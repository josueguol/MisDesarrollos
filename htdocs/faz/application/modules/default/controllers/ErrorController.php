<?php 
/**
 * Archivo de definición de controlador de errores
 *
 * @author Azteca Internet
 * @package application.modules.default.controllers
 */

/**
 * ErrorController
 *
 * @author Azteca Internet
 * @package application.modules.default.controllers
 */
class ErrorController extends Zend_Controller_Action
{
	/**
	 * errorAction() Acción automaticamente llamada por el plugin manejador de errores "ErrorHandler"
	 *
	 * {@link http://framework.zend.com/manual/en/zend.controller.plugins.html#zend.controller.plugins.standard.errorhandler the docs on the ErrorHandler Plugin}
	 *
	 * @return void
	 */
	public function errorAction(){
		// Asegurando que el sufijo predermiado usado siempre sea correcto
		$this->_helper->viewRenderer->setViewSuffix('phtml');

		// Obtener el objeto error de la petición
		$errors = $this->_getParam('error_handler');

		switch ($errors->type) {
			case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
			case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:

				$error = "404";
				$this->_forward('index', 'index', 'programas');
				break;
			case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_OTHER:
				switch ($errors->exception->getCode()) {
					case '404':
						$this->getResponse()->setHttpResponseCode(404);
						$this->getResponse()->setHeader('Error', '404');
						$this->view->message = '<center> <!-- P&aacute;gina no encontrada --> </br><img width="970" src="https://tvazteca.brightspotcdn.com/57/60/f18af0934d45a1042da761dce9de/logo.png" /></center>';
						$error = "404";
						break;
					case '500':
						$this->getResponse()->setHttpResponseCode(404);
						$this->getResponse()->setHeader('Error', '500');
						$this->view->message = '<center><!-- Error 500 --> </br><img width="970" src="https://tvazteca.brightspotcdn.com/57/60/f18af0934d45a1042da761dce9de/logo.png" /></center>';
						$error = "500";						
						break;
					case '666':
						$this->getResponse()->setHttpResponseCode(404);
						$this->getResponse()->setHeader('Error', '666');
						$this->view->message = '<center> <!-- Contenido no encontrado --> </br><img width="970" src="https://tvazteca.brightspotcdn.com/57/60/f18af0934d45a1042da761dce9de/logo.png" /></center>';
						$error = "404";
						break;
					default:
						$this->getResponse()->setHttpResponseCode(404);
						$this->getResponse()->setHeader('Error', 'sepa');
						$this->view->message = '<center> <!-- P&aacute;gina no encontrada --> </br><img width="970" src="https://tvazteca.brightspotcdn.com/57/60/f18af0934d45a1042da761dce9de/logo.png" /></center>';
						$error = "404";
						break;
				}

				break;	
			default:
				$e = $errors->exception;
				if (defined('APPLICATION_ENVIRONMENT') && APPLICATION_ENVIRONMENT != 'production' ) {
					
				} else {
					$code   = $e->getCode();
					$line   = $e->getLine();
					 
					// Guardar Log de error
					$mensaje = 'Error ' . $code . '(' . $e->getFile() . ' - ' . $line . '): ' . "\n" .
							'URL:' . $_SERVER['REQUEST_URI']  . "\n" .
							$e->getMessage() . '-' . $e->getTraceAsString();
				}

				// application error
				$this->getResponse()->setHttpResponseCode(500);
				$error = "500";
				$this->view->message = 'La p&aacute;gina que solicitaste se encuentra en mantenmiento temporal. '.$error.'<img src="https://tvazteca.brightspotcdn.com/dd/93/2ca21c074a08b2257f18e9cbdf35/puntotrader.jpg" />';
				break;
		}

		// pass the environment to the view script so we can conditionally
		// display more/less information
		$this->view->env       = $this->getInvokeArg('env');

		// pass the actual exception object to the view
		$this->view->exception = $errors->exception;

		// pass the request to the view
	    
		$this->view->request   = $errors->request;
	}
}
