<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'Welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// admin - login
$route['login']['GET'] = 'LoginController/index';
$route['logout']['GET'] = 'LoginController/logout';
$route['login-user']['POST'] = 'LoginController/login';

// admin - dashboard
$route['cms/dashboard']['GET'] = 'DashboardController/index';

// admin - category
$route['cms/categories']['GET'] = 'CategoryController/index';
$route['cms/categories/add']['GET'] = 'CategoryController/add';
$route['cms/categories/create']['POST'] = 'CategoryController/create';
$route['cms/categories/edit/(:any)/(:any)']['GET'] = 'CategoryController/edit/$1';
$route['cms/categories/update/(:any)']['POST'] = 'CategoryController/update/$1';
$route['cms/categories/delete/(:any)']['GET'] = 'CategoryController/delete/$1';

// admin - product
$route['cms/products']['GET'] = 'ProductController/index';
$route['cms/products/add']['GET'] = 'ProductController/add';
$route['cms/products/create']['POST'] = 'ProductController/create';
$route['cms/products/edit/(:any)/(:any)']['GET'] = 'ProductController/edit/$1';
$route['cms/products/update/(:any)']['POST'] = 'ProductController/update/$1';
$route['cms/products/delete/(:any)']['GET'] = 'ProductController/delete/$1';
$route['cms/products/preview/(:any)']['POST'] = 'ProductController/getPreviewDetail/$1';
