<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Profil extends BaseController
{
    protected $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function index() {
        $id = session()->get('id'); // Ambil ID dari session login
        $data = [
            'title' => 'Account Settings - Tamara Textile',
            'user'  => $this->userModel->find($id)
        ];

        if (!$data['user']) {
            return redirect()->to('/login')->with('error', 'Sesi berakhir.');
        }

        return view('dashboard/edit_profil', $data);
    }

    public function update() {
        $id = session()->get('id');
        $userLama = $this->userModel->find($id);

        $file = $this->request->getFile('foto_profil');
        $namaFoto = $userLama['foto_profil'];

        // Cek jika ada upload foto baru
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $namaFoto = $file->getRandomName();
            $file->move('uploads/profiles/', $namaFoto);
            
            // Hapus foto lama jika bukan default
            if ($userLama['foto_profil'] != 'default_admin.jpg' && file_exists('uploads/profiles/' . $userLama['foto_profil'])) {
                unlink('uploads/profiles/' . $userLama['foto_profil']);
            }
        }

        $dataUpdate = [
            'id'           => $id,
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'username'     => $this->request->getVar('username'),
            'email'        => $this->request->getVar('email'),
            'bio'          => $this->request->getVar('bio'),
            'foto_profil'  => $namaFoto
        ];

        if ($this->request->getVar('password')) {
            $dataUpdate['password'] = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
        }

        $this->userModel->save($dataUpdate);
        
        // PENTING: Update session agar Layout Sidebar langsung berubah
        session()->set([
            'nama_lengkap' => $dataUpdate['nama_lengkap'],
            'foto_profil'  => $dataUpdate['foto_profil'],
            'username'     => $dataUpdate['username']
        ]);

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }
}