<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Exception. Exception handler.
 * 
 * @package       CodeIgniter
 * @subpackage    Core Implemetations
 * @category      Exceptions
 * @author        -
 * @copyright     Copyright (c) 2016, La quinelita
 * @license       http://-
 * @link          http://-
 * @since         Version 1.0.0
 */
class MY_Exceptions extends CI_Exceptions
{
    function show_error($heading, $message, $template = 'error_general', $status_code = 500)
    {
        log_message( 'debug', print_r( $message, TRUE ) );
        throw new Exception(is_array($message) ? $message[1] : $message, $status_code );
    }
}