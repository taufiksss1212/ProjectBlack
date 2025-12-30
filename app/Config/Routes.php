<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Landing\\Home::index');
$routes->get('katalog', 'Landing\\Katalog::katalog');
$routes->get('admin', 'Admin\Dashboard::index');