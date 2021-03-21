<?php
/**
 * Archivo de definición de model de Oas
 * @package aztecaespectaculos.My.Model.Oas
 * @author  Azteca Digital [Felipon]
 * @version 1.0.0
 */

/**
 * Definición de model de Oas
 * @package aztecaespectaculos.My.Model.Oas
 * @author  Azteca Digital [Felipon]
 * @version 1.0.0
 */
class My_Model_Oas extends My_Db_TableAzteca{
	protected $_name    = 'oas';
	protected $_primary = 'idOas';

	/**
	 * Obtener los oas por programa
	 * @param integer $idPrograma
	 * @param integer $idWidget
	 * @param integer $ubicacion
	 */
	public function obtenerOASProgramaUbicacion($idPrograma,$idWidget,$ubicacion){

		$sql = "SELECT oas.cPosicion,oas.cScriptsDoubleclick as cScript
				  FROM rel_programa_oas pro
		               inner join oas oas on oas.idOas = pro.idOas
		where idPrograma = ".$idPrograma." and idWidget = ".$idWidget." and iUbicacion = ".$ubicacion." order by idRelacion;";
		$stmt = $this->query($sql);
		return  $stmt;
	}

	/**
	 * Obtener los oas por programa
	 * @param integer $idPrograma
	 * @param integer $idWidget
	 */
	public function obtenerOASPrograma($idPrograma,$idWidget){

		$db = $this->getAdapter();
		$stmt = $db->query("SELECT oas.cPosicion, oas.cScriptsDoubleclick as cScript, oas.iIdAdserver, cScriptsDoubleclick, oas.cDescripcion 
				              FROM rel_programa_oas pro
							       INNER JOIN oas oas on oas.idOas = pro.idOas
							 WHERE idPrograma = ".$idPrograma." 
								   AND idWidget = ".$idWidget." 
				             ORDER BY idRelacion;");
		return $stmt->fetchAll();

	}

	 
}