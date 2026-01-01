<?= $this->extend('dashboard/layout') ?>

<?= $this->section('content') ?>
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
<div class="search-card">
    <form action="<?= base_url('admin/produk') ?>" method="get" id="searchForm">
        <div class="search-group">
            <input type="text" name="search" id="searchInput" class="search-input"
                placeholder="Cari kain, warna, atau jenis..." value="<?= esc($keyword ?? '') ?>" autocomplete="off">
            <button type="submit" class="search-btn">
                <i class="fas fa-search"></i>
            </button>
            <?php if(!empty($keyword)): ?>
            <a href="<?= base_url('admin/produk') ?>" class="btn btn-sm btn-outline-secondary ms-2">
                <i class="fas fa-times"></i> Reset
            </a>
            <?php endif; ?>
        </div>
    </form>
    <?php if(!empty($keyword)): ?>
    <div class="mt-2">
        <small class="text-muted">
            <i class="fas fa-info-circle"></i>
            Menampilkan hasil pencarian untuk: <strong>"<?= esc($keyword) ?>"</strong>
            (<?= count($produk) ?> produk ditemukan)
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
                <?php if(empty($produk)): ?>
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
        <div class="modal-content" style="background: white; color: #333;">
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
                                <?php foreach($jenis_kain as $j) : ?>
                                <option value="<?= $j['id'] ?>"><?= $j['nama_bahan'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Varian Warna <span class="text-danger">*</span></label>
                            <select name="id_varian_warna" class="form-select" required>
                                <option value="">Pilih Warna</option>
                                <?php foreach($warna as $w) : ?>
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background: white; color: #333;">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditLabel">
                    <i class="fas fa-edit"></i> Edit Produk
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('admin/produk/update') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="edit_id">
                <input type="hidden" name="gambar_lama" id="edit_gambar_lama">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-3 text-center">
                            <img id="edit_preview" src="" alt="Current Image" class="img-thumbnail"
                                style="max-height: 150px;">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Produk <span class="text-danger">*</span></label>
                            <input type="text" name="nama_produk" id="edit_nama_produk" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jenis Bahan <span class="text-danger">*</span></label>
                            <select name="id_jenis_kain" id="edit_id_jenis_kain" class="form-select" required>
                                <?php foreach($jenis_kain as $j) : ?>
                                <option value="<?= $j['id'] ?>"><?= $j['nama_bahan'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Varian Warna <span class="text-danger">*</span></label>
                            <select name="id_varian_warna" id="edit_id_varian_warna" class="form-select" required>
                                <?php foreach($warna as $w) : ?>
                                <option value="<?= $w['id'] ?>"><?= $w['nama_varian'] ?> (<?= $w['nama_kelompok'] ?>)
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Harga Jual (Rp) <span class="text-danger">*</span></label>
                            <input type="number" name="harga" id="edit_harga" class="form-control" required min="0">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Stok <span class="text-danger">*</span></label>
                            <input type="number" name="stok" id="edit_stok" class="form-control" required min="0"
                                step="0.1">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Satuan Jual <span class="text-danger">*</span></label>
                            <select name="satuan_jual" id="edit_satuan_jual" class="form-select" required>
                                <option value="meter">Meter</option>
                                <option value="yard">Yard</option>
                                <option value="roll">Roll</option>
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Ganti Foto Produk (Opsional, Max 2MB)</label>
                            <input type="file" name="gambar_produk" class="form-control" accept="image/*">
                            <small class="text-muted">Kosongkan jika tidak ingin mengganti foto</small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Produk
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
        <div class="modal-content" style="background: white; color: #333;">
            <div class="modal-header"
                style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                <h5 class="modal-title" id="modalFlashSaleLabel">
                    <i class="fas fa-bolt"></i> Kelola Flash Sale
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Info Box -->
                <div class="alert alert-info mb-4">
                    <i class="fas fa-info-circle"></i>
                    <strong>Tips:</strong> Aktifkan flash sale untuk produk pilihan. Harga coret akan otomatis dihitung
                    berdasarkan persentase diskon yang Anda tentukan.
                </div>

                <!-- Flash Sale Form -->
                <div class="row mb-4">
                    <div class="col-md-12">
                        <form id="formFlashSale">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">
                                        <i class="fas fa-box"></i> Pilih Produk
                                    </label>
                                    <select id="produk_flash_sale" class="form-select">
                                        <option value="">-- Pilih Produk --</option>
                                        <?php foreach ($produk as $p) : ?>
                                        <option value="<?= $p['id'] ?>" data-nama="<?= esc($p['nama_produk']) ?>"
                                            data-harga="<?= $p['harga'] ?>" data-is-flash="<?= $p['is_flash_sale'] ?>"
                                            data-harga-coret="<?= $p['harga_coret'] ?>">
                                            <?= $p['nama_produk'] ?> - Rp <?= number_format($p['harga'], 0, ',', '.') ?>
                                            <?php if($p['is_flash_sale']): ?>
                                            <span style="color: red;">⚡ (Aktif)</span>
                                            <?php endif; ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label fw-bold">
                                        <i class="fas fa-percentage"></i> Diskon (%)
                                    </label>
                                    <input type="number" id="diskon_persen" class="form-control"
                                        placeholder="contoh: 25" min="1" max="90" value="25">
                                    <small class="text-muted">Max 90%</small>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label fw-bold">Status</label>
                                    <div class="form-check form-switch" style="padding-top: 8px;">
                                        <input class="form-check-input" type="checkbox" id="status_flash_sale"
                                            style="width: 50px; height: 25px; cursor: pointer;">
                                        <label class="form-check-label ms-2" for="status_flash_sale" id="label_status">
                                            <span class="badge bg-secondary">Nonaktif</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Preview Harga -->
                            <div id="preview_harga" class="card border-warning mb-3" style="display: none;">
                                <div class="card-body">
                                    <h6 class="card-title text-warning">
                                        <i class="fas fa-calculator"></i> Preview Harga
                                    </h6>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <small class="text-muted">Harga Normal:</small>
                                            <h5 id="preview_harga_normal" class="text-muted">Rp 0</h5>
                                        </div>
                                        <div class="col-md-4">
                                            <small class="text-muted">Diskon:</small>
                                            <h5 id="preview_diskon" class="text-danger">- Rp 0</h5>
                                        </div>
                                        <div class="col-md-4">
                                            <small class="text-muted">Harga Flash Sale:</small>
                                            <h5 id="preview_harga_flash" class="text-success">Rp 0</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="button" class="btn btn-primary btn-lg" onclick="simpanFlashSale()">
                                    <i class="fas fa-save"></i> Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <hr>

                <!-- Tabel Produk Flash Sale Aktif -->
                <h6 class="mb-3">
                    <i class="fas fa-fire"></i> Produk Flash Sale Aktif
                </h6>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>Produk</th>
                                <th>Harga Normal</th>
                                <th>Diskon</th>
                                <th>Harga Flash Sale</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="list_flash_sale_aktif">
                            <?php 
$ada_flash = false;
foreach ($produk as $p) : 
    if($p['is_flash_sale'] == 1):
        $ada_flash = true;
        
        // JONO: Tambahkan pengaman agar tidak error DivisionByZero
        $diskon_rp = 0;
        $diskon_persen = 0;
        
        if ($p['harga_coret'] > 0) {
            $diskon_rp = $p['harga_coret'] - $p['harga'];
            $diskon_persen = round(($diskon_rp / $p['harga_coret']) * 100);
        }
?>
                            <tr>
                                <td>
                                    <strong><?= $p['nama_produk'] ?></strong><br>
                                    <small class="text-muted"><?= $p['nama_bahan'] ?> - <?= $p['nama_varian'] ?></small>
                                </td>
                                <td>
                                    <del class="text-muted">Rp
                                        <?= number_format($p['harga_coret'], 0, ',', '.') ?></del>
                                </td>
                                <td>
                                    <span class="badge bg-danger"><?= $diskon_persen ?>%</span>
                                </td>
                                <td>
                                    <strong class="text-success">Rp
                                        <?= number_format($p['harga'], 0, ',', '.') ?></strong>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-danger"
                                        onclick="nonaktifkanFlashSale(<?= $p['id'] ?>, '<?= esc($p['nama_produk']) ?>')">
                                        <i class="fas fa-times"></i> Nonaktifkan
                                    </button>
                                </td>
                            </tr>
                            <?php 
                                endif;
                            endforeach; 
                            
                            if(!$ada_flash):
                            ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    <i class="fas fa-inbox fa-2x mb-2"></i><br>
                                    Belum ada produk flash sale aktif
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

<!-- ===================== JAVASCRIPT ===================== -->
<script>
// ==================== FLASH SALE FUNCTIONALITY ====================
const produkSelect = document.getElementById('produk_flash_sale');
const diskonInput = document.getElementById('diskon_persen');
const statusToggle = document.getElementById('status_flash_sale');
const labelStatus = document.getElementById('label_status');
const previewBox = document.getElementById('preview_harga');

let selectedProduk = null;

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
<?php if(!empty($keyword)): ?>
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

// JONO: Pastikan event listener 'input' sudah terpasang agar jalan saat ngetik
diskonInput.addEventListener('input', hitungPreview);
</script>

<?= $this->endSection() ?>