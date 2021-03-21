<?php
/**
 * Model para las funciones que obtendremos información para el tetris
 *
 * @author  Azteca Internet [EM]
 * @package library.my.models
 *
 */
class My_Model_TetrisModel extends My_Db_TableAzteca implements My_Interface_Submodels {
	
	public function getDefault(){ }
    
	public function contenttemplateAction(){
		$validador = new My_Validador_AztecaValidador();
		$templatesModel = new My_Model_Templates();
		
		$modelActualizacionHomes = new My_Model_ActualizacionHomes();
		$modelPrincipalesHome = new My_Model_PrincipalesHome();
		
		$idPrograma = $this->getRequest()->getParam('idPrograma',0);
		$idPrograma = $validador->intValido($idPrograma);
		$datosTemplate = $templatesModel->datosBasicos($idPrograma);
		$items = $templatesModel->contenidoTemplate($datosTemplate['idEje'],$timeStamp);

	}
	
	public function getInfoTemplate ($idTemplate) {
	    $sql = "SELECT idTemplate, idLayout, iTetris FROM templates WHERE idTemplate = {$idTemplate};";
	    $result = $this->query($sql);
	    return $result[0];
	}
}


