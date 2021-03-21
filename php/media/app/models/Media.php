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
 * @copyright     Copyright (c) 2017, Pixgram
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

    public function saveMid($pid) {
        $data = array();
        $mid = null;
        $date = new DateTime();
        $year = $date->format("Y");
        $week = $date->format("W");
        $upload_path = STORAGE . 'media/image/' . $pid . '/' . $year . $week . '/';

        do {
            $mid = $this->Utils->genMid(9);

            $data = [
               'mid' => $mid,
               'pid' => $pid,
               'year_week' => $year . $week
            ];

            $this->db->insert('mids', $data); 
        } while ($this->db->affected_rows() == 0);

        $config['upload_path'] = $upload_path;
        $config['file_name'] = $mid;

        return $config;
    }

    public function updateMid($mid, $upload_data) {
        $this->db->where('mid', $mid);
        return $this->db->update('mids', $upload_data);
    }

    public function getData($pid, $page) {
        try {
            $pagination = NULL;
            if ($page === NULL or $page < 1) {
                $page = 1;
            }
            $this->db->from('mids');
            $this->db->where('pid', $pid);

            // Pagination
            $db = clone $this->db;
            $temp_query = $db->get();
            $pagination['rows'] = $temp_query->num_rows();
            $pagination['page'] = $page;
            $pagination['total_pages'] = ceil($pagination['rows'] / $this->pageLimit);
            $this->setPage($page);

            $query = $this->db->get();
            $data = $query->result_array();

            return [
                'status' => TRUE,
                'message' => NULL,
                'data' => $data,
                'pagination' => $pagination
            ];
        } catch (Exception $e) {
            return [
                'status' => FALSE,
                'message' => $e->getMessage(),
                'data' => NULL,
                'pagination' => NULL
            ];
        }
    }

    private function setPage($page){
        $page = $this->pageLimit * ($page - 1);
        $this->db->limit($this->pageLimit, $page);
    }
}