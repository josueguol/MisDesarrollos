<?php
/**
 * Archivo de definición para obtener datos de las ubicaciones del nuevo esquema (Tetris)
 * @package azteca.My.Model.UbicacionTetris
 * @author  Azteca Digital [EM] 05/06/2013
 * @version 1.0.0
 */

/**
 * Definición de clase  para obtener datos de las ubicaciones del nuevo esquema (Tetris)
 * @package azteca.My.Model.UbicacionTetris
 * @author  Azteca Digital [EM] 05/06/2013
 * @version 1.0.0
 */
class My_Model_UbicacionesTetris extends My_Db_TableAzteca implements My_Interface_Submodels{
    protected $_table   = 'ubicacion';
    protected $_primary = 'idUbicacion';

    public $_idEjeHome;
    public $_idProg;
    public $_idUbicacion;

    public function getDefault(){ }
    
    /**
     * Instanciamos las clases y obtenemos los datos necesarios para el template
     * @param int $idTemplate
     */
    public function getUbicacionesTetris($idPrograma, $idTemplate, $modulo, $tPurgar = false, $ePurgar = false ){

    	$modelTemplates = new My_Model_Templates();
    	$type = $this->getTypeLayout($idTemplate, $ePurgar);
    	
    	switch ($type){
    		case "1":
    		case "6":
    		case "7":
    			$datosTemplate =  $modelTemplates->datosHorizontal($idPrograma, $idTemplate, $tPurgar, $ePurgar);
    			break;
    		case "2":
    		case "3":
    			$datosTemplate =  $modelTemplates->datosMixto($idPrograma, $idTemplate, $tPurgar, $ePurgar);
    			break;
    	}


    	$datos = $datosTemplate;
    	
		return $datos;
    }
	
    private function getTypeLayout($idTemplate, $ePurgar = false) {
    	
    	$cache      = Zend_Registry::getInstance()->cacheAdapter['programas'];
    	$utilities  = new My_Model_Utilities_tortugaUtilities();
    	$nCache01   = md5('getTypeLayout'. $idTemplate);
    	$verCache01 = $utilities->vesionCache($nCache01, $ePurgar);
    	$cacheKey01 = $nCache01.$verCache01;
    	$idLayout   = $cache->load($cacheKey01);
    	if(false==$idLayout || $ePurgar==true) {
    	
	    	$modelTemplates = new My_Model_Templates();
	    	$sql      = "SELECT idLayout FROM templates WHERE idTemplate = {$idTemplate}";
	    	$idLayout = $modelTemplates->query($sql);
    	
	    	$HoraDelete    = Zend_Registry::get('main')->delete->cache->hora;
	    	$MinutoDelete  = Zend_Registry::get('main')->delete->cache->minuto;
	    	$SegundoDelete = Zend_Registry::get('main')->delete->cache->segundos;
	    	$TiempoCache   =  mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) - time(); //86400
	    	if($TiempoCache <= 0)
	    		$TiempoCache = (mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) + 86400) - time(); //86400
	    	$cache->setLifetime($TiempoCache);
	    	$cache->save($idLayout, $cacheKey01);
    	}
    	
    	return $idLayout[0]['idLayout'];
    }

    /**
     *
     * Instancia las clases y hace referencia a los metodos, retorna un arreglo
     * @param char $nameclass
     * @param char $namemethod
     *
     */
    private function setClases($nameclass,$namemethod,$idUbicacion,$parametro, $modulo){
        if (false == @class_exists($nameclass) || false == method_exists($nameclass,$namemethod)) {
            $nameclass  = $this->getNameClassDefault($modulo);
            $namemethod = $this->getNameMethodDefault($modulo);
        }
        
        $obj = new $nameclass;
        $obj->_idEjeHome   = $this->_idEjeHome;
        $obj->_idUbicacion = $idUbicacion;
        $obj->_modulo = $modulo;
        $obj->_idProg = $this->_idProg; 
        if ($parametro == null || $parametro == '') {
            return $obj->$namemethod();
        } else {
            return $obj->$namemethod($parametro);
        }   
    }
    
    /**
     *
     * Obtenemos los datos del template
     * @param int $idTemplate
     */
    private function getUbicacionesTemplate($idTemplate = 0){
        $sql_ubicacion = 'SELECT idRelTemplateUbicacion, r.idTemplate, r.idUbicacion,
                                  u.cDescripcion,  u.iStatus,  u.cModel,  u.cMetodo,  u.cParametro
                            FROM rel_template_ubicacion r
                                 INNER JOIN ubicacion u  ON r.idUbicacion =  u.idUbicacion
                                 INNER JOIN templates t ON t.idTemplate = r.idTemplate
                           WHERE r.idTemplate = ' . $idTemplate . '
                           ORDER BY  idRelTemplateUbicacion ASC';
        $ubicacion = $this->query($sql_ubicacion);
        return $ubicacion;
    }
    
    /**
     * 
     * Obtiene el nombre de la clase por default de cada widget
     * @param string $modulo
     */
    private function getNameClassDefault($modulo) {
        switch ($modulo) {
        	case 'videos':
        		return 'My_Model_CapituloGenerico';
        		break;
        	case 'capitulos':
                return 'My_Model_CapituloGenerico';
            break;
            case 'notas':
                return 'My_Model_NotaGenerica';
            break;
            case 'galerias':
                return 'My_Model_Galeria2';
            break;
            case 'home':
                return 'My_Model_UbicacionGenerica';
        }
    }
    
    /**
     * 
     * Obtiene el nombre del metodo por default de cada widget
     * @param string $modulo
     */
    private function getNameMethodDefault($modulo) {
    	switch ($modulo) {
	    	case 'videos':
    			return 'mostrar';
    			break;	
    		case 'capitulos':
                return 'mostrar';
            break;
            case 'notas':
                return 'mostrar';
            break;
            case 'galerias':
                return 'datosGaleria';
            break;
            case 'perfiles':
                return 'getDefault';
            break;
            case 'home':
                return 'getDefault';
        }
    }
}