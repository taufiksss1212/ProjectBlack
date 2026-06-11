<?= $this->extend('layout/template'); // REVISI UTAMA: Mengextend layout dari folder layout/tamplate.php 
?>

<?= $this->section('content'); ?>
<div style="height: 90px;"></div>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <div class="mb-4">
                <h3 class="fw-bold text-dark" style="font-family: 'Playfair Display', serif;">Riwayat Pesanan Saya</h3>
                <p class="text-muted small">Pantau status pembayaran, pengiriman, dan riwayat belanja kain Anda.</p>
            </div>

            <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success border-0 shadow-sm rounded-3 mb-4">
                <i class="fas fa-check-circle me-2"></i> <?= session()->getFlashdata('success') ?>
            </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger border-0 shadow-sm rounded-3 mb-4">
                <i class="fas fa-exclamation-triangle me-2"></i> <?= session()->getFlashdata('error') ?>
            </div>
            <?php endif; ?>

            <div class="card border-0 shadow-sm mb-4 rounded-3" style="background: white;">
                <div class="card-body p-0">
                    <div class="d-flex text-center overflow-x-auto border-bottom">
                        <?php
                        $tabs = [
                            'semua'     => 'Semua',
                            'pending'   => 'Belum Bayar',
                            'paid'      => 'Diproses',
                            'shipped'   => 'Dikirim',
                            'completed' => 'Selesai',
                            'canceled'  => 'Dibatalkan'
                        ];
                        foreach ($tabs as $key => $label) :
                            $isActive = ($tab_active === $key);
                        ?>
                        <a href="<?= base_url('pesanan/' . $key) ?>"
                            class="flex-fill py-3 px-3 text-decoration-none fw-medium transition-all small text-uppercase tracking-wider border-bottom-3"
                            style="color: <?= $isActive ? 'var(--gold)' : '#666' ?>; 
                                      border-bottom: <?= $isActive ? '3px solid var(--gold)' : '3px solid transparent' ?>;
                                      font-weight: <?= $isActive ? '700' : '500' ?>;
                                      white-space: nowrap;">
                            <?= $label ?>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <?php if (empty($pesanan)) : ?>
            <div class="card border-0 shadow-sm text-center py-5 rounded-3 bg-white">
                <div class="card-body py-5">
                    <i class="fas fa-box-open fa-4x mb-3 opacity-20" style="color: var(--gold);"></i>
                    <h5 class="fw-bold text-dark">Belum Ada Pesanan</h5>
                    <p class="text-muted small">Tidak ada transaksi yang ditemukan pada kategori ini.</p>
                    <a href="<?= base_url('katalog') ?>" class="btn-gold-outline py-2 px-4 fs-6 mt-2"
                        style="text-transform: none;">Mulai Belanja Kain</a>
                </div>
            </div>
            <?php else : ?>
            <?php foreach ($pesanan as $row) :
                    $status = strtolower($row['status_pesanan'] ?? 'pending');
                ?>
            <div class="card border-0 shadow-sm mb-4 rounded-3 bg-white border-start-custom" style="border-left: 4px solid <?php
                                                        if ($status == 'pending') echo '#ffc107';
                                                        elseif ($status == 'paid' || $status == 'success') echo '#0dcaf0';
                                                        elseif ($status == 'shipped') echo '#0d6efd';
                                                        elseif ($status == 'completed') echo '#198754';
                                                        else echo '#dc3545';
                                                        ?>;">
                <div class="card-body p-4">

                    <div
                        class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3 flex-wrap gap-2">
                        <div class="d-flex align-items-center gap-2">
                            <span class="text-muted small">No. Pesanan:</span>
                            <strong class="text-dark tracking-wide"><?= $row['order_id'] ?></strong>
                            <span class="text-muted mx-1">|</span>
                            <span
                                class="text-muted small"><?= date('d M Y, H:i', strtotime($row['created_at'])) ?></span>
                        </div>
                        <div>
                            <?php
                                    $badge_class = 'bg-secondary';
                                    $status_label = strtoupper($status);
                                    if ($status == 'pending') {
                                        $badge_class = 'bg-warning text-dark';
                                        $status_label = 'BELUM BAYAR';
                                    } elseif ($status == 'paid' || $status == 'success') {
                                        $badge_class = 'bg-info text-dark';
                                        $status_label = 'SEDANG DIPROSES';
                                    } elseif ($status == 'shipped') {
                                        $badge_class = 'bg-primary text-white';
                                        $status_label = 'DALAM PENGIRIMAN';
                                    } elseif ($status == 'completed') {
                                        $badge_class = 'bg-success text-white';
                                        $status_label = 'SELESAI';
                                    } elseif ($status == 'canceled') {
                                        $badge_class = 'bg-danger text-white';
                                        $status_label = 'DIBATALKAN';
                                    }
                                    ?>
                            <span class="badge <?= $badge_class ?> px-3 py-2 rounded-pill small fw-bold"
                                style="letter-spacing: 0.5px;"><?= $status_label ?></span>
                        </div>
                    </div>

                    <div class="row align-items-center py-2 text-dark">
                        <div class="col-md-7 mb-3 mb-md-0">
                            <div class="d-flex align-items-start gap-2 mb-2">
                                <i class="fas fa-map-marker-alt text-muted mt-1" style="width: 15px;"></i>
                                <div class="small text-truncate text-secondary">
                                    <strong>Alamat Pengiriman:</strong> <?= $row['alamat_lengkap'] ?>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <i class="fas fa-truck text-muted" style="width: 15px;"></i>
                                <span class="small text-uppercase fw-bold text-secondary"><?= $row['kurir'] ?> -
                                    <?= $row['layanan_kurir'] ?></span>
                            </div>
                        </div>
                        <div class="col-md-5 text-md-end border-start-md">
                            <span class="text-muted small d-block">Total Tagihan</span>
                            <h4 class="fw-bold mb-0 mt-1" style="color: var(--gold);">Rp
                                <?= number_format($row['gross_amount'], 0, ',', '.') ?></h4>
                        </div>
                    </div>

                    <div class="border-top pt-3 mt-3 d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <div>
                            <?php if ($status == 'shipped' && !empty($row['no_resi'])) : ?>
                            <small class="text-muted"><i class="fas fa-barcode me-1"></i> No. Resi Pelacakan: <strong
                                    class="text-dark"><?= $row['no_resi'] ?></strong></small>
                            <?php endif; ?>
                        </div>

                        <div class="d-flex gap-2">
                            <?php if ($status == 'pending') : ?>
                            <?php
                                        $snap = json_decode($row['snap_token'], true);
                                        $pay_url = $snap['data']['payment_url'] ?? '#';
                                        ?>
                            <a href="<?= $pay_url ?>" target="_blank"
                                class="btn btn-sm btn-warning fw-bold px-4 py-2 rounded-pill shadow-sm text-dark">
                                <i class="fas fa-credit-card me-2"></i> Bayar Sekarang
                            </a>
                            <?php endif; ?>

                            <?php if ($status == 'shipped') : ?>
                            <form action="<?= base_url('pesanan/terima-barang/' . $row['order_id']) ?>" method="POST"
                                onsubmit="return confirm('Apakah Anda yakin kain pesanan Anda sudah diterima dengan baik dan sesuai? Aksi ini tidak dapat dibatalkan.');">
                                <?= csrf_field() ?>
                                <button type="submit"
                                    class="btn btn-sm btn-success fw-bold px-4 py-2 rounded-pill shadow-sm">
                                    <i class="fas fa-check-double me-2"></i> Konfirmasi Barang Diterima
                                </button>
                            </form>
                            <?php endif; ?>

                            <?php if ($status == 'completed') : ?>
                            <button class="btn btn-sm btn-outline-success fw-bold px-4 py-2 rounded-pill disabled">
                                <i class="fas fa-check-circle me-2"></i> Transaksi Sukses
                            </button>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>

        </div>
    </div>
</div>

<style>
.border-start-custom {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.border-start-custom:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08) !important;
}

@media (min-width: 768px) {
    .border-start-md {
        border-left: 1px solid #eee;
        padding-left: 20px;
    }
}
</style>
<?= $this->endSection(); ?>s