<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\JenisKainModel;
use App\Models\VarianWarnaModel;

class Kategori extends BaseController
{
    protected $jenisModel;
    protected $warnaModel;

    public function __construct()
    {
        // Inisialisasi model yang sudah Bos buat
        $this->jenisModel = new JenisKainModel();
        $this->warnaModel = new VarianWarnaModel();
    }

    // --- HALAMAN UTAMA (INDEX) ---
    public function index()
    {
        $keyword = $this->request->getVar('search'); //
        $db = \Config\Database::connect();
        
        // Logika Search Jenis Kain
        $jenisBuilder = $this->jenisModel;
        if ($keyword) {
            $jenisBuilder = $jenisBuilder->like('nama_bahan', $keyword);
        }

        // Logika Search Varian Warna
        $warnaBuilder = $this->warnaModel->select('varian_warna.*, kelompok_warna.nama_kelompok')
                        ->join('kelompok_warna', 'kelompok_warna.id = varian_warna.id_kelompok_warna');
        if ($keyword) {
            $warnaBuilder = $warnaBuilder->groupStart()
                            ->like('nama_varian', $keyword)
                            ->orLike('nama_kelompok', $keyword)
                            ->groupEnd();
        }

        $kelompok = $db->table('kelompok_warna')->get()->getResultArray();

        $data = [
            'title'    => 'Manajemen Kategori - Tamara Textile',
            'jenis'    => $jenisBuilder->findAll(),
            'warna'    => $warnaBuilder->findAll(),
            'kelompok' => $kelompok,
            'keyword'  => $keyword
        ];

        return view('dashboard/manajemen_kategori', $data);
    }

    // ==========================================
    //          BAGIAN JENIS KAIN (BAHAN)
    // ==========================================

    public function jenis_simpan()
    {
        $this->jenisModel->save([
            'nama_bahan'      => $this->request->getVar('nama_bahan'),
            'deskripsi_bahan' => $this->request->getVar('deskripsi_bahan') //
        ]);
        return redirect()->back()->with('success', '✓ Jenis kain baru berhasil ditambahkan!');
    }

    public function jenis_update()
    {
        $id = $this->request->getVar('id');
        $this->jenisModel->update($id, [
            'nama_bahan'      => $this->request->getVar('nama_bahan'),
            'deskripsi_bahan' => $this->request->getVar('deskripsi_bahan')
        ]);
        return redirect()->back()->with('success', '✓ Data jenis kain berhasil diperbarui!');
    }

    public function jenis_hapus()
    {
        $id = $this->request->getVar('id');
        $this->jenisModel->delete($id);
        return redirect()->back()->with('success', '✓ Jenis kain berhasil dihapus!');
    }

    // ==========================================
    //          BAGIAN VARIAN WARNA
    // ==========================================

    public function warna_simpan()
{
    // JONO: Ambil file berdasarkan name "gambar_varian" dari view
    $file = $this->request->getFile('gambar_varian');
    $namaGambar = 'default_swatch.jpg';

    if ($file && $file->isValid() && !$file->hasMoved()) {
        $namaGambar = $file->getRandomName();
        $file->move('uploads/swatches/', $namaGambar);
    }

    $namaVarian = $this->request->getVar('nama_varian');
    $this->warnaModel->save([
        'id_kelompok_warna' => $this->request->getVar('id_kelompok_warna'),
        'nama_varian'       => $namaVarian,
        'slug'              => url_title($namaVarian, '-', true),
        'gambar_varian'     => $namaGambar, // Sesuai kolom DB
        'kode_hex'          => $this->request->getVar('kode_hex') ?? '#000000'
    ]);

    return redirect()->back()->with('success', '✓ Varian warna baru berhasil ditambahkan!');
}

    public function warna_hapus()
    {
        $id = $this->request->getVar('id');
        $warna = $this->warnaModel->find($id);

        if ($warna && $warna['gambar_varian'] != 'default_swatch.jpg') {
            if (file_exists('uploads/swatches/' . $warna['gambar_varian'])) {
                unlink('uploads/swatches/' . $warna['gambar_varian']);
            }
        }

        $this->warnaModel->delete($id);
        return redirect()->back()->with('success', '✓ Varian warna berhasil dihapus!');
    }

    public function warna_update()
    {
        $id = $this->request->getVar('id');
        $file = $this->request->getFile('gambar_varian');
        $gambarLama = $this->request->getVar('gambar_lama');
        $namaGambar = $gambarLama;

        if ($file && $file->isValid() && !$file->hasMoved()) {
            if ($gambarLama != 'default_swatch.jpg' && file_exists('uploads/swatches/' . $gambarLama)) {
                unlink('uploads/swatches/' . $gambarLama);
            }
            $namaGambar = $file->getRandomName();
            $file->move('uploads/swatches/', $namaGambar);
        }

        $namaVarian = $this->request->getVar('nama_varian');
        $this->warnaModel->update($id, [
            'id_kelompok_warna' => $this->request->getVar('id_kelompok_warna'),
            'nama_varian'       => $namaVarian,
            'slug'              => url_title($namaVarian, '-', true),
            'gambar_varian'     => $namaGambar
        ]);

        return redirect()->back()->with('success', '✓ Varian warna berhasil diupdate!');
    }
}