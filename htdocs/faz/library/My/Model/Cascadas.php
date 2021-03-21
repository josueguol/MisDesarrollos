<?php 
/**
 * Archivo de defincion de clase Model para albergar las funciones que manejaran las consultas a la tabla cascadas  
 * @author Azteca Digital [EPG]
 * @package library.My.Model
 * @version 1.0.0 [2013-11-20]
 *
 */

/**
 * Definición de clase Model para albergar las funciones que manejarán las consultas a la tabla cascadas
 * @author Azteca Digital [EPG]
 * @package library.My.Model
 * @version 1.0.0 [2013-11-20]
 *
 */
class My_Model_Cascadas extends My_Db_TableAzteca  {
	protected $_name = 'cascadas';
	protected $_primary = 'idCascadas';
	
	/**
	 * Este metodo regresa la informacion de las cascadas para un programa en especifico 
	 * [EPG] 2013-11-20
	 * @param int $idPrograma
	 */
	public function getCascadas($idPrograma){
		$sql = "SELECT 
				    c.idImagen,im.cUrl AS imgUrl ,c.cUrl, c.iOrden
				FROM cascadas c
				LEFT JOIN imagenes im ON c.idImagen = im.idMultimediaImagenes
				WHERE idPrograma = $idPrograma 
				ORDER BY iOrden Asc";
		return $this->query($sql);
	}

}