1<?php

use CodeIgniter\Router\RouteCollection;
use Config\Services;

/**
 * @var RouteCollection $routes
 */
$routes = Services::routes();

/*
|--------------------------------------------------------------------------
| LOAD SYSTEM ROUTES (WAJIB)
|--------------------------------------------------------------------------
*/
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/

$routes->get('/', 'Auth::login');

$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::doLogin');
$routes->get('logout', 'Auth::logout');

$routes->get('books', 'Books::index');
$routes->post('books/store', 'Books::store');
$routes->get('books/edit/(:num)', 'Books::edit/$1');
$routes->post('books/update/(:num)', 'Books::update/$1');
$routes->get('books/delete/(:num)', 'Books::delete/$1');

$routes->get('test', function () {
    return 'ROUTING OK';
});

$routes->get('test2', 'Test::index');
