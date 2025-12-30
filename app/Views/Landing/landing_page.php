<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<style>
    .hero-title-gold {
        font-size: 5.5rem;
        font-weight: 700;
        font-family: 'Playfair Display', serif;
        font-style: italic;
        margin-bottom: 0.5rem;
        background: white;
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        filter: drop-shadow(0px 2px 5px rgba(0, 0, 0, 0.5));
        display: inline-block;
    }

    .hero-subtitle {
        font-family: 'Poppins', sans-serif;
        text-transform: uppercase;
        letter-spacing: 4px;
        font-size: 0.9rem;
        color: #d4af37;
        margin-bottom: 15px;
        font-weight: 600;
    }

    .gold-divider {
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 20px auto 30px auto;
        width: 60%;
    }

    .gold-divider::before,
    .gold-divider::after {
        content: '';
        height: 1px;
        background: linear-gradient(to right, transparent, #d4af37, transparent);
        flex: 1;
    }

    .gold-icon {
        color: #d4af37;
        margin: 0 15px;
        font-size: 1.2rem;
        animation: spinSlow 10s linear infinite;
    }

    @keyframes spinSlow {
        100% {
            transform: rotate(360deg);
        }
    }

    .btn-gold-outline {
        color: #d4af37;
        border: 2px solid #d4af37;
        border-radius: 50px;
        padding: 12px 40px;
        text-transform: uppercase;
        letter-spacing: 2px;
        font-weight: 600;
        background: transparent;
        transition: all 0.4s ease;
        position: relative;
        overflow: hidden;
    }

    .btn-gold-outline:hover {
        background: #d4af37;
        color: #000;
        box-shadow: 0 0 20px rgba(212, 175, 55, 0.6);
        transform: translateY(-3px);
    }

    /* Other styles inherited from template */
    .hero-wrapper {
        position: relative;
        height: 100vh;
        width: 100%;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    .hero-bg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url("images/janko-ferlic-eBtwD6ZG78I-unsplash.jpg");
        background-size: cover;
        background-position: center;
        z-index: -1;
        animation: kenBurns 25s infinite alternate;
    }

    @keyframes kenBurns {
        0% {
            transform: scale(1);
        }

        100% {
            transform: scale(1.15);
        }
    }

    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
    }

    .hero-content {
        position: relative;
        z-index: 2;
        color: white;
        padding: 0 15px;
    }

    /* Ticker & Animations */
    .ticker-wrap {
        width: 100%;
        overflow: hidden;
        background-color: var(--dark-blue);
        padding: 15px 0;
        white-space: nowrap;
        position: relative;
        z-index: 10;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    .ticker {
        display: inline-block;
        animation: marquee 25s linear infinite;
    }

    .ticker-item {
        display: inline-block;
        padding: 0 3rem;
        font-size: 0.9rem;
        color: var(--gold);
        font-weight: 600;
        letter-spacing: 3px;
        text-transform: uppercase;
    }

    @keyframes marquee {
        0% {
            transform: translateX(0);
        }

        100% {
            transform: translateX(-50%);
        }
    }

    /* Product & Flash Sale */
    .product-card {
        border: none;
        transition: all 0.4s ease;
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        height: 100%;
        position: relative;
        z-index: 2;
    }

    .product-card:hover {
        transform: translateY(-15px) scale(1.02);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .product-img-wrapper {
        height: 400px;
        overflow: hidden;
    }

    .product-img {
        height: 100%;
        width: 100%;
        object-fit: cover;
        transition: 0.8s;
    }

    .product-card:hover .product-img {
        transform: scale(1.1) rotate(1deg);
    }

    .flash-sale-section {
        background: linear-gradient(-45deg, #0f2027, #203a43, #2c5364, #1e1e1e);
        background-size: 400% 400%;
        animation: gradientBG 15s ease infinite;
        color: white;
        padding: 80px 0;
        position: relative;
        overflow: hidden;
    }

    @keyframes gradientBG {
        0% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }

        100% {
            background-position: 0% 50%;
        }
    }

    .flash-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .countdown-box {
        display: inline-flex;
        gap: 10px;
        margin-top: 20px;
    }

    .time-unit {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        padding: 15px 20px;
        border-radius: 15px;
        min-width: 80px;
        backdrop-filter: blur(10px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        animation: pulse 2s infinite;
    }

    .time-val {
        font-size: 2.5rem;
        font-weight: 700;
        line-height: 1;
        display: block;
    }

    .time-label {
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        opacity: 0.8;
    }

    .fs-banner-wrap {
        width: 100%;
        overflow: hidden;
        background: rgba(255, 51, 102, 0.15);
        padding: 10px 0;
        white-space: nowrap;
        margin: 30px 0;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .fs-ticker {
        display: inline-block;
        animation: marquee-reverse 15s linear infinite;
    }

    .fs-item {
        display: inline-block;
        padding: 0 2rem;
        font-size: 0.9rem;
        color: #ffb3b3;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    @keyframes marquee-reverse {
        0% {
            transform: translateX(-50%);
        }

        100% {
            transform: translateX(0);
        }
    }

    .flash-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        border: none;
        position: relative;
        transition: 0.3s;
        height: 100%;
        color: #333;
    }

    .flash-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.4);
    }

    .flash-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        background: #ff3366;
        color: white;
        padding: 5px 12px;
        border-radius: 30px;
        font-weight: 700;
        font-size: 0.8rem;
        z-index: 2;
        animation: pulse 1.5s infinite;
    }

    .flash-img-wrapper {
        height: 220px;
        overflow: hidden;
        position: relative;
    }

    .flash-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: 0.5s;
    }

    .flash-card:hover .flash-img {
        transform: scale(1.1);
    }

    .stock-bar {
        height: 8px;
        background: #eee;
        border-radius: 4px;
        margin-top: 15px;
        overflow: hidden;
    }

    .stock-fill {
        height: 100%;
        background: linear-gradient(to right, #ff3366, #ff6b6b);
        border-radius: 4px;
    }

    @keyframes shine {
        100% {
            left: 125%;
        }
    }

    .shine-effect {
        position: relative;
        overflow: hidden;
    }

    .shine-effect::before {
        content: '';
        position: absolute;
        top: 0;
        left: -75%;
        width: 50%;
        height: 100%;
        background: linear-gradient(to right, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.3) 100%);
        transform: skewX(-25deg);
        z-index: 2;
        transition: 0.5s;
    }

    .shine-effect:hover::before {
        animation: shine 0.75s;
    }

    /* Contact */
    .contact-card {
        background: white;
        padding: 30px;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        transition: 0.3s;
        display: flex;
        align-items: center;
        margin-bottom: 20px;
        border: 1px solid #f0f0f0;
        position: relative;
        z-index: 2;
    }

    .contact-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        border-color: var(--gold);
    }

    .contact-icon {
        width: 60px;
        height: 60px;
        background: #f9f9f9;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: var(--gold);
        margin-right: 20px;
        transition: 0.3s;
    }

    .contact-card:hover .contact-icon {
        background: var(--gold);
        color: white;
    }

    .map-container {
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        border: 5px solid white;
        position: relative;
        z-index: 2;
    }

    .social-btn {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: #333;
        color: white;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        font-size: 1.2rem;
        margin-right: 10px;
        transition: 0.3s;
        text-decoration: none;
    }

    .social-btn:hover {
        background: var(--gold);
        color: white;
        transform: translateY(-5px);
    }

    .blob {
        position: absolute;
        border-radius: 50%;
        filter: blur(60px);
        opacity: 0.4;
        z-index: 0;
        animation: moveBlob 10s infinite alternate;
    }

    .blob-1 {
        top: 10%;
        left: -5%;
        width: 300px;
        height: 300px;
        background: #ffe5b4;
    }

    .blob-2 {
        bottom: 10%;
        right: -5%;
        width: 250px;
        height: 250px;
        background: #e0f7fa;
        animation-delay: 2s;
    }

    @keyframes moveBlob {
        from {
            transform: translate(0, 0);
        }

        to {
            transform: translate(30px, -30px);
        }
    }

    /* Media Query for this specific page */
    @media (max-width: 768px) {

        .product-img-wrapper,
        .flash-img-wrapper {
            height: 180px !important;
        }

        .product-card h4,
        .flash-card h6 {
            font-size: 0.9rem !important;
        }

        .product-card h5,
        .flash-card .fs-5 {
            font-size: 0.9rem !important;
        }

        .card-body,
        .p-4 {
            padding: 0.8rem !important;
        }
    }

    .object-fit-cover {
        object-fit: cover;
    }
</style>

<header class="hero-wrapper">
    <div class="hero-bg"></div>
    <div class="hero-overlay"></div>
    <div class="hero-content floating-anim" data-aos="zoom-in" data-aos-duration="1500">
        <p class="hero-subtitle mb-2">Premium Fabric Collection</p>
        <h1 class="hero-title-gold">Tamara Textile</h1>
        <div class="gold-divider"><i class="fas fa-gem gold-icon"></i></div>
        <p class="lead mb-5 text-white"
            style="font-weight: 300; text-shadow: 1px 1px 5px rgba(0,0,0,0.8); max-width: 700px; margin: 0 auto; opacity: 0.9;">
            Pusat kain berkualitas grade A untuk inspirasi fashion tanpa batas. <br>Wujudkan desain impian Anda dengan
            sentuhan kemewahan.
        </p>
        <a href="katalog" class="btn btn-gold-outline shadow-lg ls-1">Lihat Katalog <i
                class="fas fa-arrow-right ms-2"></i></a>
    </div>
</header>

<div class="ticker-wrap shadow">
    <div class="ticker">
        <span class="ticker-item"><i class="fas fa-star me-2"></i>Premium Quality Grade A</span>
        <span class="ticker-item"><i class="fas fa-truck me-2"></i>Pengiriman Seluruh Indonesia</span>
        <span class="ticker-item"><i class="fas fa-tags me-2"></i>Harga Grosir & Eceran Terbaik</span>
        <span class="ticker-item"><i class="fas fa-undo me-2"></i>Jaminan Retur Mudah</span>
    </div>
</div>

<section id="about" class="section-padding text-center bg-white overflow-hidden">
    <div class="container position-relative z-2">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-5 mb-4 mb-lg-0" data-aos="fade-right">
                <img src="https://images.unsplash.com/photo-1550614000-4b9519e00664?q=80&w=600&auto=format&fit=crop"
                    alt="About" class="img-fluid rounded-pill shadow-lg floating-anim"
                    style="max-height: 400px; border: 5px solid white;">
            </div>
            <div class="col-lg-6 offset-lg-1 text-lg-start" data-aos="fade-left">
                <span class="text-gold text-uppercase small fw-bold ls-2">Tentang Kami</span>
                <h2 class="mt-2 mb-3">Elegance in Every Thread</h2>
                <div class="divider ms-0"></div>
                <p class="text-secondary fs-5" style="line-height: 1.9;">
                    <strong>Tamara Textile</strong> hadir sebagai partner terpercaya bagi para desainer.
                    Kami mengkurasi bahan tekstil terbaik dengan kualitas Grade A, warna konsisten, dan sentuhan mewah.
                </p>
            </div>
        </div>
    </div>
</section>


<section id="produk" class="section-padding bg-soft overflow-hidden">
    <div class="container position-relative z-2">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2>Koleksi Populer</h2>
            <div class="divider"></div>
            <p class="text-muted">Pilihan favorit pelanggan kami bulan ini</p>
        </div>

        <div class="row g-4 justify-content-center">

            <?php if (empty($populer)): ?>
                <div class="text-center text-muted">Belum ada data produk populer.</div>
            <?php else: ?>
                <?php foreach ($populer as $i => $p): ?>
                    <?php
                    // Cek URL gambar (apakah link luar atau file lokal)
                    $imgUrl = strpos($p['gambar_produk'], 'http') === 0 ? $p['gambar_produk'] : base_url('uploads/products/' . $p['gambar_produk']);
                    $delay = ($i + 1) * 100; // Efek delay animasi bertingkat
                    ?>
                    <div class="col-6 col-md-4" data-aos="fade-up" data-aos-delay="<?= $delay ?>">
                        <div class="product-card">
                            <div class="product-img-wrapper">
                                <img src="<?= $imgUrl ?>" class="product-img" alt="<?= $p['nama_produk'] ?>">
                            </div>
                            <div class="p-4 text-center">
                                <h4><?= $p['nama_bahan'] ?></h4>
                                <p class="text-muted small text-truncate"><?= $p['nama_produk'] ?></p>
                                <h5 class="fw-bold mt-3 text-gold fs-4">
                                    Rp <?= number_format($p['harga'], 0, ',', '.') ?>
                                    <small class="text-muted fs-6">/ <?= $p['satuan_jual'] ?></small>
                                </h5>
                                <a href="katalog" class="btn btn-sm btn-outline-dark rounded-pill mt-2 px-4">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

        </div>
    </div>
</section>


<section id="flashsale" class="flash-sale-section">
    <div class="container position-relative" style="z-index: 2;">
        <div class="flash-header" data-aos="fade-down">
            <span class="badge bg-danger rounded-pill px-4 py-2 mb-3 fs-6 bounce-hover"><i
                    class="fas fa-bolt me-2"></i>LIMITED TIME OFFER</span>
            <h2 class="display-4 fw-bold text-white">Flash Sale Hari Ini</h2>

            <div class="countdown-box">
                <div class="time-unit"><span id="hours" class="time-val">00</span><span class="time-label">Jam</span>
                </div>
                <div class="time-unit"><span id="minutes" class="time-val">00</span><span
                        class="time-label">Menit</span></div>
                <div class="time-unit"><span id="seconds" class="time-val text-danger">00</span><span
                        class="time-label">Detik</span></div>
            </div>
        </div>

        <div class="row g-4 justify-content-center">

            <?php if (empty($flash_sale)): ?>
                <div class="text-center text-white-50">Tidak ada promo flash sale saat ini.</div>
            <?php else: ?>
                <?php foreach ($flash_sale as $i => $fs): ?>
                    <?php
                    $imgUrl = strpos($fs['gambar_produk'], 'http') === 0 ? $fs['gambar_produk'] : base_url('uploads/products/' . $fs['gambar_produk']);

                    // Hitung Diskon Otomatis (%)
                    $persenDiskon = 0;
                    if ($fs['harga_coret'] > 0) {
                        $persenDiskon = round((($fs['harga_coret'] - $fs['harga']) / $fs['harga_coret']) * 100);
                    }

                    // Simulasi Progress Bar Stok (Max 100)
                    $stokPersen = $fs['stok'] > 100 ? 100 : $fs['stok'];
                    ?>
                    <div class="col-6 col-md-3" data-aos="zoom-in" data-aos-delay="<?= ($i + 1) * 100 ?>">
                        <div class="card flash-card shine-effect">
                            <?php if ($persenDiskon > 0): ?>
                                <span class="flash-badge"><?= $persenDiskon ?>% OFF</span>
                            <?php endif; ?>

                            <div class="flash-img-wrapper">
                                <img src="<?= $imgUrl ?>" class="flash-img" alt="<?= $fs['nama_produk'] ?>">
                            </div>

                            <div class="card-body p-4">
                                <h6 class="fw-bold mb-2 text-truncate"><?= $fs['nama_produk'] ?></h6>
                                <div class="mb-3">
                                    <small class="text-muted text-decoration-line-through me-2">
                                        Rp<?= number_format($fs['harga_coret'] / 1000, 0) ?>rb
                                    </small>
                                    <span class="text-danger fw-bold fs-5">
                                        <?= number_format($fs['harga'] / 1000, 1) ?>rb
                                    </span>
                                </div>

                                <div class="d-flex justify-content-between small text-muted mb-1">
                                    <span>Tersedia</span>
                                    <span><?= number_format($fs['stok']) ?> <?= $fs['satuan_jual'] ?></span>
                                </div>
                                <div class="stock-bar mb-2">
                                    <div class="stock-fill" style="width: <?= $stokPersen ?>%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

        </div>
    </div>
</section>

<section id="kontak" class="section-padding bg-white overflow-hidden">
    <div class="container position-relative z-2">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2>Hubungi Kami</h2>
            <div class="divider"></div>
        </div>
        <div class="row align-items-center g-5">
            <div class="col-lg-5" data-aos="fade-right">
                <div class="contact-card">
                    <div class="contact-icon"><i class="fab fa-whatsapp"></i></div>
                    <div>
                        <h5 class="fw-bold mb-1">WhatsApp Admin</h5>
                        <p class="text-muted mb-0">0812-3456-7890 (24 Jam)</p>
                    </div>
                </div>
                <div class="contact-card mt-3">
                    <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
                    <div>
                        <h5 class="fw-bold mb-1">Lokasi Store</h5>
                        <p class="text-muted mb-0">Jl. Gatot Subroto No. 88, Bandung</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7" data-aos="fade-left">
                <div class="map-container shadow-lg">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.8339790425946!2d107.61678131477286!3d-6.910452994999968!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e64c5e8866e5%3A0x37be7ac9d575f7ed!2sGedung%20Sate!5e0!3m2!1sid!2sid!4v1625642232532!5m2!1sid!2sid"
                        width="100%" height="450" style="border:0; filter: grayscale(20%);" allowfullscreen=""
                        loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function startFlashSaleTimer() {
        const now = new Date();
        // Set timer selalu berakhir jam 23:59:59 hari ini
        const endDate = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 23, 59, 59).getTime();

        const timer = setInterval(function() {
            const now = new Date().getTime();
            const distance = endDate - now;

            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            const h = document.getElementById("hours");
            if (h) {
                h.innerText = hours < 10 ? "0" + hours : hours;
                document.getElementById("minutes").innerText = minutes < 10 ? "0" + minutes : minutes;
                document.getElementById("seconds").innerText = seconds < 10 ? "0" + seconds : seconds;
            }

            if (distance < 0) clearInterval(timer);
        }, 1000);
    }
    startFlashSaleTimer();
</script>

<?= $this->endSection(); ?>