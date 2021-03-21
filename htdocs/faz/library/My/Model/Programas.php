<?php
/**
 *Archivo de definición de model Programas
 * @package aztecaespectaculos.My.Model.Programas
 * @author  Azteca Digital [JT]
 * @version 1.0.0
 */

/**
 *Definición de model Programas
 * @package aztecaespectaculos.My.Model.Programas
 * @author  Azteca Digital [JT]
 * @version 1.0.0
 */
class My_Model_Programas extends My_Db_TableAzteca
{
    protected $_primary = "idPrograma";
    protected $_name    = "programas";

    /**
     *  QUERY OBTIENE LOS DATOS GENERALES DE PROGRAMA
     *  @param   string  programa
     *  @seccion int     seccion
     *  @return  array
     **/
    public function obtenerConfigPrograma($programa,$seccion){
        $sql="SELECT pro.idPrograma, wid.idWidget, pro.idSeccion, templ.idTemplate,
        			 pro.cUrl as programa,cHorario,cSinopsis,cFacebook,cTwitter,cRss,
        			 idMultimediaVideos,pro.cNombre,cRutaCss,cBgColor,img.cUrl as BackGenerico,
        			 img2.cUrl as cUrlLogo, img3.cUrl as cUrlPleca, ej.idWidget,ej.cTitulo,cMetaKeywords,
        			 cMetaDescripcion,idCertifica,cUrlArchivo,iTetris,idLayout,ej.idEje,cUrlFlash as urlFlashHome,flash.iWidth as FlashiWidth,
        			 flash.iHeight as FlashiHeight,ej.cEstilos as parametrosEstilos, fab.cDescripcion as fabricaDescripcion, 
        			 cDscCorta,ej.idPageAdserver, pro.cUrl,
        			 (SELECT cUrl
        				FROM imagenes
        			   WHERE idMultimediaImagenes = idImagen) as ImgBackPersonalizado,
        			 (SELECT cUrl
        				FROM imagenes
        			   WHERE idMultimediaImagenes = ej.idImagenBottom) as ImgBottomPersonalizado, cTextTemplate, s.cDescripcion, CONCAT('Azteca ', s.cDescripcion) AS tituloCanal  
        		FROM programas pro
        			 INNER JOIN eje ej on ej.idPrograma = pro.idPrograma
        			 INNER JOIN widget wid on wid.idWidget = ej.idWidget and wid.cLink = '".$seccion."'
        			 INNER JOIN templates templ on templ.idTemplate = ej.idTemplate
        			 LEFT JOIN estilos est on est.idPrograma = pro.idPrograma
        			 LEFT JOIN imagenes img on img.idMultimediaImagenes = est.idImagenBackground
        			 LEFT JOIN imagenes img2 on img2.idMultimediaImagenes = est.idImagenLogo
        			 LEFT JOIN imagenes img3 on img3.idMultimediaImagenes = est.idImagenPleca 
        			 LEFT JOIN seo seo on seo.idPrograma = pro.idPrograma
        			 LEFT JOIN multimediaFlash flash on flash.idMultimediaFlash = ej.idMultimediaFlash
        			 LEFT JOIN seccion s on s.idSeccion = pro.idSeccion 
        			 LEFT JOIN catFabricas fab on pro.idFabrica = fab.idFabrica
        	   WHERE pro.cUrl = '".$programa."' AND pro.idSeccion in (1,130) and pro.iStatus = 1 order by img.idImgOrigen desc limit 1";
        $stmt= $this->query($sql);       
        if(count($stmt) == 0 ) throw new Exception('No existe el programa o el programa esta desactivado.' ,  404);
        return $stmt;
    }

    /**
     *
     * Obtiene las categorias de los posibles items para los historicos
     * @param int $idPrograma
     */
    public function obtenerCategoriasXPrograma($idPrograma){
        $sql="SELECT cat.idCategoria,cDescripcion as cDescripcionCategorias
        FROM rel_categorias_programas relCat
        LEFT JOIN categorias cat on cat.idCategoria = relCat.idCategoria
        WHERE idPrograma = $idPrograma";
        $stmt = $this -> query($sql);
        return $stmt;
    }

    /**
     *
     * Enter description here ...
     * @param int $idEje
     */
    public function obtenerTitulosTemplatePrograma($idEje){
        $sql= "SELECT cAlias as cTituloTemplate1,cSubAlias as cTituloTemplate2
        FROM rel_eje_ubicacion
        WHERE idEje = $idEje";
        $stmt = $this-> query($sql);
        return $stmt;
    }
    
    /**
     * 
     * Obtenemos el cUrlArchivo default dependiedo del widget en cuestion
     * @param string $seccion
     * @param string $cUrlArchivo
     */
    public function obtenUrlTemplate($seccion, $cUrlArchivo, $iTetris, $datos) {
        //Ruta donde se encuentran los templates de cada widget
        $pos = stripos($cUrlArchivo, '/');
        $slash = ($pos != 0) ? '/' : '';
        $path = dirname(dirname(dirname(dirname(__FILE__)))).'/application/modules/default/views/scripts/index' . $slash;
        
        if 	   ($seccion == 'home' && $iTetris == 1 && $cUrlArchivo == null) { $cUrlArchivo = "homes/test.phtml"; }
        elseif ($seccion == 'home' && $iTetris == 2 && $cUrlArchivo == null) { $cUrlArchivo = "homes/test.phtml"; }
        elseif ($seccion == 'home' && $iTetris == 3 && $cUrlArchivo == null) { $cUrlArchivo = "homes/test.phtml"; }
        elseif ($seccion == 'home' && $iTetris == 4 && $cUrlArchivo == null) { $cUrlArchivo = "homes/test.phtml"; }
        elseif ($seccion == 'home' && $iTetris == 7 && $cUrlArchivo == null) { $cUrlArchivo = "homes/test.phtml"; }
        else {
            if    ($seccion == 'capitulos')  { $cUrlArchivo = (!file_exists($path . $cUrlArchivo)) ? 'capitulos/capitulos.phtml' : $cUrlArchivo; }
            elseif($seccion == 'notas')      { $cUrlArchivo = (!file_exists($path . $cUrlArchivo)) ? 'notas/notaNuevo.phtml' : $cUrlArchivo; }
            elseif($seccion == 'galerias')   { $cUrlArchivo = (!file_exists($path . $cUrlArchivo)) ? 'galerias/galeriasMootoolsSinExtras.phtml' : $cUrlArchivo; }
            elseif($seccion == 'perfil')     { $cUrlArchivo = (!file_exists($path . $cUrlArchivo)) ? 'perfiles/perfilesV1.phtml' : $cUrlArchivo; }
            elseif($seccion == 'videos')     { $cUrlArchivo = (!file_exists($path . $cUrlArchivo)) ? 'videos/videos.phtml' : $cUrlArchivo; }
            elseif($seccion == 'home')       { $cUrlArchivo = (!file_exists($path . $cUrlArchivo)) ? 'homes/test.phtml' : $cUrlArchivo; }
            elseif($seccion == 'uploadfile') { $cUrlArchivo = (!file_exists($path . $cUrlArchivo)) ? 'uploadfile/uploadfile.phtml' : $cUrlArchivo; }
        }
        
        return $cUrlArchivo;
    }
    
    /**
     * 
     * Obtenemos el id del template default dependiendo del widget en cuestion
     * @param string $seccion
     */
    public function  obtenIdTemplate($seccion, $idTemplate, $cUrlArchivo) {
        //Ruta donde se encuentran los templates de cada widget
        $path = dirname(dirname(dirname(dirname(__FILE__)))).'/application/modules/default/views/scripts/index/';
        //Id de templates default por widget  
        if($seccion == 'capitulos') { $idTemplate = (!file_exists($path . $cUrlArchivo)) ? 254 : $idTemplate; }
        elseif($seccion == 'notas') { $idTemplate = (!file_exists($path . $cUrlArchivo)) ? 249 : $idTemplate; }
        elseif($seccion == 'galerias') { $idTemplate = (!file_exists($path . $cUrlArchivo)) ? 125 : $idTemplate; } 
        elseif($seccion == 'perfil') { $idTemplate = (!file_exists($path . $cUrlArchivo)) ? 56 : $idTemplate; } 
        elseif($seccion == 'videos') { $idTemplate = (!file_exists($path . $cUrlArchivo)) ? 253 : $idTemplate; }
        elseif($seccion == 'uploadfile') { $idTemplate = (!file_exists($path . $cUrlArchivo)) ? 308 : $idTemplate; }
        return $idTemplate;
    }
    
    /**
     * 
     * Obtenemos el id del programa a partir del nombre de este
     * @param string $cNombre
     */
    public function getIdProgramByName($cNombre) {
        $sql = "SELECT idPrograma FROM programas WHERE cNombre = '" . addslashes($cNombre) . "' AND iStatus = 1 ORDER BY 1 DESC LIMIT 1";
        $stmt= $this->query($sql);
        return (count($stmt) == 0 ) ? 0 : $stmt[0]['idPrograma'];
    }
    
    /**
     *
     * Obtenemos el id del programa a partir de la url de este
     * @param string $urlName
     */
    public function getIdProgramByUrlName($urlName) {
    	$sql = "SELECT idPrograma FROM programas WHERE cUrl = '" . addslashes($urlName) . "' AND iStatus = 1 AND idSeccion IN (1,10,101,104) ORDER BY 1 DESC LIMIT 1";
    	$stmt= $this->query($sql);
    	return (count($stmt) == 0 ) ? 0 : $stmt[0]['idPrograma'];
    }
    
    /**
     * 
     * Obtiene la informacion de un programa a partir del id del mismo
     * @param integer $idPrograma
     */
    public function getPrograma($idPrograma){
        $sql =  "SELECT idPrograma, cNombre, cUrl, cHorario, iStatus, iProgramaTV FROM programas WHERE idPrograma = {$idPrograma}";
        $programas = $this-> query($sql);
        return $programas;
    }
    
    public function listaProgramas($idSeccion,$order="cNombre"){
    	if($order!="cNombre")
    		$order = "iOrden, cNombre";
    		
    	$sql = "select * from ((SELECT
    	s.idSeccion, s.cDescripcion as Seccion, f.idFabrica, f.cDescripcion as Fabrica, p.cNombre, p.cUrl, p.iDestacar, iOrden
    	FROM programas p
    	INNER JOIN seccion s ON p.idSeccion = s.idSeccion
    	INNER JOIN catFabricas f ON p.idFabrica = f.idFabrica
    	WHERE p.idSeccion IN ($idSeccion) AND p.iStatus = 1 AND p.iProgramaTv = 1 AND s.iStatus = 1 AND f.iStatus = 1)
    	UNION
    	(SELECT
    	s.idSeccion, s.cDescripcion, C.idExtrasMenusCategorias, C.cDescripcion, I.cTitulo, I.cUrl, '0' , C.iOrden
    	FROM extrasMenusItems I
    	INNER JOIN extrasMenusCategorias C ON I.idExtrasMenusCategorias = C.idExtrasMenusCategorias
    	INNER JOIN seccion s ON C.idSeccion = s.idSeccion
    	WHERE C.idSeccion IN ($idSeccion))) as t
    	ORDER BY $order";
    
    	return $this->query($sql);
    }
    
    public function getIdsBySeccion($idFabrica) {
    	$sql = "SELECT p.idPrograma FROM programas p JOIN seccion s ON p.idSeccion = s.idSeccion JOIN estilos e ON p.idPrograma = e.idPrograma 
 					 WHERE p.idFabrica = 1 AND p.iStatus = 1 AND p.idSeccion IN (1,10) ORDER BY cNombre ASC;";
    	return $this->query($sql);
    }
    
    /**
     * Regresa datos del programa al que pertenese video, nota o galeria.
     * 
     * @param INT $idContenido
     * @param INT $tipContenido
     */
    public function getNomProgporContenido($idContenido, $tipContenido){
    	SWITCH ($tipContenido){
    		CASE 'video':
    		CASE 'v':
    			$idTipo = 2;
    			break;
    		CASE 'capitulo':
    		CASE 'c':
    			$idTipo = 2;
    			break;
    		CASE 'nota':
    		CASE 'n':
    			$idTipo = 3;
    			break;
    		CASE 'galeria':
    		CASE 'g':
    			$idTipo = 4;
    			break;
    		default:
				$idTipo = 0;
    	}
    	
        if($idTipo != 0 ){
        	$sql = "SELECT p.idPrograma, p.idSeccion,cNombre, p.iStatus, p.cDscCorta, p.cUrl, p.cHorario, 
    					   p.cSinopsis, p.cFacebook, p.cTwitter, p.idFabrica, p.iProgramaTv,
    					   b.dtFechaEvento as dtContenido, b.cCategorias,b.cReporteros,
    					   (SELECT cDescripcion FROM categorias c WHERE idCategoria in (b.cCategorias) LIMIT 1 ) as categoria
    				  FROM busqueda b 
    					   INNER JOIN programas p ON b.idPrograma = p.idPrograma 
        			 WHERE idTipoWidget = {$idTipo} AND idWidget =  {$idContenido} 
        		     LIMIT 1;";    	
            return $this->query($sql);
    	}else{
   	        return array();    	
    	}
    	
    }
    
    /**
     * Regresa el idfabrica de un programa
     *
     * @param String $cUrl
     */
    public function getIdFabrica($cUrl,$ePurgar){
    	$cache      = Zend_Registry::getInstance()->cacheAdapter['programas'];
    	$cacheClave = md5("idSeccionAztecaCom-$cUrl");
    	$datos = $cache->load($cacheClave);
    	// Si no hay datos en caché generarlos
    	if(false === $datos || $ePurgar == true){
    		$cols = array('idFabrica','idPrograma','cNombre','cUrl','iResponsive');
    		$condicion=" cUrl='".$cUrl."' and iStatus='1'";
    		$resultado = $this->select()->from('programas',$cols)->where($condicion);
    		$result=$resultado->query()->fetchAll();
    		$datos = $result[0];
    		$HoraDelete    = Zend_Registry::get('main')->delete->cache->hora;
    		$MinutoDelete  = Zend_Registry::get('main')->delete->cache->minuto;
    		$SegundoDelete = Zend_Registry::get('main')->delete->cache->segundos;
    		$TiempoCache =  mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) - time(); //86400
    		if ($TiempoCache <= 0){
    			$TiempoCache =  (mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) + 86400) - time(); //86400
    		}
    		$cache->setLifetime($TiempoCache);
    		$cache->save($datos,$cacheClave);
    	}
    	return $datos;
    }
    
    /**
     * Regresa el iResponsive de un programa
     *
     * @param String 0/1
     */
    public function getResponsive($cUrl,$cUrlTemporada,$ePurgar){
        $cache      = Zend_Registry::getInstance()->cacheAdapter['programas'];
        $cacheClave = md5("idResponsiveAztecaTrece-$cUrl-$cUrlTemporada");
        $datos = $cache->load($cacheClave);
        // Si no hay datos en caché generarlos
        if(false === $datos || $ePurgar == true){
            $sql = "SELECT iResponsive FROM programas p where idPrograma = (SELECT idPrograma FROM agrupadorTemporadas a where cUrlAgrupador = 'laislaelreality' and cUrlTemporada = 'revancha' limit 1) limit 1;";
            $result =  $this->query($sql);
            $datos = $result[0];
            $HoraDelete    = Zend_Registry::get('main')->delete->cache->hora;
            $MinutoDelete  = Zend_Registry::get('main')->delete->cache->minuto;
            $SegundoDelete = Zend_Registry::get('main')->delete->cache->segundos;
            $TiempoCache =  mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) - time(); //86400
            if ($TiempoCache <= 0){
                $TiempoCache =  (mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) + 86400) - time(); //86400
            }
            $cache->setLifetime($TiempoCache);
            $cache->save($datos,$cacheClave);
        }
        return $datos;
    }
}