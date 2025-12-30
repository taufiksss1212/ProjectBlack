<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table      = 'produk_kain';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nama_produk',
        'id_jenis_kain',
        'id_varian_warna',
        'lebar_kain',
        'konstruksi_kain',
        'karakteristik',
        'harga',
        'satuan_jual',
        'stok',
        'gambar_produk',
        'is_flash_sale',
        'harga_coret'
    ];

    // Tambahkan parameter $keyword = null
    public function getLengkap($keyword = null)
    {
        $builder = $this->select('produk_kain.*, 
                              jenis_kain.nama_bahan, 
                              varian_warna.nama_varian, varian_warna.slug as slug_warna,
                              kelompok_warna.nama_kelompok, kelompok_warna.slug as slug_kelompok')
            ->join('jenis_kain', 'jenis_kain.id = produk_kain.id_jenis_kain')
            ->join('varian_warna', 'varian_warna.id = produk_kain.id_varian_warna')
            ->join('kelompok_warna', 'kelompok_warna.id = varian_warna.id_kelompok_warna');

        // LOGIKA PENCARIAN
        if ($keyword) {
            $builder->groupStart() // Buka kurung query (agar logika OR tidak berantakan)
                ->like('produk_kain.nama_produk', $keyword)
                ->orLike('jenis_kain.nama_bahan', $keyword)
                ->orLike('varian_warna.nama_varian', $keyword)
                ->orLike('kelompok_warna.nama_kelompok', $keyword)
                ->groupEnd(); // Tutup kurung
        }

        return $builder->findAll();
    }
}
