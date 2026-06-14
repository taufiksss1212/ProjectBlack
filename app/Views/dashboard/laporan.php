<?= $this->extend('dashboard/layout') ?>

<?= $this->section('content') ?>

<style>
    .content-wrapper {
        background: #f3f5f9 !important;
        padding: 25px;
        min-height: 100vh;
    }
    .card-clean {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
        border: none;
        padding: 30px;
        margin-bottom: 25px;
    }
    .form-label-clean {
        color: #8898aa;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
        margin-bottom: 8px;
    }
    .form-select-clean {
        border-radius: 8px;
        border: 2px solid #e0e0e0;
        padding: 12px;
        font-size: 0.95rem;
        background-color: #fff;
        color: #1a1a1a;
        transition: 0.3s;
    }
    .form-select-clean:focus {
        border-color: #c5a059;
        box-shadow: 0 0 0 4px rgba(197, 160, 89, 0.1);
        outline: none;
    }
    
    /* === Luxury Search Bar Style (Adaptasi Manajemen Produk) === */
    .search-group-bulk {
        display: flex;
        align-items: center;
        background: white;
        border: 2px solid #e0e0e0;
        border-radius: 50px;
        padding: 4px 5px 4px 20px;
        transition: 0.3s;
        width: 100%;
        position: relative;
    }
    .search-group-bulk:focus-within {
        border-color: #c5a059;
        box-shadow: 0 0 0 4px rgba(197, 160, 89, 0.1);
    }
    .search-input-bulk {
        border: none;
        background: transparent;
        outline: none;
        flex: 1;
        min-width: 0;
        padding: 10px 10px 10px 0;
        color: #333;
        font-size: 0.95rem;
    }
    .search-btn-bulk {
        width: 40px;
        height: 40px;
        background: #c5a059;
        color: white;
        border: none;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    /* Table & Buttons */
    .table-custom thead th {
        background: #f8f9fa;
        color: #6c757d;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        border: none;
        padding: 15px 20px;
    }
    .table-custom tbody td {
        padding: 15px 20px;
        border-bottom: 1px solid #f8f9fa;
        vertical-align: middle;
        color: #495057;
    }
    .input-stok-bulk {
        width: 100px;
        padding: 8px 12px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        text-align: center;
        font-weight: bold;
        color: #1a1a1a;
    }
    .input-stok-bulk:focus {
        border-color: #2e7d32;
        outline: none;
    }
    .btn-gold {
        background: #c5a059;
        color: white;
        border: none;
        padding: 12px 25px;
        border-radius: 8px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        transition: 0.2s;
    }
    .btn-gold:hover {
        background: #b08d4b;
        color: white;
    }
    .btn-remove-row {
        background: #ffecec;
        color: #d63384;
        border: none;
        width: 32px;
        height: 32px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: 0.2s;
    }
    .btn-remove-row:hover {
        background: #d63384;
        color: white;
    }
</style>

<div class="mb-4">
    <h2 style="font-family: var(--font-serif); color: var(--lux-dark); font-weight: 700;">Pusat Pelaporan & Manajemen Stok Massal</h2>
    <p class="text-muted">Saring berkas laporan atau lakukan pembaruan data stok masuk secara berbarengan.</p>
</div>

<div class="card-clean">
    <div class="row g-4">
        <div class="col-md-6">
            <label class="form-label-clean">Aktivitas Laporan / Inventaris</label>
            <select id="jenis_laporan" class="form-select w-100 form-select-clean">
                <option value="barang_masuk" selected>Entri Barang Masuk (Bulk CRUD Stok)</option>
                <option value="barang_keluar">Laporan Distribusi Barang Keluar (Pesanan)</option>
                <option value="pendapatan">Laporan Keuangan & Pendapatan Bersih</option>
            </select>
        </div>

        <div class="col-md-6" id="box_filter_waktu" style="display: none;">
            <div class="row g-2">
                <div class="col-md-6">
                    <label class="form-label-clean">Rentang Periode</label>
                    <select id="periode" class="form-select form-select-clean">
                        <option value="harian">Harian</option>
                        <option value="bulanan" selected>Bulanan</option>
                        <option value="tahuann">Tahunan</option>
                    </select>
                </div>
                <div class="col-md-6 pt-4 text-end">
                    <a href="#" class="btn-gold w-100 justify-content-center" style="height: 48px;">
                        <i class="fas fa-file-pdf"></i> Unduh Berkas PDF
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card-clean" id="panel_pencarian_stok">
    <label class="form-label-clean mb-2"><i class="fas fa-search"></i> Cari & Tambahkan Kain ke Daftar Pembaruan Massal</label>
    <div class="row align-items-center">
        <div class="col-lg-8">
            <div class="search-group-bulk shadow-sm">
                <input type="text" id="input_search_bulk" class="search-input-bulk" 
                    placeholder="Ketik nama kain lalu tekan 'Enter' (Contoh: Rayon, Katun, Maroon)..." autocomplete="off">
                <button type="button" id="btn_trigger_add" class="search-btn-bulk">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
            <small class="text-muted d-block mt-2 ms-2">
                * Kain yang Anda pilih akan langsung masuk ke daftar tabel manajemen di bawah untuk di-update bersamaan.
            </small>
        </div>
    </div>
</div>

<div class="card-clean">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h5 class="fw-bold mb-1" id="preview_title" style="font-family: var(--font-serif); color: var(--lux-dark);">
                Daftar Pembaruan Kuantitas Stok Kain
            </h5>
            <p class="text-muted small mb-0" id="preview_subtitle">Kain-kain di bawah siap ditambahkan jumlah stok masuknya secara serentak.</p>
        </div>
        
        <button type="button" id="btn_save_bulk" class="btn-gold" style="background: #2e7d32;">
            <i class="fas fa-save"></i> Simpan Semua Perubahan Stok
        </button>
    </div>

    <div class="table-responsive" id="area_tabel_preview">
        <form id="form_bulk_stok">
            <table class="table table-custom mb-0">
                <thead>
                    <tr id="header_dinamis">
                        <th style="width: 60px;">No</th>
                        <th>Nama Produk Kain</th>
                        <th>Material Bahan</th>
                        <th>Varian Warna</th>
                        <th class="text-center">Stok Saat Ini</th>
                        <th class="text-center" style="background: rgba(46, 125, 50, 0.05); width: 180px;">Jumlah Stok Baru</th>
                        <th style="width: 50px;">Aksi</th>
                    </tr>
                </thead>
                <tbody id="body_dinamis">
                    <tr id="row_prod_12">
                        <td>1</td>
                        <td><div class="fw-bold text-dark">Merah Maroon</div><small class="text-muted">ID: #12</small></td>
                        <td><span class="badge bg-info bg-opacity-10 text-info">Rayon</span></td>
                        <td>Merah Maroon (Nuansa Merah)</td>
                        <td class="text-center font-monospace fw-bold text-danger">10.00 meter</td>
                        <td class="text-center" style="background: rgba(46, 125, 50, 0.01);">
                            <input type="number" name="stok[12]" class="input-stok-bulk" value="10.00" step="0.1" min="0">
                        </td>
                        <td>
                            <button type="button" class="btn-remove-row" onclick="removeRow('row_prod_12')" title="Keluarkan dari daftar">
                                <i class="fas fa-times"></i>
                            </button>
                        </td>
                    </tr>
                    <tr id="row_prod_13">
                        <td>2</td>
                        <td><div class="fw-bold text-dark">Merah Hati</div><small class="text-muted">ID: #13</small></td>
                        <td><span class="badge bg-info bg-opacity-10 text-info">Rayon</span></td>
                        <td>Merah Hati (Nuansa Merah)</td>
                        <td class="text-center font-monospace fw-bold text-low">5.00 meter</td>
                        <td class="text-center" style="background: rgba(46, 125, 50, 0.01);">
                            <input type="number" name="stok[13]" class="input-stok-bulk" value="5.00" step="0.1" min="0">
                        </td>
                        <td>
                            <button type="button" class="btn-remove-row" onclick="removeRow('row_prod_13')" title="Keluarkan dari daftar">
                                <i class="fas fa-times"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>

    <div id="area_empty_state" class="text-center py-5" style="display: none;">
        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
        <h5 class="fw-bold text-dark">Daftar Preview Kosong</h5>
        <p class="text-muted mb-0">Silakan gunakan filter atau masukkan pencarian kain terlebih dahulu.</p>
    </div>
</div>

<script>
    const jenisLaporan = document.getElementById('jenis_laporan');
    const panelPencarian = document.getElementById('panel_pencarian_stok');
    const boxFilterWaktu = document.getElementById('box_filter_waktu');
    
    const previewTitle = document.getElementById('preview_title');
    const previewSubtitle = document.getElementById('preview_subtitle');
    const btnSaveBulk = document.getElementById('btn_save_bulk');
    const headerDinamis = document.getElementById('header_dinamis');
    const bodyDinamis = document.getElementById('body_dinamis');
    const areaTabelPreview = document.getElementById('area_tabel_preview');
    const areaEmptyState = document.getElementById('area_empty_state');
    const inputSearchBulk = document.getElementById('input_search_bulk');

    // Set untuk menyimpan ID produk yang sudah masuk ke dalam daftar agar tidak duplikat
    let addedProductIds = new Set([12, 13]); // ID 12 & 13 adalah bawaan hardcode tabel awal

    // 1. Menangani Perpindahan Menu Aktivitas
    jenisLaporan.addEventListener('change', function() {
        if (this.value === 'barang_masuk') {
            panelPencarian.style.display = 'block';
            boxFilterWaktu.style.display = 'none';
            btnSaveBulk.style.display = 'inline-flex';
            previewTitle.innerText = "Daftar Pembaruan Kuantitas Stok Kain";
            previewSubtitle.innerText = "Kain-kain di bawah siap ditambahkan jumlah stok masuknya secara serentak.";
            
            headerDinamis.innerHTML = `
                <th style="width: 60px;">No</th>
                <th>Nama Produk Kain</th>
                <th>Material Bahan</th>
                <th>Varian Warna</th>
                <th class="text-center">Stok Saat Ini</th>
                <th class="text-center" style="background: rgba(46, 125, 50, 0.05); width: 180px;">Jumlah Stok Baru</th>
                <th style="width: 50px;">Aksi</th>
            `;
            checkEmptyState();
        } else {
            panelPencarian.style.display = 'none';
            boxFilterWaktu.style.display = 'block';
            btnSaveBulk.style.display = 'none';
            areaTabelPreview.style.display = 'block';
            areaEmptyState.style.display = 'none';

            if (this.value === 'barang_keluar') {
                previewTitle.innerText = "Pratinjau Data Distribusi Kain Keluar";
                previewSubtitle.innerText = "Riwayat pengeluaran log komoditas kain berdasarkan pesanan lunas.";
                headerDinamis.innerHTML = `
                    <th>No</th><th>ID Order</th><th>Nama Kain</th><th>Tanggal Keluar</th><th class="text-center">Kuantitas Keluar</th><th class="text-end">Subtotal Nilai</th>
                `;
                bodyDinamis.innerHTML = `<tr><td>1</td><td>#TMR-1779785492-162</td><td><span class="fw-bold text-dark">Merah Darah</span></td><td>26/05/2026</td><td class="text-center fw-bold text-dark">1.00 meter</td><td class="text-end font-monospace">Rp 20.000</td></tr>`;
            } else if (this.value === 'pendapatan') {
                previewTitle.innerText = "Pratinjau Arus Kas Pendapatan Toko";
                previewSubtitle.innerText = "Rangkuman omzet finansial butik dari transaksi penjualan sukses.";
                headerDinamis.innerHTML = `
                    <th>No</th><th>ID Order</th><th>Tanggal Pembayaran</th><th>Metode</th><th class="text-end">Ongkos Kirim</th><th class="text-end" style="color: #c5a059;">Total Belanja</th>
                `;
                bodyDinamis.innerHTML = `<tr><td>1</td><td>#TMR-1780032672-864</td><td>29/05/2026</td><td><span class="badge bg-dark text-white">QRIS</span></td><td class="text-end font-monospace">Rp 42.000</td><td class="text-end font-monospace fw-bold text-dark">Rp 220.000</td></tr>`;
            }
        }
    });

    // 2. Fungsi AJAX Live Search saat menekan Enter di Search Bar Massal
    inputSearchBulk.addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            fetchProductData(this.value.trim());
            this.value = '';
        }
    });

    document.getElementById('btn_trigger_add').addEventListener('click', function() {
        fetchProductData(inputSearchBulk.value.trim());
        inputSearchBulk.value = '';
    });

    function fetchProductData(keyword) {
        if (!keyword) return;

        // Mengirim request pencarian data kain secara asinkron ke controller backend
        fetch(`<?= base_url('admin/laporan/search-produk') ?>?keyword=${encodeURIComponent(keyword)}`)
            .then(response => response.json())
            .then(products => {
                if (products.length === 0) {
                    alert(`Kain dengan kata kunci "${keyword}" tidak ditemukan.`);
                    return;
                }
                
                // Tambahkan semua produk hasil pencarian yang cocok ke dalam tabel preview
                products.forEach(product => {
                    addProductToTable(product);
                });
            })
            .catch(error => {
                console.error('Error fetching search results:', error);
                alert('Terjadi kendala saat menghubungi server.');
            });
    }

    function addProductToTable(product) {
        // Cegah duplikasi entri produk yang sama ke dalam tabel bulk update
        if (addedProductIds.has(parseInt(product.id))) {
            return; 
        }

        addedProductIds.add(parseInt(product.id));
        areaTabelPreview.style.display = 'block';
        areaEmptyState.style.display = 'none';

        const rowCount = bodyDinamis.querySelectorAll('tr').length + 1;
        const formattedStok = parseFloat(product.stok).toFixed(2);

        const newRowHtml = `
            <tr id="row_prod_${product.id}">
                <td>${rowCount}</td>
                <td><div class="fw-bold text-dark">${product.nama_produk}</div><small class="text-muted">ID: #${product.id}</small></td>
                <td><span class="badge bg-info bg-opacity-10 text-info">${product.nama_bahan}</span></td>
                <td>${product.nama_varian} (${product.nama_kelompok})</td>
                <td class="text-center font-monospace fw-bold ${product.stok < 10 ? 'text-danger' : 'text-success'}">${formattedStok} ${product.satuan_jual}</td>
                <td class="text-center" style="background: rgba(46, 125, 50, 0.01);">
                    <input type="number" name="stok[${product.id}]" class="input-stok-bulk" value="${formattedStok}" step="0.1" min="0">
                </td>
                <td>
                    <button type="button" class="btn-remove-row" onclick="removeRow('row_prod_${product.id}', ${product.id})">
                        <i class="fas fa-times"></i>
                    </button>
                </td>
            </tr>
        `;
        bodyDinamis.insertAdjacentHTML('beforeend', newRowHtml);
        reorderTableNumbers();
    }

    // 3. Menghapus Baris dari List Bulk Update
    window.removeRow = function(rowId, productId) {
        const row = document.getElementById(rowId);
        if (row) {
            row.remove();
            if (productId) addedProductIds.delete(parseInt(productId));
            checkEmptyState();
            reorderTableNumbers();
        }
    };

    function reorderTableNumbers() {
        bodyDinamis.querySelectorAll('tr').forEach((tr, idx) => {
            const firstTd = tr.querySelector('td:first-child');
            if (firstTd) firstTd.innerText = idx + 1;
        });
    }

    function checkEmptyState() {
        const sisaBaris = bodyDinamis.querySelectorAll('tr').length;
        if (sisaBaris === 0) {
            areaTabelPreview.style.display = 'none';
            areaEmptyState.style.display = 'block';
        } else {
            areaTabelPreview.style.display = 'block';
            areaEmptyState.style.display = 'none';
        }
    }

    // 4. AJAX POST: Menyimpan Perubahan Kuantitas Banyak Stok Sekaligus ke DB
    btnSaveBulk.addEventListener('click', function() {
        const formElement = document.getElementById('form_bulk_stok');
        const formData = new FormData(formElement);

        if (bodyDinamis.querySelectorAll('tr').length === 0) {
            alert('Daftar item kosong. Silakan cari dan tambahkan kain terlebih dahulu.');
            return;
        }

        btnSaveBulk.disabled = true;
        btnSaveBulk.innerHTML = `<i class="fas fa-spinner fa-spin"></i> Menyimpan...`;

        fetch('<?= base_url('admin/laporan/update-stok-bulk') ?>', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(res => {
            alert(res.message);
            if (res.success) {
                // Refresh halaman untuk memperbarui nilai state "Stok Saat Ini" dari DB terupdate
                location.reload();
            }
        })
        .catch(error => {
            console.error('Error executing bulk update:', error);
            alert('Gagal mengeksekusi pembaruan data massal.');
        })
        .finally(() => {
            btnSaveBulk.disabled = false;
            btnSaveBulk.innerHTML = `<i class="fas fa-save"></i> Simpan Semua Perubahan Stok`;
        });
    });
</script>

<?= $this->endSection() ?>