<?php
/**
 * 
 * @author nal
 *
 */
class blog_ArticulosController extends My_Controller_ActionAzteca{
	
	/**
	 * Pagina inicial
	 */
	public function indexAction(){
		//die("test");
		header("Location: /", true, 301);
		exit();
	}
}



