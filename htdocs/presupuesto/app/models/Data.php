<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Data. Accesos al modelo de almacenamiento.
 *
 * @package       CodeIgniter
 * @subpackage    Rest Server
 * @category      Model
 * @author        -
 * @copyright     Copyright (c) 2019, Josué Gutiérrez
 * @license       http://-
 * @link          http://-
 * @since         Version 1.0.0
 */
class Data extends CI_Model {
    
    /**
     * Constructor.
     */
    function __construct() {
        parent::__construct ();

        $this->load->database();
    }

    public function change($switch) {
        $data = NULL;

        if ($switch === 'true' || $switch === 'false') {

            if (!file_exists($this->storagePath)) {
                if (!$this->createFile()) {
                    return FALSE;
                }
            }

            $data = $this->updateFile($switch);

            return $data;
        }
        
        return FALSE;
    }

    public function state() {
        $data = NULL;

        if (!file_exists($this->storagePath)) {
            if (!$this->createFile()) {
                return FALSE;
            }
        }

        if (FALSE === $json = file_get_contents($this->storagePath)) {
            return FALSE;
        }
        
        $data = json_decode($json, true);

        return $data;
    }

    
    private function createFile() {
        $json = array(
            "status" => FALSE,
            "description" => NULL
        );

        if (file_put_contents($this->storagePath, json_encode($json))) {
            return TRUE;
        }

        return FALSE;
    }

    private function updateFile($switch) {
        $json = file_get_contents($this->storagePath);
        $data = json_decode($json, true);

        $data["status"] = $switch;

        if (file_put_contents($this->storagePath, json_encode($data), LOCK_EX)) {
            return TRUE;
        }

        return FALSE;  
    }
}