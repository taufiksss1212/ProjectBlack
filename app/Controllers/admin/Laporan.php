<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProdukModel;

class Laporan extends BaseController
{
    protected $produkModel;

    public function __construct()
    {
        $this->produkModel = new ProdukModel();
    }

    public function laporan()
    {
        $data = [
            'title' => 'Pusat Pelaporan & Stok - Tamara Textile'
        ];
        return view('dashboard/laporan', $data);
    }

    // 1. AJAX: Cari produk (Untuk Entri Stok Masuk)
    public function searchProduk()
    {
        $keyword = $this->request->getVar('keyword');
        if (empty($keyword)) return $this->response->setJSON([]);

        $products = $this->produkModel->getLengkap($keyword);
        return $this->response->setJSON($products);
    }

    // 2. AJAX: Simpan Tambahan Stok Massal (Terakumulasi Otomatis)
    public function updateStokBulk()
    {
        $stokInput = $this->request->getPost('stok');
        if (empty($stokInput) || !is_array($stokInput)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Format data entri tidak valid.']);
        }

        $db = \Config\Database::connect();
        $db->transStart();

        foreach ($stokInput as $id => $jumlahMasuk) {
            // Pastikan hanya memproses baris input yang diisi angka lebih besar dari 0
            if ($jumlahMasuk > 0) {
                // 1. Ambil data stok produk yang tersimpan saat ini di database
                $produk = $this->produkModel->find($id);
                
                if ($produk) {
                    // 2. Kalkulasi akumulasi: Stok Lama + Tambahan Barang Masuk baru
                    $stokLama = floatval($produk['stok']);
                    $stokBaru = $stokLama + floatval($jumlahMasuk);

                    // 3. Update data stok terbaru ke master tabel produk
                    $this->produkModel->update($id, ['stok' => $stokBaru]);
                }
            }
        }

        $db->transComplete();

        if ($db->transStatus() === false) {
            return $this->response->setJSON(['success' => false, 'message' => 'Gagal memperbarui stok database.']);
        }
        return $this->response->setJSON(['success' => true, 'message' => '✓ Seluruh tambahan kuantitas barang masuk berhasil diakumulasikan!']);
    }

    // 3. AJAX: Ambil Data Distribusi (Barang Keluar)
    public function getDistribusi()
    {
        $periode = $this->request->getVar('periode');
        $db = \Config\Database::connect();

        $builder = $db->table('order_details')
            ->select('orders.order_id, orders.created_at, produk_kain.nama_produk, order_details.qty, order_details.subtotal')
            ->join('orders', 'orders.order_id = order_details.order_id')
            ->join('produk_kain', 'produk_kain.id = order_details.id_produk')
            ->whereIn('orders.status_pesanan', ['shipped', 'completed']); // Hanya yang sudah lunas/terkirim

        // Filter Waktu
        if ($periode == 'hari_ini') $builder->where('DATE(orders.created_at)', date('Y-m-d'));
        if ($periode == 'bulan_ini') {
            $builder->where('MONTH(orders.created_at)', date('m'))->where('YEAR(orders.created_at)', date('Y'));
        }
        if ($periode == 'tahun_ini') $builder->where('YEAR(orders.created_at)', date('Y'));

        $data = $builder->orderBy('orders.created_at', 'DESC')->get()->getResultArray();
        return $this->response->setJSON($data);
    }

    // 4. AJAX: Ambil Data Keuangan (Arus Kas)
    public function getKeuangan()
    {
        $periode = $this->request->getVar('periode');
        $db = \Config\Database::connect();

        $builder = $db->table('orders')
            ->select('order_id, created_at, payment_type, ongkir, total_belanja, gross_amount')
            ->whereIn('status_pesanan', ['shipped', 'completed']);

        // Filter Waktu
        if ($periode == 'hari_ini') $builder->where('DATE(created_at)', date('Y-m-d'));
        if ($periode == 'bulan_ini') {
            $builder->where('MONTH(created_at)', date('m'))->where('YEAR(created_at)', date('Y'));
        }
        if ($periode == 'tahun_ini') $builder->where('YEAR(created_at)', date('Y'));

        $data = $builder->orderBy('created_at', 'DESC')->get()->getResultArray();
        return $this->response->setJSON($data);
    }

    // 5. Fungsi Mencetak Laporan
    public function cetak()
    {
        $jenis = $this->request->getVar('jenis');
        $periode = $this->request->getVar('periode');
        $db = \Config\Database::connect();

        if ($jenis == 'distribusi') {
            $builder = $db->table('order_details')
                ->select('orders.order_id, orders.created_at, produk_kain.nama_produk, order_details.qty, order_details.subtotal')
                ->join('orders', 'orders.order_id = order_details.order_id')
                ->join('produk_kain', 'produk_kain.id = order_details.id_produk')
                ->whereIn('orders.status_pesanan', ['shipped', 'completed']);
            $dateCol = 'orders.created_at';
        } else {
            $builder = $db->table('orders')
                ->select('order_id, created_at, payment_type, ongkir, total_belanja, gross_amount')
                ->whereIn('status_pesanan', ['shipped', 'completed']);
            $dateCol = 'created_at';
        }

        // Filter Waktu Cetak
        if ($periode == 'hari_ini') $builder->where("DATE($dateCol)", date('Y-m-d'));
        if ($periode == 'bulan_ini') {
            $builder->where("MONTH($dateCol)", date('m'))->where("YEAR($dateCol)", date('Y'));
        }
        if ($periode == 'tahun_ini') $builder->where("YEAR($dateCol)", date('Y'));

        $data['transaksi'] = $builder->orderBy($dateCol, 'ASC')->get()->getResultArray();
        $data['jenis'] = $jenis;
        $data['periode'] = $periode;
        $data['title'] = 'Cetak Laporan - Tamara Textile';

        return view('dashboard/cetak_laporan', $data);
    }
}
