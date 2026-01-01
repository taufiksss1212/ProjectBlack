<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tamara Textile - Premium Fabrics</title>

    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('images/favicon_io/favicon-32x32.png') ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('images/favicon_io/favicon-16x16.png') ?>">

    <link rel="shortcut icon" href="<?= base_url('images/favicon_io/favicon.ico') ?>">

    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('images/favicon_io/apple-touch-icon.png') ?>">

    <link rel="manifest" href="<?= base_url('images/favicon_io/site.webmanifest') ?>">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        /* --- GLOBAL VARIABLES --- */
        :root {
            --gold: #d4af37;
            --dark-blue: #0f2027;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: #444;
            overflow-x: hidden;
            cursor: none;
        }

        a,
        button,
        .btn,
        .card,
        input {
            cursor: none;
        }

        h1,
        h2,
        h3,
        h4,
        h5 {
            font-family: 'Playfair Display', serif;
        }

        .text-gold {
            color: var(--gold);
        }

        .bg-soft {
            background-color: #f9ffff;
            position: relative;
        }

        .section-padding {
            padding: 100px 0;
            position: relative;
            z-index: 2;
        }

        .divider {
            width: 60px;
            height: 3px;
            background: var(--gold);
            margin: 20px auto;
            transition: 0.5s;
        }

        section:hover .divider {
            width: 120px;
        }

        /* --- NAVBAR DESKTOP --- */
        .navbar {
            padding: 15px 0;
            transition: 0.4s ease;
            background: transparent;
        }

        .navbar.scrolled {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            padding: 10px 0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .navbar-brand img {
            width: 150px;
        }

        .nav-link {
            color: white !important;
            font-weight: 500;
            margin-left: 15px;
            letter-spacing: 1px;
            position: relative;
            font-size: 0.9rem;
        }

        .nav-link:hover {
            color: var(--gold) !important;
        }

        /* State saat discroll (Navbar jadi putih) */
        .navbar.scrolled .navbar-brand {
            color: #333 !important;
        }

        .navbar.scrolled .nav-link {
            color: #333 !important;
        }

        .navbar.scrolled .nav-link:hover {
            color: var(--gold) !important;
        }

        .navbar.scrolled .navbar-toggler {
            border-color: #333;
        }

        .navbar.scrolled .navbar-toggler-icon {
            filter: none;
        }

        /* Icon jadi hitam */

        /* Search Input Desktop */
        .search-form {
            position: relative;
            width: 250px;
            margin-left: 20px;
        }

        .search-input {
            width: 100%;
            padding: 8px 15px 8px 40px;
            border-radius: 50px;
            border: 1px solid rgba(255, 255, 255, 0.5);
            background: rgba(255, 255, 255, 0.1);
            color: white;
            font-size: 0.85rem;
            transition: 0.3s;
        }

        .search-input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .search-input:focus {
            background: white;
            color: #333;
            border-color: var(--gold);
            outline: none;
            box-shadow: 0 0 10px rgba(212, 175, 55, 0.3);
        }

        .search-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gold);
            font-size: 0.9rem;
        }

        /* Navbar Scrolled State Search */
        .navbar.scrolled .search-input {
            border-color: #ddd;
            background: #f5f5f5;
            color: #333;
        }

        .navbar.scrolled .search-input:focus {
            border-color: var(--gold);
            background: white;
        }

        /* ========================================= */
        /* --- PERBAIKAN KHUSUS MOBILE MENU (HP) --- */
        /* ========================================= */
        @media (max-width: 991px) {

            /* 1. Kotak Menu Gelap & Mewah */
            .navbar-collapse {
                background: rgba(15, 32, 39, 0.95);
                /* Warna Dark Blue Transparan */
                backdrop-filter: blur(15px);
                padding: 20px;
                border-radius: 15px;
                margin-top: 15px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
                border: 1px solid rgba(212, 175, 55, 0.3);
                /* Border Emas Tipis */
                text-align: center;
                /* Rata Tengah */
            }

            /* 2. Link Menu di HP */
            .nav-link {
                margin-left: 0 !important;
                padding: 12px 0 !important;
                border-bottom: 1px solid rgba(255, 255, 255, 0.05);
                font-size: 1rem;
                color: white !important;
                /* PENTING: Paksa putih */
            }

            /* Ini kuncinya: Override aturan scroll desktop */
            .navbar.scrolled .nav-link {
                color: white !important;
                /* Tetap putih walau navbar discroll */
            }

            /* Warna saat dipencet/hover tetap Emas */
            .nav-link:hover,
            .navbar.scrolled .nav-link:hover {
                color: var(--gold) !important;
            }

            .nav-item:last-child .nav-link {
                border-bottom: none;
            }

            /* 3. Search Bar di HP */
            .search-form {
                width: 100% !important;
                /* Full Width */
                margin-left: 0 !important;
                margin-top: 20px;
            }

            .search-input {
                background: rgba(255, 255, 255, 0.1);
                border-color: rgba(255, 255, 255, 0.2);
                color: white;
            }

            .search-input:focus {
                background: white;
                color: #333;
            }

            /* 4. Tombol Hamburger (Garis 3) */
            .navbar-toggler {
                border-color: rgba(255, 255, 255, 0.5);
                padding: 5px 10px;
            }

            /* Ganti warna icon hamburger jadi Emas */
            .navbar-toggler-icon {
                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(212, 175, 55, 1)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e") !important;
                filter: none !important;
            }

            /* Matikan kursor custom di HP */
            .cursor-dot,
            .cursor-outline {
                display: none !important;
            }

            body {
                cursor: auto;
            }

            .section-padding {
                padding: 60px 0;
            }

            .hero-title-gold {
                font-size: 3rem !important;
            }

            .gold-divider {
                width: 90% !important;
            }
        }

        /* --- PRELOADER & SCROLL --- */
        .scroll-progress {
            position: fixed;
            top: 0;
            left: 0;
            height: 4px;
            background: var(--gold);
            width: 0%;
            z-index: 9999;
            box-shadow: 0 0 10px var(--gold);
        }

        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #0f2027;
            z-index: 10000;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: opacity 0.3s ease;
        }


        .loader-logo {
            font-family: 'Playfair Display';
            font-size: 3rem;
            font-weight: bold;
            color: white;
            animation: pulseLogo 1.5s infinite;
        }

        @keyframes pulseLogo {

            0%,
            100% {
                opacity: 0.5;
                transform: scale(0.95);
            }

            50% {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* --- PERBAIKAN PRELOADER MOBILE --- */
        /* --- PERBAIKAN PRELOADER MOBILE (VERSI PAS/SEDANG) --- */
        @media (max-width: 576px) {

            .loader-content {
                width: 100%;
                text-align: center;
                /* Pastikan konten rata tengah */
                padding: 0 20px;
            }

            /* Logo: Ukuran 140px (Pas, tidak kekecilan, tidak kegedean) */
            .loader-logo img {
                width: 140px !important;
                /* Sebelumnya 80px (terlalu kecil) */
                height: auto;
                margin-bottom: 15px;
            }

            /* Teks "Loading Premium...": Lebih terbaca */
            #preloader p {
                font-size: 0.9rem !important;
                /* Sebelumnya 0.7rem */
                letter-spacing: 2px !important;
                /* Spasi huruf tetap elegan */
                margin-top: 5px !important;
                font-weight: 500;
            }
        }

        .cursor-dot {
            width: 14px;
            height: 14px;
            background-color: var(--gold);
            border: 2px solid white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
            position: fixed;
            border-radius: 50%;
            z-index: 9999;
            pointer-events: none;
        }

        .cursor-outline {
            width: 50px;
            height: 50px;
            border: 2px solid var(--gold);
            background-color: rgba(197, 160, 89, 0.15);
            position: fixed;
            border-radius: 50%;
            z-index: 9999;
            pointer-events: none;
            transition: 0.15s;
        }

        body.hovering .cursor-outline {
            width: 80px;
            height: 80px;
            background-color: rgba(197, 160, 89, 0.3);
            border-color: var(--gold);
            mix-blend-mode: difference;
        }

        /* --- FOOTER HIGH FASHION STYLE --- */
        /* --- FOOTER REFINED (LEBIH LUWES & PREMIUM) --- */
        footer {
            background-color: #1a1a1aff;
            /* Hitam pekat tapi soft */
            padding: 100px 0 40px;
            /* Padding lebih lega */
            position: relative;
            overflow: hidden;
            text-align: left;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            /* Garis pemisah sangat halus */
            font-family: 'Poppins', sans-serif;
        }

        /* Ambient Glow Background - Lebih soft */
        footer::before {
            content: '';
            position: absolute;
            bottom: -20%;
            right: -10%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(212, 175, 55, 0.08) 0%, rgba(0, 0, 0, 0) 70%);
            z-index: 0;
            pointer-events: none;
        }

        .footer-content {
            position: relative;
            z-index: 2;
        }

        /* TYPOGRAPHY HEADING: Gaya Editorial (Kecil, Spasi Lebar) */
        .footer-heading {
            color: var(--gold);
            /* Aksen emas */
            font-family: 'Poppins', sans-serif;
            font-size: 0.75rem;
            /* Ukuran font kecil */
            font-weight: 600;
            letter-spacing: 0.15em;
            /* Jarak antar huruf renggang */
            text-transform: uppercase;
            margin-bottom: 30px;
            opacity: 0.9;
        }

        /* MENU LIST: Lebih Renggang & Interaktif */
        .footer-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-list li {
            margin-bottom: 15px;
            /* Jarak antar list lebih jauh */
        }

        .footer-list a {
            color: #999;
            /* Abu-abu lembut */
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 300;
            transition: all 0.4s ease;
            /* Transisi halus */
            display: inline-block;
            position: relative;
        }

        /* Efek Hover: Berubah Putih & Geser Sedikit */
        .footer-list a:hover {
            color: white;
            transform: translateX(8px);
            /* Geser ke kanan saat hover */
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
        }

        /* --- BAGIAN KANAN (BRAND) --- */
        .footer-brand-side {
            text-align: right;
            padding-left: 50px;
            /* Jarak dari menu */
        }

        .footer-logo img {
            width: 140px;
            margin-bottom: 20px;
            opacity: 0.9;
            transition: 0.3s;
        }

        .footer-logo img:hover {
            opacity: 1;
            transform: scale(1.02);
        }

        .footer-tagline {
            color: #666;
            font-size: 0.9rem;
            font-family: 'Playfair Display', serif;
            /* Font serif agar elegan */
            font-style: italic;
            margin-bottom: 30px;
            letter-spacing: 0.5px;
        }

        /* SOCIAL ICONS: Minimalis Outline */
        .footer-socials {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
        }

        .footer-socials a {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 40px;
            height: 40px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            /* Border tipis */
            border-radius: 50%;
            color: #888;
            font-size: 0.9rem;
            transition: all 0.4s ease;
            text-decoration: none;
        }

        .footer-socials a:hover {
            border-color: var(--gold);
            background: transparent;
            color: var(--gold);
            transform: translateY(-3px);
            /* Naik sedikit */
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        /* DIVIDER */
        .footer-divider {
            height: 1px;
            background: linear-gradient(90deg, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.1) 50%, rgba(255, 255, 255, 0) 100%);
            /* Garis memudar di ujung */
            margin: 60px 0 30px;
            width: 100%;
            opacity: 0.5;
        }

        /* BOTTOM BAR */
        .footer-bottom {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            /* Rata bawah */
            color: #555;
            font-size: 0.8rem;
            font-weight: 300;
            letter-spacing: 0.05em;
        }

        .footer-address {
            max-width: 350px;
            line-height: 1.8;
        }

        .footer-copyright {
            text-align: right;
        }

        /* RESPONSIVE MOBILE */
        @media (max-width: 991px) {
            footer {
                padding: 60px 0 30px;
                text-align: center;
                /* Di HP rata tengah agar rapi */
            }

            .footer-heading {
                margin-top: 20px;
                margin-bottom: 15px;
                font-size: 0.85rem;
            }

            .footer-list a:hover {
                transform: none;
                /* Matikan geser di HP */
                color: var(--gold);
            }

            .footer-brand-side {
                text-align: center;
                padding-left: 0;
                margin-top: 50px;
                padding-top: 40px;
                border-top: 1px solid rgba(255, 255, 255, 0.05);
            }

            .footer-socials {
                justify-content: center;
            }

            .footer-bottom {
                flex-direction: column;
                align-items: center;
                gap: 20px;
                text-align: center;
            }

            .footer-address {
                margin: 0 auto;
            }

            .footer-copyright {
                text-align: center;
            }
        }

        /* --- PERBAIKAN FOOTER MOBILE (AGAR LEBIH COMPACT) --- */
        @media (max-width: 991px) {

            /* 1. Mengubah urutan: Brand/Logo pindah ke ATAS */
            .footer-content .row.gy-4 {
                display: flex;
                flex-direction: column;
            }

            .footer-brand-side {
                order: -1;
                /* Pindah ke urutan pertama */
                margin-top: 0 !important;
                padding-top: 0 !important;
                border-top: none !important;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
                /* Garis pemisah di bawah logo */
                padding-bottom: 30px;
                margin-bottom: 30px;
            }

            /* 2. Merapikan Logo & Tagline di Mobile */
            .footer-logo img {
                width: 120px;
                /* Logo sedikit lebih kecil */
                margin-bottom: 10px;
            }

            .footer-tagline {
                font-size: 0.8rem;
                margin-bottom: 20px;
                padding: 0 20px;
                /* Padding agar teks tidak mepet layar */
            }

            /* 3. Merapikan Jarak Menu Link */
            .footer-heading {
                font-size: 0.75rem;
                margin-bottom: 10px;
                color: var(--gold);
            }

            .footer-list li {
                margin-bottom: 6px;
                /* Jarak antar list diperkecil */
            }

            .footer-list a {
                font-size: 0.85rem;
            }

            /* 4. Mengurangi padding footer secara keseluruhan */
            footer {
                padding-top: 50px;
            }
        }

        /* --- PERBAIKAN FOOTER MOBILE (AGAR LEBIH COMPACT) --- */
        @media (max-width: 991px) {

            /* 1. Mengubah urutan: Brand/Logo pindah ke ATAS */
            .footer-content .row.gy-4 {
                display: flex;
                flex-direction: column;
            }

            .footer-brand-side {
                order: -1;
                /* Pindah ke urutan pertama */
                margin-top: 0 !important;
                padding-top: 0 !important;
                border-top: none !important;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
                /* Garis pemisah di bawah logo */
                padding-bottom: 30px;
                margin-bottom: 30px;
            }

            /* 2. Merapikan Logo & Tagline di Mobile */
            .footer-logo img {
                width: 120px;
                /* Logo sedikit lebih kecil */
                margin-bottom: 10px;
            }

            .footer-tagline {
                font-size: 0.8rem;
                margin-bottom: 20px;
                padding: 0 20px;
                /* Padding agar teks tidak mepet layar */
            }

            /* 3. Merapikan Jarak Menu Link */
            .footer-heading {
                font-size: 0.75rem;
                margin-bottom: 10px;
                color: var(--gold);
            }

            .footer-list li {
                margin-bottom: 6px;
                /* Jarak antar list diperkecil */
            }

            .footer-list a {
                font-size: 0.85rem;
            }

            /* 4. Mengurangi padding footer secara keseluruhan */
            footer {
                padding-top: 50px;
            }
        }

        /* --- PERBAIKAN FOOTER MOBILE (AGAR LEBIH COMPACT) --- */
        @media (max-width: 991px) {

            /* 1. Mengubah urutan: Brand/Logo pindah ke ATAS */
            .footer-content .row.gy-4 {
                display: flex;
                flex-direction: column;
            }

            .footer-brand-side {
                order: -1;
                /* Pindah ke urutan pertama */
                margin-top: 0 !important;
                padding-top: 0 !important;
                border-top: none !important;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
                /* Garis pemisah di bawah logo */
                padding-bottom: 30px;
                margin-bottom: 30px;
            }

            /* 2. Merapikan Logo & Tagline di Mobile */
            .footer-logo img {
                width: 120px;
                /* Logo sedikit lebih kecil */
                margin-bottom: 10px;
            }

            .footer-tagline {
                font-size: 0.8rem;
                margin-bottom: 20px;
                padding: 0 20px;
                /* Padding agar teks tidak mepet layar */
            }

            /* 3. Merapikan Jarak Menu Link */
            .footer-heading {
                font-size: 0.75rem;
                margin-bottom: 10px;
                color: var(--gold);
            }

            .footer-list li {
                margin-bottom: 6px;
                /* Jarak antar list diperkecil */
            }

            .footer-list a {
                font-size: 0.85rem;
            }

            /* 4. Mengurangi padding footer secara keseluruhan */
            footer {
                padding-top: 50px;
            }
        }

        /* wa */
        /* --- FLOATING WHATSAPP BUTTON --- */
        .float-wa {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 30px;
            right: 30px;
            background-color: #25d366;
            color: white;
            border-radius: 50%;
            text-align: center;
            font-size: 30px;
            z-index: 10000;
            /* Pastikan di atas elemen lain */
            display: flex;
            justify-content: center;
            align-items: center;
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
        }

        .float-wa:hover {
            background-color: #128C7E;
            /* Hijau lebih gelap saat hover */
            color: white;
            transform: translateY(-5px);
            /* Naik sedikit saat hover */
        }

        /* Efek Berdenyut (Pulse Animation) */
        .float-wa::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background-color: #25d366;
            z-index: -1;
            opacity: 0.7;
            animation: pulse-wa 2s infinite;
        }

        @keyframes pulse-wa {
            0% {
                transform: scale(1);
                opacity: 0.7;
            }

            100% {
                transform: scale(1.6);
                opacity: 0;
            }
        }

        /* Responsif untuk HP (Dikecilkan sedikit & geser agar tidak menutupi konten) */
        @media (max-width: 991px) {
            .float-wa {
                width: 50px;
                height: 50px;
                font-size: 24px;
                bottom: 20px;
                right: 20px;
            }
        }
    </style>
</head>

<body>

    <div id="preloader">
        <div class="loader-content">
            <div class="loader-logo"><img src="images/logo.png" alt=""></div>
            <p class="small text-uppercase ls-2 mt-2">Loading Premium Fabrics...</p>
        </div>
    </div>
    <div class="scroll-progress" id="scrollProgress"></div>
    <div class="cursor-dot" data-cursor-dot></div>
    <div class="cursor-outline" data-cursor-outline></div>

    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="images/logo.png" alt=""></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center text-uppercase">
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('/') ?>">Home</a></li>

                    <li class="nav-item"><a class="nav-link" href="katalog">Katalog</a></li>
                    <li class="nav-item"><a class="nav-link" href="/
                    #kontak">Kontak</a></li>

                    <li class="nav-item w-100 w-lg-auto">
                        <form action="<?= base_url('katalog') ?>" method="get" class="search-form">

                            <button type="submit"
                                style="background:none; border:none; position:absolute; left:10px; top:50%; transform:translateY(-50%); color:var(--gold); z-index:10;">
                                <i class="fas fa-search"></i>
                            </button>

                            <input type="text" name="keyword" class="search-input" placeholder="Cari jenis kain..."
                                value="<?= isset($keyword) ? esc($keyword) : '' ?>" autocomplete="off">
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <?= $this->renderSection('content'); ?>

    <a href="https://wa.me/6285895493831?text=Halo%20Tamara%20Textile,%20saya%20tertarik%20dengan%20produk%20kain%20Anda."
        class="float-wa" target="_blank" title="Chat via WhatsApp">
        <i class="fab fa-whatsapp"></i>
    </a>

    <footer>
        <div class="container footer-content">
            <div class="row gy-4">
                <div class="col-lg-7">
                    <div class="row">
                        <div class="col-sm-4 col-6">
                            <h6 class="footer-heading">Tamara</h6>
                            <ul class="footer-list">
                                <li><a href="<?= base_url('/') ?>">Home</a></li>
                                <li><a href="#about">Philosophy</a></li>
                                <li><a href="#careers">Careers</a></li>
                            </ul>
                        </div>

                        <div class="col-sm-4 col-6">
                            <h6 class="footer-heading">Collections</h6>
                            <ul class="footer-list">
                                <li><a href="katalog">New Arrivals</a></li>
                                <li><a href="#flashsale">Best Seller</a></li>
                                <li><a href="#">Fabrics</a></li>

                            </ul>
                        </div>

                        <div class="col-sm-4 col-6 mt-sm-0">
                            <h6 class="footer-heading">Support</h6>
                            <ul class="footer-list">
                                <li><a href="#kontak">Contact Us</a></li>
                                <li><a href="#">Shipping Info</a></li>
                                <li><a href="#">Returns</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 footer-brand-side">
                    <div class="footer-logo">
                        <img src="images/logo.png" alt="Tamara Textile">
                    </div>
                    <p class="footer-tagline">
                        "Weaving elegance into every thread. <br>Your premium fabric partner since 2010."
                    </p>

                    <div class="footer-socials">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
            </div>

            <div class="footer-divider"></div>

            <div class="footer-bottom">
                <div class="footer-address">
                    Jl. Otto Iskandardinata, Pasar Baru Trade Center,<br>
                    Bandung, Jawa Barat 40181.
                </div>
                <div class="footer-copyright">
                    &copy; 2025 Tamara Textile.<br>Designed with passion.
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true,
            offset: 100,
            duration: 800
        });

        // Navbar Scroll Change Color
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                // Cek jika menu mobile sedang terbuka, jangan transparankan navbar
                const toggler = document.querySelector('.navbar-collapse');
                if (!toggler.classList.contains('show')) {
                    navbar.classList.remove('scrolled');
                }
            }
        });

        // Preloader "Sat-Set" (Cepat)
        function hidePreloader() {
            const preloader = document.getElementById('preloader');
            // Cek agar tidak error kalau preloader sudah hilang duluan
            if (preloader && preloader.style.display !== 'none') {
                preloader.style.opacity = '0';
                setTimeout(() => {
                    preloader.style.display = 'none';
                }, 400); // Waktu animasi fade-out (0.4 detik)
            }
        }

        // Skenario 1: Jika loading selesai cepat (< 1.2 detik), langsung hilangkan
        window.addEventListener("load", hidePreloader);

        // Skenario 2: (PENTING) Jika loading lama, PAKSA hilang di detik ke-1.2
        // Angka 1200 ini adalah 1.2 detik. Bisa dikurangi jadi 1000 (1 detik) kalau mau lebih ngebut.
        setTimeout(hidePreloader, 1200);

        // Scroll Progress
        window.onscroll = function() {
            const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            const scrolled = (winScroll / height) * 100;
            document.getElementById("scrollProgress").style.width = scrolled + "%";
        };

        // Custom Cursor (Desktop Only)
        if (window.matchMedia("(min-width: 992px)").matches) {
            const cursorDot = document.querySelector("[data-cursor-dot]");
            const cursorOutline = document.querySelector("[data-cursor-outline]");
            window.addEventListener("mousemove", function(e) {
                const posX = e.clientX;
                const posY = e.clientY;
                cursorDot.style.left = `${posX}px`;
                cursorDot.style.top = `${posY}px`;
                cursorOutline.animate({
                    left: `${posX}px`,
                    top: `${posY}px`
                }, {
                    duration: 500,
                    fill: "forwards"
                });
            });
            const interactiveElements = document.querySelectorAll('a, button, .btn, .card, .contact-card, input');
            interactiveElements.forEach(el => {
                el.addEventListener('mouseenter', () => document.body.classList.add('hovering'));
                el.addEventListener('mouseleave', () => document.body.classList.remove('hovering'));
            });
        }

        // [BARU] Tutup Hamburger Menu Otomatis Saat Scroll
        window.addEventListener('scroll', function() {
            const navbarCollapse = document.querySelector('.navbar-collapse');

            // Cek apakah menu sedang terbuka (ada class 'show')
            if (navbarCollapse.classList.contains('show')) {
                // Gunakan API Bootstrap untuk menutupnya dengan animasi yang benar
                const bsCollapse = new bootstrap.Collapse(navbarCollapse, {
                    toggle: false
                });
                bsCollapse.hide();
            }
        });
    </script>
</body>

</html>