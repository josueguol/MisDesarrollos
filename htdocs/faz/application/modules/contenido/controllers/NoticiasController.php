<?php 
/**
 * @author Kevin_Miriam_2020
 * Controlador para procesar los datos de los articulos de fundación, version Json ...xD
 *
 */
class contenido_NoticiasController extends Zend_Controller_Action{
	/*
	 * Seccion de noticias -Historico
	 */
	public function historicoAction(){				
		$this->view->doctype('XHTML1_RDFA');		
		$validador  = new My_Validador_AztecaValidador();
		$BoJson		= new My_Model_ProcesaJsonTraderBO();
		$url      	= $validador->urlValida($this->getRequest()->getUserParam('url',''));
		$item     	= $validador->intValido($this->getRequest()->getUserParam('item',''));
		$pagina     = $validador->intValido($this->getRequest()->getParam('pagina'));
		
		if (empty($pagina)) {
			$pagina = 0;
		}
		
		$dataJson 	= file_get_contents("https://www.tvazteca.com/appnoticias/json-fundacion-azteca-2020");
		
		$data 		= json_decode($dataJson, true);
		
		$totalReg	= 8;
		$datos 	  	= $BoJson->consultaDatosArticulo($data['items']);//Busca todos los articulos...
		
		$paginado 	= $BoJson->paginarHistorico($datos, $totalReg);//pagina los articulos  (mas bien simula un paginado...xD)
		
		$totalPag = count($paginado)-1;
		
		if ($pagina > $totalPag){//Entro a una pagina que no existe
			$pagina  = 0;
		}

		$this->view->pagina 		= $pagina;
		$this->view->total 			= $totalPag;
		$this->view->masVisto 		= $paginado[0];
		$this->view->datos 		    = $paginado[$pagina];
		$this->view->bandera  		= $bandera;
		$this->view->metadatos  	= "";
		$this->view->site			= $BoJson->obtenerUrl();
	}
	/*
	 * Busca datos de los articulos
	 */
	public function articuloAction(){		
		$this->view->doctype('XHTML1_RDFA');
		$validador  = new My_Validador_AztecaValidador();
		$BoJson		= new My_Model_ProcesaJsonTraderBO();
		$url      	= $validador->urlValida($this->getRequest()->getUserParam('url',''));
		$item     	= $validador->intValido($this->getRequest()->getUserParam('item',''));
		
		$dataJson 		= file_get_contents("https://www.tvazteca.com/appnoticias/json-fundacion-azteca-2020");
		
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
		
		//Sino encontró el articulo es probable que la url esté mal y venga de alguna red social,le quito los últimos digitos...
		if (empty($articulo) ){			
			$urlPartida = explode("-", $url);			
			array_pop($urlPartida);//Le quito el ultimo elemento
			$urlNueva = implode("-", $urlPartida);// El arreglo lo convierto de nuevo a texto sin el último elemento
			
			if(!empty($url)){//Busca los datos del articulo actual, con la nueva estructura de URL
				$resultado	= array_search($urlNueva, array_column($datosArticulos, 'idBusqueda'));
				if(strlen($resultado) > 0){
					if(array_key_exists($resultado, $datosArticulos)){
						$articulo	=	$datosArticulos[$resultado];
					}
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
	 * Seccion de noticias -Historico-multimedia
	 */
	public function historicomultimediaAction(){				
		$this->view->doctype('XHTML1_RDFA');		
		$validador  = new My_Validador_AztecaValidador();
		$BoJson		= new My_Model_ProcesaJsonTraderBOMultimedia();
		$url      	= $validador->urlValida($this->getRequest()->getUserParam('url',''));
		$item     	= $validador->intValido($this->getRequest()->getUserParam('item',''));
		$pagina     = $validador->intValido($this->getRequest()->getParam('pagina'));
		
		if (empty($pagina)) {
			$pagina = 0;
		}
		
		$dataJson 	= file_get_contents("http://uat.tv-azteca.psdops.com/appnoticias/json-fundacion-azteca-2020");
		
		$data 		= json_decode($dataJson, true);
		
		$totalReg	= 8;
		$datos 	  	= $BoJson->consultaDatosArticulo($data['items']);//Busca todos los articulos...
		
		$paginado 	= $BoJson->paginarHistorico($datos, $totalReg);//pagina los articulos  (mas bien simula un paginado...xD)
		
		$totalPag = count($paginado)-1;
		
		if ($pagina > $totalPag){//Entro a una pagina que no existe
			$pagina  = 0;
		}
			
		$this->view->pagina 		= $pagina;
		$this->view->total 			= $totalPag;
		$this->view->masVisto 		= $paginado[0];
		$this->view->datos 		    = $paginado[$pagina];
		$this->view->bandera  		= $bandera;
		$this->view->metadatos  	= "";
		$this->view->site			= $BoJson->obtenerUrl();
	}
	/*
	 * Busca datos de los articulos multimedia
	 */
	public function articulomultimediaAction(){	
		$this->view->doctype('XHTML1_RDFA');		
		$validador  = new My_Validador_AztecaValidador();
		$BoJson		= new My_Model_ProcesaJsonTraderBOMultimedia();
		$url      	= $validador->urlValida($this->getRequest()->getUserParam('url',''));
		$item     	= $validador->intValido($this->getRequest()->getUserParam('item',''));		
	
		$dataJson 	= file_get_contents("http://uat.tv-azteca.psdops.com/appnoticias/json-fundacion-azteca-2020");
		
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
		
		//Sino encontró el articulo es probable que la url esté mal y venga de alguna red social,le quito los últimos digitos...
		if (empty($articulo) ){
			$urlPartida = explode("-", $url);
			array_pop($urlPartida);//Le quito el ultimo elemento
			$urlNueva = implode("-", $urlPartida);// El arreglo lo convierto de nuevo a texto sin el último elemento
				
			if(!empty($url)){//Busca los datos del articulo actual, con la nueva estructura de URL
				$resultado	= array_search($urlNueva, array_column($datosArticulos, 'idBusqueda'));
				if(strlen($resultado) > 0){
					if(array_key_exists($resultado, $datosArticulos)){
						$articulo	=	$datosArticulos[$resultado];
					}
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
}

?>
