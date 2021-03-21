<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

/**
 * Api Controller
 * REST Service 
 *
 * @package       CodeIgniter
 * @subpackage    Rest Server
 * @category      Controller
 * @author        -
 * @copyright     Copyright (c) 2017, Pixgram CDN
 * @license       http://-
 * @link          http://-
 * @since         Version 1.0.0
 */
class Futbol extends REST_Controller {

    function __construct() {
        // Construct the parent class
        parent::__construct();
        header('Access-Control-Allow-Origin: *');

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['user_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['user_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['user_delete']['limit'] = 50; // 50 requests per hour per user/key
    }

    public function index_get() {
        
        $response = [
            "status" => TRUE,
            "message" => "OK",
            "data" => NULL
        ];

        $this->setResponse($response);
    }
}