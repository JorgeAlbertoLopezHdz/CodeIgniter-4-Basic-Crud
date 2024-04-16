<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'UserController::index');

$routes->get('/users', 'UserController::getUsers');
$routes->post("/users", "UserController::create");
$routes->get("/users/(:num)", "UserController::read/$1");
$routes->put("/users/(:num)", "UserController::update/$1");
$routes->delete("/users/(:num)", "UserController::delete/$1");
