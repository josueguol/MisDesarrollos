<?php 
/**
 * Archivo de defincion de clase Model para albergar las funciones que manejaran las consultas a la tabla settingsContenidoPiezas  
 * @author Azteca Digital [EPG]
 * @package library.My.Model
 * @version 1.0.0 [2013-06-28]
 *
 */

/**
 * Definición de clase Model para albergar las funciones que manejarán las consultas a la tabla settingsContenidoPiezas
 * @author Azteca Digital [EPG]
 * @package library.My.Model
 * @version 1.0.0 [2013-06-28]
 *
 */
class My_Model_SettingsContenidoPiezas extends My_Db_TableAzteca  {
	protected $_name    = 'settingsContenidoPiezas';
	protected $_primary = 'idSettingsContenidoPiezas';
	
	/**
	 * Funcion para guardar los settings cada pieza para un eje especifico
	 * [EPG] 2013/06/27
	 */
	public function guardaSettings($datos){
		foreach($datos as $k => $v){
			$this->insert($v);
		}
	}
	
	/**
	 * Funcion para eliminar los settings de una pieza para un eje especifico
	 * [EPG] 2013/06/27
	 */
	public function borraSettings($datos){
		foreach($datos as $k => $v){
			$this->delete("idEje =  ".$v[0]." AND idPiezaTemplate = ".$v[1]);
		}
	}
	
	/**
	 * Funcion para cargar los settings de una pieza para un eje especifico
	 * [EPG] 2013/07/01
	 */
	public function cargaSettings($idEje, $idPiezaTemplate, $ePurgar = false){

		$cache = Zend_Registry::getInstance()->cacheAdapter['programas'];
		$utilities  = new My_Model_Utilities_tortugaUtilities();
		$nCache01   = md5('cargaSet'. $idEje .$idPiezaTemplate);
		$verCache01 = $utilities->vesionCache($nCache01, $ePurgar);
		$cacheKey01 = $nCache01.$verCache01;
		$config     = $cache->load($cacheKey01);
		
		///////////MEMCACHE E = PURGAR
		if(false == $config || $ePurgar==true) {
			$sql = "SELECT idPropiedadesPiezas, cValue 
					  FROM settingsContenidoPiezas 
					 WHERE idEje = $idEje and idPiezaTemplate = $idPiezaTemplate";
			$result = $this->query($sql);

			foreach($result as $k => $v){
				$config[] = array("idStng" => $v['idPropiedadesPiezas'], "value" => $v['cValue']);
			}
			
			if($config == false){
				$config[] = 'Sin configuracion';
			}
			$HoraDelete    = Zend_Registry::get('main')->delete->cache->hora;
			$MinutoDelete  = Zend_Registry::get('main')->delete->cache->minuto;
			$SegundoDelete = Zend_Registry::get('main')->delete->cache->segundos;
			$TiempoCache   =  mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) - time(); //86400
			if($TiempoCache <= 0)
				$TiempoCache = (mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) + 86400) - time(); //86400
			$cache->setLifetime($TiempoCache);
			$cache->save($config, $cacheKey01);
		}
		
		return $config;
	}	
}
?>