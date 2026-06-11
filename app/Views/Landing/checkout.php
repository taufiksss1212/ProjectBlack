<?= $this->extend('layout/template'); ?>

<?= $this->section('styles'); ?>
<style>
    .checkout-section {
        padding: 60px 0;
        background-color: #f9ffff;
        min-height: 80vh;
    }

    .checkout-card {
        background: white;
        border-radius: 15px;
        border: none;
        box-shadow: 0 5px 25px rgba(0, 0, 0, 0.03);
        padding: 30px;
    }

    .form-label {
        font-weight: 600;
        font-size: 0.85rem;
        color: #555;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .form-control,
    .form-select {
        border-radius: 8px;
        padding: 12px 15px;
        border-color: #eee;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--gold);
        box-shadow: 0 0 0 0.2rem rgba(212, 175, 55, 0.25);
    }

    .summary-card {
        background: #0f2027;
        color: white;
        border-radius: 15px;
        padding: 30px;
        position: sticky;
        top: 100px;
    }

    .cart-item-checkout {
        display: flex;
        justify-content: space-between;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        padding-bottom: 15px;
        margin-bottom: 15px;
    }

    .total-row {
        display: flex;
        justify-content: space-between;
        font-size: 1.1rem;
        margin-bottom: 10px;
    }

    .grand-total {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--gold);
        border-top: 2px dashed rgba(255, 255, 255, 0.2);
        padding-top: 15px;
        margin-top: 15px;
    }
</style>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<section class="checkout-section">
    <div class="container">
        <h2 class="mb-4 fw-bold playfair">Pengiriman & Pembayaran</h2>

        <form id="formCheckout" action="<?= site_url('checkout/process') ?>" method="POST">
            <?= csrf_field(); ?>
            <div class="row g-4">

                <div class="col-lg-7">
                    <div class="checkout-card">
                        <h5 class="fw-bold mb-4 border-bottom pb-3"><i class="fas fa-map-marker-alt text-gold me-2"></i>
                            Detail Pengiriman</h5>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama_pembeli" class="form-control"
                                    value="<?= session()->get('customer_nama') ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">No. Handphone</label>
                                <input type="text" name="no_hp" class="form-control" placeholder="Contoh: 0812xxx"
                                    required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Provinsi</label>
                            <select id="provinsi" name="provinsi_id" class="form-select" required>
                                <option value="">-- Pilih Provinsi --</option>
                                <?php if (isset($provinsi['data'])): ?>
                                    <?php foreach ($provinsi['data'] as $prov): ?>
                                        <option value="<?= $prov['id'] ?>"><?= $prov['name'] ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <input type="hidden" name="provinsi_nama" id="provinsi_nama">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kota / Kabupaten</label>
                            <select id="kota" name="kota_id" class="form-select" required disabled>
                                <option value="">-- Pilih Kota/Kabupaten --</option>
                            </select>
                            <input type="hidden" name="kota_nama" id="kota_nama">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alamat Lengkap</label>
                            <textarea name="alamat_lengkap" class="form-control" rows="3"
                                placeholder="Nama Jalan, Gedung, No. Rumah, RT/RW, Kecamatan, Kode Pos"
                                required></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Pilih Kurir</label>
                            <select id="kurir" name="kurir" class="form-select" required disabled>
                                <option value="">-- Pilih Kurir --</option>
                                <option value="jne">JNE</option>
                                <option value="pos">POS Indonesia</option>
                                <option value="tiki">TIKI</option>
                                <option value="sicepat">SiCepat</option>
                                <option value="jnt">J&T Express</option>
                            </select>
                        </div>

                        <div id="layananKurirContainer" class="mb-3 d-none">
                            <label class="form-label">Pilih Layanan</label>
                            <select id="layanan_kurir" name="layanan_kurir" class="form-select" required>
                                <option value="">-- Pilih Layanan --</option>
                            </select>
                            <input type="hidden" name="ongkir" id="ongkir_value" value="0">
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="summary-card">
                        <h5 class="fw-bold mb-4 playfair">Ringkasan Pesanan</h5>

                        <div class="cart-items mb-4">
                            <?php
                            $totalBelanja = 0;
                            foreach ($cart as $item):
                                $totalBelanja += $item['subtotal'];
                            ?>
                                <div class="cart-item-checkout">
                                    <div>
                                        <h6 class="mb-1 text-truncate" style="max-width: 200px;"><?= $item['nama_produk'] ?>
                                        </h6>
                                        <small class="text-white-50"><?= $item['qty'] ?>
                                            <?= $item['satuan_jual'] ?? 'meter' ?> x Rp
                                            <?= number_format($item['harga'], 0, ',', '.') ?></small>
                                    </div>
                                    <div class="fw-bold text-gold">Rp <?= number_format($item['subtotal'], 0, ',', '.') ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="total-row">
                            <span class="text-white-50">Total Belanja</span>
                            <span>Rp <?= number_format($totalBelanja, 0, ',', '.') ?></span>
                        </div>
                        <div class="total-row">
                            <span class="text-white-50">Total Berat</span>
                            <span><?= number_format($berat, 0, ',', '.') ?> gram</span>
                        </div>
                        <div class="total-row">
                            <span class="text-white-50">Ongkos Kirim</span>
                            <span id="displayOngkir">Rp 0</span>
                        </div>

                        <div class="total-row grand-total">
                            <span>Total Tagihan</span>
                            <span id="displayGrandTotal">Rp <?= number_format($totalBelanja, 0, ',', '.') ?></span>
                        </div>

                        <div class="mt-4 pt-3 border-top" style="border-color: rgba(255,255,255,0.2) !important;">
                            <h6 class="mb-3 fw-bold text-white">Metode Pembayaran</h6>
                            <select name="payment_method" class="form-select bg-dark text-white border-secondary mb-4"
                                required>
                                <option value="">-- Pilih Pembayaran --</option>
                                <option value="QRIS">QRIS (Scan Barcode)</option>
                                <option value="BCA">Transfer VA - Bank BCA</option>
                                <option value="BNI">Transfer VA - Bank BNI</option>
                                <option value="MANDIRI">Transfer VA - Bank Mandiri</option>
                                <option value="BRI">Transfer VA - Bank BRI</option>
                            </select>
                        </div>

                        <button type="button" id="btnPay" class="btn w-100 fw-bold mt-4"
                            style="background: var(--gold); color: black; padding: 15px; font-size: 1.1rem; border-radius: 10px;"
                            disabled>
                            LANJUT PEMBAYARAN
                        </button>
                        <small class="d-block text-center mt-3 text-white-50"><i class="fas fa-shield-alt me-1"></i>
                            Pembayaran Aman by Komerce</small>
                    </div>
                </div>

            </div>
        </form>
    </div>
</section>

<input type="hidden" id="berat_total" value="<?= $berat ?>">
<input type="hidden" id="total_belanja" value="<?= $totalBelanja ?>">

<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script>
    const formatUang = (number) => {
        return new Intl.NumberFormat('id-ID').format(number);
    };

    // 1. Saat Provinsi Berubah, Ambil Kota
    document.getElementById('provinsi').addEventListener('change', function() {
        let provId = this.value;
        let kotaSelect = document.getElementById('kota');
        let kurirSelect = document.getElementById('kurir');

        if (provId) document.getElementById('provinsi_nama').value = this.options[this.selectedIndex].text;

        kotaSelect.innerHTML = '<option value="">Loading...</option>';
        kotaSelect.disabled = true;
        kurirSelect.value = '';
        kurirSelect.disabled = true;
        resetOngkir();

        if (provId) {
            fetch('<?= site_url('checkout/get_city/') ?>' + provId)
                .then(response => response.json())
                .then(data => {
                    let json = typeof data === 'string' ? JSON.parse(data) : data;
                    let results = json.data;

                    let options = '<option value="">-- Pilih Kota/Kabupaten --</option>';
                    if (results && results.length > 0) {
                        results.forEach(kota => {
                            options += `<option value="${kota.id}">${kota.name}</option>`;
                        });
                    }
                    kotaSelect.innerHTML = options;
                    kotaSelect.disabled = false;
                })
                .catch(err => {
                    console.error("Gagal mengambil data kota:", err);
                    kotaSelect.innerHTML = '<option value="">Gagal memuat kota</option>';
                });
        }
    });

    // 2. Saat Kota Berubah, Buka Kurir
    document.getElementById('kota').addEventListener('change', function() {
        let kotaId = this.value;
        if (kotaId) document.getElementById('kota_nama').value = this.options[this.selectedIndex].text;

        document.getElementById('kurir').disabled = (kotaId === '');
        document.getElementById('kurir').value = '';
        resetOngkir();
    });

    // 3. Saat Kurir Berubah, Ambil Harga Ongkir
    document.getElementById('kurir').addEventListener('change', function() {
        let kurir = this.value;
        let kota = document.getElementById('kota').value;
        let berat = document.getElementById('berat_total').value;
        let layananSelect = document.getElementById('layanan_kurir');
        let containerLayanan = document.getElementById('layananKurirContainer');

        resetOngkir();

        if (kurir !== '' && kota !== '') {
            containerLayanan.classList.remove('d-none');
            layananSelect.innerHTML = '<option value="">Menghitung Ongkir...</option>';

            let formData = new FormData();
            formData.append('destination', kota);
            formData.append('weight', berat);
            formData.append('courier', kurir);

            fetch('<?= site_url('checkout/get_cost') ?>', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    let json = typeof data === 'string' ? JSON.parse(data) : data;
                    let results = json.data;

                    let options = '<option value="">-- Pilih Layanan --</option>';

                    if (results && results.length > 0) {
                        results.forEach(layanan => {
                            let harga = layanan.cost || 0;
                            let etd = layanan.etd ? layanan.etd : 'Reguler';
                            let namaLayanan = layanan.service ? layanan.service : layanan.name;

                            options += `<option value="${harga}" data-nama="${namaLayanan}">
                                        ${layanan.name} (${namaLayanan}) - Rp ${formatUang(harga)} [${etd}]
                                    </option>`;
                        });
                    } else {
                        options = '<option value="">Kurir tidak tersedia di rute ini</option>';
                    }
                    layananSelect.innerHTML = options;
                })
                .catch(err => {
                    console.error("Gagal menghitung ongkir:", err);
                    layananSelect.innerHTML = '<option value="">Gagal menghitung ongkir</option>';
                });
        } else {
            containerLayanan.classList.add('d-none');
        }
    });

    // 4. Saat Layanan Dipilih, Update Total Tagihan
    document.getElementById('layanan_kurir').addEventListener('change', function() {
        let ongkir = parseInt(this.value) || 0;
        let totalBelanja = parseInt(document.getElementById('total_belanja').value);
        let grandTotal = totalBelanja + ongkir;

        document.getElementById('ongkir_value').value = ongkir;
        document.getElementById('displayOngkir').innerText = 'Rp ' + formatUang(ongkir);
        document.getElementById('displayGrandTotal').innerText = 'Rp ' + formatUang(grandTotal);

        document.getElementById('btnPay').disabled = (ongkir === 0);
    });

    function resetOngkir() {
        document.getElementById('layananKurirContainer').classList.add('d-none');
        document.getElementById('layanan_kurir').innerHTML = '<option value="">-- Pilih Layanan --</option>';
        document.getElementById('ongkir_value').value = 0;
        document.getElementById('displayOngkir').innerText = 'Rp 0';
        document.getElementById('displayGrandTotal').innerText = 'Rp ' + formatUang(document.getElementById('total_belanja')
            .value);
        document.getElementById('btnPay').disabled = true;
    }

    // 5. Submit Form dengan Validasi
    document.getElementById('btnPay').addEventListener('click', function(e) {
        e.preventDefault();
        let form = document.getElementById('formCheckout');

        if (form.reportValidity()) {
            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> MEMPROSES...';
            this.disabled = true;
            form.submit();
        }
    });
</script>
<?= $this->endSection(); ?>