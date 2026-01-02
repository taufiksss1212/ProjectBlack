<?= $this->extend('dashboard/layout') ?>

<?= $this->section('content') ?>
<style>
/* Wrapper Utama Search */
.search-group {
    display: flex;
    align-items: center;
    background: white;
    border: 1px solid #e0e0e0;
    border-radius: 50px;
    /* Padding Kanan 5px agar tombol Search ada jarak sedikit dari pinggir */
    padding: 4px 5px 4px 20px;
    transition: 0.3s;
    width: 100%;
    max-width: 600px;
    position: relative;
    /* Menjaga kestabilan layout */
}

.search-group:focus-within {
    border-color: var(--lux-gold);
    box-shadow: 0 0 0 4px rgba(197, 160, 89, 0.1);
}

/* Input Field */
.search-input {
    border: none;
    background: transparent;
    outline: none;
    flex: 1;
    /* Input mengisi ruang sisa */
    min-width: 0;
    /* Mencegah input mendorong elemen lain */
    padding: 12px 10px 12px 0;
    /* Padding kanan ditambah agar teks tidak nempel tombol reset */
    color: #333;
    font-size: 0.95rem;
}

/* Tombol Reset (Perbaikan Jarak) */
.btn-reset-custom {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    background: #f1f3f5;
    color: #868e96;
    border: none;
    padding: 0 14px;
    /* Padding samping */
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
    text-decoration: none;
    white-space: nowrap;
    flex-shrink: 0;
    /* PENTING: Jangan gepeng */
    height: 32px;
    transition: 0.2s;

    /* === PERBAIKAN UTAMA DISINI === */
    margin-right: 50px;
    /* Memberi jarak paksa ke kanan agar tidak tertimpa Search */
}

.btn-reset-custom:hover {
    background: #ffc9c9;
    color: #c92a2a;
}

/* Tombol Search */
.search-btn {
    width: 42px;
    height: 42px;
    background: var(--lux-gold);
    color: white;
    border: none;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    flex-shrink: 0;
    /* PENTING: Jangan gepeng */

}
</style>
<!-- Page Header -->
<div class="page-header">
    <div class="page-title">
        <h2>Master Tabel Produk</h2>
        <p>Kelola stok, harga, dan varian kain Anda.</p>
    </div>
    <div class="header-actions">
        <button class="btn btn-outline" data-bs-toggle="modal" data-bs-target="#modalFlashSale">
            <i class="fas fa-bolt"></i> Kelola Flash Sale
        </button>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
            <i class="fas fa-plus"></i> Tambah Produk
        </button>
    </div>
</div>

<!-- Alert Success -->
<?php if (session()->getFlashdata('success')) : ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fas fa-check-circle me-2"></i> <?= session()->getFlashdata('success') ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>

<!-- Alert Error -->
<?php if (session()->getFlashdata('error')) : ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="fas fa-exclamation-circle me-2"></i> <?= session()->getFlashdata('error') ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>

<!-- Search Card -->
<div class="search-card mb-4">
    <form action="<?= base_url('admin/produk') ?>" method="get" id="searchForm">
        <div class="search-group shadow-sm">

            <input type="text" name="search" id="searchInput" class="search-input"
                placeholder="Cari kain, warna, atau jenis..." value="<?= esc($keyword ?? '') ?>" autocomplete="off">

            <?php if (!empty($keyword)): ?>
            <a href="<?= base_url('admin/produk') ?>" class="btn-reset-custom">
                <i class="fas fa-times"></i> <span class="d-none d-sm-inline">Reset</span>
            </a>
            <?php endif; ?>

            <button type="submit" class="search-btn">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </form>

    <?php if (!empty($keyword)): ?>
    <div class="mt-2 ms-3">
        <small class="text-muted">
            <i class="fas fa-info-circle me-1"></i>
            Hasil untuk: <strong>"<?= esc($keyword) ?>"</strong>
            (<?= count($produk) ?> data)
        </small>
    </div>
    <?php endif; ?>
</div>

<!-- Table Card -->
<div class="table-card">
    <div class="table-wrapper">
        <table class="product-table">
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Nama Produk</th>
                    <th>Bahan & Warna</th>
                    <th>Harga (Rp)</th>
                    <th>Stok</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($produk)): ?>
                <tr>
                    <td colspan="7" class="text-center py-4">
                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Belum ada produk. Klik "Tambah Produk" untuk memulai.</p>
                    </td>
                </tr>
                <?php else: ?>
                <?php foreach ($produk as $p) : ?>
                <tr>
                    <td>
                        <img src="<?= base_url('uploads/products/' . $p['gambar_produk']) ?>"
                            alt="<?= $p['nama_produk'] ?>" class="product-image">
                    </td>
                    <td>
                        <div class="product-name"><?= $p['nama_produk'] ?></div>
                        <div class="product-id">ID: #<?= $p['id'] ?></div>
                    </td>
                    <td>
                        <span class="badge badge-info"><?= $p['nama_bahan'] ?></span>
                        <span class="variant-text"><?= $p['nama_varian'] ?> (<?= $p['nama_kelompok'] ?>)</span>
                    </td>
                    <td>
                        <span class="price-main"><?= number_format($p['harga'], 0, ',', '.') ?></span>
                        <?php if ($p['is_flash_sale']) : ?>
                        <span class="price-strike"><?= number_format($p['harga_coret'], 0, ',', '.') ?></span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <span class="<?= $p['stok'] < 10 ? 'stock-low' : 'stock-normal' ?>">
                            <?= $p['stok'] ?> <?= $p['satuan_jual'] ?>
                        </span>
                    </td>
                    <td>
                        <?php if ($p['is_flash_sale']) : ?>
                        <span class="badge badge-danger">FLASH SALE</span>
                        <?php else : ?>
                        <span class="badge badge-secondary">Normal</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn-icon view" title="Detail"
                                onclick="viewProduct(<?= htmlspecialchars(json_encode($p), ENT_QUOTES, 'UTF-8') ?>)">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="btn-icon edit" title="Edit"
                                onclick="editProduct(<?= htmlspecialchars(json_encode($p), ENT_QUOTES, 'UTF-8') ?>)">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn-icon delete" title="Hapus"
                                onclick="confirmDelete(<?= $p['id'] ?>, '<?= esc($p['nama_produk']) ?>')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- ===================== MODAL TAMBAH PRODUK ===================== -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahLabel">
                    <i class="fas fa-plus-circle"></i> Tambah Produk Baru
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('admin/produk/simpan') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Produk <span class="text-danger">*</span></label>
                            <input type="text" name="nama_produk" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jenis Bahan <span class="text-danger">*</span></label>
                            <select name="id_jenis_kain" class="form-select" required>
                                <option value="">Pilih Bahan</option>
                                <?php foreach ($jenis_kain as $j) : ?>
                                <option value="<?= $j['id'] ?>"><?= $j['nama_bahan'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Varian Warna <span class="text-danger">*</span></label>
                            <select name="id_varian_warna" class="form-select" required>
                                <option value="">Pilih Warna</option>
                                <?php foreach ($warna as $w) : ?>
                                <option value="<?= $w['id'] ?>"><?= $w['nama_varian'] ?> (<?= $w['nama_kelompok'] ?>)
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Harga Jual (Rp) <span class="text-danger">*</span></label>
                            <input type="number" name="harga" class="form-control" required min="0">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Stok <span class="text-danger">*</span></label>
                            <input type="number" name="stok" class="form-control" required min="0" step="0.1">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Satuan Jual <span class="text-danger">*</span></label>
                            <select name="satuan_jual" class="form-select" required>
                                <option value="meter">Meter</option>
                                <option value="yard">Yard</option>
                                <option value="roll">Roll</option>
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Foto Produk (Max 2MB) <span class="text-danger">*</span></label>
                            <input type="file" name="gambar_produk" class="form-control" accept="image/*" required>
                            <small class="text-muted">Format: JPG, JPEG, PNG. Maksimal 2MB</small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Produk
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ===================== MODAL DETAIL PRODUK ===================== -->
<div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="modalDetailLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background: white; color: #333;">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetailLabel">
                    <i class="fas fa-info-circle"></i> Detail Produk
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4 text-center mb-3">
                        <img id="detail_gambar" src="" alt="Product" class="img-fluid rounded"
                            style="max-height: 300px;">
                    </div>
                    <div class="col-md-8">
                        <table class="table table-borderless">
                            <tr>
                                <th width="40%">ID Produk</th>
                                <td id="detail_id"></td>
                            </tr>
                            <tr>
                                <th>Nama Produk</th>
                                <td id="detail_nama"></td>
                            </tr>
                            <tr>
                                <th>Jenis Bahan</th>
                                <td><span id="detail_bahan" class="badge badge-info"></span></td>
                            </tr>
                            <tr>
                                <th>Varian Warna</th>
                                <td id="detail_warna"></td>
                            </tr>
                            <tr>
                                <th>Harga Jual</th>
                                <td><strong id="detail_harga" class="text-success"></strong></td>
                            </tr>
                            <tr id="row_harga_coret" style="display: none;">
                                <th>Harga Coret</th>
                                <td><del id="detail_harga_coret" class="text-muted"></del></td>
                            </tr>
                            <tr>
                                <th>Stok</th>
                                <td id="detail_stok"></td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td><span id="detail_status"></span></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- ===================== MODAL EDIT PRODUK ===================== -->
<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">

            <div class="modal-header px-4 py-3" style="background: white; border-bottom: 2px solid var(--lux-gold);">
                <div>
                    <h5 class="modal-title fw-bold text-dark" id="modalEditLabel"
                        style="font-family: var(--font-serif);">
                        Edit Informasi Produk
                    </h5>
                    <p class="text-muted small mb-0">Perbarui detail stok, harga, atau varian kain.</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="<?= base_url('admin/produk/update') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="edit_id">
                <input type="hidden" name="gambar_lama" id="edit_gambar_lama">

                <div class="modal-body p-4" style="background: #fdfdfd;">
                    <div class="row g-4">

                        <div class="col-lg-4 text-center">
                            <div class="p-3 bg-white rounded shadow-sm border">
                                <label class="form-label small text-muted text-uppercase fw-bold mb-3">Foto Saat
                                    Ini</label>
                                <div class="position-relative d-inline-block">
                                    <img id="edit_preview" src="" alt="Current Image" class="img-fluid rounded"
                                        style="width: 100%; height: 200px; object-fit: cover; border: 1px solid #eee;">
                                </div>

                                <div class="mt-3 text-start">
                                    <label class="form-label small fw-bold text-dark">Ganti Foto (Opsional)</label>
                                    <input type="file" name="gambar_produk" class="form-control form-control-sm"
                                        accept="image/*">
                                    <small class="text-muted d-block mt-1" style="font-size: 10px;">
                                        Maksimal 2MB (JPG/PNG). Biarkan kosong jika tidak ingin mengubah foto.
                                    </small>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-8">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label small text-uppercase fw-bold text-muted">Nama
                                        Produk</label>
                                    <input type="text" name="nama_produk" id="edit_nama_produk" class="form-control"
                                        required style="font-weight: 600; color: #333;">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label small text-uppercase fw-bold text-muted">Jenis
                                        Bahan</label>
                                    <select name="id_jenis_kain" id="edit_id_jenis_kain" class="form-select" required>
                                        <?php foreach ($jenis_kain as $j) : ?>
                                        <option value="<?= $j['id'] ?>"><?= $j['nama_bahan'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label small text-uppercase fw-bold text-muted">Varian
                                        Warna</label>
                                    <select name="id_varian_warna" id="edit_id_varian_warna" class="form-select"
                                        required>
                                        <?php foreach ($warna as $w) : ?>
                                        <option value="<?= $w['id'] ?>"><?= $w['nama_varian'] ?>
                                            (<?= $w['nama_kelompok'] ?>)</option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="col-md-12">
                                    <hr class="my-2 border-light">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label small text-uppercase fw-bold text-muted">Harga Jual
                                        (Rp)</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white text-muted">Rp</span>
                                        <input type="number" name="harga" id="edit_harga" class="form-control" required
                                            min="0"
                                            style="font-family: monospace; font-weight: bold; color: var(--lux-gold);">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label small text-uppercase fw-bold text-muted">Stok</label>
                                    <input type="number" name="stok" id="edit_stok" class="form-control" required
                                        min="0" step="0.1">
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label small text-uppercase fw-bold text-muted">Satuan</label>
                                    <select name="satuan_jual" id="edit_satuan_jual" class="form-select" required>
                                        <option value="meter">Meter</option>
                                        <option value="yard">Yard</option>
                                        <option value="roll">Roll</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-0 bg-light px-4 py-3">
                    <button type="button" class="btn btn-light text-muted border" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-dark px-4" style="background: var(--lux-gold); border: none;">
                        <i class="fas fa-save me-2"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ===================== MODAL KONFIRMASI DELETE ===================== -->
<div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background: white; color: #333;">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="modalDeleteLabel">
                    <i class="fas fa-exclamation-triangle"></i> Konfirmasi Hapus
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus produk:</p>
                <h5 class="text-center my-3" id="delete_nama_produk"></h5>
                <p class="text-danger"><strong>Perhatian:</strong> Data yang dihapus tidak dapat dikembalikan!</p>
            </div>
            <div class="modal-footer">
                <form action="<?= base_url('admin/produk/hapus') ?>" method="post">
                    <?= csrf_field() ?>
                    <input type="hidden" name="id" id="delete_id">
                    <input type="hidden" name="gambar" id="delete_gambar">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i> Ya, Hapus!
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- ===================== MODAL FLASH SALE ===================== -->
<div class="modal fade" id="modalFlashSale" tabindex="-1" aria-labelledby="modalFlashSaleLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content border-0 shadow-lg">

            <div class="modal-header py-4 px-4" style="border-bottom: 2px solid var(--lux-gold); background: #fff;">
                <div>
                    <h4 class="modal-title fw-bold" id="modalFlashSaleLabel"
                        style="font-family: var(--font-serif); color: #1a1a1a;">
                        Kelola Flash Sale
                    </h4>
                    <p class="text-muted small mb-0">Atur diskon spesial untuk produk pilihan Anda.</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4" style="background: #fdfdfd;">

                <div class="row g-4">
                    <div class="col-lg-7">
                        <div class="card border-0 shadow-sm h-100" style="background: #fff; border-radius: 12px;">
                            <div class="card-body p-4">
                                <form id="formFlashSale">
                                    <div class="mb-4">
                                        <label class="form-label text-uppercase small fw-bold text-muted">Pilih
                                            Produk</label>
                                        <select id="produk_flash_sale" class="form-select form-select-lg"
                                            style="border-radius: 8px;">
                                            <option value="">-- Cari Produk --</option>
                                            <?php foreach ($produk as $p) : ?>
                                            <option value="<?= $p['id'] ?>" data-nama="<?= esc($p['nama_produk']) ?>"
                                                data-harga="<?= $p['harga'] ?>"
                                                data-is-flash="<?= $p['is_flash_sale'] ?>"
                                                data-harga-coret="<?= $p['harga_coret'] ?>">
                                                <?= $p['nama_produk'] ?>
                                                (Rp<?= number_format($p['harga'], 0, ',', '.') ?>)
                                                <?= $p['is_flash_sale'] ? '⚡' : '' ?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label text-uppercase small fw-bold text-muted">Persentase
                                                Diskon</label>
                                            <div class="input-group">
                                                <input type="number" id="diskon_persen" class="form-control"
                                                    placeholder="0" min="1" max="90" value="25"
                                                    style="border-right: 0;">
                                                <span class="input-group-text bg-white text-muted"
                                                    style="border-left: 0;">%</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label
                                                class="form-label text-uppercase small fw-bold text-muted">Status</label>
                                            <div class="d-flex align-items-center p-2 border rounded bg-light">
                                                <div class="form-check form-switch mb-0">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="status_flash_sale" style="cursor: pointer;">
                                                    <label class="form-check-label ms-2 fw-bold" for="status_flash_sale"
                                                        id="label_status">
                                                        Nonaktif
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-4 pt-3 border-top">
                                        <button type="button" class="btn btn-dark w-100 py-2"
                                            onclick="simpanFlashSale()"
                                            style="background: var(--lux-gold); border: none;">
                                            <i class="fas fa-check-circle me-2"></i> Terapkan Perubahan
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div id="preview_harga" class="card border-0 h-100 shadow-sm"
                            style="display: none; background: #fff8e6; border: 1px dashed #c5a059 !important;">
                            <div
                                class="card-body p-4 text-center d-flex flex-column justify-content-center align-items-center">
                                <h6 class="text-muted text-uppercase letter-spacing-2 mb-3">Preview Harga Jual</h6>

                                <h4 id="preview_harga_normal" class="text-decoration-line-through text-muted mb-1"
                                    style="font-family: monospace;">
                                    Rp 0
                                </h4>

                                <div id="preview_diskon" class="badge bg-danger rounded-pill px-3 py-2 mb-3">
                                    -0%
                                </div>

                                <h2 id="preview_harga_flash" class="fw-bold mb-0 display-5"
                                    style="color: var(--lux-gold); font-family: var(--font-serif);">
                                    Rp 0
                                </h2>
                                <p class="text-muted small mt-2 fst-italic">Harga yang akan tampil di website.</p>
                            </div>
                        </div>

                        <div id="preview_placeholder"
                            class="card border-0 h-100 bg-light d-flex align-items-center justify-content-center text-muted">
                            <div class="text-center p-4">
                                <i class="fas fa-hand-pointer fa-2x mb-3 text-secondary"></i>
                                <p class="mb-0">Pilih produk di sebelah kiri untuk melihat simulasi harga.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-5">
                    <h5 class="fw-bold mb-3" style="font-family: var(--font-serif);">
                        <i class="fas fa-fire text-danger me-2"></i> Sedang Berlangsung
                    </h5>

                    <div class="card border-0 shadow-sm">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead style="background: #f4f4f4;">
                                    <tr>
                                        <th class="py-3 px-4 text-secondary text-uppercase small">Produk</th>
                                        <th class="py-3 px-4 text-secondary text-uppercase small">Harga Awal</th>
                                        <th class="py-3 px-4 text-secondary text-uppercase small">Diskon</th>
                                        <th class="py-3 px-4 text-secondary text-uppercase small">Harga Promo</th>
                                        <th class="py-3 px-4 text-end text-secondary text-uppercase small">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="list_flash_sale_aktif" style="background: white;">
                                    <?php
                                    $ada_flash = false;
                                    foreach ($produk as $p) :
                                        if ($p['is_flash_sale'] == 1):
                                            $ada_flash = true;
                                            $diskon_rp = 0;
                                            $diskon_persen = 0;
                                            if ($p['harga_coret'] > 0) {
                                                $diskon_rp = $p['harga_coret'] - $p['harga'];
                                                $diskon_persen = round(($diskon_rp / $p['harga_coret']) * 100);
                                            }
                                    ?>
                                    <tr>
                                        <td class="px-4">
                                            <span class="fw-bold text-dark d-block"><?= $p['nama_produk'] ?></span>
                                            <small class="text-muted"><?= $p['nama_bahan'] ?> •
                                                <?= $p['nama_varian'] ?></small>
                                        </td>
                                        <td class="px-4 text-muted text-decoration-line-through">
                                            Rp <?= number_format($p['harga_coret'], 0, ',', '.') ?>
                                        </td>
                                        <td class="px-4">
                                            <span
                                                class="badge bg-danger bg-opacity-10 text-danger border border-danger">
                                                Hemat <?= $diskon_persen ?>%
                                            </span>
                                        </td>
                                        <td class="px-4">
                                            <strong style="color: var(--lux-gold); font-size: 1.1rem;">
                                                Rp <?= number_format($p['harga'], 0, ',', '.') ?>
                                            </strong>
                                        </td>
                                        <td class="px-4 text-end">
                                            <button class="btn btn-sm btn-light text-primary border me-1"
                                                onclick="loadFlashSaleToForm(<?= $p['id'] ?>)"
                                                title="Lihat & Edit di Preview">
                                                <i class="fas fa-pencil-alt"></i> Edit
                                            </button>

                                            <button class="btn btn-sm btn-light text-danger border"
                                                onclick="nonaktifkanFlashSale(<?= $p['id'] ?>, '<?= esc($p['nama_produk']) ?>')"
                                                title="Hentikan Flash Sale">
                                                <i class="fas fa-stop-circle"></i> Stop
                                            </button>
                                        </td>
                                    </tr>
                                    <?php
                                        endif;
                                    endforeach;

                                    if (!$ada_flash):
                                        ?>
                                    <tr>
                                        <td colspan="5" class="text-center py-5 text-muted">
                                            <div class="opacity-50">
                                                <i class="fas fa-tag fa-2x mb-2"></i>
                                                <p class="mb-0">Belum ada promo Flash Sale yang aktif.</p>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- ===================== JAVASCRIPT ===================== -->
<script>
// ==================== FLASH SALE FUNCTIONALITY ====================
const produkSelect = document.getElementById('produk_flash_sale');
const diskonInput = document.getElementById('diskon_persen');
const statusToggle = document.getElementById('status_flash_sale');
const labelStatus = document.getElementById('label_status');
const previewBox = document.getElementById('preview_harga');

let selectedProduk = null;


// Helper sederhana untuk toggle placeholder vs preview
document.getElementById('produk_flash_sale').addEventListener('change', function() {
    const placeholder = document.getElementById('preview_placeholder');
    const preview = document.getElementById('preview_harga');

    if (this.value) {
        placeholder.classList.add('d-none'); // Hide placeholder
        // Preview akan di-show oleh logic JS Anda yang sudah ada (hitungPreview)
    } else {
        placeholder.classList.remove('d-none');
        preview.style.display = 'none';
    }
});
// Event: Pilih Produk
produkSelect.addEventListener('change', function() {
    if (this.value) {
        const option = this.options[this.selectedIndex];
        selectedProduk = {
            id: this.value,
            nama: option.getAttribute('data-nama'),
            harga: parseFloat(option.getAttribute('data-harga')),
            isFlash: option.getAttribute('data-is-flash') == '1',
            hargaCoret: parseFloat(option.getAttribute('data-harga-coret'))
        };

        // Set status toggle
        statusToggle.checked = selectedProduk.isFlash;
        updateStatusLabel();

        // Jika sudah flash sale, hitung diskon dari harga yang ada
        if (selectedProduk.isFlash) {
            const diskon = ((selectedProduk.hargaCoret - selectedProduk.harga) / selectedProduk.hargaCoret) *
                100;
            diskonInput.value = Math.round(diskon);
        }

        hitungPreview();
    } else {
        selectedProduk = null;
        previewBox.style.display = 'none';
        statusToggle.checked = false;
        updateStatusLabel();
    }
});

// Event: Ubah Diskon
diskonInput.addEventListener('input', hitungPreview);

// Event: Toggle Status
statusToggle.addEventListener('change', function() {
    updateStatusLabel();
    if (selectedProduk && !this.checked) {
        // Jika dinonaktifkan, hide preview
        previewBox.style.display = 'none';
    } else if (selectedProduk) {
        hitungPreview();
    }
});

// Function: Update Label Status
function updateStatusLabel() {
    if (statusToggle.checked) {
        labelStatus.innerHTML = '<span class="badge bg-success">⚡ Aktif</span>';
    } else {
        labelStatus.innerHTML = '<span class="badge bg-secondary">Nonaktif</span>';
    }
}

// Function: Hitung Preview
function hitungPreview() {
    if (!selectedProduk || !statusToggle.checked) {
        previewBox.style.display = 'none';
        return;
    }

    const diskonPersen = parseFloat(diskonInput.value) || 0;

    if (diskonPersen < 1 || diskonPersen > 90) {
        previewBox.style.display = 'none';
        return;
    }

    // Hitung harga
    const hargaNormal = selectedProduk.harga;
    const hargaCoret = Math.round(hargaNormal / (1 - (diskonPersen / 100)));
    const diskonRupiah = hargaCoret - hargaNormal;

    // Tampilkan preview
    document.getElementById('preview_harga_normal').textContent = 'Rp ' + hargaCoret.toLocaleString('id-ID');
    document.getElementById('preview_diskon').textContent = '- Rp ' + diskonRupiah.toLocaleString('id-ID') + ' (' +
        diskonPersen + '%)';
    document.getElementById('preview_harga_flash').textContent = 'Rp ' + hargaNormal.toLocaleString('id-ID');

    previewBox.style.display = 'block';
}

// Function: Simpan Flash Sale
function simpanFlashSale() {
    if (!selectedProduk) {
        alert('Silakan pilih produk terlebih dahulu!');
        return;
    }

    const diskonPersen = parseFloat(diskonInput.value);
    const isAktif = statusToggle.checked;

    if (isAktif && (diskonPersen < 1 || diskonPersen > 90)) {
        alert('Diskon harus antara 1% - 90%');
        return;
    }

    // Hitung harga coret
    const hargaCoret = isAktif ? Math.round(selectedProduk.harga / (1 - (diskonPersen / 100))) : 0;

    // Kirim via AJAX atau form
    const formData = new FormData();
    formData.append('id', selectedProduk.id);
    formData.append('is_flash_sale', isAktif ? '1' : '0');
    formData.append('harga_coret', hargaCoret);

    fetch('<?= base_url('admin/produk/update-flash-sale') ?>', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                location.reload();
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            alert('Terjadi kesalahan. Silakan coba lagi.');
            console.error('Error:', error);
        });
}

// Function: Nonaktifkan Flash Sale
function nonaktifkanFlashSale(id, nama) {
    if (!confirm('Nonaktifkan flash sale untuk "' + nama + '"?')) {
        return;
    }

    const formData = new FormData();
    formData.append('id', id);
    formData.append('is_flash_sale', '0');
    formData.append('harga_coret', '0');

    fetch('<?= base_url('admin/produk/update-flash-sale') ?>', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                location.reload();
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            alert('Terjadi kesalahan. Silakan coba lagi.');
            console.error('Error:', error);
        });
}

// ==================== SEARCH FUNCTIONALITY ====================
const searchInput = document.getElementById('searchInput');
const searchForm = document.getElementById('searchForm');

// Live search dengan delay (debounce)
let searchTimeout;
searchInput.addEventListener('input', function() {
    clearTimeout(searchTimeout);

    // Jika input kosong, tidak perlu search
    if (this.value.trim() === '') {
        return;
    }

    // Delay 500ms sebelum search (tunggu user selesai ngetik)
    searchTimeout = setTimeout(() => {
        searchForm.submit();
    }, 500);
});

// Highlight search results
<?php if (!empty($keyword)): ?>
document.addEventListener('DOMContentLoaded', function() {
    const keyword = "<?= esc($keyword) ?>";
    const tableBody = document.querySelector('.product-table tbody');

    if (tableBody && keyword) {
        const cells = tableBody.querySelectorAll('td');
        cells.forEach(cell => {
            const text = cell.textContent;
            const regex = new RegExp(`(${keyword})`, 'gi');
            if (regex.test(text)) {
                cell.innerHTML = cell.innerHTML.replace(regex,
                    '<mark style="background: #ffd700; padding: 2px 4px; border-radius: 3px;">$1</mark>'
                );
            }
        });
    }
});
<?php endif; ?>

// ==================== CRUD FUNCTIONS ====================
// Fungsi VIEW Detail
function viewProduct(data) {
    document.getElementById('detail_id').textContent = '#' + data.id;
    document.getElementById('detail_nama').textContent = data.nama_produk;
    document.getElementById('detail_bahan').textContent = data.nama_bahan;
    document.getElementById('detail_warna').textContent = data.nama_varian + ' (' + data.nama_kelompok + ')';
    document.getElementById('detail_harga').textContent = 'Rp ' + parseInt(data.harga).toLocaleString('id-ID');
    document.getElementById('detail_stok').textContent = data.stok + ' ' + data.satuan_jual;
    document.getElementById('detail_gambar').src = '<?= base_url('uploads/products/') ?>' + data.gambar_produk;

    // Status
    if (data.is_flash_sale == 1) {
        document.getElementById('detail_status').innerHTML = '<span class="badge badge-danger">FLASH SALE</span>';
        document.getElementById('row_harga_coret').style.display = '';
        document.getElementById('detail_harga_coret').textContent = 'Rp ' + parseInt(data.harga_coret).toLocaleString(
            'id-ID');
    } else {
        document.getElementById('detail_status').innerHTML = '<span class="badge badge-secondary">Normal</span>';
        document.getElementById('row_harga_coret').style.display = 'none';
    }

    // Tampilkan modal
    new bootstrap.Modal(document.getElementById('modalDetail')).show();
}

// Fungsi EDIT
function editProduct(data) {
    // Pastikan ID elemen ini sesuai dengan yang ada di modal edit kamu
    document.getElementById('edit_id').value = data.id;
    document.getElementById('edit_nama_produk').value = data.nama_produk;
    document.getElementById('edit_id_jenis_kain').value = data.id_jenis_kain;
    document.getElementById('edit_id_varian_warna').value = data.id_varian_warna;
    document.getElementById('edit_harga').value = data.harga;
    document.getElementById('edit_stok').value = data.stok;
    document.getElementById('edit_satuan_jual').value = data.satuan_jual;
    document.getElementById('edit_gambar_lama').value = data.gambar_produk;

    const previewImg = document.getElementById('edit_preview');
    if (previewImg) {
        previewImg.src = '<?= base_url('uploads/products/') ?>' + data.gambar_produk;
    }

    // Tampilkan modal
    new bootstrap.Modal(document.getElementById('modalEdit')).show();
}
// Fungsi DELETE
function confirmDelete(id, nama) {
    document.getElementById('delete_id').value = id;
    document.getElementById('delete_nama_produk').textContent = nama;

    // Cari gambar dari data produk
    const row = event.target.closest('tr');
    const img = row.querySelector('.product-image');
    if (img) {
        const gambar = img.src.split('/').pop();
        document.getElementById('delete_gambar').value = gambar;
    }

    // Tampilkan modal
    new bootstrap.Modal(document.getElementById('modalDelete')).show();
}

// ==================== UTILITIES ====================
// Auto-hide alert setelah 5 detik
setTimeout(function() {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {
        const bsAlert = new bootstrap.Alert(alert);
        bsAlert.close();
    });
}, 5000);

// Focus ke search input dengan keyboard shortcut (Ctrl/Cmd + K)
document.addEventListener('keydown', function(e) {
    if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
        e.preventDefault();
        searchInput.focus();
        searchInput.select();
    }
});

function hitungPreview() {
    if (!selectedProduk || !statusToggle.checked) {
        previewBox.style.display = 'none';
        return;
    }

    const diskonPersen = parseFloat(diskonInput.value) || 0;

    // JONO: Batasan aman diskon agar tidak terjadi pembagian nol atau angka aneh
    if (diskonPersen < 1 || diskonPersen >= 100) {
        previewBox.style.display = 'none';
        return;
    }

    // RUMUS BALIK: Menghitung Harga Coret dari Harga Jual
    // Jika Harga Jual = 40.000 dan Diskon = 20%
    // Maka Harga Coret = 40.000 / (1 - 0.2) = 50.000
    const hargaJual = selectedProduk.harga;
    const hargaCoret = Math.round(hargaJual / (1 - (diskonPersen / 100)));
    const diskonRupiah = hargaCoret - hargaJual;

    // Update Tampilan Preview secara Real-time
    document.getElementById('preview_harga_normal').textContent = 'Rp ' + hargaCoret.toLocaleString('id-ID');
    document.getElementById('preview_diskon').innerHTML =
        `<span class="badge bg-danger">-${diskonPersen}%</span> (Hemat Rp ${diskonRupiah.toLocaleString('id-ID')})`;
    document.getElementById('preview_harga_flash').textContent = 'Rp ' + hargaJual.toLocaleString('id-ID');

    previewBox.style.display = 'block';
}

function loadFlashSaleToForm(idProduk) {
    // 1. Set nilai dropdown ke ID produk yang diklik
    produkSelect.value = idProduk;

    // 2. Picu event 'change' secara manual
    // Ini penting agar logic "hitungPreview" yang sudah ada otomatis jalan
    const event = new Event('change');
    produkSelect.dispatchEvent(event);

    // 3. Scroll ke atas (ke area form/preview) agar user sadar data sudah berubah
    // Menggunakan smooth scroll agar elegan
    document.querySelector('.modal-body').scrollTo({
        top: 0,
        behavior: 'smooth'
    });

    // 4. Fokus ke input diskon agar siap diedit
    setTimeout(() => {
        diskonInput.focus();
        // Efek visual (kedip) pada card preview agar user melihat ke sana
        const previewCard = document.getElementById('preview_harga');
        previewCard.style.transition = "transform 0.2s";
        previewCard.style.transform = "scale(1.02)";
        setTimeout(() => {
            previewCard.style.transform = "scale(1)";
        }, 200);
    }, 500); // Delay sedikit menunggu scroll selesai
}

// JONO: Pastikan event listener 'input' sudah terpasang agar jalan saat ngetik
diskonInput.addEventListener('input', hitungPreview);
</script>

<?= $this->endSection() ?>