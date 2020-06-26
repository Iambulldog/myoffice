<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'backend';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// $route['api/(:any)'] = 'api/$1';
$route['backend/(:any)'] = 'backend/$1';
$route['users/(:any)'] = 'users/$1';
// $route['frontend/(:any)'] = 'frontend/$1';
