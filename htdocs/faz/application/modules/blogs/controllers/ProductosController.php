<?php

class blogs_ProductosController extends Zend_Controller_Action{
	public function indexAction(){
		Zend_Layout::getMvcInstance()->setLayout('layout');
		$this->view->metadatos      = "";
	}
}
?>