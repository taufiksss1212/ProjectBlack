<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Dashboard - Tamara Textile' ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('css/dashboard.css') ?>">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,700;1,700&display=swap"
        rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
    .container {
        max-width: 100% !important;
        width: 100% !important;
        padding: 0 !important;
        margin: 0 !important;
    }

    .main-content {
        width: 100% !important;
        max-width: 100% !important;
    }

    .content-wrapper {
        width: 100% !important;
        max-width: 100% !important;
    }

    /* JONO: Styling Profil Sidebar agar Mewah */
    .user-profile-sidebar {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 15px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 12px;
        margin: 20px 0;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .user-avatar-sidebar {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        border: 2px solid #d4a574;
        object-fit: cover;
    }

    .user-info-sidebar h4 {
        color: white;
        font-size: 14px;
        margin: 0;
        font-weight: 600;
    }

    .user-info-sidebar p {
        color: #d4a574;
        font-size: 11px;
        margin: 0;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    :root {
        --lux-gold: #c5a059;
        /* Emas yang lebih redup/mahal */
        --lux-dark: #0a0a0a;
        /* Hitam pekat */
        --lux-gray: #1a1a1a;
        --font-main: 'Inter', sans-serif;
        --font-serif: 'Playfair Display', serif;
    }

    body {
        font-family: var(--font-body);
        /* */
        background: var(--lux-dark);
        color: #e0e0e0;
    }

    /* Sidebar Luxury Style */
    .sidebar {
        background: var(--lux-dark) !important;
        border-right: 1px solid rgba(255, 255, 255, 0.05);
    }

    .logo {
        font-family: var(--font-serif);
        font-style: italic;
        letter-spacing: 3px;
        color: var(--lux-gold) !important;
        border-bottom: 1px solid rgba(197, 160, 89, 0.2);
        padding-bottom: 20px;
    }

    .menu-item {
        font-weight: 400;
        letter-spacing: 0.5px;
        color: #888 !important;
        padding: 12px 20px !important;
    }

    .menu-item.active {
        background: rgba(197, 160, 89, 0.1) !important;
        color: var(--lux-gold) !important;
        border-left: 3px solid var(--lux-gold);
        border-radius: 0 10px 10px 0 !important;
    }

    /* Lucide Icon Sizing */
    .lucide {
        width: 18px;
        height: 18px;
        stroke-width: 1.5px;
        /* Tipis & Elegan */
    }
    </style>
</head>

<body>
    <div class="container">
        <aside class="sidebar">
            <div class="logo">
                <i class="fas fa-gem"></i> TAMARA
            </div>

            <div class="user-profile-sidebar">
                <img src="<?= base_url('uploads/profiles/' . session()->get('foto_profil')) ?>"
                    class="user-avatar-sidebar">
                <div class="user-info-sidebar">
                    <h4><?= session()->get('nama_lengkap') ?></h4>
                    <p><?= session()->get('role') ?> - Online</p>
                </div>
            </div>

            <nav class="menu">
                <a href="<?= base_url('admin') ?>" class="menu-item <?= url_is('admin') ? 'active' : '' ?>">
                    <i class="fas fa-th-large"></i> Dashboard
                </a>

                <a href="<?= base_url('admin/produk') ?>"
                    class="menu-item <?= url_is('admin/produk*') ? 'active' : '' ?>">
                    <i class="fas fa-box"></i> Manajemen Produk
                </a>

                <a href="<?= base_url('admin/kategori') ?>"
                    class="menu-item <?= url_is('admin/kategori*') ? 'active' : '' ?>">
                    <i class="fas fa-layer-group"></i> Manajemen Kategori
                </a>

                <a href="<?= base_url('admin/profil') ?>"
                    class="menu-item <?= url_is('admin/profil*') ? 'active' : '' ?>">
                    <i class="fas fa-user-cog"></i> Pengaturan Profil
                </a>

                <a href="<?= base_url('logout') ?>" class="menu-item text-danger mt-5">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </nav>
        </aside>

        <main class="main-content">
            <div class="content-wrapper">
                <?= $this->renderSection('content') ?>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>