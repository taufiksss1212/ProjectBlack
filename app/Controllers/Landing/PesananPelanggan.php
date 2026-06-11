<?php

namespace App\Controllers\Landing;

use App\Controllers\BaseController;
use App\Models\OrderModel;
use App\Models\OrderDetailModel;

class PesananPelanggan extends BaseController
{
    protected $orderModel;
    protected $orderDetailModel;

    public function __construct()
    {
        $this->orderModel       = new OrderModel();
        $this->orderDetailModel = new OrderDetailModel();
    }

    // Menampilkan Tab Pesanan
    public function index($status = 'semua')
    {
        // PERBAIKAN 1: Cek session spesifik untuk Customer
        if (!session()->get('customer_logged_in')) {
            // Arahkan ke rute login yang benar
            return redirect()->to(site_url('customer/login'))->with('error', 'Silakan login untuk melihat pesanan Anda.');
        }

        // PERBAIKAN 2: Ambil data user menggunakan session customer_id
        $user_id = session()->get('customer_id');

        // Filter berdasarkan Tab yang dipilih
        if ($status == 'semua') {
            $pesanan = $this->orderModel->where('user_id', $user_id)->orderBy('created_at', 'DESC')->findAll();
        } else {
            $pesanan = $this->orderModel->where('user_id', $user_id)->where('status_pesanan', $status)->orderBy('created_at', 'DESC')->findAll();
        }

        $data = [
            'title'       => 'Pesanan Saya - Tamara Textile',
            'pesanan'     => $pesanan,
            'tab_active'  => $status
        ];

        return view('Landing/pesanan/index', $data);
    }

    // Pelanggan Menekan "Barang Diterima"
    public function terimaBarang($order_id)
    {
        // PERBAIKAN 3: Sesuaikan validasi ID saat menerima barang
        $user_id = session()->get('customer_id');

        $order = $this->orderModel->where('order_id', $order_id)->where('user_id', $user_id)->first();

        if (!$order) {
            return redirect()->back()->with('error', 'Akses ditolak atau pesanan tidak ditemukan.');
        }

        // Ubah status menjadi Selesai (completed)
        $this->orderModel->update($order_id, ['status_pesanan' => 'completed']);

        return redirect()->back()->with('success', 'Terima kasih! Pesanan telah dikonfirmasi selesai.');
    }
}
