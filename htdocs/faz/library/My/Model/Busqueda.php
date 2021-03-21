<?php
/**
 * Archivo de definición de model de busqueda
 * @package aztecaespectaculos.My.Model.Busqueda
 * @author  Azteca Digital [JT]
 * @version 1.0.0
 */

/**
 * Definición de model de busqueda
 * @package aztecaespectaculos.My.Model.Busqueda
 * @author  Azteca Digital [JT]
 * @version 1.0.0
 */
class My_Model_Busqueda extends My_Db_TableAzteca{

	protected $_primary = 'idBusqueda';
	protected $_name    = 'busqueda';

	public $_idEjeHome;
	public $_idUbicacion;


	/**
	 * 
	 * 
	 * @param unknown $tipoPrograma
	 * @param unknown $datos
	 * @param unknown $textobusqueda
	 * @param unknown $pagina
	 * @param unknown $cat
	 * @param string $tPurgar
	 * @throws Exception
	 * @return Ambigous <string, Ambigous, multitype:, stdClass, multitype:array >
	 */
	public function busqueda($tipoPrograma,$datos,$textobusqueda,$pagina, $cat, $tPurgar=false){

		$info  = array();
		$url   = new My_Model_UtileriasCadenas();
		$utilities = new My_Model_Utilities_tortugaUtilities();

		$cache = Zend_Registry::getInstance()->cacheAdapter['programas'];
		/**** Obtenemos la version del cache ****/
		$nombreCacheGenerico = md5('buqueda-'.$tipoPrograma.$textobusqueda.$pagina.$cat);//idPrograma idWidget idGaleria
		$versionCache = $utilities->vesionCache($nombreCacheGenerico,$tPurgar);

		// Nombre del generico de cache para purga automatica.
		$cache_clave = md5('busquedaRevistaCentral-'.$tipoPrograma.$textobusqueda.$pagina).$versionCache;
		$info = $cache->load($cache_clave);

		if(false == $info){
			try{
				$cont = 0;
				$cadena = '';
				$wherePrograma = '';
				if ($pagina == '' || $pagina == 0)
					$pagina = 1;

				if ($pagina < 1 )
					$this->_redirect('/'.$tipoPrograma.'/'.$textobusqueda);

				$info["paginaActual"]  = $pagina;
				$info["textoBusqueda"] = $textobusqueda;

				if ($datos != false ) {
					/**** Variables de paginacion ****/
					$vistaPagina = 13;

					/** Sacamos el total de resultados **/
					$notasPaginaActual = ($pagina - 1) * $vistaPagina ;
					/**** Buscamos en la base de datos las notas y videos relacionados con la palabra ****/
					if ($tipoPrograma == 'busqueda'){
						$result = $this->obtenerBusquedaXPagina($textobusqueda,$notasPaginaActual,$vistaPagina);
						$totalNotas = $this->obtenerBusquedaXPaginaTotal($textobusqueda);
						$totalNotas = count(@$totalNotas);
					}else{
						$idPrograma = $this->obteneIdPrograma($tipoPrograma);
						if ($textobusqueda == 'notas'){
							$tipoWidget = 3;
						}elseif ($textobusqueda == 'galerias'){
							$tipoWidget = 4;
						}elseif ($textobusqueda == 'capitulos'){
							$tipoWidget = 2;
						}elseif ($textobusqueda == 'videos'){
							$tipoWidget = 2;
						}else{
							$this->_redirect('/');
						}
						$result = $this->obtenerNotasGaleriasXPrograma($idPrograma[0]['idPrograma'],$tipoWidget,$notasPaginaActual,$vistaPagina,$cat);
						$totalNotas = $this->obtenerNotasGaleriasXProgramaTotal($idPrograma[0]['idPrograma'],$tipoWidget,$cat);
						$totalNotas = count(@$totalNotas);
					}

					if(is_array($result)){
						foreach($result as $key => $value){
							if ($value['idTipoWidget'] == 2 ){    // tipo 2 para videos
								$result[$key]['Busqueda_liga'] = '/capitulos/'.$value['cUrlPrograma'].'/'.$value['idWidget'].'/'.$url->convierteUrl( ($value['cTitulo']));
							}
							if ($value['idTipoWidget'] == 3){    // tipo 3 para notas
								$result[$key]['Busqueda_liga'] = '/notas/'.$value['cUrlPrograma'].'/'.$value['idWidget'].'/'.$url->convierteUrl( ($value['cTitulo']));
							}
							if ( $value['idTipoWidget'] == 4){    // tipo 4 para galerias
								$result[$key]['Busqueda_liga'] = '/galerias/'.$value['cUrlPrograma'].'/'.$value['idWidget'].'/'.$url->convierteUrl(($value['cTitulo']));
							}
							if ($value['cUrlImagen'] == "" || $value['cUrlImagen'] == null)
								$result[$key]['cUrlImagen'] = 'http://static.azteca.com/imagenes/2012/22/1561332.jpg';

						}
					}

					$totalPaginas = ceil($totalNotas/$vistaPagina);
					if ($totalPaginas == 0)
						$totalPaginas = 1;

					if ($totalPaginas < $pagina)
						$this->_redirect('/busqueda/'.$textobusqueda.'/'.$totalPaginas);

					$limiteInferior = $pagina - 3;
					$limiteSuperior = $pagina + 5;
					 
					//si el limite inferior en menos o igual a 1 no se mostraran las flechas <<
					if ($limiteInferior <= 1 ){
						$limiteInferior = 1;
						$limiteSuperior = 9;
					}
					//si el limite superior en mayor o igual al total de paginas no se mostraran las flechas >>
					if ($limiteSuperior >= $totalPaginas){
						$limiteSuperior=$totalPaginas;
						$limiteInferior = $totalPaginas - 9;
						if ($limiteInferior <= 1 )
							$limiteInferior = 1;
					}
					$info["limiteSuperior"] = $limiteSuperior;
					$info["limiteInferior"] = $limiteInferior;
					$info["totalPaginas"]   = $totalPaginas;
					$info["tipoPrograma"]   = $tipoPrograma;

				}
				$info["result"] = $result;

				$HoraDelete    = Zend_Registry::get('main')->delete->cache->hora;
				$MinutoDelete  = Zend_Registry::get('main')->delete->cache->minuto;
				$SegundoDelete = Zend_Registry::get('main')->delete->cache->segundos;
				$TiempoCache   =  mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) - time(); //86400
				if($TiempoCache <= 0)
					$TiempoCache = (mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) + 86400) - time(); //86400
				$cache->setLifetime($TiempoCache);
				$cache->save($info,$cache_clave);
			}catch (Exception $e) {
				 
				if ($this->tPurgar) $msg = 'No es posible purgar, se mantienen los datos desde cache, busqueda.' .$e;
				else throw new Exception('No fue posible obtener información de la base de datos, busqueda.', 666);
			}
		}

		return $info;
	}
	
	/**
	 * 
	 * @param unknown $textobusqueda
	 * @return Ambigous <multitype:, stdClass, multitype:array >
	 */
	public function obtenerOpcionesComboBusqueda($textobusqueda){

		$query = "SELECT  count('dtFechaEvento') as cuantos, SUBSTRING_INDEX(dtFechaEvento, '-', 2) as aniomes
				    FROM busqueda b
				   WHERE (b.cTitulo like '%$textobusqueda%' 
				         OR b.cTeaser like '%$textobusqueda%' 
				         OR b.cKeywords like '%$textobusqueda%' 
				         OR b.cReporteros like '%$textobusqueda%') 
				         AND b.idSeccion=21
				   GROUP BY aniomes
				   ORDER BY dtFechaEvento desc";
		$stmt = $this->query($query);
		return $stmt;
	}

	/**
	 * 
	 * @param unknown $textobusqueda
	 * @param unknown $notasPaginaActual
	 * @param unknown $vistaPagina
	 * @return Ambigous <multitype:, stdClass, multitype:array >
	 */
	public function obtenerBusquedaXPagina($textobusqueda,$notasPaginaActual,$vistaPagina){

		$query = "SELECT b.idWidget, b.idTipoWidget, b.idSeccion, b.idPrograma, 
						 b.cTitulo, b.cTeaser, b.cUrlImagen, b.dtFechaEvento, cReporteros, 
						 pro.cUrl as cUrlPrograma, pro.cNombre as cNombrePrograma, mv.cUrlWebVideo
					FROM busqueda b
						 LEFT JOIN programas pro on b.idPrograma = pro.idPrograma
						 LEFT JOIN multimediaVideos mv on b.idWidget = mv.idMultimediaVideos
				   WHERE (b.cTitulo like '%$textobusqueda%' OR b.cTeaser like '%$textobusqueda%' OR b.cKeywords like '%$textobusqueda%' OR b.cReporteros like '%$textobusqueda%') and b.idSeccion=111
				   ORDER BY b.dtFechaEvento desc
				   LIMIT ".$notasPaginaActual.",".$vistaPagina.";";
		$stmt = $this->query($query);
		return $stmt;
	}

	/**
	 * 
	 * @param unknown $textobusqueda
	 * @return Ambigous <multitype:, stdClass, multitype:array >
	 */
	public function obtenerBusquedaXPaginaTotal($textobusqueda){

		$query = "SELECT pro.cNombre as cNombrePrograma, mv.cUrlWebVideo
				    FROM busqueda b
						 LEFT JOIN programas pro on b.idPrograma = pro.idPrograma
						 LEFT JOIN multimediaVideos mv on b.idWidget = mv.idMultimediaVideos
				   WHERE (b.cTitulo like '%$textobusqueda%' OR b.cTeaser like '%$textobusqueda%' OR b.cKeywords like '%$textobusqueda%' OR b.cReporteros like '%$textobusqueda%') and b.idSeccion= 111

				   ORDER BY b.dtFechaEvento desc";
		$stmt = $this->query($query);
		return $stmt;
	}

	/**
	 * 
	 * @param unknown $idPrograma
	 * @param unknown $tipoWidget
	 * @param unknown $notasPaginaActual
	 * @param unknown $vistaPagina
	 * @param unknown $cat
	 * @return Ambigous <multitype:, stdClass, multitype:array >
	 */
	public function obtenerNotasGaleriasXPrograma($idPrograma, $tipoWidget ,$notasPaginaActual,$vistaPagina, $cat){

		if($cat != 0) $cat =  ' AND b.idCategoria = ' . $cat;
		else $cat = '';
		 
		$query = "SELECT b.idWidget, b.idTipoWidget, b.idSeccion, b.idPrograma, 
                         b.cTitulo, b.cTeaser, 
                         CASE b.idTipoWidget WHEN 2 THEN 
                         (SELECT cUrl 
                            FROM rel_MultimediaImagenes_MultimediaVideos x 
                                 INNER JOIN multimediaImagenes y ON x.idMultimediaImagenes = y.idMultimediaImagenes
                           WHERE x.idMultimediaVideos = b.idWidget ORDER BY iSize DESC LIMIT 1)
                         ELSE b.cUrlImagen END as cUrlImagen,
                         b.dtFechaEvento, 
                         cReporteros, pro.cUrl as cUrlPrograma, pro.cNombre as cNombrePrograma 
                    FROM busqueda b 
                         LEFT JOIN programas pro on b.idPrograma = pro.idPrograma 
                   WHERE b.idPrograma = $idPrograma
                         AND b.idTipoWidget = $tipoWidget $cat
				   ORDER BY b.dtFechaEvento desc
				   LIMIT ".$notasPaginaActual.",".$vistaPagina.";";

     	$stmt = $this->query($query);
		return $stmt;
	}

	/**
	 * 
	 * 
	 * @param unknown $idPrograma
	 * @param unknown $tipoWidget
	 * @param unknown $cat
	 * @return Ambigous <multitype:, stdClass, multitype:array >
	 */
	public function obtenerNotasGaleriasXProgramaTotal($idPrograma, $tipoWidget, $cat){

		if($cat != 0) $cat =  ' AND b.idCategoria = ' . $cat;
		else $cat = '';
		 
		$query = "SELECT b.idWidget, b.idTipoWidget, b.idSeccion, b.idPrograma, b.cTitulo, b.cTeaser,
						 b.cUrlImagen, b.dtFechaEvento, cReporteros, pro.cUrl as cUrlPrograma,
						 pro.cNombre as cNombrePrograma
				    FROM busqueda b
						 LEFT JOIN programas pro on b.idPrograma = pro.idPrograma
				   WHERE b.idPrograma = $idPrograma
						 AND b.idTipoWidget = $tipoWidget  $cat
				   ORDER BY b.dtFechaEvento desc";
		$stmt = $this->query($query);
		return $stmt;
	}

	/**
	 * Obtener el id del programa
	 * 
	 * @param unknown $programa
	 * @return Ambigous <multitype:, stdClass, multitype:array >
	 */
	public function obteneIdPrograma($programa){

		$query = "SELECT idPrograma
					FROM programas
				   WHERE cUrl = '$programa'";
		$stmt = $this->query($query);
		return $stmt;
	}
	
	/**
	 * Busqueda General 
	 * 
	 * @param number $elementos
	 * @param number $pagina
	 * @param string $tipos
	 * @param string $keywords
	 * @param string $excepciones
	 * @param number $ordenar
	 * @param string $programas
	 * @param string $acompletarElementos
	 * @param string $categorias
	 * @param string $texto
	 * @param number $tPurgar
	 * @param string $metodo Nombre del metodo o ubicaciondonde se manda a llamar
	 * @return Ambigous <multitype:, number>
	 */
	public function busquedaGral($elementos=9, $pagina=1, $tipos="", $keywords="", $excepciones="", $ordenar=2,
			                     $programas="", $acompletarElementos = true, $categorias="", $texto="", $tPurgar = 1,$metodo='',$tiempo=0){
		
		$texto = html_entity_decode($texto);
		if ($texto!=""){
			$busqueda= 13;
		}elseif ($texto == "BUSCAR"){
			$texto = "";
		}
		
		$url       = new My_Model_UtileriasCadenas();
		$utilities = new My_Model_Utilities_tortugaUtilities();
		$cache     = Zend_Registry::getInstance()->cacheAdapter['programas'];
		$tiposAux = array();
		foreach($tipos as $k => $v){
			switch($v){
				case "n":
				case "notas":
					$tiposAux[] = 3;
					break;
				case "v":
				case "videos":
				case "capitulos":
				case "clips":
				case "c":
					$tiposAux[] = 2;
					break;
				case "g":
				case "galerias":
					$tiposAux[] = 4;
					break;
				case "p":
				case "perfiles":
					$tiposAux[] = 17;
					break;
				default:
					$tiposAux[] = $v;
			}
		}
		$tipos = $tiposAux;
		
		/**** Obtenemos la version del cache ****/
		$nombreCacheGenerico = md5('busquedaRevistaCentral-'.$elementos.@implode(",",$tipos).@implode(",",$keywords).@implode(",",$excepciones).$ordenar.@implode(",",$programas).@implode(",",$categorias).$texto);
		$versionCache = $utilities->vesionCache($nombreCacheGenerico,$tPurgar);
		$nombreCacheGenerico = $pagina.$nombreCacheGenerico;

		// Nombre del generico de cache para purga automatica.
		$cache_clave = $versionCache . md5($nombreCacheGenerico);
		$result = $cache->load($cache_clave);
		
		if($result == false){		
		//Seleccionamos los tipos
		if($tipos){
			foreach($tipos as $k => $v){
				switch($v){
					case 3:
						$whereTipos[]="idTipoWidget=3";
					break;
					case 2:
						$whereTipos[]="idTipoWidget=2";
					break;
					case 4:
						$whereTipos[]="idTipoWidget=4";
					break; 
					case 17:
						$whereTipos[]="idTipoWidget=17";
						break;
				}
			}
		}
		if(@$whereTipos){
			$where[] = implode(" OR ", $whereTipos);
		}else{
			$where[] = "idTipoWidget!=17";
		}
			//Selecciono los keywords
		    if(is_array($keywords)){
		        $i= 0;
		        foreach($keywords as $k => $v){
		            if($v!="")
		                $keysArray[] = $v;
		            if($i > 1) break;
		            $i++;
		        }
		    }

		    if(@$keysArray){
		        $sql = "SELECT cKeywords 
		                       FROM catKeywords 
		                    WHERE idCatKeywords IN (".implode(",", $keysArray).") LIMIT 3";
		        $result = $this->query($sql);
		        foreach($result as $k => $v){
		            $keys[] = "MATCH (b.cTitulo,b.cTeaser,b.cKeywords) AGAINST ('{$v['cKeywords']}')";
		        }
		        $where[] = implode(" OR ", $keys);
		    }
			
			//Quitamos las excepciones
			if($excepciones){
				$where[] = "idWidget not in (".implode(",", $excepciones).")";
			}
			
			//Selecciono los programas
			if($programas){
				$progs = implode(",", $programas);
				$where[] = "b.idPrograma in (".$progs.")";
			}
			
			//Selecciono las categorias
			if($categorias){
				$cats = implode("','", $categorias);
				$where[] = "b.cCategorias in ('".$cats."')";
			}
			
			//Selecciono el texto de busqueda
			if($texto!=""){
				$where[] = "MATCH (b.cTitulo,b.cTeaser,b.cKeywords) AGAINST ('$texto')";
			}
			// Selecciono las ultimas notas relacionadas de la ultima semana
			if($metodo == 'datosNota'){	
					//$where[] = "DATE(dtFechaEvento) BETWEEN DATE_SUB(NOW(),INTERVAL 7 DAY)";
					$where[] = "DATE_SUB(CURDATE(),INTERVAL 14 DAY) <= NOW()";
				}	
			
			// valores para LIMIT
			if ($pagina == 0) $inicio = 0;
			else $inicio = (($pagina-1)*($desc==0 ? $busqueda == 13 ? $busqueda : 10 : $elementos-20))+$desc;
			
			$where[]="b.idSeccion in (111)";
			
			//Limito la busqueda a elementos que tengan fecha de busqueda mayor a hoy
			$where[]="b.dtFechaEvento  <= NOW()";
			
			if($where)
				$wheretxt = " WHERE (".implode(") AND (", $where).")";
				
			
			
			
			switch($ordenar){
				case 0:
					$order = "ORDER BY idBusqueda DESC";
				break;
				case 1:
					$order = "ORDER BY RAND()";
				break;
				case 2:
					$order = "ORDER BY dtFechaEvento DESC";
				break;
				case 3:
					$order = "ORDER BY  dtFechaEvento DESC, MATCH (b.cTitulo,b.cTeaser,b.cKeywords) AGAINST ('$texto') DESC";
				break;
			}
						
			$sql = "SELECT idBusqueda, idTipoWidget, idWidget, cTitulo, b.cTeaser, 
						   IFNULL (cUrlImagen, 'http://static.tvazteca.com/images/Default.png') AS cUrlImagen, 
			               cKeywords, p.cUrl as cUrlPrograma, p.cNombre as cNombrePrograma, dtFechaEvento 
					  FROM busqueda b
					       LEFT JOIN programas p on b.idPrograma = p.idPrograma
					  $wheretxt AND cUrlImagen NOT LIKE 'rtmpe://%' AND cUrlImagen IS NOT NULL
					  $order
					 LIMIT $inicio,$elementos";

			$result = $this->queryTotal($sql);
			$total  = $this->getTotal();
			
			foreach	($result as $key => $value){
				$result[$key]['cTitulo'] = utf8_encode($result[$key]['cTitulo']);
				$result[$key]['title']   = $result[$key]['cTitulo'];
				$result[$key]['image']   = $result[$key]['cUrlImagen'];
				
				$result[$key]['cTeaser'] = utf8_encode($result[$key]['cTeaser']);
				$result[$key]['total'] = $total;
				if ($value['idTipoWidget'] == 2 ){    // tipo 2 para videos
					$sql = "SELECT idTipoVideo FROM multimediaVideos2 WHERE idMultimediaVideos = " . $value['idWidget'];
					$tipoVideo  = $this->query($sql);
					$iTipoVideo = ($tipoVideo[0]['idTipoVideo'] == 1)?'capitulos':'videos';
					
					$result[$key]['letraWidget'] = "v";
					$result[$key]['url'] = "/{$iTipoVideo}/".$value['cUrlPrograma'].'/'.$value['idWidget'].'/'.$url->convierteUrl(utf8_encode($value['cTitulo']));
					$result[$key]['icon'] = 'icon-play-circle';
				}
				if ($value['idTipoWidget'] == 3){    // tipo 3 para notas
					$result[$key]['letraWidget'] = "n";
					$result[$key]['url'] = '/notas/'.$value['cUrlPrograma'].'/'.$value['idWidget'].'/'.$url->convierteUrl(utf8_encode($value['cTitulo']));
					$result[$key]['icon'] = 'icon-edit';
				}
				if ( $value['idTipoWidget'] == 4){    // tipo 4 para galerias
					$result[$key]['letraWidget'] = "g";
					$result[$key]['url'] = '/galerias/'.$value['cUrlPrograma'].'/'.$value['idWidget'].'/'.$url->convierteUrl(utf8_encode($value['cTitulo']));
					$result[$key]['icon'] = 'icon-picture';
				}
				if ( $value['idTipoWidget'] == 17){    // tipo 4 para galerias
					$urlaux = explode(',', $result[$key]['cKeywords']);
					$result[$key]['letraWidget'] = "p";
					$result[$key]['url'] = $urlaux[2];
					$result[$key]['icon'] = 'icon-picture';
				}
			}
			
			$actuales = count($result);
			//ya estaba comentado
			/*if($actuales < $elementos && $acompletarElementos){
				if(is_array($excepciones))
					$ids = $excepciones;
				foreach ($result as $k => $v)
					$ids[] = $v['idWidget']; print_r($tipos);
				//die("<br>elementos ".$elementos." actuales: ".$actuales." ordenar: ".$ordenar);
				$complemento = $this->busquedaGral($elementos-$actuales,1,$tipos,"",$ids,$ordenar);
				$result = array_merge($result,$complemento);
			}*/

			$HoraDelete    = Zend_Registry::get('main')->delete->cache->hora;
			$MinutoDelete  = Zend_Registry::get('main')->delete->cache->minuto;
			$SegundoDelete = Zend_Registry::get('main')->delete->cache->segundos;
			$TiempoCache   =  $tiempo >0 ? $tiempo : mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) - time(); //86400
			
			if($TiempoCache <= 0)
				$TiempoCache = (mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) + 86400) - time(); //86400
			$cache->setLifetime($TiempoCache);
			$cache->save($result,$cache_clave);
		}
			
		return $result;
	}	
	
	
	/**
	 * Busqueda General agregamos busqueda jerarquica 
	 *
	 * @param number $elementos
	 * @param number $pagina
	 * @param string $tipos
	 * @param string $keywords
	 * @param string $excepciones
	 * @param number $ordenar
	 * @param string $programas
	 * @param string $acompletarElementos
	 * @param string $categorias
	 * @param string $texto
	 * @param string $textoPrincipal
	 * @param number $tPurgar
	 * @return Ambigous <multitype:, number>
	 */
	public function busquedaGralJerarquica($elementos=9, $pagina=1, $tipos="", $keywords="", $excepciones="", $ordenar=1,
			$programas="", $acompletarElementos = true, $categorias="", $texto="", $textoPrincipal="",$tPurgar = 1){
			
		$texto = html_entity_decode($texto);
		if($texto == "BUSCAR")
			$texto = "";
		
		$url       = new My_Model_UtileriasCadenas();
		$utilities = new My_Model_Utilities_tortugaUtilities();
		$cache     = Zend_Registry::getInstance()->cacheAdapter['programas'];
		$tiposAux = array();
		foreach($tipos as $k => $v){
			switch($v){
				case "n":
				case "notas":
					$tiposAux[] = 3;
					break;
				case "v":
				case "videos":
				case "capitulos":
				case "clips":
				case "c":
					$tiposAux[] = 2;
					break;
				case "g":
				case "galerias":
					$tiposAux[] = 4;
					break;
				case "p":
				case "perfiles":
					$tiposAux[] = 17;
					break;
				default:
					$tiposAux[] = $v;
			}
		}
		$tipos = $tiposAux;
		
		/**** Obtenemos la version del cache ****/
		$nombreCacheGenerico = md5('busquedaRevistaCentral-'.$elementos.@implode(",",$tipos).@implode(",",$keywords).@implode(",",$excepciones).$ordenar.@implode(",",$programas).@implode(",",$categorias).$texto);
		$versionCache = $utilities->vesionCache($nombreCacheGenerico,$tPurgar);
		$nombreCacheGenerico = $pagina.$nombreCacheGenerico;
		
		// Nombre del generico de cache para purga automatica.
		$cache_clave = $versionCache . md5($nombreCacheGenerico);
		$result = $cache->load($cache_clave);
		
		if($result == false){
			//Seleccionamos los tipos
			if($tipos){
				foreach($tipos as $k => $v){
					switch($v){
						case 3:
							$whereTipos[]="idTipoWidget=3";
							break;
						case 2:
							$whereTipos[]="idTipoWidget=2";
							break;
						case 4:
							$whereTipos[]="idTipoWidget=4";
							break;
						case 17:
							$whereTipos[]="idTipoWidget=17";
							break;
					}
				}
			}
			if(@$whereTipos){
				$where[] = implode(" OR ", $whereTipos);
			}else{
				$where[] = "idTipoWidget!=17";
			}
			//Selecciono los keywords
			if(is_array($keywords)){
				foreach($keywords as $k => $v){
					if($v!="")
						$keysArray[] = $v;
				}
			}
			if(@$keysArray){
				$sql = "select cKeywords from catKeywords where idCatKeywords in (".implode(",", $keysArray).")";
				$result = $this->query($sql);
				foreach($result as $k => $v)
					$keys[] = $v['cKeywords'];
		
				$where[] = "cKeywords like '%" .implode("%' OR cKeywords like '%",$keys). "%'";
			}
				
			//Quitamos las excepciones
			if($excepciones){
				$where[] = "idWidget not in (".implode(",", $excepciones).")";
			}
				
			//Selecciono los programas
			if($programas){
				$progs = implode(",", $programas);
				$where[] = "b.idPrograma in (".$progs.")";
			}
				
			//Selecciono las categorias
			if($categorias){
				$cats = implode(",", $categorias);
				$where[] = "b.cCategorias in (".$cats.")";
			}
			
			if($textoPrincipal != ""){
				if($texto!=""){
					$where[] = "MATCH (b.cTitulo,b.cTeaser,b.cKeywords) AGAINST ('$texto')";
					
					$where[] = "b.cKeywords like '%$textoPrincipal%'";
				}
			} else {
				if($texto!=""){
					$where[] = "MATCH (b.cTitulo,b.cTeaser,b.cKeywords) AGAINST ('$texto')";
				}
			}
			
			//Selecciono el texto de busqueda
			
				
			if ($pagina == 0) $inicio = 0;
			else $inicio = (($pagina-1)*$elementos);
				
			$where[]="b.idSeccion in (111)";
				
			if($where)
				$wheretxt = " WHERE (".implode(") AND (", $where).")";
		
			switch($ordenar){
				case 0:
					$order = "ORDER BY idBusqueda DESC";
					break;
				case 1:
					$order = "ORDER BY RAND()";
					break;
				case 2:
					$order = "ORDER BY dtFechaEvento DESC";
					break;
				case 3:
					$order = "ORDER BY MATCH (b.cTitulo,b.cTeaser,b.cKeywords) AGAINST ('$texto') DESC";
					break;
			}
		
			$sql = "SELECT idBusqueda, idTipoWidget, idWidget, cTitulo, b.cTeaser, cUrlImagen,
			cKeywords, p.cUrl as cUrlPrograma, p.cNombre as cNombrePrograma, dtFechaEvento
			FROM busqueda b
			LEFT JOIN programas p on b.idPrograma = p.idPrograma
			$wheretxt AND cUrlImagen NOT LIKE 'rtmpe://%' AND cUrlImagen IS NOT NULL
			$order
			LIMIT $inicio,$elementos";
			$result = $this->queryTotal($sql);
			$total  = $this->getTotal();
				
			foreach	($result as $key => $value){
			$result[$key]['cTitulo'] = utf8_encode($result[$key]['cTitulo']);
			$result[$key]['cTeaser'] = utf8_encode($result[$key]['cTeaser']);
			$result[$key]['total'] = $total;
			if ($value['idTipoWidget'] == 2 ){    // tipo 2 para videos
			$result[$key]['letraWidget'] = "v";
			$result[$key]['url'] = '/capitulos/'.$value['cUrlPrograma'].'/'.$value['idWidget'].'/'.$url->convierteUrl(utf8_encode($value['cTitulo']));
			$result[$key]['icon'] = 'icon-play-circle';
			}
			if ($value['idTipoWidget'] == 3){    // tipo 3 para notas
			$result[$key]['letraWidget'] = "n";
			$result[$key]['url'] = '/notas/'.$value['cUrlPrograma'].'/'.$value['idWidget'].'/'.$url->convierteUrl(utf8_encode($value['cTitulo']));
			$result[$key]['icon'] = 'icon-edit';
			}
			if ( $value['idTipoWidget'] == 4){    // tipo 4 para galerias
			$result[$key]['letraWidget'] = "g";
			$result[$key]['url'] = '/galerias/'.$value['cUrlPrograma'].'/'.$value['idWidget'].'/'.$url->convierteUrl(utf8_encode($value['cTitulo']));
			$result[$key]['icon'] = 'icon-picture';
			}
			if ( $value['idTipoWidget'] == 17){    // tipo 4 para galerias
			$urlaux = explode(',', $result[$key]['cKeywords']);
			$result[$key]['letraWidget'] = "p";
			$result[$key]['url'] = $urlaux[2];
				$result[$key]['icon'] = 'icon-picture';
			}
			}
				
			$actuales = count($result);
			if($actuales < $elementos && $acompletarElementos){
			if(is_array($excepciones))
					$ids = $excepciones;
			foreach ($result as $k => $v)
				$ids[] = $v['idWidget'];
					
				$complemento = $this->busquedaGral($elementos-$actuales,1,$tipos,"",$ids,$ordenar);
				$result = array_merge($result,$complemento);
			}
		
			$HoraDelete    = Zend_Registry::get('main')->delete->cache->hora;
			$MinutoDelete  = Zend_Registry::get('main')->delete->cache->minuto;
			$SegundoDelete = Zend_Registry::get('main')->delete->cache->segundos;
			$TiempoCache   =  mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) - time(); //86400
			if($TiempoCache <= 0)
					$TiempoCache = (mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) + 86400) - time(); //86400
					$cache->setLifetime($TiempoCache);
					$cache->save($result,$cache_clave);
		}
			
		return $result;
	}
	
	/**
	 * Busqueda por paticipante
	 *
	 * @param number $idPrograma
	 * @param string $cParticipantes
	 * @return Array>
	 */
	public function busquedaParticipante(){
		$url   = new My_Model_UtileriasCadenas();
		$sql = "SELECT b.*, (SELECT cUrl FROM programas p where idPrograma = ".$this->_idProg." limit 1) as cUrlPrograma FROM busqueda b where idPrograma = ".$this->_idProg." and cParticipantes like concat('%',(SELECT cNombre FROM participantesTmp p where idParticipanteTmp = ".$this->_idEjeHome." limit 1),'%') ORDER BY idBusqueda DESC;";
		$stmt = $this->query($sql);
		foreach($stmt as $key => $value) {
				if ($value['idTipoWidget'] == 2 ){    // tipo 2 para capitulos
					$stmt[$key]['url'] = '/capitulos/'.$value['cUrlPrograma'].'/'.$value['idWidget'].'/'.$url->convierteUrl(utf8_encode($value['cTitulo']));
				}
				if ($value['idTipoWidget'] == 3){    // tipo 3 para notas
					$stmt[$key]['url'] = '/notas/'.$value['cUrlPrograma'].'/'.$value['idWidget'].'/'.$url->convierteUrl(utf8_encode($value['cTitulo']));
				}
				if ( $value['idTipoWidget'] == 4){    // tipo 4 para galerias
					$stmt[$key]['url'] = '/galerias/'.$value['cUrlPrograma'].'/'.$value['idWidget'].'/'.$url->convierteUrl(utf8_encode($value['cTitulo']));
				}
				if ( $value['idTipoWidget'] == 34){    // tipo 34 para videos
					$stmt[$key]['url'] = '/galerias/'.$value['cUrlPrograma'].'/'.$value['idWidget'].'/'.$url->convierteUrl(utf8_encode($value['cTitulo']));
				}
		}
		return $stmt;
	}
	/**
	 * Para generar los resultados para apps/feed
	 * [EPG] 2014-05-29
	 */
	public function appsFeed($p, $tc, $ord, $lt, $ini){

		if( $lt === false )
			$lt = 20;
		
		if( $ini === false )
			$ini = 0;
		
		if($p!==false)
			$where[] = "idPrograma in (".$p.") ";
		
		if($tc!=false)
			$where[] = "idTipoWidget in (".$tc.") ";
		
		$order = "";
		if($ord != false)
			$order = "ORDER BY $ord";
		
		$sql = "SELECT idTipoWidget, idWidget, idPrograma, cTitulo, cUrlImagen
				  FROM busqueda ";
		if(count($where)>0)
			$sql .= "WHERE ".implode(" AND ", $where);
		$sql .= "$order LIMIT $ini,$lt";

		return $this->query($sql);
	}

	/**
	 * Método que obtiene los 6 últimos resultados de la tabla de búsqueda, para desplegar en Lo + Visto de Revista Central
	 * @author RMI
	 */
	public function showSide(){
		$url   = new My_Model_UtileriasCadenas();
		
		$cache = Zend_Registry::getInstance()->cacheAdapter['programas'];
		$cache_clave = md5('showSideRC'.$this->_pagina);
		
		if($this->tPurgar == 'purgar') $cache->remove($cache_clave);
		if(($stmt = $cache->load($cache_clave)) === false){		
				$sql = "SELECT b.idBusqueda, b.idWidget, b.idTipoWidget, b.cTitulo, b.cTeaser, b.cUrlImagen,
							(SELECT cUrl FROM programas p WHERE idPrograma = b.idPrograma LIMIT 1) as cUrlPrograma, b.dtFechaEvento
						FROM busqueda b WHERE b.idSeccion = 111 AND b.idTipoWidget = 3
		                AND dtFechaEvento < CURDATE()
						ORDER BY b.idBusqueda DESC LIMIT 30";
				$stmt = $this->query($sql);
				foreach($stmt as $key => $value) {
					if ($value['idTipoWidget'] == 2 ){    // tipo 2 para capitulos
						$stmt[$key]['url'] = '/capitulos/'.$value['cUrlPrograma'].'/'.$value['idWidget'].'/'.$url->convierteUrl($value['cTitulo']);
					}
					if ($value['idTipoWidget'] == 3){    // tipo 3 para notas
						$stmt[$key]['url'] = '/notas/'.$value['cUrlPrograma'].'/'.$value['idWidget'].'/'.$url->convierteUrl($value['cTitulo']);
					}
					if ( $value['idTipoWidget'] == 4){    // tipo 4 para galerias
						$stmt[$key]['url'] = '/galerias/'.$value['cUrlPrograma'].'/'.$value['idWidget'].'/'.$url->convierteUrl($value['cTitulo']);
					}
					if ( $value['idTipoWidget'] == 34){    // tipo 34 para videos
						$stmt[$key]['url'] = '/galerias/'.$value['cUrlPrograma'].'/'.$value['idWidget'].'/'.$url->convierteUrl($value['cTitulo']);
					}
				}
		$TiempoCache = 3600;
		$cache->setLifetime($TiempoCache);
		$cache->save($stmt,$cache_clave);
				 
		return $stmt;
		}else{
				return $stmt;
		}
	}
}