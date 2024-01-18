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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller'] = 'Clogin';
$route['404_override'] = 'Cerror';
$route['translate_uri_dashes'] = FALSE;

// Broom Main Controller
$route['settings'] = 'Csetting';
$route['dashboard'] = 'Cdashboard';
$route['login'] = 'Clogin';
$route['register'] = 'Cregister';
$route['logout'] = 'Clogout';
$route['rooms'] = 'Crooms';
$route['reservation'] = 'Creservasi';
$route['notifications'] = 'Cnotification';

// Broom Setting Controller
$route['settings/(:any)'] = 'Csetting/$1';

// Broom Dashboard Controller
$route['dashboard/(:any)'] = 'Cdashboard/$1';

// Broom Login Controller
$route['login/(:any)/(:any)/(:any)'] = $route['login'].'/$1/$2/$3';
$route['login/(:any)/(:any)'] = $route['login'].'/$1/$2';
$route['login/(:any)'] = $route['login'].'/$1';

// Broom Register Controller
$route['register/(:any)/(:any)/(:any)'] = $route['register'].'/$1/$2/$3';
$route['register/(:any)/(:any)'] = $route['register'].'/$1/$2';
$route['register/(:any)'] = $route['register'].'/$1';

// Broom Room Controller
$route['rooms/(:any)/(:any)/(:any)'] = $route['rooms'].'/$1/$2/$3';
$route['rooms/(:any)/(:any)'] = $route['rooms'].'/$1/$2';
$route['rooms/(:any)'] = $route['rooms'].'/$1';

// Broom Reservation Controller
$route['reservation/(:any)/(:any)/(:any)'] = $route['reservation'].'/$1/$2/$3';
$route['reservation/(:any)/(:any)'] = $route['reservation'].'/$1/$2';
$route['reservation/(:any)'] = $route['reservation'].'/$1';

// Broom Notification Controller
$route['notifications/(:any)/(:any)/(:any)'] = $route['notifications'].'/$1/$2/$3';
$route['notifications/(:any)/(:any)'] = $route['notifications'].'/$1/$2';
$route['notifications/(:any)'] = $route['notifications'].'/$1';

// Broom Account URL on Pengelola
$route['account/peminjam'] = 'Cpengelola/view_data_peminjam';
$route['account/peminjam/search'] = 'Cpengelola/search';
$route['account/peminjam/history/(:num)'] = 'Cpengelola/jejak/$1';
$route['account/pimpinan'] = 'Cpengelola/view_data_pimpinan';
$route['account/peminjam/history/(:num)'] = 'Cpengelola/jejak/$1';