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
 * @copyright     Copyright (c) 2017, Pixgram
 * @license       http://-
 * @link          http://-
 * @since         Version 1.0.0
 */
class Manager extends RESTF_Controller {

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

        $this->response($response, RESTF_Controller::HTTP_OK);
    }

    public function index_post() {
        
        $response = [
            "status" => TRUE,
            "message" => "OK",
            "data" => NULL
        ];

        $this->response($response, RESTF_Controller::HTTP_OK);
    }

    public function upload_post() {
        $auth = $this->input->get_request_header('Authorization', TRUE);
        $data = NULL;

        $validation = $this->validLogin($auth);

        if ($validation['status']) {

            $config = $this->Media->saveMid($validation['token']->pid);
            $config['allowed_types'] = 'gif|jpg|png';
            $this->load->library('upload', $config);

            if (!file_exists($config['upload_path'])) {
                mkdir($config['upload_path'], 0755, true);
            }

            if (!$this->upload->do_upload('fileupload'))
            {
                $validation['status'] = FALSE;
                $validation['message'] = $this->upload->display_errors();
                $validation['return_request'] = RESTF_Controller::HTTP_OK;//RESTF_Controller::HTTP_NOT_ACCEPTABLE;
            } else {
                $mid = $this->upload->data()['raw_name'];
                $data['media_type'] = $this->upload->data()['file_type'];
                $data['extension'] = $this->upload->data()['file_ext'];
                $data['metadata'] = 'fnm::' . $this->upload->data()['client_name'] . '|';
                $data['metadata'] .= 'siz::' . $this->upload->data()['file_size'] . '|';
                $data['metadata'] .= 'wxh::' . $this->upload->data()['image_width']
                    . 'x' . $this->upload->data()['image_height'];
                $this->Media->updateMid($mid, $data);

                // SAVE THUMBNAIL
                $this->Utils->createThumbnail($config['upload_path'], $config['upload_path'] . 'thumbnail/', $mid . $data['extension']);

                $data['mid'] = $mid;
            }
        }

        $response = [
            'status' => $validation['status'],
            'message' => $validation['message'],
            'data' => $data,
            'pagination' => NULL
        ];

        $this->response($response, $validation['return_request']);
    }

    public function data_post() {
        $auth = $this->input->get_request_header('Authorization', TRUE);
        $data = NULL;
        $pagination = NULL;

        $validation = $this->validLogin($auth);

        if ($validation['status']) {
            $page = $this->post('page');
            $data = $this->Media->getData($validation['token']->pid, $page);
            $validation['status'] = $data['status'];
            $validation['message'] = $data['message'];
            $pagination = $data['pagination'];
            $data = $data['data'];
        }

        $response = [
            'status' => $validation['status'],
            'message' => $validation['message'],
            'data' => $data,
            'pagination' => $pagination
        ];

        $this->response($response, $validation['return_request']);
    }

    private function validLogin($auth) {
        $auth = $this->input->get_request_header('Authorization', TRUE);
        $obj = array();
        if ($auth) {
            list($jwt) = sscanf($auth, 'Bearer %s');
            if ($jwt) {
                try {
                    $secretKey = $this->config->item('jwt_key');
                    $token = JWT::decode($jwt, $secretKey, array('HS512'));

                    $obj['status'] = TRUE;
                    $obj['message'] = NULL;
                    $obj['return_request'] = RESTF_Controller::HTTP_OK;
                    $obj['token'] = $token;

                    return $obj;
                } catch (Exception $e) {
                    $obj['status'] = FALSE;
                    $obj['message'] = "No se puede decodificar el token, debido a que no es correcto.";
                    $obj['return_request'] = RESTF_Controller::HTTP_UNAUTHORIZED;

                    return $obj;
                }
            } else {
                $obj['status'] = FALSE;
                $obj['message'] = "No se pudo extraer ningun token de la cabecera, viene vacia.";
                $obj['return_request'] = RESTF_Controller::HTTP_BAD_REQUEST;

                return $obj;
            }
        } else {
            $obj['status'] = FALSE;
            $obj['message'] = "La cabecera carece de información de autorización.";
            $obj['return_request'] = RESTF_Controller::HTTP_BAD_REQUEST;

            return $obj;
        }
    }

    /*public function jornadas_update() {
        
    }

    public function jornadas_delete() {
        $id = (int) $this->get('id');

        // Validate the id.
        if ($id <= 0)
        {
            // Set the response and exit
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

        // $this->some_model->delete_something($id);
        $message = [
            'id' => $id,
            'message' => 'Deleted the resource'
        ];

        $this->set_response($message, REST_Controller::HTTP_NO_CONTENT); // NO_CONTENT (204) being the HTTP response code
    }*/
}