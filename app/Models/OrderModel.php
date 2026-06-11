<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table            = 'orders';
    protected $primaryKey       = 'order_id';
    protected $useAutoIncrement = false; // Karena order_id kita formatnya TMR-xxx
    protected $allowedFields    = [
        'order_id',
        'user_id',
        'alamat_lengkap',
        'provinsi_id',
        'kota_id',
        'kurir',
        'layanan_kurir',
        'berat_total',
        'ongkir',
        'total_belanja',
        'gross_amount',
        'payment_type',
        'status_pesanan',
        'snap_token',
        'no_resi'
    ];

    // Aktifkan ini jika Anda punya kolom created_at & updated_at di tabel orders
    // protected $useTimestamps = true; 
}
