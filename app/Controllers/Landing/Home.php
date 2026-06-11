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
        $flashSale = $produkModel->select('produk_kain.*, jenis_kain.nama_bahan')
            ->join('jenis_kain', 'jenis_kain.id = produk_kain.id_jenis_kain')
            ->where('is_flash_sale', 1)
            ->orderBy('id', 'DESC') // OPTIMASI: Ganti rand() dengan id DESC (Terbaru)
            ->limit(4)
            ->findAll();

        // 2. Ambil Data Populer (Max 4 item)
        $populer = $produkModel->select('produk_kain.*, jenis_kain.nama_bahan')
            ->join('jenis_kain', 'jenis_kain.id = produk_kain.id_jenis_kain')
            ->where('is_flash_sale', 0)
            ->orderBy('id', 'DESC') // OPTIMASI: Ganti rand() dengan id DESC
            ->limit(4)
            ->findAll();

        $data = [
            'title'      => 'Tamara Textile - Pusat Kain Berkualitas',
            'populer'    => $populer,
            'flash_sale' => $flashSale
        ];

        return view('Landing/landing_page', $data);
    }
}