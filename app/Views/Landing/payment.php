<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container py-5" style="min-height: 80vh;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0" style="border-radius: 20px;">
                <div class="card-header bg-dark text-white text-center py-4"
                    style="border-top-left-radius: 20px; border-top-right-radius: 20px; border-bottom: 3px solid var(--gold);">
                    <h4 class="mb-0 playfair fw-bold text-gold">Detail Pembayaran</h4>
                </div>

                <div class="card-body p-4 p-md-5">
                    <?php
                    // Decode respon JSON dari database
                    $snap_token = json_decode($order['snap_token'], true);

                    // Struktur Komerce: Cek status di dalam objek 'meta'
                    $isSuccess = isset($snap_token['meta']['status']) && $snap_token['meta']['status'] === 'success';
                    $dataApi = $snap_token['data'] ?? [];

                    if (!$isSuccess):
                    ?>
                    <div class="alert alert-danger border-danger">
                        <h5 class="alert-heading"><i class="fas fa-exclamation-triangle"></i> Gagal Memproses Pembayaran
                        </h5>
                        <p>Sistem Komerce menolak permintaan transaksi ini.</p>
                        <hr>
                        <p class="mb-0"><strong>Raw Response:</strong></p>
                        <pre class="bg-light p-2 mt-2 text-dark"
                            style="font-size: 13px; overflow-x: auto;"><?= print_r($snap_token, true) ?></pre>
                    </div>
                    <a href="<?= base_url('checkout') ?>" class="btn btn-secondary mt-3">Kembali ke Checkout</a>

                    <?php else: ?>
                    <div class="alert alert-success text-center mb-4">
                        <i class="fas fa-check-circle fs-4 mb-2 d-block"></i>
                        <strong>Pesanan berhasil dibuat!</strong>
                    </div>

                    <div class="mb-4 text-center">
                        <p class="text-muted mb-1 text-uppercase small letter-spacing-2">Order ID</p>
                        <h6 class="fw-bold badge bg-warning text-dark px-3 py-2 fs-6"><?= $order['order_id'] ?></h6>
                    </div>

                    <div class="p-4 bg-light rounded-4 text-center mb-4 border">
                        <p class="text-muted mb-1 text-uppercase small letter-spacing-2">Total Tagihan</p>
                        <h1 class="display-5 fw-bold text-gold mb-0">Rp
                            <?= number_format($order['gross_amount'], 0, ',', '.') ?></h1>
                    </div>

                    <?php if ($order['payment_type'] === 'QRIS'): ?>
                    <div class="text-center p-4 border rounded-4 border-primary bg-white shadow-sm">
                        <h5 class="fw-bold mb-4">Scan QRIS Berikut:</h5>
                        <?php
                                $qrString = $dataApi['qr_string'] ?? '';
                                if ($qrString):
                                ?>
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=<?= urlencode($qrString) ?>"
                            class="img-fluid border p-2 rounded-4 shadow-sm" alt="QRIS" style="width: 250px;">
                        <?php else: ?>
                        <p class="text-danger">Data QR String tidak ditemukan dari server Komerce.</p>
                        <?php endif; ?>
                        <p class="text-muted small mt-4">Buka aplikasi e-Wallet (GoPay, OVO, DANA) atau m-Banking Anda,
                            pilih menu QRIS, dan scan kode di atas.</p>
                    </div>

                    <?php else: ?>
                    <div class="p-4 border rounded-4 border-primary text-center bg-white shadow-sm">
                        <p class="text-muted mb-1 text-uppercase small letter-spacing-2">Bank Tujuan</p>
                        <h4 class="text-primary fw-bold mb-4"><?= strtoupper($order['payment_type']) ?></h4>
                        <hr class="opacity-25">
                        <p class="text-muted mb-2 text-uppercase small letter-spacing-2 mt-4">No. Virtual Account</p>

                        <h2 class="fw-bold text-dark tracking-wide py-2 px-3 bg-light d-inline-block rounded"
                            style="letter-spacing: 3px;">
                            <?= $dataApi['account_number'] ?? $dataApi['va_number'] ?? 'TIDAK DITEMUKAN' ?>
                        </h2>
                        <p class="text-muted small mt-4">Silakan transfer tepat sesuai nominal tagihan ke nomor Virtual
                            Account di atas.</p>
                    </div>
                    <?php endif; ?>

                    <?php if (isset($dataApi['payment_url'])): ?>
                    <div class="mt-4 p-3 bg-warning bg-opacity-10 border border-warning rounded text-center">
                        <p class="small text-dark mb-2"><i class="fas fa-info-circle"></i> <strong>Mode
                                Testing:</strong> Klik tombol di bawah ini untuk mensimulasikan pembayaran agar status
                            berubah menjadi LUNAS.</p>
                        <a href="<?= $dataApi['payment_url'] ?>" target="_blank"
                            class="btn btn-warning fw-bold shadow-sm">
                            <i class="fas fa-external-link-alt"></i> BUKA HALAMAN SIMULASI KOMERCE
                        </a>
                    </div>
                    <?php endif; ?>

                    <div class="mt-5 text-center">
                        <a href="<?= base_url('/') ?>"
                            class="btn btn-outline-dark rounded-pill px-5 py-2 fw-bold">KEMBALI KE BERANDA</a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>