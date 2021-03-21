<?php
/**
 * Clase para verificar si un usuario esta logueado, via Facebook o por Correo Electronico
 * @author kevin
 *
 */

require_once 'My/facebookSDK/facebook.php';

class My_Model_LoginGenerico extends My_Db_TableAzteca{
	private $appid ;
	private $secret;
	private $validador;
	protected $_name    = 'usuario';
	protected $_primary = 'idusuario';
	
	
	public function init(){
		$this->_setAdapter(Zend_Registry::getInstance()->dbAdapter['aztecaventas']);
		$this->validador = new My_Validador_AztecaValidador();
	}
	
	/**
	 * Nos logeamos por facebook
	 * @param unknown_type $appid
	 * @param unknown_type $secret
	 */
	public function LoginFacebook($appid,$secret){
		$this->appid=$appid;
		$this->secret=$secret;
		return $this->getSessionDataUser();		
	}
	
	/**
	 * Obtiene la sesión de facebook
	 */
	private function getSessionDataUser(){
		Try{			
				$facebook = new Facebookphp(array(
						'appId'  => $this->appid,
						'secret' => $this->secret,
						'cookie' => true
				));				
				$idUserFB =  $facebook->getUser();				
				if($idUserFB != 0 ) {
					return $facebook->api('/'.$facebook->getUser());
				} else {
					return false;
				}
			}catch(Exception $e){
					
			}
	}
	/**
	 * Nos logeamos por Correo Electronico
	 * @param unknown_type $correo
	 * @param unknown_type $password
	 */
	public function LoginCorreo($correo,$password){
		try {
				$this->validador->mailValido($correo);
				$this->validador->alphanumSpaces($password);
				$pass=hash("whirlpool",$password);
				$sql = "SELECT cEmail FROM usuario WHERE cEmail='{$correo}' AND cPassword='{$pass}'";				
				return $this->query($sql);
		} catch (Zend_Exception $e) {
				return false;
		}
	}
	/**
	 * 
	 * @param unknown_type $tipo
	 * @param unknown_type $data
	 * @param unknown_type $purgar
	 */
	public function obtenerDatosLogeo($data){
		
		$cache      = Zend_Registry::getInstance()->cacheAdapter['programas'];	
		$cacheName = 'datosF';
	
		$cacheClave = md5($cacheName);
		$datos = $cache->load($cacheClave);
		
		if(false == $datos || $purgar == 'purgar' ){
			try{
				$cols = $data;
				$resultado = $this->select()->from('usuario',$cols)->where(' cEmail ="cheque_1026@hotmail.com" ');
				$resultado->query()->fetchAll();
				
				$dato = $datos;
	
				$TiempoCache = 3600;
				$cache->setLifetime($TiempoCache);
				$cache->save($dato,$cacheClave);
				
				return $dato;
	
			}catch(Zend_Exception $e){
				
				return false;
			}
		}
		return $datos;
	}
}
