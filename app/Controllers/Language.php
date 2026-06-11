<?php

namespace App\Controllers;

class Language extends BaseController
{
    public function index($locale)
    {
        $session = session();

        // Validasi input hanya boleh 'id' atau 'en'
        if ($locale == 'id' || $locale == 'en') {
            $session->set('lang', $locale);
        }

        // Kembalikan user ke halaman sebelumnya
        return redirect()->back();
    }
}