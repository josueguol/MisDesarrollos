<?php
/**
 *Definición de model htmls
* @package My.Model.htmls
* @author Azteca Digital [PILJ]
* @version 1.0.0
*/
class My_Model_htmls extends My_Db_TableAzteca
{
	protected $_name    = "htmls";
	protected $_primary = "idHtmls";
	
	
	public function getInfohtmls($idhtml){
		
		$sql = "SELECT idPrograma, 	idEmpresa, idSeccion, cTitulo, cEmbebido, urlArchivo, cUploadFile, idPage, iStatus, idUsuarioCreador, dtFechaCaptura 
				FROM $this->_name WHERE $this->_primary  = $idhtml";
		
		try{
			return  $this->getAdapter()->query($sql)->fetchAll();
		}catch(Zend_Exception $e) {
			return false;
		}
	}
	
}