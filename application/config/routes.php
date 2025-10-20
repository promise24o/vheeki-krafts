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
$route['default_controller'] = 'landing';
$route['shop'] = 'Landing/shop';
$route['about'] = 'Landing/about';
$route['contact'] = 'Landing/contact';
$route['reviews'] = 'Landing/reviews';
$route['product/(:any)'] = 'Landing/product_detail/$1'; // Support both encrypted_id and slug

// Cart routes
$route['cart'] = 'Landing/cart';
$route['cart/add'] = 'Landing/cart_add';
$route['cart/update'] = 'Landing/cart_update';
$route['cart/remove'] = 'Landing/cart_remove';
$route['cart/clear'] = 'Landing/cart_clear';
$route['cart/get_count'] = 'Landing/cart_get_count';

// Checkout routes
$route['checkout'] = 'Landing/checkout';
$route['checkout/process'] = 'Landing/checkout_process';

// Order routes
$route['orders'] = 'Landing/orders';
$route['track-order'] = 'Landing/order_track';
$route['order/track'] = 'Landing/order_track';
$route['order/success/(:num)'] = 'Landing/order_success/$1';

// Webhook routes
$route['webhook/paystack'] = 'Webhook/paystack';
$route['webhook/test'] = 'Webhook/test';

$route['admin'] = 'auth/login';
$route['confirm-login'] = 'auth/confirm_login';
$route['logout'] = 'auth/logout';
$route['404_override'] = 'auth/page_not_found';
$route['translate_uri_dashes'] = FALSE;
