<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProdukModel;
use App\Models\JenisKainModel;
use App\Models\VarianWarnaModel;

class Produk extends BaseController
{
    protected $produkModel;
    protected $jenisModel;
    protected $warnaModel;

    public function __construct()
    {
        $this->produkModel = new ProdukModel();
        $this->jenisModel = new JenisKainModel();
        $this->warnaModel = new VarianWarnaModel();
    }

    // ==================== READ/INDEX ====================
    public function index()
    {
        $keyword = $this->request->getVar('search');
        
        $data = [
            'title'      => 'Manajemen Produk - Tamara Textile',
            'produk'     => $this->produkModel->getLengkap($keyword),
            'jenis_kain' => $this->jenisModel->findAll(),
            'warna'      => $this->warnaModel->getVarianLengkap(),
            'keyword'    => $keyword
        ];

        return view('dashboard/manajemen_produk', $data);
    }

    // ==================== CREATE ====================
    public function simpan()
    {
        $rules = [
            'nama_produk'   => 'required|min_length[3]',
            'id_jenis_kain' => 'required|numeric',
            'id_varian_warna' => 'required|numeric',
            'harga'         => 'required|numeric|greater_than[0]',
            'stok'          => 'required|decimal|greater_than_equal_to[0]',
            'satuan_jual'   => 'required|in_list[meter,yard,roll]',
            'gambar_produk' => 'uploaded[gambar_produk]|max_size[gambar_produk,2048]|is_image[gambar_produk]|mime_in[gambar_produk,image/jpg,image/jpeg,image/png]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Cek kembali inputan Anda. ' . implode(', ', $this->validator->getErrors()));
        }

        $fileGambar = $this->request->getFile('gambar_produk');
        $namaGambar = $fileGambar->getRandomName();
        $fileGambar->move('uploads/products/', $namaGambar);

        $isFlashSale = $this->request->getVar('is_flash_sale') == '1' ? 1 : 0;
        $hargaInput = $this->request->getVar('harga');
        
        // JONO: Jika flash sale aktif saat input baru, set harga coret (default +25%)
        $hargaCoret = $isFlashSale ? round($hargaInput * 1.25) : 0;

        $this->produkModel->save([
            'nama_produk'     => $this->request->getVar('nama_produk'),
            'id_jenis_kain'   => $this->request->getVar('id_jenis_kain'),
            'id_varian_warna' => $this->request->getVar('id_varian_warna'),
            'lebar_kain'      => $this->request->getVar('lebar_kain') ?? '1.5 meter',
            'harga'           => $hargaInput,
            'stok'            => $this->request->getVar('stok'),
            'satuan_jual'     => $this->request->getVar('satuan_jual'),
            'gambar_produk'   => $namaGambar,
            'is_flash_sale'   => $isFlashSale,
            'harga_coret'     => $hargaCoret,
        ]);

        return redirect()->to('admin/produk')->with('success', '✓ Produk berhasil ditambahkan!');
    }

    // ==================== UPDATE DATA PRODUK ====================
    public function update()
    {
        $id = $this->request->getVar('id');
        $rules = [
            'nama_produk'   => 'required|min_length[3]',
            'id_jenis_kain' => 'required|numeric',
            'id_varian_warna' => 'required|numeric',
            'harga'         => 'required|numeric|greater_than[0]',
            'stok'          => 'required|decimal|greater_than_equal_to[0]',
            'satuan_jual'   => 'required|in_list[meter,yard,roll]',
        ];

        $fileGambar = $this->request->getFile('gambar_produk');
        if ($fileGambar && $fileGambar->isValid()) {
            $rules['gambar_produk'] = 'max_size[gambar_produk,2048]|is_image[gambar_produk]|mime_in[gambar_produk,image/jpg,image/jpeg,image/png]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->with('error', 'Cek kembali inputan Anda.');
        }

        $gambarLama = $this->request->getVar('gambar_lama');
        $namaGambar = $gambarLama;

        if ($fileGambar && $fileGambar->isValid() && !$fileGambar->hasMoved()) {
            if (file_exists('uploads/products/' . $gambarLama)) {
                unlink('uploads/products/' . $gambarLama);
            }
            $namaGambar = $fileGambar->getRandomName();
            $fileGambar->move('uploads/products/', $namaGambar);
        }

        $isFlashSale = $this->request->getVar('is_flash_sale') == '1' ? 1 : 0;
        $hargaInput = $this->request->getVar('harga');
        
        // JONO: Logika update harga coret tetap terjaga
        $hargaCoret = $isFlashSale ? round($hargaInput * 1.25) : 0;

        $this->produkModel->update($id, [
            'nama_produk'     => $this->request->getVar('nama_produk'),
            'id_jenis_kain'   => $this->request->getVar('id_jenis_kain'),
            'id_varian_warna' => $this->request->getVar('id_varian_warna'),
            'harga'           => $hargaInput,
            'stok'            => $this->request->getVar('stok'),
            'satuan_jual'     => $this->request->getVar('satuan_jual'),
            'gambar_produk'   => $namaGambar,
            'is_flash_sale'   => $isFlashSale,
            'harga_coret'     => $hargaCoret,
        ]);

        return redirect()->to('admin/produk')->with('success', '✓ Produk berhasil diupdate!');
    }

    // ==================== AJAX: UPDATE FLASH SALE ONLY ====================
    // JONO: Fungsi ini yang kamu panggil di modal Flash Sale (fetch API)
    public function updateFlashSale() {
    $id = $this->request->getVar('id');
    $isAktif = $this->request->getVar('is_flash_sale');
    $hargaCoret = $this->request->getVar('harga_coret'); // Data dari JS

    $this->produkModel->update($id, [
        'is_flash_sale' => $isAktif,
        'harga_coret'   => $hargaCoret // JONO: Simpan hasil hitungan JS tadi
    ]);
    
    return $this->response->setJSON(['success' => true, 'message' => 'Flash sale diperbarui!']);
}

    // ==================== DELETE ====================
    public function hapus()
    {
        $id = $this->request->getVar('id');
        $produk = $this->produkModel->find($id);
        
        if ($produk) {
            $pathGambar = 'uploads/products/' . $produk['gambar_produk'];
            if (file_exists($pathGambar)) {
                unlink($pathGambar);
            }
            $this->produkModel->delete($id);
            return redirect()->to('admin/produk')->with('success', '✓ Produk berhasil dihapus!');
        }
        
        return redirect()->to('admin/produk')->with('error', '✗ Produk tidak ditemukan!');
    }
}