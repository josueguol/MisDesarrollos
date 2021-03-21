<?php
/**
 * Archivo de definición de model de capitulo
 * @package trunk.My.Model.CapituloGenerico
 * @author  Azteca Digital [JT]
 * @version 1.0.0
 */

/**
 * Definición de model de capitulo
 * @package trunk.My.Model.CapituloGenerico
 * @author  Azteca Digital [JT]
 * @version 1.0.0
 */
class My_Model_Categorias extends My_Db_TableAzteca{
	protected $_name    = 'categorias';
	protected $_primary = 'idCategoria';
	public    $_idEjeHome;

 	/**
 	 *	 Regresa el id de la categoria que se manda. 
 	 * 
 	 */
	function getCategorias($programa = null, $idPrograma = null){

	 
		// Buscamos primero en caché
		$cache      = Zend_Registry::getInstance()->cacheAdapter['programas'];
		$cacheClave = md5("categorias-$programa-$idPrograma");
		$categoria = $cache->load($cacheClave);
		
		// Si no hay datos en caché generarlos
		if(false == $categoria){
			
			if($idPrograma> 0){
				
				$sql = "SELECT cat.idCategoria, cat.cDescripcion
						  FROM categorias cat
						       INNER JOIN rel_categorias_programas rel ON cat.idCategoria = rel.idCategoria
						 WHERE rel.idPrograma = {$idPrograma}
						 LIMIT 10";
				$categoria = $this->query($sql);
								
			}else if($programa != null){
				
				$sql = "SELECT cat.idCategoria, cat.cDescripcion
						  FROM categorias cat
							   INNER JOIN rel_categorias_programas rel ON cat.idCategoria = rel.idCategoria
						 WHERE rel.idPrograma = (SELECT idPrograma FROM programas WHERE cUrl = '{$programa}' AND iStatus = 1 AND idSeccion IN (1,10));
						 LIMIT 10";
				$categoria = $this->query($sql);			
				
			}

			$ctn = count($categoria);
			$categoria[$ctn]['idCategoria']  = 0; 
			$categoria[$ctn]['cDescripcion'] = 'Todos';
	 
			$HoraDelete    = Zend_Registry::get('main')->delete->cache->hora;
			$MinutoDelete  = Zend_Registry::get('main')->delete->cache->minuto;
			$SegundoDelete = Zend_Registry::get('main')->delete->cache->segundos;
			$TiempoCache =  mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) - time(); //86400
			if ($TiempoCache <= 0){
				$TiempoCache =  (mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) + 86400) - time(); //86400
			}
			$cache->setLifetime($TiempoCache);
			$cache->save($categoria,$cacheClave);
		}
		
		return $categoria;	
		
	}

	function getCategoriaUrl($widget, $item){
	 
		if($widget == 'videos')
			$widget = 'capitulos';
		
		// Buscamos primero en caché
		$cache      = Zend_Registry::getInstance()->cacheAdapter['programas'];
		$cacheClave = md5("categorias-$widget-$item");
		$urlCategoria = $cache->load($cacheClave);
		
		// Si no hay datos en caché generarlos
		if(false == $urlCategoria){
			try {
				$util = new My_Model_UtileriasCadenas();
				$sql = "SELECT cCategorias
		  				  FROM busqueda b
							   INNER JOIN widget w ON b.idTipoWidget  = w.idWidget
					   	 WHERE w.cLink = '{$widget}'
						 	   AND b.idWidget = {$item}
						 LIMIT 1";
				
				$idCategoria  = $this->query($sql);
				$idCategoria  = explode(',', $idCategoria[0]["cCategorias"]);
				$idCategoria  = $idCategoria [0];
				$sqlCategoria = "SELECT cDescripcion 
								   FROM categorias 
							  	  WHERE idCategoria = {$idCategoria};";
				
				$idCategoria  = $this->query($sqlCategoria);
				
				$urlCategoria = $util->convierteUrl($idCategoria[0]["cDescripcion"]);
				
				if(strlen($urlCategoria) ==  0){
					$urlCategoria = $widget;
				}
				
				$HoraDelete    = Zend_Registry::get('main')->delete->cache->hora;
				$MinutoDelete  = Zend_Registry::get('main')->delete->cache->minuto;
				$SegundoDelete = Zend_Registry::get('main')->delete->cache->segundos;
				$TiempoCache =  mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) - time(); //86400
				if ($TiempoCache <= 0){
					$TiempoCache =  (mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) + 86400) - time(); //86400
				}
				$cache->setLifetime($TiempoCache);
				$cache->save($urlCategoria,$cacheClave);
			} catch (Exception $e) {
				$urlCategoria  = $widget; 
			}
		}
		
		return $urlCategoria;		
	}
	
	
}