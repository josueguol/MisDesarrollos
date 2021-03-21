<?php
/**
 * Archivo de definición de model de Eje
 * @package aztecaespectaculos.My.Model.Eje
 * @author  Azteca Digital [JT]
 * @version 1.0.0
 */

/**
 * Definición de model de Eje
 * @package aztecaespectaculos.My.Model.Eje
 * @author  Azteca Digital [JT]
 * @version 1.0.0
 */
class My_Model_Eje extends My_Db_TableAzteca{
    protected $_name    = 'eje';
    protected $_primary = 'idEje';

    /**
     * Obtener los widget por prorama
     * @param integer $idPrograma
     */
    public function obtenerWidgetsPrograma($idPrograma){
        $sql = "SELECT wid.idWidget,wid.cTitulo,cStyleIcono,cLink,cNombre as cTituloWidget
                  FROM eje ej
                       INNER JOIN widget wid ON wid.idWidget = ej.idWidget
                 WHERE idPrograma = ".$idPrograma." 
                 ORDER BY  wid.idWidget";
        $stmt = $this->query($sql);
        return  $stmt;
    }
}