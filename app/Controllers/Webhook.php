<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Webhook extends Controller
{
    public function komerce()
    {
        // 1. Ambil data JSON yang dikirim oleh Komerce
        $json = $this->request->getJSON();

        // Jika tidak ada data, tolak
        if (!$json) {
            return $this->response->setStatusCode(400)->setBody('Bad Request');
        }

        // Simpan data mentah ke file log untuk debugging (opsional tapi sangat berguna)
        log_message('info', 'Webhook Komerce Masuk: ' . json_encode($json));

        $db = \Config\Database::connect();

        // 2. Ekstrak data dari JSON Komerce
        // Biasanya Komerce mengirimkan order_id di dalam 'external_id' atau 'order_id'
        $order_id = $json->external_id ?? $json->order_id ?? null;
        $status   = $json->status ?? null;

        if ($order_id && $status) {
            // 3. Jika statusnya PAID / SUCCESS, update database Anda
            if (strtoupper($status) === 'PAID' || strtoupper($status) === 'SUCCESS' || strtoupper($status) === 'COMPLETED') {

                $db->table('orders')->where('order_id', $order_id)->update([
                    'status_pesanan' => 'paid',
                    'updated_at'     => date('Y-m-d H:i:s')
                ]);

                return $this->response->setStatusCode(200)->setJSON(['message' => 'Pesanan berhasil diupdate menjadi PAID']);
            }
        }

        // Kembalikan status 200 OK agar Komerce tahu pesannya sudah diterima (meskipun status bukan PAID)
        return $this->response->setStatusCode(200)->setJSON(['message' => 'Webhook diterima']);
    }
}
