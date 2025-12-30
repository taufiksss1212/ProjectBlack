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

        // 1. TANGKAP KEYWORD DARI URL
        // Contoh: ?keyword=satin
        $keyword = $this->request->getGet('keyword');

        // 2. Kirim keyword ke Model
        $products = $produkModel->getLengkap($keyword);

        // --- Bagian Filter Sidebar (Tetap Sama) ---
        $queryFilter = $db->query("
            SELECT 
                kw.slug as group_slug, kw.nama_kelompok, kw.kode_hex as group_hex,
                vw.slug as variant_slug, vw.nama_varian, vw.kode_hex as variant_hex
            FROM kelompok_warna kw
            JOIN varian_warna vw ON vw.id_kelompok_warna = kw.id
            ORDER BY kw.id ASC, vw.nama_varian ASC
        ");

        $rawFilter = $queryFilter->getResultArray();
        $filters = [];
        $colorGroups = [];

        foreach ($rawFilter as $row) {
            if (!isset($colorGroups[$row['group_slug']])) {
                $colorGroups[$row['group_slug']] = [
                    'label' => $row['nama_kelompok'],
                    'hex'   => $row['group_hex'],
                    'slug'  => $row['group_slug']
                ];
            }
            $filters[$row['group_slug']][] = [
                'id'    => $row['variant_slug'],
                'label' => $row['nama_varian'],
                'color' => $row['variant_hex']
            ];
        }

        $data = [
            'title'       => 'Katalog Tamara Textile',
            'products'    => $products,
            'colorGroups' => array_values($colorGroups),
            'subCats'     => $filters,
            'keyword'     => $keyword // Kirim balik keyword ke view agar input tidak kosong setelah search
        ];

        return view('Landing/katalog', $data);
    }
}
