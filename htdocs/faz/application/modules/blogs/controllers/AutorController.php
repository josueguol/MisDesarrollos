<?php 
/**
 * @author Kevin_Miriam_2019
 * Controlador para procesar los datos de los articulos y los autores de punto trader, version Json ...xD
 *
 */
class blogs_AutorController extends Zend_Controller_Action{
	/*
	 * Busca datos de los autores
	 */
	public function indexAction(){
		$this->view->doctype('XHTML1_RDFA');
		Zend_Layout::getMvcInstance()->setLayout('layout');
		$validador  = new My_Validador_AztecaValidador();
		$BoJson		= new My_Model_ProcesaJsonTraderBO();
		$url      	= $validador->urlValida($this->getRequest()->getUserParam('url',''));
		$item     	= $validador->intValido($this->getRequest()->getUserParam('item',''));
		
		$dataJson 	= file_get_contents("https://www.tvazteca.com/appnoticias/json/puntotraderhome");
		$data 		= json_decode($dataJson, true);
		
		$datosAutor		= $BoJson->organizarDatosJson($data['items'], 2);//Traer el json organizado por autor
		$datosArticulos = $BoJson->consultaDatosArticulo($data['items']);//Traer el json original si organizar para buscar el articulo
		
		$articulo		= 	"";
		$otrosArticulos =	"";
		$otrosAutores	=	"";
		
		if(!empty($url)){//Busca los datos del autor actual
			$resultado	= array_search($url, array_column($datosArticulos, 'idBusquedaAU'));
			if(strlen($resultado) > 0){
				if(array_key_exists($resultado, $datosArticulos)){
					$articulo	=	$datosArticulos[$resultado];
				}
			}
		}
		
		// Busca los contenidos relacionados...
		
		$datosRelacionados				= $datosAutor[$articulo['autorC']];
		
		if (count($datosRelacionados)   != 0){
			$otrosArticulos				= $datosRelacionados;
		}

		$bandera = 0;
		if (count($articulo) != 0){
			
			if(count($otrosArticulos) == 0){//No tiene ningun contenido relacionado le traigo contenido de cualquier otro autor
				$otrosArticulos	= $BoJson->consultaDatosArticulo($data['items'],1,12);
				$bandera 		= 1;
			}
			
			if($bandera == 0){//En caso que no requieran esta funcionalidad  igualarlo a 2, $bandera == 2, muchas diran mejor quita el fragmento de codigo, pero como ya sabras luego dicen: Dice mi mamá que siempre SI....xD
				
				if(count($otrosArticulos) <= 2){//Tiene menos de 2 contenido, le anexo mas contenido de otros autores para que no se vea muy vacio...
					$nuevosArticulos	= $BoJson->consultaDatosArticulo($data['items'],1,12);
					$uneArreglo			= array_merge($otrosArticulos,$nuevosArticulos);
					$otrosArticulos		= $uneArreglo;
				}
				
			}
			
		}
		if (count($articulo) != 0){
			$otrosAutores = $BoJson->otrosAutores($datosAutor, $articulo['idBusquedaAU']);
		}

		$this->view->datosAutor			= $articulo;
		$this->view->articulosAutores	= $otrosArticulos;
		$this->view->otrosAutores		= $otrosAutores;
		$this->view->metadatos  		= "";
		$this->view->site				= $BoJson->obtenerUrl();
	}
	/*
	 * Busca datos de los articulos
	 */
	public function articuloAction(){
		$this->view->doctype('XHTML1_RDFA');
		Zend_Layout::getMvcInstance()->setLayout('layout');
		$validador  = new My_Validador_AztecaValidador();
		$BoJson		= new My_Model_ProcesaJsonTraderBO();
		$url      	= $validador->urlValida($this->getRequest()->getUserParam('url',''));
		$item     	= $validador->intValido($this->getRequest()->getUserParam('item',''));
		
		$dataJson 	= file_get_contents("https://www.tvazteca.com/appnoticias/json/puntotraderhome");
		$data 		= json_decode($dataJson, true);
		
		$datosAutor		= $BoJson->organizarDatosJson($data['items'], 2);//Traer el json organizado por autor
		$datosArticulos = $BoJson->consultaDatosArticulo($data['items']);//Traer el json original si organizar para buscar el articulo
		
		$articulo		= 	"";
		$otrosArticulos =	"";
		
		if(!empty($url)){//Busca los datos del articulo actual
			$resultado	= array_search($url, array_column($datosArticulos, 'idBusqueda'));
			if(strlen($resultado) > 0){
				if(array_key_exists($resultado, $datosArticulos)){
					$articulo	=	$datosArticulos[$resultado];
				}
			}
		}
		
		// Busca los contenidos relacionados...
		
		$datosRelacionados				= $datosAutor[$articulo['autorC']];
		if (count($datosRelacionados)   != 0){
			$otrosArticulos				= $BoJson->eliminarElementoActual($datosRelacionados,$url);
		}
		//$aleatorio					= array_rand($data);//array_rand($datos,10);
		//$this->view->otrosArticulos	= $this->obtieneDatosAleatorios($aleatorio, $datosRelacionados,$item);
		$bandera = 0;
		if (count($articulo) != 0){
			
			if(count($otrosArticulos) == 0){//No tiene ningun contenido relacionado le traigo contenido de cualquier otro autor
				$otrosArticulos	= $BoJson->consultaDatosArticulo($data['items'],1,12);
				$otrosArticulos	= $BoJson->eliminarElementoActual($otrosArticulos,$url);
				$bandera 		= 1;
			}
			
			if($bandera == 0){//En caso que no requieran esta funcionalidad  igualarlo a 2, $bandera == 2, muchas diran mejor quita el fragmento de codigo, pero como ya sabras luego dicen: Dice mi mamá que siempre SI....xD
				
				if(count($otrosArticulos) <= 2){//Tiene menos de 2 contenido, le anexo mas contenido de otros autores para que no se vea muy vacio...
					$nuevosArticulos	= $BoJson->consultaDatosArticulo($data['items'],1,12);
					$nuevosArticulos	= $BoJson->eliminarElementoActual($nuevosArticulos,$url);
					
					foreach ($otrosArticulos as $key => $valor){//Eliminar los repetidos de nuevos articulos, que coincidan con los relacionados
							$nuevosArticulos	= $BoJson->eliminarElementoActual($nuevosArticulos,$valor['idBusqueda']);
					}
					
					$uneArreglo			= array_merge($otrosArticulos,$nuevosArticulos);
					$otrosArticulos		= $uneArreglo;
				}
				
			}
			
		}
		$this->view->articulo		= $articulo;
		$this->view->otrosArticulos	= $otrosArticulos;
		$this->view->metadatos  = "";
		$this->view->site		= $BoJson->obtenerUrl();
	}
	/*
	 * obtiene los datos del random - por ahora no implementado.. chance para el aguinaldo 2019 ...xD
	 */
	public function obtieneDatosAleatorios($datosAleatorios,$origenDatos,$excepcion){
		$datos = array();
		 
		foreach ($datosAleatorios as $key => $idDatos) {
				$datos[] = $origenDatos[$idDatos];
		}
		//Quita un registro del arreglo, quita el registro actual para no mostrarlo en el relacionado...
		foreach ($datos as $key => $valor) {
			if($valor['idBusqueda'] === $excepcion)
				unset($datos[$key]);
		}
		return $datos;
	}
	
}

?>