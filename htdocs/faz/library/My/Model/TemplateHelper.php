<?php
/**
 * Archivo de definición de clase modelo tempalteHelper
 *
 * @author Azteca Internet [JT]
 * @package library.my.model
 */

/**
 * Clase modelo para manipulación de datos tempalteHelper
 *
 * @author Azteca Internet [JT]
 * @package library.my.model
 */
class My_Model_TemplateHelper extends My_Db_TableAzteca{
	protected $_name    = 'templateHelper';
	protected $_primary = 'idTemplateHelper';


	/***
	 * Obtiene un helper asigando a algun programa.
	*
	*/
	public function getHelper($idPrograma){

		$sql= "SELECT idTemplateHelper, idPrograma, cPathHelper
		FROM templateHelper
		WHERE idPrograma = {$idPrograma}";
		
		$helper = $this->query($sql);
		$path = dirname(dirname(dirname(dirname(__FILE__)))).'/library/';
		
		if(isset($helper[0])){
			if(!file_exists($path. $helper[0]['cPathHelper']))
			$helper = array();
		}
		
		return $helper;
	}
}