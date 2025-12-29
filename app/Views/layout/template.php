<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tamara Textile - Premium Fabrics</title>

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

        .navbar-brand {
            font-weight: 700;
            letter-spacing: 2px;
            color: white !important;
            font-size: 1.5rem;
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
                /* Garis pemisah tipis */
                font-size: 1rem;
                /* Font lebih besar biar gampang dipencet */
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
            transition: opacity 0.5s ease;
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
        footer {
            background-color: #020202;
            /* Hitam sangat pekat */
            padding: 60px 0 30px;
            position: relative;
            overflow: hidden;
            text-align: center;
            border-top: 1px solid rgba(212, 175, 55, 0.2);
        }

        /* Efek Bias Cahaya Emas di Background */
        footer::before {
            content: '';
            position: absolute;
            top: -50%;
            left: 50%;
            transform: translateX(-50%);
            width: 600px;
            height: 400px;
            background: radial-gradient(circle, rgba(212, 175, 55, 0.15) 0%, rgba(0, 0, 0, 0) 70%);
            z-index: 0;
            pointer-events: none;
        }

        .footer-content {
            position: relative;
            z-index: 2;
        }

        .footer-brand-luxury {
            font-family: 'Playfair Display', serif;
            font-size: 3rem;
            /* Ukuran Besar */
            font-weight: 700;
            letter-spacing: 5px;
            margin-bottom: 20px;
            display: inline-block;
            background: linear-gradient(to bottom, #d4af37, #aa771c);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }

        .footer-nav {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .footer-nav a {
            color: #888;
            text-decoration: none;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 2px;
            font-weight: 500;
            transition: 0.3s;
            position: relative;
        }

        .footer-nav a::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 1px;
            background: var(--gold);
            transition: 0.3s;
        }

        .footer-nav a:hover {
            color: white;
        }

        .footer-nav a:hover::after {
            width: 100%;
        }

        .footer-socials {
            margin-bottom: 30px;
        }

        .social-icon-luxury {
            color: var(--gold);
            font-size: 1.2rem;
            margin: 0 15px;
            transition: 0.3s;
            display: inline-block;
        }

        .social-icon-luxury:hover {
            color: white;
            transform: translateY(-3px) scale(1.1);
            text-shadow: 0 0 10px var(--gold);
        }

        .footer-copyright {
            color: #444;
            font-size: 0.7rem;
            letter-spacing: 1px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            padding-top: 20px;
            display: inline-block;
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <div id="preloader">
        <div class="loader-content">
            <div class="loader-logo">TAMARA.</div>
            <p class="small text-uppercase ls-2 mt-2">Loading Premium Fabrics...</p>
        </div>
    </div>
    <div class="scroll-progress" id="scrollProgress"></div>
    <div class="cursor-dot" data-cursor-dot></div>
    <div class="cursor-outline" data-cursor-outline></div>

    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">TAMARA.</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center text-uppercase">
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('/') ?>">Home</a></li>

                    <li class="nav-item"><a class="nav-link" href="katalog">Katalog</a></li>
                    <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>

                    <li class="nav-item w-100 w-lg-auto">
                        <form action="" class="search-form">
                            <i class="fas fa-search search-icon"></i>
                            <input type="text" class="search-input" placeholder="Cari jenis kain...">
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <?= $this->renderSection('content'); ?>

    <footer>
        <div class="container footer-content">

            <h2 class="footer-brand-luxury">TAMARA.</h2>

            <div class="footer-nav">
                <a href="<?= base_url('/') ?>">Home</a>
                <a href="katalog">Katalog</a>
                <a href="#flashsale">Flash Sale</a>
                <a href="#about">Tentang Kami</a>
                <a href="#kontak">Kontak</a>
            </div>

            <div class="footer-socials">
                <a href="#" class="social-icon-luxury"><i class="fab fa-instagram"></i></a>
                <a href="#" class="social-icon-luxury"><i class="fab fa-whatsapp"></i></a>
                <a href="#" class="social-icon-luxury"><i class="fab fa-tiktok"></i></a>
                <a href="#" class="social-icon-luxury"><i class="fab fa-facebook-f"></i></a>
            </div>

            <div class="footer-copyright">
                &copy; 2025 TAMARA TEXTILE. ESTABLISHED 2010.<br>
                DESIGNED WITH PASSION IN BANDUNG.
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

        // Preloader
        window.addEventListener("load", function() {
            const preloader = document.getElementById('preloader');
            preloader.style.opacity = '0';
            setTimeout(() => {
                preloader.style.display = 'none';
            }, 500);
        });

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