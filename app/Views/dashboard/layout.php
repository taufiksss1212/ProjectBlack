<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Dashboard - PBD' ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('css/dashboard.css') ?>">
</head>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Dashboard - PBD' ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('css/dashboard.css') ?>">
</head>

<body>
    <div class="container">
        <aside class="sidebar">
            <div class="logo">
                <i class="fas fa-shield-alt"></i> PBD
            </div>
            <nav class="menu">
                <a href="<?= base_url('admin/dashboard') ?>" class="menu-item active">
                    <i class="fas fa-th-large"></i> Dashboard
                </a>
            </nav>
            <div class="user-profile">
                <div class="user-avatar"></div>
                <div class="user-info">
                    <h4>Elizabeth</h4>
                    <p>Active</p>
                </div>
            </div>
            <div class="theme-toggle">
                <button class="theme-btn light"><i class="fas fa-sun"></i> Light</button>
                <button class="theme-btn dark"><i class="fas fa-moon"></i> Dark</button>
            </div>
        </aside>

        <main class="main-content">
            <div class="content-wrapper">
                <?= $this->renderSection('content') ?>
            </div>
        </main>
    </div>

    <script>
    // Theme Toggle
    const lightBtn = document.querySelector('.theme-btn.light');
    const darkBtn = document.querySelector('.theme-btn.dark');
    const body = document.body;

    darkBtn.addEventListener('click', () => {
        darkBtn.style.background = '#d4a574';
        darkBtn.style.color = '#2d2d2d';
        lightBtn.style.background = '#3a3a3a';
        lightBtn.style.color = '#999';
    });

    lightBtn.addEventListener('click', () => {
        lightBtn.style.background = '#d4a574';
        lightBtn.style.color = '#2d2d2d';
        darkBtn.style.background = '#3a3a3a';
        darkBtn.style.color = '#999';
    });

    // Menu Item Active State
    const menuItems = document.querySelectorAll('.menu-item');
    menuItems.forEach(item => {
        item.addEventListener('click', (e) => {
            e.preventDefault();
            menuItems.forEach(i => i.classList.remove('active'));
            item.classList.add('active');
        });
    });
    </script>
</body>

</html>

</html>