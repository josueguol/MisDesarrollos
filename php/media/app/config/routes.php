<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


/*
| -------------------------------------------------------------------------
| REST API Routes
| -------------------------------------------------------------------------
*/

//REQUEST UPLOAD
$route['media/manager/upload'] = 'media/manager/upload';


//OVERVIEW
//
/*
$route['api/futbol/overview'] = 'api/futbol/overview';
*/
//FRONT CONFIG
//$route['api/futbol/front/location/(:any)'] = 'api/futbol/front/location/$1';

//GENERICO
//
//
/*
$route['api/futbol/partidos/(:any)'] = 'api/futbol/partidos/model/$1';
$route['api/futbol/partidos/(:any)/page/(:num)'] = 'api/futbol/partidos/model/$1/page/$2'; //PAGINATION

$route['api/futbol/partidos/(:any)/id/(:num)'] = 'api/futbol/partidos/model/$1/id/$2';
$route['api/futbol/partidos/(:any)/id/(:num)/page/(:num)'] = 'api/futbol/partidos/model/$1/id/$2/page/$3'; //PAGINATION
*/
/* 
| -----------------------------------------------------------------------------
| CURRENT:  Query all active rows
| EQUAL: Field equal Value ?key=field_name&value=Some Value
| LIKE: Field like Value ?key=field_name&value=Some Value
| -----------------------------------------------------------------------------
*/

/*
$route['api/futbol/partidos/(:any)/query/(:any)'] = 'api/futbol/partidos/model/$1/query/$2';
$route['api/futbol/partidos/(:any)/query/(:any)/page/(:num)'] = 'api/futbol/partidos/model/$1/query/$2/page/$3'; //PAGINATION

*/

//ESPECIFICO
/*
$route['api/futbol/partidos/(:any)/id_torneo/(:num)'] = 'api/futbol/partidos/model/$1/id_torneo/$2';
$route['api/futbol/partidos/(:any)/id_torneo/(:num)/page/(:num)'] = 'api/futbol/partidos/model/$1/id_torneo/$2/page/$3';

$route['api/futbol/partidos/(:any)/id_temporada/(:num)'] = 'api/futbol/partidos/model/$1/id_temporada/$2';
$route['api/futbol/partidos/(:any)/id_temporada/(:num)/page/(:num)'] = 'api/futbol/partidos/model/$1/id_temporada/$2/page/$3';

$route['api/futbol/partidos/(:any)/id_jornada/(:num)'] = 'api/futbol/partidos/model/$1/id_jornada/$2';
$route['api/futbol/partidos/(:any)/id_jornada/(:num)/page/(:num)'] = 'api/futbol/partidos/model/$1/id_jornada/$2/page/$3';
*/



//TORNEOS
//$route['api/futbol/(:num)'] = 'api/torneos/id/$1';
//$route['api/futbol/(:num)(\.)([a-zA-Z0-9_-]+)(.*)'] = 'api/futbol/torneos/id/$1/format/$3$4';
// JORNADAS
//$route['api/futbol/(:num)'] = 'api/jornadas/id/$1';
//$route['api/futbol/(:num)(\.)([a-zA-Z0-9_-]+)(.*)'] = 'api/futbol/jornadas/id/$1/format/$3$4';
