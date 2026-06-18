<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');
$routes->get('/dress/all-dresses', 'Home::index');
$routes->get('/dress/casual', 'Home::index');
$routes->get('/dress/evening', 'Home::index');
$routes->get('/dress/bridal', 'Home::index');
$routes->get('/dress/party', 'Home::index');
$routes->get('/dress/office-wear', 'Home::index');
$routes->get('/dress/sale', 'Home::index');

$routes->get('/dress-details/(:num)', 'Home::dress_details/$1');


$routes->get('/data/dress-category/all-dresses','DressesController::all_dresses');
$routes->get('/data/dress-category/casual','DressesController::casual');
$routes->get('/data/dress-category/evening','DressesController::evening');
$routes->get('/data/dress-category/bridal','DressesController::bridal');
$routes->get('/data/dress-category/party','DressesController::party');
$routes->get('/data/dress-category/office-wear','DressesController::office_wear');
$routes->get('/data/dress-category/sale','DressesController::sale');

$routes->get('/admin/login','Admin\Admin_Pages::login'); //view page
$routes->get('/admin/dashboard','Admin\Admin_Pages::index'); //view for admin dashboard
$routes->get('/admin/','Admin\Admin_Pages::index'); //view for admin dashboard
$routes->get('/admin/default','Admin\Admin_Pages::default'); //view for admin dashboard

$routes->get('/admin/category','Admin\Admin_Pages::category'); 
$routes->get('/admin/users','Admin\Admin_Pages::users'); 
$routes->get('/admin/profile','Admin\Admin_Pages::profile'); 

//this will be the ui where user can see his payment history and make new payment
$routes->get('/admin/subscription','Admin\Admin_Pages::subscription'); 
$routes->post('/admin/subscription/submit','Admin\Subscription::submitUpiCode'); 

// Super admin page - Lists all pending verification requests
$routes->get('/admin/subscription/verify', 'Admin\Admin_Pages::verify_by_superadmin');

// Action route - Processes a specific row's approval/rejection choice
$routes->post('/admin/subscription/process-action/(:num)', 'Admin\Subscription::process_payment_action/$1');

$routes->post('/admin/users/update-profile', 'Admin\Auth::updateProfile');
$routes->post('/admin/users/change-password', 'Admin\Auth::changePassword');

$routes->get('/admin/dresses','Admin\Admin_Pages::dresses'); 
$routes->get('admin/dresses/add', 'Admin\Admin_Pages::addDress');
$routes->post('admin/dresses/store', 'Admin\Dresses::store');

$routes->get('admin/dresses/edit/(:num)', 'Admin\Admin_Pages::editDress/$1');
$routes->post('admin/dresses/update/(:num)', 'Admin\Dresses::update/$1');

$routes->get('admin/dresses/delete/(:num)', 'Admin\Dresses::delete/$1');

$routes->post('/admin/auth/login','Admin\Auth::login'); //controller to check valid login
$routes->get('/admin/auth/logout','Admin\Auth::logout'); //controller to check valid login


