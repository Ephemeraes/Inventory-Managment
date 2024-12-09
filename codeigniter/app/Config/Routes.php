<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//Log in
$routes->get('/', 'ProjectController::index');
$routes->post('/authenticate', 'ProjectController::login');

//Inventory
$routes->get('/inventory', 'InventoryController::inventory',['filter' => 'general']);
$routes->group('inventory', ['filter' => 'clerk'], function($routes) {
    $routes->post('update', 'InventoryController::update');
    $routes->match(['get', 'post'], 'addedit', 'InventoryController::addedit');
    $routes->match(['get', 'post'], 'addedit/(:segment)', 'InventoryController::addedit/$1');
    $routes->get('delete/(:segment)', 'InventoryController::delete/$1');
});

//Operation
$routes->get('/operation', 'OperationController::operation', ['filter' => 'manager']);
$routes->get('/operation/adduser', 'OperationController::adduser', ['filter' => 'manager']);
$routes->post('/operation/adduser', 'OperationController::adduser', ['filter' => 'manager']);
$routes->post('/operation/approve', 'OperationController::approveRecord', ['filter' => 'manager']);

//Sort
$routes->get('/sort', 'SortController::sort', ['filter' => 'manager']);
$routes->post('/sort/result', 'SortController::sortResult', ['filter' => 'manager']);

//Log out
$routes->get('/logout', 'ProjectController::logout');
