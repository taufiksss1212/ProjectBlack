<?php

namespace App\Controllers\Landing;

use App\Controllers\BaseController;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Tamara Textile - Pusat Kain Berkualitas',
            // Data Dummy Produk Populer
            'products' => [
                ['name' => 'Satin Silk Premium', 'price' => 'Rp 45.000/m', 'img' => 'https://placehold.co/400x300/6a0572/fff?text=Satin+Silk'],
                ['name' => 'Cotton Combed 30s', 'price' => 'Rp 85.000/kg', 'img' => 'https://placehold.co/400x300/ab0e86/fff?text=Cotton+Combed'],
                ['name' => 'Rayon Viscose Motif', 'price' => 'Rp 35.000/m', 'img' => 'https://placehold.co/400x300/d63384/fff?text=Rayon+Viscose'],
                ['name' => 'Brokat Tile 3D', 'price' => 'Rp 120.000/m', 'img' => 'https://placehold.co/400x300/fd7e14/fff?text=Brokat+3D'],
            ],
            // Data Dummy Flash Sale
            'flash_sale' => [
                ['name' => 'Wolfis Grade A', 'price_coret' => 'Rp 30.000', 'price' => 'Rp 19.900/m', 'img' => 'https://placehold.co/400x300/20c997/fff?text=Wolfis+Promo'],
                ['name' => 'Toyobo Fodu', 'price_coret' => 'Rp 45.000', 'price' => 'Rp 32.500/m', 'img' => 'https://placehold.co/400x300/0dcaf0/fff?text=Toyobo+Promo'],
            ]
        ];

        return view('Landing/landing_page', $data);
    }
}
