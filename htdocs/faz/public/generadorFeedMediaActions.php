<?php
/*
 * Clase para generar un Json con la estructura de los MediaActions (Aun en version Demo)
 */
class generadorFeedMediaActions {

public function  __construct(){
	
}

public function generarArchivoJson(){
try {
	$bandera = 1;
	//$dataJson 	= file_get_contents("venga.json"); //Local para que me responda mas rapido
	$dataJson 	= file_get_contents("https://www.tvazteca.com/appnoticias/test-json-vla");
	$data 		= json_decode($dataJson, true);
	if ($dataJson === false) {
		echo "No se puede leer el json de BS...";
		$bandera = 0;
	}
	
	$datos		= $this->organizarDatosJson($data['items']);
	
	$datosJ 		= $this->generaJson();
 	$rutaArchivo	= "/webtva/webhost/casaBolsa/public/mediaactions/feed/feed.json";//Ruta del archivo a crear
 	//$rutaArchivo	= "/home/ezequiel/workspace/casaBolsa/public/mediaactions/feed/feed.json";//Ruta del archivo a crear

  	$fh = fopen($rutaArchivo, 'w');
 	if($fh == false ) {
 		echo "No tiene los permisos necesarios para crear el archivo o el directorio no existe... ";
 		$bandera = 0;
 	}else{
		fwrite($fh, json_encode($datos,JSON_UNESCAPED_UNICODE));
		fclose($fh);
 	}
	
	if($bandera == 1)
		echo "Json Generado Exitosamente :: ".date('Y-m-d h:i:sa');
	
} catch (Exception $e) {
	echo "No se puede generar el json...";
}

}

/*
 * Función para retornar los elementos del json de BS en formato MediaAction
 */
public function organizarDatosJson($LosDatos){
	if(empty($LosDatos)) return "";
	$arrDatos		= array();
	date_default_timezone_set("America/Mexico_City");
	$datosMediaAction	= 	"";
	$time				=	time();
	$fechaActual 		= 	date('Y-m-d h:i:sa');
	$fechaFormatoIso	=	date("Y-m-d", $time) . 'T' . date("H:i:s", $time) .'Z';
	$nuevafecha 		= 	strtotime ('+1 year' , strtotime($fechaActual)); //Le aumentamos 1 año por ahora solo prueba chance y sirva de algo mas adelante
	$fechaFormatoIsoMas	=	date("Y-m-d", $nuevafecha) . 'T' . date("H:i:s", $nuevafecha) .'Z';
	
	//Inicio Recorrido Json BS
	foreach ($LosDatos as $key => $datos) {
		$arrDatos [] = array(
				"@context" 			=> array("http://schema.org", array("@language" => "en")),
				"@type"  			=> "Movie",
				"@id"  				=> $datos['compartir'],
				"url"  				=> $datos['compartir'],
				"name"  			=> $datos['titulo'],				
				"description"		=> $datos['teaser']		
		);
	}//Fin Recorrido Json BS
	
	//Armo el json con la estructura completa de MediaActions
	$datosMediaAction =	array(
			"@context" 			=> "http://schema.org",
			"@type"  			=> "DataFeed",
			"dateModified"  	=> $fechaFormatoIso,
			"dataFeedElement"  	=> $arrDatos
			
		);
	
	return $datosMediaAction;
}


/*
 * Generara la estructa del json de MediaActions -por ahora solo lo pienso usar para cuando el json de Bs no se pueda leer voy a enviar un estructura por Default
 */

public function generaJson(){
	date_default_timezone_set("America/Mexico_City");
	$datosMediaAction	= 	"";
	$time				=	time();
	$fechaActual 		= 	date('Y-m-d h:i:sa');
	$fechaFormatoIso	=	date("Y-m-d", $time) . 'T' . date("H:i:s", $time) .'Z';
	$nuevafecha 		= 	strtotime ('+1 year' , strtotime($fechaActual)); //Le aumentamos 1 año por ahora solo prueba chance y sirva de algo mas adelante
	$fechaFormatoIsoMas	=	date("Y-m-d", $nuevafecha) . 'T' . date("H:i:s", $nuevafecha) .'Z';

	$datosMediaAction =	array(
			"@context" 			=> "http://schema.org",
			"@type"  			=> "DataFeed",
			"dateModified"  	=> $fechaFormatoIso,
			"dataFeedElement"  	=> array(
					"@context" 			=> array("http://schema.org", array("@language" => "en")),
					"@type"  			=> "Movie",
					"@id"  				=> "http://www.example.com/my_favorite_movie",
					"url"  				=> "http://www.example.com/my_favorite_movie",
					"name"  			=> "My Favorite Movie",
					"potentialAction"  	=>	array(
							"@type"				=> "WatchAction",
							"target"			=> array(
									"@type"				=> "EntryPoint",
									"urlTemplate"		=> "http://www.example.com/my_favorite_movie?autoplay=true",
									"inLanguage"		=> "en",
									"actionPlatform"	=> array("http://schema.org/DesktopWebPlatform",
											"http://schema.org/MobileWebPlatform",
											"http://schema.org/AndroidPlatform",
											"http://schema.org/IOSPlatform",
									"http://schema.googleapis.com/GoogleVideoCast"),
							),
							"actionAccessibilityRequirement" 	=> array(
									"@type"								=> "ActionAccessSpecification",
									"category"							=> "subscription",
									"availabilityStarts"				=> $fechaFormatoIso,
									"availabilityEnds"					=> $fechaFormatoIsoMas,
									"eligibleRegion"					=> array(
											array(
													"@type"	=> "Country",
													"name"	=> "US"
											),
											array(
													"@type"	=> "Country",
													"name"	=> "CA"
											)
									),
							),
					),//Fin de potentialAction
					"sameAs"			=> "https://en.wikipedia.org/wiki/my_favorite_movie",
					"releasedEvent"		=> array(
							"@type"			=> "PublicationEvent",
							"startDate"		=> date('Y-m-d'),
							"location"		=> array(
									"@type"		=> "Country",
									"name"		=> "US"
							)
					),
					"description"		=> "This is my favorite movie.",
					"actor" 			=> array(
							array(
									"@type"		=> "Person",
									"name"		=> "John Doe",
									"sameAs"	=> "https://en.wikipedia.org/wiki/John_Doe"
							),
							array(
									"@type"		=> "Person",
									"name"		=> "Jane Doe",
									"sameAs"	=> "https://en.wikipedia.org/wiki/Jane_Doe"
							)
					),
					"identifier"		=> array(
							array(
									"@type"=> "PropertyValue",
									"propertyID"=> "IMDB_ID",
									"value"=>  "tt0123456"
							)
					)

			)//Fin de dataFeedElement

	);

	return $datosMediaAction;
}


}

$json = new generadorFeedMediaActions();
$json->generarArchivoJson();
?>
