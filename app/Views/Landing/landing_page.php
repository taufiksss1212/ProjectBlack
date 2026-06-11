<?= $this->extend('layout/template'); ?>

<?= $this->section('styles'); ?>
<link rel="stylesheet" href="<?= base_url('css/home.css?v=' . time()) ?>') ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<header class="hero-wrapper">
    <div class="hero-bg"></div>
    <div class="hero-overlay"></div>
    <div class="hero-content floating-anim" data-aos="zoom-in" data-aos-duration="1500">
        <p class="hero-subtitle mb-2"><?= lang('Site.hero_subtitle') ?></p>

        <h1 class="hero-title-gold">Tamara Textile</h1>
        <div class="gold-divider"><i class="fas fa-gem gold-icon"></i></div>

        <p class="lead mb-5 text-white"
            style="font-weight: 300; text-shadow: 1px 1px 5px rgba(0,0,0,0.8); max-width: 700px; margin: 0 auto; opacity: 0.9;">
            <?= lang('Site.hero_desc') ?>
        </p>

        <a href="<?= base_url('katalog') ?>" class="btn btn-gold-outline shadow-lg ls-1">
            <?= lang('Site.btn_catalog') ?> <i class="fas fa-arrow-right ms-2"></i>
        </a>
    </div>
</header>

<div class="ticker-wrap shadow">
    <div class="ticker">
        <span class="ticker-item"><i class="fas fa-star me-2"></i><?= lang('Site.ticker_quality') ?></span>
        <span class="ticker-item"><i class="fas fa-truck me-2"></i><?= lang('Site.ticker_shipping') ?></span>
        <span class="ticker-item"><i class="fas fa-tags me-2"></i><?= lang('Site.ticker_price') ?></span>
        <span class="ticker-item"><i class="fas fa-undo me-2"></i><?= lang('Site.ticker_return') ?></span>
    </div>
</div>

<section id="about" class="section-padding text-center bg-white overflow-hidden">
    <div class="container position-relative z-2">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-5 mb-4 mb-lg-0" data-aos="fade-right">
                <img src="<?= base_url('images/about.jpg') ?>" alt="About"
                    class="img-fluid rounded-pill shadow-lg floating-anim"
                    style="max-height: 400px; border: 5px solid white;">
            </div>
            <div class="col-lg-6 offset-lg-1 text-lg-start" data-aos="fade-left">
                <span class="text-gold text-uppercase small fw-bold ls-2"><?= lang('Site.about_us') ?></span>
                <h2 class="mt-2 mb-3"><?= lang('Site.about_title') ?></h2>
                <div class="divider ms-0"></div>
                <p class="text-secondary fs-5" style="line-height: 1.9;">
                    <?= lang('Site.about_desc') ?>
                </p>
            </div>
        </div>
    </div>
</section>

<section id="produk" class="section-padding bg-soft overflow-hidden">
    <div class="container position-relative z-2">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2><?= lang('Site.pop_title') ?></h2>
            <div class="divider"></div>
            <p class="text-muted"><?= lang('Site.pop_desc') ?></p>
        </div>
        <div class="row g-4 justify-content-lg-center">
            <?php if (empty($populer)): ?>
                <div class="text-center text-muted">Belum ada data produk populer.</div>
            <?php else: ?>
                <?php foreach ($populer as $i => $p): ?>
                    <?php
                    $imgUrl = strpos($p['gambar_produk'], 'http') === 0 ? $p['gambar_produk'] : base_url('uploads/products/' . $p['gambar_produk']);
                    $delay = ($i + 1) * 100;
                    ?>
                    <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="<?= $delay ?>">
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
                                <a href="<?= base_url('katalog') ?>"
                                    class="btn btn-sm btn-outline-dark rounded-pill mt-2 px-4"><?= lang('Site.btn_detail') ?></a>
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
        <div class="flash-header text-center mx-auto" data-aos="fade-down" style="max-width: 800px;">
            <span class="d-inline-block px-4 py-2 mb-3 rounded-pill"
                style="background: rgba(255, 255, 255, 0.05); color: #d4af37; border: 1px solid rgba(212, 175, 55, 0.3); font-weight: 600; font-size: 0.75rem; letter-spacing: 3px; text-transform: uppercase;">
                <i class="fas fa-gem me-2"></i><?= lang('Site.fs_badge') ?>
            </span>

            <h2 class="display-4 fw-bold text-white mb-3" style="font-family: 'Playfair Display', serif;">
                <?= lang('Site.fs_title') ?> <span
                    style="color: var(--gold); font-style: italic;"><?= lang('Site.fs_subtitle') ?></span>
            </h2>

            <div
                style="width: 80px; height: 1px; background: linear-gradient(90deg, transparent, #d4af37, transparent); margin: 20px auto;">
            </div>

            <p class="text-white-50 fs-5 mb-5" style="font-weight: 300; line-height: 1.6;">
                <?= lang('Site.fs_desc') ?>
            </p>
        </div>
        <div class="row g-4 justify-content-lg-center">
            <?php if (empty($flash_sale)): ?>
                <div class="text-center text-white-50 py-5">
                    <i class="far fa-clock fa-3x mb-3 opacity-50"></i>
                    <p>Tidak ada promo flash sale saat ini.</p>
                </div>
            <?php else: ?>
                <?php foreach ($flash_sale as $i => $fs): ?>
                    <?php
                    $imgUrl = strpos($fs['gambar_produk'], 'http') === 0 ? $fs['gambar_produk'] : base_url('uploads/products/' . $fs['gambar_produk']);
                    $persenDiskon = 0;
                    if ($fs['harga_coret'] > 0) {
                        $persenDiskon = round((($fs['harga_coret'] - $fs['harga']) / $fs['harga_coret']) * 100);
                    }
                    $stokPersen = $fs['stok'] > 100 ? 100 : $fs['stok'];
                    ?>
                    <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="<?= ($i + 1) * 100 ?>">
                        <div class="card flash-card">
                            <?php if ($persenDiskon > 0): ?>
                                <span class="flash-badge"><?= $persenDiskon ?>% OFF</span>
                            <?php endif; ?>
                            <div class="flash-img-wrapper">
                                <img src="<?= $imgUrl ?>" class="flash-img" alt="<?= $fs['nama_produk'] ?>">
                            </div>
                            <div class="card-body p-3 p-md-4">
                                <h6 class="fw-bold mb-2 text-truncate text-dark"><?= $fs['nama_produk'] ?></h6>
                                <div class="mb-3">
                                    <span class="price-strike d-block d-md-inline me-2">
                                        Rp<?= number_format($fs['harga_coret'] / 1000, 0) ?>rb
                                    </span>
                                    <span class="price-final">
                                        Rp<?= number_format($fs['harga'] / 1000, 0) ?>rb
                                    </span>
                                </div>
                                <div class="d-flex justify-content-between small text-muted mb-1" style="font-size: 0.75rem;">
                                    <span><?= lang('Site.fs_stock') ?></span>
                                    <span class="fw-bold text-dark"><?= number_format($fs['stok']) ?></span>
                                </div>
                                <div class="stock-bar">
                                    <div class="stock-fill" style="width: <?= $stokPersen ?>%"></div>
                                </div>
                                <a href="<?= base_url('katalog') ?>" class="btn btn-dark w-100 mt-3 btn-sm rounded-1"
                                    style="font-size: 0.8rem; letter-spacing: 1px;">
                                    <?= lang('Site.btn_buy') ?>
                                </a>
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
            <h2><?= lang('Site.contact_title') ?></h2>
            <div class="divider"></div>
        </div>
        <div class="row align-items-center g-5">
            <div class="col-lg-5" data-aos="fade-right">
                <div class="contact-card">
                    <div class="contact-icon"><i class="fab fa-whatsapp"></i></div>
                    <div>
                        <h5 class="fw-bold mb-1">Admin 1</h5>
                        <a href="tel:+6281239334764" class="text-muted text-decoration-none mb-0 d-block">
                            +62 812-3933-4764 (<?= lang('Site.contact_24h') ?>)
                        </a>
                    </div>
                </div>

                <div class="contact-card">
                    <div class="contact-icon"><i class="fab fa-whatsapp"></i></div>
                    <div>
                        <h5 class="fw-bold mb-1">Admin 2</h5>
                        <a href="tel:+6281239188716" class="text-muted text-decoration-none mb-0 d-block">
                            +62 812-3918-8716 (<?= lang('Site.contact_24h') ?>)
                        </a>
                    </div>
                </div>
                <div class="contact-card mt-3">
                    <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
                    <div>
                        <h5 class="fw-bold mb-1"><?= lang('Site.contact_loc') ?></h5>
                        <p class="text-muted mb-0">Jl. Pulau Batanta No.53 Denpasar Barat</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7" data-aos="fade-left">
                <div class="map-container shadow-lg">
                    <iframe width="100%" height="450" frameborder="0" style="border:0; filter: grayscale(20%);"
                        src="https://maps.google.com/maps?q=Tamara+Bali+Textile+Jl+Pulau+Batanta&t=&z=15&ie=UTF8&iwloc=&output=embed"
                        allowfullscreen loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<?= $this->endSection(); ?>