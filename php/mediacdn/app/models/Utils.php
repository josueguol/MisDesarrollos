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
 * @copyright     Copyright (c) 2017, Pixgram CDN
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

    public function resizeImage($image_path, $newWidth, $newHeight) {
        $newWidth = $newWidth !== NULL ? $newWidth : 0;
        $newHeight = $newHeight !== NULL ? $newHeight : 0;

        list($width, $height) = getimagesize($image_path);
        $info = getimagesize($image_path);

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

        $ratioX = $newWidth / $width;
        $ratioY = $newHeight / $height;

        $ratio = $ratioX > $ratioY ? $ratioX : $ratioY;

        $newWidth = $width * $ratio;
        $newHeight = $height * $ratio;

        $thumb = imagecreatetruecolor($newWidth, $newHeight);
        $image = call_user_func($methodCreate, $image_path);

        imagecopyresized($thumb, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

        //call_user_func($methodSave, $thumb, $dest . $name);
        call_user_func($methodSave, $thumb);
        imagedestroy($thumb);
        imagedestroy($image);
    }

    public function cropImage($image_path, $newWidth, $newHeight, $x, $y) {
        list($width, $height) = getimagesize($image_path);
        $info = getimagesize($image_path);

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

        $ratioX = $newWidth / $width;
        $ratioY = $newHeight / $height;

        $ratio = $ratioX > $ratioY ? $ratioX : $ratioY;

        $thumb = imagecreatetruecolor($newWidth, $newHeight);
        $image = call_user_func($methodCreate, $image_path);

        $widthCut = $newWidth / $ratio;
        $heightCut = $newHeight / $ratio;

        $upx = $x - ($widthCut / 2);
        $upy = $y - ($heightCut / 2);
        $botx = $x + ($widthCut / 2);
        $boty = $y + ($heightCut / 2);

        if ($upx < 0) {
            $upx = 0;
        }
        if ($botx > $width) {
            $upx = $width - $widthCut;
        }
        if ($upy < 0) {
            $upy = 0;
        }
        if ($boty > $height) {
            $upy = $height - $heightCut;
        }

        imagecopyresized($thumb, $image, 0, 0,  $upx,  $upy, $newWidth, $newHeight, $widthCut, $heightCut);

        call_user_func($methodSave, $thumb);
        imagedestroy($thumb);
        imagedestroy($resize);
    }
}

