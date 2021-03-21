<?php
class ontraport_OntraportController extends Zend_Controller_Action{
	
	public $contexts = array(
			'set'  => array('json'),
			'test'  => array('json')
	);
	public function init()
	{
		$this->_helper->contextSwitch()->initContext();
	}
	/**
	 * Pagina inicial
	 */
	public function indexAction(){
		$this->view->doctype('XHTML1_RDFA');
		$this->_helper->layout->disableLayout();

	}
	
	public function setAction(){
		unset($this->view->format);
		unset($this->view->site);
		unset($this->view->idFacebook);
		
		$nombre = $this->getRequest()->getPost('nombre', '');
		$ap_pa = $this->getRequest()->getPost('apellidopaterno', '');
		$ap_ma = $this->getRequest()->getPost('apellidomaterno', '');
		$email = $this->getRequest()->getPost('email', '');
		$celular = $this->getRequest()->getPost('celular', '');
		
		$ontra = new My_Ontraport_Ontraport("2_194166_b6gcTXS0c", "EQlzc1pXoEHir8E");
		$otype = new My_Ontraport_ObjectType;
		
		if($celular==0){
			$requestParams = array(
					"objectID"  => $otype::CONTACT, // Object type ID: 0
					"f1562" => $nombre,
					"f1563"  => $ap_pa,
					"f1589"  => $ap_ma,
					"email"  => $email
			);
		}else{
			$requestParams = array(
					"objectID"  => $otype::CONTACT, // Object type ID: 0
					"f1562" => $nombre,
					"f1563"  => $ap_pa,
					"f1589"  => $ap_ma,
					"email"     => $email,
					//"f1564"     => $celular
					"f1598"	 => $celular
			);
		}
				
		$response = $ontra->object()->create($requestParams);
		
		$this->view->respuesta = $response;
	}
	
	public function testAction(){
		unset($this->view->format);
		unset($this->view->site);
		unset($this->view->idFacebook);
		
		$nombre = $this->getRequest()->getPost('nombre', '');
		$ap_pa = $this->getRequest()->getPost('apellidopaterno', '');
		$ap_ma = $this->getRequest()->getPost('apellidomaterno', '');
		$email = $this->getRequest()->getPost('email', '');
		$celular = $this->getRequest()->getPost('celular', '');
		$respuestas = $this->getRequest()->getPost('respuestas', '');
		
		$ontra = new My_Ontraport_Ontraport("2_194166_b6gcTXS0c", "EQlzc1pXoEHir8E");
		$otype = new My_Ontraport_ObjectType;
		
		$requestParams = array(
				"objectID"  => $otype::CONTACT, // Object type ID: 0
				"f1562" => $nombre,
				"f1563"  => $ap_pa,
				"f1589"  => $ap_ma,
				"email"  => $email,
		);
		
		foreach ($respuestas as $k => $v){
			$requestParams[$v['pregunta']] = $v['respuesta'];
		}
				
		$response = $ontra->object()->create($requestParams);
			
		$this->view->respuesta = $response;
	}
}