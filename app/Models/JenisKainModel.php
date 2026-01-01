<?php namespace App\Models;
use CodeIgniter\Model;

class JenisKainModel extends Model {
    protected $table = 'jenis_kain';
    protected $allowedFields = ['nama_bahan', 'deskripsi_bahan'];
}