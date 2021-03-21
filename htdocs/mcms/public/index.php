<?php
/**
 *
 * @package	MCMS
 * @author	Josué Gutiérrez Olivares
 * @copyright	Copyright (c) 2020 Pixcan. (http://www.pixcan.com/)
 * @license	http://  Unknown
 * @link	http://pixcan.com/mcms
 * @since	Version 1.0.0
 * @filesource
 */

/*
 *---------------------------------------------------------------
 * APPLICATION ENVIRONMENT
 *---------------------------------------------------------------
 *
 * You can load different configurations depending on your
 * current environment. Setting the environment also influences
 * things like logging and error reporting.
 *
 * This can be set to anything, but default usage is:
 *
 *     development
 *     production
 *
 * NOTE: If you change these, also change the error_reporting() code below
 */
	define('ENVIRONMENT', isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : 'production');

/*
 *---------------------------------------------------------------
 * ERROR REPORTING
 *---------------------------------------------------------------
 *
 * Different environments will require different levels of error reporting.
 * By default development will show errors but testing and live will hide them.
 */
switch (ENVIRONMENT)
{
	case 'development':
		error_reporting(-1);
		ini_set('display_errors', 1);
	break;

	case 'production':
		ini_set('display_errors', 0);
		if (version_compare(PHP_VERSION, '5.3', '>='))
		{
			error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
		}
		else
		{
			error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE);
		}
	break;

	default:
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
		echo 'The application environment is not set correctly.';
		exit(1); // EXIT_ERROR
}

/*
 *---------------------------------------------------------------
 * APPLICATION FOLDER NAME
 *---------------------------------------------------------------
 *
 * If you want this front controller to use a different "application"
 * folder than the default one you can set its name here. The folder
 * can also be renamed or relocated anywhere on your server. If
 * you do, use a full server path.
 *
 * NO TRAILING SLASH!
 */
$application_folder = '../app';

/*
 *---------------------------------------------------------------
 * VIEW,CONFIG,CORE,CONTROLLER,MODEL FOLDER's NAME
 *---------------------------------------------------------------
 */
$view_folder = '';
$config_folder = '';
$core_folder = '';
$controller_folder = '';
$model_folder = '';
$lib_folder = '';


/*
 * ---------------------------------------------------------------
 *  Resolve the system path for increased reliability
 * ---------------------------------------------------------------
 */

// Set the current directory correctly for CLI requests
if (defined('STDIN'))
{
	chdir(dirname(__FILE__));
}


/*
 * -------------------------------------------------------------------
 *  Now that we know the path, set the main path constants
 * -------------------------------------------------------------------
 */
// The extension files
define('EXT', '.php');

// The name of THIS file
define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));

// Path to the front controller (this file)
define('WEBROOT', dirname(__FILE__).'/');

// The path to the "application" folder
if (is_dir($application_folder))
{
	if (($_temp = realpath($application_folder)) !== FALSE)
	{
		$application_folder = $_temp;
	}

	define('APPPATH', $application_folder.DIRECTORY_SEPARATOR);
}
else
{
	header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
	echo 'Your application folder path does not appear to be set correctly. Please open the following file and correct this: '.SELF;
	exit(3);
}

// The path to the "views" folder
if ( ! is_dir($view_folder))
{
	if ( ! empty($view_folder) && is_dir(APPPATH.$view_folder.DIRECTORY_SEPARATOR))
	{
		$view_folder = APPPATH.$view_folder;
	}
	elseif ( ! is_dir(APPPATH.'views'.DIRECTORY_SEPARATOR))
	{
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
		echo 'Your view folder path does not appear to be set correctly. Please open the following file and correct this: '.SELF;
		exit(3); // EXIT_CONFIG
	}
	else
	{
		$view_folder = APPPATH.'views';
	}
}
if (($_temp = realpath($view_folder)) !== FALSE)
{
	$view_folder = $_temp.DIRECTORY_SEPARATOR;
}
else
{
	$view_folder = rtrim($view_folder, '/\\').DIRECTORY_SEPARATOR;
}
define('VIEWPATH', $view_folder);

if ( ! is_dir($config_folder))
{
	if ( ! empty($config_folder) && is_dir(APPPATH.$config_folder.DIRECTORY_SEPARATOR))
	{
		$config_folder = APPPATH.$config_folder;
	}
	elseif ( ! is_dir(APPPATH.'config'.DIRECTORY_SEPARATOR))
	{
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
		echo 'Your config folder path does not appear to be set correctly. Please open the following file and correct this: '.SELF;
		exit(3); // EXIT_CONFIG
	}
	else
	{
		$config_folder = APPPATH.'config';
	}
	
}
if (($_temp = realpath($config_folder)) !== FALSE)
{
	$config_folder = $_temp.DIRECTORY_SEPARATOR;
}
else
{
	$config_folder = rtrim($config_folder, '/\\').DIRECTORY_SEPARATOR;
}
define('CONFIGPATH', $config_folder);

if ( ! is_dir($core_folder))
{
	if ( ! empty($core_folder) && is_dir(APPPATH.$core_folder.DIRECTORY_SEPARATOR))
	{
		$core_folder = APPPATH.$core_folder;
	}
	elseif ( ! is_dir(APPPATH.'core'.DIRECTORY_SEPARATOR))
	{
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
		echo 'Your core folder path does not appear to be set correctly. Please open the following file and correct this: '.SELF;
		exit(3); // EXIT_CONFIG
	}
	else
	{
		$core_folder = APPPATH.'core';
	}
	
}
if (($_temp = realpath($core_folder)) !== FALSE)
{
	$core_folder = $_temp.DIRECTORY_SEPARATOR;
}
else
{
	$core_folder = rtrim($core_folder, '/\\').DIRECTORY_SEPARATOR;
}
define('COREPATH', $core_folder);

if ( ! is_dir($controller_folder))
{
	if ( ! empty($controller_folder) && is_dir(APPPATH.$controller_folder.DIRECTORY_SEPARATOR))
	{
		$controller_folder = APPPATH.$controller_folder;
	}
	elseif ( ! is_dir(APPPATH.'controllers'.DIRECTORY_SEPARATOR))
	{
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
		echo 'Your controllers folder path does not appear to be set correctly. Please open the following file and correct this: '.SELF;
		exit(3); // EXIT_CONFIG
	}
	else
	{
		$controller_folder = APPPATH.'controllers';
	}
	
}
if (($_temp = realpath($controller_folder)) !== FALSE)
{
	$controller_folder = $_temp.DIRECTORY_SEPARATOR;
}
else
{
	$controller_folder = rtrim($controller_folder, '/\\').DIRECTORY_SEPARATOR;
}
define('CONTROLLERPATH', $controller_folder);

if ( ! is_dir($model_folder))
{
	if ( ! empty($model_folder) && is_dir(APPPATH.$model_folder.DIRECTORY_SEPARATOR))
	{
		$model_folder = APPPATH.$model_folder;
	}
	elseif ( ! is_dir(APPPATH.'models'.DIRECTORY_SEPARATOR))
	{
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
		echo 'Your models folder path does not appear to be set correctly. Please open the following file and correct this: '.SELF;
		exit(3); // EXIT_CONFIG
	}
	else
	{
		$model_folder = APPPATH.'models';
	}
	
}
if (($_temp = realpath($model_folder)) !== FALSE)
{
	$model_folder = $_temp.DIRECTORY_SEPARATOR;
}
else
{
	$model_folder = rtrim($model_folder, '/\\').DIRECTORY_SEPARATOR;
}
define('MODELPATH', $model_folder);

if ( ! is_dir($lib_folder))
{
	if ( ! empty($lib_folder) && is_dir(APPPATH.$lib_folder.DIRECTORY_SEPARATOR))
	{
		$lib_folder = APPPATH.$lib_folder;
	}
	elseif ( ! is_dir(APPPATH.'library'.DIRECTORY_SEPARATOR))
	{
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
		echo 'Your library folder path does not appear to be set correctly. Please open the following file and correct this: ' . SELF;
		exit(3); // EXIT_CONFIG
	}
	else
	{
		$lib_folder = APPPATH.'library';
	}
	
}
if (($_temp = realpath($lib_folder)) !== FALSE)
{
	$lib_folder = $_temp.DIRECTORY_SEPARATOR;
}
else
{
	$lib_folder = rtrim($lib_folder, '/\\').DIRECTORY_SEPARATOR;
}
define('LIBPATH', $lib_folder);

require COREPATH.'main.php';
require COREPATH.'router.php';
require COREPATH.'request.php';
require COREPATH.'dispatcher.php';

$dispatch = new Dispatcher();
$dispatch->dispatch();