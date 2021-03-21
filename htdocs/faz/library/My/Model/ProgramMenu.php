<?php
/**
 * Archivo de generación dinámica de menú principal
 * @package aztecaespectaculos.My.Model.Menu
 * @author  Azteca Digital [BF]
 * @version 1.0.0 Beta
 */

class My_Model_ProgramMenu extends My_Db_TableAzteca {
	
	/**
     *Obtiene el menú correspondiente por programa y sección
     *@return array
     */
	public function get_items() {
		
		$menuItemsArray = array();
			
		// Obtenemos los programas
		$sql= "SELECT * FROM extrasMenusItems";
		foreach( $this->query($sql) as $value ) {
			
			// Agregamos el programa al array
			$menuItemsArray[] = array('nombre'=>$value['cTitulo'], 'link'=>$value['cUrl']);
				
		}
		
		// Dividimos el array en partes iguales para las 4 columnas
		$totalMenuItems = count($menuItemsArray);
		$menuItemsPerBlock = round($totalMenuItems / 4);
		
		$newMenuItemsArray = array();
		$newMenuItemsArray = array_chunk($menuItemsArray, $menuItemsPerBlock, true);
				
		return $newMenuItemsArray;
		
		
	}
	
}

?>