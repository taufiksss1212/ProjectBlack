<?php namespace App\Models;
use CodeIgniter\Model;

class VarianWarnaModel extends Model {
    protected $table = 'varian_warna';
    
    public function getVarianLengkap() {
        return $this->select('varian_warna.*, kelompok_warna.nama_kelompok')
                    ->join('kelompok_warna', 'kelompok_warna.id = varian_warna.id_kelompok_warna')
                    ->findAll();
    }
}