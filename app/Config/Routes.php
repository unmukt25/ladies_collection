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


$routes->get('/data/dress-category/all-dresses','DressesController::all_dresses');
$routes->get('/data/dress-category/casual','DressesController::casual');
$routes->get('/data/dress-category/evening','DressesController::evening');
$routes->get('/data/dress-category/bridal','DressesController::bridal');
$routes->get('/data/dress-category/party','DressesController::party');
$routes->get('/data/dress-category/office-wear','DressesController::office_wear');
$routes->get('/data/dress-category/sale','DressesController::sale');

$routes->get('/admin/login','Admin::login');
$routes->get('/admin/dashboard','Admin::index');
$routes->get('/admin/','Admin::index');


