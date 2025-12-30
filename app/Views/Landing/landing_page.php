<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<style>
    /* Hero Title Gold Style */
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
    <div
        style="position: absolute; bottom: 40px; left: 50%; transform: translateX(-50%); color: #d4af37; animation: bounce 2s infinite;">
        <i class="fas fa-chevron-down fa-2x opacity-75"></i>
    </div>
</header>

<div class="ticker-wrap shadow">
    <div class="ticker">
        <span class="ticker-item"><i class="fas fa-star me-2"></i>Premium Quality Grade A</span>
        <span class="ticker-item"><i class="fas fa-truck me-2"></i>Pengiriman Seluruh Indonesia</span>
        <span class="ticker-item"><i class="fas fa-tags me-2"></i>Harga Grosir & Eceran Terbaik</span>
        <span class="ticker-item"><i class="fas fa-undo me-2"></i>Jaminan Retur Mudah</span>
        <span class="ticker-item"><i class="fas fa-star me-2"></i>Premium Quality Grade A</span>
        <span class="ticker-item"><i class="fas fa-truck me-2"></i>Pengiriman Seluruh Indonesia</span>
        <span class="ticker-item"><i class="fas fa-tags me-2"></i>Harga Grosir & Eceran Terbaik</span>
    </div>
</div>

<section id="about" class="section-padding text-center bg-white overflow-hidden">
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
    <div class="container position-relative z-2">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-5 mb-4 mb-lg-0" data-aos="fade-right">
                <img src="https://images.unsplash.com/photo-1550614000-4b9519e00664?q=80&w=600&h=700&auto=format&fit=crop"
                    alt="About" class="img-fluid rounded-pill shadow-lg floating-anim"
                    style="max-height: 400px; border: 5px solid white;">
            </div>
            <div class="col-lg-6 offset-lg-1 text-lg-start" data-aos="fade-left">
                <span class="text-gold text-uppercase small fw-bold ls-2">Tentang Kami</span>
                <h2 class="mt-2 mb-3">Elegance in Every Thread</h2>
                <div class="divider ms-0"></div>
                <p class="text-secondary fs-5" style="line-height: 1.9;">
                    <strong>Tamara Textile</strong> hadir sebagai partner terpercaya bagi para desainer dan pegiat
                    fashion profesional.
                    Kami mengkurasi bahan tekstil terbaik dengan kualitas Grade A, warna yang konsisten, dan sentuhan
                    mewah.
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
        <div class="row g-4">
            <div class="col-6 col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="product-card">
                    <div class="product-img-wrapper"><img
                            src="https://images.unsplash.com/photo-1612459807212-32a225424757?q=80&w=600&h=800&auto=format&fit=crop"
                            class="product-img" alt="Satin"></div>
                    <div class="p-4 text-center">
                        <h4>Satin Silk</h4>
                        <p class="text-muted small">Kilau mewah.</p>
                        <h5 class="fw-bold mt-3 text-gold fs-4">Rp 45.000 <small class="text-muted fs-6">/m</small></h5>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="product-card">
                    <div class="product-img-wrapper"><img
                            src="https://images.unsplash.com/photo-1620799140408-ed5341cd2431?q=80&w=600&h=800&auto=format&fit=crop"
                            class="product-img" alt="Linen"></div>
                    <div class="p-4 text-center">
                        <h4>Pure Linen</h4>
                        <p class="text-muted small">Serat alami.</p>
                        <h5 class="fw-bold mt-3 text-gold fs-4">Rp 85.000 <small class="text-muted fs-6">/m</small></h5>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="product-card">
                    <div class="product-img-wrapper"><img
                            src="https://images.unsplash.com/photo-1584912311636-62281c382458?q=80&w=600&h=800&auto=format&fit=crop"
                            class="product-img" alt="Brokat"></div>
                    <div class="p-4 text-center">
                        <h4>Brokat Tile</h4>
                        <p class="text-muted small">Motif eksklusif.</p>
                        <h5 class="fw-bold mt-3 text-gold fs-4">Rp 120.000 <small class="text-muted fs-6">/m</small>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="flashsale" class="flash-sale-section">
    <div class="container position-relative" style="z-index: 2;">
        <div class="flash-header" data-aos="fade-down">
            <span class="badge bg-danger rounded-pill px-4 py-2 mb-3 fs-6 bounce-hover"><i
                    class="fas fa-bolt me-2"></i>LIMITED TIME OFFER</span>
            <h2 class="display-4 fw-bold text-white">Flash Sale Hari Ini</h2>

            <div class="fs-banner-wrap">
                <div class="fs-ticker">
                    <span class="fs-item"><i class="fas fa-exclamation-circle me-2"></i>Stok Sangat Terbatas! Jangan
                        Sampai Kehabisan.</span>
                    <span class="fs-item"><i class="fas fa-fire me-2"></i>Harga Termurah Tahun Ini!</span>
                    <span class="fs-item"><i class="fas fa-exclamation-circle me-2"></i>Stok Sangat Terbatas! Jangan
                        Sampai Kehabisan.</span>
                </div>
            </div>

            <div class="countdown-box">
                <div class="time-unit"><span id="hours" class="time-val">00</span><span class="time-label">Jam</span>
                </div>
                <div class="time-unit"><span id="minutes" class="time-val">00</span><span
                        class="time-label">Menit</span></div>
                <div class="time-unit"><span id="seconds" class="time-val text-danger">00</span><span
                        class="time-label">Detik</span></div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-6 col-md-3" data-aos="zoom-in" data-aos-delay="100">
                <div class="card flash-card shine-effect">
                    <span class="flash-badge">30% OFF</span>
                    <div class="flash-img-wrapper"><img
                            src="https://images.unsplash.com/photo-1604582410491-605e72535457?q=80&w=400&h=400&auto=format&fit=crop"
                            class="flash-img" alt="Kain"></div>
                    <div class="card-body p-4">
                        <h6 class="fw-bold mb-2">Wolfis Grade A</h6>
                        <div class="mb-3"><small class="text-muted text-decoration-line-through me-2">28rb</small><span
                                class="text-danger fw-bold fs-5">19.5rb</span></div>
                        <div class="stock-bar mb-2">
                            <div class="stock-fill" style="width: 85%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3" data-aos="zoom-in" data-aos-delay="200">
                <div class="card flash-card shine-effect">
                    <span class="flash-badge">25% OFF</span>
                    <div class="flash-img-wrapper"><img
                            src="https://images.unsplash.com/photo-1528459801416-a9e53bbf4e17?q=80&w=400&h=400&auto=format&fit=crop"
                            class="flash-img" alt="Kain"></div>
                    <div class="card-body p-4">
                        <h6 class="fw-bold mb-2">Toyobo Fodu</h6>
                        <div class="mb-3"><small class="text-muted text-decoration-line-through me-2">45rb</small><span
                                class="text-danger fw-bold fs-5">33rb</span></div>
                        <div class="stock-bar mb-2">
                            <div class="stock-fill" style="width: 60%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3" data-aos="zoom-in" data-aos-delay="300">
                <div class="card flash-card shine-effect">
                    <span class="flash-badge">40% OFF</span>
                    <div class="flash-img-wrapper"><img
                            src="https://images.unsplash.com/photo-1598048145788-b715694a5e01?q=80&w=400&h=400&auto=format&fit=crop"
                            class="flash-img" alt="Kain"></div>
                    <div class="card-body p-4">
                        <h6 class="fw-bold mb-2">Ceruti Doll</h6>
                        <div class="mb-3"><small class="text-muted text-decoration-line-through me-2">35rb</small><span
                                class="text-danger fw-bold fs-5">21rb</span></div>
                        <div class="stock-bar mb-2">
                            <div class="stock-fill" style="width: 92%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3" data-aos="zoom-in" data-aos-delay="400">
                <div class="card flash-card shine-effect">
                    <span class="flash-badge">20% OFF</span>
                    <div class="flash-img-wrapper"><img
                            src="https://images.unsplash.com/photo-1574169208507-84376144848b?q=80&w=400&h=400&auto=format&fit=crop"
                            class="flash-img" alt="Kain"></div>
                    <div class="card-body p-4">
                        <h6 class="fw-bold mb-2">Maxmara Lux</h6>
                        <div class="mb-3"><small class="text-muted text-decoration-line-through me-2">55rb</small><span
                                class="text-danger fw-bold fs-5">44rb</span></div>
                        <div class="stock-bar mb-2">
                            <div class="stock-fill" style="width: 45%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="kontak" class="section-padding bg-white overflow-hidden">
    <div class="blob blob-2" style="left: -10%; top: 20%;"></div>
    <div class="container position-relative z-2">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2>Hubungi Kami</h2>
            <div class="divider"></div>
            <p class="text-muted">Kami siap membantu kebutuhan kain Anda. Silakan hubungi kontak di bawah ini.</p>
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
                <div class="contact-card">
                    <div class="contact-icon"><i class="fas fa-phone-alt"></i></div>
                    <div>
                        <h5 class="fw-bold mb-1">Telepon Kantor</h5>
                        <p class="text-muted mb-0">(022) 456-7890</p>
                    </div>
                </div>
                <div class="contact-card">
                    <div class="contact-icon"><i class="far fa-envelope"></i></div>
                    <div>
                        <h5 class="fw-bold mb-1">Email Support</h5>
                        <p class="text-muted mb-0">hello@tamaratextile.com</p>
                    </div>
                </div>
                <div class="mt-5">
                    <h6 class="fw-bold mb-3">Ikuti Kami:</h6><a href="#" class="social-btn"><i
                            class="fab fa-instagram"></i></a><a href="#" class="social-btn"><i
                            class="fab fa-facebook-f"></i></a><a href="#" class="social-btn"><i
                            class="fab fa-tiktok"></i></a>
                </div>
            </div>
            <div class="col-lg-7" data-aos="fade-left">
                <div class="map-container shadow-lg"><iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.888098013676!2d107.61526631477277!3d-6.903449495007356!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e64c5e88662f%3A0x300c5e82dd4b750!2sBandung%2C%20Bandung%20City%2C%20West%20Java!5e0!3m2!1sen!2sid!4v1629787541234!5m2!1sen!2sid"
                        width="100%" height="450" style="border:0; filter: grayscale(20%);" allowfullscreen=""
                        loading="lazy"></iframe></div>
                <div class="mt-4 text-center">
                    <h5><i class="fas fa-map-marker-alt text-danger me-2"></i>Tamara Textile Store</h5>
                    <p class="text-muted">Jl. Gatot Subroto No. 88, Kawasan Sentra Tekstil, Bandung, Jawa Barat</p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function startFlashSaleTimer() {
        const now = new Date();
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