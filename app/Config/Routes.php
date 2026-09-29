<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Authentication routes
$routes->get('/', 'Auth::login');
$routes->get('auth/login', 'Auth::login');
$routes->post('auth/authenticate', 'Auth::authenticate');
$routes->get('auth/register', 'Auth::register');
$routes->post('auth/register', 'Auth::register');
$routes->get('auth/logout', 'Auth::logout');

// Dashboard
$routes->get('dashboard', 'Dashboard::index');

// Product routes
$routes->get('product', 'Product::index');
$routes->get('product/create', 'Product::create');
$routes->post('product/store', 'Product::store');
$routes->get('product/edit/(:num)', 'Product::edit/$1');
$routes->post('product/update/(:num)', 'Product::update/$1');
$routes->get('product/delete/(:num)', 'Product::delete/$1');
$routes->get('product/detail/(:num)', 'Product::detail/$1');

// Stock routes
$routes->get('stock', 'Stock::index');
$routes->get('stock/in/(:num)', 'Stock::in/$1');
$routes->get('stock/out/(:num)', 'Stock::out/$1');
$routes->post('stock/movement', 'Stock::movement');
$routes->get('stock/history', 'Stock::history');
$routes->get('stock/history/(:num)', 'Stock::history/$1');

// Category routes
$routes->get('category', 'Category::index');
$routes->get('category/create', 'Category::create');
$routes->post('category/store', 'Category::store');
$routes->get('category/edit/(:num)', 'Category::edit/$1');
$routes->post('category/update/(:num)', 'Category::update/$1');
$routes->get('category/delete/(:num)', 'Category::delete/$1');

// Alert routes
$routes->get('alert', 'Alert::index');
$routes->get('alert/resolve/(:num)', 'Alert::resolve/$1');

// Report routes
$routes->get('report', 'Report::index');
$routes->get('report/inventory', 'Report::inventory');
$routes->get('report/movements', 'Report::movements');
