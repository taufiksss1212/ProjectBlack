const formatRupiah = (number) => {
    return new Intl.NumberFormat('id-ID', { maximumSignificantDigits: 3 }).format(number);
}

function renderGrid(data) {
    const grid = document.getElementById('catalogGrid');
    const empty = document.getElementById('emptyState');
    if (!grid) return;
    
    grid.innerHTML = '';
    if (data.length === 0) {
        empty.classList.remove('d-none');
    } else {
        empty.classList.add('d-none');
        data.forEach(item => {
            // Menggunakan variabel global imageBasePath yang diset di View
            let imgUrl = item.gambar_produk.includes('http') ? item.gambar_produk : imageBasePath + item.gambar_produk;
            let priceHtml = `Rp ${formatRupiah(item.harga)}`;
            if (item.is_flash_sale == 1 && item.harga_coret > 0) {
                priceHtml = `<small class="text-danger text-decoration-line-through me-1 fs-6">${formatRupiah(item.harga_coret)}</small> Rp ${formatRupiah(item.harga)}`;
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
    // Menggunakan variabel global dbProducts
    const product = dbProducts.find(p => p.id == id);
    if (product) {
        let imgUrl = product.gambar_produk.includes('http') ? product.gambar_produk : imageBasePath + product.gambar_produk;
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
        const message = `Halo Tamara Textile, saya tertarik dengan produk *${product.nama_produk}*. Apakah stok tersedia?`;
        const waUrl = `https://wa.me/6281234567890?text=${encodeURIComponent(message)}`;
        document.getElementById('waLink').href = waUrl;
        var myModal = new bootstrap.Modal(document.getElementById('productDetailModal'));
        myModal.show();
    }
}

function goToStep2(groupSlug, groupName) {
    document.getElementById('step1').classList.remove('active');
    document.getElementById('step2').classList.add('active');
    document.getElementById('subCategoryTitle').innerText = "Varian " + groupName;

    const listContainer = document.getElementById('subCategoryList');
    listContainer.innerHTML = '';

    // Menggunakan variabel global dbFilters
    const variants = dbFilters[groupSlug];

    if (variants) {
        variants.forEach(variant => {
            let iconHtml = '';
            if (variant.image && variant.image !== 'null') {
                iconHtml = `<img src="${variant.image}" class="rounded-circle shadow-sm me-3" style="width: 40px; height: 40px; object-fit: cover; border: 2px solid #fff;">`;
            } else {
                iconHtml = `<span class="color-circle me-3" style="background: ${variant.color}; width:40px; height:40px;"></span>`;
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

    listContainer.innerHTML += `
        <div class="filter-item mt-3 bg-light justify-content-center p-3" onclick="applyFilter('${groupSlug}', 'all', 'Semua ${groupName}')">
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
    // Cek apakah dbProducts sudah didefinisikan sebelum render
    if (typeof dbProducts !== 'undefined') {
        renderGrid(dbProducts);
    }
});