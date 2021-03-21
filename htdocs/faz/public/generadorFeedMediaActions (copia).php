<?php
class generadorFeedMediaActions {

public function generarArchivoJson(){
try {
	$dataJson 	= file_get_contents("https://www.tvazteca.com/appnoticias/json/puntotraderhome");
	$data 		= json_decode($dataJson, true);
	if ($dataJson === false) {
		echo "No se puede leer el json de BS...";
	}
	
	$datosAutor		= $this->organizarDatosJson($data['items'], 2);//Traer el json organizado por autor
	$datosJ 		= $this->generaJson();
 	$rutaArchivo	= "/home/ezequiel/workspace/casaBolsa/public/mediaactions/feed/datosFeed.json";
 	$rutaArchivoL	= "/home/ezequiel/workspace/casaBolsa/public/mediaactions/feed/datosFeed.json";
	
	$fh = fopen($rutaArchivoL, 'w')or die("Error al escribir fichero...");
	fwrite($fh, json_encode($datosJ,JSON_UNESCAPED_UNICODE));
	fclose($fh);
	echo "Json Generado :: ".date('Y-m-d h:i:sa');
} catch (Exception $e) {
	
}
}
/*
 * Obtiene los datos del autor
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
					"dataFeedElement"  	=> array([
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
							
					])//Fin de dataFeedElement					
				
					);
	
	return $datosMediaAction;
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
	
	$datosMediaAction =	array(
			"@context" 			=> "http://schema.org",
			"@type"  			=> "DataFeed",
			"dateModified"  	=> $fechaFormatoIso,
			"dataFeedElement"  	=> array([
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
						
			])//Fin de dataFeedElement
	
	);
	 //$aAutor[$datosA][] = $LosDatos[$key];
	foreach ($LosDatos as $key => $datos) {

	}
	 
	return $arrDatos;
}
}
$json = new generadorFeedMediaActions();
$json->generarArchivoJson();
?>
