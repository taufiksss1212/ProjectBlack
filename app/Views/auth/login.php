<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrator - Tamara Textile</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,600;0,700;1,600&display=swap"
        rel="stylesheet">

    <style>
    :root {
        --lux-gold: #c5a059;
        --lux-dark: #1a1a1a;
        --font-serif: 'Playfair Display', serif;
        --font-sans: 'Inter', sans-serif;
    }

    body,
    html {
        height: 100%;
        margin: 0;
        font-family: var(--font-sans);
        overflow-x: hidden;
        background-color: #ffffff;
    }

    .login-container {
        min-height: 100vh;
    }

    /* === BAGIAN KANAN: GAMBAR TEXTILE === */
    .image-section {
        /* Tambahkan base_url() agar path gambar benar */
        background-image: url('<?= base_url('images/login.jpg') ?>');
        background-size: cover;
        background-position: center;
        position: relative;
        min-height: 100vh;
    }

    /* Overlay Emas Gelap agar teks terbaca jika ada, dan memberi kesan mewah */
    .image-section::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background: linear-gradient(45deg, rgba(0, 0, 0, 0.7), rgba(197, 160, 89, 0.3));
    }

    .image-caption {
        position: absolute;
        bottom: 50px;
        left: 50px;
        right: 50px;
        color: white;
        z-index: 2;
    }

    /* === BAGIAN KIRI: FORM LOGIN === */
    .form-section {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px;
        background: #ffffff;
        position: relative;
    }

    .login-wrapper {
        width: 100%;
        max-width: 420px;
        animation: fadeIn 0.8s ease-out;
    }

    /* Logo Brand */
    .brand-header {
        margin-bottom: 40px;
    }

    .logo-text {
        font-family: var(--font-serif);
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--lux-dark);
        letter-spacing: -0.5px;
        margin-bottom: 5px;
    }

    .logo-sub {
        font-size: 0.9rem;
        color: #888;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    /* Custom Input Fields (Sama seperti Profil Edit) */
    .input-group-custom {
        position: relative;
        margin-bottom: 25px;
    }

    .input-group-custom i {
        position: absolute;
        left: 20px;
        top: 50%;
        transform: translateY(-50%);
        color: #999;
        transition: 0.3s;
        z-index: 5;
    }

    .form-control-lux {
        width: 100%;
        padding: 16px 20px 16px 50px;
        /* Padding kiri besar untuk icon */
        border: 1px solid #e0e0e0;
        border-radius: 12px;
        background: #fcfcfc;
        font-size: 0.95rem;
        color: #333;
        transition: all 0.3s ease;
    }

    .form-control-lux:focus {
        background: #fff;
        border-color: var(--lux-gold);
        box-shadow: 0 0 0 4px rgba(197, 160, 89, 0.1);
        outline: none;
    }

    .form-control-lux:focus+i {
        color: var(--lux-gold);
    }

    .form-label {
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        color: #666;
        margin-bottom: 8px;
        display: block;
        margin-left: 5px;
    }

    /* Button Login */
    .btn-gold {
        background: var(--lux-gold);
        color: white;
        border: none;
        width: 100%;
        padding: 16px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1rem;
        letter-spacing: 1px;
        transition: all 0.3s;
        cursor: pointer;
        box-shadow: 0 10px 20px rgba(197, 160, 89, 0.2);
        margin-top: 10px;
    }

    .btn-gold:hover {
        background: #b08d4b;
        transform: translateY(-2px);
        box-shadow: 0 15px 30px rgba(197, 160, 89, 0.3);
    }

    /* Alert styling */
    .alert-custom {
        border: none;
        background: #fee2e2;
        color: #dc2626;
        font-size: 0.9rem;
        border-radius: 10px;
        padding: 15px;
        display: flex;
        align-items: center;
        margin-bottom: 30px;
    }

    .footer-copy {
        position: absolute;
        bottom: 10px;
        /* Diubah dari 30px ke 10px agar lebih turun */
        width: 100%;
        text-align: center;
        font-size: 0.75rem;
        color: #aaa;
        left: 0;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Responsive: Gambar hilang di layar HP */
    @media (max-width: 991px) {
        .image-section {
            display: none;
        }

        .form-section {
            width: 100%;
            background: #fff;
        }
    }
    </style>
</head>

<body>

    <div class="container-fluid login-container">
        <div class="row g-0 h-100">

            <div class="col-lg-6 form-section h-100">
                <div class="login-wrapper">

                    <div class="brand-header">
                        <div class="logo-text">TAMARA.</div>
                        <div class="logo-sub">Premium Textile Management</div>
                    </div>

                    <div class="mb-5">
                        <h2 style="font-family: var(--font-serif); font-weight: 700; color: #1a1a1a;">Welcome Back</h2>
                        <p class="text-muted">Silakan masuk untuk mengelola inventaris.</p>
                    </div>

                    <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-custom">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <div><?= session()->getFlashdata('error') ?></div>
                    </div>
                    <?php endif; ?>

                    <form action="<?= base_url('auth/proses_login') ?>" method="post">
                        <?= csrf_field() ?>

                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <div class="input-group-custom">
                                <input type="text" name="username" class="form-control-lux"
                                    placeholder="Masukkan username admin" required>
                                <i class="fas fa-user"></i>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Password</label>
                            <div class="input-group-custom">
                                <input type="password" name="password" class="form-control-lux"
                                    placeholder="Masukkan password" required>
                                <i class="fas fa-lock"></i>
                            </div>
                        </div>

                        <button type="submit" class="btn-gold">
                            MASUK DASHBOARD <i class="fas fa-arrow-right ms-2"></i>
                        </button>
                    </form>

                </div>

                <div class="footer-copy">
                    &copy; <?= date('Y') ?> Tamara Textile. All rights reserved.
                </div>
            </div>

            <div class="col-lg-6 image-section h-100 d-none d-lg-block">
                <div class="image-caption">
                    <h1 class="display-4 fw-bold" style="font-family: var(--font-serif);">Elegance in Every Thread.</h1>
                    <p class="lead opacity-75">Kelola koleksi kain premium dengan sistem manajemen yang terintegrasi dan
                        efisien.</p>
                </div>
            </div>

        </div>
    </div>

</body>

</html>