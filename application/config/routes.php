<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'Welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// login
$route['login']['GET'] = 'LoginController/index';
$route['logout']['GET'] = 'LoginController/logout';
$route['login-user']['POST'] = 'LoginController/login';

// dashboard
$route['cms/dashboard']['GET'] = 'DashboardController/index';

// category
$route['cms/categories']['GET'] = 'CategoryController/index';
