<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        // Jika sudah login, tendang ke dashboard
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/admin');
        }
        return view('auth/login');
    }

    public function proses_login()
    {
        $model = new UserModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $user = $model->where('username', $username)->first();

        if ($user) {
            // Cek password (menggunakan password_verify karena di DB kita pakai hash)
            if (password_verify($password, $user['password'])) {
                
                // Set data ke session
                $sessionData = [
                    'id'           => $user['id'],
                    'username'     => $user['username'],
                    'nama_lengkap' => $user['nama_lengkap'],
                    'foto_profil'  => $user['foto_profil'],
                    'role'         => $user['role'],
                    'isLoggedIn'   => true,
                ];
                session()->set($sessionData);

                return redirect()->to('/admin');
            } else {
                return redirect()->back()->with('error', 'Password salah, Bos!');
            }
        } else {
            return redirect()->back()->with('error', 'Username tidak terdaftar!');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/auth/login');
    }
}