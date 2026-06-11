<?= $this->extend('layout/template'); ?>

<?= $this->section('styles'); ?>
<style>
.auth-section {
    min-height: 80vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #f9ffff;
    padding: 50px 0;
}

.auth-card {
    background: #ffffff;
    border-radius: 20px;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.05);
    border: 1px solid rgba(212, 175, 55, 0.1);
    overflow: hidden;
    width: 100%;
    max-width: 480px;
}

.auth-header {
    background: #0f2027;
    color: white;
    padding: 35px 30px;
    text-align: center;
    border-bottom: 3px solid var(--gold);
}

.auth-header h3 {
    font-family: "Playfair Display", serif;
    font-weight: 700;
}

.auth-body {
    padding: 35px 35px;
}

.btn-auth {
    background: var(--gold);
    color: #ffffff;
    border: none;
    border-radius: 50px;
    padding: 12px;
    font-weight: 600;
    width: 100%;
    transition: all 0.3s ease;
}

.btn-auth:hover {
    background: #bfa030;
    color: #ffffff;
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(212, 175, 55, 0.3);
}
</style>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="auth-section">
    <div class="auth-card" data-aos="fade-up">
        <div class="auth-header">
            <h3 class="mb-1">Daftar Akun</h3>
            <p class="mb-0 text-white-50 small">Lengkapi formulir untuk membuat akun baru pelanggan</p>
        </div>
        <div class="auth-body">
            <?php if (session()->getFlashdata('errors')) : ?>
            <div class="alert alert-danger p-3 mb-3 small" style="border-radius: 10px;">
                <ul class="mb-0 ps-3">
                    <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                    <li><?= $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>

            <form action="<?= site_url('customer/proses_register'); ?>" method="POST">
                <?= csrf_field(); ?>
                <div class="mb-3">
                    <label class="form-label small fw-bold text-secondary">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="form-control p-3" placeholder="Contoh: Budi Santoso"
                        value="<?= old('nama_lengkap'); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-bold text-secondary">Username</label>
                    <input type="text" name="username" class="form-control p-3" placeholder="Contoh: budisnt"
                        value="<?= old('username'); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-bold text-secondary">Alamat Email</label>
                    <input type="email" name="email" class="form-control p-3" placeholder="Contoh: budi@gmail.com"
                        value="<?= old('email'); ?>" required>
                </div>
                <div class="mb-4">
                    <label class="form-label small fw-bold text-secondary">Password</label>
                    <input type="password" name="password" class="form-control p-3" placeholder="Minimal 6 karakter"
                        required>
                </div>
                <button type="submit" class="btn btn-auth mb-3">DAFTAR AKUN</button>
            </form>

            <div class="text-center mt-4">
                <span class="text-muted small">Sudah memiliki akun?</span>
                <a href="<?= site_url('customer/login'); ?>"
                    class="text-gold small fw-bold text-decoration-none ms-1">Masuk Di Sini</a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>