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
class Image extends REST_Controller {

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
        $params = $this->get();
        $response = $this->Media->getImage($params);
        if ($response['status']) {
            if (file_exists($response['data']['imagen'])){ 
                $type = $response['data']['type'];
                
                //header('Content-Length: ' . filesize($response['data']['imagen']));
                header("Content-Type: $type");
                header('Content-Disposition: inline; filename="' . $response['data']['filename'] . '";');

                $x = @$params['x'];
                $y = @$params['y'];
                $w = @$params['w'];
                $h = @$params['h'];

                if ($x === NULL and $y === NULL and ($w > -1 or $h > -1)) {
                    //RESIZE
                    $this->Utils->resizeImage($response['data']['imagen'], $w, $h);
                } else if ($x > -1 and $y > -1 and $w > 0 and $h > 0) {
                    //CROP
                    $this->Utils->cropImage($response['data']['imagen'], $w, $h, $x, $y);
                } else {
                    //NORMAL
                    readfile($response['data']['imagen']);
                }
                die();
                exit;
            }
        }
        
        $this->response(NULL, REST_Controller::HTTP_NOT_FOUND);
    }
}