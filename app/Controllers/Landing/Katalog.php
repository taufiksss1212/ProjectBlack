<?php

namespace App\Controllers\Landing;

use App\Controllers\BaseController;
use App\Models\ProdukModel;

class Katalog extends BaseController
{
    public function katalog()
    {
        $db = \Config\Database::connect();
        $produkModel = new ProdukModel();

        // 1. TANGKAP KEYWORD
        $keyword = $this->request->getGet('keyword');

        // 2. AMBIL PRODUK
        $products = $produkModel->getLengkap($keyword);

        // 3. AMBIL FILTER (UPDATED: Ambil gambar_varian)
        $queryFilter = $db->query("
            SELECT 
                kw.slug as group_slug, kw.nama_kelompok, kw.kode_hex as group_hex,
                vw.slug as variant_slug, vw.nama_varian, vw.kode_hex as variant_hex,
                vw.gambar_varian -- <--- KOLOM BARU DIAMBIL DISINI
            FROM kelompok_warna kw
            JOIN varian_warna vw ON vw.id_kelompok_warna = kw.id
            ORDER BY kw.id ASC, vw.nama_varian ASC
        ");

        $rawFilter = $queryFilter->getResultArray();
        $filters = [];
        $colorGroups = [];

        foreach ($rawFilter as $row) {
            // Step 1: Grouping (Tetap pakai Hex untuk ikon grup besar)
            if (!isset($colorGroups[$row['group_slug']])) {
                $colorGroups[$row['group_slug']] = [
                    'label' => $row['nama_kelompok'],
                    'hex'   => $row['group_hex'],
                    'slug'  => $row['group_slug']
                ];
            }

            // Step 2: Variants (Sekarang pakai Image)
            $filters[$row['group_slug']][] = [
                'id'    => $row['variant_slug'],
                'label' => $row['nama_varian'],
                'color' => $row['variant_hex'],      // Tetap simpan hex sebagai backup
                'image' => $row['gambar_varian']     // <--- DATA GAMBAR DISIMPAN DISINI
            ];
        }

        $data = [
            'title'       => 'Katalog Tamara Textile',
            'products'    => $products,
            'colorGroups' => array_values($colorGroups),
            'subCats'     => $filters,
            'keyword'     => $keyword
        ];

        return view('Landing/katalog', $data);
    }
}
