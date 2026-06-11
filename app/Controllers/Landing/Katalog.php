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

        // 2. BUILDER QUERY DASAR
        // Kita buat function private atau closure agar query bisa dipakai ulang
        $buildQuery = function () use ($produkModel, $keyword) {
            $builder = $produkModel->select('produk_kain.*, jenis_kain.nama_bahan, varian_warna.nama_varian, varian_warna.slug as slug_warna, kelompok_warna.slug as slug_kelompok')
                ->join('jenis_kain', 'jenis_kain.id = produk_kain.id_jenis_kain')
                ->join('varian_warna', 'varian_warna.id = produk_kain.id_varian_warna', 'left')
                ->join('kelompok_warna', 'kelompok_warna.id = varian_warna.id_kelompok_warna', 'left');

            if ($keyword) {
                $builder->groupStart()
                    ->like('produk_kain.nama_produk', $keyword)
                    ->orLike('jenis_kain.nama_bahan', $keyword)
                    ->groupEnd();
            }
            return $builder;
        };

        // 3. QUERY 1: UNTUK TAMPILAN AWAL (PAGINATION)
        // Kita panggil builder baru
        $productsPaged = $buildQuery()->paginate(12, 'produk');
        $pager = $produkModel->pager;

        // 4. QUERY 2: UNTUK DATA JAVASCRIPT (SEMUA DATA) [PERBAIKAN DISINI]
        // Kita panggil builder baru lagi agar tidak konflik dengan pagination
        $productsAll = $buildQuery()->findAll();

        // 5. AMBIL FILTER WARNA (Tetap sama)
        $queryFilter = $db->query("
            SELECT 
                kw.slug as group_slug, kw.nama_kelompok, kw.kode_hex as group_hex,
                vw.slug as variant_slug, vw.nama_varian, vw.kode_hex as variant_hex,
                vw.gambar_varian
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
                'color' => $row['variant_hex'],
                'image' => $row['gambar_varian']
            ];
        }

        $data = [
            'title'       => 'Katalog Tamara Textile',
            'products'    => $productsPaged, // Untuk Loop PHP
            'all_products' => $productsAll,   // Untuk JSON JS (Data Lengkap)
            'pager'       => $pager,
            'colorGroups' => array_values($colorGroups),
            'subCats'     => $filters,
            'keyword'     => $keyword
        ];

        return view('Landing/katalog', $data);
    }
}
