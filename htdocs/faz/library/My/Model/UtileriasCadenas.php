<?php
/**
 * Archivo de definición de clase
 *
 * @package Utilerias Cadenas
 * @author Etienne Rodríguez
 */

define("TXT_WYSIWYG", "<,>,=,\",comma,;,…,’,‘,%,#,“,”,–,$,|,—,+,{,},*,	,°,´");

/**
 * Definición de clase de controlador genérico
 *
 */
class My_Model_UtileriasCadenas
{
	/**
	 * Variable de registro de aplicación
	 *
	 * @var Zend_Registry
	 */
	protected $_registry = null;

	/**
	 * Método para obtener datos del programa, posibles opciones como llaves de arreglo.
	 *         menu:
	 *         widget:
	 *         oas:
	 *         seo:
	 * Asignar valor false para desactivar
	 *
	 * @param array $elementosPagina Arreglo de parametrización de datos de programa
	 * @param $idPrograma
	 * @param int $idSeccion
	 * @return array
	 */
	public function convierteUrl($string){
		$spacer = "-";
		$string = (trim($string));
		$string = str_replace("á","a",$string);
		$string = str_replace("é","e",$string);
		$string = str_replace("í","i",$string);
		$string = str_replace("ó","o",$string);
		$string = str_replace("ú","u",$string);
		$string = str_replace("ñ","n",$string);
		$string = str_replace("Á","a",$string);
		$string = str_replace("É","e",$string);
		$string = str_replace("Í","i",$string);
		$string = str_replace("Ó","o",$string);
		$string = str_replace("Ú","u",$string);
		$string = str_replace("Ñ","n",$string);
		$string = strtolower($string);
		$string = preg_replace("([^ A-Za-z0-9_])", "", $string);
		$string = str_replace(" ", "-", $string);
		return urlencode($string);
	}

	/**
	 * Convierte fecha hora aun formato legible  
	 * 
	 * @param unknown $FechaHora
	 * @return string
	 */
	public function convierteFechaHora($FechaHora){
		setlocale(LC_TIME,"spanish");
		return strftime("%d de %B de %Y, %R hrs",strtotime($FechaHora));
	}
	
	/**
	 * Convierte fecha en formato legible 
	 * 
	 * @param unknown $FechaHora
	 * @return string
	 */
	public function convierteFecha($FechaHora){
		setlocale(LC_TIME,"spanish");
		return (strftime(" %A %d de %B del %Y",strtotime($FechaHora)));
	}

	/**
	 * Convierte hora en formato legible 
	 * 
	 * @param unknown $FechaHora
	 * @return string
	 */
	public function convierteHora($FechaHora){
		setlocale(LC_TIME,"spanish");
		return strftime(" %R hrs",strtotime($FechaHora));
	}

	/**
	 * Recortador de url bityl
	 * 
	 * @param unknown $URL_larga
	 */
	public function bityl($URL_larga){
		$servicio_web = "http://api.bit.ly/";
		$version_API = "version=2.0.1";
		$usuario = "login=o_5gi95r4sip"; //sustituye por tu usuario del API
		$llave = "apiKey=R_eba707c8267fec0858168ea31111ec51"; //sustituye por tu clave del API

		$URL_larga = str_replace('?t=purgar', '',$URL_larga);
		$URL_larga = str_replace('?e=purgar', '',$URL_larga);

		//codifico en formato de URL la URL larga
		$query_URL = "&longUrl=" . urlencode($URL_larga);

		//genero la URL para consultar en el API de bit.ly
		$URL_consulta_API = $servicio_web . "shorten?" . $version_API . "&" . $query_URL . "&" . $usuario . "&" . $llave;

		//leo lo que me devuelve el API al hacer esa consulta, que estará en formato JSON
		$respuesta_API = file_get_contents($URL_consulta_API);

		//ahora tengo que consumir ese JSON para convertirlo en una estructura de datos accesible desde PHP
		$respuesta_API = json_decode($respuesta_API, true);
		//el true anterior hace que json_decode me devuelva sea un array asociativo.
		return $respuesta_API["results"][$URL_larga]["shortUrl"];
	}
	
	/**
	 * Funcion que sustituye caracteres que podrian romper los Json
	 */
	public function keepClean($value){
		str_replace(" ", " ", $value);
		$val = $value;
		$datos = bin2hex($val);
		for($i = 0 ; $i < strlen($datos) ; $i+=2 )
			$chars[] = substr($datos,$i,2);
		$val = "";
		foreach($chars as $c)
			if($c!="0a")
			$val = $val.chr(hexdec($c));
		$excepciones = explode(",", TXT_WYSIWYG);
		if (is_array($excepciones)) {
			foreach ($excepciones as $excepcion => $exc){
				if(strcmp("comma",$exc)==0)
					$val = str_replace(",","",$val);
				else
					$val = str_replace($exc,"",$val);
			}
		}
		return $val;
	}
	
	/**
	 * 
	 */
	public function convierteMes($value) {
		switch ($value) {
			case 1:
			case "Ene":
			case "Jan":
			case "ENERO":
			case "enero":
			case "ene":
			case "ENE":
			case "January":
			case "JANUARY":
			case "january":
				return "Enero"; break;

			case 2:
			case "Feb":			
			case "FEBRERO":
			case "febrero":
			case "feb":
			case "FEB":
			case "Febraury":
			case "FEBRAURY":
			case "febraury":
				return "Febrero"; break;
				

			case 3:
			case "Mar":
			case "MARZO":
			case "marzo":
			case "mar":
			case "MAR":
			case "March":
			case "MARCH":
			case "march":
				return "Marzo"; break;
					

			case 4:
			case "Abr":
			case "Apr":
			case "ABRIL":
			case "abril":
			case "abr":
			case "ABR":
			case "April":
			case "APRIL":
			case "april":
				return "Abril"; break;
						

			case 5:
			case "May":
			case "MAYO":
			case "mayo":
			case "may":
			case "MAY":
				return "Mayo"; break;
							

			case 6:
			case "Jun":
			case "JUNIO":
			case "junio":
			case "June":
			case "june":
			case "JUNE":
			case "JUN":
				return "Junio"; break;
								

			case 7:
			case "Jul":
			case "JULIO":
			case "julio":
			case "jul":
			case "July":
			case "july":
			case "JULY":
			case "JUL":
				return "Julio"; break;
									

			case 8:
			case "Ago":
			case "AGOSTO":
			case "agosto":
			case "ago":
			case "aug":
			case "August":
			case "august":
			case "AUGUST":
			case "AUG":
			case "AGO":
				return "Agosto"; break;
										

			case 9:
			case "Sep":
			case "SEPTIEMBRE":
			case "septiembre":
			case "sep":
			case "September":
			case "september":
			case "SEPTEMBER":
			case "SEP":
				return "Septiembre"; break;
											

			case 10:
			case "Oct":
			case "OCTUBRE":
			case "octubre":
			case "oct":
			case "October":
			case "october":
			case "OCTOBER":
			case "OCT":
				return "Octubre"; break;
												

			case 11:
			case "Nov":
			case "NOVIEMBRE":
			case "noviembre":
			case "nov":
			case "November":
			case "november":
			case "NOVEMBER":
			case "NOV":
				return "Noviembre"; break;
													

			case 12:
			case "Dic":
			case "DICIEMBRE":
			case "diciembre":
			case "dic":
			case "Dec":
			case "dec":
			case "December":
			case "december":
			case "DECEMBER":
			case "DEC":
				return "Diciembre"; break;
			
		}
	}
}
