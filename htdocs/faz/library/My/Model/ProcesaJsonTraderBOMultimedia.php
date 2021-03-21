<?php 
/**
 * BO para procesar los json que alimentaran el sitio puntoTrader
 * @package azteca.My.Model.ProcesaJsonTraderBO
 * @author  Kevin_Miriam_2020
 * @version 1.0.0 - 10-03-2020
 */
class My_Model_ProcesaJsonTraderBOMultimedia{
    /* Modulo de noticias y articulos y el que necesite ser organizado...xD todo sea por exigir el bono del 2020...xD2 
     * Organiza el json para procesarlos, los organiza por temas o por autor segun sea necesario
     */
    public function organizarDatosJson($LosDatos,$tipoDato){//$tipoDato 1= Tema , 2 Autor
    	if(empty($LosDatos)) return "";
    	$util			= new My_Model_UtileriasCadenas();
    	$objetoAutores	= new My_Model_JsonAutoresTrader();
    	$arrAutor		= array();
    	$arrTema		= array();
    	
    	foreach ($LosDatos as $key => $datos) {
    		$contenido 							= $util->keepClean(strip_tags($datos['contenido']));
    		$contenidoH 						= $util->keepClean(strip_tags($datos['contenido']));
    		$titulo 							= strip_tags($util->keepClean($datos['titulo']));
    		$teaser 							= strip_tags($util->keepClean($datos['teaser']));
    		$separar							= explode("/",$datos['compartir']);
    		$urlTitulo 							= trim(end($separar));
    		$separar2							= explode(".com",$datos['compartir']);
    		$urlTitulo2							= $util->convierteUrl($util->keepClean($separar2[1]));
    		$autor								= strip_tags($util->convierteUrl($util->keepClean($datos['autor'])));
    		$tema								= strip_tags($util->convierteUrl($util->keepClean($datos['tema'])));
    		//$dataAutores						= $objetoAutores->obtenerDatosAutor($autor,$datos['autor']);
    		$fecha								= $datos['fecha'];
    		$date 								= explode("T", $datos["fecha"]); $date = explode("-", $date[0]);
    		$dia 								= $date[2]; $mes = $date[1]; $anio = $date[0];
    		$fecha 								= strtotime("{$mes}/{$dia}/{$anio}");
    		$newformat 							= date('j', $fecha)." de ".$util->convierteMes($mes)." de ".date('Y', $fecha);
    		
    		$cantidadC  						= 90;
    		$tresPuntos 						= "...";
    		$textobusqueda 						= explode("||",wordwrap($teaser,$cantidadC,"||"));
    		$truncar 							= $textobusqueda[0]; if(strlen($teaser) > $cantidadC ){$tresPuntos = "...";}
    		$contenidoH 	  					= $textobusqueda[0].$tresPuntos;
    		
    		    
    		if(strlen($contenido) > 60){		$contenido 	= 	mb_substr($contenido, 0, 59).	"...";}
    		//if(strlen($contenidoH) > 250){		$contenidoH = 	mb_substr($contenidoH, 0, 280).	"...";}
    		if(strlen($titulo) > 54){			$titulo = 		mb_substr($titulo, 0, 46).		"...";}
    		if(strlen($teaser) > 60){			$teaser = 		mb_substr($teaser, 0, 59).		"...";}
    		    		
    		$idContenido						= ($key+1)*3;
    		$LosDatos[$key]['fecha'] 			= $newformat;
    		$LosDatos[$key]['idBusqueda'] 		= $urlTitulo;
    		$LosDatos[$key]['idBusqueda2'] 		= $urlTitulo2;
    		$LosDatos[$key]['idBusquedaAU'] 	= $autor;
    		$LosDatos[$key]['autorC']  			= $autor;
    		$LosDatos[$key]['temaC'] 			= $tema;
    		$LosDatos[$key]['contenidoC'] 		= $contenido;
    		$LosDatos[$key]['contenidoH'] 		= $contenidoH;
    		$LosDatos[$key]['tituloC'] 			= $titulo;
    		$LosDatos[$key]['teaserC'] 			= $teaser;
    		if(!empty($autor))					array_push($arrAutor, $autor);
    		if(!empty($tema))					array_push($arrTema, $tema);
    		
    		$LosDatos[$key]['urlC'] 			= "/contenido/noticias/articulomultimedia/".$idContenido."/".$urlTitulo;
    		$LosDatos[$key]['urlAutor'] 		= "/blogs/autor/".$idContenido."/".$autor;
    		//$LosDatos[$key]['imagenAutor'] 		= $dataAutores['cImagen'];
    		//$LosDatos[$key]['acercaAutor'] 		= $dataAutores['cAcerca'];
    	}
    	
    	$datosLimpios 	= $LosDatos;
    	$arregloAutor	= array_unique($arrAutor);	//Quita los autores repetidos
    	$arregloTema	= array_unique($arrTema);	//Quita los temas repetidos
    	$aTema			= array();
    	$aAutor			= array();
    	
		if ($tipoDato == 1){
    	//Arreglo agrupado por Temas
	    	foreach ($arregloTema as $keyT => $datosT) {
	    		foreach ($datosLimpios as $key => $datos) {
	    			if($datosT === $datos['temaC']){
	    				$aTema[$datosT][] = $LosDatos[$key];
	    			}
	    		}
	    	}
		}
		if ($tipoDato == 2){
    	//Arreglo agrupado por Autor
	    	foreach ($arregloAutor as $keyA => $datosA) {
	    		foreach ($datosLimpios as $key => $datos) {
	    			if($datosA === $datos['autorC']){
	    				$aAutor[$datosA][] = $LosDatos[$key];
	    			}
	    		}
	    	}
		}
    	return ($tipoDato == 1)? $aTema : $aAutor;
    }
    
    /* Modulo blog - Articulo
     * Muestra los datos del articulo y su contenido relacionado
     */
    public function consultaDatosArticulo($LosDatos,$banderacontador = 0,$cantidadRegistros = 10){
    	if(empty($LosDatos)) return "";
    	$util			= new My_Model_UtileriasCadenas();
    	$objetoAutores	= new My_Model_JsonAutoresTrader();
		$nuevosDatos 	= array();
		
    	foreach ($LosDatos as $key => $datos) {
    		$nuevosDatos[$key]['autor'] 		= $datos['autor'];
    		$nuevosDatos[$key]['compartir']	 	= $datos['compartir'];
    		if (isset($datos['contenidoMultimedia'])){
    			$nuevosDatos[$key]['contenido'] 	= $this->procesaImagenJsonPicture($datos['contenidoMultimedia']);
    		}else{
    			$nuevosDatos[$key]['contenido'] 	= $datos['contenido'];
    		}
    		//$nuevosDatos[$key]['fecha'] 		= $datos['fecha'];
    		$nuevosDatos[$key]['fechacap'] 		= $datos['fechacap'];
    		$nuevosDatos[$key]['imagen'] 		= $datos['imagen'];
    		$nuevosDatos[$key]['nota'] 			= $datos['nota'];
    		$nuevosDatos[$key]['teaser'] 		= $datos['teaser'];
    		$nuevosDatos[$key]['tema'] 			= $datos['tema'];
    		$nuevosDatos[$key]['titulo'] 		= $datos['titulo'];
    		
    		$contenido 							= $util->keepClean(strip_tags($datos['contenido']));
    		$contenidoH 						= $util->keepClean(strip_tags($datos['contenido']));
    		$titulo 							= strip_tags($util->keepClean($datos['titulo']));
    		$teaser 							= strip_tags($util->keepClean($datos['teaser']));
    		$separar							= explode("/",$datos['compartir']);
    		$urlTitulo 							= trim(end($separar));
    		$separar2							= explode(".com",$datos['compartir']);
    		$urlTitulo2							= $util->convierteUrl($util->keepClean($separar2[1]));
    		$autor								= strip_tags($util->convierteUrl($util->keepClean($datos['autor'])));
    		$tema								= strip_tags($util->convierteUrl($util->keepClean($datos['tema'])));
    		//$dataAutores						= $objetoAutores->obtenerDatosAutor($autor,$datos['autor']);
    		$fecha								= $datos['fecha'];
    		$date 								= explode("T", $datos["fecha"]); $date = explode("-", $date[0]);
    		$dia 								= $date[2]; $mes = $date[1]; $anio = $date[0];
    		$fecha 								= strtotime("{$mes}/{$dia}/{$anio}");
    		$newformat 							= date('j', $fecha)." de ".$util->convierteMes($mes)." de ".date('Y', $fecha);
    		
    		$cantidadC  						= 90;
    		$tresPuntos 						= "";
    		$textobusqueda 						= explode("||",wordwrap($teaser,$cantidadC,"||"));
    		$truncar 							= $textobusqueda[0]; if(strlen($teaser) > $cantidadC ){$tresPuntos = "...";}
    		$contenidoH 	  					= $textobusqueda[0].$tresPuntos;
    
    		if(strlen($contenido) > 60){		$contenido = 	mb_substr($contenido, 0, 59).	"...";}
    		//if(strlen($contenidoH) > 135){		$contenidoH = 	mb_substr($contenidoH, 0, 100).	"...";}
    		if(strlen($titulo) > 54){			$titulo = 		mb_substr($titulo, 0, 45).		"...";}
    		if(strlen($teaser) > 60){			$teaser = 		mb_substr($teaser, 0, 59).		"...";}
    		
    		$idContenido						= ($key+1)*3;
    		$nuevosDatos[$key]['fecha'] 		= $newformat;
    		$nuevosDatos[$key]['idBusqueda'] 	= $urlTitulo;
    		$nuevosDatos[$key]['idBusqueda2'] 	= $urlTitulo2;
    		$nuevosDatos[$key]['idBusquedaAU'] 	= $autor;
    		$nuevosDatos[$key]['autorC']  		= $autor;
    		$nuevosDatos[$key]['temaC'] 		= $tema;
    		$nuevosDatos[$key]['contenidoC'] 	= $contenido;
    		$nuevosDatos[$key]['contenidoH'] 	= $contenidoH;
    		$nuevosDatos[$key]['tituloC'] 		= $titulo;
    		$nuevosDatos[$key]['teaserC'] 		= $teaser;    		
    		
    		$nuevosDatos[$key]['urlC'] 			= "/contenido/noticias/articulomultimedia/".$idContenido."/".$urlTitulo;
    		$nuevosDatos[$key]['urlAutor'] 		= "/blogs/autor/".$idContenido."/".$autor;
    		//$nuevosDatos[$key]['imagenAutor'] 	= $dataAutores['cImagen'];
    		//$nuevosDatos[$key]['acercaAutor'] 	= $dataAutores['cAcerca'];
    		
    		if($banderacontador == 1){//retornar solo el numero de elementos indicado, para cuando no existe contenido relacionado del autor trae de otros autores...
    			if ($cantidadRegistros == $key){
    				return $nuevosDatos; //Retorno la cantidad de elementos especificados, el predeterminado es 10
    			}
    		}
    			
    	}

    	return $nuevosDatos;
    }
    /*
     * Procesa las imagenes que viene del json para mostarla al full...
     */
    public function procesaImagenJson($cuerpoDocumento){
    	try {
		//Convertir utf8 a ISO-8859-1
		//$htmlISO = mb_convert_encoding($cuerpoDocumento, 'ISO-8859-1'); //Local    	
    	$htmlISO = utf8_decode($cuerpoDocumento);//P
		//Create a new DOMDocument object.
		$htmlDom = new DOMDocument;
		$opcionesLibXML = LIBXML_COMPACT | LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD;

		//Load the HTML string into our DOMDocument object.
		@$htmlDom->loadHTML($htmlISO,$opcionesLibXML);

		//Extract all img elements / tags from the HTML.
		$imageTags = $htmlDom->getElementsByTagName('img');
		$length = $imageTags->length;

		if (strlen($length) >= 1){
			//Loop through the image tags that DOMDocument found.
			For ($i = $length - 1; $i > -1 ; $i--) {
			    //Obtiene los datos de la imagen y la procesa
			    $nodePre 	= $imageTags->item($i);
			    $imgSrc  	= $nodePre->getAttribute('src');
			    $ExisteUrl	= stripos($imgSrc, "url=");
			     
			    if ($ExisteUrl !== false) {
			    	$imgSrc 	= explode("url=",$imgSrc);
			    	$imgSrc 	= urldecode($imgSrc[1]);
			    }

			    //Crea el elemento imagen en el nuevo formato
			    $nodeImg = $htmlDom->createElement("img");
			    $nodeImg->setAttribute('src', $imgSrc);

			 
			    //Reemplaza el elemento nuevo por el viejo
			    $nodePre->parentNode->replaceChild($nodeImg, $nodePre);
			}
		}
		$resultado = $htmlDom->saveHTML($htmlDom->documentElement);//documentElement :: importante para no recibir entities
		return $resultado;

	} catch (Exception $e) {	
	   return $cuerpoDocumento;//Por si acaso fallará el proceso de reemplazar la imagen que me regrese el json original
	}
    	
    }
    
    /*
     * Procesa las imagenes que viene del json para mostarla al full version Luis Flores...
     */
    public function procesaImagenJsonPicture($cuerpoDocumento){
    	try {
    		//Convertir utf8 a ISO-8859-1
    		//$htmlISO = mb_convert_encoding($cuerpoDocumento, 'ISO-8859-1'); //Local
    		$htmlISO = utf8_decode($cuerpoDocumento);//P
    		//Create a new DOMDocument object.
    		$htmlDom = new DOMDocument;
    		$opcionesLibXML = LIBXML_COMPACT | LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD;
    
    		//Load the HTML string into our DOMDocument object.
    		@$htmlDom->loadHTML($htmlISO);
    
    		//Extract all img elements / tags from the HTML.
    		$imageTags = $htmlDom->getElementsByTagName('picture');
    		$length = $imageTags->length;
    
    		if (strlen($length) >= 1){
    			//Loop through the image tags that DOMDocument found.
    			For ($i = $length - 1; $i > -1 ; $i--) {
                	//Obtiene los datos de la imagen y la procesa
                    	$nodePre        = $imageTags->item($i);//Lee el primer elemento del arreglo de picture       
                    	$lista          = $nodePre->childNodes; //Del elemento actual Lista los hijos de picture en este caso para obtener la etiqueta img(el cual debe ser uno solo en teoria)
                    	$etiquetaImg    = $nodePre->getElementsByTagName('img'); //Ahora si ya podemos leer la etiqueta img
                    	$nodoImg        = $etiquetaImg->item(0);//Leemos el primer elemento de img, en teoria siempre habrá un img dentro de picture si es que Luis no cambia de parecer...xD
                    	$etiquetaAncla  = $nodePre->getElementsByTagName('a');
                    	$nodoAncla      = $etiquetaAncla->item(0);

                    if ($nodoAncla) { //Si encontro un enlace en la estructura de picture que la procese...                                       
                        $linkHref   = $nodoAncla->getAttribute('href'); 
                        $linkClase  = $nodoAncla->getAttribute('class');                       
                        //Crea la etiqueta de enlace
                        $nodoANuevo = $htmlDom->createElement("a");//Creamos la etiqueta a
                        $nodoANuevo->setAttribute('href', $linkHref);//Le seteamos la ulr
                        $nodoANuevo->setAttribute('class', $linkClase);

                        $tipoTarget    = $nodoAncla->getAttribute('target');
                        if ($tipoTarget) {
                            $nodoANuevo->setAttribute('target', $tipoTarget);//Le seteamos el tipo de target
                        }                       
                        
                        $imgNueva       = $nodoImg->getAttribute('src');
                        $ExisteImagen   = stripos($imgNueva, "url=");
                        
                         if ($ExisteImagen !== false) {
                                    $imgNueva   = explode("url=",$imgNueva);
                                    $imgNueva   = urldecode($imgNueva[1]);
                                }
                        
                        //Crea el elemento imagen  en el nuevo formato
                        $nodoImgNueva   = $htmlDom->createElement("img");//Creamos la etiqueta Imagen
                        $nodoImgNueva->setAttribute('src', $imgNueva);//Le seteamos la ulr de la imagen ya procesada                     
                        //Crea el nodo antes de la etiqueta picture
                        $padre = $nodePre->parentNode->insertBefore ($nodoANuevo,$nodePre);
                        //Insertamos la imagen dentro del enlace
                        $padre->appendChild($nodoImgNueva);                     
                        $nodePre->parentNode->removeChild ($nodePre);//Eliminamos la etiqueta Picture                        
                    } else {
                        $imgNueva       = $nodoImg->getAttribute('src');
                        $ExisteImagen   = stripos($imgNueva, "url=");
                        
                         if ($ExisteImagen !== false) {
                                    $imgNueva   = explode("url=",$imgNueva);
                                    $imgNueva   = urldecode($imgNueva[1]);
                                }
                        
                        //Crea el elemento imagen  en el nuevo formato
                        $nodoImgNueva   = $htmlDom->createElement("img");//Creamos la etiqueta Imagen
                        $nodoImgNueva->setAttribute('src', $imgNueva);//Le seteamos la ulr de la imagen ya procesada                        
        
                        //Agrega el elemento nuevo y elimina picture
                        $nodePre->parentNode->insertBefore ($nodoImgNueva,$nodePre);//Insertamos el nuevo elemento antes de la etiqueta Picture con la nueva estructura
                        $nodePre->parentNode->removeChild ($nodePre);//Eliminamos la etiqueta Picture                                              
                    }
    			}
    		}
    		$resultado = $htmlDom->saveHTML($htmlDom->documentElement);//documentElement :: importante para no recibir entities
    		return $resultado;
    
    	} catch (Exception $e) {
    		return $cuerpoDocumento;//Por si acaso fallará el proceso de reemplazar la imagen que me regrese el json original
    	}
    
    }
    /*
     * Quita un registro del arreglo, quita el registro actual para no mostrarlo en el relacionado...
     */
    public function eliminarElementoActual($origenDatos,$excepcion){
    	
    	foreach ($origenDatos as $key => $valor) {
    		if($valor['idBusqueda'] == $excepcion){
    			unset($origenDatos[$key]);
    		}
    	}
    
    	return array_values($origenDatos);
    }
    
    /*
     * Quita un registro del arreglo, quita el registro actual para no mostrarlo en el relacionado...si me alcanza el tiempo hacemos una sola funcion para quitar elementos
     */
    public function eliminarElementoActualAU($origenDatos,$excepcion){
    	 
    	foreach ($origenDatos as $key => $valor) {
    		if($valor['idBusquedaAU'] == $excepcion){
    			unset($origenDatos[$key]);
    		}
    	}
    
    	return array_values($origenDatos);
    }
    
    /*
     * Organiza los autores con su respectivos campos
     */
    public function otrosAutores($origenDatos,$excepto){
    	$aAutores	= array();
    	foreach ($origenDatos as $keyA => $datosA) {
    		if($keyA !== $excepto){//Que no me incluya el autor actual
	    		foreach ($origenDatos[$keyA] as $key => $datos) {
	    			if($key <= 0){
	    				if(strlen($datos['autor']) > 18){$nombreAutor = 	mb_substr($datos['autor'], 0, 15).	"...";}
	    				$aAutores[] = array('urlAutor' 		=> $datos['urlAutor'],
	    								  	'nombreAutor' 	=> $nombreAutor,
	    								  	'imagenAutor' 	=> $datos['imagenAutor'],
	    								  	'acercaAutor' 	=> $datos['acercaAutor']
	    								);
	    			}
	    		}
    		}
    	}
    	return array_values($aAutores);
    }
    /*
     * Paginador del historico
     */
    public function paginarHistorico($LosDatos,$numeroRegistros){
    if(empty($LosDatos)) return "";
    	$organizaIndex = array_values($LosDatos);
    	$data 		   = array_chunk($organizaIndex,$numeroRegistros);
    
    	return $data;
    }

    /*
     * Obtiene la url actual
     */
    public function obtenerUrl(){
    	$host   = $_SERVER['HTTP_HOST'];
    	$uri    = $_SERVER['REQUEST_URI'];
    	
    	return $host.$uri;
    }
    
}
