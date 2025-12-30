<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<style>
    /* --- HEADER & LAYOUT UTAMA --- */
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
                    </div>

                    <div class="col-lg-6 detail-right-col">
                        <span id="detailCat" class="badge-category">Kategori</span>
                        <h2 class="detail-title-large" id="detailName">Nama Produk</h2>

                        <div class="detail-price-large">
                            <span id="detailPriceDisplay">Rp 0</span> <span>/ meter</span>
                        </div>

                        <p class="text-secondary" style="line-height: 1.7;">
                            Nikmati kualitas kain premium Grade A dengan tekstur lembut dan warna yang tahan lama. Cocok
                            untuk gaun, kemeja, atau busana muslimah yang elegan.
                        </p>

                        <div class="spec-grid-clean">
                            <div class="spec-box">
                                <i class="fas fa-ruler-horizontal"></i>
                                <div class="spec-text">
                                    <h6>Lebar</h6>
                                    <p id="specWidth">1.5m</p>
                                </div>
                            </div>
                            <div class="spec-box">
                                <i class="fas fa-layer-group"></i>
                                <div class="spec-text">
                                    <h6>Bahan</h6>
                                    <p id="specMaterial">Katun</p>
                                </div>
                            </div>
                            <div class="spec-box">
                                <i class="fas fa-feather-alt"></i>
                                <div class="spec-text">
                                    <h6>Tekstur</h6>
                                    <p id="specChar">Halus</p>
                                </div>
                            </div>
                            <div class="spec-box">
                                <i class="fas fa-check-circle"></i>
                                <div class="spec-text">
                                    <h6>Status</h6>
                                    <p class="text-success">Ready Stock</p>
                                </div>
                            </div>
                        </div>

                        <a href="#" id="waLink" target="_blank" class="btn btn-wa-large">
                            <i class="fab fa-whatsapp fa-lg"></i> Pesan via WhatsApp
                        </a>
                        <div class="text-center mt-3">
                            <small class="text-muted" style="font-size: 0.7rem;">*Garansi retur jika barang cacat/tidak
                                sesuai.</small>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

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
                    <div class="filter-item" onclick="goToStep2('merah')">
                        <div class="d-flex align-items-center"><span class="color-circle"
                                style="background: #d32f2f;"></span><span class="fw-bold">Nuansa Merah</span></div><i
                            class="fas fa-chevron-right text-muted"></i>
                    </div>
                    <div class="filter-item" onclick="goToStep2('biru')">
                        <div class="d-flex align-items-center"><span class="color-circle"
                                style="background: #1976d2;"></span><span class="fw-bold">Nuansa Biru</span></div><i
                            class="fas fa-chevron-right text-muted"></i>
                    </div>
                    <div class="filter-item" onclick="goToStep2('hijau')">
                        <div class="d-flex align-items-center"><span class="color-circle"
                                style="background: #388e3c;"></span><span class="fw-bold">Nuansa Hijau</span></div><i
                            class="fas fa-chevron-right text-muted"></i>
                    </div>
                    <div class="filter-item" onclick="goToStep2('netral')">
                        <div class="d-flex align-items-center"><span class="color-circle"
                                style="background: #ddd;"></span><span class="fw-bold">Nuansa Netral</span></div><i
                            class="fas fa-chevron-right text-muted"></i>
                    </div>
                </div>
                <div id="step2" class="step-view">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <button class="btn btn-sm btn-outline-secondary rounded-pill px-3" onclick="backToStep1()"><i
                                class="fas fa-arrow-left me-1"></i> Kembali</button>
                        <span class="badge bg-dark text-gold">Step 2</span>
                    </div>
                    <h5 class="fw-bold mb-3 playfair" id="subCategoryTitle">Pilih Varian</h5>
                    <div id="subCategoryList"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // 1. DATA PRODUK LENGKAP
    const allProducts = [
        // MERAH
        {
            id: 1,
            name: "Satin Silk Maroon",
            cat: "merah",
            sub: "maroon",
            price: "45.000",
            img: "https://placehold.co/400x500/5c0002/fff?text=Maroon",
            width: "1.5 m",
            mat: "Satin Silk Premium",
            char: "Mengkilap, Jatuh"
        },
        {
            id: 2,
            name: "Wolfis Red Chilli",
            cat: "merah",
            sub: "cabe",
            price: "28.000",
            img: "https://placehold.co/400x500/ff0000/fff?text=Red+Chilli",
            width: "1.5 m",
            mat: "Wolfis Grade A",
            char: "Tebal, Tidak Terawang"
        },
        {
            id: 3,
            name: "Velvet Rose Red",
            cat: "merah",
            sub: "rose",
            price: "55.000",
            img: "https://placehold.co/400x500/d10046/fff?text=Rose",
            width: "1.5 m",
            mat: "Velvet Junior",
            char: "Lembut Beludru"
        },
        {
            id: 4,
            name: "Maxmara Burgundy",
            cat: "merah",
            sub: "maroon",
            price: "60.000",
            img: "https://placehold.co/400x500/4a001f/fff?text=Burgundy",
            width: "1.5 m",
            mat: "Maxmara Lux",
            char: "Motif Elegan, Dingin"
        },

        // BIRU
        {
            id: 5,
            name: "Toyobo Royal Blue",
            cat: "biru",
            sub: "royal",
            price: "35.000",
            img: "https://placehold.co/400x500/002366/fff?text=Royal+Blue",
            width: "1.5 m",
            mat: "Katun Toyobo",
            char: "Serap Keringat"
        },
        {
            id: 6,
            name: "Linen Sky Blue",
            cat: "biru",
            sub: "sky",
            price: "42.000",
            img: "https://placehold.co/400x500/87ceeb/fff?text=Sky+Blue",
            width: "1.5 m",
            mat: "Linen Euro",
            char: "Serat Alami Estetik"
        },
        {
            id: 7,
            name: "Drill Navy Blue",
            cat: "biru",
            sub: "navy",
            price: "38.000",
            img: "https://placehold.co/400x500/000080/fff?text=Navy",
            width: "1.5 m",
            mat: "American Drill",
            char: "Kuat, Tebal, Awet"
        },

        // HIJAU
        {
            id: 8,
            name: "Rayon Sage Green",
            cat: "hijau",
            sub: "sage",
            price: "32.000",
            img: "https://placehold.co/400x500/9dc183/fff?text=Sage",
            width: "1.5 m",
            mat: "Rayon Viscose",
            char: "Sangat Adem, Jatuh"
        },
        {
            id: 9,
            name: "Canvas Army",
            cat: "hijau",
            sub: "army",
            price: "50.000",
            img: "https://placehold.co/400x500/4b5320/fff?text=Army",
            width: "1.5 m",
            mat: "Canvas Marsoto",
            char: "Kaku, Kokoh"
        },
        {
            id: 10,
            name: "Satin Emerald",
            cat: "hijau",
            sub: "emerald",
            price: "48.000",
            img: "https://placehold.co/400x500/50c878/fff?text=Emerald",
            width: "1.5 m",
            mat: "Satin Roberto",
            char: "Halus, Berkilau Doff"
        },

        // NETRAL
        {
            id: 11,
            name: "Cotton Broken White",
            cat: "netral",
            sub: "bw",
            price: "30.000",
            img: "https://placehold.co/400x500/f8f8ff/333?text=BW",
            width: "1.5 m",
            mat: "Combed 30s",
            char: "Standar Distro"
        },
        {
            id: 12,
            name: "Jetblack Premium",
            cat: "netral",
            sub: "black",
            price: "40.000",
            img: "https://placehold.co/400x500/000000/fff?text=Jetblack",
            width: "1.5 m",
            mat: "Wolfis Jetblack",
            char: "Hitam Pekat"
        },
    ];

    const subCategories = {
        'merah': [{
            id: 'maroon',
            label: 'Maroon',
            color: '#5c0002'
        }, {
            id: 'cabe',
            label: 'Merah Cabe',
            color: '#ff0000'
        }, {
            id: 'rose',
            label: 'Rose Pink',
            color: '#d10046'
        }],
        'biru': [{
            id: 'navy',
            label: 'Navy',
            color: '#000080'
        }, {
            id: 'royal',
            label: 'Royal Blue',
            color: '#002366'
        }, {
            id: 'sky',
            label: 'Sky Blue',
            color: '#87ceeb'
        }],
        'hijau': [{
            id: 'army',
            label: 'Army',
            color: '#4b5320'
        }, {
            id: 'sage',
            label: 'Sage',
            color: '#9dc183'
        }, {
            id: 'emerald',
            label: 'Emerald',
            color: '#50c878'
        }],
        'netral': [{
            id: 'bw',
            label: 'Broken White',
            color: '#eee'
        }, {
            id: 'black',
            label: 'Hitam',
            color: '#000'
        }]
    };

    function renderGrid(data) {
        const grid = document.getElementById('catalogGrid');
        const empty = document.getElementById('emptyState');
        grid.innerHTML = '';

        if (data.length === 0) {
            empty.classList.remove('d-none');
        } else {
            empty.classList.add('d-none');
            data.forEach(item => {
                const cardHTML = `
                    <div class="col-6 col-lg-3" data-aos="fade-up">
                        <div class="catalog-card">
                            <div class="catalog-img-wrapper">
                                <img src="${item.img}" class="catalog-img" alt="${item.name}">
                            </div>
                            <div class="catalog-info">
                                <span class="product-category text-gold">${item.cat} Series</span>
                                <h5 class="product-name text-truncate">${item.name}</h5>
                                <p class="mb-0 fw-bold">Rp ${item.price} <small class="text-muted">/ m</small></p>
                                <button class="btn-detail-gold" onclick="showDetail(${item.id})">DETAIL</button>
                            </div>
                        </div>
                    </div>
                `;
                grid.innerHTML += cardHTML;
            });
        }
    }

    function showDetail(id) {
        const product = allProducts.find(p => p.id === id);
        if (product) {
            document.getElementById('detailImg').src = product.img;
            document.getElementById('detailName').innerText = product.name;
            document.getElementById('detailPriceDisplay').innerText = 'Rp ' + product.price;
            document.getElementById('detailCat').innerText = product.cat + ' Series';
            document.getElementById('specWidth').innerText = product.width;
            document.getElementById('specMaterial').innerText = product.mat;
            document.getElementById('specChar').innerText = product.char;

            const message =
                `Halo Tamara Textile, saya ingin memesan *${product.name}* (Rp ${product.price}). Apakah stok tersedia?`;
            const waUrl = `https://wa.me/6281234567890?text=${encodeURIComponent(message)}`;
            document.getElementById('waLink').href = waUrl;

            var myModal = new bootstrap.Modal(document.getElementById('productDetailModal'));
            myModal.show();
        }
    }

    function goToStep2(category) {
        document.getElementById('step1').classList.remove('active');
        document.getElementById('step2').classList.add('active');
        document.getElementById('subCategoryTitle').innerText = "Varian " + category.charAt(0).toUpperCase() + category
            .slice(1);

        const listContainer = document.getElementById('subCategoryList');
        listContainer.innerHTML = '';
        const variants = subCategories[category];
        if (variants) {
            variants.forEach(variant => {
                listContainer.innerHTML += `
                    <div class="filter-item" onclick="applyFilter('${category}', '${variant.id}', '${variant.label}')">
                        <div class="d-flex align-items-center"><span class="color-dot" style="background: ${variant.color};"></span><span class="fw-bold text-dark">${variant.label}</span></div>
                        <i class="fas fa-check text-gold opacity-0"></i>
                    </div>
                `;
            });
        }
        listContainer.innerHTML +=
            `<div class="filter-item mt-3 bg-light justify-content-center" onclick="applyFilter('${category}', 'all', 'Semua ${category.toUpperCase()}')"><span class="fw-bold text-muted small text-uppercase">Lihat Semua ${category}</span></div>`;
    }

    function backToStep1() {
        document.getElementById('step2').classList.remove('active');
        document.getElementById('step1').classList.add('active');
    }

    function applyFilter(category, subCategory, labelName) {
        const modalEl = document.getElementById('filterModal');
        const modal = bootstrap.Modal.getInstance(modalEl);
        modal.hide();
        document.getElementById('productCountTitle').innerText = "Kategori: " + labelName.split('(')[0];
        let filteredData;
        if (subCategory === 'all') {
            filteredData = allProducts.filter(p => p.cat === category);
        } else {
            filteredData = allProducts.filter(p => p.cat === category && p.sub === subCategory);
        }
        renderGrid(filteredData);
        setTimeout(() => backToStep1(), 500);
    }

    function resetFilter() {
        renderGrid(allProducts);
        document.getElementById('productCountTitle').innerText = "SEMUA KOLEKSI";
    }

    document.addEventListener('DOMContentLoaded', () => {
        renderGrid(allProducts);
    });
</script>

<?= $this->endSection(); ?>