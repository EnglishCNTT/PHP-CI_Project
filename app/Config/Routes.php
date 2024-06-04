<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'User\HomeController::index');
$routes->get('error/404', function () {
    return view('errors/html/error_404');
});

$routes->get('login', 'Admin\LoginController::index');
$routes->post('login', 'Admin\LoginController::login');

$routes->group('admin', ['filter' => 'adminLoginFilter'], function ($routes) {
    $routes->get('home', 'Admin\HomeController::index');

    $routes->get('logout', 'Admin\LoginController::logout');
    $routes->group('user', function ($routes) {
        $routes->get('list', 'Admin\UserController::list');
        $routes->get('add', 'Admin\UserController::add');
        $routes->post('create', 'Admin\UserController::create');
        $routes->get('edit/(:num)', 'Admin\UserController::edit/$1');
        $routes->post('update', 'Admin\UserController::update');
        $routes->get('delete/(:num)', 'Admin\UserController::delete/$1');
    });
    $routes->group('purchase', function ($routes) {
        $routes->get('list', 'Admin\PurchaseController::list');
        $routes->get('add', 'Admin\PurchaseController::add');
        $routes->post('create', 'Admin\PurchaseController::create');
        $routes->get('edit/(:num)', 'Admin\PurchaseController::edit/$1');
        $routes->post('update', 'Admin\PurchaseController::update');
        $routes->get('delete/(:num)', 'Admin\PurchaseController::delete/$1');
    });
    $routes->group('contact', function ($routes) {
        $routes->get('list', 'Admin\ContactController::list');
        $routes->get('add', 'Admin\ContactController::add');
        $routes->post('create', 'Admin\ContactController::create');
        $routes->get('edit/(:num)', 'Admin\ContactController::edit/$1');
        $routes->post('update', 'Admin\ContactController::update');
        $routes->get('delete/(:num)', 'Admin\ContactController::delete/$1');
    });
});
