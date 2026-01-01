<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProdukModel;
use App\Models\JenisKainModel;
use App\Models\VarianWarnaModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $produkModel = new ProdukModel();
        $jenisModel = new JenisKainModel();
        $warnaModel = new VarianWarnaModel();

        // Jono: Ambil semua data statistik untuk ditampilkan di widget
        $data = [
            'title'        => 'Admin Dashboard - Tamara Textile',
            'total_produk' => $produkModel->countAll(),
            'total_bahan'  => $jenisModel->countAll(),
            'total_warna'  => $warnaModel->countAll(),
            // Jono: Ambil produk yang stoknya di bawah 10 unit untuk peringatan
            'stok_menipis' => $produkModel->where('stok <', 10)->findAll(),
            'flash_sale'   => $produkModel->where('is_flash_sale', 1)->countAllResults()
        ];

        return view('dashboard/dashboard', $data);
    }
}