<?php
/**
 * Validador/ForoComentarios
 */

class My_Validador_AztecaValidador extends Zend_Validate
{

	//public $programa;
	public function isValid($programa)
	{
		return $this->urlValida($programa);
	}

	public function urlValida($programa)
	{
		$valido = $programa;
		 
		$filtroST = new Zend_Filter_StripTags();
		$filtroHtml = new Zend_Filter_HtmlEntities();
		$filtroTrim = new Zend_Filter_StringTrim();

		$programa =  $filtroHtml -> filter($programa);
		$programa =  $filtroST -> filter($programa);
		$programa =  $filtroTrim -> filter($programa);
		//se sustituye los - que tiene la url para verificar que sea alphanumerco
		$programa = str_replace("-","",$programa);
		$programa = str_replace(":","",$programa);
		//echo $programa;die;
		 
		if (!Zend_Validate::is($programa, 'Alnum')) {
			$valido = false;
		}


		return $valido;
	}

	public function uriValida($uri)
	{
		$valido = $uri;
		 
		$filtroST = new Zend_Filter_StripTags();
		$filtroHtml = new Zend_Filter_HtmlEntities();
		$filtroTrim = new Zend_Filter_StringTrim();

		$uri =  $filtroHtml -> filter($uri);
		$uri =  $filtroST -> filter($uri);
		$uri =  $filtroTrim -> filter($uri);
		//se sustituye los - que tiene la url para verificar que sea alphanumerco
		$uri = str_replace("-","",$uri);
		$uri = str_replace("/","",$uri);
		$uri = str_replace("?","",$uri);
		$uri = str_replace("=","",$uri);
		$uri = str_replace(" ","",$uri);
		//echo $programa;die;
		 
		if (!Zend_Validate::is($uri, 'Alnum')) {
			$valido = false;
		}


		return $valido;
	}

	/**
	 * Funcion que valida los enteros
	 * @param int $value
	 * @return int (validado, filtrado y escapdo)
	 */
	public function intValido($value){
		// valida entero
		if(Zend_Validate::is($value, 'Int')){
			// filtrarlo
			$Zfilter = new Zend_Filter_Int();
			$value = $Zfilter->filter($value, 'Int');
			return $value;
		}
		return false;
	}

	/**
	 * Funcion que valida las cadenas de solo caracteres
	 * @param int $value
	 * @return int (validado, filtrado y escapdo)
	 */
	public function alphaValido($value){
		// valida cadena
		if(Zend_Validate::is($value, 'Alpha')){
			// filtrarlo
			$filtroST = new Zend_Filter_StripTags();
			$filtroHtml = new Zend_Filter_HtmlEntities();
			$filtroTrim = new Zend_Filter_StringTrim();
				
			$value =  $filtroHtml -> filter($value);
			$value =  $filtroST -> filter($value);
			$value =  $filtroTrim -> filter($value);

			return $value;
		}
		return false;
	}


	/**
	 * Funcion que valida las cadenas de caracteres y numeros
	 * @param int $value
	 * @return int (validado, filtrado y escapdo)
	 */
	public function alphanumValido($value){
		$valueAux = str_replace(" ","",$value);
		// valida cadena
		if(Zend_Validate::is($valueAux, 'Alnum')){
			// filtrarlo
			$filtroST = new Zend_Filter_StripTags();
			$filtroHtml = new Zend_Filter_HtmlEntities();
			$filtroTrim = new Zend_Filter_StringTrim();
				
			$value =  $filtroHtml -> filter($value);
			$value =  $filtroST -> filter($value);
			$value =  $filtroTrim -> filter($value);

			return $value;
		}
		return false;
	}


	/**
	 * Funcion que valida los tipo float
	 * @param int $value
	 * @return int (validado, filtrado y escapdo)
	 */
	public function floatValido($value){
		// valida cadena
		if(Zend_Validate::is($value, 'Float')){
			// filtrarlo
			$filtroST = new Zend_Filter_StripTags();
			$filtroHtml = new Zend_Filter_HtmlEntities();
			$filtroTrim = new Zend_Filter_StringTrim();
				
			$value =  $filtroHtml -> filter($value);
			$value =  $filtroST -> filter($value);
			$value =  $filtroTrim -> filter($value);

			return $value;
		}
		return false;
	}



	/**
	 * Funcion que valida los mails
	 * @param int $value
	 * @return int (validado, filtrado y escapdo)
	 */
	public function mailValido($value){
		// valida cadena
		if(Zend_Validate::is($value, 'EmailAddress')){
			// filtrarlo
			$filtroST = new Zend_Filter_StripTags();
			$filtroHtml = new Zend_Filter_HtmlEntities();
			$filtroTrim = new Zend_Filter_StringTrim();
				
			$value =  $filtroHtml -> filter($value);
			$value =  $filtroST -> filter($value);
			$value =  $filtroTrim -> filter($value);

			return $value;
		}
		return false;
	}


	/**
	 * Metodo que aplica el filtro StripTags
	 * @param string $string
	 */
	 
	private function stringTags($string) {
		$filter  = new Zend_Filter_StripTags();
		return $filter->filter($string);
	}


	/**
	 * Metodo que recibe un elemento, valida si es un objeto, arreglo o variable y aplica validaciones
	 * @param $object
	 */
	 

	public function dataFront($object) {
		if (is_object ( $object ))
			$object = get_object_vars ($object);


		if (is_array ( $object )){
			foreach ( $object as $key => $value ) {
				//Exception para widgets y contenido de la nota
				if($key != 'perfiles' && $key != 'widgets' && $key != 'cContenido' && $key != 'animacionFlash' && $key != 'HistoricoNotas' && $key != 'HistoricoNotasBottonAnt' && $key != 'HistoricoNotasBottonAnt' && $key != 'HistoricoNotasBottonSig' && $key != 'notasRelacionadasGalerias'  && $key != 'HistoricoGalerias' && $key != 'GaleriasRelacionadasconGalerias' && $key != 'listaCategorias' && $key != 'jsTortuga')
					$object [$key] =  $this->dataFront ($object [$key]);
			}
		} else {
			$object = ($this->stringTags($object));
		}

		return $object;
	}

	/**
	 * Metodo que recibe una cadena y valida si el dominio esta dentro de los perimitidos, si no lo esta regresa falso
	 * @param $object
	 */
	 

	public function validDomain($domain) {
		$domains = array("b3t42012.azteca.com","www.tvazteca.com","www.aztecanoticias.com.mx","www.aztecadeportes.com","www.aztecaespectaculos.com");
		if (in_array($domain,$domains)){
			return $domain;
		}
		else{
			return false;
		}
	}

	public function execValida($comando)
	{
		$valido = false;
		 
		//$filtroTrim = new Zend_Filter_StringTrim();
		//$comando =  $filtroTrim -> filter($comando);

		//lista de comandos validos
		$comandosValidos[0]='ffmpeg';


		foreach ($comandosValidos as $value) {
			if($value == strtolower(substr($comando, 0, strlen($value)))){
				$valido = $comando;
				break;
			}
		}
		 
		return $valido;
	}
	
	public function arrayValido($data, $tipo) {
        $filtroST = new Zend_Filter_StripTags();
		$filtroTrim = new Zend_Filter_StringTrim();
		if (is_array($data)) {
		    foreach ($data as $value => $val) {
		        $valor = $val;
		        //Aplicamos los filtros
		        $valor =  $filtroST  -> filter($valor);
		        $valor =  $filtroTrim-> filter($valor);
		        //Quitamos los caracteres permitidos
		        $valor = str_replace("-","",$valor);
		        $valor = str_replace(":","",$valor);
		        $valor = str_replace(";","",$valor);
		        //Validamos el tipo dependiendo el tipo que hayamos recibido como parametro
		        if (!Zend_Validate::is($valor, "{$tipo}")) {
			        return false;
		        }
		    }
		    return $data;
		}
        return false;
    }
    
    public function validIdKaltura($idKaltura)
    {
    	$valido    = $idKaltura;
    	$idKaltura = str_replace("_","",$idKaltura);
    	if (Zend_Validate::is($idKaltura, 'Alnum')) {
    		$filtroST = new Zend_Filter_StripTags();
    		$filtroTrim = new Zend_Filter_StringTrim();
    		//Aplicamos los filtros
    		$valido = $filtroST -> filter($valido);
    		$valido = $filtroTrim -> filter($valido);
    		//Retornamos el valor válido
    		return $valido;
    	}
    	return false;
    }
    
    public function alphanumSpaces($alnums)
    {
    	$validator = new Zend_Validate_Alnum(array('allowWhiteSpace' => true));
    	if ($validator->isValid($alnums)) {
    		return $alnums;
    	} else {
    		return false;
    	}
    }
    
    public function isDate($date)
    {
    	$validator = new Zend_Validate_Date();
    	if ($validator->isValid($date)) {
    		return $date;
    	} else {
    		return false;
    	}
    }
    
    public function urlValidaInstagram($programa)
    {
    	$valido = $programa;
    		
    	$filtroST = new Zend_Filter_StripTags();
    	$filtroHtml = new Zend_Filter_HtmlEntities();
    	$filtroTrim = new Zend_Filter_StringTrim();
    
    	$programa =  $filtroHtml -> filter($programa);
    	$programa =  $filtroST -> filter($programa);
    	$programa =  $filtroTrim -> filter($programa);
    	
    	//se sustituye los caracteres que tiene la url para verificar que sea alphanumerco
    	
    	$programa = str_replace("-","",$programa);
    	$programa = str_replace("_","",$programa);
    	$programa = str_replace(":","",$programa);
    	$programa = str_replace("/","",$programa);
    	$programa = str_replace(".","",$programa);
    	
    	if (!Zend_Validate::is($programa, 'Alnum')) {
    		$valido = false;
    	}
    	return $valido;
    }
    
    public function isDigit($digit){
    	
    	$validator = new Zend_Validate_Digits();
    	if ($validator->isValid($digit)) {
    		return $digit;
    	} else {
    		return false;
    	}
    	
    }
    
    /**
     * Funcion que valida las cadenas de caracteres y numeros
     * @param int $value
     * @return int (validado, filtrado y escapdo)
     */
    public function alnumAdvance($value, $excepciones = null){
    	$val = $value;
    	if(!is_array($excepciones) && $excepciones!=null){
    		$excepciones = explode(",", $excepciones);
    	}
    
    	if (is_array($excepciones)) {
    		foreach ($excepciones as $excepcion => $exc){
    			if(strcmp("comma",$exc)==0)
    				$val = str_replace(",","",$val);
    			else
    				$val = str_replace($exc,"",$val);
    		}
    
    	}
    
    	// valida cadena
    	if(Zend_Validate::is($val, 'Alnum')){
    		// filtrarlo
    		$filtroST = new Zend_Filter_StripTags();
    		$filtroTrim = new Zend_Filter_StringTrim();
    			
    		$value =  $filtroST -> filter($value);
    		$value =  $filtroTrim -> filter($value);
    
    		return $value;
    	}
    	return false;
    }
    
}