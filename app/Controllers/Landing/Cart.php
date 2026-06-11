<?php

namespace App\Controllers\Landing;

use App\Controllers\BaseController;

class Cart extends BaseController
{
    // 1. Fungsi Tambah Barang ke Keranjang (AJAX)
    public function add()
    {
        $id_produk = $this->request->getPost('id_produk');
        $qty       = (int) $this->request->getPost('qty');

        // Tarik data produk dari database
        $db = \Config\Database::connect();
        $produk = $db->table('produk_kain')->where('id', $id_produk)->get()->getRowArray();

        if ($produk) {
            $cart = session()->get('cart') ?? [];

            // Cek apakah sedang flash sale
            $harga = $produk['harga'];
            if ($produk['is_flash_sale'] == 1 && $produk['harga_coret'] > 0) {
                $harga = $produk['harga']; // Gunakan harga promo
            }

            // Jika produk sudah ada di keranjang, tambahkan QTY-nya
            if (isset($cart[$id_produk])) {
                $cart[$id_produk]['qty'] += $qty;
                $cart[$id_produk]['subtotal'] = $cart[$id_produk]['qty'] * $cart[$id_produk]['harga'];
            }
            // Jika belum ada, buat baru beserta data berat & satuan_jual
            else {
                $cart[$id_produk] = [
                    'id_produk'     => $produk['id'],
                    'nama_produk'   => $produk['nama_produk'],
                    'harga'         => $harga,
                    'qty'           => $qty,
                    'subtotal'      => $harga * $qty,
                    'gambar_produk' => $produk['gambar_produk'],
                    'berat'         => $produk['berat'] ?? 250,      // PENYELAMAT ERROR BERAT
                    'satuan_jual'   => $produk['satuan_jual'] ?? 'meter' // PENYELAMAT ERROR SATUAN
                ];
            }

            session()->set('cart', $cart);

            return $this->response->setJSON([
                'status'      => 'success',
                'cart_data'   => $cart,
                'total_items' => count($cart)
            ]);
        }

        return $this->response->setJSON(['status' => 'error', 'message' => 'Produk tidak ditemukan']);
    }

    // 2. Fungsi Update Jumlah Barang di Offcanvas (AJAX)
    public function update()
    {
        $id_produk = $this->request->getPost('id_produk');
        $qty       = (int) $this->request->getPost('qty');

        $cart = session()->get('cart') ?? [];

        if (isset($cart[$id_produk]) && $qty > 0) {
            $cart[$id_produk]['qty'] = $qty;
            $cart[$id_produk]['subtotal'] = $cart[$id_produk]['harga'] * $qty;
            session()->set('cart', $cart);
        }

        return $this->response->setJSON([
            'status'      => 'success',
            'cart_data'   => $cart,
            'total_items' => count($cart)
        ]);
    }

    // 3. Fungsi Hapus Barang dari Offcanvas (AJAX)
    public function remove_ajax()
    {
        $id_produk = $this->request->getPost('id_produk');
        $cart = session()->get('cart') ?? [];

        if (isset($cart[$id_produk])) {
            unset($cart[$id_produk]);
            session()->set('cart', $cart);
        }

        return $this->response->setJSON([
            'status'      => 'success',
            'cart_data'   => $cart,
            'total_items' => count($cart)
        ]);
    }
}
