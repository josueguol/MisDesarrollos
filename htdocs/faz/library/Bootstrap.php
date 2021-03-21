<?php
/**
 * Archivo de definición de clase Bootstrap
 *
 * @package library
 * @author Azteca Internet
 * @version 1.0
 */

/**
 * Clase Bootstrap para inicialización de aplicación
 *
 * @package library
 * @author Azteca Internet
 */
class Bootstrap {
	/**
	 * Instancia estática
	 *
	 * @var Bootstrap
	 */
	protected static $_instance = null;

	/**
	 * Petición a partir de URL
	 *
	 * @var string
	 */
	protected $_module;

	/**
	 * Adaptadores de base de datos
	 *
	 * @var array
	 */
	protected $_dbAdapter;

	/**
	 * Adaptadores de caché
	 *
	 * @var array
	 */
	protected $_cacheAdapter;

	/**
	 * Configuración de la aplicación
	 *
	 * @var Zend_Config
	 */
	protected $_config = array();

	/**
	 * Devuelve instancia estática de esta clase, creándola si es necesario
	 *
	 * @return Bootstrap
	 */
	public static function getInstance()
	{
		if (null === self::$_instance) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * Lanza aplicación
	 *
	 * @return Bootstrap
	 */
	public function run()
	{
		$this->_setupAutoloader()
		->_setupEnvironment()
		->_loadConfig()
		->_setupFrontController()
		->_setupLayout()	
		->_setupRegistry()
		->_setupRoute()
		->_dispatchFrontController();

		return $this;
	}

	/**
	 * Inicializa y determina el ambiente de la aplicación
	 *
	 * @return Bootstrap
	 */
	protected function _setupEnvironment()
	{
		Zend_Locale::setDefault('es_MX');
		// CONSTANTES DE APLICACIÓN - Asigna valores a las constantes de aplicación
		defined('APPLICATION_PATH')
		or define('APPLICATION_PATH', dirname(__FILE__));

		// En caso de no estar definidas, se utilizará "development" como ambiente predeterminado
		defined('APPLICATION_ENVIRONMENT')
		or define('APPLICATION_ENVIRONMENT', 'testing');

		return $this;
	}

	/**
	 * Configura Autolader
	 *
	 * @return Bootstrap
	 */
	protected function _setupAutoloader()
	{
		require_once 'Zend/Version.php';

		if (Zend_Version::compareVersion('1.8') <= 0) {
			include_once 'Zend/Loader/Autoloader.php';
			$autoLoader = Zend_Loader_Autoloader::getInstance();
			$autoLoader->registerNamespace('My_')
			->registerNamespace('XmlfeedObject')
			->registerNamespace('XmlfeedObject_');
		} else {
			include_once 'Zend/Loader.php';
			Zend_Loader::registerAutoload();
		}

		return $this;
	}

	/**
	 * Carga configuración de la aplicación
	 *
	 * @return Bootstrap
	 */
	protected function _loadConfig()
	{
		// Obtener módulo
		$request       = new Zend_Controller_Request_Http();
		$elements      = explode('/', $request->getRequestUri());
		$this->_module = ($elements[1] == '')?'default':$elements[1];


		// CONFIGURATION - Setup the configuration object
		$configuration['main']		= new Zend_Config_Ini2(APPLICATION_PATH . '/config/appEncrypt.ini', APPLICATION_ENVIRONMENT);
		Zend_Registry::set('main', $configuration['main']);

		// Cargar configuración solo para el módulo solicitado en caso de existir
		$appIniFile = APPLICATION_PATH . '/modules/' . $this->_module . '/app.ini';
			
		if (true == file_exists($appIniFile)) {
			$configuration[$this->_module] = new Zend_Config_Ini($appIniFile, APPLICATION_ENVIRONMENT);
			Zend_Registry::set($this->_module, $configuration[$this->_module]);
		}

		$this->_config = $configuration;

		return $this;
	}

	/**
	 * Configura Front Controller y Layout
	 *
	 * @return Bootstrap
	 */
	protected function _setupFrontController()
	{
		Zend_Controller_Front::getInstance()
		->throwExceptions(false)
		->setBaseUrl($this->_config['main']->baseUrl)
		->addModuleDirectory(APPLICATION_PATH . '/modules')
		->setParam('env', APPLICATION_ENVIRONMENT)
		->returnResponse(true);

		return $this;
	}

	/**
	 * Configura Layout
	 *
	 * @return Bootstrap
	 */
	protected function _setupLayout()
	{
		Zend_Layout::startMvc(APPLICATION_PATH . '/layouts/scripts');

		$view = Zend_Layout::getMvcInstance()->getView();
		$view->doctype('XHTML1_STRICT');
		$view->addHelperPath(APPLICATION_PATH . '/../library/My/View/Helper', 'My_View_Helper');

		return $this;
	}

 
	/**
	 * Configuración de registro
	 *
	 * @return Bootstrap
	 */
	protected function _setupRegistry()
	{
		// REGISTRY - setup the application registry
		$registry = Zend_Registry::getInstance();
		$registry->configuration = $this->_config['main'];
		$registry->dbAdapter     = $this->_dbAdapter;
		$registry->cacheAdapter  = $this->_cacheAdapter;


		return $this;
	}

	/**
	 * Configuración dinámica de Routers
	 * Se deberán agregar routers en archivo app.ini según sea necesario con sintaxis similar:
	 *
	 * 		router.nombre.route	     = nombremod/:controller/:varios  ;; ruta
	 * 		router.nombre.module     = nombremod					  ;; modulo
	 * 		router.nombre.controller = notashistoricas				  ;; controlador
	 * 		router.nombre.action     = index						  ;; acción
	 *
	 * @return Bootstrap
	 */
	protected function _setupRoute()
	{
		$controller = Zend_Controller_Front::getInstance();

		// ROUTERS Principales
		if (isset($this->_config['main']->router) && $this->_config['main']->router instanceof Zend_Config) {
			$router     = $this->_config['main']->router->toArray();
			foreach($router as $routeName=>$routeOptions) {
				$controller->getRouter()
				->addRoute($routeName,
						new Zend_Controller_Router_Route(array_shift($routeOptions), $routeOptions, $routeOptions['parts'])
				);
			}
		}

		// ROUTERS Por módulo
		if (isset($this->_config[$this->_module]->router) && $this->_config[$this->_module]->router instanceof Zend_Config) {
			$router     = $this->_config[$this->_module]->router->toArray();
			foreach($router as $routeName=>$routeOptions) {
				$controller->getRouter()
				->addRoute($routeName,
						new Zend_Controller_Router_Route(array_shift($routeOptions), $routeOptions)
				);
			}
		}

		return $this;


	}

	/**
	 * Despacha Front Controller
	 *
	 * @return Bootstrap
	 */
	protected function _dispatchFrontController()
	{
		// Lanza aplicación, si existe una excepción será lanzada desde aquí
		// y atrapada en ErrorController del módulo default
		$expires = null;

		// Obtener parámetros de manejo de caché por página
		if (isset($this->_config['main']->expires)) {
			$expires = $this->_config['main']->expires->toArray();
		}
		 
		// Aplicar caché por módulo (opcional)
		if (isset($this->_config[$this->_module]->expires)) {
			$expires = $this->_config[$this->_module]->expires->toArray();
		}

		// Aplicar reglas de caché parametrizado desde archivos de configuración
		if (is_array($expires)) {
			if ($expires['time'] <= 0) {
				$expires['pragma'] 		 = 'no-cache';
				$expires['cachecontrol'] = 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0';
				$expires['time'] = gmdate("D, d M Y H:i:s",
						(time() + $expires['time'])) . ' GMT';
			} else {
				$expires['pragma'] 		 = '';
				$expires['cachecontrol'] = 'max-age=' . $expires['time'];
				$expires['time'] = gmdate("D, d M Y H:i:s",
						(time() + $expires['time'])) . ' GMT';
			}

			Zend_Controller_Front::getInstance()->dispatch()
			->setHeader('Expires', $expires['time'], true)
			->setHeader('Pragma', $expires['pragma'], true)
			->setHeader('Cache-Control', $expires['cachecontrol'], true)
			->sendResponse();
		} else {
			 
			Zend_Controller_Front::getInstance()->dispatch()
			->setHeader('Expires', gmdate("D, d M Y H:i:s",
					time() + 220).' GMT', true)
					->setHeader('Pragma', '', true)
					->setHeader('Cache-Control', 'max-age=220', true)
					->sendResponse();
		}
		return $this;
	}

	/**
	 * Implementación de patrón Singleton, restringe el uso del operador "clone"
	 *
	 */
	private function __construct()
	{
	}

	/**
	 * Implementación de patrón Singleton restringe el uso del operador "clone"
	 *
	 * @return void
	 */
	private function __clone()
	{
	}
}
