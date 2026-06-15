<!DOCTYPE html>
<html lang="<?= session('lang') ?: 'id' ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tamara Textile - Premium Fabrics</title>
    <link rel="shortcut icon" href="<?= base_url('images/favicon_io/favicon.ico') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/style.css?v=' . time()) ?>">
    <?= $this->renderSection('styles'); ?>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
</head>

<body>

    <?php
    // CEK APAKAH SEDANG DI HALAMAN DASBOR (Pesanan / Checkout)
    $uriString = uri_string();
    $isDashboard = (strpos($uriString, 'pesanan') === 0 || strpos($uriString, 'checkout') === 0);

    // Jika di Dasbor, paksa navbar memiliki class 'scrolled' agar backgroundnya putih & teksnya gelap
    $navbarClass = $isDashboard ? 'navbar-expand-lg fixed-top transition-all scrolled shadow-sm' : 'navbar-expand-lg fixed-top transition-all';
    ?>

    <nav class="navbar <?= $navbarClass ?>">
        <div class="container d-flex align-items-center justify-content-between position-relative">

            <a class="navbar-brand" href="<?= base_url('/') ?>">
                <img src="<?= base_url('images/logo.png') ?>" alt="Logo">
            </a>

            <div class="d-flex align-items-center gap-3 d-lg-none ms-auto">
                <?php if (!$isDashboard): ?>
                    <a href="javascript:void(0)" class="nav-icon-link" id="mobileSearchTrigger">
                        <i class="fas fa-search"></i>
                    </a>
                <?php endif; ?>
                <div class="lang-switch d-flex align-items-center">
                    <a href="<?= base_url('lang/id') ?>"
                        class="lang-item <?= (session('lang') == 'id' || !session('lang')) ? 'active' : '' ?>">ID</a>
                    <span class="mx-1 opacity-50">|</span>
                    <a href="<?= base_url('lang/en') ?>"
                        class="lang-item <?= (session('lang') == 'en') ? 'active' : '' ?>">EN</a>
                </div>
                <button class="navbar-toggler border-0 p-0" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNav">
                    <i class="fas fa-bars fs-3"></i>
                </button>
            </div>

            <div class="collapse navbar-collapse" id="navbarNav">

                <?php if (!$isDashboard): ?>
                    <ul class="navbar-nav ms-auto text-uppercase align-items-center gap-3 gap-xl-4">
                        <li class="nav-item"><a class="nav-link"
                                href="<?= base_url('/') ?>"><?= lang('Site.menu_home') ?></a></li>
                        <li class="nav-item"><a class="nav-link"
                                href="<?= base_url('katalog') ?>"><?= lang('Site.menu_catalog') ?></a></li>
                        <li class="nav-item"><a class="nav-link"
                                href="<?= base_url('/#kontak') ?>"><?= lang('Site.menu_contact') ?></a></li>
                    </ul>
                <?php endif; ?>

                <div class="d-flex align-items-center gap-4 <?= $isDashboard ? 'ms-auto' : 'ms-lg-5' ?> mt-3 mt-lg-0">

                    <?php if (session()->get('customer_logged_in')): ?>

                        <?php if (!$isDashboard): ?>
                            <div class="dropdown">
                                <a href="#"
                                    class="user-action-link text-decoration-none dropdown-toggle d-flex align-items-center gap-2 text-uppercase"
                                    data-bs-toggle="dropdown" aria-expanded="false"
                                    style="font-size: 0.9rem; font-weight: 500; letter-spacing: 1px;">
                                    <i class="fas fa-box-open fs-5"></i>
                                    <span class="d-lg-none d-xl-inline">Pesanan Saya</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-3 p-2"
                                    style="border-radius: 12px; min-width: 220px; text-transform: none;">
                                    <li><a class="dropdown-item py-2 dropdown-hover rounded"
                                            href="<?= base_url('pesanan/semua') ?>"><i
                                                class="fas fa-list fa-fw me-2 text-secondary"></i> Semua Pesanan</a></li>
                                    <li><a class="dropdown-item py-2 dropdown-hover rounded"
                                            href="<?= base_url('pesanan/pending') ?>"><i
                                                class="fas fa-hourglass-half fa-fw me-2 text-warning"></i> Belum Bayar</a></li>
                                    <li><a class="dropdown-item py-2 dropdown-hover rounded"
                                            href="<?= base_url('pesanan/shipped') ?>"><i
                                                class="fas fa-truck fa-fw me-2 text-primary"></i> Sedang Dikirim</a></li>
                                    <li><a class="dropdown-item py-2 dropdown-hover rounded"
                                            href="<?= base_url('pesanan/completed') ?>"><i
                                                class="fas fa-check-circle fa-fw me-2 text-success"></i> Selesai</a></li>
                                    <li>
                                        <hr class="dropdown-divider my-1">
                                    </li>
                                    <li><a class="dropdown-item py-2 dropdown-hover rounded"
                                            href="<?= base_url('pesanan/canceled') ?>"><i
                                                class="fas fa-times-circle fa-fw me-2 text-danger"></i> Dibatalkan</a></li>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <?php
                        $cart = session()->get('cart') ?? [];
                        $total_cart = is_array($cart) ? count($cart) : 0;
                        ?>
                        <a href="#" class="position-relative user-action-link text-decoration-none"
                            data-bs-toggle="offcanvas" data-bs-target="#cartOffcanvas" aria-controls="cartOffcanvas">
                            <i class="fas fa-shopping-cart fs-5"></i>
                            <span id="cartBadgeCount"
                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger shadow-sm"
                                style="font-size: 0.6rem; padding: 0.25em 0.4em; <?= $total_cart > 0 ? '' : 'display:none;' ?>">
                                <?= $total_cart ?>
                            </span>
                        </a>

                        <a href="#" class="user-action-link text-decoration-none d-flex align-items-center gap-2 ms-2"
                            data-bs-toggle="offcanvas" data-bs-target="#offcanvasProfile" aria-controls="offcanvasProfile">
                            <img src="<?= base_url('uploads/profiles/' . (session()->get('customer_foto_profil') ?? 'default_admin.jpg')) ?>"
                                alt="Profile" class="rounded-circle object-fit-cover shadow-sm" width="35" height="35"
                                style="border: 2px solid var(--gold);">
                            <span class="d-none d-md-inline text-uppercase text-truncate"
                                style="max-width: 100px; font-size: 0.9rem; font-weight: 500; letter-spacing: 1px;">
                                <?= session()->get('customer_nama') ?>
                            </span>
                        </a>

                    <?php else: ?>

                        <?php
                        $cart = session()->get('cart') ?? [];
                        $total_cart = is_array($cart) ? count($cart) : 0;
                        ?>
                        <a href="#" class="position-relative user-action-link text-decoration-none me-2"
                            data-bs-toggle="offcanvas" data-bs-target="#cartOffcanvas" aria-controls="cartOffcanvas">
                            <i class="fas fa-shopping-cart fs-5"></i>
                            <span id="cartBadgeCount"
                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger shadow-sm"
                                style="font-size: 0.6rem; padding: 0.25em 0.4em; <?= $total_cart > 0 ? '' : 'display:none;' ?>">
                                <?= $total_cart ?>
                            </span>
                        </a>

                        <a href="<?= base_url('customer/login') ?>" class="btn-gold-outline py-1 px-3 fs-6"
                            style="text-transform: none; font-family:'Poppins', sans-serif;">Masuk / Daftar</a>
                    <?php endif; ?>
                </div>

                <div class="d-none d-lg-flex align-items-center lang-desktop ms-4">
                    <a href="<?= base_url('lang/id') ?>"
                        class="lang-item <?= (session('lang') == 'id' || !session('lang')) ? 'active' : '' ?>">ID</a>
                    <span class="mx-2 lang-divider">|</span>
                    <a href="<?= base_url('lang/en') ?>"
                        class="lang-item <?= (session('lang') == 'en') ? 'active' : '' ?>">EN</a>
                </div>

            </div>
        </div>

        <?php if (!$isDashboard): ?>
            <div id="searchBar" class="search-bar-container">
                <div class="container">
                    <form action="<?= base_url('katalog') ?>" method="get" class="d-flex align-items-center py-2">
                        <i class="fas fa-search text-muted me-3"></i>
                        <input type="text" name="keyword" class="form-control border-0 bg-transparent shadow-none text-dark"
                            placeholder="<?= lang('Site.search_placeholder') ?>...">
                        <button type="button" class="btn-close ms-2" id="closeSearch"></button>
                    </form>
                </div>
            </div>
        <?php endif; ?>
    </nav>

    <?php if (!$isDashboard): ?>
        <script>
            const mobileSearchTrigger = document.getElementById('mobileSearchTrigger');
            const closeSearch = document.getElementById('closeSearch');
            const searchBar = document.getElementById('searchBar');
            const searchInput = searchBar.querySelector('input');

            if (mobileSearchTrigger) {
                mobileSearchTrigger.addEventListener('click', function() {
                    searchBar.classList.toggle('active');
                    if (searchBar.classList.contains('active')) {
                        setTimeout(() => searchInput.focus(), 100);
                    }
                });
            }

            if (closeSearch) {
                closeSearch.addEventListener('click', function() {
                    searchBar.classList.remove('active');
                });
            }
        </script>
    <?php endif; ?>

    <?= $this->renderSection('content'); ?>

    <a href="https://wa.me/6281239334764" class="float-wa" target="_blank"><i class="fab fa-whatsapp"></i></a>

    <footer class="footer-clean">
        <div class="container">
            <div class="row gy-5">
                <div class="col-lg-4 col-md-6">
                    <div class="footer-brand mb-4">
                        <img src="<?= base_url('images/logo.png') ?>" alt="Tamara Textile"
                            style="width: 140px; opacity: 0.9;">
                    </div>
                    <p class="text-secondary fw-light" style="line-height: 1.8; font-size: 0.9rem;">
                        <?= lang('Site.footer_desc') ?>
                    </p>
                    <div class="social-links mt-4">
                        <a href="https://www.instagram.com/tamarabalifashion?igsh=OGw3dDQ3dWxwMGVx"><i
                                class="fab fa-instagram"></i></a>
                        <a href="https://wa.me/628139334764"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6 col-6">
                    <h6 class="footer-title"><?= lang('Site.menu_title') ?></h6>
                    <ul class="footer-links">
                        <li><a href="<?= base_url('/') ?>"><?= lang('Site.menu_home') ?></a></li>
                        <li><a href="<?= base_url('katalog') ?>"><?= lang('Site.menu_catalog') ?></a></li>
                        <li><a href="#flashsale"><?= lang('Site.fs_title') ?></a></li>
                        <li><a href="#kontak"><?= lang('Site.contact_loc') ?></a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-6 col-6">
                    <h6 class="footer-title"><?= lang('Site.col_title') ?></h6>
                    <ul class="footer-links">
                        <li><a href="#">Satin Silk</a></li>
                        <li><a href="#">Cotton Rayon</a></li>
                        <li><a href="#">Linen Premium</a></li>
                        <li><a href="#">Brokat</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-6">
                    <h6 class="footer-title"><?= lang('Site.contact_title') ?></h6>
                    <ul class="footer-contact">
                        <li>
                            <i class="fas fa-map-marker-alt mt-1 text-gold"></i>
                            <span>Jl. Pulau Batanta No.53 Denpasar Barat, Denpasar, Bali</span>
                        </li>
                        <li>
                            <i class="text-muted text-decoration-none fas fa-phone-alt mt-1 text-gold"></i>
                            <span>+62 812-3933-4764</span>
                        </li>
                        <li>
                            <i class="fas fa-envelope mt-1 text-gold"></i>
                            <span>info@tamarabalitextile.com</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center text-md-start">
                        <p class="mb-0 small text-secondary">&copy; 2025 Tamara Textile. All rights reserved.</p>
                    </div>
                    <div class="col-md-6 text-center text-md-end mt-3 mt-md-0">
                        <span class="text-secondary small me-2">We Accept:</span>
                        <i class="fab fa-cc-visa text-secondary fa-lg mx-1"></i>
                        <i class="fab fa-cc-mastercard text-secondary fa-lg mx-1"></i>
                        <i class="fas fa-university text-secondary fa-lg mx-1"></i>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <div class="offcanvas offcanvas-end shadow-lg" tabindex="-1" id="offcanvasProfile"
        aria-labelledby="offcanvasProfileLabel"
        style="border-left: 3px solid var(--gold); width: 350px; z-index: 9999;">
        <div class="offcanvas-header bg-light border-bottom px-4 py-3">
            <h5 class="offcanvas-title fw-bold text-dark" id="offcanvasProfileLabel"
                style="font-family: 'Playfair Display', serif;">
                <i class="fas fa-user-circle me-2" style="color: var(--gold);"></i> Akun Saya
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <div class="offcanvas-body p-0 d-flex flex-column bg-white">
            <div class="p-4 text-center border-bottom">
                <div class="position-relative d-inline-block mb-3">
                    <img src="<?= base_url('uploads/profiles/' . (session()->get('customer_foto_profil') ?? 'default_admin.jpg')) ?>"
                        alt="Profile" class="rounded-circle shadow" width="90" height="90"
                        style="border: 3px solid var(--gold); object-fit: cover;">
                </div>
                <h5 class="fw-bold mb-1 text-dark"><?= session()->get('customer_nama') ?></h5>
                <p class="text-muted small mb-0"><i class="fas fa-envelope me-1"></i>
                    <?= session()->get('customer_email') ?></p>
            </div>

            <div class="accordion accordion-flush flex-grow-1" id="accordionProfile">
                <div class="accordion-item border-bottom">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold text-dark py-3" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapseDataDiri">
                            <i class="fas fa-id-card fa-fw me-3 text-secondary"></i> Informasi Data Diri
                        </button>
                    </h2>
                    <div id="collapseDataDiri" class="accordion-collapse collapse" data-bs-parent="#accordionProfile">
                        <div class="accordion-body bg-light p-4">
                            <form action="#" method="POST">
                                <div class="mb-3">
                                    <label class="form-label small text-muted fw-bold">Nama Lengkap</label>
                                    <input type="text" class="form-control bg-white shadow-none"
                                        value="<?= session()->get('customer_nama') ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label small text-muted fw-bold">Nomor WhatsApp</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white">+62</span>
                                        <input type="text" class="form-control bg-white shadow-none"
                                            placeholder="85xxx">
                                    </div>
                                </div>
                                <button class="btn w-100 fw-bold text-white shadow-sm"
                                    style="background: var(--gold);">Simpan Perubahan</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="accordion-item border-bottom">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold text-dark py-3" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapseAlamat">
                            <i class="fas fa-map-marker-alt fa-fw me-3 text-secondary"></i> Buku Alamat Utama
                        </button>
                    </h2>
                    <div id="collapseAlamat" class="accordion-collapse collapse" data-bs-parent="#accordionProfile">
                        <div class="accordion-body bg-light p-4 text-center">
                            <div class="alert alert-info border-0 shadow-sm p-3 small text-start">
                                <i class="fas fa-info-circle me-1"></i> Atur alamat utama agar Anda tidak perlu mengetik
                                ulang saat Checkout.
                            </div>
                            <a href="<?= base_url('profil/alamat') ?>" class="btn btn-outline-dark w-100 fw-bold">
                                <i class="fas fa-edit me-2"></i> Atur Alamat Sekarang
                            </a>
                        </div>
                    </div>
                </div>

                <div class="accordion-item border-bottom">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold text-dark py-3" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapseKeamanan">
                            <i class="fas fa-lock fa-fw me-3 text-secondary"></i> Pengaturan Keamanan
                        </button>
                    </h2>
                    <div id="collapseKeamanan" class="accordion-collapse collapse" data-bs-parent="#accordionProfile">
                        <div class="accordion-body bg-light p-4">
                            <a href="<?= base_url('profil/password') ?>" class="btn btn-outline-danger w-100 fw-bold">
                                <i class="fas fa-key me-2"></i> Ubah Password
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-4 border-top bg-light mt-auto">
                <a href="<?= base_url('customer/logout') ?>" class="btn btn-danger w-100 fw-bold shadow-sm py-2"
                    onclick="return confirm('Yakin ingin keluar dari akun?')">
                    <i class="fas fa-sign-out-alt me-2"></i> KELUAR (LOGOUT)
                </a>
            </div>
        </div>
    </div>

    <div class="offcanvas offcanvas-end shadow-lg border-0" tabindex="-1" id="cartOffcanvas"
        aria-labelledby="cartOffcanvasLabel" style="width: 400px; z-index: 9999;">
        <div class="offcanvas-header bg-dark text-white">
            <h5 class="offcanvas-title playfair fw-bold" id="cartOffcanvasLabel">
                <i class="fas fa-shopping-bag me-2 text-gold"></i> Keranjang Saya
            </h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>

        <div class="offcanvas-body p-0" style="background: #fdfdfd;">
            <div id="offcanvasCartList" class="p-3">
                <?php
                $grandTotal = 0;
                if (empty($cart)) {
                    echo '<div class="text-center py-5 mt-4">
                            <i class="fas fa-shopping-basket fa-3x text-muted opacity-50 mb-3"></i>
                            <p class="text-muted">Keranjang masih kosong</p>
                          </div>';
                } else {
                    foreach ($cart as $key => $item) {
                        $subtotal = $item['harga'] * $item['qty'];
                        $grandTotal += $subtotal;

                        $imgField = $item['gambar_produk'] ?? $item['gambar'] ?? 'default.jpg';
                        $imgUrl = strpos($imgField, 'http') === 0 ? $imgField : base_url('uploads/products/' . $imgField);

                        $nama = $item['nama_produk'] ?? $item['nama'] ?? 'Produk Kain';
                        $id_produk = $item['id_produk'] ?? $key;
                ?>
                        <div class="d-flex align-items-start gap-3 mb-3 pb-3 border-bottom">
                            <img src="<?= $imgUrl ?>" alt="<?= $nama ?>" class="rounded"
                                style="width: 70px; height: 70px; object-fit: cover; border: 1px solid #eee;">
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start">
                                    <h6 class="fw-bold mb-1 text-dark text-truncate" style="max-width: 140px;"><?= $nama ?></h6>
                                    <button onclick="hapusItemOffcanvas('<?= $id_produk ?>')" class="btn btn-sm text-danger p-0"
                                        title="Hapus"><i class="fas fa-trash-alt"></i></button>
                                </div>
                                <span class="fw-bold text-gold d-block mb-2">Rp
                                    <?= number_format($item['harga'], 0, ',', '.') ?></span>

                                <div class="input-group input-group-sm" style="width: 110px;">
                                    <button class="btn btn-outline-secondary px-2"
                                        onclick="updateQtyOffcanvas('<?= $id_produk ?>', -1, <?= $item['qty'] ?>)"><i
                                            class="fas fa-minus small"></i></button>
                                    <input type="number" class="form-control text-center p-0 fw-bold"
                                        value="<?= $item['qty'] ?>" min="1" step="1"
                                        onchange="ketikQtyOffcanvas('<?= $id_produk ?>', this.value)"
                                        style="font-size: 0.85rem; color: #000; background: #fff;">
                                    <button class="btn btn-outline-secondary px-2"
                                        onclick="updateQtyOffcanvas('<?= $id_produk ?>', 1, <?= $item['qty'] ?>)"><i
                                            class="fas fa-plus small"></i></button>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>

        <div class="offcanvas-footer p-3 bg-white border-top shadow-sm">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-secondary fw-bold text-uppercase small">Subtotal</span>
                <span id="offcanvasCartTotal" class="fs-4 fw-bold text-gold playfair">Rp
                    <?= number_format($grandTotal, 0, ',', '.') ?></span>
            </div>
            <div class="row g-2">
                <div class="col-12">
                    <a href="<?= site_url('checkout') ?>" id="btnCheckoutOffcanvas"
                        class="btn w-100 fw-bold py-2 shadow-sm <?= empty($cart) ? 'disabled' : '' ?>"
                        style="background: var(--gold); color: white; border-radius: 8px;">
                        LANJUT CHECKOUT <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            AOS.init({
                once: true,
                disable: 'mobile',
                duration: 600
            });

            // LOGIKA SCROLL NAVBAR (Tidak berjalan jika dipaksa putih di Dasbor)
            window.addEventListener('scroll', function() {
                const navbar = document.querySelector('.navbar');
                if (!navbar.classList.contains('shadow-sm')) {
                    if (window.scrollY > 50) navbar.classList.add('scrolled');
                    else navbar.classList.remove('scrolled');
                }
            });
        });

        // ==============================================
        // GLOBAL JAVASCRIPT UNTUK KERANJANG OFFCANVAS
        // ==============================================
        const formatUangJS = (number) => new Intl.NumberFormat('id-ID').format(number);
        const imageBasePathGlobal = "<?= base_url('uploads/products/') ?>";

        function renderOffcanvas(cartData) {
            const listContainer = document.getElementById('offcanvasCartList');
            const totalContainer = document.getElementById('offcanvasCartTotal');
            listContainer.innerHTML = '';
            let grandTotal = 0;

            if (Object.keys(cartData).length === 0) {
                listContainer.innerHTML = `
                    <div class="text-center py-5 mt-4">
                        <i class="fas fa-shopping-basket fa-3x text-muted opacity-50 mb-3"></i>
                        <p class="text-muted">Keranjang masih kosong</p>
                    </div>`;
                totalContainer.innerText = 'Rp 0';

                const badge = document.getElementById('cartBadgeCount');
                if (badge) badge.style.display = 'none';
                return;
            }

            for (const key in cartData) {
                let item = cartData[key];
                grandTotal += item.subtotal;

                let imgField = item.gambar_produk || item.gambar || 'default.jpg';
                let imgUrl = imgField.includes('http') ? imgField : imageBasePathGlobal + imgField;
                let nama = item.nama_produk || item.nama || 'Produk';
                let id_produk = item.id_produk || key;

                listContainer.innerHTML += `
                    <div class="d-flex align-items-start gap-3 mb-3 pb-3 border-bottom">
                        <img src="${imgUrl}" alt="${nama}" class="rounded" style="width: 70px; height: 70px; object-fit: cover; border: 1px solid #eee;">
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start">
                                <h6 class="fw-bold mb-1 text-dark text-truncate" style="max-width: 140px;">${nama}</h6>
                                <button onclick="hapusItemOffcanvas('${id_produk}')" class="btn btn-sm text-danger p-0" title="Hapus"><i class="fas fa-trash-alt"></i></button>
                            </div>
                            <span class="fw-bold text-gold d-block mb-2">Rp ${formatUangJS(item.harga)}</span>
                            
                            <div class="input-group input-group-sm" style="width: 110px;">
                                <button class="btn btn-outline-secondary px-2" onclick="updateQtyOffcanvas('${id_produk}', -1, ${item.qty})"><i class="fas fa-minus small"></i></button>
                                <input type="number" class="form-control text-center p-0 fw-bold" value="${item.qty}" min="1" step="1" onchange="ketikQtyOffcanvas('${id_produk}', this.value)" style="font-size: 0.85rem; color: #000; background: #fff;">
                                <button class="btn btn-outline-secondary px-2" onclick="updateQtyOffcanvas('${id_produk}', 1, ${item.qty})"><i class="fas fa-plus small"></i></button>
                            </div>
                        </div>
                    </div>
                `;
            }
            totalContainer.innerText = 'Rp ' + formatUangJS(grandTotal);

            const badge = document.getElementById('cartBadgeCount');
            if (badge) {
                badge.innerText = Object.keys(cartData).length;
                badge.style.display = 'inline-block';
            }
        }

        function updateQtyOffcanvas(id, change, currentQty) {
            let newQty = parseInt(currentQty) + change;
            if (newQty < 1) return;
            prosesUpdateCartOffcanvas(id, newQty);
        }

        function ketikQtyOffcanvas(id, valueKetik) {
            let newQty = parseInt(valueKetik);
            if (isNaN(newQty) || newQty < 1) return;
            prosesUpdateCartOffcanvas(id, newQty);
        }

        function prosesUpdateCartOffcanvas(id, newQty) {
            fetch('<?= site_url('cart/update') ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: `id_produk=${id}&qty=${newQty}`
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') renderOffcanvas(data.cart_data);
                });
        }

        function hapusItemOffcanvas(id) {
            fetch('<?= site_url('cart/remove_ajax') ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: `id_produk=${id}`
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') renderOffcanvas(data.cart_data);
                });
        }
    </script>

    <?= $this->renderSection('scripts'); ?>
</body>

</html>