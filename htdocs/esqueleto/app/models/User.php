<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User. Accesos al modelo de datos de usuarios.
 *
 * @package       CodeIgniter
 * @subpackage    Rest Server
 * @category      Model
 * @author        -
 * @copyright     Copyright (c) 2017, TV Azteca
 * @license       http://-
 * @link          http://-
 * @since         Version 1.0.0
 */
class User extends CI_Model {
    
    var $storagePath = STORAGE . 'users/usuarios.xml';
    var $xml = NULL;

    /**
     * Constructor.
     */
    function __construct() {
        parent::__construct ();
        $this->xml = simplexml_load_file($this->storagePath);
    }

    public function validateUser($username, $password) {
        $pass = hash('sha512',$password);
        $usuarios = $this->xml->xpath("/Usuarios/Usuario[Identificador = '$username' and Clave = '$pass']");
        if (count($usuarios) > 0) {
            $data = [
                "username" => (string)$usuarios[0]->Nombre,
                "userlogin" => (string)$usuarios[0]->Identificador
            ];

            return $data;
        } else {
            return FALSE;
        }
    }

}