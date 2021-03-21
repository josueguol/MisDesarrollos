<?php

/**
 * Archivo para obtener programas en vivo
 */

/**
 *Model para obtener datos de programas en vivo
 *
 *@author Azteca Digital
 *@package library.My.Model
 */


class My_Model_ContenidoHome extends My_Db_TableAzteca implements My_Interface_Submodels {
	protected $_name    = 'contenidoHome';
	protected $_primary = 'idContenidoHome';
	
	public    $_idEjeHome;
	public    $_idUbicacion;
	
    public function getDefault(){}
	
	public function getContenidoHome(){
		try{
			$sql_select = "SELECT idRelEjeUbicacion, idEje, idUbicacion, idElemento, dFechaPublicacion, cTipo, 
					cUrlEspecial, idImagen, cPivotPoint, idFlashSugerencia, 
					  iHeight, idWidth, cTitulo, cTituloEspecial, cDescripcion, cTeaser, 
					cAutor, iPrioridad, iVentanaNueva, cColor, iSegundaImagen, idTipoLogo, 
								  iBrand, cTextoExtra, iTipoPrograma, cCategoria,
						(SELECT cUrl 
							FROM imagenes
							WHERE idMultimediaImagenes = idImagen ) AS cUrlImg								  
						   FROM contenidoHome 
						   WHERE idEje = {$this->_idEjeHome} AND idUbicacion = {$this->_idUbicacion} 
						   ORDER BY iPrioridad ";
			$result = $this->getAdapter()->query($sql_select)->fetchAll();
			return  $result	;
		}catch (Zend_Exception $e) { return false; }
	}
	
	public function getvideosHome(){
		try{
			$sql_select = "SELECT idRelEjeUbicacion, idEje, idUbicacion, idElemento, dFechaPublicacion, cTipo, 
					cUrlEspecial, idImagen, cPivotPoint, idFlashSugerencia,
					iHeight, idWidth, cTitulo, cTituloEspecial, cDescripcion, cTeaser, cAutor, 
					iPrioridad, iVentanaNueva, cColor, iSegundaImagen, idTipoLogo,

							iBrand, cTextoExtra, iTipoPrograma, cCategoria,
						(SELECT cUrl 
							FROM imagenes
							WHERE idMultimediaImagenes = idImagen ) AS cUrlImg		

							FROM contenidoHome

							WHERE idEje = {$this->_idEjeHome} AND idUbicacion = {$this->_idUbicacion} 
			                   AND cTipo='Video' ";											
			return  $this->getAdapter()->query($sql_select)->fetchAll();
		}catch (Zend_Exception $e) {
			return false;
		}
	}	
	
	public function getImagenesHome(){
		try{
			$sql_select = "SELECT idRelEjeUbicacion, idEje, idUbicacion, idElemento, dFechaPublicacion, cTipo, 
								  cUrlEspecial,idImagen, cUrlImg, cPivotPoint, idFlashSugerencia,
								  iHeight, idWidth, cTitulo, cTituloEspecial, cDescripcion, cTeaser, 
								  cAutor, iPrioridad, iVentanaNueva, cColor, iSegundaImagen, idTipoLogo,
								  iBrand, cTextoExtra, iTipoPrograma, cCategoria,
								  (SELECT cUrl 
								     FROM imagenes
									WHERE idMultimediaImagenes = idImagen ) AS cUrlImg								
							 FROM contenidoHome
							WHERE idEje = {$this->_idEjeHome} AND idUbicacion = {$this->_idUbicacion}
							      AND cTipo='Sugerencia' ";	

			return  $this->getAdapter()->query($sql_select)->fetchAll();
		}catch (Zend_Exception $e) {
			return false;
		}
	}	
	
	public function getContenidoExtraHome(){
		try{
			$sql_select = "SELECT idContenidoHome, idRelEjeUbicacion, idEje, idUbicacion, idElemento, dFechaPublicacion, 
								  cTipo, cUrlEspecial, idImagen, cPivotPoint, idFlashSugerencia, 
								  iHeight, idWidth, cTitulo, cTituloEspecial, cDescripcion, cTeaser, cAutor, 
								  iPrioridad, iVentanaNueva, cColor, iSegundaImagen, idTipoLogo, 
								  iBrand, cTextoExtra, iTipoPrograma, cCategoria, idItemsExtraHomes, ieh.cContenido,
								  (SELECT cUrl 
									 FROM imagenes
									WHERE idMultimediaImagenes = ch.idImagen ) AS cUrlImg
							 FROM contenidoHome AS ch
								  LEFT JOIN infoExtraHomes AS ieh ON ch.idContenidoHome = ieh.idEjeRelacionWidget
							WHERE idEje = {$this->_idEjeHome}  AND idUbicacion = {$this->_idUbicacion} 
							ORDER BY iPrioridad";
			
			return  $this->getAdapter()->query($sql_select)->fetchAll();
		}catch(Zend_Exception $e) { return false; }
	}

	public function getVideoNota(){
		try{
			$utilities = new  My_Model_UtileriasCadenas();
            $sql_select = "SELECT idRelEjeUbicacion, idEje, idUbicacion, idElemento, dFechaPublicacion, cTipo, cUrlEspecial, idImagen, cUrlImg, cPivotPoint, idFlashSugerencia, 
                                  iHeight, idWidth, cTitulo, cTituloEspecial, cDescripcion, cTeaser, cAutor, iPrioridad, iVentanaNueva, cColor, iSegundaImagen, idTipoLogo, 
                                  iBrand, cTextoExtra, iTipoPrograma, cCategoria
                             FROM contenidoHome 
                            WHERE idEje = {$this->_idEjeHome} AND idUbicacion = {$this->_idUbicacion} 
                            ORDER BY iPrioridad";
            $video =  $this->getAdapter()->query($sql_select)->fetchAll();
            $elementos = array();
            foreach($video as $row){
				$row['cUrlVideo']= '/capitulos/laacademia10/'.$row["idElemento"].'/'.$utilities->convierteUrl(strtolower($row["cTitulo"]));
				array_push($elementos, $row);
			}
            return $elementos;
        }catch(Zend_Exception $e){ return false; }
    }
      
    /**
     * Obtenemos los videos para el home de espectaculos
     * @author [PILJ]
    */
    public function getVideoEspectaculos(){
      	try {
      		$utilities = new  My_Model_UtileriasCadenas();
      		$sql = "SELECT idRelEjeUbicacion, idEje, idUbicacion, idElemento, dFechaPublicacion, cTipo, cUrlEspecial, idImagen, cUrlImg, cPivotPoint, idFlashSugerencia, 
                                              iHeight, idWidth, cTitulo, cTituloEspecial, cDescripcion, cTeaser, cAutor, iPrioridad, iVentanaNueva, cColor, iSegundaImagen, idTipoLogo, 
                                              iBrand, cTextoExtra, iTipoPrograma, cCategoria
                                       FROM contenidoHome 
                                       WHERE idEje = {$this->_idEjeHome} AND idUbicacion = {$this->_idUbicacion} 
                                       ORDER BY iPrioridad";
           $video =  $this->getAdapter()->query($sql)->fetchAll();
           
           $elementos = array();
           foreach($video as $row){
           	$row['cUrlVideo']= '/capitulos/espectaculos/'.$row["idElemento"].'/'.$utilities->convierteUrl(strtolower($row["cTitulo"]));
           	array_push($elementos, $row);
           }
           
           return $elementos;
      	} catch(Zend_Exception $e) {
      		return false;
      	}
    }
      
    /**
     * Funcion para cargar el contenido de una pieza para un eje especifico
     * [EPG] 2013/06/27
    */
    public function cargaContenido($idEje, $idUbicacion, $timeStamp, $datosConfig = array(), $idPrograma, $tPurgar = false){
      	$cache      = Zend_Registry::getInstance()->cacheAdapter['programas'];
      	$utilities  = new My_Model_Utilities_tortugaUtilities();
      	$programas  = new My_Model_Programas();
      	$nCache01   = md5('cargaCont'. $idEje .$idUbicacion.$timeStamp.$idPrograma);
      	$verCache01 = $utilities->vesionCache($nCache01, $tPurgar);
      	$cacheKey01 = $nCache01.$verCache01;
      	$items      = $cache->load($cacheKey01);
      	
      	///////////MEMCACHE E = PURGAR
	    if(false==$items || $tPurgar==true) {
	      	if ($datosConfig['content'] == 1) { //Validamos si la información ha sido pedida de forma manual
    		      	$sql = "SELECT LOWER(SUBSTRING(ch.cTipo,1,1)) AS cType, ch.idElemento AS id, ch.cTeaser, 
    							   ch.cTextoExtra, ch.cTitulo, ch.cUrlEspecial, ch.cUrlImg, ch.idPrograma
    						  FROM contenidoHome ch
    		      			 WHERE idEje = $idEje 
    		      				   AND idUbicacion = $idUbicacion 
    		      	               AND dFechaPublicacion = '$timeStamp'
    		      			 ORDER BY iPrioridad";
		      	$result = $this->query($sql);
		      	foreach($result as $k => $v){
		      		$Programa = $programas->getNomProgporContenido($v['id'], $v['cType']);
			      	$item['cType'] = $v['cType'];
			 		$item['id'] = $v['id'];
		   	 		$item['title'] = $v['cTitulo'];
		  	 		$item['url'] = $v['cUrlEspecial'];
		      	 	$item['image'] = $v['cUrlImg'];
		      	 	$item['teaser'] = $v['cTeaser'];
		      	 	$item['idProg'] = $v['idPrograma'];
		      	 	$item['cPrograma'] = @$Programa[0]['cNombre'];
		      	 	$item['cUrlPrograma'] = @$Programa[0]['cUrl'];
		      	 	$item['detalle']   = $Programa;
				if($v['cType'] == 'v') {
		      	 	    $infoVideo = $videos->getInfoVideo($v['id']);
		      	 	    $item['entryId']   = $infoVideo['entryId'];
		      	 	    $item['cUrlYoutube']   = $infoVideo['cUrlYoutube'];
		      	 	    $item['datediff']   = $infoVideo['datediff'];
		      	 	}
		      	 	$item['infoPrograma'] = $this->getInfoPrograma($Programa,$v['cTeaser'],$v['cType']);
		      	 	$extras = (array) json_decode($v['cTextoExtra']);
			 		$items[] = array_merge($item,$extras);
		      	}
		      	 
	      	}
	      	else if ($datosConfig['content'] == 2) { //Si ha sido de forma automatica tomamos en cuenta el programa y la categoria de lo que haya sido elegido
	      		$busqueda = new My_Model_Busqueda();
	      		if($datosConfig['category'] != "")
	      			$categorias = array($datosConfig['category']);
	      		else
	      			$categorias = "";
	      		$result = $busqueda->busquedaGral(10,0,array($datosConfig['type']),"","",2,array($idPrograma),false,$categorias,"",$tPurgar);

	      		foreach($result as $k => $v){
	      			$item['cType'] = $v['idTipoWidget'];
	      			$item['id'] = $v['idWidget'];
	      			$item['title'] = $v['cTitulo'];
	      			$item['url'] = $v['url'];
	      			$item['image'] = $v['cUrlImagen'];
	      			$item['cTeaser'] = "";
	      			if($v['cType'] == '2') {
	      			    $infoVideo = $videos->getInfoVideo($v['id']);
	      			    $item['entryId']   = $infoVideo['entryId'];
	      			    $item['datediff']   = $infoVideo['datediff'];
	      			}
	      			$extras = (array) json_decode($v['cTeaser']);
	      			$items[] = array_merge($item,$extras);
	      		}
		    }
		    else{
		    	
		    	$sql = "SELECT LOWER(SUBSTRING(ch.cTipo,1,1)) AS cType, ch.idElemento AS id, ch.cTeaser,
						       ch.cTextoExtra, ch.cTitulo, ch.cUrlEspecial, ch.cUrlImg, ch.idPrograma
						  FROM contenidoHome ch
						 WHERE idEje = $idEje
						       AND idUbicacion = $idUbicacion
						       AND dFechaPublicacion = '$timeStamp' 
		    			 ORDER BY iPrioridad";
		    	 
		    	$result = $this->query($sql);
		    	foreach($result as $k => $v){
			    	$Programa = $programas->getNomProgporContenido($v['id'], $v['cType']);
			    	$item['cType']     = $v['cType'];
			    	$item['id'] 	   = $v['id'];
			    	$item['title']     = $v['cTitulo'];
			    	$item['url'] 	   = $v['cUrlEspecial'];
			    	$item['image']     = $v['cUrlImg'];
			    	$item['teaser']    = $v['cTeaser'];
			    	$item['idProg']    = $v['idPrograma'];
			    	$item['cPrograma'] = @$Programa[0]['cNombre'];
			    	$item['cUrlPrograma'] = @$Programa[0]['cUrl'];
			    	$item['detalle']   = $Programa;
			    	if($v['cType'] == 'v') {
				    	$infoVideo 		 = $videos->getInfoVideo($v['id']);
				    	$item['entryId'] = $infoVideo['entryId'];
				    	$item['datediff']   = $infoVideo['datediff'];
			    	}
			    	$extras = (array) json_decode($v['cTextoExtra']);
			    	$items[] = array_merge($item,$extras);
		    	}
		    	
		    }
		    
		    $HoraDelete    = Zend_Registry::get('main')->delete->cache->hora;
		    $MinutoDelete  = Zend_Registry::get('main')->delete->cache->minuto;
		    $SegundoDelete = Zend_Registry::get('main')->delete->cache->segundos;
		    $TiempoCache   =  mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) - time(); //86400
		    if($TiempoCache <= 0)
		    	$TiempoCache = (mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) + 86400) - time(); //86400
		    $cache->setLifetime($TiempoCache);
		    $cache->save($items, $cacheKey01);
	    }

      	return $items;
      }
    
   
      /**
       * Funcion para cargar el contenido de una pieza obteniendo la información desde un Json especifico
       * [EM] 2018/11/07
       */
      public function cargaContenidoFromJson($urlJson, $tPurgar = false){
          $cache      = Zend_Registry::getInstance()->cacheAdapter['programas'];
          $utilities  = new My_Model_Utilities_tortugaUtilities();
          //$programas  = new My_Model_Programas();
          $nCache01   = md5('cargaContJson'. $urlJson);
          $verCache01 = $utilities->vesionCache($nCache01, $tPurgar);
          $cacheKey01 = $nCache01.$verCache01;
          $items      = $cache->load($cacheKey01);
          
          ///////////MEMCACHE E = PURGAR
          if(false==$items || $tPurgar==true) {
              
              $json = file_get_contents($urlJson);
              $result = json_decode($json, TRUE);
              
              foreach($result['items'] as $k => $v){
                  $tipo = null;
                  switch ($v['tipo']) {
                      case 'capitulo': $tipo = 'v'; break;
                      case 'nota': $tipo = 'n'; break;
                      case 'galeria': $tipo = 'g'; break;
                      default: $tipo = '';
                  }
                  
                  $item['cType'] = $tipo;
                  $item['title'] = $v['titulo'];
                  $item['url'] = $v['url'];
                  $item['image'] = $v['imagen'];
                  $item['teaser'] = isset($v['teaser']) ? $v['teaser'] : $v['titulo'];
                  $item['cPrograma'] = isset($v['programa']) ? $v['programa'] : '';
                  
                  $items[] = $item;
                  
              }
              
              $HoraDelete    = Zend_Registry::get('main')->delete->cache->hora;
              $MinutoDelete  = Zend_Registry::get('main')->delete->cache->minuto;
              $SegundoDelete = Zend_Registry::get('main')->delete->cache->segundos;
              $TiempoCache   =  mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) - time(); //86400
              if($TiempoCache <= 0)
                  $TiempoCache = (mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) + 86400) - time(); //86400
                  $cache->setLifetime($TiempoCache);
                  $cache->save($items, $cacheKey01);
          }
          
          return $items;
      }
      
      
      /**
       * Funcion para cargar el contenido de una pieza obteniendo la información desde un Json especifico
       * [EM] 2018/11/07
       */
      public function cargaContenidoADN40FromJson($urlJson, $type, $tPurgar = false){
          $cache      = Zend_Registry::getInstance()->cacheAdapter['programas'];
          $utilities  = new My_Model_Utilities_tortugaUtilities();
          //$programas  = new My_Model_Programas();
          $nCache01   = md5('cargaContADNJson'. $urlJson.$type);
          $verCache01 = $utilities->vesionCache($nCache01, $tPurgar);
          $cacheKey01 = $nCache01.$verCache01;
          $items      = $cache->load($cacheKey01);
          
          ///////////MEMCACHE E = PURGAR
          if(false==$items || $tPurgar==true) {
              
              $json = file_get_contents($urlJson);
              $result = json_decode($json, TRUE);
              
              foreach($result['section'][$type]['items'] as $k => $v){
                  
                  $tipo = null;
                  switch ($v['tipo']) {
                      case 'capitulo': $tipo = 'v'; break;
                      case 'nota': $tipo = 'n'; break;
                      case 'galeria': $tipo = 'g'; break;
                      default: $tipo = '';
                  }
                  
                  $item['cType'] = $tipo;
                  $item['title'] = $v['titulo'];
                  $item['url'] = $v['url'];
                  $item['image'] = $v['imagen'];
                  $item['teaser'] = isset($v['teaser']) ? $v['teaser'] : $v['titulo'];
                  $item['cPrograma'] = isset($v['programa']) ? $v['programa'] : '';
                  
                  $items[] = $item;
                  
              }
              
              $HoraDelete    = Zend_Registry::get('main')->delete->cache->hora;
              $MinutoDelete  = Zend_Registry::get('main')->delete->cache->minuto;
              $SegundoDelete = Zend_Registry::get('main')->delete->cache->segundos;
              $TiempoCache   =  mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) - time(); //86400
              if($TiempoCache <= 0)
                  $TiempoCache = (mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) + 86400) - time(); //86400
                  $cache->setLifetime($TiempoCache);
                  $cache->save($items, $cacheKey01);
          }
          
          return $items;
      }
      
      
      
    /**
     * Obtenemos todas las horas para las que se tiene programado un home para que a partir de este arreglo se pueda obtener la informacion requerida
     * @param integer $idEje
     * @return Ambigous <boolean, multitype:, stdClass, multitype:array >
    */
    public function getFechaPublicacion($idEje){
        $sql = "SELECT dFechaPublicacion FROM contenidoHome WHERE idEje = {$idEje} AND idUbicacion  IS NOT NULL GROUP BY dFechaPublicacion ORDER BY 1 ASC;";
        $result = $this->query($sql);
        return (count($result) > 0) ? $result : false;
    }
      
    private function getInfoPrograma($infoPrograma, $teaser, $type) {
        $arrInfoPrograma = array();
        switch ($type) {
            case 'v':
            case 'c':
            case 'g':
            case 'n':
                $arrInfoPrograma = array('idS' => $infoPrograma[0]['idSeccion'], 'name' => $infoPrograma[0]['cNombre'], 'schedule' => $infoPrograma[0]['cHorario'], 'synopsis' => $infoPrograma[0]['cSinopsis']);
                break;
            default:
                $result = explode("|", $teaser);
                $arrInfoPrograma = array('idS' => $result[0], 'name' => $result[1], 'schedule' => $result[2], 'synopsis' => $result[3]);
                break;
        }
        return $arrInfoPrograma;
    }
      
      //obtiene los programas del home de CentralVideo
    public function getContenidoHomeCentralVideo($tPurgar = false){
    	$idEjeHome = 8690;//8690 idEje de centralVideo
		$cache      = Zend_Registry::getInstance()->cacheAdapter['programas'];
      	$utilities  = new My_Model_Utilities_tortugaUtilities();
      	$nCache01   = md5('progsCVideo'. $idEjeHome);
      	$verCache01 = $utilities->vesionCache($nCache01, $tPurgar);
      	$cacheKey01 = $nCache01.$verCache01;
      	$items      = $cache->load($cacheKey01); 
      	///////////MEMCACHE E = PURGAR
	    if(false==$items || $tPurgar==true) {
	      	$sql = "SELECT ch.idElemento AS id, ch.cTeaser, ch.cTitulo, ch.cUrlEspecial
					  	FROM contenidoHome ch
	      			 	WHERE idEje = $idEjeHome";
	      	$result = $this->query($sql);
	      	foreach($result as $k => $v){
		 		$item['id'] = $v['id'];
	   	 		$item['title'] = $v['cTitulo'];
	  	 		$item['url'] = $v['cUrlEspecial'];
	      	 	$item['teaser'] = $v['cTeaser'];
		 		$items[] = $item;
	      	}
		    
		    $HoraDelete    = Zend_Registry::get('main')->delete->cache->hora;
		    $MinutoDelete  = Zend_Registry::get('main')->delete->cache->minuto;
		    $SegundoDelete = Zend_Registry::get('main')->delete->cache->segundos;
		    $TiempoCache   =  mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) - time(); 
		    if($TiempoCache <= 0)
		    	$TiempoCache = (mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) + 86400) - time(); 
		    $cache->setLifetime($TiempoCache);
		    $cache->save($items, $cacheKey01);
        }
        return $items;

	}
}
