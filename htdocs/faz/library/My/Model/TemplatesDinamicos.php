<?php
/**
 * Archivo de definición de la clase templatesDinamicos
 *
 * @author Azteca Internet [JT]
 * @package library.my.model
 */

/**
 * Clase templatesDinamicos
 * 
 * @author Azteca Internet [JT]
 * @package library.my.model
 */

class My_Model_TemplatesDinamicos extends My_Db_TableAzteca implements My_Interface_Submodels{
    protected $_name    = 'templatesDinamicos';
    protected $_primary = 'idTemplatesDinamicos';
    
    public $_idEjeHome;
    public $_idUbicacion;
    
    /**Regresa todas las configuraciones existentes del template dinamico
     * 
     * @param INTEGER $idPrograma
     */
    public function getDefault(){
        
    	$idShow  = 0;
        $diasBd  = array('Null','iLunes','iMartes','iMiercoles','iJueves','iViernes','iSabado','iDomingo');
        $sql     = "SELECT tdp.idGrupoElementos, tdp.iLunes, tdp.iMartes, tdp.iMiercoles, tdp.iJueves, tdp.iViernes, tdp.iSabado,    
                           tdp.iDomingo, tdp.tmHoraIni, tdp.tmHoraFin,  iDefault
                      FROM templatesDinamicosProgramacion tdp 
                           LEFT JOIN templatesDinamicos td ON td.idGrupoElementos =  tdp.idGrupoElementos
                     WHERE td.idEje = {$this->_idEjeHome}
                     GROUP BY tdp.idGrupoElementos
                     ORDER BY tdp.idTemplatesDinamicosProgramacion DESC";
        
        $temDin  = $this->getAdapter()->query($sql)->fetchAll();
        
        $sql     = "SELECT idGrupoElementos, idEje, cPath
                      FROM templatesDinamicos td
                           INNER JOIN  templatesDinamicosElementos tde ON td.idTemplateDinamicoElemento = tde.idTemplatesDinamicosElementos 
                     WHERE idEje = {$this->_idEjeHome}
                           AND iMostrar = 1
                     ORDER BY idGrupoElementos, iOrden";
        $arrTD   = $this->getAdapter()->query($sql)->fetchAll();
        
        $dateIni = new Zend_Date();
        $dateFin = new Zend_Date();
        $dateNow = new Zend_Date();
        
        // Busca la configuracion del template programada para el dia y hora actual.
        foreach($temDin AS $item){
            if($item[$diasBd[date("N")]]==1){
                $dateIni->set($item['tmHoraIni'], Zend_Date::TIMES);
                $dateFin->set($item['tmHoraFin'], Zend_Date::TIMES);
                if($dateNow->compare($dateIni) >= 1 && $dateNow->compare($dateFin) == -1){
                    if($item['iDefault'] != 1) {
                        $idShow = $item['idGrupoElementos'];
                        break;
                    }
                }
            }
        }
        //Si no existe nada programado para ese dia y hora, busca el default
        if($idShow==0){
            foreach($temDin AS $item){
                if($item['iDefault'] == 1) {
                    $idShow = $item['idGrupoElementos'];
                    break;
                }
            }
        }
        
        $return  = array('idGrupoElementos'=>$idShow, 'arrayProgramaTD' => $arrTD);
        
        return $return;
    }
}