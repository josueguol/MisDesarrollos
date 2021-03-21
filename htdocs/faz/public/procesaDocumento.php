<?php
//Send a GET request to the URL of the web page using file_get_contents.
//This will return the HTML source of the page as a string.
//$htmlString = file_get_contents('https://en.wikipedia.org/wiki/Main_Page');

$htmlString ='Este es el primer parrafo<br><div class="Enhancement">
            <div class="Enhancement-item"><figure data-module class="Figure">
    <div class="Figure-container">
        
            <img src="https://tvazteca.brightspotcdn.com/dims4/default/03f1902/2147483647/strip/true/crop/975x650+163+0/resize/300x200!/quality/90/?url=https%3A%2F%2Ftvazteca.brightspotcdn.com%2F3c%2F47%2Fa6d72deb44099b37fb8a50900c08%2Fplantel-azteca.jpeg" alt="Plantel Azteca" srcset="https://tvazteca.brightspotcdn.com/dims4/default/ac46661/2147483647/strip/true/crop/975x650+163+0/resize/600x400!/quality/90/?url=https%3A%2F%2Ftvazteca.brightspotcdn.com%2F3c%2F47%2Fa6d72deb44099b37fb8a50900c08%2Fplantel-azteca.jpeg 2x" width="300" height="200"/>
        
    </div>
    
</figure></div>
        </div>De ahi que las cosas a veces<br><br>Inicio Video<br><div class="Enhancement">
            <div class="Enhancement-item"><span class="VideoEnhancement" data-video-disable-history>
    
        <div class="VideoEnhancement-title">primer video fundacion</div>
    
    
    
        <div class="VideoEnhancement-player">
<div
    data-module
    class="BitmovinVideoPlayer"
    data-video-player
    data-video-id="8074942d34864f5282ab9593906f3414"
    data-analytics-key="dbac5055-3ab3-40cc-b197-bb8bccf253e6"
    data-account="f32ed0f7-7c00-4f1f-8798-6f0864dc5f44"
    data-video-title="primer video fundacion"
    data-video-description=""
    data-dashurl=""
    data-hlsurl="https://content.uplynk.com/8074942d34864f5282ab9593906f3414.m3u8"
    data-progressiveurl=""
    data-video-poster=""
    data-video-channel="APP Noticias"
    data-video-program=""
    data-date-published="2020-04-13"
    
>
    <div class="BitmovinVideoPlayer-viewport">
        <div class="BitmovinVideoPlayer-player"></div>
    </div>
</div>

</div>
    
    
</span>
</div>
        </div><br>Fin Video<br>Segundo Video youtube<br><div class="Enhancement">
            <div class="Enhancement-item"><span class="VideoEnhancement" data-video-disable-history>
    
        <div class="VideoEnhancement-title">Fundación Azteca: 23 años siendo el brazo social de Grupo Salinas.</div>
    
    
    
        <div class="VideoEnhancement-player"><div
    data-module
    class="YouTubeVideoPlayer"
    data-video-player
    data-player-id="f7fb3e7d916314ce2aa4df2aadaf34b46"
    data-video-id="wDHb072Y058"
    data-video-title="Fundación Azteca: 23 años siendo el brazo social de Grupo Salinas.">
    <div class="YouTubeVideoPlayer-viewport">
        <iframe id="YouTubeVideoPlayer-f7fb3e7d916314ce2aa4df2aadaf34b46" allowfullscreen src="https://www.youtube.com/embed/wDHb072Y058?enablejsapi=1"></iframe>
    </div>
</div>
</div>
    
    
</span>
</div>
        </div>Otra imagen<br><div class="Enhancement">
            <div class="Enhancement-item"><figure data-module class="Figure">
    <div class="Figure-container">
        
            <img src="https://tvazteca.brightspotcdn.com/dims4/default/256e677/2147483647/strip/true/crop/885x590+30+0/resize/300x200!/quality/90/?url=https%3A%2F%2Ftvazteca.brightspotcdn.com%2Ffa%2Fc0%2Fb9c0f5940c8d83fc687809de4bc8%2Frevistacentralsociedaddeautoresycompositores-2285925.png" alt="El 15 de enero de 1945 se funda la Sociedad de Autores y Compositores de México con el fin de reconocer los Derechos de Autor/ Foto: Especial" srcset="https://tvazteca.brightspotcdn.com/dims4/default/50d1115/2147483647/strip/true/crop/885x590+30+0/resize/600x400!/quality/90/?url=https%3A%2F%2Ftvazteca.brightspotcdn.com%2Ffa%2Fc0%2Fb9c0f5940c8d83fc687809de4bc8%2Frevistacentralsociedaddeautoresycompositores-2285925.png 2x" width="300" height="200"/>
        
    </div>
    
        <figcaption class="Figure-caption">El 15 de enero de 1945 se funda la Sociedad de Autores y Compositores de México con el fin de reconocer los Derechos de Autor Foto Especial</figcaption>
    
</figure></div>
        </div>';

//Convertir utf8 a ISO-8859-1
$htmlISO = mb_convert_encoding($htmlString, 'ISO-8859-1');

//Create a new DOMDocument object.
$htmlDom = new DOMDocument;
$opcionesLibXML = LIBXML_COMPACT | LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD;

//Load the HTML string into our DOMDocument object.
@$htmlDom->loadHTML($htmlISO,$opcionesLibXML);
 
//Extract all img elements / tags from the HTML.
$imageTags = $htmlDom->getElementsByTagName('img');
$length = $imageTags->length;
//echo $length;
//Create an array to add extracted images to.
$extractedImages = array();
 
//Loop through the image tags that DOMDocument found.
foreach($imageTags as $imageTag){
    //Crear un nuevo iframe y asignar el src
    $nuevaImagen 	= $htmlDom->createElement('img');
    $imgSrc 		= $imageTag->getAttribute('src');
//echo 
    $imgSrc 		= explode("url=",$imgSrc);
    $imgSrc 		= urldecode($imgSrc[1]);
    $nuevaImagen->setAttribute('src', $imgSrc);
     //reemplazar viejo por nuevo
    $imageTag->parentNode->replaceChild($nuevaImagen, $imageTag);

}
//DOM -> string final
$resultado = $htmlDom->saveHTML($htmlDom->documentElement);
             //documentElement :: importante para no recibir entities
echo "".$htmlString;
echo "=====================";
echo $resultado;

?>
