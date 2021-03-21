<?php

/**
 * Helper para formateo de url de imagen.
 * 
 * @author AztecaDigital [JT]
  */
class My_Helper_CrearImagen  extends Zend_Controller_Action_Helper_Abstract {

	public function crearImagen($tipo, $img, $w, $h, $coordinates = ''){
		
		$imagen = "";
		/**** Sacamos la info para validar si es un gif ****/
		$parseUrl = parse_url($img);
		$pathUrl = $parseUrl[path];
		$pathInfo = pathinfo($pathUrl);
		$extension = $pathInfo['extension'];
		if($extension == 'gif') {
			return $img;
		} else {		
			$buscarCrop = strpos($img, 'crop.php');
			$buscarAkam = strpos($img, 'cdnbakmi.kaltura.com') || strpos($img, 'cdn.kaltura.com');
	
			if($buscarAkam  ==  TRUE ){
				$imagen = $img;
			}else{	
				
				if(strlen($img) > 10){
					$pos = strpos($img, 'https://');
					if($pos === FALSE){
						$vector = explode("http://",$img);
					} else {
						$vector = explode("https://",$img);
					}
					if(count($vector)>1){
						$aux = explode('&',$vector[1]);
						$aux = explode('coordinates=',$aux[0]);
						
						if($coordinates == ''){
							if(count($aux) > 1)
						    	$coordenadaFinal = $aux[1];
							else 
								$coordenadaFinal = "50,50";
						}
						else{
							$coordenadaFinal = $coordinates;
						}
					}
					$img = "https://".$vector[(sizeof($vector)-1)];
					$resampleImg = "https://static.azteca.com/crop/crop.php?width={$w}&height={$h}&img=";
					$imagen  = $resampleImg . $img ."&coordinates=" . $coordenadaFinal;
				}else{
					$imagen = "http://cdnbakmi.kaltura.com/p/459791/sp/45979100/thumbnail/entry_id/{$img}/width/{$w}/version/001";
				}
			}
			return $imagen;
		}
	}
}
