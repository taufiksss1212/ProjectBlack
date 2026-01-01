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
        :root {
            --lux-gold: #c5a059;
            --lux-dark: #0a0a0a;
            --lux-gray: #1a1a1a;
            --sidebar-width: 260px;
            /* Variabel lebar sidebar */
            --font-main: 'Inter', sans-serif;
            --font-serif: 'Playfair Display', serif;
        }

        body {
            font-family: var(--font-main);
            background: var(--lux-dark);
            color: #e0e0e0;
            overflow-x: hidden;
            /* Mencegah scroll horizontal */
        }

        .container {
            max-width: 100% !important;
            width: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
            display: flex;
            /* Menggunakan Flexbox */
        }

        /* === PERBAIKAN SIDEBAR MELAYANG === */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            /* Tinggi penuh layar */
            position: fixed;
            /* Kunci posisi agar melayang */
            top: 0;
            left: 0;
            background: var(--lux-dark) !important;
            border-right: 1px solid rgba(255, 255, 255, 0.05);
            z-index: 1000;
            overflow-y: auto;
            /* Scroll jika menu terlalu panjang */
            display: flex;
            flex-direction: column;
        }

        /* Logo Area */
        .logo {
            font-family: var(--font-serif);
            font-style: italic;
            letter-spacing: 3px;
            color: var(--lux-gold) !important;
            border-bottom: 1px solid rgba(197, 160, 89, 0.2);
            padding: 25px 20px;
            font-size: 1.2rem;
        }

        /* Profil di Sidebar */
        .user-profile-sidebar {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 15px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 12px;
            margin: 20px;
            /* Margin di dalam sidebar */
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .user-avatar-sidebar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            border: 2px solid #d4a574;
            object-fit: cover;
            flex-shrink: 0;
        }

        .user-info-sidebar h4 {
            color: white;
            font-size: 14px;
            margin: 0;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 130px;
        }

        .user-info-sidebar p {
            color: #d4a574;
            font-size: 11px;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Menu Navigasi */
        .menu {
            padding: 0 10px;
        }

        .menu-item {
            font-weight: 400;
            letter-spacing: 0.5px;
            color: #888 !important;
            padding: 12px 20px !important;
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            transition: 0.3s;
            border-radius: 8px;
            margin-bottom: 5px;
        }

        .menu-item i {
            width: 20px;
            text-align: center;
        }

        .menu-item:hover {
            background: rgba(255, 255, 255, 0.03);
            color: #fff !important;
        }

        .menu-item.active {
            background: rgba(197, 160, 89, 0.1) !important;
            color: var(--lux-gold) !important;
            border-left: 3px solid var(--lux-gold);
            border-radius: 0 10px 10px 0 !important;
        }

        /* === PENGATURAN KONTEN UTAMA === */
        .main-content {
            margin-left: var(--sidebar-width);
            /* Geser konten ke kanan sebesar lebar sidebar */
            width: calc(100% - var(--sidebar-width)) !important;
            min-height: 100vh;
            position: relative;
        }

        .content-wrapper {
            width: 100% !important;
            max-width: 100% !important;
            /* Padding dipindahkan ke file dashboard.php/view masing-masing atau disini global */
        }

        /* Scrollbar Cantik untuk Sidebar */
        .sidebar::-webkit-scrollbar {
            width: 5px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: var(--lux-dark);
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: #333;
            border-radius: 10px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: var(--lux-gold);
        }
    </style>
</head>

<body>
    <aside class="sidebar">
        <div class="logo">
            <i class="fas fa-gem me-2"></i> TAMARA
        </div>

        <div class="user-profile-sidebar">
            <img src="<?= base_url('uploads/profiles/' . session()->get('foto_profil')) ?>" class="user-avatar-sidebar">
            <div class="user-info-sidebar">
                <h4><?= session()->get('nama_lengkap') ?></h4>
                <p><?= session()->get('role') ?></p>
            </div>
        </div>

        <nav class="menu">
            <a href="<?= base_url('admin') ?>" class="menu-item <?= url_is('admin') ? 'active' : '' ?>">
                <i class="fas fa-th-large"></i> Dashboard
            </a>

            <a href="<?= base_url('admin/produk') ?>" class="menu-item <?= url_is('admin/produk*') ? 'active' : '' ?>">
                <i class="fas fa-box"></i> Manajemen Produk
            </a>

            <a href="<?= base_url('admin/kategori') ?>"
                class="menu-item <?= url_is('admin/kategori*') ? 'active' : '' ?>">
                <i class="fas fa-layer-group"></i> Manajemen Kategori
            </a>

            <a href="<?= base_url('admin/profil') ?>" class="menu-item <?= url_is('admin/profil*') ? 'active' : '' ?>">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>