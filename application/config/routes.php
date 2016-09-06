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
  |	https://codeigniter.com/user_guide/general/routing.html
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

$route['usuarios/(:num)']['get'] = 'usuarios/one/$1';
$route['usuarios/(:num)']['put'] = 'usuarios/update/$1';
$route['usuarios/(:num)']['delete'] = 'usuarios/remove/$1';

$route['clientes/(:num)']['get'] = 'clientes/one/$1';
$route['clientes/(:num)']['put'] = 'clientes/update/$1';
$route['clientes/(:num)']['delete'] = 'clientes/remove/$1';

$route['productos/(:num)']['get'] = 'productos/one/$1';
$route['productos/(:num)']['put'] = 'productos/update/$1';
$route['productos/(:num)']['delete'] = 'productos/remove/$1';

$route['parametros/(:num)']['get'] = 'parametros/one/$1';
$route['parametros/(:num)']['put'] = 'parametros/update/$1';
$route['parametros/(:num)']['delete'] = 'parametros/remove/$1';

$route['cotizaciones/(:num)']['get'] = 'cotizaciones/one/$1';
$route['cotizaciones/(:num)']['put'] = 'cotizaciones/update/$1';
$route['cotizaciones/(:num)']['delete'] = 'cotizaciones/remove/$1';

$route['rolesusuarios/(:num)']['get'] = 'rolesusuarios/one/$1';
$route['rolesusuarios/(:num)']['put'] = 'rolesusuarios/update/$1';
$route['rolesusuarios/(:num)']['delete'] = 'rolesusuarios/remove/$1';

$route['gastosextras/(:num)']['get'] = 'gastosextras/one/$1';
$route['gastosextras/(:num)']['put'] = 'gastosextras/update/$1';
$route['gastosextras/(:num)']['delete'] = 'gastosextras/remove/$1';


$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
