<?= $this->extend('dashboard/layout') ?>

<?= $this->section('content') ?>
<div class="header-card">
    <div class="header-text">
        <h1>Selamat Datang, <?= session()->get('nama_lengkap') ?>! 👋</h1>
        <p>Ringkasan performa inventaris Tamara Textile hari ini.</p>
    </div>
    <div class="header-actions">
        <a href="<?= base_url('admin/produk') ?>" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i> Tambah Kain
        </a>
    </div>
</div>

<div class="stats-grid">
    <div class="stat-card" style="background: var(--lux-gray); border: 1px solid rgba(255,255,255,0.03);">
        <div class="stat-icon" style="background: rgba(197, 160, 89, 0.1); color: var(--lux-gold);">
            <i data-lucide="package"></i>
        </div>
        <div class="stat-info">
            <h3 style="font-family: var(--font-serif);"><?= $total_produk ?></h3>
            <p style="text-transform: uppercase; font-size: 10px; letter-spacing: 1px;">Koleksi Produk</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="color: #59a5c5; background: rgba(89,165,197,0.1);">
            <i data-lucide="scroll-text"></i>
        </div>
        <div class="stat-info">
            <h3 style="font-family: var(--font-serif);"><?= $total_bahan ?></h3>
            <p style="text-transform: uppercase; font-size: 10px; letter-spacing: 1px;">Material Kain</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="color: #c559a5; background: rgba(197,89,165,0.1);">
            <i data-lucide="palette"></i>
        </div>
        <div class="stat-info">
            <h3 style="font-family: var(--font-serif);"><?= $total_warna ?></h3>
            <p style="text-transform: uppercase; font-size: 10px; letter-spacing: 1px;">Spektrum Warna</p>
        </div>
    </div>
</div>

<script>
// Jono: Inisialisasi Ikon Lucide agar muncul
lucide.createIcons();
</script>

<div class="content-grid">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center">
            <h2 class="mb-0"><i class="fas fa-exclamation-triangle text-warning me-2"></i> Stok Menipis</h2>
            <a href="<?= base_url('admin/produk') ?>" class="view-all text-decoration-none">Kelola Stok</a>
        </div>
        <div class="table-responsive mt-3">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Nama Produk</th>
                        <th>Sisa</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($stok_menipis)): ?>
                    <tr>
                        <td colspan="3" class="text-center py-4 text-muted">Semua stok aman Bos! ✅</td>
                    </tr>
                    <?php else: ?>
                    <?php foreach($stok_menipis as $s): ?>
                    <tr>
                        <td class="fw-bold"><?= $s['nama_produk'] ?></td>
                        <td><?= $s['stok'] ?> <?= $s['satuan_jual'] ?></td>
                        <td><span class="badge rounded-pill bg-danger">Kritis</span></td>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-header bg-transparent border-0">
            <h2 class="mb-0">Profil Manager</h2>
        </div>
        <div class="shoutout-item mt-3 p-3 rounded bg-light border">
            <div class="shoutout-avatar">
                <img src="<?= base_url('uploads/profiles/' . session()->get('foto_profil')) ?>"
                    style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                <div class="status-dot"></div>
            </div>
            <div class="shoutout-info">
                <h4><?= session()->get('nama_lengkap') ?></h4>
                <p><?= session()->get('role') ?> Tamara Textile</p>
            </div>
        </div>
        <div class="mt-4 alert alert-info border-0 shadow-sm" style="border-left: 5px solid #d4a574 !important;">
            <small class="fw-bold d-block mb-1 text-uppercase">Tips Jono:</small>
            <p class="small mb-0">Bos, jangan lupa cek tabel stok menipis secara rutin agar pelanggan tidak kecewa saat
                memesan kain! 🧐</p>
        </div>
    </div>
</div>

<style>
.content-wrapper {
    background: #f8f9fa !important;
    border-radius: 30px;
}

.stat-card:hover {
    transform: translateY(-5px);
    transition: 0.3s;
}
</style>
<?= $this->endSection() ?>