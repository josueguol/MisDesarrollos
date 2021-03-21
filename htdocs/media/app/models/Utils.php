<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Relational. Accesos al modelo de datos
 * Modelo relacional MySql o MariaDB
 * 
 * @package       CodeIgniter
 * @subpackage    Rest Server
 * @category      Model
 * @author        -
 * @copyright     Copyright (c) 2016, Pixgram
 * @license       http://-
 * @link          http://-
 * @since         Version 1.0.0
 */
class Utils extends CI_Model {
    const NUMERIC = '0123456789';
    const LETTERS = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    /**
     * Constructor.
     */
    function __construct() {
        parent::__construct ();
        $this->load->database();
    }

    /**
     * Generate a random string, using a cryptographically secure 
     * pseudorandom number generator (random_int)
     * 
     * For PHP 7, random_int is a PHP core function
     * For PHP 5.x, depends on https://github.com/paragonie/random_compat
     * 
     * @param int $length      How many characters do we want?
     * @param string $keyspace A string of all possible characters
     *                         to select from
     * @return string
     */
    public function genMid($length) {
        $keyspace = self::NUMERIC . self::LETTERS;

        $max = mb_strlen($keyspace, '8bit') - 1;

        $randomString = '';
        for ($i = 0; $i < $length; ++$i) {
            $randomString .= $keyspace[random_int(0, $max)];
        }

        return $randomString;
    }

    public function createThumbnail($source, $dest, $name)
    {
        if (!file_exists($dest)) {
            mkdir($dest, 0755, true);
        }
        list($width, $height) = getimagesize($source . $name);
        $info = getimagesize($source . $name);

        $thumb = NULL;
        $newWidth = NULL;
        $newHeight = NULL;

        if($width > $height) {
            $ratio = $height / $width;
            $newWidth = 255;
            $newHeight = 255 * $ratio;
        } else {
            $ratio = $width / $height;
            $newHeight = 255;
            $newWidth = 255  * $ratio;
        }

        $thumb = imagecreatetruecolor($newWidth, $newHeight);

        $methodCreate = "";
        $methodSave = "";

        switch ($info['mime']) {
            case 'image/jpeg':
                $methodCreate = "imagecreatefromjpeg";
                $methodSave = "imagejpeg";
            break;
            case 'image/png':
                $methodCreate = "imagecreatefrompng";
                $methodSave = "imagepng";
            break;
            case 'image/gif':
                $methodCreate = "imagecreatefromgif";
                $methodSave = "imagegif";
            break;
        }

        $image = call_user_func($methodCreate, $source . $name);

        imagecopyresized($thumb, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

        call_user_func($methodSave, $thumb, $dest . $name);
        imagedestroy($thumb);
        imagedestroy($image);
    }
}

