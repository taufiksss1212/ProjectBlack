<?= $this->extend('layout/template'); ?>

<?= $this->section('styles'); ?>
<link rel="stylesheet" href="<?= base_url('css/catalog.css?v=' . time()) ?>">
<style>
    /* Menyembunyikan panah atas-bawah (spinner) bawaan browser pada input number */
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type="number"] {
        -moz-appearance: textfield;
    }
</style>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<header class="catalog-header">
    <div data-aos="fade-up">
        <h1 class="catalog-title"><?= lang('Site.cat_header') ?? 'Koleksi Kain' ?></h1>
    </div>
</header>

<div class="container filter-bar-container">
    <div class="filter-bar">
        <div>
            <span
                class="text-muted text-uppercase small letter-spacing-2"><?= lang('Site.cat_displaying') ?? 'Menampilkan' ?></span>
            <h4 class="mb-0 fw-bold playfair" id="productCountTitle">
                <?= lang('Site.cat_collection') ?? 'Semua Koleksi' ?></h4>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-outline-dark rounded-pill px-4" onclick="resetFilter()">
                <i class="fas fa-sync-alt me-2"></i> <?= lang('Site.btn_reset') ?? 'Reset' ?>
            </button>
            <button class="btn btn-gold-outline rounded-pill px-4" style="background: var(--gold); color: white;"
                data-bs-toggle="modal" data-bs-target="#filterModal">
                <i class="fas fa-filter me-2"></i> <?= lang('Site.btn_filter') ?? 'Filter' ?>
            </button>
        </div>
    </div>
</div>

<section class="pb-5 bg-soft" style="min-height: 600px;">
    <div class="container">
        <div class="row g-4" id="catalogGrid">
            <?php foreach ($products as $p): ?>
                <?php $img = strpos($p['gambar_produk'], 'http') === 0 ? $p['gambar_produk'] : base_url('uploads/products/' . $p['gambar_produk']); ?>
                <div class="col-6 col-lg-3" data-aos="fade-up">
                    <div class="catalog-card">
                        <div class="catalog-img-wrapper">
                            <img src="<?= $img ?>" class="catalog-img" alt="<?= $p['nama_produk'] ?>" loading="lazy">
                            <?php if ($p['is_flash_sale'] == 1): ?>
                                <span
                                    class="position-absolute top-0 end-0 m-2 badge bg-danger"><?= lang('Site.promo_badge') ?? 'PROMO' ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="catalog-info">
                            <span class="product-category text-gold"><?= $p['nama_bahan'] ?></span>
                            <h5 class="product-name text-truncate"><?= $p['nama_produk'] ?></h5>
                            <p class="mb-0 fw-bold">Rp <?= number_format($p['harga'], 0, ',', '.') ?></p>
                            <button class="btn-detail-gold"
                                onclick="showDetail(<?= $p['id'] ?>)"><?= lang('Site.btn_detail') ?? 'DETAIL' ?></button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="row mt-5" id="paginationContainer">
            <div class="col-12">
                <?= $pager->links('produk', 'luxury_theme') ?>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="filterModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-luxury">
            <div class="modal-header modal-header-luxury">
                <h5 class="modal-title text-white playfair" id="modalTitle">
                    <?= lang('Site.filter_title') ?? 'Filter Warna' ?></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 bg-light">
                <div id="step1" class="step-view active">
                    <p class="text-muted small text-uppercase mb-3 fw-bold">
                        <?= lang('Site.filter_step1') ?? 'Pilih Kelompok Warna' ?></p>
                    <?php if (!empty($colorGroups)): ?>
                        <?php foreach ($colorGroups as $group) : ?>
                            <div class="filter-item" onclick="goToStep2('<?= $group['slug'] ?>', '<?= $group['label'] ?>')">
                                <div class="d-flex align-items-center">
                                    <span class="color-circle" style="background: <?= $group['hex'] ?>;"></span>
                                    <span class="fw-bold"><?= $group['label'] ?></span>
                                </div>
                                <i class="fas fa-chevron-right text-muted"></i>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <div id="step2" class="step-view">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <button class="btn btn-sm btn-outline-secondary rounded-pill px-3" onclick="backToStep1()">
                            <i class="fas fa-arrow-left me-1"></i> <?= lang('Site.btn_back') ?? 'Kembali' ?>
                        </button>
                        <span class="badge bg-dark text-gold"><?= lang('Site.filter_step2_bdg') ?? 'Langkah 2' ?></span>
                    </div>
                    <h5 class="fw-bold mb-3 playfair" id="subCategoryTitle">
                        <?= lang('Site.choose_variant') ?? 'Pilih Varian' ?></h5>
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
                <div class="text-uppercase letter-spacing-2 small text-gold fw-bold">
                    <?= lang('Site.detail_title') ?? 'Detail Produk' ?></div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body p-0 bg-white">
                <div class="row g-0">
                    <div class="col-lg-6 detail-left-col">
                        <img src="" id="detailImg" class="detail-img-full" alt="Foto Produk">
                        <div id="detailBadge" class="position-absolute top-0 start-0 m-3 d-none">
                            <span
                                class="badge bg-danger rounded-pill px-3 py-2"><?= lang('Site.flash_sale') ?? 'FLASH SALE' ?></span>
                        </div>
                    </div>

                    <div class="col-lg-6 detail-right-col">
                        <span id="detailCat" class="badge-category"><?= lang('Site.category') ?? 'Kategori' ?></span>
                        <h2 class="detail-title-large" id="detailName">Nama Produk</h2>
                        <div class="detail-price-large">
                            <span id="detailPriceDisplay">Rp 0</span> <span>/ <span id="detailUnit">satuan</span></span>
                        </div>
                        <p class="text-secondary" style="line-height: 1.7;"><span id="detailDesc"></span></p>

                        <div class="spec-grid-clean">
                            <div class="spec-box"><i class="fas fa-ruler-horizontal"></i>
                                <div class="spec-text">
                                    <h6>Lebar Kain</h6>
                                    <p id="specWidth">-</p>
                                </div>
                            </div>
                            <div class="spec-box"><i class="fas fa-layer-group"></i>
                                <div class="spec-text">
                                    <h6>Bahan</h6>
                                    <p id="specMaterial">-</p>
                                </div>
                            </div>
                            <div class="spec-box"><i class="fas fa-feather-alt"></i>
                                <div class="spec-text">
                                    <h6>Karakteristik</h6>
                                    <p id="specChar">-</p>
                                </div>
                            </div>
                            <div class="spec-box"><i class="fas fa-cube"></i>
                                <div class="spec-text">
                                    <h6>Konstruksi</h6>
                                    <p id="specConst">-</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 pt-3 border-top">
                            <label class="form-label small fw-bold text-muted">Jumlah (<span
                                    id="inputUnit">satuan</span>)</label>
                            <div class="d-flex flex-column flex-md-row align-items-center gap-3">
                                <div class="input-group" style="width: 130px; flex-shrink: 0;">
                                    <button class="btn btn-outline-secondary" type="button" onclick="ubahQty(-1)"><i
                                            class="fas fa-minus"></i></button>
                                    <input type="number" id="qtyInput" class="form-control text-center fw-bold"
                                        value="1" min="1" step="1" onchange="validasiKetikManual(this)"
                                        style="color: #000 !important; background: #fff;">
                                    <button class="btn btn-outline-secondary" type="button" onclick="ubahQty(1)"><i
                                            class="fas fa-plus"></i></button>
                                </div>

                                <div class="d-flex gap-2 w-100">
                                    <button id="btnAddToCart" class="btn btn-outline-dark flex-grow-1 fw-bold"
                                        onclick="prosesAddToCart(false)">
                                        <i class="fas fa-cart-plus"></i> KERANJANG
                                    </button>
                                    <button id="btnBuyNow" class="btn flex-grow-1 fw-bold shadow-sm"
                                        style="background: var(--gold); color: white;" onclick="prosesAddToCart(true)">
                                        LANGSUNG CHECKOUT
                                    </button>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="hiddenProductId" value="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script>
    // DATA & CONFIG
    const dbProducts = <?= json_encode($all_products); ?>;
    const dbFilters = <?= json_encode($subCats); ?>;
    const imageBasePath = "<?= base_url('uploads/products/') ?>";
    const TEXT = {
        viewAll: "Lihat Semua",
        notFound: "Produk tidak ditemukan",
        btnReset: "Reset Filter",
        promo: "PROMO",
        btnDetail: "DETAIL"
    };
    const formatRupiah = (number) => new Intl.NumberFormat('id-ID').format(number);

    // FUNGSI FILTER LOGIC
    function goToStep2(groupSlug, groupName) {
        document.getElementById('step1').classList.remove('active');
        document.getElementById('step2').classList.add('active');
        document.getElementById('subCategoryTitle').innerText = "Varian " + groupName;
        const listContainer = document.getElementById('subCategoryList');
        listContainer.innerHTML = '';
        const variants = dbFilters[groupSlug];

        if (variants) {
            variants.forEach(variant => {
                let iconHtml = variant.image && variant.image !== 'null' ?
                    `<img src="${variant.image.includes('http') ? variant.image : imageBasePath + '../swatches/' + variant.image}" class="rounded-circle shadow-sm me-3" style="width: 40px; height: 40px; object-fit: cover; border: 2px solid #fff;">` :
                    `<span class="color-circle me-3" style="background: ${variant.color}; width:40px; height:40px;"></span>`;
                listContainer.innerHTML += `
                <div class="filter-item" onclick="applyFilter('${groupSlug}', '${variant.id}', '${variant.label}')">
                    <div class="d-flex align-items-center">${iconHtml}<span class="fw-bold text-dark fs-5">${variant.label}</span></div>
                    <i class="fas fa-check text-gold opacity-0"></i>
                </div>`;
            });
        }
        listContainer.innerHTML +=
            `<div class="filter-item mt-3 bg-light justify-content-center p-3" onclick="applyFilter('${groupSlug}', 'all', '${TEXT.viewAll} ${groupName}')"><span class="fw-bold text-muted small text-uppercase">${TEXT.viewAll} ${groupName}</span></div>`;
    }

    function backToStep1() {
        document.getElementById('step2').classList.remove('active');
        document.getElementById('step1').classList.add('active');
    }

    function applyFilter(groupSlug, variantSlug, labelName) {
        const modal = bootstrap.Modal.getInstance(document.getElementById('filterModal'));
        modal.hide();
        document.getElementById('productCountTitle').innerText = labelName;
        let filteredData = variantSlug === 'all' ? dbProducts.filter(p => p.slug_kelompok === groupSlug) : dbProducts
            .filter(p => p.slug_kelompok === groupSlug && p.slug_warna === variantSlug);
        renderGrid(filteredData);
        const pager = document.getElementById('paginationContainer');
        if (pager) pager.style.display = 'none';
        setTimeout(() => backToStep1(), 500);
    }

    function resetFilter() {
        window.location.reload();
    }

    function renderGrid(data) {
        const grid = document.getElementById('catalogGrid');
        if (!grid) return;
        grid.innerHTML = '';
        if (data.length === 0) {
            grid.innerHTML =
                `<div class="col-12 text-center py-5"><i class="fas fa-search fa-3x text-muted mb-3 opacity-50"></i><p class="text-muted">${TEXT.notFound}</p><button class="btn btn-sm btn-outline-dark" onclick="resetFilter()">${TEXT.btnReset}</button></div>`;
        } else {
            data.forEach(item => {
                let imgUrl = item.gambar_produk.includes('http') ? item.gambar_produk : imageBasePath + item
                    .gambar_produk;
                let priceHtml = `Rp ${formatRupiah(item.harga)}`;
                let badgeHtml = item.is_flash_sale == 1 ?
                    `<span class="position-absolute top-0 end-0 m-2 badge bg-danger">${TEXT.promo}</span>` : '';
                if (item.is_flash_sale == 1 && item.harga_coret > 0) priceHtml =
                    `<small class="text-danger text-decoration-line-through me-1 fs-6">${formatRupiah(item.harga_coret)}</small> Rp ${formatRupiah(item.harga)}`;

                grid.innerHTML += `
                <div class="col-6 col-lg-3" data-aos="fade-up">
                    <div class="catalog-card">
                        <div class="catalog-img-wrapper"><img src="${imgUrl}" class="catalog-img" alt="${item.nama_produk}" loading="lazy">${badgeHtml}</div>
                        <div class="catalog-info">
                            <span class="product-category text-gold">${item.nama_bahan}</span>
                            <h5 class="product-name text-truncate">${item.nama_produk}</h5>
                            <p class="mb-0 fw-bold">${priceHtml}</p>
                            <button class="btn-detail-gold" onclick="showDetail(${item.id})">${TEXT.btnDetail}</button>
                        </div>
                    </div>
                </div>`;
            });
        }
    }

    // FUNGSI DETAIL MODAL & ADD TO CART
    function showDetail(id) {
        const product = dbProducts.find(p => p.id == id);
        if (product) {
            document.getElementById('hiddenProductId').value = product.id;
            document.getElementById('detailImg').src = product.gambar_produk.includes('http') ? product.gambar_produk :
                imageBasePath + product.gambar_produk;
            document.getElementById('detailName').innerText = product.nama_produk;
            document.getElementById('detailPriceDisplay').innerText = 'Rp ' + formatRupiah(product.harga);
            let unitText = product.satuan_jual || 'satuan';
            if (document.getElementById('detailUnit')) document.getElementById('detailUnit').innerText = unitText;
            if (document.getElementById('inputUnit')) document.getElementById('inputUnit').innerText = unitText;
            document.getElementById('qtyInput').value = 1;
            document.getElementById('detailCat').innerText = (product.nama_bahan || '') + ' - ' + (product.nama_varian ||
                '');
            document.getElementById('specWidth').innerText = product.lebar_kain || '-';
            document.getElementById('specMaterial').innerText = product.nama_bahan || '-';
            document.getElementById('specChar').innerText = product.karakteristik || '-';
            document.getElementById('specConst').innerText = product.konstruksi_kain || '-';
            document.getElementById('detailDesc').innerText = product.deskripsi_bahan || '';

            const badge = document.getElementById('detailBadge');
            if (badge) {
                if (product.is_flash_sale == 1) badge.classList.remove('d-none');
                else badge.classList.add('d-none');
            }
            var myModal = new bootstrap.Modal(document.getElementById('productDetailModal'));
            myModal.show();
        }
    }

    function ubahQty(nilai) {
        let input = document.getElementById('qtyInput');
        let newVal = (parseInt(input.value) || 0) + nilai;
        if (newVal >= 1) input.value = newVal;
    }

    function validasiKetikManual(input) {
        let val = parseInt(input.value);
        input.value = (isNaN(val) || val < 1) ? 1 : val;
    }

    // Proses Add To Cart terhubung dengan Offcanvas di template.php
    function prosesAddToCart(isCheckout) {
        let productId = document.getElementById('hiddenProductId').value;
        let qty = parseInt(document.getElementById('qtyInput').value);
        if (isNaN(qty) || qty < 1) qty = 1;

        let btnCart = document.getElementById('btnAddToCart');
        let btnBuy = document.getElementById('btnBuyNow');
        let activeBtn = isCheckout ? btnBuy : btnCart;
        let originalText = activeBtn.innerHTML;

        activeBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> PROSES...';
        btnCart.disabled = true;
        btnBuy.disabled = true;

        fetch('<?= site_url('cart/add') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: `id_produk=${productId}&qty=${qty}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    if (isCheckout) {
                        window.location.href = '<?= site_url('checkout') ?>';
                    } else {
                        // Panggil fungsi global dari template.php
                        if (typeof renderOffcanvas === "function") {
                            renderOffcanvas(data.cart_data);
                        }
                        var myModal = bootstrap.Modal.getInstance(document.getElementById('productDetailModal'));
                        myModal.hide();

                        var cartOffcanvas = new bootstrap.Offcanvas(document.getElementById('cartOffcanvas'));
                        cartOffcanvas.show();

                        setTimeout(() => {
                            activeBtn.innerHTML = originalText;
                            btnCart.disabled = false;
                            btnBuy.disabled = false;
                        }, 500);
                    }
                }
            });
    }
</script>
<?= $this->endSection(); ?>