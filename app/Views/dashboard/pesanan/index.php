<?= $this->extend('dashboard/layout'); ?>

<?= $this->section('content'); ?>
<div class="page-header mb-4">
    <div class="page-title">
        <h2>Manajemen Pesanan</h2>
        <p>Kelola daftar pesanan masuk, pantau pembayaran, dan status pengiriman.</p>
    </div>
</div>

<?php if (session()->getFlashdata('success')) : ?>
<div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
    <i class="fas fa-check-circle me-2"></i> <?= session()->getFlashdata('success') ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>

<div class="table-card shadow-sm border-0">
    <div class="table-wrapper">
        <table class="product-table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Tanggal</th>
                    <th>Pembeli</th>
                    <th>Total Tagihan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($pesanan)): ?>
                <tr>
                    <td colspan="6" class="text-center py-5 text-muted">
                        <i class="fas fa-inbox fa-3x mb-3 opacity-50"></i>
                        <p class="mb-0">Belum ada pesanan masuk.</p>
                    </td>
                </tr>
                <?php else: ?>
                <?php foreach ($pesanan as $row) : ?>
                <tr>
                    <td class="fw-bold text-dark"><?= $row['order_id'] ?></td>
                    <td class="text-muted small"><?= date('d M Y, H:i', strtotime($row['created_at'] ?? 'now')) ?></td>
                    <td class="text-dark">
                        <?= strtok($row['alamat_lengkap'], '(') ?>
                    </td>
                    <td>
                        <strong style="color: var(--lux-gold);">Rp
                            <?= number_format($row['gross_amount'], 0, ',', '.') ?></strong>
                    </td>
                    <td>
                        <?php
                                // PERBAIKAN: Jika status kosong dari DB, paksa anggap sebagai 'pending'
                                $status_db = strtolower(trim($row['status_pesanan'] ?? ''));
                                if ($status_db == '') {
                                    $status_db = 'pending';
                                }

                                $bg = 'bg-secondary';
                                $label = strtoupper($status_db);

                                if ($status_db == 'pending') {
                                    $bg = 'bg-warning text-dark';
                                    $label = 'PENDING';
                                } elseif ($status_db == 'paid' || $status_db == 'success') {
                                    $bg = 'bg-success text-white';
                                    $label = 'LUNAS (KIRIM)';
                                } elseif ($status_db == 'shipped') {
                                    $bg = 'bg-primary text-white';
                                    $label = 'DIKIRIM';
                                } elseif ($status_db == 'completed') {
                                    $bg = 'bg-info text-dark';
                                    $label = 'SELESAI';
                                } elseif ($status_db == 'canceled') {
                                    $bg = 'bg-danger text-white';
                                    $label = 'DIBATALKAN';
                                }
                                ?>
                        <span class="badge <?= $bg ?> px-3 py-2 shadow-sm"
                            style="letter-spacing: 0.5px;"><?= $label ?></span>
                    </td>
                    <td>
                        <a href="<?= site_url('admin/pesanan/detail/' . $row['order_id']) ?>"
                            class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                            Lihat Detail <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection(); ?>