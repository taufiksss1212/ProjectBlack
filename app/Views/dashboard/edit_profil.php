<?= $this->extend('dashboard/layout') ?>

<?= $this->section('content') ?>

<style>
    /* === STYLE KHUSUS HALAMAN PROFIL (CLEAN LUXURY) === */
    :root {
        --lux-gold: #c5a059;
        --lux-gold-light: #f9f3e6;
    }

    /* 1. Kunci Halaman agar Pas Layar (No Scroll) */
    .profile-page-container {
        height: calc(100vh - 40px);
        /* Kurangi padding atas bawah */
        overflow: hidden;
        /* Hilangkan scroll bar halaman */
        display: flex;
        flex-direction: column;
    }

    .page-header-simple {
        margin-bottom: 20px;
        flex-shrink: 0;
        /* Header tidak boleh mengecil */
    }

    /* 2. Kartu Utama yang Mengisi Sisa Ruang */
    .profile-card-wrapper {
        background: white;
        border-radius: 20px;
        box-shadow: 0 5px 25px rgba(0, 0, 0, 0.03);
        border: 1px solid rgba(0, 0, 0, 0.02);
        display: flex;
        flex: 1;
        /* Ambil sisa tinggi layar */
        overflow: hidden;
        /* Agar konten dalam card bisa di-scroll sendiri jika perlu */
    }

    /* === BAGIAN KIRI: SIDEBAR PROFIL === */
    .profile-sidebar {
        width: 350px;
        background: linear-gradient(180deg, #fdfbf7 0%, #fff 100%);
        border-right: 1px solid #f0f0f0;
        padding: 40px 30px;
        text-align: center;
        display: flex;
        flex-direction: column;
        justify-content: center;
        /* Tengahkan vertikal */
        align-items: center;
    }

    .avatar-wrapper {
        position: relative;
        width: 150px;
        height: 150px;
        margin: 0 auto 20px;
    }

    .avatar-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid white;
        box-shadow: 0 8px 20px rgba(197, 160, 89, 0.2);
    }

    .camera-btn {
        position: absolute;
        bottom: 5px;
        right: 5px;
        background: var(--lux-gold);
        color: white;
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 3px solid white;
        cursor: pointer;
        transition: 0.2s;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .camera-btn:hover {
        transform: scale(1.1);
        background: #b08d4b;
    }

    .profile-name {
        font-family: var(--font-serif);
        font-size: 1.5rem;
        color: #1a1a1a;
        margin-bottom: 5px;
        font-weight: 700;
    }

    .profile-role {
        display: inline-block;
        background: var(--lux-gold-light);
        color: var(--lux-gold);
        padding: 5px 15px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 30px;
    }

    .info-stats {
        width: 100%;
        display: flex;
        justify-content: space-around;
        padding-top: 20px;
        border-top: 1px solid #eee;
    }

    .stat-item h6 {
        font-weight: 700;
        color: #333;
        margin-bottom: 0;
    }

    .stat-item span {
        font-size: 12px;
        color: #999;
        text-transform: uppercase;
    }

    .input-group {
        border-radius: 8px;
        overflow: hidden;
        /* Pastikan sudut anak elemen tidak keluar */
        border: 1px solid #eee;
        /* Border pembungkus utama */
    }

    /* Ikon di sebelah kiri */
    .input-group-text {
        background: #f8f9fa;
        /* Warna abu muda */
        border: none;
        /* Hapus border bawaan bootstrap */
        color: #888;
        padding-left: 15px;
        padding-right: 15px;
    }

    /* Input field di sebelah kanan */
    .form-control-custom {
        border: none !important;
        /* Hapus border individual */
        background: #fcfcfc;
        padding: 12px 15px;
        /* Hapus border-radius karena sudah diatur di parent .input-group */
        border-radius: 0 !important;
        width: 100%;
        transition: 0.3s;
        color: #333;
    }

    /* Efek Fokus (Glow Emas pada Pembungkus) */
    .input-group:focus-within {
        border-color: var(--lux-gold);
        box-shadow: 0 0 0 3px rgba(197, 160, 89, 0.1);
        background: white;
    }

    /* Pastikan background input ikut berubah saat fokus */
    .input-group:focus-within .form-control-custom,
    .input-group:focus-within .input-group-text {
        background: white;
    }

    /* === BAGIAN KANAN: FORM === */
    .profile-content {
        flex: 1;
        padding: 40px 50px;
        overflow-y: auto;
        /* Scroll hanya di form jika layar terlalu pendek */
    }

    .form-group-custom {
        margin-bottom: 25px;
    }

    .form-label-custom {
        font-size: 0.75rem;
        color: #888;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
        display: block;
    }

    .form-control-custom {
        border: 1px solid #eee;
        background: #fcfcfc;
        padding: 12px 15px;
        border-radius: 8px;
        width: 100%;
        transition: 0.3s;
        color: #333;
    }

    .form-control-custom:focus {
        background: white;
        border-color: var(--lux-gold);
        box-shadow: 0 0 0 3px rgba(197, 160, 89, 0.1);
        outline: none;
    }

    .btn-save-custom {
        background: var(--lux-gold);
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 8px;
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: 0.3s;
    }

    .btn-save-custom:hover {
        background: #b08d4b;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(197, 160, 89, 0.3);
    }
</style>

<div class="profile-page-container">

    <div class="page-header-simple d-flex justify-content-between align-items-center">
        <div>
            <h3 class="fw-bold text-dark mb-0" style="font-family: var(--font-serif);">Pengaturan Profil</h3>
            <p class="text-muted small mb-0">Kelola informasi pribadi akun Anda.</p>
        </div>

        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success py-2 px-3 mb-0 d-flex align-items-center small shadow-sm border-0">
                <i class="fas fa-check-circle me-2"></i> <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="profile-card-wrapper">
        <form action="<?= base_url('admin/profil/update') ?>" method="post" enctype="multipart/form-data"
            class="d-flex w-100">
            <?= csrf_field() ?>

            <div class="profile-sidebar">
                <div class="avatar-wrapper">
                    <img id="preview-foto"
                        src="<?= base_url('uploads/profiles/' . ($user['foto_profil'] ?: 'default_admin.jpg')) ?>"
                        class="avatar-img">

                    <label for="foto_profil" class="camera-btn" title="Ganti Foto">
                        <i class="fas fa-camera small"></i>
                    </label>
                    <input type="file" name="foto_profil" id="foto_profil" class="d-none" accept="image/*"
                        onchange="previewImage(this)">
                </div>

                <div class="text-center">
                    <h2 class="profile-name"><?= $user['nama_lengkap'] ?></h2>
                    <span class="profile-role"><?= strtoupper($user['role']) ?> TAMARA</span>
                </div>

                <div class="info-stats mt-4">
                    <div class="stat-item">
                        <h6><?= date('Y') ?></h6>
                        <span>Member Since</span>
                    </div>
                    <div class="stat-item">
                        <h6 class="text-success">Active</h6>
                        <span>Status Akun</span>
                    </div>
                </div>
            </div>

            <div class="profile-content">
                <div class="row">
                    <div class="col-md-6 form-group-custom">
                        <label class="form-label-custom">Username</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-at small"></i></span>
                            <input type="text" name="username" class="form-control-custom"
                                value="<?= $user['username'] ?>" required>
                        </div>
                    </div>

                    <div class="col-md-6 form-group-custom">
                        <label class="form-label-custom">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope small"></i></span>
                            <input type="email" name="email" class="form-control-custom" value="<?= $user['email'] ?>"
                                required>
                        </div>
                    </div>

                    <div class="col-12 form-group-custom">
                        <label class="form-label-custom">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control-custom"
                            value="<?= $user['nama_lengkap'] ?>" required>
                    </div>

                    <div class="col-12 form-group-custom">
                        <label class="form-label-custom">Bio Singkat</label>
                        <textarea name="bio" class="form-control-custom" rows="2"
                            placeholder="Tulis sedikit tentang Anda..."><?= $user['bio'] ?></textarea>
                    </div>

                    <div class="col-12 mt-2">
                        <hr class="text-muted opacity-25">
                        <label class="form-label-custom text-danger mt-3"><i class="fas fa-shield-alt me-1"></i> Ganti
                            Password (Opsional)</label>
                    </div>

                    <div class="col-md-12 form-group-custom">
                        <div class="position-relative">
                            <input type="password" name="password" id="password" class="form-control-custom"
                                placeholder="Kosongkan jika tidak ingin mengubah password">
                            <button type="button" class="btn position-absolute end-0 top-0 mt-1 me-1 text-muted"
                                onclick="togglePassword()">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <small class="text-muted d-block mt-1" style="font-size: 11px;">Minimal 6 karakter kombinasi
                            huruf dan angka untuk keamanan.</small>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-3 mt-4">
                    <a href="<?= base_url('admin') ?>" class="btn btn-light text-muted px-4"
                        style="font-weight: 500;">Batal</a>
                    <button type="submit" class="btn-save-custom">
                        <i class="fas fa-save me-2"></i> Simpan Perubahan
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>

<script>
    // Preview Gambar saat upload
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview-foto').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Toggle Password Visibility
    function togglePassword() {
        const passInput = document.getElementById('password');
        const icon = event.currentTarget.querySelector('i');

        if (passInput.type === 'password') {
            passInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>

<?= $this->endSection() ?>