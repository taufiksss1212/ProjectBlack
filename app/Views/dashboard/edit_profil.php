<?= $this->extend('dashboard/layout') ?>

<?= $this->section('content') ?>

<div class="profile-page-wrapper">
    <div class="page-header-profil">
        <h2 class="title-profil">Account Settings</h2>
        <p class="subtitle-profil">Kelola informasi personal dan keamanan akun Anda untuk Tamara Textile.</p>
    </div>

    <?php if (session()->getFlashdata('success')) : ?>
    <div class="alert-custom success animate__animated animate__fadeIn">
        <i class="fas fa-check-circle me-2"></i> <?= session()->getFlashdata('success') ?>
    </div>
    <?php endif; ?>

    <div class="profile-card-container">
        <form action="<?= base_url('admin/profil/update') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="profile-grid">
                <div class="profile-sidebar-card">
                    <div class="avatar-upload-wrapper">
                        <img id="preview-foto"
                            src="<?= base_url('uploads/profiles/' . ($user['foto_profil'] ?: 'default_admin.jpg')) ?>"
                            class="profile-img-large">

                        <label for="foto_profil" class="camera-icon-btn">
                            <i class="fas fa-camera"></i>
                        </label>
                    </div>
                    <input type="file" name="foto_profil" id="foto_profil" class="d-none" accept="image/*"
                        onchange="previewImage(this)">

                    <h4 class="admin-name"><?= $user['nama_lengkap'] ?></h4>
                    <span class="role-badge"><?= strtoupper($user['role']) ?></span>

                    <div class="member-since">
                        <small>Member Since</small>
                        <p><?= date('d F Y', strtotime($user['created_at'] ?? 'now')) ?></p>
                    </div>
                </div>

                <div class="profile-form-content">
                    <div class="form-section">
                        <h5><i class="fas fa-id-card me-2"></i> Informasi Personal</h5>
                        <div class="row-input">
                            <div class="input-box">
                                <label>NAMA LENGKAP</label>
                                <input type="text" name="nama_lengkap" class="input-field"
                                    value="<?= $user['nama_lengkap'] ?>" required>
                            </div>
                            <div class="input-box">
                                <label>USERNAME</label>
                                <input type="text" name="username" class="input-field" value="<?= $user['username'] ?>"
                                    required>
                            </div>
                        </div>
                        <div class="input-box">
                            <label>ALAMAT EMAIL</label>
                            <input type="email" name="email" class="input-field" value="<?= $user['email'] ?>" required>
                        </div>
                        <div class="input-box">
                            <label>BIO SINGKAT</label>
                            <textarea name="bio" class="input-field" rows="3"><?= $user['bio'] ?></textarea>
                        </div>
                    </div>

                    <div class="form-section mt-4">
                        <h5><i class="fas fa-shield-alt me-2"></i> Keamanan Akun</h5>
                        <div class="input-box">
                            <label>PASSWORD BARU</label>
                            <div class="password-wrapper">
                                <input type="password" name="password" id="password" class="input-field"
                                    placeholder="Kosongkan jika tidak diganti">
                                <i class="fas fa-eye eye-toggle" onclick="togglePassword()"></i>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-save-profil">SIMPAN PERUBAHAN</button>
                        <a href="<?= base_url('admin') ?>" class="btn-cancel-profil">Batal</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
/* JONO: CSS KHUSUS AGAR TIDAK NABRAK BACKGROUND PUTIH LAYOUT */
.profile-page-wrapper {
    position: relative;
    padding: 20px;
    background: #1a1a1a !important;
    /* Paksa background gelap */
    min-height: 100vh;
    border-radius: 20px;
    z-index: 10;
}

/* Header Profil */
.page-header-profil {
    margin-bottom: 30px;
}

.title-profil {
    color: #ffffff !important;
    font-weight: 700;
    margin-bottom: 5px;
}

.subtitle-profil {
    color: #999 !important;
    font-size: 14px;
}

/* Container Utama */
.profile-card-container {
    background: rgba(40, 40, 40, 0.95) !important;
    border-radius: 15px;
    border: 1px solid #d4a574;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
}

.profile-grid {
    display: flex;
    flex-wrap: wrap;
}

/* Sidebar Profil */
.profile-sidebar-card {
    flex: 1;
    min-width: 300px;
    padding: 40px;
    text-align: center;
    background: rgba(0, 0, 0, 0.2);
    border-right: 1px solid rgba(212, 165, 116, 0.2);
}

.avatar-upload-wrapper {
    position: relative;
    display: inline-block;
    margin-bottom: 20px;
}

.profile-img-large {
    width: 180px;
    height: 180px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid #d4a574;
    background: #222;
}

.camera-icon-btn {
    position: absolute;
    bottom: 5px;
    right: 5px;
    background: #d4a574;
    color: #1a1a1a;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    border: 3px solid #1a1a1a;
}

.admin-name {
    color: #fff !important;
    margin-top: 15px;
}

.role-badge {
    color: #d4a574;
    border: 1px solid #d4a574;
    padding: 2px 15px;
    border-radius: 20px;
    font-size: 12px;
}

.member-since {
    margin-top: 30px;
    color: #666;
}

.member-since p {
    color: #fff;
    font-size: 14px;
}

/* Konten Form */
.profile-form-content {
    flex: 2;
    min-width: 400px;
    padding: 40px;
}

.form-section h5 {
    color: #d4a574 !important;
    margin-bottom: 20px;
    font-weight: 600;
}

.row-input {
    display: flex;
    gap: 20px;
    margin-bottom: 20px;
}

.input-box {
    flex: 1;
    margin-bottom: 20px;
}

.input-box label {
    display: block;
    color: #999;
    font-size: 11px;
    font-weight: 700;
    margin-bottom: 8px;
}

.input-field {
    width: 100%;
    background: rgba(255, 255, 255, 0.05) !important;
    border: 1px solid rgba(255, 255, 255, 0.1) !important;
    padding: 12px;
    border-radius: 8px;
    color: #fff !important;
    outline: none;
}

.input-field:focus {
    border-color: #d4a574 !important;
    background: rgba(255, 255, 255, 0.1) !important;
}

.password-wrapper {
    position: relative;
}

.eye-toggle {
    position: absolute;
    right: 15px;
    top: 15px;
    color: #666;
    cursor: pointer;
}

/* Buttons */
.form-actions {
    display: flex;
    gap: 15px;
    margin-top: 30px;
}

.btn-save-profil {
    background: #d4a574;
    color: #1a1a1a;
    border: none;
    padding: 12px 30px;
    border-radius: 8px;
    font-weight: 700;
    cursor: pointer;
    flex: 1;
}

.btn-cancel-profil {
    text-decoration: none;
    color: #999;
    padding: 12px 20px;
    border: 1px solid #333;
    border-radius: 8px;
}

.alert-custom {
    padding: 15px;
    border-radius: 10px;
    margin-bottom: 20px;
    background: rgba(46, 204, 113, 0.2);
    color: #2ecc71;
    border: 1px solid #2ecc71;
}
</style>

<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview-foto').src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function togglePassword() {
    const passInput = document.getElementById('password');
    passInput.type = passInput.type === 'password' ? 'text' : 'password';
}
</script>

<?= $this->endSection() ?>