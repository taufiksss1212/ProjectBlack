<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ==================== PUBLIC / USER ROUTES ====================
$routes->get('/', 'Landing\Home::index');
$routes->get('katalog', 'Landing\Katalog::katalog');

// ==================== AUTH ROUTES ====================
$routes->get('login', 'Auth::login');
$routes->post('auth/proses_login', 'Auth::proses_login');
$routes->get('logout', 'Auth::logout');

// ==================== ADMIN PANEL ROUTES ====================

$routes->group('Admin', ['filter' => 'auth'], function ($routes) {

    // 1. Main Dashboard
    $routes->get('/', 'Admin\Dashboard::index');

    // 2. Manajemen Produk (CRUD & Flash Sale)
    $routes->group('produk', function ($routes) {

        $routes->get('/', 'Admin\Produk::index');
        $routes->post('simpan', 'Admin\Produk::simpan');
        $routes->post('update', 'Admin\Produk::update');
        $routes->post('hapus', 'Admin\Produk::hapus');
        $routes->post('update-flash-sale', 'Admin\Produk::updateFlashSale');
    });


    // Manajemen Kategori
    $routes->group('kategori', function($routes) {
        $routes->get('/', 'Admin\Kategori::index');

    // 3. Manajemen Kategori (Jenis Kain & Varian Warna)
    $routes->group('kategori', function ($routes) {
        $routes->get('/', 'Admin\Kategori::index');

        // Sub-Group Jenis Kain
        $routes->post('jenis-simpan', 'Admin\Kategori::jenis_simpan');
        $routes->post('jenis-update', 'Admin\Kategori::jenis_update');
        $routes->post('jenis-hapus', 'Admin\Kategori::jenis_hapus');
        $routes->post('warna-simpan', 'Admin\Kategori::warna_simpan');
        $routes->post('warna-update', 'Admin\Kategori::warna_update');
        $routes->post('warna-hapus', 'Admin\Kategori::warna_hapus');
    });
});
