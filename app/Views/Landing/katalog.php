<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<style>
    /* ... (Copy paste style CSS kamu yang tadi di sini) ... */
    /* Agar rapi, saya skip bagian CSS karena sama persis */

    .catalog-header {
        height: 60vh;
        background: linear-gradient(to bottom, rgba(15, 32, 39, 0.8), rgba(15, 32, 39, 0.9)), url('https://images.unsplash.com/photo-1558769132-cb1aea458c5e?q=80&w=2000&auto=format&fit=crop');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        position: relative;
        margin-top: -85px;
    }

    .catalog-title {
        font-family: 'Playfair Display', serif;
        font-size: 4rem;
        font-weight: 700;
        color: white;
        text-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
    }

    .filter-bar-container {
        margin-top: -50px;
        position: relative;
        z-index: 10;
        margin-bottom: 50px;
    }

    .filter-bar {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        padding: 20px 30px;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(212, 175, 55, 0.2);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
    }

    /* --- PRODUCT CARD --- */
    .catalog-card {
        background: white;
        border: none;
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.4s ease;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        height: 100%;
        position: relative;
    }

    .catalog-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(212, 175, 55, 0.15);
    }

    .catalog-img-wrapper {
        height: 350px;
        overflow: hidden;
        position: relative;
    }

    .catalog-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: 0.6s ease;
    }

    .catalog-card:hover .catalog-img {
        transform: scale(1.1);
    }

    .catalog-info {
        padding: 20px;
        text-align: center;
        background: white;
        position: relative;
    }

    .product-category {
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: #999;
        margin-bottom: 5px;
        display: block;
    }

    .product-name {
        font-family: 'Playfair Display', serif;
        font-size: 1.2rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 10px;
    }

    .btn-detail-gold {
        display: inline-block;
        width: 100%;
        padding: 12px 0;
        border: 1px solid var(--gold);
        color: var(--gold);
        background: transparent;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 2px;
        font-weight: 600;
        transition: 0.3s;
        margin-top: 10px;
        cursor: pointer;
    }

    .btn-detail-gold:hover {
        background: var(--gold);
        color: white;
    }

    /* ========================================= */
    /* --- CSS POP UP (MODAL) YANG DIPERBAIKI --- */
    /* ========================================= */

    /* 1. Container Modal yang Bersih */
    .modal-content-luxury {
        border-radius: 20px;
        border: none;
        overflow: hidden;
        /* Penting biar gambar ga keluar jalur */
        box-shadow: 0 30px 60px rgba(0, 0, 0, 0.5);
    }

    /* 2. Header Modal */
    .modal-header-luxury {
        background: #0f2027;
        /* Dark Blue Solid */
        color: white;
        border-bottom: 2px solid var(--gold);
        padding: 15px 25px;
        position: relative;
        z-index: 2;
    }

    /* 3. Layout Foto Full-Bleed (Tanpa Margin) */
    .detail-left-col {
        background: #f0f0f0;
        min-height: 500px;
        position: relative;
        overflow: hidden;
    }

    .detail-img-full {
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* Gambar memenuhi ruang tanpa gepeng */
        position: absolute;
        top: 0;
        left: 0;
    }

    /* 4. Layout Info Kanan */
    .detail-right-col {
        padding: 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        background: white;
    }

    /* Elemen-elemen Detail */
    .badge-category {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: #999;
        margin-bottom: 10px;
        display: block;
        font-weight: 600;
    }

    .detail-title-large {
        font-family: 'Playfair Display', serif;
        font-size: 2.5rem;
        font-weight: 700;
        color: #222;
        margin-bottom: 15px;
        line-height: 1.2;
    }

    .detail-price-large {
        font-size: 2rem;
        color: var(--gold);
        font-weight: 700;
        margin-bottom: 20px;
    }

    .detail-price-large span {
        font-size: 1rem;
        color: #aaa;
        font-weight: 400;
    }

    /* Grid Spesifikasi yang Lebih Rapi */
    .spec-grid-clean {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
        margin: 25px 0;
        border-top: 1px solid #eee;
        border-bottom: 1px solid #eee;
        padding: 20px 0;
    }

    .spec-box {
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }

    .spec-box i {
        color: var(--gold);
        font-size: 1.2rem;
        margin-top: 3px;
    }

    .spec-text h6 {
        font-size: 0.7rem;
        color: #aaa;
        text-transform: uppercase;
        margin-bottom: 2px;
        letter-spacing: 1px;
    }

    .spec-text p {
        font-size: 0.95rem;
        font-weight: 600;
        color: #333;
        margin: 0;
    }

    /* Tombol WA Besar */
    .btn-wa-large {
        background: #25D366;
        color: white;
        width: 100%;
        padding: 15px;
        border-radius: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        transition: 0.3s;
    }

    .btn-wa-large:hover {
        background: #128C7E;
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(37, 211, 102, 0.2);
    }

    /* Modal Filter Styles (Tetap) */
    .filter-item {
        padding: 15px 20px;
        margin-bottom: 10px;
        border: 1px solid #eee;
        border-radius: 10px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: 0.2s;
    }

    .filter-item:hover {
        border-color: var(--gold);
        background: #fffdf5;
        color: var(--gold);
    }

    .color-circle {
        width: 25px;
        height: 25px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 15px;
        border: 2px solid #fff;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    .step-view {
        display: none;
        animation: slideIn 0.3s ease;
    }

    .step-view.active {
        display: block;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateX(20px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    /* MOBILE RESPONSIVE FIXES */
    @media (max-width: 991px) {
        .catalog-title {
            font-size: 2.5rem;
        }

        .filter-bar {
            flex-direction: column;
            text-align: center;
        }

        .catalog-img-wrapper {
            height: 200px;
        }

        .btn-detail-gold {
            padding: 8px 0;
            font-size: 0.7rem;
        }

        .product-name {
            font-size: 1rem;
        }

        /* Modal di HP */
        .detail-left-col {
            min-height: 300px;
            height: 300px;
        }

        /* Gambar di atas, tinggi fix */
        .detail-right-col {
            padding: 25px;
        }

        /* Padding dikurangi biar muat */
        .detail-title-large {
            font-size: 1.8rem;
        }

        .detail-price-large {
            font-size: 1.5rem;
        }

        .spec-grid-clean {
            grid-template-columns: 1fr;
            gap: 15px;
        }

        /* Stack spesifikasi ke bawah */
    }
</style>

<header class="catalog-header">
    <div data-aos="fade-up">
        <p class="text-gold text-uppercase letter-spacing-2 mb-2">Our Masterpieces</p>
        <h1 class="catalog-title">Exclusive Collection</h1>
        <div class="divider"></div>
    </div>
</header>

<div class="container filter-bar-container">
    <div class="filter-bar">
        <div>
            <span class="text-muted text-uppercase small letter-spacing-2">Menampilkan:</span>
            <h4 class="mb-0 fw-bold playfair" id="productCountTitle">Semua Koleksi</h4>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-outline-dark rounded-pill px-4" onclick="resetFilter()">
                <i class="fas fa-sync-alt me-2"></i> Reset
            </button>
            <button class="btn btn-gold-outline rounded-pill px-4" style="background: var(--gold); color: white;"
                data-bs-toggle="modal" data-bs-target="#filterModal">
                <i class="fas fa-filter me-2"></i> Filter Warna
            </button>
        </div>
    </div>
</div>

<section class="pb-5 bg-soft" style="min-height: 600px;">
    <div class="container">
        <div class="row g-4" id="catalogGrid"></div>

        <div id="emptyState" class="text-center py-5 d-none">
            <i class="fas fa-box-open fa-4x text-gold mb-3 opacity-50"></i>
            <h3>Produk Tidak Ditemukan</h3>
            <p class="text-muted">Maaf, varian warna yang Anda cari sedang kosong.</p>
            <button class="btn btn-outline-dark mt-3" onclick="resetFilter()">Lihat Semua</button>
        </div>
    </div>
</section>

<div class="modal fade" id="filterModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-luxury">
            <div class="modal-header modal-header-luxury">
                <h5 class="modal-title text-white playfair" id="modalTitle">Pilih Warna Dasar</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 bg-light">

                <div id="step1" class="step-view active">
                    <p class="text-muted small text-uppercase mb-3 fw-bold">Step 1: Pilih Kelompok Warna</p>

                    <?php foreach ($colorGroups as $group) : ?>
                        <div class="filter-item" onclick="goToStep2('<?= $group['slug'] ?>', '<?= $group['label'] ?>')">
                            <div class="d-flex align-items-center">
                                <span class="color-circle" style="background: <?= $group['hex'] ?>;"></span>
                                <span class="fw-bold"><?= $group['label'] ?></span>
                            </div>
                            <i class="fas fa-chevron-right text-muted"></i>
                        </div>
                    <?php endforeach; ?>

                </div>

                <div id="step2" class="step-view">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <button class="btn btn-sm btn-outline-secondary rounded-pill px-3" onclick="backToStep1()">
                            <i class="fas fa-arrow-left me-1"></i> Kembali
                        </button>
                        <span class="badge bg-dark text-gold">Step 2</span>
                    </div>
                    <h5 class="fw-bold mb-3 playfair" id="subCategoryTitle">Pilih Varian</h5>
                    <div id="subCategoryList"></div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="productDetailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content modal-content-luxury">
            <div class="modal-header-luxury d-flex justify-content-between align-items-center">
                <div class="text-uppercase letter-spacing-2 small text-gold fw-bold">Detail Produk</div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <div class="modal-body p-0 bg-white">
                <div class="row g-0">
                    <div class="col-lg-6 detail-left-col">
                        <img src="" id="detailImg" class="detail-img-full" alt="Foto Produk">
                        <div id="detailBadge" class="position-absolute top-0 start-0 m-3 d-none">
                            <span class="badge bg-danger rounded-pill px-3 py-2">Flash Sale</span>
                        </div>
                    </div>

                    <div class="col-lg-6 detail-right-col">
                        <span id="detailCat" class="badge-category">Kategori</span>
                        <h2 class="detail-title-large" id="detailName">Nama Produk</h2>

                        <div class="detail-price-large">
                            <span id="detailPriceDisplay">Rp 0</span> <span>/ <span id="detailUnit">m</span></span>
                        </div>

                        <p class="text-secondary" style="line-height: 1.7;">
                            Nikmati kualitas kain premium Grade A.
                            <span id="detailDesc"></span>
                        </p>

                        <div class="spec-grid-clean">
                            <div class="spec-box">
                                <i class="fas fa-ruler-horizontal"></i>
                                <div class="spec-text">
                                    <h6>Lebar</h6>
                                    <p id="specWidth">-</p>
                                </div>
                            </div>
                            <div class="spec-box">
                                <i class="fas fa-layer-group"></i>
                                <div class="spec-text">
                                    <h6>Bahan</h6>
                                    <p id="specMaterial">-</p>
                                </div>
                            </div>
                            <div class="spec-box">
                                <i class="fas fa-feather-alt"></i>
                                <div class="spec-text">
                                    <h6>Karakteristik</h6>
                                    <p id="specChar">-</p>
                                </div>
                            </div>
                            <div class="spec-box">
                                <i class="fas fa-cube"></i>
                                <div class="spec-text">
                                    <h6>Konstruksi</h6>
                                    <p id="specConst">-</p>
                                </div>
                            </div>
                        </div>

                        <a href="#" id="waLink" target="_blank" class="btn btn-wa-large">
                            <i class="fab fa-whatsapp fa-lg"></i> Pesan via WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    /** * DATA DARI DATABASE (PHP -> JS) */
    const dbProducts = <?= json_encode($products); ?>;
    const dbFilters = <?= json_encode($subCats); ?>;
    const imageBasePath = "<?= base_url('uploads/products/') ?>";

    const formatRupiah = (number) => {
        return new Intl.NumberFormat('id-ID', {
            maximumSignificantDigits: 3
        }).format(number);
    }

    // --- (Fungsi renderGrid dan showDetail TETAP SAMA, tidak perlu diubah) ---
    // Copy paste fungsi renderGrid dan showDetail dari kode sebelumnya di sini 
    // atau biarkan jika Anda hanya mengupdate bagian bawah ini:

    function renderGrid(data) {
        const grid = document.getElementById('catalogGrid');
        const empty = document.getElementById('emptyState');
        grid.innerHTML = '';
        if (data.length === 0) {
            empty.classList.remove('d-none');
        } else {
            empty.classList.add('d-none');
            data.forEach(item => {
                let imgUrl = item.gambar_produk.includes('http') ? item.gambar_produk : imageBasePath + item
                    .gambar_produk;
                let priceHtml = `Rp ${formatRupiah(item.harga)}`;
                if (item.is_flash_sale == 1 && item.harga_coret > 0) {
                    priceHtml =
                        `<small class="text-danger text-decoration-line-through me-1 fs-6">${formatRupiah(item.harga_coret)}</small> Rp ${formatRupiah(item.harga)}`;
                }
                const cardHTML = `
                    <div class="col-6 col-lg-3" data-aos="fade-up">
                        <div class="catalog-card">
                            <div class="catalog-img-wrapper">
                                <img src="${imgUrl}" class="catalog-img" alt="${item.nama_produk}">
                                ${item.is_flash_sale == 1 ? '<span class="position-absolute top-0 end-0 m-2 badge bg-danger">PROMO</span>' : ''}
                            </div>
                            <div class="catalog-info">
                                <span class="product-category text-gold">${item.nama_bahan}</span>
                                <h5 class="product-name text-truncate">${item.nama_produk}</h5>
                                <p class="mb-0 fw-bold">${priceHtml} <small class="text-muted">/ ${item.satuan_jual}</small></p>
                                <button class="btn-detail-gold" onclick="showDetail(${item.id})">DETAIL</button>
                            </div>
                        </div>
                    </div>`;
                grid.innerHTML += cardHTML;
            });
        }
    }

    function showDetail(id) {
        const product = dbProducts.find(p => p.id == id);
        if (product) {
            let imgUrl = product.gambar_produk.includes('http') ? product.gambar_produk : imageBasePath + product
                .gambar_produk;
            document.getElementById('detailImg').src = imgUrl;
            document.getElementById('detailName').innerText = product.nama_produk;
            document.getElementById('detailPriceDisplay').innerText = 'Rp ' + formatRupiah(product.harga);
            document.getElementById('detailUnit').innerText = product.satuan_jual;
            document.getElementById('detailCat').innerText = product.nama_bahan + ' - ' + product.nama_varian;
            document.getElementById('specWidth').innerText = product.lebar_kain;
            document.getElementById('specMaterial').innerText = product.nama_bahan;
            document.getElementById('specChar').innerText = product.karakteristik || '-';
            document.getElementById('specConst').innerText = product.konstruksi_kain || '-';
            document.getElementById('detailDesc').innerText = product.deskripsi_bahan || '';
            const badge = document.getElementById('detailBadge');
            if (product.is_flash_sale == 1) badge.classList.remove('d-none');
            else badge.classList.add('d-none');
            const message =
                `Halo Tamara Textile, saya tertarik dengan produk *${product.nama_produk}*. Apakah stok tersedia?`;
            const waUrl = `https://wa.me/6281234567890?text=${encodeURIComponent(message)}`;
            document.getElementById('waLink').href = waUrl;
            var myModal = new bootstrap.Modal(document.getElementById('productDetailModal'));
            myModal.show();
        }
    }

    // --- UPDATED: BAGIAN FILTER GAMBAR ---

    function goToStep2(groupSlug, groupName) {
        document.getElementById('step1').classList.remove('active');
        document.getElementById('step2').classList.add('active');
        document.getElementById('subCategoryTitle').innerText = "Varian " + groupName;

        const listContainer = document.getElementById('subCategoryList');
        listContainer.innerHTML = '';

        const variants = dbFilters[groupSlug];

        if (variants) {
            variants.forEach(variant => {
                // LOGIKA GAMBAR:
                // Jika ada gambar_varian di DB, pakai itu. Jika tidak, pakai warna hex sebagai fallback.
                let iconHtml = '';
                if (variant.image && variant.image !== 'null') {
                    // Tampilkan Gambar Bulat
                    iconHtml =
                        `<img src="${variant.image}" class="rounded-circle shadow-sm me-3" style="width: 40px; height: 40px; object-fit: cover; border: 2px solid #fff;">`;
                } else {
                    // Fallback ke Hex Color jika gambar kosong
                    iconHtml =
                        `<span class="color-circle me-3" style="background: ${variant.color}; width:40px; height:40px;"></span>`;
                }

                listContainer.innerHTML += `
                    <div class="filter-item" onclick="applyFilter('${groupSlug}', '${variant.id}', '${variant.label}')">
                        <div class="d-flex align-items-center">
                            ${iconHtml}
                            <span class="fw-bold text-dark fs-5">${variant.label}</span>
                        </div>
                        <i class="fas fa-check text-gold opacity-0"></i>
                    </div>
                `;
            });
        }

        listContainer.innerHTML +=
            `<div class="filter-item mt-3 bg-light justify-content-center p-3" onclick="applyFilter('${groupSlug}', 'all', 'Semua ${groupName}')">
                <span class="fw-bold text-muted small text-uppercase">Lihat Semua ${groupName}</span>
            </div>`;
    }

    function backToStep1() {
        document.getElementById('step2').classList.remove('active');
        document.getElementById('step1').classList.add('active');
    }

    function applyFilter(groupSlug, variantSlug, labelName) {
        const modalEl = document.getElementById('filterModal');
        const modal = bootstrap.Modal.getInstance(modalEl);
        modal.hide();

        document.getElementById('productCountTitle').innerText = labelName;

        let filteredData;
        if (variantSlug === 'all') {
            filteredData = dbProducts.filter(p => p.slug_kelompok === groupSlug);
        } else {
            filteredData = dbProducts.filter(p => p.slug_kelompok === groupSlug && p.slug_warna === variantSlug);
        }

        renderGrid(filteredData);
        setTimeout(() => backToStep1(), 500);
    }

    function resetFilter() {
        renderGrid(dbProducts);
        document.getElementById('productCountTitle').innerText = "SEMUA KOLEKSI";
    }

    document.addEventListener('DOMContentLoaded', () => {
        renderGrid(dbProducts);
    });
</script>
<?= $this->endSection(); ?>