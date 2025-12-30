<?php

namespace App\Controllers\Landing;

use App\Controllers\BaseController;
use App\Models\ProdukModel;

class Home extends BaseController
{
    public function index()
    {
        $produkModel = new ProdukModel();

        // 1. Ambil Data Flash Sale (Max 4 item)
        // Syarat: is_flash_sale = 1
        $flashSale = $produkModel->select('produk_kain.*, jenis_kain.nama_bahan')
            ->join('jenis_kain', 'jenis_kain.id = produk_kain.id_jenis_kain')
            ->where('is_flash_sale', 1)
            ->orderBy('rand()') // Acak biar fresh tiap refresh (opsional)
            ->limit(4)
            ->findAll();

        // 2. Ambil Data Populer (Max 3 item)
        // Kita ambil 3 produk terbaru yang BUKAN flash sale (biar beda isinya)
        $populer = $produkModel->select('produk_kain.*, jenis_kain.nama_bahan')
            ->join('jenis_kain', 'jenis_kain.id = produk_kain.id_jenis_kain')
            ->where('is_flash_sale', 0)
            ->orderBy('id', 'DESC') // Produk terbaru
            ->limit(3)
            ->findAll();

        $data = [
            'title'      => 'Tamara Textile - Pusat Kain Berkualitas',
            'populer'    => $populer,
            'flash_sale' => $flashSale
        ];

        return view('Landing/landing_page', $data);
    }
}
