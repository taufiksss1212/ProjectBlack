<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<style>
    /* --- KATALOG PAGE STYLES --- */

    /* 1. Page Header (Senada dengan Hero Landing Page) */
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
        /* Supaya masuk ke belakang navbar */
    }

    .catalog-title {
        font-family: 'Playfair Display', serif;
        font-size: 4rem;
        font-weight: 700;
        color: white;
        text-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
    }

    /* 2. Filter Bar (Floating Glass Effect) */
    .filter-bar-container {
        margin-top: -50px;
        /* Overlap ke header */
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
        /* Border emas tipis */
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
    }

    /* 3. Product Card (Sama mewahnya dengan Landing Page) */
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
        /* Shadow Emas */
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
    }

    .btn-detail-gold:hover {
        background: var(--gold);
        color: white;
    }

    /* 4. Modal Styles (Popup Filter) */
    .modal-content-luxury {
        border-radius: 20px;
        border: none;
        overflow: hidden;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
    }

    .modal-header-luxury {
        background: var(--dark-blue);
        color: white;
        border-bottom: 3px solid var(--gold);
        padding: 20px 30px;
    }

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

    /* Step Animation */
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

    /* Media Query Mobile */
    @media (max-width: 768px) {
        .catalog-title {
            font-size: 2.5rem;
        }

        .catalog-img-wrapper {
            height: 200px;
        }

        /* Gambar lebih pendek di HP */
        .filter-bar {
            flex-direction: column;
            text-align: center;
        }

        .product-name {
            font-size: 1rem;
        }

        .btn-detail-gold {
            padding: 8px 0;
            font-size: 0.7rem;
        }
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
        <div class="row g-4" id="catalogGrid">
        </div>

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

                    <div class="filter-item" onclick="goToStep2('merah')">
                        <div class="d-flex align-items-center">
                            <span class="color-circle" style="background: #d32f2f;"></span>
                            <span class="fw-bold">Nuansa Merah (Red)</span>
                        </div>
                        <i class="fas fa-chevron-right text-muted"></i>
                    </div>

                    <div class="filter-item" onclick="goToStep2('biru')">
                        <div class="d-flex align-items-center">
                            <span class="color-circle" style="background: #1976d2;"></span>
                            <span class="fw-bold">Nuansa Biru (Blue)</span>
                        </div>
                        <i class="fas fa-chevron-right text-muted"></i>
                    </div>

                    <div class="filter-item" onclick="goToStep2('hijau')">
                        <div class="d-flex align-items-center">
                            <span class="color-circle" style="background: #388e3c;"></span>
                            <span class="fw-bold">Nuansa Hijau (Green)</span>
                        </div>
                        <i class="fas fa-chevron-right text-muted"></i>
                    </div>

                    <div class="filter-item" onclick="goToStep2('netral')">
                        <div class="d-flex align-items-center">
                            <span class="color-circle" style="background: #ddd;"></span>
                            <span class="fw-bold">Nuansa Netral (BW)</span>
                        </div>
                        <i class="fas fa-chevron-right text-muted"></i>
                    </div>
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


<script>
    // 1. DATABASE PRODUK (Dummy Data)
    // Struktur: id, nama, kategori(merah/biru), sub(maroon/cabe), harga, foto
    const allProducts = [
        // MERAH
        {
            id: 1,
            name: "Satin Silk Maroon",
            cat: "merah",
            sub: "maroon",
            price: "45.000",
            img: "https://placehold.co/400x500/5c0002/fff?text=Maroon"
        },
        {
            id: 2,
            name: "Wolfis Red Chilli",
            cat: "merah",
            sub: "cabe",
            price: "28.000",
            img: "https://placehold.co/400x500/ff0000/fff?text=Red+Chilli"
        },
        {
            id: 3,
            name: "Velvet Rose Red",
            cat: "merah",
            sub: "rose",
            price: "55.000",
            img: "https://placehold.co/400x500/d10046/fff?text=Rose"
        },
        {
            id: 4,
            name: "Maxmara Burgundy",
            cat: "merah",
            sub: "maroon",
            price: "60.000",
            img: "https://placehold.co/400x500/4a001f/fff?text=Burgundy"
        },

        // BIRU
        {
            id: 5,
            name: "Toyobo Royal Blue",
            cat: "biru",
            sub: "royal",
            price: "35.000",
            img: "https://placehold.co/400x500/002366/fff?text=Royal+Blue"
        },
        {
            id: 6,
            name: "Linen Sky Blue",
            cat: "biru",
            sub: "sky",
            price: "42.000",
            img: "https://placehold.co/400x500/87ceeb/fff?text=Sky+Blue"
        },
        {
            id: 7,
            name: "Drill Navy Blue",
            cat: "biru",
            sub: "navy",
            price: "38.000",
            img: "https://placehold.co/400x500/000080/fff?text=Navy"
        },

        // HIJAU
        {
            id: 8,
            name: "Rayon Sage Green",
            cat: "hijau",
            sub: "sage",
            price: "32.000",
            img: "https://placehold.co/400x500/9dc183/fff?text=Sage"
        },
        {
            id: 9,
            name: "Canvas Army Green",
            cat: "hijau",
            sub: "army",
            price: "50.000",
            img: "https://placehold.co/400x500/4b5320/fff?text=Army"
        },
        {
            id: 10,
            name: "Satin Emerald",
            cat: "hijau",
            sub: "emerald",
            price: "48.000",
            img: "https://placehold.co/400x500/50c878/fff?text=Emerald"
        },

        // NETRAL
        {
            id: 11,
            name: "Cotton Broken White",
            cat: "netral",
            sub: "bw",
            price: "30.000",
            img: "https://placehold.co/400x500/f8f8ff/333?text=BW"
        },
        {
            id: 12,
            name: "Jetblack Premium",
            cat: "netral",
            sub: "black",
            price: "40.000",
            img: "https://placehold.co/400x500/000000/fff?text=Jetblack"
        },
    ];

    // 2. DATABASE SUB-KATEGORI (Untuk Modal Lapis 2)
    const subCategories = {
        'merah': [{
                id: 'maroon',
                label: 'Maroon / Burgundy (Gelap)',
                color: '#5c0002'
            },
            {
                id: 'cabe',
                label: 'Merah Cabe (Terang)',
                color: '#ff0000'
            },
            {
                id: 'rose',
                label: 'Rose / Pinkish',
                color: '#d10046'
            }
        ],
        'biru': [{
                id: 'navy',
                label: 'Navy / Dongker',
                color: '#000080'
            },
            {
                id: 'royal',
                label: 'Royal Blue (Elektrik)',
                color: '#002366'
            },
            {
                id: 'sky',
                label: 'Sky / Light Blue',
                color: '#87ceeb'
            }
        ],
        'hijau': [{
                id: 'army',
                label: 'Hijau Army / Olive',
                color: '#4b5320'
            },
            {
                id: 'sage',
                label: 'Sage Green (Pastel)',
                color: '#9dc183'
            },
            {
                id: 'emerald',
                label: 'Emerald / Botol',
                color: '#50c878'
            }
        ],
        'netral': [{
                id: 'bw',
                label: 'Putih / Broken White',
                color: '#eee'
            },
            {
                id: 'black',
                label: 'Hitam / Jetblack',
                color: '#000'
            },
            {
                id: 'grey',
                label: 'Abu-abu',
                color: '#888'
            }
        ]
    };

    // --- FUNGSI RENDER GRID PRODUK ---
    function renderGrid(data) {
        const grid = document.getElementById('catalogGrid');
        const empty = document.getElementById('emptyState');

        grid.innerHTML = ''; // Bersihkan grid

        if (data.length === 0) {
            empty.classList.remove('d-none');
        } else {
            empty.classList.add('d-none');
            data.forEach(item => {
                // Card HTML
                const cardHTML = `
                    <div class="col-6 col-lg-3" data-aos="fade-up">
                        <div class="catalog-card">
                            <div class="catalog-img-wrapper">
                                <img src="${item.img}" class="catalog-img" alt="${item.name}">
                                <span class="badge bg-dark position-absolute top-0 start-0 m-3">NEW</span>
                            </div>
                            <div class="catalog-info">
                                <span class="product-category text-gold">${item.cat} Series</span>
                                <h5 class="product-name">${item.name}</h5>
                                <p class="mb-0 fw-bold">Rp ${item.price} <small class="text-muted">/ m</small></p>
                                <button class="btn-detail-gold">DETAIL</button>
                            </div>
                        </div>
                    </div>
                `;
                grid.innerHTML += cardHTML;
            });
        }
    }

    // --- FUNGSI MODAL STEP 1 KE STEP 2 ---
    function goToStep2(category) {
        // 1. Sembunyikan Step 1, Munculkan Step 2
        document.getElementById('step1').classList.remove('active');
        document.getElementById('step2').classList.add('active');

        // 2. Ganti Judul Modal
        document.getElementById('subCategoryTitle').innerText = "Pilih Varian " + category.toUpperCase();

        // 3. Render List Sub Kategori
        const listContainer = document.getElementById('subCategoryList');
        listContainer.innerHTML = ''; // Reset list

        const variants = subCategories[category]; // Ambil data varian

        if (variants) {
            variants.forEach(variant => {
                listContainer.innerHTML += `
                    <div class="filter-item" onclick="applyFilter('${category}', '${variant.id}')">
                        <div class="d-flex align-items-center">
                            <span class="color-circle" style="background: ${variant.color};"></span>
                            <span class="fw-bold">${variant.label}</span>
                        </div>
                        <i class="fas fa-check text-gold opacity-0"></i>
                    </div>
                `;
            });
        }

        // Tambahkan opsi "Lihat Semua di Kategori Ini"
        listContainer.innerHTML += `
            <div class="filter-item mt-3 bg-light" onclick="applyFilter('${category}', 'all')">
                <div class="d-flex align-items-center justify-content-center w-100 text-center">
                    <span class="fw-bold text-dark">Lihat Semua ${category.toUpperCase()}</span>
                </div>
            </div>
        `;
    }

    // --- FUNGSI KEMBALI KE STEP 1 ---
    function backToStep1() {
        document.getElementById('step2').classList.remove('active');
        document.getElementById('step1').classList.add('active');
    }

    // --- FUNGSI APPLY FILTER (FINAL) ---
    function applyFilter(category, subCategory) {
        // 1. Tutup Modal
        const modalEl = document.getElementById('filterModal');
        const modal = bootstrap.Modal.getInstance(modalEl);
        modal.hide();

        // 2. Filter Data
        let filteredData;

        if (subCategory === 'all') {
            // Tampilkan semua di kategori utama (misal: semua merah)
            filteredData = allProducts.filter(p => p.cat === category);
            document.getElementById('productCountTitle').innerText = "Kategori: " + category.toUpperCase();
        } else {
            // Tampilkan spesifik (misal: merah maroon)
            filteredData = allProducts.filter(p => p.cat === category && p.sub === subCategory);
            document.getElementById('productCountTitle').innerText = "Kategori: " + subCategory.toUpperCase();
        }

        // 3. Render Ulang
        renderGrid(filteredData);

        // 4. Reset modal ke step 1 (tunggu animasi tutup selesai)
        setTimeout(() => backToStep1(), 500);
    }

    // --- FUNGSI RESET ---
    function resetFilter() {
        renderGrid(allProducts);
        document.getElementById('productCountTitle').innerText = "Semua Koleksi";
    }

    // --- INITIAL RENDER ---
    document.addEventListener('DOMContentLoaded', () => {
        renderGrid(allProducts);
    });
</script>

<?= $this->endSection(); ?>