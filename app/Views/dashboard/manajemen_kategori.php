<?= $this->extend('dashboard/layout') ?>

<?= $this->section('content') ?>
<div class="page-header">
    <div class="page-title">
        <h2>Manajemen Kategori</h2>
        <p>Kelola Jenis Bahan dan Koleksi Warna Produk.</p>
    </div>
</div>

<div class="search-card mb-4">
    <form action="" method="get">
        <div class="search-group">
            <input type="text" name="search" class="search-input" placeholder="Cari bahan atau varian warna..."
                value="<?= esc($keyword ?? '') ?>">
            <button type="submit" class="search-btn">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </form>
</div>

<ul class="nav nav-pills mb-4" id="pills-tab" role="tablist">
    <li class="nav-item">
        <button class="nav-link active me-2" id="tab-jenis" data-bs-toggle="pill" data-bs-target="#content-jenis">
            <i class="fas fa-scroll me-2"></i>Jenis Kain
        </button>
    </li>
    <li class="nav-item">
        <button class="nav-link" id="tab-warna" data-bs-toggle="pill" data-bs-target="#content-warna">
            <i class="fas fa-palette me-2"></i>Varian Warna
        </button>
    </li>
</ul>

<div class="tab-content mt-3">
    <div class="tab-pane fade show active" id="content-jenis">
        <div class="table-card">
            <div class="d-flex justify-content-between mb-3">
                <h4 class="text-white">Master Bahan</h4>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahJenis">
                    <i class="fas fa-plus"></i> Tambah Bahan
                </button>
            </div>
            <table class="product-table">
                <thead>
                    <tr>
                        <th>Nama Bahan</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($jenis as $j): ?>
                    <tr>
                        <td><strong><?= $j['nama_bahan'] ?></strong></td>
                        <td class="text-muted small"><?= $j['deskripsi_bahan'] ?></td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-icon edit"
                                    onclick="editJenis(<?= htmlspecialchars(json_encode($j)) ?>)"><i
                                        class="fas fa-edit"></i></button>
                                <button class="btn-icon delete" onclick="hapusJenis(<?= $j['id'] ?>)"><i
                                        class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="tab-pane fade" id="content-warna">
        <div class="table-card">
            <div class="d-flex justify-content-between mb-3">
                <h4 class="text-white">Koleksi Warna</h4>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahWarna">
                    <i class="fas fa-plus"></i> Tambah Warna
                </button>
            </div>
            <table class="product-table">
                <thead>
                    <tr>
                        <th>Swatch</th>
                        <th>Nama Warna</th>
                        <th>Kelompok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($warna as $w): ?>
                    <tr>
                        <td>
                            <img src="<?= base_url('uploads/swatches/' . $w['gambar_varian']) ?>"
                                style="width: 40px; height: 40px; border-radius: 50%; border: 2px solid #444; object-fit: cover;">
                        </td>
                        <td><strong><?= $w['nama_varian'] ?></strong></td>
                        <td><span class="badge bg-dark"><?= $w['nama_kelompok'] ?></span></td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-icon edit"
                                    onclick="editWarna(<?= htmlspecialchars(json_encode($w)) ?>)"><i
                                        class="fas fa-edit"></i></button>
                                <button class="btn-icon delete" onclick="hapusWarna(<?= $w['id'] ?>)"><i
                                        class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambahJenis" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content text-dark">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Tambah Jenis Bahan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= base_url('admin/kategori/jenis-simpan') ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Bahan</label>
                        <input type="text" name="nama_bahan" class="form-control" placeholder="Contoh: Satin Premium"
                            required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi_bahan" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer"><button type="submit" class="btn btn-primary w-100">Simpan Bahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEditJenis" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content text-dark">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Edit Jenis Bahan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= base_url('admin/kategori/jenis-update') ?>" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="edit_jenis_id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Bahan</label>
                        <input type="text" name="nama_bahan" id="edit_jenis_nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi_bahan" id="edit_jenis_deskripsi" class="form-control"
                            rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer"><button type="submit" class="btn btn-primary w-100">Update Bahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambahWarna" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content text-dark">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Tambah Varian Warna</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= base_url('admin/kategori/warna-simpan') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Kelompok Warna Utama</label>
                        <select name="id_kelompok_warna" class="form-select" required>
                            <?php foreach($kelompok as $k): ?>
                            <option value="<?= $k['id'] ?>"><?= $k['nama_kelompok'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Spesifik Warna</label>
                        <input type="text" name="nama_varian" class="form-control" placeholder="Contoh: Midnight Blue"
                            required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gambar Swatch (Tekstur Warna)</label>
                        <input type="file" name="gambar_varian" class="form-control" accept="image/*">
                    </div>
                </div>
                <div class="modal-footer"><button type="submit" class="btn btn-primary w-100">Simpan Warna</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEditWarna" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content text-dark">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Edit Varian Warna</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= base_url('admin/kategori/warna-update') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="edit_warna_id">
                <input type="hidden" name="gambar_lama" id="edit_warna_gambar_lama">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Kelompok Warna Utama</label>
                        <select name="id_kelompok_warna" id="edit_warna_kelompok" class="form-select" required>
                            <?php foreach($kelompok as $k): ?>
                            <option value="<?= $k['id'] ?>"><?= $k['nama_kelompok'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Spesifik Warna</label>
                        <input type="text" name="nama_varian" id="edit_warna_nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ganti Gambar Swatch</label>
                        <input type="file" name="gambar_varian" class="form-control" accept="image/*">
                    </div>
                </div>
                <div class="modal-footer"><button type="submit" class="btn btn-primary w-100">Update Warna</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// JONO: Fungsi JS untuk memunculkan modal Edit Jenis
function editJenis(data) {
    document.getElementById('edit_jenis_id').value = data.id;
    document.getElementById('edit_jenis_nama').value = data.nama_bahan;
    document.getElementById('edit_jenis_deskripsi').value = data.deskripsi_bahan;
    new bootstrap.Modal(document.getElementById('modalEditJenis')).show();
}

// JONO: Fungsi JS untuk memunculkan modal Edit Warna
function editWarna(data) {
    document.getElementById('edit_warna_id').value = data.id;
    document.getElementById('edit_warna_nama').value = data.nama_varian;
    document.getElementById('edit_warna_kelompok').value = data.id_kelompok_warna;
    document.getElementById('edit_warna_gambar_lama').value = data.gambar_varian;
    new bootstrap.Modal(document.getElementById('modalEditWarna')).show();
}

// JONO: Fungsi Hapus (Pencocokan URL)
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

<style>
/* Styling agar Tab Navigasi terlihat mewah di Dark Mode */
.nav-pills .nav-link {
    color: #aaa;
    background: #2a2a2a;
    transition: 0.3s;
}

.nav-pills .nav-link.active {
    background: #d4a574 !important;
    color: #1a1a1a !important;
    font-weight: 600;
}

.nav-pills .nav-link:hover:not(.active) {
    background: #333;
    color: #fff;
}
</style>

<?= $this->endSection() ?>