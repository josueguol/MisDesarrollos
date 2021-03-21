<?php
/**
 * Archivo de definición de model de MenusTemplate
 * @package aztecaespectaculos.My.Model.MenusTemplate
 * @author  Azteca Digital [EPG] 2013-02-05
 * @version 1.0.0
 */

/**
 * Archivo de definición de model de MenusTemplate
 * @package My.Model.MenusTemplate
 * @author  Azteca Digital [EPG] 2013-02-05
 * @version 1.0.0
 */

class My_Model_MenusTemplate extends My_Db_TableAzteca{

	/**
	 *
	 * Metodo que obtiene los Menus Extras de los templates
	 */
	public function getMenusTemplate($idPrograma){
		
		$sql = "SELECT idmenusTemplate, cTitulo, cLInk, idMenuTemplatePadre 
		          FROM menusTemplate 
		         WHERE idPrograma = $idPrograma ORDER BY iOrden ASC";
		$result = $this->query($sql);
		
		return $result;
	}
	
	
	/**
	 * 
	 * Metodo que regresa el contenido del menu de azteca 2014
	 */
	public function getMenuAzteca2014(){
		
		$sql =  "SELECT idmenusTemplate, cTitulo, cLink, iOrden, idMenuTemplatePadre 
				   FROM menusTemplate 
				  WHERE idPrograma = 10581 
				  ORDER BY idMenuTemplatePadre, iOrden ASC;";
		$result = $this->query($sql);
		$menu = array();
		foreach ($result as $item){
			if($item['idMenuTemplatePadre'] == 0){
				$menu[$item['idmenusTemplate']] = $item;
			}else{
				if(isset($menu[$item['idMenuTemplatePadre']]))
					$menu[$item['idMenuTemplatePadre']]['submenu'][$item['idmenusTemplate']] =  $item;
				else{
					
					foreach($menu as $i => $item2){
						if(isset($item2['submenu'][$item['idMenuTemplatePadre']])){
							
							$menu[$i]['submenu'][$item['idMenuTemplatePadre']]['subsub'][$item['idmenusTemplate']] =  $item;
							
						}
					}
				}				 
			}		
		}

		
		return $menu;
		
	}
	
	
}