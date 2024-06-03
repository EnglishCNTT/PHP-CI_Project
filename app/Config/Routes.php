<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'User\HomeController::index');
$routes->get('error/404', function () {
    return view('errors/html/error_404');
});

$routes->group('admin', function ($routes) {
    $routes->get('home', 'Admin\HomeController::index');
    $routes->group('user', function ($routes) {
        $routes->get('list', 'Admin\UserController::list');
        $routes->get('add', 'Admin\UserController::add');
        $routes->post('create', 'Admin\UserController::create');
        $routes->get('edit/(:num)', 'Admin\UserController::edit/$1');
        $routes->post('update', 'Admin\UserController::update');
        $routes->get('delete/(:num)', 'Admin\UserController::delete/$1');
    });
});
