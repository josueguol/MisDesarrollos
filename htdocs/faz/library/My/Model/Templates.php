<?php
/**
 * Archivo de definición de model para obtener datos de ubicacion generica
 * @package aztecaespectaculos.My.Model.UbicacionGenerica
 * @author  Azteca Digital [JT]
 * @version 1.0.0
 */

/**
 * Definición de model  para obtener datos de ubicacion generica
 * @package aztecaespectaculos.My.Model.UbicacionGenerica
 * @author  Azteca Digital [JT]
 * @version 1.0.0
 */
class My_Model_Templates extends My_Db_TableAzteca implements My_Interface_Submodels{
	protected $_table   = 'templates';
	protected $_primary = 'idTemplate';
	
	public function getDefault(){}
	
	/**
	 * Funcion para obtener los datos del template en modo horizontal
	 * [EPG] 2013/05/14
	 */
	public function datosHorizontal($idPrograma, $idTemplate, $tPurgar = false, $ePurgar = false){
		
		$cache = Zend_Registry::getInstance()->cacheAdapter['programas'];
		
		$modelContenidoHome           = new My_Model_ContenidoHome();
		$modelSettingsContenidoPiezas = new My_Model_SettingsContenidoPiezas();
		$modelPrincipalesHome         = new My_Model_PrincipalesHome();
		$utilities 					  = new My_Model_Utilities_tortugaUtilities();
		
		// Caché 01 
		$nCache01   = md5('DatosBAsicos'. $idPrograma .$idTemplate);
		$verCache01 = $utilities->vesionCache($nCache01, $ePurgar);
		$cacheKey01 = $nCache01.$verCache01;
		$datos01    = $cache->load($cacheKey01);
		
		if(false==$datos01 || $ePurgar==true) {
		
			$datosTemplate = $this->datosBasicos($idPrograma);
			$sql     = "SELECT idTemplate, cDescripcion, cPrincipal 
			              FROM templates 
			             WHERE idTemplate = $idTemplate";
			$result1 = $this->query($sql);
		
			$sql = "SELECT vp.idValoresPropiedades, vp.idPiezas, GROUP_CONCAT(vp.idPropiedadesPiezas ORDER BY vp.idPropiedadesPiezas ASC) AS idPropiedadesPiezas, 
						   GROUP_CONCAT(vp.cValor ORDER BY vp.idPropiedadesPiezas ASC) AS cValores, vp.iColumna, 
			               vp.iOrden, p.cNombre, p.iColumnas, IF(p.iExpandible=1,'unlocked','locked') AS height, p.cColor
		              FROM valoresPropiedades vp
	                 	   LEFT JOIN piezas p ON vp.idPiezas = p.idPiezas
	                 WHERE idTemplate = $idTemplate
	                 GROUP BY iOrden, iColumna
	                 ORDER BY iColumna, iOrden ASC";
			$result2 = $this->query($sql);
			
			$datos01['datosTemp'] = $datosTemplate;
			$datos01['id']   	  = $result1[0]['idTemplate'];;
			$datos01['name']      = $result1[0]['cDescripcion'];
			$datos01['main']      = $result1[0]['cPrincipal'];
			$datos01['result2']   = $result2;

			$HoraDelete    = Zend_Registry::get('main')->delete->cache->hora;
			$MinutoDelete  = Zend_Registry::get('main')->delete->cache->minuto;
			$SegundoDelete = Zend_Registry::get('main')->delete->cache->segundos;
			$TiempoCache   =  mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) - time(); //86400
			if($TiempoCache <= 0)
				$TiempoCache = (mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) + 86400) - time(); //86400
			$cache->setLifetime($TiempoCache);
			$cache->save($datos01,$cacheKey01);
		}
		
		//Caché Fechas de Publicacion
		$nCacheFP   = md5('FechaPublicacion'.$idPrograma.$idTemplate);
		$verCacheFP = $utilities->vesionCache($nCacheFP, $tPurgar);
		$cacheKeyFP = $nCacheFP.$verCacheFP;
		$dtFP       = $cache->load($cacheKeyFP);
		
		if (false ===$dtFP || $tPurgar==true) {
			$dtFP = $modelContenidoHome->getFechaPublicacion($datos01['datosTemp']['idEje']);
			$HoraDelete    = Zend_Registry::get('main')->delete->cache->hora;
			$MinutoDelete  = Zend_Registry::get('main')->delete->cache->minuto;
			$SegundoDelete = Zend_Registry::get('main')->delete->cache->segundos;
			$TiempoCache   =  mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) - time(); //86400
			if($TiempoCache <= 0)
				$TiempoCache = (mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) + 86400) - time(); //86400
			$cache->setLifetime($TiempoCache);
			$cache->save($dtFP,$cacheKeyFP);
		}

		$date   = date('Y-m-d H:i:s');
		$entrada_unix = strtotime($date);
		$dFePu  = "";
		foreach ($dtFP as $k => $v) {
			$guardada_unix = strtotime($v["dFechaPublicacion"]);
			if ($entrada_unix >= $guardada_unix) $dFePu = $v["dFechaPublicacion"];
		}
		if ($dFePu == "") $dFePu = "0000-00-00 00:00";
		$datosTemplate = $datos01['datosTemp'];
		$datos['id']   = $datos01['id'];
		$datos['name'] = $datos01['name'];
		$datos['main'] = $datos01['main'];
		$result        = $datos01['result2'];
		
		foreach($result as $key => $val){
			$titleWidget = "";
			$moreLink    = "";
			//Cargo los settings de la pieza
			$config = $modelSettingsContenidoPiezas->cargaSettings($datosTemplate['idEje'], $val['idValoresPropiedades'], $ePurgar);
			if($config==null) $config = array();
			$arrSpecialConf = array();
			foreach ($config as $key => $values) {
				switch ($values['idStng']) {
					case 10: $arrSpecialConf['titleWidget']       = $values['value']; break;//Texto encabezado;
					case 12: $arrSpecialConf['titleWidgetMore']   = $values['value']; break;//Texto encabezado Ver mas;
					case 13: $arrSpecialConf['moreLink']          = $values['value']; break;//Liga Ver mas;
					case 14: $arrSpecialConf['typeContent']       = $values['value']; break;//Tipo contenido Manual o Automatico;
					case 15: $arrSpecialConf['categoryContent']   = $values['value']; break;//Categoria de tipo de contenido automatico;
					case 16: $arrSpecialConf['typeContentAuto']   = $values['value']; break;//Tipo de contenido que se eligio n,g,v;
					case 17: $arrSpecialConf['srcIframe']         = $values['value']; break;//src Iframe;
					case 18: $arrSpecialConf['heightIframe']      = $values['value']; break;//height Iframe
					case 19: $arrSpecialConf['idWidgetTT']        = $values['value']; break;//idWidgetTT
					case 20: $arrSpecialConf['iframeInstagram']   = $values['value']; break;//Iframe Instagram
					case 21: $arrSpecialConf['fanPage']           = $values['value']; break;//Iframe Instagram
					case 22: $arrSpecialConf['contentText']       = $values['value']; break;//Content Text
					case 23: $arrSpecialConf['cModel']            = $values['value']; break;//Model Ubicacion
					case 24: $arrSpecialConf['cMetodo']           = $values['value']; break;//Metodo Ubicacion
					case 25: $arrSpecialConf['cParametro']        = $values['value']; break;//Parametro Ubicacion
					case 26: $arrSpecialConf['secondTitleWidget'] = $values['value']; break;//Título secundario
					case 27: $arrSpecialConf['cLogo']             = $values['value']; break;//Logo
					case 28: $arrSpecialConf['cFacebook']         = $values['value']; break;//Facebook
					case 29: $arrSpecialConf['cTwitter']          = $values['value']; break;//Twitter
					case 30: $arrSpecialConf['cInstagram']        = $values['value']; break;//Instagram
					case 31: $arrSpecialConf['bMute']             = $values['value']; break;//Mute
					case 32: $arrSpecialConf['cUrlVerMas']        = $values['value']; break;//Ver más
					case 33: $arrSpecialConf['cMostrarTeaser']    = $values['value']; break;//Mostrar Teaser
					case 34: $arrSpecialConf['cColorBarra']       = $values['value']; break;//Color de la barra
					case 35: $arrSpecialConf['cColorBoton']       = $values['value']; break;//Color de botones
					case 36: $arrSpecialConf['cColorFlechas']     = $values['value']; break;//Color Flechas
					case 37: $arrSpecialConf['cTipoLetra']        = $values['value']; break;//Letra
					case 38: $arrSpecialConf['cRedondeaBorde']    = $values['value']; break;//Redondear bordes
					case 39: $arrSpecialConf['cAutoplay']         = $values['value']; break;//autoplay
					case 40: $arrSpecialConf['cAdTag']            = $values['value']; break;//AdTag
					case 41: $arrSpecialConf['cUrchin']           = $values['value']; break;//urchin
					case 42: $arrSpecialConf['cUiconf']           = $values['value']; break;//uiconf
					case 43: $arrSpecialConf['cPleca']            = $values['value']; break;//pleca
					case 44: $arrSpecialConf['cFormatoTexto']     = $values['value']; break;//Texto con formato
					case 45: $arrSpecialConf['cFeed']             = $values['value']; break;//Feed de transmision - entryId
// 					case 46: $arrSpecialConf['cIdPoll']           = $values['value']; break;//Id encuesta
					case 49: $arrSpecialConf['cUrlBackPieza']       = $values['value']; break;//Url para imagen de modulo (pieza)
					case 50: $arrSpecialConf['cBotonVerSecundario'] = $values['value']; break;//Boton ver mas secundario
					case 51: $arrSpecialConf['cTituloBotonVerSecundario'] = $values['value']; break;//Titulo boton ver mas secundario
					case 52: $arrSpecialConf['cUrlBotonVerSecundario']    = $values['value']; break;//Url boton ver mas secundario
					case 53: $arrSpecialConf['cBannerINE']        = $values['value']; break;//Mostrar banners de INE
					case 54: $arrSpecialConf['bCarruselFull']     = $values['value']; break;//Mostrar Carrusel en modo full
					case 55: $arrSpecialConf['bMuestraBack']      = $values['value']; break;//Mostrar back para carrusel (pieza)
					case 56: $arrSpecialConf['bContDobleUno']     = $values['value']; break;//Mostrar primera posicion de contenido doble
					case 57: $arrSpecialConf['cContDobleDos']     = $values['value']; break;//Mostrar segunda posicion de contenido doble
					case 58: $arrSpecialConf['cContDobleTres']    = $values['value']; break;//Mostrar tercera posicion de contenido doble
					case 59: $arrSpecialConf['cRedSocialUno']     = $values['value']; break;//Nombre y url de red social 1
					case 60: $arrSpecialConf['cRedSocialDos']     = $values['value']; break;//Nombre y url de red social 2
					case 61: $arrSpecialConf['cRedSocialTres']    = $values['value']; break;//Nombre y url de red social 3
					case 62: $arrSpecialConf['cUrlJsonProg']      = $values['value']; break;//Url Json de programacion
					case 68: $arrSpecialConf['cUrlJsonProgAMas']  = $values['value']; break;//Url Json de programacion de A+
					case 69: $arrSpecialConf['cUrlJsonProgADN40'] = $values['value']; break;//Url Json de programacion de ADN40
				}
			}
			
			$datosConfig['pieza']    = $val['idPiezas'];
			$datosConfig['content']  = isset($arrSpecialConf['typeContent'])     ? $arrSpecialConf['typeContent']     : "";
			$datosConfig['category'] = isset($arrSpecialConf['categoryContent']) ? $arrSpecialConf['categoryContent'] : "";
			$datosConfig['type']     = isset($arrSpecialConf['typeContentAuto']) ? $arrSpecialConf['typeContentAuto'] : "";
			///////////MEMCACHE T = PURGAR
			
			
			// ============================== Caché  PIEZAS  31, 31, 32 y Default ==============================
			$nCache001   = md5($dFePu.'ContenidoExtras'.@$idPrograma.@$idTemplate.@$val['idValoresPropiedades'].@$datosTemplate['idEje'].@$arrSpecialConf['cModel'].@$arrSpecialConf['cMetodo']. @$idUbicacion. @$arrSpecialConf['cParametro']. @$modulo);
			$verCache001 = $utilities->vesionCache($nCache001, $tPurgar);
			$cacheKey001 = $nCache001.$verCache001;
			$data       = $cache->load($cacheKey001);
			
			if (false ===$data || $tPurgar==true) {
	    		//Cargamos el contenido de la pieza
	    		switch($val['idPiezas']){
	    			case "30": case "31": case  "32":
	    				$data = $this->setClases($arrSpecialConf['cModel'], $arrSpecialConf['cMetodo'], $idUbicacion, $arrSpecialConf['cParametro'], $modulo);
	    				break;
	    			default:
	    				$data = $modelContenidoHome->cargaContenido($datosTemplate['idEje'], $val['idValoresPropiedades'], $dFePu, $datosConfig, $idPrograma, $tPurgar);
	    		}
	    		
	    		if (($val['idPiezas'] == '69' || $val['idPiezas'] == '75')) {
	    		    if (isset($arrSpecialConf['cUrlJsonProg']) && $arrSpecialConf['cUrlJsonProg'] != null) {
	    		        if ($arrSpecialConf['titleWidget'] == 'adn40') {
	    		            $data = $modelContenidoHome->cargaContenidoADN40FromJson($arrSpecialConf['cUrlJsonProg'], 0, $tPurgar);
	    		        } else {
	    		            $data = $modelContenidoHome->cargaContenidoFromJson($arrSpecialConf['cUrlJsonProg'], $tPurgar);
	    		        }
	    		    }
	    		}
	    		
	    		
	    		if($data==null) $data = array();
	
	    		
	    		$HoraDelete    = Zend_Registry::get('main')->delete->cache->hora;
	    		$MinutoDelete  = Zend_Registry::get('main')->delete->cache->minuto;
	    		$SegundoDelete = Zend_Registry::get('main')->delete->cache->segundos;
	    		$TiempoCache   =  mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) - time(); //86400
	    		if($TiempoCache <= 0)
	    			$TiempoCache = (mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) + 86400) - time(); //86400
	    		$cache->setLifetime($TiempoCache);
	    		$cache->save($data,$cacheKey001);
	    		
			}
			// ==================================================================================================
		
			
			if($val['idPropiedadesPiezas']==0){
				$datos['body'][] = array("idValoresPropiedades"=>$val['idValoresPropiedades'],"id"=>$val['idPiezas'],"name"=>$val['cNombre'], "cols" => $val['iColumnas'], "height" => $val['height'], "color" => $val['cColor'], "settings" => array(), 'data' => $data, 'config' => $config, "arrSpecialConf" => $arrSpecialConf);
			} else {
				$settings = null;
		        $idPropiedades = explode(",", $val['idPropiedadesPiezas']);
		        $valores = explode(",", $val['cValores']);
		        foreach($idPropiedades as $k => $v) {
		            $settings[] = array("id"=>$idPropiedades[$k],"value"=>$valores[$k]);
		            if ($idPropiedades[$k] == 6) $arrSpecialConf['especial'] = $valores[$k]; //Modulo especial, configuracion template
		        }
		        $datos['body'][] = array("idValoresPropiedades"=>$val['idValoresPropiedades'],"id"=>$val['idPiezas'],"name"=>$val['cNombre'], "cols" => $val['iColumnas'], "height" => $val['height'], "color" => $val['cColor'], "settings" => $settings, 'data' => $data, 'config' => $config, "arrSpecialConf" => $arrSpecialConf);
		    }
		}
	
		$datos['mainItems'] = array('mainType'=> $datos['main'],'items'=> $modelPrincipalesHome->mainItems($datosTemplate['idEje'], $dFePu, $tPurgar));
		
		
		// Caché 02
		$nCache02   = md5('DatosBAsicos2'. $idPrograma .$idTemplate);
		$verCache02 = $utilities->vesionCache($nCache02, $tPurgar);
		$cacheKey02 = $nCache02.$verCache02;
		$datos02    = $cache->load($cacheKey02);
		
		if(false==$datos02 || $tPurgar==true) {
			$datos02['infoPlaylist'] = array();
			$datos02['auxDatos'] = array();
			foreach ($result as $k => $v) {
			}
			
			$HoraDelete    = Zend_Registry::get('main')->delete->cache->hora;
			$MinutoDelete  = Zend_Registry::get('main')->delete->cache->minuto;
			$SegundoDelete = Zend_Registry::get('main')->delete->cache->segundos;
			$TiempoCache   =  mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) - time(); //86400
			if($TiempoCache <= 0)
				$TiempoCache = (mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) + 86400) - time(); //86400
			$cache->setLifetime($TiempoCache);
			$cache->save($datos02,$cacheKey02);		
		}
		$auxDatos      = $datos02['auxDatos'];
		$datos['infoPlaylist'] = $datos02['infoPlaylist'];
		
		
		foreach ($datos['body'] as $key => $value) {
		}
		
		return $datos;
	}
	
	/**
	 * Funcion para obtener los datos del template mixto 2x1
	 * [EPG] 2013/05/15
	 */
	public function datosMixto($idPrograma, $idTemplate, $tPurgar = false, $ePurgar = false){
		
		$cache = Zend_Registry::getInstance()->cacheAdapter['programas'];
			
		$modelSettingsContenidoPiezas = new My_Model_SettingsContenidoPiezas();
		$modelContenidoHome           = new My_Model_ContenidoHome();
		$modelPrincipalesHome         = new My_Model_PrincipalesHome();
		$utilities 					  = new My_Model_Utilities_tortugaUtilities();
		
	
		// Caché 01
		$nCache01   = md5('DatosBAsicos'. $idPrograma .$idTemplate);
		$verCache01 = $utilities->vesionCache($nCache01, $ePurgar);
		$cacheKey01 = $nCache01.$verCache01;
		$datos01    = $cache->load($cacheKey01);
		
		if(false==$datos01 || $ePurgar==true) {
			
			$datosTemplate = $this->datosBasicos($idPrograma);
			$sql = "SELECT idTemplate, cDescripcion, cPrincipal 
			          FROM templates 
			         WHERE idTemplate = $idTemplate";
			$result1 = $this->query($sql);
	
			$sql    = "SELECT vp.idValoresPropiedades, vp.idPiezas, GROUP_CONCAT(vp.idPropiedadesPiezas ORDER BY vp.idPropiedadesPiezas ASC) AS idPropiedadesPiezas, 
			                 GROUP_CONCAT(vp.cValor ORDER BY vp.idPropiedadesPiezas ASC) AS cValores, vp.iColumna, vp.iOrden, p.cNombre, p.iColumnas, 
			                 IF(p.iExpandible=1,'unlocked','locked') AS height, p.cColor
					    FROM valoresPropiedades vp
						     LEFT JOIN piezas p ON vp.idPiezas = p.idPiezas
					   WHERE idTemplate = $idTemplate
					   GROUP BY iOrden, iColumna
					   ORDER BY iColumna, iOrden ASC";
			
			$result2 = $this->query($sql);
			
			$datos01['datosTemp'] = $datosTemplate;
			$datos01['id']   	  = $result1[0]['idTemplate'];;
			$datos01['name']      = $result1[0]['cDescripcion'];
			$datos01['main']      = $result1[0]['cPrincipal'];
			$datos01['result2']   = $result2;
			
	
			$HoraDelete    = Zend_Registry::get('main')->delete->cache->hora;
			$MinutoDelete  = Zend_Registry::get('main')->delete->cache->minuto;
			$SegundoDelete = Zend_Registry::get('main')->delete->cache->segundos;
			$TiempoCache   =  mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) - time(); //86400
			if($TiempoCache <= 0)
				$TiempoCache = (mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) + 86400) - time(); //86400
			$cache->setLifetime($TiempoCache);
			$cache->save($datos01,$cacheKey01);
		}
		
		//Caché Fechas de Publicacion
		$nCacheFP   = md5('FechaPublicacion'.$idPrograma.$idTemplate);
		$verCacheFP = $utilities->vesionCache($nCacheFP, $tPurgar);
		$cacheKeyFP = $nCacheFP.$verCacheFP;
		$dtFP       = $cache->load($cacheKeyFP);
		
		if (false ===$dtFP || $tPurgar==true) {
			$dtFP = $modelContenidoHome->getFechaPublicacion($datos01['datosTemp']['idEje']);
			$HoraDelete    = Zend_Registry::get('main')->delete->cache->hora;
			$MinutoDelete  = Zend_Registry::get('main')->delete->cache->minuto;
			$SegundoDelete = Zend_Registry::get('main')->delete->cache->segundos;
			$TiempoCache   =  mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) - time(); //86400
			if($TiempoCache <= 0)
				$TiempoCache = (mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) + 86400) - time(); //86400
			$cache->setLifetime($TiempoCache);
			$cache->save($dtFP,$cacheKeyFP);
		}
		
		$date   = date('Y-m-d H:i:s');
		$entrada_unix = strtotime($date);
		$dFePu  = "";
		foreach ($dtFP as $k => $v) {
			$guardada_unix = strtotime($v["dFechaPublicacion"]);
			if ($entrada_unix >= $guardada_unix) $dFePu = $v["dFechaPublicacion"];
		}
		if ($dFePu == "") $dFePu = "0000-00-00 00:00";
		$datosTemplate = $datos01['datosTemp'];
		$datos['id']   = $datos01['id'];
		$datos['name'] = $datos01['name'];
		$datos['main'] = $datos01['main'];
		$result        = $datos01['result2'];
		
		foreach($result as $key => $val){
			$titleWidget = "";
			$moreLink    = "";
			//Cargo los settings de la pieza
			$config = $modelSettingsContenidoPiezas->cargaSettings($datosTemplate['idEje'], $val['idValoresPropiedades'], $ePurgar);
			if($config==null) $config = array();
			$arrSpecialConf = array();
			foreach ($config as $key => $values) {
				switch ($values['idStng']) {
					case 10: $arrSpecialConf['titleWidget']     = $values['value']; break;//Texto encabezado break;
					case 12: $arrSpecialConf['titleWidgetMore'] = $values['value']; break; //Texto encabezado Ver mas;
					case 13: $arrSpecialConf['moreLink']        = $values['value']; break;//Liga Ver mas;
					case 14: $arrSpecialConf['typeContent']     = $values['value']; break;//Tipo contenido Manual o Automatico;
					case 15: $arrSpecialConf['categoryContent'] = $values['value']; break;//Categoria de tipo de contenido automatico;
					case 16: $arrSpecialConf['typeContentAuto'] = $values['value']; break;//Tipo de contenido que se eligio n,g,v;
					case 17: $arrSpecialConf['srcIframe']       = $values['value']; break;//src Iframe;
					case 18: $arrSpecialConf['heightIframe']    = $values['value']; break;//height Iframe
					case 19: $arrSpecialConf['idWidgetTT']      = $values['value']; break;//idWidgetTT
					case 20: $arrSpecialConf['iframeInstagram'] = $values['value']; break;//Iframe Instagram
					case 21: $arrSpecialConf['fanPage']         = $values['value']; break;//Iframe Instagram
					case 22: $arrSpecialConf['contentText']     = $values['value']; break;//Content Text
					case 23: $arrSpecialConf['cModel']          = $values['value']; break;//Model Ubicacion
					case 24: $arrSpecialConf['cMetodo']         = $values['value']; break;//Metodo Ubicacion
					case 25: $arrSpecialConf['cParametro']      = $values['value']; break;//Parametro Ubicacion
				}
			}
				
			$datosConfig['pieza']    = $val['idPiezas'];
			$datosConfig['content']  = isset($arrSpecialConf['typeContent'])     ? $arrSpecialConf['typeContent']     : "";
			$datosConfig['category'] = isset($arrSpecialConf['categoryContent']) ? $arrSpecialConf['categoryContent'] : "";
			$datosConfig['type']     = isset($arrSpecialConf['typeContentAuto']) ? $arrSpecialConf['typeContentAuto'] : "";

			
			// ============================== Caché  PIEZAS  31, 31, 32 y Default ==============================
			$nCache001   = md5($dFePu.'ContenidoExtras'.@$idPrograma.@$idTemplate.@$val['idValoresPropiedades'].@$datosTemplate['idEje'].@$arrSpecialConf['cModel'].@$arrSpecialConf['cMetodo']. @$idUbicacion. @$arrSpecialConf['cParametro']. @$modulo);
			$verCache001 = $utilities->vesionCache($nCache001, $tPurgar);
			$cacheKey001 = $nCache001.$verCache001;
			$data       = $cache->load($cacheKey001);

			if (false ===$data || $tPurgar==true) {
	    		//Cargamos el contenido de la pieza
	    		switch($val['idPiezas']){
	    			case "30": case "31": case  "32":
	    				$data = $this->setClases($arrSpecialConf['cModel'], $arrSpecialConf['cMetodo'], $idUbicacion, $arrSpecialConf['cParametro'], $modulo);
	    				break;
	    			default:
	    				$data = $modelContenidoHome->cargaContenido($datosTemplate['idEje'], $val['idValoresPropiedades'], $dFePu, $datosConfig, $idPrograma, $tPurgar);
	    		}
	    		
	    		
	    		if($data==null) $data = array();
	
	    		
	    		$HoraDelete    = Zend_Registry::get('main')->delete->cache->hora;
	    		$MinutoDelete  = Zend_Registry::get('main')->delete->cache->minuto;
	    		$SegundoDelete = Zend_Registry::get('main')->delete->cache->segundos;
	    		$TiempoCache   =  mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) - time(); //86400
	    		if($TiempoCache <= 0)
	    			$TiempoCache = (mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) + 86400) - time(); //86400
	    		$cache->setLifetime($TiempoCache);
	    		$cache->save($data,$cacheKey001);
	    		
			}
			// ==================================================================================================
			
			if($val['idPropiedadesPiezas']==0){
				if( $val['iColumna'] == 'top' || $val['iColumna'] =='bottom' ){
					$datos[$val['iColumna']][] = array("id"=>$val['idPiezas'],"name"=>$val['cNombre'], "cols" => $val['iColumnas'], "height" => $val['height'], "color" => $val['cColor'], "settings" => array(), 'data' => $data, 'config' => $config, "arrSpecialConf" => $arrSpecialConf);
				} else {
					$datos['body'][$val['iColumna']][] = array("id"=>$val['idPiezas'],"name"=>$val['cNombre'], "cols" => $val['iColumnas'], "height" => $val['height'], "color" => $val['cColor'], "settings" => array(), 'data' => $data, 'config' => $config, "arrSpecialConf" => $arrSpecialConf);
				}
			} else {
				$settings = null;
				$idPropiedades = explode(",", $val['idPropiedadesPiezas']);
				$valores = explode(",", $val['cValores']);
				foreach($idPropiedades as $k => $v) {
					$settings[] = array("id"=>$idPropiedades[$k],"value"=>$valores[$k]);
					if ($idPropiedades[$k] == 6) $arrSpecialConf['especial'] = $valores[$k]; //Modulo especial, configuracion template
				}
				if( $val['iColumna'] == 'top' || $val['iColumna'] =='bottom' ){
					$datos[$val['iColumna']][] = array("id"=>$val['idPiezas'],"name"=>$val['cNombre'], "cols" => $val['iColumnas'], "height" => $val['height'], "color" => $val['cColor'], "settings" => $settings, 'data' => $data, 'config' => $config, "arrSpecialConf" => $arrSpecialConf);
				} else {
					$datos['body'][$val['iColumna']][] = array("id"=>$val['idPiezas'],"name"=>$val['cNombre'], "cols" => $val['iColumnas'], "height" => $val['height'], "color" => $val['cColor'], "settings" => $settings, 'data' => $data, 'config' => $config, "arrSpecialConf" => $arrSpecialConf);
				}
			}
		}
		if(!isset($datos['top'])) $datos['top'] = array();
		if(!isset($datos['bottom'])) $datos['bottom'] = array();
		
		$datos['mainItems'] = array('mainType'=> $datos['main'],'items'=> $modelPrincipalesHome->mainItems($datosTemplate['idEje'], $dFePu ,$tPurgar));

		// Caché 02
		$nCache02   = md5('DatosBAsicos2'. $idPrograma .$idTemplate);
		$verCache02 = $utilities->vesionCache($nCache02, $tPurgar);
		$cacheKey02 = $nCache02.$verCache02;
		$datos02    = $cache->load($cacheKey02);
		
		if(false==$datos02 || $tPurgar==true) {
			$datos02['infoPlaylist'] = array();
			$datos02['auxDatos'] = array();
			foreach ($result as $k => $v) {
		
			}
		
			$HoraDelete    = Zend_Registry::get('main')->delete->cache->hora;
			$MinutoDelete  = Zend_Registry::get('main')->delete->cache->minuto;
			$SegundoDelete = Zend_Registry::get('main')->delete->cache->segundos;
			$TiempoCache   =  mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) - time(); //86400
			if($TiempoCache <= 0)
				$TiempoCache = (mktime($HoraDelete,$MinutoDelete,$SegundoDelete,date("n"),date("j"),date("Y")) + 86400) - time(); //86400
			$cache->setLifetime($TiempoCache);
			$cache->save($datos02,$cacheKey02);		
		}

		$auxDatos      = $datos02['auxDatos'];
		$datos['infoPlaylist'] = $datos02['infoPlaylist'];
		return $datos;
	}
	

	/**
	 *  Esta funcion solamente trae los datos basicos del template y programa para el header del modulo de carga contenido
	 *  [EPG] 2013/06/25
	 */
	public function  datosBasicos($idPrograma){
		$sql = "SELECT e.idEje, e.idTemplate, tt.cPrincipal, s.cDescripcion AS estudio, 
		               tt.cDescripcion AS templateName, tt.idLayout AS templateType, tt.dtCreacion AS templateStamp
				  FROM eje e
				       LEFT JOIN templates  tt ON e.idTemplate = tt.idTemplate
				       LEFT JOIN programas p ON e.idPrograma = p.idPrograma
				       LEFT JOIN seccion s ON p.idSeccion = s.idSeccion
				 WHERE e.idPrograma = $idPrograma and e.idWidget =1";
		$result = $this->query($sql);
			
		return $result[0];
	}
	
	/**
	 *
	 * Instancia las clases y hace referencia a los metodos, retorna un arreglo
	 * @param char $nameclass
	 * @param char $namemethod
	 *
	 */
	public function setClases($nameclass,$namemethod,$idUbicacion,$parametro, $modulo){
		if (false == @class_exists($nameclass) || false == method_exists($nameclass,$namemethod)) {
			$nameclass  = $this->getNameClassDefault($modulo);
			$namemethod = $this->getNameMethodDefault($modulo);
		}
		if($nameclass !== null){
			$obj = new $nameclass;
			$obj->_modulo = $modulo;
			if ($parametro == null || $parametro == '') {
				return $obj->$namemethod();
			} else {
				return $obj->$namemethod($parametro);
			}
		}
	}
	
	/**
	 *
	 * Obtiene el nombre de la clase por default de cada widget
	 * @param string $modulo
	 */
	private function getNameClassDefault($modulo) {
		switch ($modulo) { case 'home': return 'My_Model_UbicacionGenerica'; break; }
	}
	
	/**
	 *
	 * Obtiene el nombre del metodo por default de cada widget
	 * @param string $modulo
	 */
	private function getNameMethodDefault($modulo) {
		switch ($modulo) { case 'home': return 'getDefault'; break; }
	}
	 
}
