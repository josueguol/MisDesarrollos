<?php
/**
 * Archivo de definición de clase
 *
 * @package library.My.Controller
 * @author Moíses Pérez Ayala <mpereza@tvazteca.com>
 * @author Andrés García Alcántara <angarcia@tvazteca.com>
 * @version 0.8
 */

/**
 * Definición de clase de controlador genérico
 *
 */
class My_Controller_ActionAzteca extends Zend_Controller_Action
{

    /**
     * Context posibles
     *
     */
    public $contexts = array('index'    => array("dmrss","json","xml","iphone","arrayJS","xbox","zip"),
                             'busqueda' => array("dmrss","json","xml","iphone","arrayJS","xbox"),
                             'carta'    => array("dmrss","json","xml","iphone","arrayJS","xbox"));


    /**
     * Variable de registro de aplicación
     *
     * @var Zend_Registry
     */
    protected $_registry = null;
    public    $tPurgar;
    public    $ePurgar;
    public    $bPurgar;
    public    $sPurgar;

	/**
     * Inicia al cargar la pagina, configura context para la aplicacion
     */
    public function init(){ 
    	// Array donde se pueden agregar los sitios responsivos
    	$arraySinVistaMovil = array();
    	if($this->_request->getModuleName() == 'ideas') {
    		array_unshift($arraySinVistaMovil,'');
    	}
    	if($this->_request->getParam('prog') == '' && $this->_request->getModuleName() != 'ideas') {
    		$this->_request->setParam('prog','home2013');
    	}
    	
    	$this->tPurgar     = (isset($_GET['t']) == 'purgar');
        $this->ePurgar     = (isset($_GET['e']) == 'purgar');
        $this->bPurgar     = (isset($_GET['b']) == 'purgar');
        $this->sPurgar     = (isset($_GET['s']) == 'clean');
        
        $contextSwitch = $this->_helper->contextSwitch(); 
        
    	$customContext = array("iphone","xbox","zip",);
    	foreach($customContext as $item){ //Agregamos los context que no vienen por default y necesitamos
 			try{ $contextSwitch->addContext( $item, array( 'suffix' => $item, 'headers' => array( 'Content-type' => 'text/html', ), )); }
 			catch(Exception $e) { }
    	}
        //agregamos el contexto dmrss
        try{ 
            $contextSwitch->addContext( "dmrss", array( 'suffix' => "dmrss", 'headers' => array( 'Content-type' => 'application/xml', ), )); 
        }
        catch(Exception $e) { }
        
        $container = $_SERVER['HTTP_USER_AGENT']; //Obtenemos el user agent de quien hace la peticion de la pagina
        $useragents  = array('iphone', 'ipod', 'aspen', 'dream', 'android','Nokia5800','blackberry9630','IEMobile','BB10'); //Catalogo de agents con los cuales compararemos

        $applemobile = false;
		$is_iphone   = false;
        foreach ($useragents as $useragent) { //Verificamos si es una peticion de un aparato de apple y si especificamente es un iphone
           if (preg_match("/".$useragent."/i" , strtolower($container) )) {
                  $applemobile = true;
                  $is_iphone = true;
           }
        }
        //Si no es un producto apple
        if ( !$applemobile ) {
            $browserAgents = 'Elaine, Palm, EudoraWeb, Blazer, AvantGo, Windows CE, Cellphone, Small, MMEF20, Danger, hiptop, Proxinet, ProxiNet, Newt, PalmOS, NetFront, SHARP-TQ-GX10, SonyEricsson, SymbianOS, UP.Browser, UP.Link, TS21i-10, MOT-V, portalmmm, DoCoMo, Opera Mini, Palm, Handspring, Nokia, Kyocera, Samsung, Motorola, Mot, Smartphone, Blackberry, WAP, SonyEricsson, PlayStation Portable, LG, MMP,OPWV, Symbian, EPOC';
            $browserAgents = explode(',',$browserAgents);
            if(!empty($browserAgents)){
                foreach ($browserAgents as $key => $value)
                    $browserAgents[$key] = trim($value);
            }

            foreach ( $browserAgents as $userAgent ) {
                if(preg_match("/".$userAgent."/i", strtolower($container))){
                    $applemobile = true;
                    $is_iphone   = false;
                }
           }
        }
        
        //Todo:  eliminar despues que se arregle 
        if($this->_request->getParam('format') == 'xml-')
        $this->_request->setParam("format","xml");
        
        //Si es un producto apple
 		if($applemobile == true){
		  	if($is_iphone == true ){//muestra el estilo iphone
				$platform = 'iphone';
			}
			$this->_request->setParam("format", $platform);
		}
 		//Todos los request que vengan de http les agrega el format json
    	if($this->_request->isXmlHttpRequest())
            $this->_request->setParam("format","json");

    	// Buscamos la configuracion del programa para saber el idFabrica al que pertenece
        $programa = $this->_request->getParam('prog','siete-beta');
 
        $modelProgramas   =  new My_Model_Programas();
        $iDatosResponsive = $modelProgramas->getIdFabrica($programa,$this->ePurgar);


        // Si el iResponsivo es 1, eliminamos el context iphone para mostrar sitio responsivo
        if($iDatosResponsive['iResponsive'] == 1 && $this->_request->getParam('format') != "json") {
            $contextSwitch->removeActionContext('index','iphone');
       	    $format = '';
        } else {
        	$format = $this->_request->getParam('format');
        }
       
        if($this->_request->getParam("module")!="busqueda") {
            if(!in_array($this->_request->getParam('prog'), $arraySinVistaMovil) || !in_array($this->_request->getParam('programa'), $arraySinVistaMovil))
                $contextSwitch->initContext();
        }

        
    	
    	//Despues de que inicializa el context, hay que colocar el "LAYOUT" mobil
   		//$format = $this->_request->getParam('format');
    	$this->view->format = $format;

    	  
    	if(in_array($this->_request->getParam('prog'), $arraySinVistaMovil) )
    		$format = "";

     	$layout = "";//layout
     	if($format == "xml" || $format =="json" || $format =="xbox" || $format == "zip" || $format =="dmrss"){//no layout
            header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
			header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
      	}else {
     		$layout = "layout";
     		if($format == "iphone" ){
     			$layout = "layoutmovilcontext";
     			header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
				header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
      		}

     		Zend_Layout::getMvcInstance ()->setLayout($layout);
        }
        $this->layoutAux = $layout; 
        //Reemplazamos de la URI la variable ?format= ... &format=
        $this->_request->setParam('format',null);
 		if($format!=""){
 			$cadena = $_SERVER["REQUEST_URI"];
 			$cadena= str_replace( strstr($cadena,"?format="),"", $cadena);
 			$_SERVER["REQUEST_URI"] = str_replace( strstr($cadena,"&format=") ,"", $cadena);
 		}
    }
    /**
     * Método para obtener datos del programa, posibles opciones como llaves de arreglo.
     *         menu:
     *         widget:
     *         oas:
     *         seo:
     * Asignar valor false para desactivar
     *
     * @param array $elementosPagina Arreglo de parametrización de datos de programa
     * @param $idPrograma
     * @param int $idSeccion
     * @return array
     */
    public function getDatosGenerales($elementosPagina, $programa, $seccion, $item, $url = ""){

    	$extra = '';
    	// Buscamos primero en caché
        $cache      = Zend_Registry::getInstance()->cacheAdapter['programas'];
        $cacheClave = md5("config-$seccion-$programa$extra");
		$datos = $cache->load($cacheClave);

        // Si no hay datos en caché generarlos
        if(false == $datos || $this->ePurgar == true){
            try {
                 
                //DATOS GENERALES
                $arrConfiguracion = $this->_getDatosConfiguracion($programa, $seccion);
                
                // si existen los datos de configuración
                if (isset($arrConfiguracion) && count($arrConfiguracion) > 0){ //si funciona pasa al siguiente
                    //DATOS COMPLEMENTARIOS DE CONFIGURACION - Url de Siete y Trece
                    if ($arrConfiguracion[0]['tituloCanal'] == 'Azteca Siete') $arrConfiguracion[0]['cUrlDescripcion'] = 'http://www.azteca.com/azteca7';
                    if ($arrConfiguracion[0]['tituloCanal'] == 'Azteca Trece') $arrConfiguracion[0]['cUrlDescripcion'] = 'http://www.azteca.com/aztecatrece';
                    
                	// DATOS MENU
                    $arrMenu    = (isset($elementosPagina['menu']) && $elementosPagina['menu'] == false)?
                    null : $this->_getMenu($arrConfiguracion[0]['idPrograma']);
                    if ($arrMenu != null) $arrMenu[0]['cUrlPathHelper'] = dirname(dirname(dirname(dirname(__FILE__)))).'/library/'.$arrMenu[0]['cPathHelper'];
                    
                    $arrMenu2014    = (isset($elementosPagina['menu']) && $elementosPagina['menu'] == false)?
                    null : $this->_getMenu2014($arrConfiguracion[0]['idPrograma']);
                    if ($arrMenu2014 != null) $arrMenu2014[0]['cUrlPathHelper'] = dirname(dirname(dirname(dirname(__FILE__)))).'/library/'.$arrMenu[0]['cPathHelper'];

                    // DATOS WIDGET
                    $arrWidget   = (isset($elementosPagina['widget']) && $elementosPagina['widget'] == false)?
                    null:$this->_getWidget($arrConfiguracion[0]['idPrograma']);
                    
                    //MENUS TEMPLATE
                    $arrMenusTemplate = $this->_getMenusTemplate($arrConfiguracion[0]['idPrograma']);
                    
                    // DATOS OAS
                    $arrOas      = (isset($elementosPagina['oas']) && $elementosPagina['oas'] == false)?
                    null:$this->_getOas($arrConfiguracion[0]['idPrograma'],$arrConfiguracion[0]['idWidget']);
                    
                    //DATOS OAS Ubicacion 1
                    $arrOasUbicacion1  = (isset($elementosPagina['oas']) && $elementosPagina['oas'] == false)?
                    null:$this->_getOasUbicacion($arrConfiguracion[0]['idPrograma'],$arrConfiguracion[0]['idWidget'],'1');
                     
                    // DATOS OAS Ubicacion 2
                    $arrOasUbicacion2  = (isset($elementosPagina['oas']) && $elementosPagina['oas'] == false)?
                    null:$this->_getOasUbicacion($arrConfiguracion[0]['idPrograma'],$arrConfiguracion[0]['idWidget'],2);
                     
                    // DATOS OAS Ubicacion 3
                    $arrOasUbicacion3  = (isset($elementosPagina['oas']) && $elementosPagina['oas'] == false)?
                    null:$this->_getOasUbicacion($arrConfiguracion[0]['idPrograma'],$arrConfiguracion[0]['idWidget'],3);
                    
                    //MENUS Azteca 13 Logo
                    $arrMenusSitio = $this->_getMenusTemplate('10541');
                    
                    //MENUS Azteca Uno Programa Home Azteca Uno - Menu idPrograma 11375
                    $arrMenusSitioProgramas = $this->_getMenusTemplate('11375');
                    
                    //MENUS Programas azteca
                    $arrMenusSitioProgramas2018 = $this->_getMenusTemplate('10635');
                    
                    //MENUS Programas amas
                    $arrMenusSitioProgramasAmas2018 = $this->_getMenusTemplate('11464');
                    
                    //tv Azteca Programas - Carrusel de programas Internas 2018
                    $arrtvAztecaProgramas = $this->_getubicacionPrograma('11375','2025','home');
                    
                    //defineSlot
                    $arrConfiguracion[0]['defineSlot'] = $this->defineSlotDFP($arrConfiguracion);
                    
                    // EstilosTetris
                    $estilosTetris     = new My_Model_Estilostetris();
                    $arrConfiguracion[0]['estilosTetris'] = $estilosTetris->getDefault($arrConfiguracion[0]['idPrograma']);
                    
                    //MENUS Azteca 7 Programa Home Azteca 7 - Menu idPrograma 11377
                    $arrMenusSitioSiete = $this->_getMenusTemplate('11377');
                    
                    //MENUS Azteca Uno Programa Home Azteca Uno - Menu idPrograma 11375
                    $arrMenusSitioUno = $this->_getMenusTemplate('11375');
                    
                    //defineSlot
					$arrConfiguracion[0]['defineSlot'] = $this->defineSlotDFP($arrConfiguracion);
					
                    //Aquí se concentran todos los datos para luego enviarlos a vistas.
                    $datos = array('menu'=> $arrMenu,'menu2014'=> $arrMenu2014, 'widget' => $arrWidget, 'widgetXbox' => $arrWidget, 
                                   'oas'=> $arrOas,
                                   'configuracion'=> $arrConfiguracion, 
                    		       'arrayOasUbicacion1'=>$arrOasUbicacion1,
                    		       'arrayOasUbicacion2'=>$arrOasUbicacion2,
                    		       'arrayOasUbicacion3'=>$arrOasUbicacion3,
                                   'menusTemplate' => $arrMenusTemplate,
                                   'menusSitioAztecaSiete' => $arrMenusSitioSiete,
                                   'menusSitioAztecaUno' => $arrMenusSitioUno,
                                   'menusSitio' => $arrMenusSitio,
                                   'tvAztecaProgramas' => $arrtvAztecaProgramas,
                                   'menusSitioProgramas' => $arrMenusSitioProgramas,
                                   'menusSitioProgramas2018' => $arrMenusSitioProgramas2018,
                                   'menusSitioProgramasAmas2018' => $arrMenusSitioProgramasAmas2018
                        
                    );
                    //Obtenemos Id y cUrlArchivo default dependiendo de que no exista uno asociado y el tipo de widget
                    $cUrlArchivo = $this->_getUrlTemplate($seccion, $datos['configuracion'][0]['cUrlArchivo'], $datos['configuracion'][0]['idLayout'], $datos);
                    $idTemplate  = $this->_getIdTemplate($seccion, $datos['configuracion'][0]['idTemplate'], $datos['configuracion'][0]['cUrlArchivo']);
                    $datos['configuracion'][0]['cUrlArchivo'] = $cUrlArchivo;
                    $datos['configuracion'][0]['idTemplate']  = $idTemplate;

                }
            }catch (Exception $e) {
                if ($this->tPurgar) $msg = 'No es posible purgar, se mantienen los datos desde cache, datos generales. getDatosGenerales()';
                else throw new Exception('No fue posible obtener información de la base de datos, datos generales. getDatosGenerales()' ,  404);
                
            }
            
            $HoraDelete    = Zend_Registry::get('main')->delete->cache->hora;
            $MinutoDelete  = Zend_Registry::get('main')->delete->cache->minuto;
            $SegundoDelete = Zend_Registry::get('main')->delete->cache->segundos;
            $TiempoCache =  mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) - time(); //86400
            if ($TiempoCache <= 0){
                $TiempoCache =  (mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) + 86400) - time(); //86400
            }
            $cache->setLifetime($TiempoCache);
            $cache->save($datos,$cacheClave);
        }
        
        // Buscamos en cache los datos de barra
	    $cache      = Zend_Registry::getInstance()->cacheAdapter['programas'];
	    $cacheClave = md5("barra".date("N"));
	    $datosBarra = $cache->load($cacheClave);
	    // Si no hay datos en caché generarlos
	    if(false == $datosBarra || $this->bPurgar == true){
	    	// LISTA DE PROGRAMAS PARA BARRA Y HOME
            $arrListaProgramas = $this->_getListaProgramas();

			// DESTACAMOS 7 Y 13
			$destacamos = $this->_destacamos();
				
			//Obtenemos datos de facebook y twitter.
			$utilities = new My_Model_Utilities_tortugaUtilities();
			$datosBarra['usuariosFB'] = number_format($utilities->getUsuariosFB()); //Usuarios en facebook
			$datosBarra['usuariosTW'] = number_format($utilities->getUsuariosTW()); //Usuarios en twitter
			
			$HoraDelete    = Zend_Registry::get('main')->delete->cache->hora;
	        $MinutoDelete  = Zend_Registry::get('main')->delete->cache->minuto;
	        $SegundoDelete = Zend_Registry::get('main')->delete->cache->segundos;
	        $TiempoCache =  mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) - time(); //86400
	        if ($TiempoCache <= 0){
	        	$TiempoCache =  (mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) + 86400) - time(); //86400
	        }
	        $cache->setLifetime($TiempoCache);
	        $cache->save($datosBarra,$cacheClave);
	    }

        if ($currentLiveUrl != "#") $datosBarra['currentLiveUrl'] = $currentLiveUrl;
            
        $this->obtenerUrl();
        $this->view->datosBarra   = $datosBarra;
        $this->view->usuariosFB   = $datosBarra['usuariosFB'];
        $this->view->usuariosTW   = $datosBarra['usuariosTW'];
        $this->view->arrayOasUbicacion1 = $datos['arrayOasUbicacion1'];
        $this->view->arrayOasUbicacion2 = $datos['arrayOasUbicacion2'];
        $this->view->arrayOasUbicacion3 = $datos['arrayOasUbicacion3'];
        
        
        return $datos;
    }
    
    /**
     * Funcion que obtendra los datos para el formato xbox, internas e historicos de notas, galerias, videos y homes
     * @param array $arrWidgetXbox
     * @param integer $idPrograma
     * @param string $seccion
     * @param string $fabricaDescripcion
     * @param integer $item
     * @param string $programa
     * @param string $tipoHistorico
     */
    public function getDatosXbox($arrWidgetXbox, $idPrograma, $seccion, $fabricaDescripcion, $item, $programa) {
    	$model = new My_Model_XboxGralFunctions();
    	return $model->getDatosXbox($idPrograma, $seccion, $arrWidgetXbox, $fabricaDescripcion, $item, $programa, $this->tPurgar);
    }
    
    /**
     * Funcion que obtendra los datos para el formato xbox,historicos de notas, galerias, videos
     * @param integer $idPrograma
     * @param string $seccion
     * @param string $fabricaDescripcion
     * @param string $programa
     * @param string $tipoHistorico
     * @param integr $page
     * @param integer $categoria
     * @return array
     */
    public function getDatosHistoricoXbox($idPrograma, $seccion, $fabricaDescripcion, $programa, $tipo, $pagina, $categoria) {
    	$model = new My_Model_XboxGralFunctions();
    	return $model->getDatosHistoricoXbox($idPrograma, $seccion, $fabricaDescripcion, $programa, $tipo, $pagina, $categoria, $this->tPurgar);
    }

    /**
     * TRAE LOS DATOS GENERALES POR PROGRAMA
     * @param  programa - Id
     * @param  seccion - id de dominio
     * @return array
     */
    private function _getDatosConfiguracion($programa, $seccion){
        $obj    = new My_Model_Programas();
        $result = $obj->obtenerConfigPrograma($programa, $seccion);
        return $result;
    }

    /**
     *OBTIENE EL MENÚ CORRESPONDIENTE POR PROGRAMA
     *@param int idPrograma
     *@return array
     */
    private function _getMenu($idPrograma){
        $obj = new My_Model_TemplateHelper();
        $result = $obj->getHelper($idPrograma);
        return $result;
    }


    /**
     *OBTIENE EL MENÚ CORRESPONDIENTE DEL SITIO 2014
     *@param int idPrograma
     *@return array
     */
    private function _getMenu2014(){
    	$obj = new My_Model_MenusTemplate();
    	$result = $obj->getMenuAzteca2014();
    	return $result;
    }
    /**
     * Obtiene un arreglo con los widgets por programa
     * @param int idProgram
     * @return array
     */
    private function _getWidget($idPrograma){
        $obj = new My_Model_Eje();
        $result=$obj->obtenerWidgetsPrograma($idPrograma);
        return $result;
    }

    /**
     * Obtiene los oas por programa
     * @param int $programa
     * @param int $seccion
     */
    private function _getOas($programa,$seccion){
        $OasTag  = '';
        $cont    = 0;
        $oasPosic=array();
        $objMenu = new My_Model_Oas();
        $result = $objMenu->obtenerOASPrograma($programa,$seccion);
        if (isset($result) && count($result) > 0){
            foreach($result as $tmp){
                $cont= $cont +1;
                if($cont == 1)
                    $OasTag .= $tmp['cPosicion'];
                else
                    $OasTag .= ",".$tmp['cPosicion'];
                $oasPosic['OAS'.$cont]=strtoupper($tmp['cPosicion']);
            }
            $this->view->oasPosiciones =$oasPosic;
        }
        $this->view->oas  = $OasTag;
        $this -> obtenerUrl();
        return $result;
    }
    
	/**
    *OBTIENE EL MENÚ DE PROGRAMAS
    *@return array
    */
    private function _getProgramMenu() {
        $obj = new My_Model_ProgramMenu();
        $result = $obj->get_items();
        return $result;
    }

    /**
     * Trae la url válida correspondiente y manda a la vista el oasSite
     *
     */
    public function obtenerUrl(){
        //$patron = '/(www|net|com|org|mx|\.)/';
        //$host   = preg_replace($patron, '', $_SERVER['HTTP_HOST']);
        $host   = $_SERVER['HTTP_HOST'];
        $uri    = $_SERVER['REQUEST_URI'];
        $this->view->site = $host.$uri;
        return $host.$uri;
    }

    /**
     * Obtiene registro
     *
     * @return void
     */
    protected function _getRegistry(){
        $this->_registry = Zend_Registry::getInstance();
    }
    /**
     *Obtiene los OAS (smart server) por programa, widget y ubicacion del OAS
     * @param int $programa
     * @param int $widget
     * @param int $ubicacion Unicacion del OAS 1.- Despues del Body 2.- El cuerpo de la pagina 3.- Antes de cerrar el body
     */
    private function _getOasUbicacion($idPrograma,$idWidget,$ubicacion){
    	$obj = new My_Model_Oas();
    	$result=$obj->obtenerOASProgramaUbicacion($idPrograma,$idWidget,$ubicacion);
    	return $result;
    }

    /**
     * Obtiene el cUrlArchivo default
     * @param string $seccion
     */
    private function _getUrlTemplate($seccion, $cUrlArchivo, $iTetris, $datos) {
        $obj = new My_Model_Programas();
        $result = $obj->obtenUrlTemplate($seccion, $cUrlArchivo, $iTetris, $datos);
        return $result;
    }
    
	/**
	 * Obtiene el id del template
	 * 
	 * @param Integer $seccion
	 * @param Integer $idTemplate
	 * @param String $cUrlArchivo
	 * @return Ambigous <number, unknown>
	 */
    private function _getIdTemplate($seccion, $idTemplate, $cUrlArchivo) {
        $obj    = new My_Model_Programas();
        $result = $obj->obtenIdTemplate($seccion, $idTemplate, $cUrlArchivo);
        return $result;
    }

    /**
     * Ejecución previa a lanzamiento de aplicación
     *
     */
    public function preDispatch(){

        $this->view->addScriptPath(APPLICATION_PATH.'/../library/');
        $_modulo = $this->_request->getModuleName();
        $dominio   = 'tvazteca';//isset($getBarra->dominio)?$getBarra->dominio:'tvazteca';

        //AddSense
        if(false !== Zend_Registry::isRegistered($_modulo)) {
            $appini = Zend_Registry::get($_modulo);
            $ads    = $appini->addsense;
        }else{
            $registry = Zend_Registry::getInstance();
            $ads      = $registry['main']->addsense;
            $appini   = false;
        }
        if(!is_null($ads)){
            $ads2 = "{";
            foreach($ads as $seccion => $valores ){
                $ads2 .= "'$seccion':{'section':'$seccion',";
                foreach($valores as $parametros => $valor){
                    $ads2 .="'$parametros' : '$valor',";
                }
                $ads2 = substr($ads2,0,(strlen($ads2)-1));
                $ads2 .= "},";
            }
            $ads2 = substr($ads2,0,(strlen($ads2)-1));
            $ads2 .= "}";

            $this->view->ads = $ads2;
        }
        //AddSense

        //Información para iniciar sesión en el dominio, los datos los envia a el view

        if($this->_request->getModuleName() === "sesion") return;
        if($this->_request->getModuleName() === "registro") {
            $_cName = $this->_request->getControllerName();
            if($_cName == "create"||$_cName=="login") return;
        }

        Zend_Session::start();
        if (true == Zend_Session::namespaceIsset('login')) {
            $loginUsr = Zend_Session::namespaceGet('login');
            $this->view->identidad = $loginUsr;
        }

        /*Obtiene y envia al view la seccion y la subseccion actual
         * Se encuentra en el app.ini de cada módulo
        */
        if($appini){
            $_controller =  $this->_request->getControllerName();

            $idSeccion = 1;
            $idSubSeccion = 114;//Por default azteca.com
            if(isset($appini->programa)){
                $idSeccion = $appini->programa->idSeccion;
                $idSubSeccion = $appini->programa->idSubSeccion;
            }else if(isset($appini->programa->$_controller)){
                $idSeccion = $appini->programa->$_controller->idSeccion;
                $idSubSeccion = $appini->programa->$_controller->idSubSeccion;
            }

            $this->view->programa = Zend_Json::encode(
                    array('seccion'=>(int)$idSeccion,
                            'subseccion'=>(int)$idSubSeccion
                    )
            );
        }

        /******* Validamos si hay una sesion iniciada de Facebook *********/
        // hay que quitar este comentario para que si se sube a Producción no le pegue en su nariz
		//include_once 'Facebook.php';
        $user_id  = '';
        //$faceVars = Zend_Registry::getInstance()->main->facebook;
        //$facebook = new Facebook($faceVars->appapikey, $faceVars->appsecret);
        //$user_id  = $facebook->get_loggedin_user();

        /*if($user_id != '')
         $facebook->expire_session();*/
        $this->view->idFacebook = $user_id;
    }
    
	public function _getListaProgramas(){
    	$modelProgramas =  new My_Model_Programas();
    	
    	$programas['alfabetico'] = $modelProgramas->listaProgramas("1,10");
    	$programas['trece'] = $modelProgramas->listaProgramas("1","1");
    	$programas['siete'] = $modelProgramas->listaProgramas("10","1");
    	
    	return $programas;
    }
    
	public function _destacamos(){
    	$modelHome =  new My_Model_Home();
    	
    	$destacamos['siete'] = $modelHome->destacamos("destacamosSiete");
    	$destacamos['trece'] = $modelHome->destacamos("destacamosTrece");
    	
    	return $destacamos;
    }

    public function _getMenusTemplate($idPrograma){
    	$model = new My_Model_MenusTemplate();
    	 
		$menusTemplate = $model->getMenusTemplate($idPrograma);
		
    	return $menusTemplate;
    }
    
    public function _getubicacionPrograma($idPrograma,$idTemplate,$modulo){
        
        $ubicacionesTetris = new My_Model_UbicacionesTetris();
        $datos = $ubicacionesTetris->getUbicacionesTetris($idPrograma, $idTemplate, $modulo, $this->tPurgar, $this->ePurgar);
        $valores['data'] = $datos['top'][0]['data'];
        $valores['config'] = $datos['top'][0]['config'];
        
        return $valores;
    }
    

    /**
     * Este metodo obtiene las cascadas ADZTECA en caso que existan
     * @param unknown_type $idPrograma
     */
    public function getCascadas($idPrograma){
    	// Buscamos primero en caché
    	$cache      = Zend_Registry::getInstance()->cacheAdapter['programas'];
    	$cacheClave = md5("config-cascadas-$idPrograma");
    	$datos = $cache->load($cacheClave);
    	
    	// Si no hay datos en caché generarlos
    	if(false === $datos || $this->ePurgar == true){
    		
    		$modelCascadas =  new My_Model_Cascadas();
    		
    		$datos = $modelCascadas->getCascadas($idPrograma);
    		
    		$HoraDelete    = Zend_Registry::get('main')->delete->cache->hora;
    		$MinutoDelete  = Zend_Registry::get('main')->delete->cache->minuto;
    		$SegundoDelete = Zend_Registry::get('main')->delete->cache->segundos;
    		$TiempoCache =  mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) - time(); //86400
    		if ($TiempoCache <= 0){
    			$TiempoCache =  (mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) + 86400) - time(); //86400
    		}
    		$cache->setLifetime($TiempoCache);
    		$cache->save($datos,$cacheClave);
    	}
    	
    	return $datos;
    }

    /**
	 * Agrega la url que se utilzara para el defineSlot del  DFP
	 * @param string $modulo
	 * @param string $item
	 * @return Ambigous <string>
	 */
	public function defineSlotDFP($datos) {
		
		$defineSlotBase = '/29782907/Azteca.com/';
		$no_permitidas= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","Ñ",' ');
		$permitidas= array ("a","e","i","o","u","A","E","I","O","U","n","N",'-');
		$nombreFabrica = str_replace($no_permitidas, $permitidas ,$datos[0]['fabricaDescripcion']);
		$nombrePrograma = str_replace($no_permitidas, $permitidas ,$datos[0]['cNombre']);
		$tipoW    = $array = array( "1" => "Home-".$nombrePrograma);
		if($datos[0]['programa'] == 'homeazteca2018') {
			$urlGoogleTag = $defineSlotBase;
			$nombrePrograma = 'home/home';
			$programa = $nombrePrograma;
		} else {
			$urlGoogleTag = $defineSlotBase.$nombreFabrica."/".str_replace(' ','-',$nombrePrograma)."/";
			$programa = $tipoW[$datos[0]['idWidget']];
		}
		
	
		
		if (stripos($datos[0]['programa'],'home') !== FALSE )
			$datos[0]['programa'] = 'home';
			
		if (false !== strpos($this->cUrl,'historico'))
			$programa = 'Historico-'.$nombrePrograma;
	
		$slotP['urlDefineSlot'] = $urlGoogleTag.$programa;
		$slotP['defineSlotBase'] = $defineSlotBase;
		return $slotP;
	}
}