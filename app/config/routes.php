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
$route['default_controller'] = 'front/login/login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['mem-panel'] = 'front/login/login';

$route['sign-in-action'] = 'front/login/login/action';

$route['logout'] = 'front/login/login/logout';

$route['dashboard'] = 'front/dashboard';

$route['topup'] = 'front/topup';

$route['topup-json'] = 'front/topup/json';

$route['topup-add'] = 'front/topup/add';

$route['topup-add-action'] = 'front/topup/add_action';

$route['topup-detail/(:num)/(:any)'] = 'front/topup/detail/$1/$2';

$route['topup-konfirmasi/(:num)/(:any)'] = 'front/topup/konfirmasi/$1/$2';

$route['withdraw'] = 'front/withdraw';

$route['withdraw-json'] = 'front/withdraw/json';

$route['withdraw-add'] = 'front/withdraw/add';

$route['withdraw-add-action'] = 'front/withdraw/add_action';

$route['withdraw-konfirmasi/(:any)/(:any)'] = 'front/withdraw/konfirmasi/$1/$2';

$route['withdraw-detail/(:any)/(:any)'] = 'front/withdraw/detail/$1/$2';
