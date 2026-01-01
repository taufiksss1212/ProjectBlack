<?php 

namespace App\Models;

use CodeIgniter\Model;

class VarianWarnaModel extends Model {
    protected $table = 'varian_warna';
    protected $primaryKey = 'id'; // JONO: Tambahkan primary key agar update akurat

    // JONO: WAJIB didaftarkan agar Bos bisa Simpan dan Update data master warna
    protected $allowedFields = [
        'id_kelompok_warna', 
        'nama_varian', 
        'slug', 
        'gambar_varian', 
        'kode_hex'
    ];

    public function getVarianLengkap() {
        return $this->select('varian_warna.*, kelompok_warna.nama_kelompok')
                    ->join('kelompok_warna', 'kelompok_warna.id = varian_warna.id_kelompok_warna')
                    ->findAll();
    }
}