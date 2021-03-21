<?php
/**
 * Definición de clase de controlador
 * @package default.index
 * @author  Azteca Digital Kevin_Miriam_2020
 * @author  Kevin_Miriam_2019
 * Controlador para procesar los datos de los articulos de fundación azteca, version Json ...xD
 *
 */
class IndexController extends Zend_Controller_Action{
    /**
     *
     * Index Action
     * Home principal
     */
    public function indexAction(){
    	$this->view->doctype('XHTML1_RDFA');    	
    	$this->_helper->layout->disableLayout();
    	$this->_helper->redirector->setCode(301);
    	$this->_redirect('/contenido/seccion/home');
    }
}