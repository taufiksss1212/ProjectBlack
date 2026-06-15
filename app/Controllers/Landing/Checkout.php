<?php

namespace App\Controllers\Landing;

use App\Controllers\BaseController;

class Checkout extends BaseController
{
    private $shippingApiKey = 'lEim3zup35c3040b10ab38e3nckZ8Eb9';
    private $paymentApiKey  = 'ZrW6Vf6M35c3040b10ab38e3sqzvKDpU';
    private $originCity     = 114;

    public function index()
    {
        if (!session()->get('customer_logged_in')) {
            session()->set('redirect_url', 'checkout');
            return redirect()->to(site_url('customer/login'))->with('error', 'Silakan login terlebih dahulu.');
        }

        $cart = session()->get('cart');
        if (empty($cart)) {
            return redirect()->to(site_url('katalog'))->with('error', 'Keranjang belanja Anda kosong.');
        }

        // PENYELAMAT ERROR BERAT (?? 250)
        $totalBerat = 0;
        foreach ($cart as $item) {
            $berat_item = $item['berat'] ?? 250;
            $totalBerat += ($berat_item * $item['qty']);
        }

        $provinsi = $this->rajaOngkirAPI('destination/province');

        $data = [
            'title'    => 'Checkout - Tamara Textile',
            'cart'     => $cart,
            'berat'    => ceil($totalBerat),
            'provinsi' => json_decode($provinsi, true)
        ];

        return view('Landing/checkout', $data);
    }

    public function getCity($id_provinsi)
    {
        return $this->response->setJSON($this->rajaOngkirAPI('destination/city/' . $id_provinsi));
    }

    public function getCost()
    {
        $destination = $this->request->getPost('destination');
        $weight      = $this->request->getPost('weight');
        $courier     = $this->request->getPost('courier');

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://rajaongkir.komerce.id/api/v1/calculate/domestic-cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=" . $this->originCity . "&destination=" . $destination . "&weight=" . $weight . "&courier=" . $courier,
            CURLOPT_HTTPHEADER => [
                "content-type: application/x-www-form-urlencoded",
                "key: " . $this->shippingApiKey,
                "Accept: application/json"
            ],
            CURLOPT_SSL_VERIFYPEER => false
        ]);

        $response = curl_exec($curl);
        curl_close($curl);
        return $this->response->setJSON($response);
    }

    private function rajaOngkirAPI($endpoint)
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://rajaongkir.komerce.id/api/v1/" . $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => ["key: " . $this->shippingApiKey, "Accept: application/json"],
            CURLOPT_SSL_VERIFYPEER => false
        ]);
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    public function process()
    {
        $db = \Config\Database::connect();
        $cart = session()->get('cart');

        if (empty($cart)) return redirect()->to(site_url('katalog'));

        $user_id        = session()->get('customer_id');
        $nama_pembeli   = $this->request->getPost('nama_pembeli');
        $no_hp          = $this->request->getPost('no_hp');
        $alamat_lengkap = $this->request->getPost('alamat_lengkap');
        $provinsi_id    = $this->request->getPost('provinsi_id');
        $kota_id        = $this->request->getPost('kota_id');
        $kurir          = $this->request->getPost('kurir');
        $ongkir         = (float) $this->request->getPost('ongkir');
        $channel_code   = $this->request->getPost('payment_method');

        $totalBelanja = 0;
        $totalBerat   = 0;
        $itemsAPI = [];

        foreach ($cart as $item) {
            $totalBelanja += $item['subtotal'];
            $berat_item = $item['berat'] ?? 250;
            $totalBerat += ($berat_item * $item['qty']);
            $itemsAPI[] = [
                'name'     => $item['nama_produk'],
                'quantity' => (int) ceil($item['qty']),
                'price'    => (int) $item['harga']
            ];
        }
        $grossAmount = $totalBelanja + $ongkir;
        $order_id = 'TMR-' . time() . '-' . rand(100, 999);

        if ($ongkir > 0) {
            $itemsAPI[] = ['name' => 'Ongkos Kirim (' . strtoupper($kurir) . ')', 'quantity' => 1, 'price' => (int) $ongkir];
        }

        // ==========================================
        // TRANSAKSI DATABASE (SIMPAN ORDER & POTONG STOK)
        // ==========================================
        $db->transStart();

        // 1. Simpan ke tabel orders
        $db->table('orders')->insert([
            'order_id'       => $order_id,
            'user_id'        => $user_id,
            'alamat_lengkap' => $alamat_lengkap . " (HP: $no_hp - $nama_pembeli)",
            'provinsi_id'    => $provinsi_id,
            'kota_id'        => $kota_id,
            'kurir'          => $kurir,
            'layanan_kurir'  => 'Reguler',
            'berat_total'    => $totalBerat,
            'ongkir'         => $ongkir,
            'total_belanja'  => $totalBelanja,
            'gross_amount'   => $grossAmount,
            'payment_type'   => $channel_code,
            'status_pesanan' => 'pending'
        ]);

        // 2. Simpan ke tabel order_details SEKALIGUS potong stok di produk_kain
        $detailData = [];
        foreach ($cart as $item) {
            $id_produk = $item['id_produk'] ?? $item['id'];
            $qty_dibeli = $item['qty'];

            $detailData[] = [
                'order_id'     => $order_id,
                'id_produk'    => $id_produk,
                'harga_satuan' => $item['harga'],
                'qty'          => $qty_dibeli,
                'subtotal'     => $item['subtotal']
            ];

            // LOGIKA POTONG STOK OTOMATIS
            $db->table('produk_kain')
                ->where('id', $id_produk)
                ->set('stok', 'stok - ' . $qty_dibeli, false) // Mengurangi stok yang ada dengan qty yang dibeli
                ->update();
        }
        $db->table('order_details')->insertBatch($detailData);

        $db->transComplete();
        // ==========================================

        if ($db->transStatus() === false) return redirect()->back()->with('error', 'Gagal memproses pesanan.');

        $payment_type = ($channel_code === 'QRIS') ? 'qris' : 'bank_transfer';

        $payload = [
            "order_id" => $order_id,
            "payment_type" => $payment_type,
            "amount" => (int) $grossAmount,
            "customer" => [
                "name" => $nama_pembeli,
                "email" => session()->get('customer_email') ?? 'customer@tamara.com',
                "phone" => $no_hp
            ],
            "items" => $itemsAPI
        ];

        if ($payment_type === 'bank_transfer') {
            $payload['channel_code'] = $channel_code;
        }

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api-sandbox.collaborator.komerce.id/user/api/v1/user/payment/create",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "x-api-key: " . $this->paymentApiKey
            ],
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            $db->table('orders')->where('order_id', $order_id)->update(['snap_token' => json_encode(['error' => $err])]);
        } else {
            $db->table('orders')->where('order_id', $order_id)->update(['snap_token' => $response]);
        }

        session()->remove('cart');
        return redirect()->to(site_url('checkout/payment/' . $order_id));
    }

    public function payment($order_id)
    {
        $db = \Config\Database::connect();
        $order = $db->table('orders')->where('order_id', $order_id)->get()->getRowArray();

        if (!$order) return redirect()->to(site_url('/'))->with('error', 'Pesanan tidak ditemukan.');

        $data = [
            'title' => 'Instruksi Pembayaran - Tamara Textile',
            'order' => $order,
            'api_response' => json_decode($order['snap_token'], true)
        ];

        return view('Landing/payment', $data);
    }
}
