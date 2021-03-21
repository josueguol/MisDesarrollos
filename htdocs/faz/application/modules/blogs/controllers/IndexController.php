<?php
/**
 * @author Kevin_Miriam_2019
 * Controlador para procesar el historicos de punto trader, version Json ...xD
 *
 */
class blogs_IndexController extends Zend_Controller_Action {

	public function indexAction() {
		$this->view->doctype('XHTML1_RDFA');
		Zend_Layout::getMvcInstance()->setLayout('layout');
		$validador  = new My_Validador_AztecaValidador();
		$BoJson		= new My_Model_ProcesaJsonTraderBO();
		$url      	= $validador->urlValida($this->getRequest()->getUserParam('url',''));
		$item     	= $validador->intValido($this->getRequest()->getUserParam('item',''));
		$pagina     = $validador->intValido($this->getRequest()->getParam('pagina'));
		
			if (empty($pagina)) {
				$pagina = 1;
			}
	
		
		$dataJson 	= file_get_contents("https://www.tvazteca.com/appnoticias/json/puntotraderhome");
		$data 		= json_decode($dataJson, true);
		
		$totalReg	= 5;
		$datos 	  	= $BoJson->consultaDatosArticulo($data['items']);//Busca todos los articulos...
		$paginado 	= $BoJson->paginarHistorico($datos, $totalReg);//pagina los articulos  (mas bien simula un paginado...xD)
		
		$totalPag = count($paginado)-1;

			if ($pagina > $totalPag){//Entro a una pagina que no existe			
				$pagina  = 1;
			}
			
		$this->view->pagina 		= $pagina;
		$this->view->total 			= $totalPag;
		$this->view->masVisto 		= $paginado[0];
		$this->view->datos 		    = $paginado[$pagina];
		$this->view->bandera  		= $bandera;
		$this->view->metadatos  	= "";
		$this->view->site			= $BoJson->obtenerUrl();
	}
	

}
