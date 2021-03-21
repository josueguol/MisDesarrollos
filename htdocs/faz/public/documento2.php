<?php
echo "Inicio Proceso DOMDocument<br/>";
//Send a GET request to the URL of the web page using file_get_contents.
//This will return the HTML source of the page as a string.
//$htmlString = file_get_contents('https://en.wikipedia.org/wiki/Main_Page');

//$htmlString ='<br>m<br>m<div class="cms-textAlign-left"></div> <span class="Enhancement"><span class="Enhancement-item"><a class="Link" href="https://www.tvazteca.com/fundacion/movimiento/notas/infografias" target="_blank"><img src="https://tv-azteca-brightspot.s3.amazonaws.com/f4/6c/3364da188f40e750ab32a8ef5b7b/movimiento-2159182.jpg" border="0"></a></span></span><img src="https://tv-azteca-brightspot.s3.amazonaws.com/00/b7/c3817c51685e199b350c5b0de8f7/fundacion-1869941.jpg" alt="COMUNICADO OFICIAL FUNDACIÓN AZTECA-FundacionAzteca">';
//$htmlString ='<b>Entrega de Fichas</b><br><br>Del 04 al 07 de febrero de 2020<br>de 09:00 a 17:00 hrs.20<br><br><b>Requisitos</b>:<br><br>Promedio general mínimo 9.0 (Primaria)<br>Copia de la CURP del alumno (Versión actualizada)<br> <br><b>Lugar:</b> Plantel Azteca<br>Acueducto de Guadalupe No. 25, Santa Isabel Tola, Gustavo A. Madero, CP. 07010, Ciudad de México.<br><div class="Enhancement"> <div class="Enhancement-item"><figure data-module class="Figure"> <div class="Figure-container"> <img src="https://qa3.tv-azteca.psdops.com/dims4/default/34de361/2147483647/strip/true/crop/1080x720+100+0/resize/300x200!/quality/90/?url=https%3A%2F%2Ftv-azteca-brightspot.s3.amazonaws.com%2F46%2F6f%2F8f4de39e41c5a2be5c2cf57abb5a%2Fwhatsapp-image-2019-10-10-at-12.46.36.jpeg" alt="Conócenos Fundación Aztec" srcset="https://qa3.tv-azteca.psdops.com/dims4/default/a7c2aff/2147483647/strip/true/crop/1080x720+100+0/resize/600x400!/quality/90/?url=https%3A%2F%2Ftv-azteca-brightspot.s3.amazonaws.com%2F46%2F6f%2F8f4de39e41c5a2be5c2cf57abb5a%2Fwhatsapp-image-2019-10-10-at-12.46.36.jpeg 2x" width="300" height="200"/> </div> </figure></div> </div>Image<br><br><b>Informes:</b><br>55 5577 2990<br>55 5748 2410<br><div class="Enhancement"> <div class="Enhancement-item"><figure data-module class="Figure"> <div class="Figure-container"> <img src="https://qa3.tv-azteca.psdops.com/dims4/default/013540f/2147483647/strip/true/crop/1620x1080+150+0/resize/300x200!/quality/90/?url=https%3A%2F%2Ftv-azteca-brightspot.s3.amazonaws.com%2F69%2F30%2Ff607cccf048af09d3a8d1b3a7d82%2Flogofun-2314612.jpg" alt="LogoFUN" srcset="https://qa3.tv-azteca.psdops.com/dims4/default/c1deea9/2147483647/strip/true/crop/1620x1080+150+0/resize/600x400!/quality/90/?url=https%3A%2F%2Ftv-azteca-brightspot.s3.amazonaws.com%2F69%2F30%2Ff607cccf048af09d3a8d1b3a7d82%2Flogofun-2314612.jpg 2x" width="300" height="200"/> </div> <figcaption class="Figure-caption">LogoFUN</figcaption> </figure></div> </div>';
//$htmlString='<div class="Enhancement"> <div class="Enhancement-item"><figure data-module class="Figure"> <div class="Figure-container"> <img src="https://uat.tv-azteca.psdops.com/dims4/default/a2fc593/2147483647/strip/true/crop/633x422+0+429/resize/300x200!/quality/90/?url=https%3A%2F%2Ftv-azteca-brightspot-lower.s3.amazonaws.com%2F52%2F6e%2F2732067841529031341289bd741d%2Finfografia-faz.jpeg" alt="Infografia FAZ.jpeg" srcset="https://uat.tv-azteca.psdops.com/dims4/default/918a39e/2147483647/strip/true/crop/633x422+0+429/resize/600x400!/quality/90/?url=https%3A%2F%2Ftv-azteca-brightspot-lower.s3.amazonaws.com%2F52%2F6e%2F2732067841529031341289bd741d%2Finfografia-faz.jpeg 2x" width="300" height="200"/> </div> </figure></div> </div><div class="Enhancement"> <div class="Enhancement-item"><figure data-module class="Figure"> <div class="Figure-container"> <img src="https://uat.tv-azteca.psdops.com/dims4/default/768576f/2147483647/strip/true/crop/755x503+103+0/resize/300x200!/quality/90/?url=https%3A%2F%2Ftv-azteca-brightspot.s3.amazonaws.com%2F4c%2Faa%2Feb3af75dd276547de8f72c78fa8d%2Fselva-lacandona-1975902.jpg" alt="selva lacandona" srcset="https://uat.tv-azteca.psdops.com/dims4/default/4056e49/2147483647/strip/true/crop/755x503+103+0/resize/600x400!/quality/90/?url=https%3A%2F%2Ftv-azteca-brightspot.s3.amazonaws.com%2F4c%2Faa%2Feb3af75dd276547de8f72c78fa8d%2Fselva-lacandona-1975902.jpg 2x" width="300" height="200"/> </div> </figure></div> </div><div class="Enhancement"> <div class="Enhancement-item"><figure data-module class="Figure"> <div class="Figure-container"> <img src="https://uat.tv-azteca.psdops.com/dims4/default/f486b6b/2147483647/strip/true/crop/540x360+50+0/resize/300x200!/quality/90/?url=https%3A%2F%2Ftv-azteca-brightspot.s3.amazonaws.com%2F73%2F00%2F71228e2ad9425390209c420ac97b%2Fselva-lacandona-2139382.jpg" alt="selva lacandona" srcset="https://uat.tv-azteca.psdops.com/dims4/default/8079022/2147483647/strip/true/crop/540x360+50+0/resize/600x400!/quality/90/?url=https%3A%2F%2Ftv-azteca-brightspot.s3.amazonaws.com%2F73%2F00%2F71228e2ad9425390209c420ac97b%2Fselva-lacandona-2139382.jpg 2x" width="300" height="200"/> </div>  </figure></div> </div>';
$htmlString='El pasado mes de febrero, con la ayuda del Comité de Operadores de Puebla y Red Social Azteca, ayudamos a más de <b>500 familias</b> del Municipio de San Nicolás de los Ranchos en Puebla con la entrega de <b>400 cobijas </b>y<b> 400 bufandas</b>. <br><br>El objetivo de esta jornada fue concientizar a la población sobre la importancia del reciclaje y la opción de darle a nuestros residuos una segunda vida a través del reúso. En este caso, se destacó la posibilidad de poder transformar PET en cobijas y así, poder incluso ayudar a las poblaciones más vulnerables (el Municipio de San Nicolás de los Ranchos es considerado de los más pobres del Estado de Puebla).<br><br>Se aprovechó la ocasión para hablar sobre el programa de recolección permanente de PET en las instalaciones del SEDIF para elaborar cobijas y crear conciencia en la población sobre el reciclado y recolección de este residuo. Este proyecto se está llevando a cabo con nuestro socio ambiental y ganador del concurso Recicla 2016: MORPHOPLAST.<br><div class="Enhancement"> <div class="Enhancement-item"><figure data-module class="Figure"> <div class="Figure-container"> <img src="https://tvazteca.brightspotcdn.com/dims4/default/df69ebd/2147483647/strip/true/crop/1280x853+0+53/resize/300x200!/quality/90/?url=https%3A%2F%2Ftvazteca.brightspotcdn.com%2Fc3%2F01%2F2a1536a9488398e2d22343b3af62%2Fcobijas-2.jpg" alt="Entrega de cobijas" width="300" height="200"/> </div> </figure></div> </div><br>¡Gracias al Comité por su participación y por ayudar a los más necesitados! <br><br><b>Trabajando juntos lograremos llevar prosperidad incluyente a todo México. </b>';
$contents ='
<pre>hi</pre>
<img src="1">
<pre>hello</pre>
<img src="2">
<pre>bye</pre>
<img src="3">
';

//Convertir utf8 a ISO-8859-1
$htmlISO = mb_convert_encoding($htmlString, 'ISO-8859-1');

//Create a new DOMDocument object.
$htmlDom = new DOMDocument;
$opcionesLibXML = LIBXML_COMPACT | LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD;

//Load the HTML string into our DOMDocument object.
@$htmlDom->loadHTML($htmlISO,$opcionesLibXML);

//Extract all img elements / tags from the HTML.
$imageTags = $htmlDom->getElementsByTagName('img');
//print_r($imageTags);
//die("**");
$length = $imageTags->length;
echo $htmlString;

echo "===============<br>";
if (strlen($length) >= 1){
	//Loop through the image tags that DOMDocument found.
	For ($i = $length - 1; $i > -1 ; $i--) {
	    //Obtiene los datos de la imagen y la procesa
	    $nodePre 	= $imageTags->item($i);
	    $imgSrc  	= $nodePre->getAttribute('src');
	    $ExisteUrl	= stripos($imgSrc, "url=");
			    
			    if ($ExisteUrl !== false) {
				    $imgSrc 	= explode("url=",$imgSrc);
				    $imgSrc 	= urldecode($imgSrc[1]);
			    }
	 echo " <br/>imagen:".$imgSrc." <br/>";
	    //Crea el elemento imagen en el nuevo formato
	    $nodeImg = $htmlDom->createElement("img");
	    $nodeImg->setAttribute('src', $imgSrc);
		// var_dump($nodeImg);

	   
	    //Reemplaza el elemento nuevo por el viejo
	    $nodePre->parentNode->replaceChild($nodeImg, $nodePre);
	}
}
$resultado = $htmlDom->saveHTML($htmlDom->documentElement);//documentElement :: importante para no recibir entities
echo $resultado;


echo "<br/>Fin Proceso DOMDocument"; 
?>
