<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/RESTF_Controller.php';

/**
 * Api Controller
 * REST Service 
 *
 * @package       CodeIgniter
 * @subpackage    Rest Server
 * @category      Controller
 * @author        -
 * @copyright     Copyright (c) 2019, Josué Gutiérrez
 * @license       http://-
 * @link          http://-
 * @since         Version 1.0.0
 */
class Xoc extends RESTF_Controller {
    function __construct() {
        // Construct the parent class
        parent::__construct();
        header('Access-Control-Allow-Origin: tvaservices.local');

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['user_get']['limit'] = 300; // 300 requests per hour per user/key
        $this->methods['user_post']['limit'] = 50; // 50 requests per hour per user/key
        $this->methods['user_delete']['limit'] = 20; // 20 requests per hour per user/key
    }

    public function index_get() {
        $response = [
            "message" => "OK",
            "data" => NULL
        ];

        $this->response($response, parent::HTTP_OK);
    }

    public function index_post() {
        $response = [
            "message" => "OK",
            "data" => NULL
        ];

        $this->response($response, parent::HTTP_OK);
    }

    public function change_post() {
        $validation = $this->verify_request();

        if ($validation["status"]) {
            $switch = $this->post('switch');
            if ($switch === NULL) {
                $response = [
                    "message" => "Falta parametro 'switch'",
                    "data" => NULL
                ];

                $this->response($response, parent::HTTP_BAD_REQUEST);
                exit();
            }

            $data = $this->Data->change($switch);

            if ($data !== FALSE) {
                $response = [
                    "message" => "OK",
                    "data" => NULL
                ];

                $this->response($response, parent::HTTP_OK);
            } else {
                $response = [
                    "message" => "Error al procesar los datos o no se puede escribir en el almacen.",
                    "data" => $this->input->post()
                ];

                $this->response($response, parent::HTTP_BAD_REQUEST);
            } 
        } else {
            $response = [
                "message" => $validation["message"],
                "data" => NULL
            ];

            $this->response($response, parent::HTTP_UNAUTHORIZED);
        }
    }

    public function status_post() {
        $validation = $this->verify_request();

        if ($validation["status"]) {
            $data = $this->Data->state();

            if ($data !== FALSE) {
                $response = [
                    "message" => "OK",
                    "data" => $data
                ];

                $this->response($response, parent::HTTP_OK);
            } else {
                $response = [
                    "message" => "Error al obtener datos, revise con su administrador.",
                    "data" => NULL
                ];

                $this->response($response, parent::HTTP_FORBIDDEN);
            }            
        } else {
            $response = [
                "message" => $validation["message"],
                "data" => NULL
            ];

            $this->response($response, parent::HTTP_UNAUTHORIZED);
        }
    }

    public function login_post() {
        $username = $this->post("username");
        $password = $this->post("password");

        $data = $this->User->validateUser($username, $password);

        if ($data !== FALSE) {
            $token = AUTHORIZATION::generateToken($data["userlogin"]);

            $response = [
                "message" => "OK",
                "data" => [
                    "name" => $data["username"],
                    "token" => $token
                ]
            ];

            $this->response($response, parent::HTTP_OK);
        } else {
            $response = [
                "message" => "Usuario o contraseña invalida.",
                "data" => NULL
            ];

            $this->response($response, parent::HTTP_UNAUTHORIZED);
        }
    }

    private function verify_request() {
        $headers = $this->input->request_headers();
        $auth = $headers['Authorization'];

        //$auth = $this->input->get_request_header('Authorization', TRUE);

        try {
            $data = AUTHORIZATION::validateToken($auth);
            if ($data === FALSE) {
                $response = ["status" => FALSE, "message" => "Acceso no autorizado."];

                return $response;
            } else {
                $response = ["status" => TRUE, "message" => "Acceso concedido."];

                return $response;
            }
        } catch (Exception $e) {
            $response =  ["status" => FALSE, "message" => "Acceso no autorizado."];

            return $response;
        }
    }    
}