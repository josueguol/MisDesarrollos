<?php
/**
 * Model para os Estilos de Tetris
 *
 * @author  Azteca Internet [ROMF]
 * @package library.my.models.Estilostetris
 *
 * 
 * return array(
 *             )
 */
class My_Model_Estilostetris extends My_Db_TableAzteca implements My_Interface_Submodels {
    protected $_name    = 'estilosTetris';
    protected $_primary = 'idEstilosTetris';
     
    public    $_idEjeHome;
    public    $_idUbicacion;
    
	/**
     * Obtiene los estilos de un programa de tetris.
     * 
     * @param INTEGER $idPrograma     Id del programa 
     */
    public function getDefault($idPrograma=0){
        $sql =  "SELECT cestilos,iVersion FROM estilosTetris e where idPrograma = '".$idPrograma."';";
        
        $result = $this->query($sql);
        $result[0]['cestilos'] = json_decode($result[0]['cestilos'],true);
        return $result;
    }
   
}