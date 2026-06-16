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

    .btn-gold {
        background: #c5a059;
        color: white;
        border-radius: 8px;
        font-weight: 600;
        padding: 10px 20px;
        transition: 0.3s;
        border: none;
    }

    .btn-gold:hover {
        background: #a68545;
        color: white;
        transform: translateY(-2px);
    }

    .table-modern th {
        background: #f8f9fa;
        color: #495057;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e9ecef;
        padding: 15px;
    }

    .table-modern td {
        padding: 15px;
        vertical-align: middle;
        color: #2d3436;
        font-size: 0.95rem;
        border-bottom: 1px solid #f1f3f5;
    }

    .input-stok {
        width: 100px;
        border: 2px solid #e9ecef;
        border-radius: 6px;
        padding: 6px 12px;
        text-align: center;
        font-weight: bold;
    }

    .input-stok:focus {
        border-color: #c5a059;
        outline: none;
    }

    .summary-box {
        background: #fff;
        border: 1px solid #eee;
        border-left: 4px solid #c5a059;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
    }
</style>

<div class="content-wrapper">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1" style="font-family: 'Playfair Display', serif; color: #1a1a1a;">Pusat Laporan &
                Stok</h2>
            <p class="text-muted mb-0">Kelola inventaris dan pantau laporan keuangan otomatis Tamara Textile.</p>
        </div>
    </div>

    <div class="card-clean mb-4">
        <div class="row align-items-end">
            <div class="col-md-6">
                <label class="form-label-clean">Aktivitas Laporan / Inventaris</label>
                <select id="jenis_laporan" class="form-select-clean w-100">
                    <option value="stok">📦 Entri Barang Masuk (Update Stok)</option>
                    <option value="distribusi">🚚 Laporan Distribusi Barang Keluar</option>
                    <option value="keuangan">💰 Laporan Keuangan & Pendapatan Bersih</option>
                </select>
            </div>
            <div class="col-md-4 d-none" id="filterPeriodeContainer">
                <label class="form-label-clean">Filter Periode Waktu</label>
                <select id="filter_periode" class="form-select-clean w-100">
                    <option value="semua">Semua Waktu</option>
                    <option value="hari_ini">Hari Ini</option>
                    <option value="bulan_ini">Bulan Ini</option>
                    <option value="tahun_ini">Tahun Ini</option>
                </select>
            </div>
            <div class="col-md-2 text-end d-none" id="btnCetakContainer">
                <button id="btnCetakPdf" class="btn btn-dark w-100 py-2 mt-3 mt-md-0" style="border-radius: 8px;"><i
                        class="fas fa-file-pdf me-2"></i> Cetak PDF</button>
            </div>
        </div>
    </div>

    <div id="view_stok" class="view-panel">
        <div class="card-clean">
            <h5 class="fw-bold mb-4 border-bottom pb-3">Daftar Antrean Update Stok</h5>
            <div class="position-relative mb-4">
                <i class="fas fa-search position-absolute text-muted" style="top: 15px; left: 15px;"></i>
                <input type="text" id="keyword_kain" class="form-select-clean w-100 ps-5"
                    placeholder="Ketik nama kain yang baru datang (misal: Rayon, Katun) lalu tekan Enter..."
                    style="cursor: text;">
            </div>

            <form id="form_bulk_stok">
                <div class="table-responsive">
                    <table class="table table-modern table-hover w-100">
                        <thead>
                            <tr>
                                <th>Produk Kain</th>
                                <th class="text-center">Kategori</th>
                                <th class="text-center">Stok Saat Ini</th>
                                <th class="text-center" style="width: 200px;">Stok Terbaru</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="table_stok_body">
                            <tr>
                                <td colspan="5" class="text-center text-muted py-5"><i
                                        class="fas fa-box-open fa-2x mb-3 opacity-50"></i><br>Cari dan tambahkan kain ke
                                    daftar ini.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="text-end mt-4">
                    <button type="button" id="btnSaveBulk" class="btn-gold px-4" disabled><i
                            class="fas fa-save me-2"></i> Simpan Perubahan Stok</button>
                </div>
            </form>
        </div>
    </div>

    <div id="view_distribusi" class="view-panel d-none">
        <div class="card-clean">
            <h5 class="fw-bold mb-4 border-bottom pb-3">Riwayat Barang Keluar (Terjual)</h5>
            <div class="table-responsive">
                <table class="table table-modern table-hover w-100">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>No. Order</th>
                            <th>Nama Kain Terjual</th>
                            <th class="text-center">Kuantitas</th>
                            <th class="text-end">Nilai Transaksi</th>
                        </tr>
                    </thead>
                    <tbody id="table_distribusi_body">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="view_keuangan" class="view-panel d-none">
        <div class="row mb-3" id="keuangan_summary">
            <div class="col-md-4">
                <div class="summary-box">
                    <p class="text-muted small text-uppercase mb-1 fw-bold">Total Transaksi</p>
                    <h3 class="fw-bold text-dark mb-0" id="sum_trx">0</h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="summary-box">
                    <p class="text-muted small text-uppercase mb-1 fw-bold">Pendapatan Bersih (Kain)</p>
                    <h3 class="fw-bold text-success mb-0" id="sum_bersih">Rp 0</h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="summary-box">
                    <p class="text-muted small text-uppercase mb-1 fw-bold">Total Pemasukan (Gross)</p>
                    <h3 class="fw-bold text-dark mb-0" id="sum_kotor">Rp 0</h3>
                </div>
            </div>
        </div>
        <div class="card-clean">
            <h5 class="fw-bold mb-4 border-bottom pb-3">Rincian Aliran Dana Pesanan</h5>
            <div class="table-responsive">
                <table class="table table-modern table-hover w-100">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>No. Order</th>
                            <th>Metode Bayar</th>
                            <th class="text-end">Ongkos Kirim</th>
                            <th class="text-end">Nilai Kain</th>
                            <th class="text-end">Total (Gross)</th>
                        </tr>
                    </thead>
                    <tbody id="table_keuangan_body">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script>
    const formatUang = (number) => new Intl.NumberFormat('id-ID').format(number);
    const formatDate = (dateStr) => {
        let d = new Date(dateStr);
        return d.toLocaleDateString('id-ID', {
            day: '2-digit',
            month: 'short',
            year: 'numeric'
        });
    };

    // --- LOGIKA NAVIGASI VIEW & FILTER ---
    const selectJenis = document.getElementById('jenis_laporan');
    const selectPeriode = document.getElementById('filter_periode');
    const filterContainer = document.getElementById('filterPeriodeContainer');
    const btnCetakContainer = document.getElementById('btnCetakContainer');

    const views = {
        stok: document.getElementById('view_stok'),
        distribusi: document.getElementById('view_distribusi'),
        keuangan: document.getElementById('view_keuangan')
    };

    selectJenis.addEventListener('change', function() {
        // Sembunyikan semua view
        Object.values(views).forEach(el => el.classList.add('d-none'));
        // Tampilkan view yang dipilih
        views[this.value].classList.remove('d-none');

        if (this.value === 'stok') {
            filterContainer.classList.add('d-none');
            btnCetakContainer.classList.add('d-none');
        } else {
            filterContainer.classList.remove('d-none');
            btnCetakContainer.classList.remove('d-none');
            loadReportData(this.value, selectPeriode.value);
        }
    });

    selectPeriode.addEventListener('change', function() {
        loadReportData(selectJenis.value, this.value);
    });

    // --- FUNGSI LOAD DATA LAPORAN VIA AJAX ---
    function loadReportData(jenis, periode) {
        let endpoint = jenis === 'distribusi' ? 'get-distribusi' : 'get-keuangan';
        let tbody = jenis === 'distribusi' ? document.getElementById('table_distribusi_body') : document.getElementById(
            'table_keuangan_body');

        tbody.innerHTML =
            `<tr><td colspan="6" class="text-center py-4"><i class="fas fa-spinner fa-spin me-2"></i> Memuat data...</td></tr>`;

        fetch(`<?= base_url('admin/laporan/') ?>${endpoint}?periode=${periode}`)
            .then(res => res.json())
            .then(data => {
                tbody.innerHTML = '';
                if (data.length === 0) {
                    tbody.innerHTML =
                        `<tr><td colspan="6" class="text-center text-muted py-5"><i class="fas fa-folder-open fa-2x mb-3 opacity-50"></i><br>Belum ada data transaksi di periode ini.</td></tr>`;
                    if (jenis === 'keuangan') {
                        document.getElementById('sum_trx').innerText = '0';
                        document.getElementById('sum_bersih').innerText = 'Rp 0';
                        document.getElementById('sum_kotor').innerText = 'Rp 0';
                    }
                    return;
                }

                if (jenis === 'distribusi') {
                    data.forEach(row => {
                        tbody.innerHTML += `
                        <tr>
                            <td>${formatDate(row.created_at)}</td>
                            <td><strong class="text-primary">${row.order_id}</strong></td>
                            <td>${row.nama_produk}</td>
                            <td class="text-center fw-bold">${parseFloat(row.qty)}</td>
                            <td class="text-end">Rp ${formatUang(row.subtotal)}</td>
                        </tr>`;
                    });
                } else if (jenis === 'keuangan') {
                    let totalTrx = data.length;
                    let totalBersih = 0;
                    let totalKotor = 0;

                    data.forEach(row => {
                        totalBersih += parseFloat(row.total_belanja);
                        totalKotor += parseFloat(row.gross_amount);
                        let payment = row.payment_type ? row.payment_type.toUpperCase() : '-';

                        tbody.innerHTML += `
                        <tr>
                            <td>${formatDate(row.created_at)}</td>
                            <td><strong class="text-primary">${row.order_id}</strong></td>
                            <td><span class="badge bg-secondary">${payment}</span></td>
                            <td class="text-end text-muted">Rp ${formatUang(row.ongkir)}</td>
                            <td class="text-end fw-bold text-success">Rp ${formatUang(row.total_belanja)}</td>
                            <td class="text-end fw-bold">Rp ${formatUang(row.gross_amount)}</td>
                        </tr>`;
                    });

                    document.getElementById('sum_trx').innerText = totalTrx;
                    document.getElementById('sum_bersih').innerText = 'Rp ' + formatUang(totalBersih);
                    document.getElementById('sum_kotor').innerText = 'Rp ' + formatUang(totalKotor);
                }
            })
            .catch(err => console.error(err));
    }

    // FUNGSI KLIK TOMBOL CETAK PDF
    document.getElementById('btnCetakPdf').addEventListener('click', function() {
        let jenis = selectJenis.value;
        let periode = selectPeriode.value;
        // Buka tab baru untuk nge-print
        window.open(`<?= base_url('admin/laporan/cetak') ?>?jenis=${jenis}&periode=${periode}`, '_blank');
    });

    // --- LOGIKA LAMA: ENTRI BARANG MASUK (TIDAK ADA YANG DIHAPUS) ---
    const inputKeyword = document.getElementById('keyword_kain');
    const tableStokBody = document.getElementById('table_stok_body');
    const btnSaveBulk = document.getElementById('btnSaveBulk');
    let addedProductIds = new Set();

    inputKeyword.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            const keyword = this.value.trim();
            if (keyword === '') return;

            fetch(`<?= base_url('admin/laporan/search-produk') ?>?keyword=${encodeURIComponent(keyword)}`)
                .then(response => response.json())
                .then(data => {
                    if (data.length === 0) {
                        alert('Kain tidak ditemukan!');
                        return;
                    }
                    if (addedProductIds.size === 0) tableStokBody.innerHTML = '';

                    data.forEach(item => {
                        if (!addedProductIds.has(item.id)) {
                            addedProductIds.add(item.id);
                            const rowHtml = `
<tr id="row_${item.id}">
    <td>
        <div class="d-flex align-items-center">
            <img src="<?= base_url('uploads/products/') ?>${item.gambar_produk}" class="rounded me-3" style="width: 45px; height: 45px; object-fit: cover;">
            <div><h6 class="mb-0 fw-bold">${item.nama_produk}</h6><small class="text-muted">Varian: ${item.nama_varian || '-'}</small></div>
        </div>
    </td>
    <td class="text-center"><span class="badge bg-light text-dark border">${item.nama_bahan || '-'}</span></td>
    <td class="text-center"><span class="fw-bold fs-5">${parseFloat(item.stok)}</span> <small class="text-muted">${item.satuan_jual || 'm'}</small></td>
    
    <td class="text-center"><input type="number" name="stok[${item.id}]" class="input-stok" value="0" min="0" step="any" required></td>
    
    <td class="text-center"><button type="button" class="btn btn-sm btn-outline-danger" onclick="removeRow('${item.id}')"><i class="fas fa-times"></i></button></td>
</tr>
`;
                            tableStokBody.insertAdjacentHTML('beforeend', rowHtml);
                        }
                    });
                    btnSaveBulk.disabled = false;
                    this.value = '';
                })
                .catch(error => console.error('Error fetching data:', error));
        }
    });

    window.removeRow = function(id) {
        document.getElementById('row_' + id).remove();
        addedProductIds.delete(id);
        if (addedProductIds.size === 0) {
            tableStokBody.innerHTML =
                `<tr><td colspan="5" class="text-center text-muted py-5"><i class="fas fa-box-open fa-2x mb-3 opacity-50"></i><br>Cari dan tambahkan kain ke daftar ini.</td></tr>`;
            btnSaveBulk.disabled = true;
        }
    };

    // 4. AJAX POST: Menyimpan Perubahan Kuantitas Banyak Stok Sekaligus ke DB
    btnSaveBulk.addEventListener('click', function() {
        const formElement = document.getElementById('form_bulk_stok');
        const formData = new FormData(formElement);

        btnSaveBulk.disabled = true;
        btnSaveBulk.innerHTML = `<i class="fas fa-spinner fa-spin"></i> Menyimpan...`;

        fetch('<?= base_url('admin/laporan/update-stok-bulk') ?>', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                // TAMBAHKAN BARIS INI UNTUK MENYISIPKAN TOKEN KEAMANAN CI 4
                '<?= csrf_header() ?>': '<?= csrf_hash() ?>'
            }
        })
        .then(res => res.json())
        .then(res => {
            alert(res.message);
            if (res.success) location.reload();
        })
        .catch(error => {
            console.error('Error executing bulk update:', error);
            alert('Gagal mengeksekusi pembaruan data massal.');
        })
        .finally(() => {
            btnSaveBulk.disabled = false;
            btnSaveBulk.innerHTML = `<i class="fas fa-save me-2"></i> Simpan Perubahan Stok`;
        });
    });
</script>
<?= $this->endSection() ?>