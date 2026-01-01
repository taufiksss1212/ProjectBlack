<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Tamara Textile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400;600&display=swap"
        rel="stylesheet">

    <style>
    :root {
        --gold: #d4af37;
        --dark-bg: #0f2027;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(rgba(15, 32, 39, 0.8), rgba(15, 32, 39, 0.9)),
            url('https://images.unsplash.com/photo-1550614000-4b9519e00664?q=80&w=1500&auto=format&fit=crop');
        background-size: cover;
        background-position: center;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0;
    }

    .login-card {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(15px);
        border: 1px solid rgba(212, 175, 55, 0.3);
        border-radius: 20px;
        padding: 40px;
        width: 100%;
        max-width: 400px;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5);
        animation: fadeIn 1s ease-out;
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

    .brand-logo {
        font-family: 'Playfair Display', serif;
        font-size: 2.5rem;
        color: var(--gold);
        text-align: center;
        margin-bottom: 10px;
        letter-spacing: 3px;
    }

    .login-subtitle {
        color: rgba(255, 255, 255, 0.6);
        text-align: center;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 30px;
    }

    .form-label {
        color: var(--gold);
        font-size: 0.85rem;
        font-weight: 600;
    }

    .form-control {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: white;
        padding: 12px 15px;
        border-radius: 10px;
    }

    .form-control:focus {
        background: rgba(255, 255, 255, 0.15);
        border-color: var(--gold);
        color: white;
        box-shadow: 0 0 10px rgba(212, 175, 55, 0.2);
    }

    .btn-login {
        background: var(--gold);
        color: #000;
        border: none;
        padding: 12px;
        border-radius: 10px;
        font-weight: 700;
        width: 100%;
        margin-top: 20px;
        transition: 0.3s;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .btn-login:hover {
        background: #b8962d;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(212, 175, 55, 0.4);
    }

    .alert {
        background: rgba(220, 53, 69, 0.2);
        border: 1px solid rgba(220, 53, 69, 0.4);
        color: #ff8a8a;
        font-size: 0.85rem;
        border-radius: 10px;
    }
    </style>
</head>

<body>

    <div class="login-card">
        <div class="brand-logo">TAMARA.</div>
        <div class="login-subtitle">Administrative Access</div>

        <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle me-2"></i> <?= session()->getFlashdata('error') ?>
        </div>
        <?php endif; ?>

        <form action="<?= base_url('auth/proses_login') ?>" method="post">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Masukkan username admin" required>
            </div>
            <div class="mb-4">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
            </div>
            <button type="submit" class="btn-login">Masuk ke Dashboard</button>
        </form>
    </div>

</body>

</html>