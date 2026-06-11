<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderDetailModel extends Model
{
    protected $table         = 'order_details';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['order_id', 'id_produk', 'harga_satuan', 'qty', 'subtotal'];

    // Relasi untuk mengambil nama dan gambar kain dari tabel produk_kain
    public function getDetailWithProduct($order_id)
    {
        return $this->select('order_details.*, produk_kain.nama_produk, produk_kain.gambar_produk')
            ->join('produk_kain', 'produk_kain.id = order_details.id_produk')
            ->where('order_id', $order_id)
            ->findAll();
    }
}
