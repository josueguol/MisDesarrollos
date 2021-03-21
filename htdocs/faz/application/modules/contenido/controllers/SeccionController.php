<?php
/**
 * @author Kevin_Miriam_2020
 * Controlador para procesar las secciones de fundación, version Json ...xD
 *
 */
class contenido_SeccionController extends Zend_Controller_Action {
	
	public function init(){
		$this->view->doctype('XHTML1_RDFA');
		$this->view->metadatos  	= "";
		$this->view->site			= $this->obtenerUrl();
	}

	public function homeAction() {
		$this->view->doctype('XHTML1_RDFA');	
		$validador  			= new My_Validador_AztecaValidador();
		$BoJson					= new My_Model_ProcesaJsonTraderBO();
		
		//Para el carrusel principal
		$dataJsonCarrusel		= file_get_contents("https://www.tvazteca.com/fundacion/home2020?_renderer=json");
		$dataCarrusel			= json_decode($dataJsonCarrusel, true);
		$this->view->galeria	= $this->getProcesaImagenJsonPicture($dataCarrusel['main'][0]['items']);
		
		//Para la seccion de noticias del home		
		$dataJson 				= file_get_contents("https://www.tvazteca.com/appnoticias/json-fundacion-azteca-2020");		
		$data 					= json_decode($dataJson, true);		
		$datosNoticias			= $BoJson->consultaDatosArticulo($data['items'],1,2);
		$this->view->datos  	= $datosNoticias;
		
		$this->view->metadatos  = "";
		$this->view->site		= $this->obtenerUrl();

	}
	
	public function homegaleriaAction() {
		$this->view->doctype('XHTML1_RDFA');	
		$validador  			= new My_Validador_AztecaValidador();
		$BoJson					= new My_Model_ProcesaJsonTraderBO();
		
		//Para el carrusel principal
		$dataJsonCarrusel		= file_get_contents("https://www.tvazteca.com/fundacion/home2020?_renderer=json");
		$dataCarrusel			= json_decode($dataJsonCarrusel, true);
		$this->view->galeria	= $this->getProcesaImagenJsonPicture($dataCarrusel['main'][0]['items']);
		
		//Para la seccion de noticias del home		
		$dataJson 				= file_get_contents("https://www.tvazteca.com/appnoticias/json-fundacion-azteca-2020");		
		$data 					= json_decode($dataJson, true);		
		$datosNoticias			= $BoJson->consultaDatosArticulo($data['items'],1,3);
		$this->view->datos  	= $datosNoticias;
		
		$this->view->metadatos  = "";
		$this->view->site		= $this->obtenerUrl();
	
	}
	
	public function nosotrosAction() {
	
	}
	
	public function comunidadAction() {
	
	}
	
	public function programaseducativosAction() {
	
	}
	
	public function programasambientalesAction() {
	
	}
	
	public function directorioAction() {
	
	}

	public function contactoAction() {
	
	}
	
	/*
	 * Obtiene la url actual
	 */
	public function obtenerUrl(){
		$host   = $_SERVER['HTTP_HOST'];
		$uri    = $_SERVER['REQUEST_URI'];
		 
		return $host.$uri;
	}
	
	 /*
     * Procesa las imagenes que viene del json para mostrala al full..
     */
    public function getProcesaImagenJsonPicture($losDatos){
    	$datosGaleria 	= array();
    	
    	foreach ($losDatos as $key => $datos) {
    		$datosGaleria[$key]['titulo'] 			= $datos['title'];
    		$datosGaleria[$key]['descripcion']	 	= $datos['description'];
    		$datosGaleria[$key]['urlLink']	 		= $datos['url'];
    		if (isset($datos['media'])){
    				$datosGaleria[$key]['imagen']	= $datos['media'][0]['image']["src"];
	    			$imagenMedia 					= $datos['media'][0]['image']["src"];	    			
	    			$existeImagen					= stripos($imagenMedia, "url=");	    			    			
	    			if ($existeImagen !== false) {
	    				$imgNueva 						= explode("url=",$imagenMedia);
	    				$imgNueva 						= urldecode($imgNueva[1]);
	    				$datosGaleria[$key]['urlImagen']= $imgNueva;
	    			} else {
	    				$datosGaleria[$key]['urlImagen']= "https://fundacionazteca.org/assets/v2/images/azteka2.jpg"; // Imagen Default
	    			}
    			
    		} else {
    				$datosGaleria[$key]['urlImagen']= "https://fundacionazteca.org/assets/v2/images/azteka2.jpg"; // Imagen Default
    		}
    	}
    	if(empty($datosGaleria)){
    		$datosGaleria[0]['titulo'] 			= "Sin Titulo";
    		$datosGaleria[0]['descripcion']	 	= "Sin Descripción";
    		$datosGaleria[0]['urlImagen']		= "https://fundacionazteca.org/assets/v2/images/azteka2.jpg"; // Imagen Default
    		$datosGaleria[0]['urlLink']			= "#"; // Link Default
    	}
			
		return $datosGaleria;
	}

}
