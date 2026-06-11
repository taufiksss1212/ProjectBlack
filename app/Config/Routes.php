<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ==================== PUBLIC / USER ROUTES ====================
$routes->get('lang/(:segment)', 'Language::index/$1');
$routes->get('/', 'Landing\Home::index');
$routes->get('katalog', 'Landing\Katalog::katalog');

// ==================== AUTH ROUTES ====================
$routes->get('auth/login', 'Auth::login');
$routes->post('auth/proses_login', 'Auth::proses_login');
$routes->get('auth/logout', 'Auth::logout');



// ==================== CUSTOMER AUTH ROUTES ====================
$routes->get('customer/login', 'Landing\CustomerAuth::login');
$routes->post('customer/proses_login', 'Landing\CustomerAuth::proses_login');
$routes->get('customer/register', 'Landing\CustomerAuth::register');
$routes->post('customer/proses_register', 'Landing\CustomerAuth::proses_register');
$routes->get('customer/logout', 'Landing\CustomerAuth::logout');


// ==================== CART ROUTES ====================
$routes->group('cart', function ($routes) {
    $routes->get('/', 'Landing\Cart::index');
    $routes->post('add', 'Landing\Cart::add');
    $routes->post('update', 'Landing\Cart::update');          // <--- RUTE BARU
    $routes->post('remove', 'Landing\Cart::remove');          // Untuk halaman Cart utama
    $routes->post('remove_ajax', 'Landing\Cart::remove_ajax'); // <--- RUTE BARU
    $routes->get('count', 'Landing\Cart::count');
    $routes->get('fetch', 'Landing\Cart::fetch');
});


// ==================== CHECKOUT ROUTES ====================
$routes->group('checkout', function ($routes) {
    $routes->get('/', 'Landing\Checkout::index');
    $routes->get('get_city/(:num)', 'Landing\Checkout::getCity/$1');
    $routes->post('get_cost', 'Landing\Checkout::getCost');
    $routes->post('process', 'Landing\Checkout::process');

    // INI BARIS YANG MENYELESAIKAN ERROR 404:
    $routes->get('payment/(:segment)', 'Landing\Checkout::payment/$1');
});


// ==========================================
// AREA PELANGGAN (FRONTEND)
// ==========================================
$routes->get('pesanan/(:segment)', 'Landing\PesananPelanggan::index/$1');
$routes->post('pesanan/terima-barang/(:segment)', 'Landing\PesananPelanggan::terimaBarang/$1');



$routes->post('webhook/komerce', 'Webhook::komerce');


// ==================== ADMIN PANEL ROUTES ====================

$routes->group('admin', ['filter' => 'auth'], function ($routes) {

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

    $routes->get('profil', 'Admin\Profil::index');
    $routes->post('profil/update', 'Admin\Profil::update');

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

    // 4. Manajemen Pesanan
    $routes->group('pesanan', function ($routes) {
        $routes->get('/', 'Admin\Pesanan::index');
        $routes->get('detail/(:segment)', 'Admin\Pesanan::detail/$1');
        $routes->get('sync/(:segment)', 'Admin\Pesanan::syncKomerce/$1');
        $routes->post('update-resi', 'Admin\Pesanan::updateResi');
        $routes->get('selesai/(:segment)', 'Admin\Pesanan::selesai/$1');
        $routes->get('batal/(:segment)', 'Admin\Pesanan::batal/$1');
    });
});
