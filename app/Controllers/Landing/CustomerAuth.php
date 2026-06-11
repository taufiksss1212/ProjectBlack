<?php

namespace App\Controllers\Landing;

use App\Controllers\BaseController;
use App\Models\UserModel;

class CustomerAuth extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function login()
    {
        if (session()->get('customer_logged_in')) {
            return redirect()->to(site_url('/'));
        }

        return view('Landing/customer_login', [
            'title' => 'Login Pelanggan - Tamara Textile'
        ]);
    }

    public function proses_login()
    {
        $session = session();
        $loginInput = $this->request->getPost('login_input');
        $password = $this->request->getPost('password');

        $user = $this->userModel->groupStart()
            ->where('username', $loginInput)
            ->orWhere('email', $loginInput)
            ->groupEnd()
            ->where('role', 'customer')
            ->first();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $sessionData = [
                    'customer_id'        => $user['id'],
                    'customer_username'  => $user['username'],
                    'customer_email'     => $user['email'],
                    'customer_nama'      => $user['nama_lengkap'],
                    'customer_logged_in' => true,
                ];
                $session->set($sessionData);

                if ($session->has('redirect_url')) {
                    $redirectTarget = $session->get('redirect_url');
                    $session->remove('redirect_url');
                    return redirect()->to(site_url($redirectTarget));
                }

                return redirect()->to(site_url('/'));
            } else {
                $session->setFlashdata('error', 'Password yang Anda masukkan salah.');
                return redirect()->back()->withInput();
            }
        } else {
            $session->setFlashdata('error', 'Akun tidak ditemukan atau Anda bukan pelanggan.');
            return redirect()->back()->withInput();
        }
    }

    public function register()
    {
        if (session()->get('customer_logged_in')) {
            return redirect()->to(site_url('/'));
        }

        return view('Landing/customer_register', [
            'title' => 'Daftar Akun - Tamara Textile'
        ]);
    }

    public function proses_register()
    {
        $session = session();

        $rules = [
            'username'     => 'required|alpha_dash|min_length[4]|is_unique[users.username]',
            'email'        => 'required|valid_email|is_unique[users.email]',
            'password'     => 'required|min_length[6]',
            'nama_lengkap' => 'required|min_length[3]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->userModel->save([
            'username'     => $this->request->getPost('username'),
            'email'        => $this->request->getPost('email'),
            'password'     => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'role'         => 'customer'
        ]);

        $newUser = $this->userModel->where('username', $this->request->getPost('username'))->first();
        
        $sessionData = [
            'customer_id'        => $newUser['id'],
            'customer_username'  => $newUser['username'],
            'customer_email'     => $newUser['email'],
            'customer_nama'      => $newUser['nama_lengkap'],
            'customer_logged_in' => true,
                ];
        $session->set($sessionData);

        if ($session->has('redirect_url')) {
            $redirectTarget = $session->get('redirect_url');
            $session->remove('redirect_url');
            return redirect()->to(site_url($redirectTarget));
        }

        return redirect()->to(site_url('/'));
    }

    public function logout()
    {
        session()->remove(['customer_id', 'customer_username', 'customer_email', 'customer_nama', 'customer_logged_in']);
        return redirect()->to(site_url('/'));
    }
}