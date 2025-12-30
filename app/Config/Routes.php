<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Landing\\Home::index');
$routes->get('katalog', 'Landing\\Katalog::katalog');

// ==================== ADMIN ROUTES ====================
$routes->group('admin', function($routes) {
    // Dashboard
    $routes->get('/', 'Admin\Dashboard::index');
    
    // Produk CRUD
    $routes->get('produk', 'Admin\Produk::index');                        // READ - Tampil semua
    $routes->post('produk/simpan', 'Admin\Produk::simpan');               // CREATE - Tambah baru
    $routes->post('produk/update', 'Admin\Produk::update');               // UPDATE - Edit
    $routes->post('produk/hapus', 'Admin\Produk::hapus');                 // DELETE - Hapus
    $routes->post('produk/update-flash-sale', 'Admin\Produk::updateFlashSale'); // UPDATE - Flash Sale
});