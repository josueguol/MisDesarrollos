<?php
/**
 * Archivo de definición de clase modelo
 *
 * @author AztecaAmerica JT
 * @package library.my.model.multimedia
 */

/**
 * Clase modelo para manipulación de utilidades de tortuga
 *
 * @author ?
 * @package library.my.model.Utilities
 */
class My_Model_Utilities_tortugaUtilities
{

	public static function getUsuariosFB(){
		/**
		 * Funcion para sacar el total de usuarios de Facebook
		 * return int
		 */
		$cache = Zend_Registry::getInstance()->cacheAdapter['programas'];
		$cache_clave = md5('userFBEsp');
		 
		ini_set('default_socket_timeout', 1);
		@$result = file_get_contents('https://graph.facebook.com/tvazteca');
		if ($result === false){
			$datos = $cache->load($cache_clave);
			$userFB = $datos;
		} else {


			$user = json_decode($result);
			$userFB = $user->likes;
			$cache->save($user->likes,$cache_clave);
		}
		return $userFB;
	}

	public static function getUsuariosTW(){
		/**
		 * Funcion para sacar el total de usuarios de Twitter
		 * return int
		 */
		$cache = Zend_Registry::getInstance()->cacheAdapter['programas'];
		$cache_clave = md5('userTWNot');

		ini_set('default_socket_timeout', 1);
		$xml=file_get_contents('http://api.twitter.com/1/users/show.xml?screen_name=tvaztecaoficial');
		if ($xml === false)
		{
			$datos = $cache->load($cache_clave);
			$userTW = $datos;
		} else {
			if (preg_match('/followers_count>(.*)</',$xml,$match)!=0) {
				$userTW = $match[1];
				$cache->save($userTW,$cache_clave);
			}
		}

		return $userTW;
	}

	/**
	 *Obtener version de cache
	 */
	public static function vesionCache($Url, $tPurgar=false){
		$cache = Zend_Registry::getInstance()->cacheAdapter['programasCache'];
		$cache_clavePurga = md5($Url.'-v1');
		$cachePurga = $cache->load($cache_clavePurga);
		if(false == $cachePurga || $tPurgar == true){
			if($cachePurga==false) $cachePurga = 1;
			if($tPurgar==1) $cachePurga++;
			$HoraDelete    = Zend_Registry::get('main')->delete->cache->hora;
			$MinutoDelete  = Zend_Registry::get('main')->delete->cache->minuto;
			$SegundoDelete = Zend_Registry::get('main')->delete->cache->segundos;
			$TiempoCache   =  mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) - time(); //86400
			if($TiempoCache <= 0){
				$TiempoCache =  (mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) + 86400) - time(); //86400
			}
			$cache->setLifetime($TiempoCache);
			$cache->save($cachePurga,$cache_clavePurga);
		}
		return 'vP'.$cachePurga;
	}

	/** 
	 * Calcula el tiempo restante a las 2:00 am para el cache 
	 */
    public static function setTimeCache(){
        $HoraDelete = Zend_Registry::get('main')->delete->cache->hora;
        $MinutoDelete = Zend_Registry::get('main')->delete->cache->minuto;
        $SegundoDelete = Zend_Registry::get('main')->delete->cache->segundos;
        date_default_timezone_set('America/Mexico_City');
        $TiempoCache =  mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) - time(); //86400
        if($TiempoCache <= 0){
            $TiempoCache =  (mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) + 86400) - time(); //86400
        }
        return $TiempoCache;
    }
    
    /**
     * 
     * Funcion que obtendra el numero de caracteres especificados de una cadena dada
     * @param string $texto
     * @param integer $numCaracteres
     */
    public static function cortarCadena($texto, $numCaracteres){
        $palabras = explode(' ', $texto);
        $maxCaract = $numCaracteres;
        $arrayTextPQA = array();
        $countCarc = 0; 
        $txtXLinea = '';
        $j=1; 
        for ($i=0; $i<count($palabras); $i++) {
            $countCarc = $countCarc + strlen($palabras[$i]) + 1;
            $saltoLine = explode( "\n", $palabras[$i]);
            if($countCarc > $maxCaract OR count($saltoLine) > 1){
                $countCarc = 0; 
                if(count($saltoLine) > 1){
                    $saltoLi = explode( "\n", $palabras[$i]);
                    $txtXLinea = $txtXLinea . " " . $saltoLi[0]; 
                }
                $arrayTextPQA[] = $txtXLinea;
                $txtXLinea = '';
                if(count($saltoLine) > 1){
                    $saltoLi = explode( "\n", $palabras[$i]);
                    $txtXLinea = $txtXLinea . " " . @$saltoLi[2]; 
                }
            }else{
                $txtXLinea = $txtXLinea . " " . $palabras[$i]; 
            }           
        }
        $var1 = count($arrayTextPQA);
        if($var1 > 0)
            return $arrayTextPQA[0].'...';     
        else
            return $texto;
    }
    
    public static function NuevaVesionCache($Url,$tPurgar){
        $cache = Zend_Registry::getInstance()->cacheAdapter['programasCache'];
		$cache_clavePurga = md5($Url.'-v1');
		if(!$cachePurga = $cache->load($cache_clavePurga)) {
			$cachePurga = 1;
			$HoraDelete = Zend_Registry::get('main')->delete->cache->hora;
		    $MinutoDelete = Zend_Registry::get('main')->delete->cache->minuto;
		    $SegundoDelete = Zend_Registry::get('main')->delete->cache->segundos;
		    $TiempoCache =  mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) - time(); //86400
	    	if($TiempoCache <= 0){
	        	$TiempoCache =  (mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) + 86400) - time(); //86400
			    //echo "el tiempo de cache ya esta caducado, el nuevo tiempo es de ".$TiempoCache;
	        }
	        $cache->setLifetime($TiempoCache);
	    	$cache->save($cachePurga,$cache_clavePurga);
		}
		if($tPurgar == true) {
			$cachePurga = $cachePurga + 1;
			$HoraDelete = Zend_Registry::get('main')->delete->cache->hora;
		    $MinutoDelete = Zend_Registry::get('main')->delete->cache->minuto;
		    $SegundoDelete = Zend_Registry::get('main')->delete->cache->segundos;
		    $TiempoCache =  mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) - time(); //86400
	    	if($TiempoCache <= 0){
	        	$TiempoCache =  (mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) + 86400) - time(); //86400
	        }
	        $cache->setLifetime($TiempoCache);
	    	$cache->save($cachePurga,$cache_clavePurga);
		}
        return 'versionPurga'.$cachePurga.' ====';
    }
    
    /**
     * Funcion para sacar la url rtmp de kaltura por medio de un entryId
     * return string
     */
    public static function rtmpIdKaltura($entryId, $flavorParamsId = 280271){
    	require_once('/webtva/webhost/tvazteca/htdocs/exampleKaltura2/libActualizado/KalturaClient.php');
    	$partnerId = Zend_Registry::get('main')->partnerId;
    	$secret = Zend_Registry::get('main')->secret;
    	$config = new KalturaConfiguration($partnerId);
    	$config->serviceUrl = Zend_Registry::get('main')->serviceUrl;
    	$client = new KalturaClient($config);
    	$userId = null;
    	$expiry = null;
    	$privileges = null;
    	$type = KalturaSessionType::ADMIN;
    	$ks = $client->session->start($secret, $userId, $type, $partnerId, $expiry, $privileges);
    	$client->setKs($ks);
    	$version = NULL;
    	try {
    		$id = '';
    		$results = $client-> flavorAsset ->getbyentryid($entryId);
    	 	foreach ($results as $key => $value) {
    			if($value->flavorParamsId == $flavorParamsId) 
    				$id = $value->id;
    		}
    		
    		if($flavorParamsId == 221801)
    			return $id;
    		
    		if($id != '') 
    			return 'http://cdnapi.kaltura.com/p/459791/sp/45979100/playManifest/entryId/'.$entryId.'/flavorId/'.$id.'/format/url/protocol/http/a.mp4?ks='.$ks;
    	} catch (Exception $e) { 
    		return 'Ocurrio algún error al conectarse con kaltura'; 
    	}
    }
    
    /**
     * Funcion para sacar los datos de un video de kaltura por medio de un entryId
     * return array
     */
    public static function entryIdKaltura($entryId){
    	require_once('/webtva/webhost/tvazteca/htdocs/exampleKaltura2/libActualizado/KalturaClient.php');
    	$partnerId = Zend_Registry::get('main')->partnerId;
    	$secret = Zend_Registry::get('main')->secret;
    	$config = new KalturaConfiguration($partnerId);
    	$config->serviceUrl = Zend_Registry::get('main')->serviceUrl;
    	$client = new KalturaClient($config);
    	$userId = null;
    	$expiry = null;
    	$privileges = null;
    	$type = KalturaSessionType::ADMIN;
    	$ks = $client->session->start($secret, $userId, $type, $partnerId, $expiry, $privileges);
    	$client->setKs($ks);
    	$version = NULL;
    	try {
    		return $client->baseEntry->get($entryId, $version);
    	} catch (Exception $e) { return ""; }
    }
    
    /**
     * convierte una fecha en 21 de Feb del 2012
     * @param $FechaHora
     */
	public static function comvierteFecha($FechaHora)
    {
        setlocale(LC_TIME,"spanish");
        $arrayMes = array(1=>'Ene',2=>'Feb',3=>'Mar', 4=>'Abr', 5=>'May', 6=>'Jun',
                          7=>'Jul',8=>'Ago',9=>'Sep',10=>'Oct',11=>'Nov',12=>'Dic');
        
        $dia = strftime("%d",strtotime($FechaHora));
        $mes = (int)strftime("%m",strtotime($FechaHora));
        $mes =  $arrayMes[$mes];
        $ani = strftime("%Y",strtotime($FechaHora));
        $hrs = strftime("%H",strtotime($FechaHora));
        $min = strftime("%M",strtotime($FechaHora));
        
        $fecha = $dia . ' de ' . $mes . ' del '.$ani ;
        
        return $fecha;
    }
    /**
     * convierte una fecha en 21 de Febrero del 2012
     * @param $FechaHora
     */
    public static function comvierteFechaMesLargo($FechaHora)
    {
    	$divideCadena=explode(" ", $FechaHora);
		$mes=array("January" =>"Enero","February" =>"Febrero","March" =>"Marzo","April" =>"Abril",
					"May" =>"Mayo","June" =>"Junio","July" =>"Julio","August" =>"Agosto",
					"September" =>"Septiembre","October" =>"Octubre","November" =>"Noviembre",
					"December" =>"Diciembre");
    
    	$dia =$divideCadena[0];
    	$mes = $mes[$divideCadena[2]];
    	$anio = $divideCadena[4];
    	    	
    	$fecha = $dia . ' de ' . $mes . ' del '.$anio ;
    	
    	return $fecha;
    }
    /**
     * Funcion que quita los acentos y reemplaza un caracter por el que se le indique
     * @param unknown_type $str -> texto
     * @param unknown_type $Tipospacer -> caracter a reemplazar
     * @param unknown_type $reemplazaCaracter -> por cual caracter lo quiero a reemplazar
     * @return mixed
     */
    function eliminar_acentos($str,$Tipospacer="null",$reemplazaCaracter=" "){
    	$a = array('À','Á','Â','Ã','Ä','Å','Æ','Ç','È','É','Ê','Ë','Ì','Í','Î','Ï','Ð','Ñ','Ò','Ó','Ô','Õ','Ö','Ø','Ù','Ú','Û','Ü','Ý','ß','à','á','â','ã','ä','å','æ','ç','è','é','ê','ë','ì','í','î','ï','ñ','ò','ó','ô','õ','ö','ø','ù','ú','�»','ü','ý','ÿ','Ā','ā','Ă','ă','Ą','ą','Ć','ć','Ĉ','ĉ','Ċ','ċ','Č','č','Ď','ď','Đ','đ','Ē','ē','Ĕ','ĕ','Ė','ė','Ę','ę','Ě','ě','Ĝ','ĝ','Ğ','ğ','Ġ','ġ','Ģ','ģ','Ĥ','ĥ','Ħ','ħ','Ĩ','ĩ','Ī','ī','Ĭ','ĭ','Į','į','İ','ı','Ĳ','ĳ','Ĵ','ĵ','Ķ','ķ','Ĺ','ĺ','�»','ļ','Ľ','ľ','Ŀ','ŀ','Ł','ł','Ń','ń','Ņ','ņ','Ň','ň','ŉ','Ō','ō','Ŏ','ŏ','Ő','ő','Œ','œ','Ŕ','ŕ','Ŗ','ŗ','Ř','ř','Ś','ś','Ŝ','ŝ','Ş','ş','Š','š','Ţ','ţ','Ť','ť','Ŧ','ŧ','Ũ','ũ','Ū','ū','Ŭ','ŭ','Ů','ů','Ű','ű','Ų','ų','Ŵ','ŵ','Ŷ','ŷ','Ÿ','Ź','ź','�»','ż','Ž','ž','ſ','ƒ','Ơ','ơ','Ư','ư','Ǻ','�»','Ǽ','ǽ','Ǿ','ǿ');
    	$b = array('A','A','A','A','A','A','AE','C','E','E','E','E','I','I','I','I','D','N','O','O','O','O','O','O','U','U','U','U','Y','s','a','a','a','a','a','a','ae','c','e','e','e','e','i','i','i','i','n','o','o','o','o','o','o','u','u','u','u','y','y','A','a','A','a','A','a','C','c','C','c','C','c','C','c','D','d','D','d','E','e','E','e','E','e','E','e','E','e','G','g','G','g','G','g','G','g','H','h','H','h','I','i','I','i','I','i','I','i','I','i','IJ','ij','J','j','K','k','L','l','L','l','L','l','L','l','l','l','N','n','N','n','N','n','n','O','o','O','o','O','o','OE','oe','R','r','R','r','R','r','S','s','S','s','S','s','S','s','T','t','T','t','T','t','U','u','U','u','U','u','U','u','U','u','U','u','W','w','Y','y','Y','Z','z','Z','z','Z','z','s','f','O','o','U','u','A','a','I','i','O','o','U','u','A','a','AE','ae','O','o');
    	if ($Tipospacer=="null")
    		return str_replace($a, $b, $str);//solo quitara los acentos
    	else
    		return str_replace($Tipospacer,$reemplazaCaracter, str_replace($a, $b, $str));//quita los acentos y reemplaza caracter segun se indique
    	
    }
    
    public static function comvierteUrl($string) {
    	$spacer = "-";
    	$string = str_replace("á","a",$string);
    	$string = str_replace("é","e",$string);
    	$string = str_replace("í","i",$string);
    	$string = str_replace("ó","o",$string);
    	$string = str_replace("ú","u",$string);
    	$string = str_replace("ñ","n",$string);
    	$string = str_replace("/","-",$string);
    	$string = str_replace("¿","-",$string);
    	$string = str_replace("?","-",$string);
    	$string = str_replace("¡","-",$string);
    	$string = str_replace("!","-",$string);
    	$string = str_replace("/","-",$string);
    	$string = str_replace("\"","-",$string);
    	$string = str_replace("'","",$string);
    	$string = str_replace('"','',$string);
    	$string = trim($string);
    	$string = strtolower($string);
    	$string = trim(preg_replace("[^ A-Za-z0-9_]", " ", $string));
    	$string = preg_replace("[ \t\n\r]", "-", $string);
    	$string = str_replace(" ", $spacer, $string);
    	$string = preg_replace("[ -]", "-", $string);
    	return $string;
    }
}
