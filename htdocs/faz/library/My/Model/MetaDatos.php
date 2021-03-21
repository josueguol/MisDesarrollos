<?php
/**
 * Archivo de definición de model de nota generica
 * @author  Azteca Digital [EPG]
 * @version 1.0.0
 */

class My_Model_MetaDatos extends My_Db_TableAzteca{
	
	
	public function titulo($metadatos,$datos){
		if($metadatos['configuracion'][0]['cTitulo']==""){
		    if (isset($datos['notanew'])) {
				if($datos['notanew'][0]['cTituloNota']!=""){
					$metadatos['configuracion'][0]['cTitulo']=$datos['notanew'][0]['cTituloNota']." - Nota - ".$metadatos['configuracion'][0]['cNombre']." - www.azteca.com";
				}
		    }
		}
		return $metadatos;
	}
}
?>