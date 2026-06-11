<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\OrderModel;
use App\Models\OrderDetailModel;

class Pesanan extends BaseController
{
    protected $orderModel;
    protected $orderDetailModel;

    public function __construct()
    {
        $this->orderModel       = new OrderModel();
        $this->orderDetailModel = new OrderDetailModel();
    }

    // Menampilkan Daftar Semua Pesanan
    public function index()
    {
        $data = [
            'title'   => 'Manajemen Pesanan - Tamara Textile',
            'pesanan' => $this->orderModel->orderBy('order_id', 'DESC')->findAll()
        ];

        // Perubahan ke folder dashboard
        return view('dashboard/pesanan/index', $data);
    }

    // Menampilkan Detail Pesanan Tertentu
    public function detail($order_id)
    {
        $order = $this->orderModel->find($order_id);

        if (!$order) {
            return redirect()->to(site_url('admin/pesanan'))->with('error', 'Pesanan tidak ditemukan!');
        }

        $data = [
            'title'   => 'Detail Pesanan: ' . $order_id,
            'order'   => $order,
            'details' => $this->orderDetailModel->getDetailWithProduct($order_id)
        ];

        // Perubahan ke folder dashboard
        return view('dashboard/pesanan/detail', $data);
    }

    // Aksi: Menarik Status Lunas dari API Komerce (Khusus Localhost/Manual)
    public function syncKomerce($order_id)
    {
        $order = $this->orderModel->find($order_id);
        if (!$order) return redirect()->back()->with('error', 'Pesanan tidak ditemukan.');

        // 1. Ekstrak Payment ID dari database (snap_token)
        $snap = json_decode($order['snap_token'], true);
        $payment_id = $snap['data']['payment_id'] ?? null;

        if (!$payment_id) {
            return redirect()->back()->with('error', 'Payment ID tidak ditemukan. Pesanan ini mungkin error sejak awal.');
        }

        // 2. Tembak API Komerce untuk cek status
        $paymentApiKey = 'ZrW6Vf6M35c3040b10ab38e3sqzvKDpU'; // API Key Anda

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api-sandbox.collaborator.komerce.id/user/api/v1/user/payment/status/" . $payment_id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => ["x-api-key: " . $paymentApiKey],
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false
        ]);
        $response = curl_exec($curl);
        curl_close($curl);

        $resJson = json_decode($response, true);
        $statusApi = strtoupper($resJson['data']['status'] ?? ''); // PENDING, PAID, EXPIRED, CANCELED

        // 3. LOGIKA BARU: Tangkap semua kemungkinan status dari Komerce!
        if ($statusApi === 'PAID' || $statusApi === 'SUCCESS') {

            $this->orderModel->update($order_id, ['status_pesanan' => 'paid']);
            return redirect()->back()->with('success', 'Sinkronisasi Berhasil! Pembayaran dari Komerce telah LUNAS.');
        } elseif ($statusApi === 'EXPIRED') {

            // JIKA KEDALUWARSA -> Otomatis batalkan pesanan
            $this->orderModel->update($order_id, ['status_pesanan' => 'canceled']);
            return redirect()->back()->with('error', 'Waktu pembayaran telah habis (EXPIRED). Pesanan otomatis DIBATALKAN.');
        } elseif ($statusApi === 'CANCELED' || $statusApi === 'CANCELLED') {

            // JIKA DIBATALKAN VIA KOMERCE -> Otomatis batalkan pesanan
            $this->orderModel->update($order_id, ['status_pesanan' => 'canceled']);
            return redirect()->back()->with('error', 'Pembayaran dibatalkan di sistem Komerce. Pesanan otomatis DIBATALKAN.');
        } else {

            // MASIH PENDING
            return redirect()->back()->with('error', 'Sinkronisasi sukses, tetapi status pelanggan di Komerce masih: ' . $statusApi);
        }
    }

    // Aksi: Admin Memasukkan Nomor Resi
    public function updateResi()
    {
        $order_id = $this->request->getPost('order_id');
        $no_resi  = $this->request->getPost('no_resi');

        $this->orderModel->update($order_id, [
            'no_resi'        => $no_resi,
            'status_pesanan' => 'shipped'
        ]);

        return redirect()->back()->with('success', 'Nomor Resi berhasil disimpan! Status pesanan berubah menjadi DIKIRIM.');
    }

    // Aksi: Admin Menandai Barang Telah Sampai
    public function selesai($order_id)
    {
        $this->orderModel->update($order_id, [
            'status_pesanan' => 'completed'
        ]);

        return redirect()->back()->with('success', 'Pesanan telah ditandai sebagai SELESAI.');
    }

    // Aksi: Admin Mematalkan Pesanan
    public function batal($order_id)
    {
        $this->orderModel->update($order_id, [
            'status_pesanan' => 'canceled'
        ]);

        return redirect()->back()->with('success', 'Pesanan berhasil DIBATALKAN.');
    }
}
