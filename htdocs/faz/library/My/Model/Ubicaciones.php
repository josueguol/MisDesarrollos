<?php
/**
 * Archivo de definición para obtener datos de las ubicaciones
 * @package aztecaespectaculos.My.Model.Ubicacion
 * @author  Azteca Digital [JT]
 * @version 1.0.0
 */

/**
 * Definición de clase  para obtener datos de las ubicaciones
 * @package aztecaespectaculos.My.Model.Ubicacion
 * @author  Azteca Digital [JT]
 * @version 1.0.0
 */
class My_Model_Ubicaciones extends My_Db_TableAzteca implements My_Interface_Submodels{
    protected $_table   = 'ubicacion';
    protected $_primary = 'idUbicacion';

    public $_idEjeHome;
    public $_idProg;
    public $_idUbicacion;
    public $_elementos;
    public $_pagina;

    public function getDefault(){

    }
    
    /**
     * Instanciamos las clases y obtenemos los datos necesarios para el template
     * @param int $idTemplate
     */
    public function getUbicaciones($idTemplate, $modulo, $tPurgar=false, $sPurgar=false){
        $datos = array();
        $cache = Zend_Registry::getInstance()->cacheAdapter['programas'];
        $convierteUrl = new My_Model_UtileriasCadenas();

        /**** Obtenemos la version del cache ****/
        $utilities = new My_Model_Utilities_tortugaUtilities();
        if($this->_idProg == 10617 || $this->_idProg == 10621) {
            $nombreCacheGenerico = md5('ubicaciones-'.$idTemplate.'-'.$this->_idEjeHome.'-'.$this->_pagina);
        }else{
            $nombreCacheGenerico = md5('ubicaciones-'.$idTemplate.'-'.$this->_idEjeHome);
        }
        
        $versionCache = $utilities->vesionCache(md5($this->_idProg .'-1'), $tPurgar);

        $cache_clave = $nombreCacheGenerico.$versionCache.$this->_pagina;
        
        if($tPurgar == true)
        	echo "<!-- versionCache: $cache_clave  -  $versionCache -->";
        	
        if ($tPurgar == 'purgar')
        	$cache->remove ($cache_clave);
        
        if ($tPurgar==null)
        $datos = $cache->load($cache_clave);

        if(false == $datos){
            try {
            	
                $ubicaciones =  $this->getUbicacionesTemplate($idTemplate);
                
                if(count($ubicaciones) == 0)
                $ubicaciones = array(0=>array('idRelTemplateUbicacion'=>'0',
                							  'idTemplate'=>0,
                							  'idUbicacion'=>0,
                							  'cDescripcion'=>'UbicaGenerica',
                							  'iStatus'=>1,
                							  'cModel'=>'My_fail',
                							  'cMetodo'=>'fail',
                							  'cParametro'=>''
                		  		));
                
                foreach($ubicaciones as $row){
                    $datos[$convierteUrl->convierteUrl($row['cDescripcion'])]= $this->setClases(
                    $row['cModel'],
                    $row['cMetodo'],
                    $row['idUbicacion'],
                    $row['cParametro'], 
                    $modulo);
                }

                $HoraDelete    = Zend_Registry::get('main')->delete->cache->hora;
                $MinutoDelete  = Zend_Registry::get('main')->delete->cache->minuto;
                $SegundoDelete = Zend_Registry::get('main')->delete->cache->segundos;
                $TiempoCache   =  mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) - time(); //86400
                if($TiempoCache <= 0)
                $TiempoCache = (mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) + 86400) - time(); //86400
                $cache->setLifetime($TiempoCache);
                $cache->save($datos,$cache_clave);
            }catch (Exception $e) {
                if ($this->tPurgar) $msg = 'No es posible purgar, se mantienen los datos desde cache, getUbicaciones()';
                else throw new Exception('No fue posible obtener informaciónnnn de la base de datos, getUbicaciones()', 666);
				
            }
		}

		return $datos;
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
        
        if($nameclass !== null){
	        $obj = new $nameclass;
	        $obj->_idEjeHome   = $this->_idEjeHome;
            if(!empty($this->_elementos)){ $obj->_elementos = $this->_elementos; }
            if(!empty($this->_pagina)){ $obj->_pagina = $this->_pagina; }
	        $obj->_idUbicacion = $idUbicacion;
	        $obj->_modulo = $modulo;
	        $obj->_idProg = $this->_idProg;
	        if ($parametro == null || $parametro == '') {
	            return $obj->$namemethod();
	        } else {
	            return $obj->$namemethod($parametro);
	        }   
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
            break;
            case 'blogs':
                return 'My_Model_Blog';
            break;
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
            break;
            case 'blogs':
                return 'mostrar';
            break;
        }
    }
}