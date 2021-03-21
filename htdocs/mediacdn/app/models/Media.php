<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Media. Accesos al modelo de datos
 * Modelo de acceso a datos de multimedia. MySql o MariaDB
 *
 * @package       CodeIgniter
 * @subpackage    Rest Server
 * @category      Model
 * @author        -
 * @copyright     Copyright (c) 2017, Pixgram CDN
 * @license       http://-
 * @link          http://-
 * @since         Version 1.0.0
 */
class Media extends CI_Model {
    var $pageLimit = 10;

    /**
     * Constructor.
     */
    function __construct() {
        parent::__construct ();
    }

    public function getImage($params) {
        try {
            $this->db->from('mids');
            $this->db->where('pid', $params['pid']);
            $this->db->where('mid', $params['mid']);
            
            $query = $this->db->get();
            $rows = $query->num_rows();

            if ($rows === 1) {
                $data = $query->result_array()[0];

                $thumb = NULL;
                if(@$params['thumb']) { $thumb = 'thumbnail/'; }

                $image_path = STORAGE . 'media/image/' . $params['pid'] . '/' . $data['year_week'] . '/' . $thumb . $params['mid'] . $data['extension'];

                return [
                    'status' => TRUE,
                    'data' => [
                        'type' => $data['media_type'],
                        'filename' => $params['mid'] . $data['extension'],
                        'imagen' => $image_path
                    ]
                ];
            }
        } catch (Exception $e) { }
        return [
            'status' => FALSE,
            'data' => NULL
        ];
    }
}