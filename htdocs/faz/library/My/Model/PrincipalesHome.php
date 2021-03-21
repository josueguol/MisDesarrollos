<?php 
/**
 * Archivo de defincion de clase Model para albergar las funciones que manejaran las consultas a la tabla principalesHome  
 * @author Azteca Digital [EPG]
 * @package library.My.Model
 * @version 1.0.0 [2013-06-26]
 *
 */

/**
 * Definición de clase Model para albergar las funciones que manejarán las consultas a la tabla principalesHome
 * @author Azteca Digital [EPG]
 * @package library.My.Model
 * @version 1.0.0 [2013-06-26]
 *
 */
class My_Model_PrincipalesHome extends My_Db_TableAzteca  {
	protected $_name = 'principalesHome';
	protected $_primary = 'idPrincipalesHome';
	/**
	 * Funcion para obtener el contenido de las principales
	 * [EPG] 2013/06/25
	 */
	public function mainItems($idEje, $dPublicacion, $tPurgar){

		$cache      = Zend_Registry::getInstance()->cacheAdapter['programas'];
		$utilities  = new My_Model_Utilities_tortugaUtilities();
		$nCache01   = md5('mainItems'. $idEje .$dPublicacion);
		$verCache01 = $utilities->vesionCache($nCache01, $tPurgar);
		$cacheKey01 = $nCache01.$verCache01;
		$items      = $cache->load($cacheKey01);

		///////////MEMCACHE E = PURGAR
		if(false==$items || $tPurgar==true) {
			$sql = "SELECT ph.iTipoPrincipal, ph.cTipoContenido, ph.idElemento, ph.iTituloPersonalizado, ph.cTitulo, ph.cTeaser,
			               ph.iUrlPersonalizada, ph.cUrl, ph.cUrlImagen, ph.iOrdenPrincipal, ph.iOrdenContenido, ph.dPublicacion, ph.cEntryId, p.idPrograma, p.cNombre
					  FROM principalesHome ph
					  LEFT JOIN eje e ON ph.idEje = e.idEje
					  LEFT JOIN programas p ON p.idPrograma = e.idPrograma
					 WHERE ph.idEje = $idEje 
					       AND ph.dPublicacion = '$dPublicacion' 
					 ORDER BY ph.iOrdenPrincipal ASC, ph.iOrdenContenido ASC";
				
			$result = $this->query($sql);
			if(count($result)>0){
				$actual = "";
				$cont = -1;
					foreach($result as $k => $v){
						if($actual!=$v['iOrdenPrincipal']){
							$cont++;
							$actual = $v['iOrdenPrincipal'];
						}
						$items[$cont]['itemType'] = $v['iTipoPrincipal'];
						$items[$cont]['content'][] = array('cType'=>$v['cTipoContenido'],'id'=>$v['idElemento'],
								                           'customTitle'=>$v['iTituloPersonalizado']==1?true:false,
								                           'title'=>str_replace("'", "\\'", $v['cTitulo']),'customUrl'=>$v['iUrlPersonalizada']==1?true:false,
														   'teaser'=> $v['cTeaser'],
														   'idPrograma' => $v['idPrograma'],
														   'cPrograma' => $v['cNombre'],
								                           'url'=>$v['cUrl'],'image'=>$v['cUrlImagen'],
														   'cEntryId'=>$v['cEntryId'], 'infoPrograma' => $this->getInfoProgramaByItem($v['cTipoContenido'], $v['idElemento'], $v['cTeaser']));
					}
			}else
				$items = array();
			
			$HoraDelete    = Zend_Registry::get('main')->delete->cache->hora;
			$MinutoDelete  = Zend_Registry::get('main')->delete->cache->minuto;
			$SegundoDelete = Zend_Registry::get('main')->delete->cache->segundos;
			$TiempoCache   = mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) - time(); //86400
			if($TiempoCache <= 0)
				$TiempoCache = (mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) + 86400) - time(); //86400
			$cache->setLifetime($TiempoCache);
			$cache->save($items, $cacheKey01);
		}
		
		return $items;
	}
	
	/**
	 * Funcion para guardar elementos de las principales
	 * [EPG] 2013/06/26
	 */
	public function guardaPrincipales($datos,$idEje,$fechaPublicacion){

		$this->delete("idEje =  ".$idEje." AND dPublicacion = '$fechaPublicacion'");
		foreach($datos as $k => $v){
			$this->insert($v);
		}
	}
	
	/**
	 * Funcion que regresa una lista de las fechas con informacion en el Home
	 * [EPG] 2013/07/01
	 */
	public function assignedPubStamps($idEje){
		
		$sql="SELECT DISTINCT dPublicacion 
		        FROM principalesHome 
		       WHERE idEje = $idEje AND dPublicacion!='0000-00-00 00:00:00'";
		$result = $this->query($sql);
		$data[] = "0000-00-00 00:00:00";
		
		foreach ( $result as $k=> $v){
			$data[] = $v['dPublicacion'];
		}
		
		return $data;
	}
	
	public function getInfoProgramaByItem($type, $id, $teaser) {
	    $arrInfoPrograma = array();
	    switch ($type) {
	        case 'v':
	            $sql = "SELECT p.idSeccion, p.cNombre, p.cHorario, cSinopsis FROM programas p INNER JOIN rel_MultimediaVideos_Programas rmp ON p.idPrograma = rmp.idPrograma 
	                     INNER JOIN multimediaVideos2 mv ON rmp.idMultimediaVideos = mv.idMultimediaVideos 
	                     INNER JOIN principalesHome ph ON mv.idMultimediaVideos = ph.idElemento WHERE ph.cTipoContenido = '{$type}' AND ph.idElemento = {$id} LIMIT 1;";
	            $result = $this->query($sql);
	            if (count($result) > 0) $arrInfoPrograma = array('idS' => $result[0]['idSeccion'], 'name' => $result[0]['cNombre'], 'schedule' => $result[0]['cHorario'], 'synopsis' => $result[0]['cSinopsis']);
	            break;
	        case 'n':
	            $sql = "SELECT p.idSeccion, p.cNombre, p.cHorario, cSinopsis FROM programas p INNER JOIN rel_NotaGenerica_Programas rnp ON p.idPrograma = rnp.idPrograma
	                     INNER JOIN notaGenerica2 n ON rnp.idNotaGenerica = n.idNotaGenerica INNER JOIN principalesHome ph ON n.idNotaGenerica = ph.idElemento
	                     WHERE ph.cTipoContenido = '{$type}' AND ph.idElemento = {$id} LIMIT 1;";
	            $result = $this->query($sql);
	            if (count($result) > 0) $arrInfoPrograma = array('idS' => $result[0]['idSeccion'], 'name' => $result[0]['cNombre'], 'schedule' => $result[0]['cHorario'], 'synopsis' => $result[0]['cSinopsis']);
	            break;
	        case 'g':
	            $sql = "SELECT p.idSeccion, p.cNombre, p.cHorario, cSinopsis FROM programas p INNER JOIN rel_Galeria_Programas rgp ON p.idPrograma = rgp.idPrograma 
	                     INNER JOIN galeria2 g ON rgp.idGalerias = g.idGalerias INNER JOIN principalesHome ph ON g.idGalerias = ph.idElemento 
	                     WHERE ph.cTipoContenido = '{$type}' AND ph.idElemento = {$id} LIMIT 1;";
	            $result = $this->query($sql);
	            if (count($result) > 0) $arrInfoPrograma = array('idS' => $result[0]['idSeccion'], 'name' => $result[0]['cNombre'], 'schedule' => $result[0]['cHorario'], 'synopsis' => $result[0]['cSinopsis']);
	            break;
	        default:
	            $result = explode("|", $teaser);
	            $arrInfoPrograma = array('idS' => $result[0], 'name' => $result[1], 'schedule' => $result[2], 'synopsis' => $result[3]);
	            break;
	    }
	    return $arrInfoPrograma;
	}
}
?>