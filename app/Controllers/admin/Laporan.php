<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProdukModel;

class Laporan extends BaseController
{
    protected $produkModel;

    public function __construct()
    {
        $this->produkModel = new ProdukModel();
    }

    public function laporan()
    {
        $data = [
            'title' => 'Pusat Pelaporan & Stok - Tamara Textile'
        ];
        return view('dashboard/laporan', $data);
    }

    // 1. Fungsi AJAX: Mencari produk secara real-time berdasarkan kata kunci
    public function searchProduk()
    {
        $keyword = $this->request->getVar('keyword');
        if (empty($keyword)) {
            return $this->response->setJSON([]);
        }

        // Memanfaatkan fungsi getLengkap($keyword) yang sudah kamu miliki di ProdukModel!
        $products = $this->produkModel->getLengkap($keyword);

        return $this->response->setJSON($products);
    }

    // 2. Fungsi AJAX: Memperbarui kuantitas banyak stok sekaligus (Bulk Update)
    public function updateStokBulk()
    {
        // Menangkap array stok dari form data request
        $stokInput = $this->request->getPost('stok'); // Format data: [id_produk => nilai_stok_baru]

        if (empty($stokInput) || !is_array($stokInput)) {
            return $this->response->setJSON([
                'success' => false, 
                'message' => 'Tidak ada data stok yang dikirim atau format tidak valid.'
            ]);
        }

        // Mulai transaksi database agar aman jika ada kegagalan di tengah jalan
        $db = \Config\Database::connect();
        $db->transStart();

        foreach ($stokInput as $id => $stokBaru) {
            // Pastikan nilai stok tidak minus
            if ($stokBaru >= 0) {
                $this->produkModel->update($id, [
                    'stok' => $stokBaru
                ]);
            }
        }

        $db->transComplete();

        if ($db->transStatus() === false) {
            return $this->response->setJSON([
                'success' => false, 
                'message' => 'Gagal memperbarui stok massal terjadi kesalahan sistem.'
            ]);
        }

        return $this->response->setJSON([
            'success' => true, 
            'message' => '✓ Seluruh data stok kain berhasil diperbarui serentak!'
        ]);
    }
}