<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'username'     => 'admin_tamara',
            'email'        => 'admin@tamara.com',
            // JONO: Password ini adalah 'admin123' yang sudah di-hash aman
            'password'     => password_hash('admin123', PASSWORD_DEFAULT),
            'nama_lengkap' => 'Elizabeth Addams',
            'foto_profil'  => 'default_admin.jpg',
            'bio'          => 'Lead Manager of Tamara Textile. Premium fabric expert.',
            'role'         => 'admin',
        ];

        // Masukkan data ke tabel 'users'
        $this->db->table('users')->insert($data);
    }
}