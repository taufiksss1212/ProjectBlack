<?= $this->extend('dashboard/layout') ?>

<?= $this->section('content') ?>

<style>
    /* Styling Khusus Dashboard Clean Luxury */
    :root {
        --lux-gold: #c5a059;
        --lux-dark: #1a1a1a;
        --soft-bg: #f3f5f9;
    }

    /* Override wrapper agar background halaman jadi abu-abu muda bersih */
    .content-wrapper {
        background: var(--soft-bg) !important;
        padding: 25px;
        min-height: 100vh;
    }

    /* 1. Hero Section yang Bersih */
    .welcome-card {
        background: white;
        border-radius: 16px;
        padding: 30px 40px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.03);
        border: 1px solid rgba(0, 0, 0, 0.02);
        margin-bottom: 30px;
        position: relative;
        overflow: hidden;
    }

    .welcome-card::after {
        content: '';
        position: absolute;
        right: 0;
        top: 0;
        bottom: 0;
        width: 6px;
        background: var(--lux-gold);
    }

    /* 2. Stat Cards Modern */
    .stat-card-clean {
        background: white;
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
        border: 1px solid rgba(0, 0, 0, 0.02);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .stat-card-clean:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(197, 160, 89, 0.15);
        border-color: rgba(197, 160, 89, 0.3);
    }

    .stat-icon-circle {
        width: 55px;
        height: 55px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        margin-bottom: 20px;
    }

    .stat-value {
        font-family: var(--font-serif);
        font-size: 2.2rem;
        font-weight: 700;
        color: var(--lux-dark);
        line-height: 1;
        margin-bottom: 5px;
    }

    .stat-label {
        color: #8898aa;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
    }

    /* 3. Tabel & Widget */
    .card-clean {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
        border: none;
        height: 100%;
        overflow: hidden;
    }

    .card-header-clean {
        padding: 25px 30px;
        background: white;
        border-bottom: 1px solid #f1f1f1;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .table-custom thead th {
        background: #f8f9fa;
        color: #6c757d;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        border: none;
        padding: 15px 30px;
    }

    .table-custom tbody td {
        padding: 20px 30px;
        border-bottom: 1px solid #f8f9fa;
        vertical-align: middle;
        color: #495057;
    }

    .table-custom tr:last-child td {
        border-bottom: none;
    }

    /* Widget Profil */
    .profile-widget {
        text-align: center;
        padding: 40px 30px;
    }

    .profile-img-lg {
        width: 110px;
        height: 110px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid white;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    .tips-box {
        background: #fff8e6;
        /* Gold/Yellow sangat muda */
        border-radius: 12px;
        padding: 20px;
        margin-top: 25px;
        text-align: left;
        border-left: 4px solid var(--lux-gold);
    }

    /* Tombol Elegant */
    .btn-gold {
        background: var(--lux-gold);
        color: white;
        border: none;
        padding: 12px 25px;
        border-radius: 8px;
        font-weight: 500;
        transition: 0.2s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-gold:hover {
        background: #b08d4b;
        color: white;
        transform: translateY(-1px);
    }
</style>

<div class="welcome-card d-flex justify-content-between align-items-center flex-wrap gap-3">
    <div>
        <h2 class="mb-1" style="font-family: var(--font-serif); color: var(--lux-dark);">
            Selamat Datang, <?= session()->get('nama_lengkap') ?>!
        </h2>
        <p class="text-muted mb-0">
            Berikut adalah ringkasan aktivitas butik hari ini.
        </p>
    </div>
    <a href="<?= base_url('admin/produk') ?>" class="btn-gold">
        <i data-lucide="plus-circle" style="width: 18px;"></i> Tambah Stok Kain
    </a>
</div>

<div class="row g-4 mb-5">
    <div class="col-md-4">
        <div class="stat-card-clean">
            <div class="stat-icon-circle" style="background: #fff4e0; color: #c5a059;">
                <i data-lucide="package"></i>
            </div>
            <div>
                <div class="stat-value"><?= $total_produk ?></div>
                <div class="stat-label">Total Koleksi</div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="stat-card-clean">
            <div class="stat-icon-circle" style="background: #e0f2fe; color: #0ea5e9;">
                <i data-lucide="scroll-text"></i>
            </div>
            <div>
                <div class="stat-value"><?= $total_bahan ?></div>
                <div class="stat-label">Jenis Material</div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="stat-card-clean">
            <div class="stat-icon-circle" style="background: #fce7f3; color: #db2777;">
                <i data-lucide="palette"></i>
            </div>
            <div>
                <div class="stat-value"><?= $total_warna ?></div>
                <div class="stat-label">Variasi Warna</div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card-clean">
            <div class="card-header-clean">
                <div>
                    <h5 class="mb-0 fw-bold" style="color: var(--lux-dark); font-family: var(--font-serif);">
                        Stok Menipis
                    </h5>
                    <small class="text-muted">Produk yang memerlukan perhatian segera.</small>
                </div>
                <a href="<?= base_url('admin/produk') ?>" class="text-decoration-none"
                    style="color: var(--lux-gold); font-weight: 500; font-size: 0.9rem;">
                    Kelola Inventaris &rarr;
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-custom mb-0">
                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Sisa Stok</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($stok_menipis)): ?>
                            <tr>
                                <td colspan="3" class="text-center py-5">
                                    <div class="text-muted">
                                        <i data-lucide="check-circle" class="mb-3 text-success"
                                            style="width: 40px; height: 40px;"></i>
                                        <p class="mb-0">Semua stok aman terkendali.</p>
                                    </div>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($stok_menipis as $s): ?>
                                <tr>
                                    <td>
                                        <span class="fw-bold text-dark"><?= $s['nama_produk'] ?></span>
                                    </td>
                                    <td
                                        style="font-family: monospace; font-size: 1rem; color: var(--lux-gold); font-weight: 600;">
                                        <?= $s['stok'] ?> <?= $s['satuan_jual'] ?>
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill"
                                            style="background: #ffecec; color: #d63384; font-weight: 500; padding: 6px 12px;">
                                            Hampir Habis
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card-clean profile-widget">
            <img src="<?= base_url('uploads/profiles/' . session()->get('foto_profil')) ?>" class="profile-img-lg">

            <h4 class="mb-1" style="font-family: var(--font-serif);"><?= session()->get('nama_lengkap') ?></h4>
            <p class="text-muted text-uppercase small mb-0"><?= session()->get('role') ?> Tamara Textile</p>

            <div class="tips-box">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <i class="fas fa-lightbulb" style="color: var(--lux-gold);"></i>
                    <span class="fw-bold small text-dark">TIPS HARI INI</span>
                </div>
                <p class="mb-0 small text-muted" style="line-height: 1.6;">
                    "Cek tabel di samping. Jika ada barang yang stoknya kritis, segera hubungi supplier kain sebelum
                    pelanggan kecewa."
                </p>
            </div>
        </div>
    </div>
</div>

<script>
    // Jalankan render icon Lucide
    lucide.createIcons();
</script>

<?= $this->endSection() ?>