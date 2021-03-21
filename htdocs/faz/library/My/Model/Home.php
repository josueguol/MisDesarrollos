<?php
/**
 * Archivo de definición de model de nota generica
 * @author  Azteca Digital [EPG] 2012-09-26
 * @version 1.0.0
 */

class My_Model_Home extends My_Db_TableAzteca{
	public $_modulo;
	public $tPurgar;
	
	
	public function init(){
		if(isset($_GET['t']) == 'purgar')
			$this->tPurgar = 'purgar';
	}
	
	/**
	 * Metodo que obtiene los datos del Home 
	 * [EPG] 2012-09-26
	 */
	public function datosHome(){
		
		$idUbicacion = 359;
		$idEje       = 3486;
		
		//Sacamos el contenido
		$sql ='SELECT cTipo, REPLACE(cH.cTeaser,"\'","\\\\\'") as cTeaser, p.cUrl as cUrlPrograma, 
				      p.cHorario, p.cNombre, idElemento, cH.cUrlEspecial, cH.idImagen, 
				      REPLACE(cH.cTitulo,"\'","\\\\\'") as cTitulo, cTipo, cUrlImg, cPivotPoint, 
				      s.cUrl as seccionUrl, s.cDescripcion as seccion, cH.iVentanaNueva, dFechaPublicacion
			     FROM contenidoHome cH 
				      LEFT JOIN programas p on p.idPrograma = cH.idPrograma 
				      LEFT JOIN seccion s on s.idSeccion = p.idSeccion
			    WHERE cH.idEje = '.$idEje.' 
				 	  AND cH.idUbicacion 	= '.$idUbicacion.'
				 	  AND dFechaPublicacion = (SELECT dFechaPublicacion 
												 FROM contenidoHome
												WHERE idEje = '.$idEje.'  
												      AND idUbicacion = '.$idUbicacion.' 
												      AND dFechaPublicacion  <= now()
												GROUP BY dFechaPublicacion 
												ORDER BY dFechaPublicacion DESC
												LIMIT 1)
			  	ORDER BY cH.iPrioridad DESC';
 
		$result = $this->query($sql);
		$result = $this->trataDatos($result);
		return $result;
	}
	
	/**
	 * Metodo que obtiene los datos de la seccion de Espectaculos 
	 * [EPG] 2012-09-26
	 */
	public function datosEspectaculos(){
		
		$idUbicacion = 362;
		$idEje = 3486;
		
		//Sacamos el contenido
		$sql ='SELECT cTipo, p.cUrl as cUrlPrograma, p.cHorario, p.cNombre, idElemento, 
					  cH.cUrlEspecial, cH.idImagen, REPLACE(cH.cTitulo,"\'","\\\\\'") as cTitulo,
					  cTipo, cUrlImg, cPivotPoint, s.cUrl as seccionUrl, s.cDescripcion as seccion, 
					  cH.iVentanaNueva, dFechaPublicacion
			     FROM contenidoHome cH 
					  LEFT JOIN programas p on p.idPrograma = cH.idPrograma 
					  LEFT JOIN seccion s on s.idSeccion = p.idSeccion
				WHERE cH.idEje = '.$idEje.' 
				      AND cH.idUbicacion = '.$idUbicacion.'
			   		  AND dFechaPublicacion = (SELECT dFechaPublicacion 
							        			 FROM contenidoHome
											    WHERE idEje = '.$idEje.'  
												      AND idUbicacion = '.$idUbicacion.' 
												      AND dFechaPublicacion  <= now()
												GROUP BY dFechaPublicacion 
												ORDER BY dFechaPublicacion DESC
												LIMIT 1) 
				ORDER BY cH.iPrioridad DESC';
		$result = $this->query($sql);
		
		$result = $this->trataDatos($result);
		
		return $result;
		
	}
	
	/**
	 * Metodo que obtiene los elementos de "DESTACAMOS" para la seccion 7(destacamosSiete) y 13(destacamosTrece)
	 * [EPG] 2012-09-26
	 */
	public function destacamos($metodo){
		
		//Sacamos idUbicacion
		$sql="select rtu.idUbicacion
				from 
				    templates t
				LEFT JOIN rel_template_ubicacion rtu on t.idTemplate = rtu.idTemplate
                LEFT JOIN ubicacion u ON u.idUbicacion = rtu.idUbicacion
				where 
				    t.cDescripcion = 'HomeNotasTT' and u.cMetodo = '$metodo';";
		$result = $this->query($sql);
		$idUbicacion = $result[0]['idUbicacion'];
		//Sacamos el idEje
		$sql="Select e.idEje
				from 
				    programas p
				LEFT JOIN eje e on p.idPrograma = e.idPrograma
				where cUrl='notas-tt';";
		$result = $this->query($sql);
		$idEje = $result[0]['idEje'];
		
		//Sacamos el contenido
		$sql ='SELECT cTipo, p.cUrl as cUrlPrograma, p.cNombre, idElemento, cH.cUrlEspecial, cH.idImagen, cH.cTitulo, cTipo, cUrlImg, cPivotPoint
					FROM 
					    contenidoHome cH 
					LEFT JOIN programas p on p.idPrograma = cH.idPrograma 
						   WHERE cH.idEje = '.$idEje.' 
						   		AND cH.idUbicacion = '.$idUbicacion.' 
						   	ORDER BY cH.iPrioridad DESC LIMIT 3';	

		$result = $this->query($sql);
		
		$result = $this->trataDatos($result);
		
		return $result;
	}
	
	/**
	 * Metodo que obtiene los elementos de Noticias
	 * [EPG] 2012-11-14
	 */
	public function noticias(){
		$utilerias = new My_Model_UtileriasCadenas();
		
		$sql = "select * from (
				      select
				          reung.iPrioridad, reung.idRelEjeUbicacionNotaGenerica, reung.cURLEspecial as cUrlRecomendacion, reung.bVentanaNueva,programa.cUrl as cUrlPrograma,ng.dtFechaEvento as fecha,DATE_FORMAT(ng.dtFechaEvento , '%H:%i') as hora,ng.dtFechaCaptura as fechaCap,CONCAT(DATE_FORMAT(ng.dtFechaEvento, '%a, %d %b  %Y  %T') ,' CST')as fechaRSS,'' as  iDuracion,
				           ng.idNotaGenerica as idNotaGenerica, ng.cTitulo as cTituloRecomendacion, ng.cTeaser as cTeaserRecomendacion, '  ' as cUrlWeb, c.cDescripcion, 'nota' as tipoRow, 'imagenRecomendacion',programa.cNombre as NombrePrograma,programa.idPrograma,
				          (SELECT cUrl FROM rel_notaGenerica_multimediaImagenes x INNER JOIN multimediaImagenes y ON x.idMultimediaImagenes = y.idMultimediaImagenes WHERE x.idNotaGenerica = ng.idNotaGenerica  LIMIT 1) as imagenRecomendacion1,
				          contrelng,contrelvn,contrelgl
				        from rel_eje_ubicacion_notaGenerica as reung
				               join notaGenerica as ng on reung.idNotaGenerica = ng.idNotaGenerica
				               join categorias as c on ng.idCategoria = c.idCategoria
				               join programas as programa  on programa.idPrograma = ng.idPrograma
				              left join (SELECT idNotaGenerica1, count( idNotaGenerica1) as contrelng FROM rel_notaGenerica_notaGenerica GROUP BY idNotaGenerica1) cntrelng on cntrelng.idNotaGenerica1 = ng.idNotaGenerica 
				               left join (SELECT idNotaGenerica, count( idNotaGenerica) as contrelvn FROM rel_notaGenerica_multimediaVideos GROUP BY idNotaGenerica) cntrelvn on cntrelvn.idNotaGenerica = ng.idNotaGenerica 
					       left join (SELECT idNotaGenerica, count( idNotaGenerica) as contrelgl FROM rel_galerias_notaGenerica GROUP BY idNotaGenerica) cntrelgl on cntrelgl.idNotaGenerica = ng.idNotaGenerica 
				       where reung.idEje = 383 and reung.idUbicacion = 84
				  
				  union
				       select
				          reumv.iPrioridad, reumv.idRelEjeUbicacionMultimediaVideos as idRelEjeUbicacionNotaGenerica, reumv.cURLEspecial as cUrlRecomendacion, reumv.bVentanaNueva,programa.cUrl as cUrlPrograma,mv.dtFechaPublicacion as fecha,DATE_FORMAT(mv.dtFechaPublicacion , '%H:%i') as hora,mv.dtFechaCreacion as fechaCap,CONCAT(DATE_FORMAT(mv.dtFechaPublicacion, '%a, %d %b  %Y  %T') ,' CST')as fechaRSS,mv.iDuracion as  iDuracion,
				          mv.idMultimediaVideos as idNotaGenerica, mv.cTitulo as cTituloRecomendacion, mv.cTeaser as cTeaserRecomendacion, mv.cUrlWebVideo as cUrlWeb, c.cDescripcion, 'capitulos' as tipoRow, 'imagenRecomendacion',programa.cNombre as NombrePrograma,programa.idPrograma,
				          (SELECT cUrl as cUrl FROM rel_MultimediaImagenes_MultimediaVideos x  INNER JOIN multimediaImagenes y ON x.idMultimediaImagenes = y.idMultimediaImagenes WHERE x.idMultimediaVideos = mv.idMultimediaVideos  LIMIT 1) as imagenRecomendacion1,
				          contrelng,contrelvn,contrelgl
				       from rel_eje_ubicacion_multimediaVideos as reumv
				              join multimediaVideos as mv on reumv.idMultimediaVideos = mv.idMultimediaVideos
				              join categorias as c on mv.idCategoria = c.idCategoria
				              join programas as programa  on programa.idPrograma = mv.idPrograma
				              left join (SELECT idMultimediaVideos1, count( idMultimediaVideos1) as contrelvn FROM rel_multimediaVideos_multimediaVideos GROUP BY idMultimediaVideos1) cntrelvn on cntrelvn.idMultimediaVideos1 = mv.idMultimediaVideos
				               left join (SELECT idMultimediaVideos, count( idMultimediaVideos) as contrelng FROM rel_notaGenerica_multimediaVideos GROUP BY idMultimediaVideos) cntrelng on cntrelng.idMultimediaVideos = mv.idMultimediaVideos 
					       left join (SELECT idMultimediaVideos, count( idMultimediaVideos) as contrelgl FROM rel_galerias_multimediaVideos GROUP BY idMultimediaVideos) cntrelgl on cntrelgl.idMultimediaVideos = mv.idMultimediaVideos
				      where reumv.idEje = 383 and reumv.idUbicacion = 84
				
				) as t 
				LEFT JOIN (SELECT
								se.idElemento, SUM(se.iTotalComentarios) as contComentarios, idPrograma
							FROM 
								estadisticas as se
								left join rel_eje_ubicacion_notaGenerica sreung on se.idElemento=sreung.idNotaGenerica
							WHERE 
								se.iTotalComentarios > 0 AND se.idWidget = 3 and sreung.idEje = 383 and sreung.idUbicacion = 84
				            GROUP BY idElemento) est 
				on  est. idElemento = t.idNotaGenerica and est.idPrograma = t.idPrograma				
				order by t.iPrioridad ASC, idRelEjeUbicacionNotaGenerica DESC limit 5";
		 
		$this->_setAdapter(Zend_Registry::getInstance()->dbAdapter['externo']);
		$result = $this->query($sql);
		
		foreach($result as $k => $v) {
			switch($v['tipoRow']) {
				case 'nota':
					$result[$k]['cUrl'] = 'http://www.aztecanoticias.com/notas/'.$v['cUrlPrograma'].'/'.$v["idNotaGenerica"].'/'.$utilerias->convierteUrl($v["cTituloRecomendacion"]);
					break;
				case 'capitulos':
					$result[$k]['cUrl'] = 'http://www.aztecanoticias.com/capitulos/'.$v['cUrlPrograma'].'/'.$v["idNotaGenerica"].'/'.$utilerias->convierteUrl($v["cTituloRecomendacion"]);
					break;
			}
		}
		
		return $result;
	}
	
	/**
	 * Metodo que obtiene los elementos de Deportes
	 * [EPG] 2012-11-14
	 */
	public function deportes(){
		$utilerias = new My_Model_UtileriasCadenas();
		
		$sql = "select * 
					from ( 
					        SELECT
					        reung.iPrioridad, reung.idRelEjeUbicacionNotaGenerica, '' AS cUrlRecomendacion20, reung.bVentanaNueva, p.cUrl AS cUrlPrograma20, b.idWidget as idNotaGenerica20,
					        b.cTitulo AS cTituloRecomendacion20, '' AS TEspecial20, b.cTeaser AS cTeaserRecomendacion, c.cDescripcion, 'nota' as tipoRow20, p.cNombre as NombrePrograma20, 
					        b.cUrlImagen AS imagenRecomendacion20
					    FROM rel_eje_ubicacion_notaGenerica AS reung 
					    LEFT JOIN busqueda b ON b.idWidget = reung.idNotaGenerica AND idTipoWidget = 3
					    LEFT JOIN programas p ON p.idPrograma = b.idPrograma
					    RIGHT JOIN categorias c ON c.idCategoria = b.idCategoria
					    WHERE reung.idEje = 3556 AND reung.idUbicacion = 293
					UNION
					    SELECT
					        reug.iPrioridad, reug.idRelEjeUbicacionGaleria, '' AS cUrlRecomendacion, reug.bVentanaNueva, p.cUrl AS cUrlPrograma, b.idWidget as idNotaGenerica,
					        b.cTitulo AS cTituloRecomendacion, reug.cTituloEspecial, b.cTeaser AS cTeaserRecomendacion, c.cDescripcion, 'galeria' as tipoRow, p.cNombre as NombrePrograma, 
					        b.cUrlImagen AS imagenRecomendacion2
					    FROM rel_eje_ubicacion_galeria AS reug
					    LEFT JOIN busqueda b ON b.idWidget = reug.idGalerias AND idTipoWidget = 4
					    LEFT JOIN programas p ON p.idPrograma = b.idPrograma
					    RIGHT JOIN categorias c ON c.idCategoria = b.idCategoria
					    WHERE reug.idEje = 3556 AND reug.idUbicacion = 293
					UNION
					    SELECT
					        reum.iPrioridad, reum.idRelEjeUbicacionMultimediaVideos, '' AS cUrlRecomendacion, reum.bVentanaNueva, p.cUrl AS cUrlPrograma, b.idWidget as idNotaGenerica,
					        b.cTitulo AS cTituloRecomendacion, reum.cTituloEspecial, b.cTeaser AS cTeaserRecomendacion, c.cDescripcion, 'videonota' as tipoRow, p.cNombre as NombrePrograma, 
					        b.cUrlImagen AS imagenRecomendacion2
					    FROM rel_eje_ubicacion_multimediaVideos as reum
					    LEFT JOIN busqueda b ON b.idWidget = reum.idMultimediaVideos AND idTipoWidget = 2
					    LEFT JOIN programas p ON p.idPrograma = b.idPrograma
					    RIGHT JOIN categorias c ON c.idCategoria = b.idCategoria
					    WHERE reum.idEje = 3556 and reum.idUbicacion = 293
					UNION
					    SELECT
					        sh.iPrioridad, sh.idSugerenciasHome as idRelEjeUbicacionNotaGenerica, sh.cURL as cURLEspecial, sh.bVentanaNueva, '' AS cUrlPrograma , 
					        sh.idSugerenciasHome as idNotaGenerica, sh.cTitulo as cTituloRecomendacion, '' as cTituloEspecial, sh.cTeaser as cTeaserRecomendacion, 'sugerencia' as cDescripcion, 
					        'sugerencia' as tipoRow, sh.cTeaser as NombrePrograma, mi.cUrl
					    FROM sugerenciasHome sh
					    LEFT JOIN multimediaImagenes mi on mi.idMultimediaImagenes = sh.idMultimediaImagenes
					    WHERE sh.idEje = 3556 and sh.idUbicacion = 293
				
					UNION
 						(SELECT -1,0,'http://www.aztecadeportes.com/galeria/view/otros-deportes/598/la-bb-del-dia',
						        0, '',0,'','','','sugerencia','sugerencia','', cUrl
  						   FROM rel_galerias_multimediaImagenes r 
								INNER JOIN multimediaImagenes i ON r.idMultimediaIMagenes = i.idMultimediaIMagenes
						  WHERE r.idGalerias = 598
      							AND r.iTipo = 1
								AND iOrden = 1 
						  LIMIT 1)
					) AS t 
					WHERE iPrioridad<=5
					ORDER BY t.iPrioridad DESC, idRelEjeUbicacionNotaGenerica DESC";
		
            $this->_setAdapter(Zend_Registry::getInstance()->dbAdapter['externo']);
            $db = $this->getAdapter();
            $stmt = $db->query($sql);
            $result = $stmt->fetchAll();
            
            foreach($result as $key => $value){
            	$result[$key]['tituloN'] = utf8_encode($value["cTituloRecomendacion20"]);
            	switch($value['tipoRow20']){
            		case 'nota':
            			$result[$key]['cUrl'] = 'http://www.aztecadeportes.com/notas/'.$value["cUrlPrograma20"].'/'.$value["idNotaGenerica20"].'/'.$utilerias->convierteUrl($value["cTituloRecomendacion20"]);
            		break;
            		case 'galeria':
            			$result[$key]['cUrl'] = 'http://www.aztecadeportes.com/galerias/'.$value["cUrlPrograma20"].'/'.$value["idNotaGenerica20"].'/'.$utilerias->convierteUrl($value["cTituloRecomendacion20"]);            			
            		break;
            		case 'videonota':
            			$result[$key]['cUrl'] = 'http://www.aztecadeportes.com/capitulos/'.$value["cUrlPrograma20"].'/'.$value["idNotaGenerica20"].'/'.$utilerias->convierteUrl($value["cTituloRecomendacion20"]);
            		break;
            		case 'sugerencia':
            			$result[$key]['cUrl'] = $value['cUrlRecomendacion20'];
            		break;
            	}
            	if($value['TEspecial20'])
            		$result[$key]['tituloN'] = utf8_encode($value['TEspecial20']);
            	}

            	
    		return $result;
	}
	
	private function trataDatos($result){
		$url = new My_Model_UtileriasCadenas();
		
		foreach	($result as $key => $value){
			$result[$key]['urlToGo'] = 'null';
			if ($value['cTipo'] == 	'Video' ){    // tipo 2 para videos
				if($value['iVentanaNueva']=="1"){
					$result[$key]['url'] = $result[$key]['seccionUrl'].'/capitulos/'.$value['cUrlPrograma'].'/'.$value['idElemento'].'/'.$url->convierteUrl( ($value['cTitulo']));
					$result[$key]['icon'] = 'icon-play-circle';
					$result[$key]['type'] = 'cap';
					$result[$key]['prefijo'] = 'cap';
				}
				else{
					$result[$key]['idElemento'] = $datosVideo['entryId'];
					$result[$key]['type'] = 'kal';
					$result[$key]['prefijo'] = 'clp';
					$result[$key]['cUrlImg'] = 'http://cdnbakmi.kaltura.com/p/459791/sp/45979100/thumbnail/entry_id/'.$datosVideo['entryId'].'/width/196/height/122/version/001';
					$result[$key]['url'] = $result[$key]['seccionUrl'].'/capitulos/'.$value['cUrlPrograma'].'/'.$value['idElemento'].'/'.$url->convierteUrl(($value['cTitulo']));
				}
				$result[$key]['urlToGo'] = $result[$key]['seccionUrl'].'/capitulos/'.$value['cUrlPrograma'].'/'.$value['idElemento'].'/'.$url->convierteUrl(($value['cTitulo']));
			}
			if ($value['cTipo'] == 'Nota'){    // tipo 3 para notas
				$result[$key]['url'] = $result[$key]['seccionUrl'].'/notas/'.$value['cUrlPrograma'].'/'.$value['idElemento'].'/'.$url->convierteUrl( ($value['cTitulo']));
				$result[$key]['icon'] = 'icon-edit';
				$result[$key]['type'] = 'not';
				$result[$key]['prefijo'] = 'not';
			}
			if ( $value['cTipo'] == "Galeria"){    // tipo 4 para galerias
				$result[$key]['url'] = $result[$key]['seccionUrl'].'/galerias/'.$value['cUrlPrograma'].'/'.$value['idElemento'].'/'.$url->convierteUrl(($value['cTitulo']));
				$result[$key]['icon'] = 'icon-picture';
				$result[$key]['type'] = 'gal';
				$result[$key]['prefijo'] = 'gal';
			}
			if ( $value['cTipo'] == "Sugerencia"){
				$result[$key]['cTeaser'] = $url->keepClean($result[$key]['cTeaser']);
				$result[$key]['url'] = $value['cUrlEspecial'];
				if(strpos($result[$key]['cTeaser'],"http://")===FALSE){
					$result[$key]['icon'] = '';
					$result[$key]['type'] = 'sug';
					$result[$key]['prefijo'] = 'sug';
				}
				else{
					$result[$key]['icon'] = '';
					$result[$key]['type'] = 'brand';
					$result[$key]['prefijo'] = 'brand';					
				}
				$sql="select cUrl, cPivotPoint from imagenes where idMultimediaImagenes = ".$value['idImagen'];
				$result2 = $this->query($sql);
				$result[$key]['cUrlImg'] = $result2[0]['cUrl'];
				$result[$key]['cPivotPoint'] = $result2[0]['cPivotPoint'];
				
			}
			
		}
		
		return $result;
	}
	
	/**
	 * Función que nos ayudará a filtrar los datos que sean necesarios para el formato Json del home
	 * @param array $datos
	 * @param integer $iTetris
	 * @author Azteca Digital [EM] 
	 * @version 1.0.0 27-09-2013 (ningun cambio)
	 */
	public function getData($datos, $iTetris, $idPrograma) {
		$arrData      = array();
		$arrItems     = array();
		$arrMainItems = array();
		//Eliminamos los datos que no se necesitan en la app de Azteca Opinion
		if($idPrograma == 10348) {
			unset($datos['sugerencia-02']);
			unset($datos['sugerencia-03']);
			unset($datos['sugerencia-04']);
			unset($datos['sugerencia-06']);
			unset($datos['sugerencia-07']);
			foreach($datos['capitulos-completos-home-programas'] as $key=>$$value) {
				array_push($datos['sugerencia-01'],$datos['capitulos-completos-home-programas'][$key]);
			}
			unset($datos['capitulos-completos-home-programas']);
		}

		//Si no es un home con estructura de tetris
		if ($iTetris == 0) {
			$indice = 0;
			$url = "";
			foreach ($datos as $k => $v) 
				foreach ($v as $k2 => $v2) 
					if ($v2['idTipoWidget'] == 2 || $v2['idTipoWidget'] == 3 || $v2['idTipoWidget'] == 4 || $v2['idTipoWidget'] == 34) {
						if ($v2['idTipoWidget'] == 2 || $v2['idTipoWidget'] == 34) {
							$sql = "SELECT idTipoVideo FROM multimediaVideos2 WHERE idMultimediaVideos = " . $v2['idNotaGenerica'];
							$tipoVideo  = $this->query($sql);
							$iTipoVideo = ($tipoVideo[0]['idTipoVideo'] == 1)?'/capitulos/':'/videos/';
						}	
						$cType = '';
						switch ($v2['idTipoWidget']) {
							case 2:  
								$cType = 'v';
								$url   = str_replace('/videos/', $iTipoVideo, $v2['url']);
								$url   = str_replace('/capitulos/', $iTipoVideo, $url);
							break;
							case 3:  $cType = 'n'; $url = $v2['url']; break;
							case 4:  $cType = 'g'; $url = $v2['url']; break;
							case 34: 
								$cType = 'v';
								$url   = str_replace('/capitulos/', $iTipoVideo, $v2['url']);
								$url   = str_replace('/videos/', $iTipoVideo, $url);
							break;
						}
						
						//Creamos el objeto a insertar en la posicion del arreglo correspondiente, si es el primero ira a mainItems del segundo en adelanta ira a items	
						if($idPrograma == 10348) {
							$item = array('cType' => $cType, 'id' => $v2['idNotaGenerica'], 'customTitle' => isset($v2['cTextoOpcional']), 'customUrl' => isset($v2['cUrlEspecial']), 
								      'title' => $v2['cTitulo'], 'url' => $url, 'cPivotPoint' => $v2['cPivotPoint'], 'image' => $v2['cUrlImagen'], 'cEntryId' => $v2['entryId']);
							if ($indice <= 3) array_push($arrMainItems, $item);
							else array_push($arrItems, $item);
						} else {
							$item = array('cType' => $cType, 'id' => $v2['idNotaGenerica'], 'customTitle' => isset($v2['cTextoOpcional']), 'customUrl' => isset($v2['cUrlEspecial']), 
										  'title' => $v2['cTitulo'], 'url' => $url, 'cPivotPoint' => $v2['cPivotPoint'], 'image' => $v2['cUrlImagen'], 'cEntryId' => $v2['entryId']);
							if ($indice == 0) array_push($arrMainItems, $item);
							else array_push($arrItems, $item);
						}
						$indice++;
					}
		//Si es un home con estructura tetris 
		} else {
			
			//Asignamos los mainItems dentro de nuestro primer arreglo
			foreach ($datos['mainItems']['items'] as $k => $v) 
				foreach ($v['content'] as $k2 => $v2) 
					if ($v2['cType'] != 's' && $v2['cType'] != 'p' && $v2['cType'] != 'm') array_push($arrMainItems,$v2);
			//Asignamos los items del body al segundo arreglo
			foreach ($datos['body'] as $k => $v) 
				foreach ($v['data'] as $k2 => $v2) 
					if ($v2['cType'] != 's' && $v2['cType'] != 'p' && $v2['cType'] != 'm') array_push($arrItems,$v2);
			
			//En caso de que los mainItems sean todas sugerencias o vengan vacios lo que hacemos es quitar un elemento del arreglo de items y asignarlo como mainItem
			if (count($arrMainItems) == 0) {
				$indice = 0;
				foreach ($datos['body'] as $k => $v) {
					foreach ($v['data'] as $k2 => $v2) {
						if ($v2['cType'] != 's' && $v2['cType'] != 'p' && $v2['cType'] != 'm') { if ($indice == 0) { array_push($arrMainItems, $v2); } $indice++; }
					}
				}
				$temp = array_shift($arrItems);
			}
			
			//Quitamos el crop de las urls de imagen
			foreach ($arrMainItems as $k => $v) {
				if ($v['cType'] == 'v') {
					$sql = "SELECT idTipoVideo FROM multimediaVideos2 WHERE idMultimediaVideos = " . $v['id'];
					$tipoVideo  = $this->query($sql);
					$iTipoVideo = ($tipoVideo[0]['idTipoVideo'] == 1)?'/capitulos/':'/videos/';
					$url   = str_replace('/capitulos/', $iTipoVideo, $v['url']);
					$url   = str_replace('/videos/', $iTipoVideo, $url);
					$arrMainItems[$k]['url'] = $url;
				}
				
				if(strpos($arrMainItems[$k]['image'],'http://static.azteca.com/crop/crop.php') === false) { 
					$arrMainItems[$k]['cPivot'] = "50,50"; 
					$arrMainItems[$k]['image'] = $arrMainItems[$k]['image']; }
				else {
					$arrMainItems[$k]['cPivot'] = substr($arrMainItems[$k]['image'], 51, 5);
					$arrMainItems[$k]['image'] = substr($arrMainItems[$k]['image'], 61); 
				}
			}
			
			foreach ($arrItems as $k => $v) {
			if ($v['cType'] == 'v') {
					$sql = "SELECT idTipoVideo FROM multimediaVideos2 WHERE idMultimediaVideos = " . $v['id'];
					$tipoVideo  = $this->query($sql);
					$iTipoVideo = ($tipoVideo[0]['idTipoVideo'] == 1)?'/capitulos/':'/videos/';
					$url   = str_replace('/capitulos/', $iTipoVideo, $v['url']);
					$url   = str_replace('/videos/', $iTipoVideo, $url);
					$arrItems[$k]['url'] = $url;
				}
				if(strpos($arrItems[$k]['image'],'http://static.azteca.com/crop/crop.php') === false) {
					$arrItems[$k]['cPivot'] = "50,50";
					$arrItems[$k]['image'] = $arrItems[$k]['image']; }
				else {
					$arrItems[$k]['cPivot'] = substr($arrItems[$k]['image'], 51, 5);
					$arrItems[$k]['image'] = substr($arrItems[$k]['image'], 61);
				}
			}
		}
		return $arrData = array( 'mainItems' => $arrMainItems, 'items' => $arrItems);
	}
	
	public function getTipoVideo($idMultimediaVideo) {
		$sql = "SELECT idTipoVideo FROM multimediaVideos2 WHERE idMultimediaVideos = " . $idMultimediaVideo;
		$tipoVideo  = $this->query($sql);
		return $iTipoVideo = ($tipoVideo[0]['idTipoVideo'] == 1)?'capitulos':'videos';
	}

	/*  
	 * Regresa la fecha del proximo home programado
	 */
	public function getProximoHome(){

		$sql = "SELECT DATE_FORMAT(dFechaPublicacion, '%d-%m-%Y %k:%i:%s') as dFechaPublicacion 
				  FROM contenidoHome
				 WHERE idEje = 3486  
				       AND idUbicacion = 359 
				       AND dFechaPublicacion  > now()
				 GROUP BY dFechaPublicacion 
				 ORDER BY dFechaPublicacion ASC
				 LIMIT 1";
		
		$result = $this->query($sql);
		return $result;		
	
	
	}

	/**
	 * Regresa las últimas 4 notas de sociales
	 * @author RMI 12-04-14
	 * @param  sociales = 10609
	 */
	public function sociales(){
		$url = new My_Model_UtileriasCadenas();
		
		$cache = Zend_Registry::getInstance()->cacheAdapter['programas'];
		$cache_clave = md5('socialesRC');
		
		if($this->tPurgar == 'purgar') $cache->remove($cache_clave);
		if(($result = $cache->load($cache_clave)) === false){
				
				$sql = "SELECT b.idBusqueda, b.idWidget as idNotaGenerica, b.idTipoWidget, 
							b.cTitulo, b.cTeaser, b.cUrlImagen as urlImagen, b.cTitulo as tituloImagen,
							p.cUrl as urlPrograma, b.dtFechaEvento
						FROM busqueda b 
							LEFT JOIN programas p ON p.idPrograma = b.idPrograma
						WHERE 
							b.idPrograma = 10609 AND idTipoWidget = 4
						ORDER BY b.idBusqueda DESC
						LIMIT 30";
				$result = $this->query($sql);
				foreach	($result as $key => $value){
					//Notas
					if($value['idTipoWidget'] == '3'){
						$result[$key]['urlPrograma'] = '/notas/social/'.$value['idNotaGenerica'].'/'.$url->convierteUrl($value['cTitulo']);
					}
					//Galerias
					if($value['idTipoWidget'] == '4'){
						$result[$key]['urlPrograma'] = '/galerias/social/'.$value['idNotaGenerica'].'/'.$url->convierteUrl($value['cTitulo']);
					}
				}
				
				

				$HoraDelete    = Zend_Registry::get('main')->delete->cache->hora;
				$MinutoDelete  = Zend_Registry::get('main')->delete->cache->minuto;
				$SegundoDelete = Zend_Registry::get('main')->delete->cache->segundos;
				$TiempoCache   =  mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) - time(); //86400
				if($TiempoCache <= 0)
					$TiempoCache = (mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) + 86400) - time(); //86400
				$cache->setLifetime($TiempoCache);
				$cache->save($result,$cache_clave);
				

				 
			return $result;
				}else{
					return $result;
				}
	}

	/**
	 * Regresa las últimas 8 notas, y que no se encuentran en sociales
	 * @author RMI 12-04-14
	 */
	public function loUltimo(){
		$url = new My_Model_UtileriasCadenas();
		
		$cache = Zend_Registry::getInstance()->cacheAdapter['programas'];
		$cache_clave = md5('loultimoRC');
		
		if($this->tPurgar == 'purgar') $cache->remove($cache_clave);
		if(($result = $cache->load($cache_clave)) === false){
		
				/*$sql = "SELECT n.idNotaGenerica, n.cTitulo, n.cTeaser, n.cContenido, n.cAutor, n.dtFechaCaptura,
						    p.cUrl AS urlPrograma,
						    m.cTitulo AS tituloImagen, m.cUrl AS urlImagen
						FROM
						    notaGenerica2 n
								LEFT JOIN rel_NotaGenerica_Programas rnp USING (idNotaGenerica)
								LEFT JOIN rel_notaGenerica_multimediaImagenes rnm ON rnm.idNotaGenerica = n.idNotaGenerica
		        				LEFT JOIN multimediaImagenes m ON m.idMultimediaImagenes = rnm.idMultimediaImagenes
						        LEFT JOIN programas p ON p.idPrograma = rnp.idPrograma
						WHERE
						    n.iStatus = 1 AND p.idSeccion = 111
						        AND p.idPrograma <> 10609
						GROUP BY n.idNotaGenerica
						ORDER BY n.dtFechaCaptura DESC
						LIMIT 8"; */

				$sql = "SELECT b.idBusqueda, b.idWidget as idNotaGenerica, b.idTipoWidget, 
							b.cTitulo, b.cTeaser, b.cUrlImagen as urlImagen, b.cTitulo as tituloImagen,
							p.cUrl as urlPrograma, b.dtFechaEvento
						FROM busqueda b 
							LEFT JOIN programas p ON p.idPrograma = b.idPrograma
						WHERE 
							b.idSeccion = 111 AND b.idTipoWidget = 3 
						ORDER BY b.dtFechaEvento DESC
						LIMIT 100";
			
			
			
				$result = $this->query($sql);
				
				
				
				foreach	($result as $key => $value){
					$result[$key]['urlPrograma'] = '/notas/'.$value['urlPrograma'].'/'.$value['idNotaGenerica'].'/'.$url->convierteUrl($value['cTitulo']);
				}
				
				
				$HoraDelete    = Zend_Registry::get('main')->delete->cache->hora;
				$MinutoDelete  = Zend_Registry::get('main')->delete->cache->minuto;
				$SegundoDelete = Zend_Registry::get('main')->delete->cache->segundos;
				$TiempoCache   =  mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) - time(); //86400
				if($TiempoCache <= 0)
					$TiempoCache = (mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) + 86400) - time(); //86400
				$cache->setLifetime($TiempoCache);
				$cache->save($result,$cache_clave);

					
			return $result;
			}else{
					return $result;
				}
	}
	
 public function blogs( $autor = 0 ){ 	
 	$url = new My_Model_UtileriasCadenas();
 	
 	if($autor > 0)
 	$where .= ' AND n.idCatAutor ='. $autor .' ';	
 	
 	
 	$cache = Zend_Registry::getInstance()->cacheAdapter['programas'];
 	$cache_clave = md5('homeBlogsRC'.$autor);
 	
 	if($this->tPurgar == 'purgar') $cache->remove($cache_clave);
 	if(($result = $cache->load($cache_clave)) === false){
 	
		 	$sql = 'SELECT n.idCatAutor, n.idCatBlogs, n.cTitulo, n.cContenido, n.dtFechaCaptura, n.iStatus,  a.cNombre, a.cTeaser, a.cNumEmpleado,   m.cTitulo AS tituloImagen,
		 			 m.cUrl AS urlImagen, a.cAcercaBlog 
					FROM (SELECT idCatAutor, idCatBlogs, cTitulo, cContenido, dtFechaCaptura, iStatus FROM catBlogs ORDER BY dtFechaCaptura DESC) n
					left JOIN catAutores a ON a.idCatAutor = n.idCatAutor
					LEFT JOIN multimediaImagenes m ON m.idMultimediaImagenes = a.idMultimediaImagen
					 WHERE n.iStatus = 1 '. $where .'
					 GROUP BY idCatAutor
					ORDER BY dtFechaCaptura DESC limit 4';
		 	
		 	$result = $this->query($sql);
		 	foreach	($result as $key => $value){
		 		$result[$key]['urlBlog'] = '/blog/historico/'.$value['idCatBlogs'].'/'.$url->convierteUrl($value['cTitulo']);
		 	}
		$TiempoCache = 3600;
		$cache->setLifetime($TiempoCache);
		$cache->save($result,$cache_clave);
		
		
		
		$HoraDelete    = Zend_Registry::get('main')->delete->cache->hora;
		$MinutoDelete  = Zend_Registry::get('main')->delete->cache->minuto;
		$SegundoDelete = Zend_Registry::get('main')->delete->cache->segundos;
		$TiempoCache   =  mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) - time(); //86400
		if($TiempoCache <= 0)
			$TiempoCache = (mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) + 86400) - time(); //86400
		$cache->setLifetime($TiempoCache);
		$cache->save($result,$cache_clave);
		
		
		 		
		return $result;
		}else{
		 	return $result;
	}
 }
 

 
 public function imgAutor( $autor = 0 ){
 
 	$url = new My_Model_UtileriasCadenas();
 
 	$cache = Zend_Registry::getInstance()->cacheAdapter['programas'];
 	$cache_clave = md5('imgAutorRC'.$autor);
 	
 	if($this->tPurgar == 'purgar') $cache->remove($cache_clave);
 	if(($result = $cache->load($cache_clave)) === false){
 		
 	if($autor > 0)
 		$where .= $autor;
 		//$where .= ' idMultimediaImagenes ='. $autor .' limit 1'; 
 	
 	$sql = 'SELECT i.cUrl as imagenAutor
FROM imagenes i 
LEFT JOIN catAutores ca ON i.idMultimediaImagenes = ca.idMultimediaImagen
WHERE idCatAutor  = '. $where ;
 	$result = $this->query($sql);
 	
 	
 	
 	$HoraDelete    = Zend_Registry::get('main')->delete->cache->hora;
 	$MinutoDelete  = Zend_Registry::get('main')->delete->cache->minuto;
 	$SegundoDelete = Zend_Registry::get('main')->delete->cache->segundos;
 	$TiempoCache   =  mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) - time(); //86400
 	if($TiempoCache <= 0)
 		$TiempoCache = (mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) + 86400) - time(); //86400
 	$cache->setLifetime($TiempoCache);
 	$cache->save($result,$cache_clave);
 	
 
		 		
		return $result;
		}else{
		 	return $result;
	}
 
 }
 
 /*
 public function acercaBlog( $autor = 0 ){
 	$url = new My_Model_UtileriasCadenas();  
 	$sql = 'Select cAcercaBlog  from catAutores WHERE idCatAutor = '. $autor ;
 	 	$result = $this->query($sql);
 	return $result;
 }
*/	
}