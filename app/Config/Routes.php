<?php
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Employee Routes
$routes->get('/employee', 'Employee::allEmployee');
$routes->get('/employee/add', 'Employee::add');
$routes->post('/employee/store', 'Employee::store');
$routes->get('/employee/edit/(:num)', 'Employee::edit/$1');
$routes->post('/employee/update/(:num)', 'Employee::update/$1');
$routes->get('/employee/delete/(:num)', 'Employee::delete/$1');

// User Routes
$routes->get('/users/registration', 'Users::registration');
$routes->post('/users/registration', 'Users::registration');
$routes->get('/users/login', 'Users::login');
$routes->post('/users/login', 'Users::login');
$routes->get('/users/logout', 'Users::logout');

// Default route
$routes->get('/', 'Users::login');
