<?= $this->extend('dashboard/layout') ?>

<?= $this->section('content') ?>

<style>
    /* === Custom Style untuk Halaman Kategori === */

    /* 1. Header & Search */
    .page-header-clean {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        flex-wrap: wrap;
        gap: 20px;
    }

    .search-box {
        position: relative;
        min-width: 300px;
    }

    .search-input {
        border: 1px solid #e0e0e0;
        border-radius: 50px;
        padding: 10px 20px 10px 45px;
        width: 100%;
        outline: none;
        transition: 0.3s;
        background: white;
    }

    .search-input:focus {
        border-color: var(--lux-gold);
        box-shadow: 0 0 0 3px rgba(197, 160, 89, 0.1);
    }

    .search-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #999;
    }

    /* 2. Custom Tabs Modern */
    .nav-tabs-custom {
        background: white;
        padding: 10px;
        border-radius: 12px;
        display: inline-flex;
        border: 1px solid rgba(0, 0, 0, 0.03);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
        margin-bottom: 25px;
    }

    .nav-tabs-custom .nav-link {
        border: none;
        color: #6c757d;
        font-weight: 500;
        border-radius: 8px;
        padding: 10px 25px;
        transition: 0.3s;
    }

    .nav-tabs-custom .nav-link:hover {
        background: #f8f9fa;
        color: var(--lux-gold);
    }

    .nav-tabs-custom .nav-link.active {
        background: var(--lux-gold);
        color: white !important;
        box-shadow: 0 4px 10px rgba(197, 160, 89, 0.3);
    }

    /* 3. Card & Table Style */
    .card-clean {
        background: white;
        border-radius: 16px;
        border: 1px solid rgba(0, 0, 0, 0.02);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
        overflow: hidden;
    }

    .table-modern thead th {
        background: #f8f9fa;
        color: #6c757d;
        font-weight: 600;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 15px 25px;
        border: none;
    }

    .table-modern tbody td {
        padding: 20px 25px;
        vertical-align: middle;
        border-bottom: 1px solid #f8f9fa;
        color: #333;
    }

    .table-modern tbody tr:last-child td {
        border-bottom: none;
    }

    .table-modern tbody tr:hover {
        background: #fafafa;
    }

    /* Action Buttons */
    .btn-action {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: none;
        transition: 0.2s;
        margin-right: 5px;
    }

    .btn-edit {
        background: #e0f2fe;
        color: #0284c7;
    }

    .btn-edit:hover {
        background: #0284c7;
        color: white;
    }

    .btn-delete {
        background: #fee2e2;
        color: #dc2626;
    }

    .btn-delete:hover {
        background: #dc2626;
        color: white;
    }

    .swatch-img {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        border: 3px solid #f3f5f9;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        object-fit: cover;
    }
</style>

<div class="page-header-clean">
    <div>
        <h2 style="font-family: var(--font-serif); color: #1a1a1a; margin-bottom: 5px;">Manajemen Kategori</h2>
        <p class="text-muted mb-0">Kelola master data jenis bahan dan variasi warna produk.</p>
    </div>

    <div class="search-box">
        <form action="" method="get">
            <i class="fas fa-search search-icon"></i>
            <input type="text" name="search" class="search-input" placeholder="Cari bahan atau warna..."
                value="<?= esc($keyword ?? '') ?>">
        </form>
    </div>
</div>

<ul class="nav nav-tabs-custom" id="pills-tab" role="tablist">
    <li class="nav-item">
        <button class="nav-link active me-2" id="tab-jenis" data-bs-toggle="pill" data-bs-target="#content-jenis">
            <i class="fas fa-layer-group me-2"></i>Jenis Kain
        </button>
    </li>
    <li class="nav-item">
        <button class="nav-link" id="tab-warna" data-bs-toggle="pill" data-bs-target="#content-warna">
            <i class="fas fa-palette me-2"></i>Varian Warna
        </button>
    </li>
</ul>

<div class="tab-content">

    <div class="tab-pane fade show active" id="content-jenis">
        <div class="card-clean">
            <div class="d-flex justify-content-between align-items-center p-4 border-bottom">
                <h5 class="mb-0 fw-bold text-dark" style="font-family: var(--font-serif); color: #000;">
                    Daftar Material Kain
                </h5>

                <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#modalTambahJenis"
                    style="background: var(--lux-gray);">
                    <i class="fas fa-plus me-2" style="color: var(--lux-gold);"></i> Tambah Bahan
                </button>
            </div>

            <div class="table-responsive">
                <table class="table table-modern mb-0">
                    <thead>
                        <tr>
                            <th>Nama Bahan</th>
                            <th>Deskripsi</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($jenis as $j): ?>
                            <tr>
                                <td class="fw-bold text-dark"><?= $j['nama_bahan'] ?></td>
                                <td class="text-muted small"><?= $j['deskripsi_bahan'] ?></td>
                                <td class="text-end">
                                    <button class="btn-action btn-edit"
                                        onclick="editJenis(<?= htmlspecialchars(json_encode($j)) ?>)" title="Edit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>
                                    <button class="btn-action btn-delete" onclick="hapusJenis(<?= $j['id'] ?>)"
                                        title="Hapus">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="content-warna">
        <div class="card-clean">
            <div class="d-flex justify-content-between align-items-center p-4 border-bottom">
                <h5 class="mb-0 fw-bold text-dark" style="font-family: var(--font-serif); color: #000;">
                    Katalog Warna
                </h5>

                <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#modalTambahWarna"
                    style="background: var(--lux-gray);">
                    <i class="fas fa-plus me-2" style="color: var(--lux-gold);"></i> Tambah Warna
                </button>
            </div>

            <div class="table-responsive">
                <table class="table table-modern mb-0">
                    <thead>
                        <tr>
                            <th>Swatch</th>
                            <th>Nama Warna</th>
                            <th>Kelompok</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($warna as $w): ?>
                            <tr>
                                <td>
                                    <img src="<?= base_url('uploads/swatches/' . $w['gambar_varian']) ?>"
                                        class="swatch-img">
                                </td>
                                <td>
                                    <span class="fw-bold d-block text-dark"><?= $w['nama_varian'] ?></span>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border"><?= $w['nama_kelompok'] ?></span>
                                </td>
                                <td class="text-end">
                                    <button class="btn-action btn-edit"
                                        onclick="editWarna(<?= htmlspecialchars(json_encode($w)) ?>)">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>
                                    <button class="btn-action btn-delete" onclick="hapusWarna(<?= $w['id'] ?>)">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambahJenis" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold" style="font-family: var(--font-serif);">Tambah Jenis Bahan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= base_url('admin/kategori/jenis-simpan') ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label text-muted small text-uppercase fw-bold">Nama Bahan</label>
                        <input type="text" name="nama_bahan" class="form-control" placeholder="Contoh: Satin Premium"
                            required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted small text-uppercase fw-bold">Deskripsi</label>
                        <textarea name="deskripsi_bahan" class="form-control" rows="3"
                            placeholder="Karakteristik bahan..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-dark" style="background: var(--lux-gold); border:none;">Simpan
                        Bahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEditJenis" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold">Edit Jenis Bahan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= base_url('admin/kategori/jenis-update') ?>" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="edit_jenis_id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label text-muted small text-uppercase fw-bold">Nama Bahan</label>
                        <input type="text" name="nama_bahan" id="edit_jenis_nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted small text-uppercase fw-bold">Deskripsi</label>
                        <textarea name="deskripsi_bahan" id="edit_jenis_deskripsi" class="form-control"
                            rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-dark" style="background: var(--lux-gold); border:none;">Update
                        Bahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambahWarna" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold" style="font-family: var(--font-serif);">Tambah Varian Warna</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= base_url('admin/kategori/warna-simpan') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label text-muted small text-uppercase fw-bold">Kelompok Warna</label>
                        <select name="id_kelompok_warna" class="form-select" required>
                            <?php foreach ($kelompok as $k): ?>
                                <option value="<?= $k['id'] ?>"><?= $k['nama_kelompok'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted small text-uppercase fw-bold">Nama Spesifik</label>
                        <input type="text" name="nama_varian" class="form-control" placeholder="Contoh: Midnight Blue"
                            required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted small text-uppercase fw-bold">Upload Swatch</label>
                        <input type="file" name="gambar_varian" class="form-control" accept="image/*">
                        <small class="text-muted">Disarankan format JPG/PNG rasio 1:1</small>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-dark" style="background: var(--lux-gold); border:none;">Simpan
                        Warna</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEditWarna" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold">Edit Varian Warna</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= base_url('admin/kategori/warna-update') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="edit_warna_id">
                <input type="hidden" name="gambar_lama" id="edit_warna_gambar_lama">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label text-muted small text-uppercase fw-bold">Kelompok Warna</label>
                        <select name="id_kelompok_warna" id="edit_warna_kelompok" class="form-select" required>
                            <?php foreach ($kelompok as $k): ?>
                                <option value="<?= $k['id'] ?>"><?= $k['nama_kelompok'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted small text-uppercase fw-bold">Nama Spesifik</label>
                        <input type="text" name="nama_varian" id="edit_warna_nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted small text-uppercase fw-bold">Ganti Swatch
                            (Opsional)</label>
                        <input type="file" name="gambar_varian" class="form-control" accept="image/*">
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-dark" style="background: var(--lux-gold); border:none;">Update
                        Warna</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Fungsi JS Tetap Sama, hanya styling alert yang mungkin perlu dipercantik jika mau
    function editJenis(data) {
        document.getElementById('edit_jenis_id').value = data.id;
        document.getElementById('edit_jenis_nama').value = data.nama_bahan;
        document.getElementById('edit_jenis_deskripsi').value = data.deskripsi_bahan;
        new bootstrap.Modal(document.getElementById('modalEditJenis')).show();
    }

    function editWarna(data) {
        document.getElementById('edit_warna_id').value = data.id;
        document.getElementById('edit_warna_nama').value = data.nama_varian;
        document.getElementById('edit_warna_kelompok').value = data.id_kelompok_warna;
        document.getElementById('edit_warna_gambar_lama').value = data.gambar_varian;
        new bootstrap.Modal(document.getElementById('modalEditWarna')).show();
    }

    function hapusJenis(id) {
        if (confirm('Apakah Anda yakin ingin menghapus jenis bahan ini?')) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '<?= base_url('admin/kategori/jenis-hapus') ?>';
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'id';
            input.value = id;
            form.appendChild(input);
            document.body.appendChild(form);
            form.submit();
        }
    }

    function hapusWarna(id) {
        if (confirm('Apakah Anda yakin ingin menghapus varian warna ini?')) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '<?= base_url('admin/kategori/warna-hapus') ?>';
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'id';
            input.value = id;
            form.appendChild(input);
            document.body.appendChild(form);
            form.submit();
        }
    }
</script>

<?= $this->endSection() ?>