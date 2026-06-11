<?= $this->extend('dashboard/layout'); ?>

<?= $this->section('content'); ?>
<div class="mb-4 d-flex align-items-center gap-3">
    <a href="<?= site_url('admin/pesanan') ?>" class="btn btn-outline-secondary rounded-pill px-3">
        <i class="fas fa-arrow-left me-2"></i> Kembali
    </a>
    <h3 class="fw-bold mb-0 text-dark" style="font-family: var(--font-serif);">
        Detail Pesanan: <span style="color: var(--lux-gold);"><?= $order['order_id'] ?></span>
    </h3>
</div>

<?php if (session()->getFlashdata('success')) : ?>
<div class="alert alert-success border-0 shadow-sm"><i class="fas fa-check-circle me-2"></i>
    <?= session()->getFlashdata('success') ?></div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')) : ?>
<div class="alert alert-danger border-0 shadow-sm"><i class="fas fa-exclamation-triangle me-2"></i>
    <?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px; background: white;">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-4 border-bottom pb-3 text-dark"><i
                        class="fas fa-map-marker-alt text-muted me-2"></i> Informasi Pengiriman</h5>

                <p class="mb-1 fw-bold text-dark">Alamat Lengkap:</p>
                <p class="text-secondary ms-1 mb-4"><?= $order['alamat_lengkap'] ?></p>

                <div class="row bg-light p-3 rounded mx-0">
                    <div class="col-md-6 border-end">
                        <p class="mb-1 text-muted small text-uppercase fw-bold">Kurir / Layanan</p>
                        <h6 class="fw-bold text-dark text-uppercase mb-0"><?= $order['kurir'] ?> -
                            <?= $order['layanan_kurir'] ?></h6>
                    </div>
                    <div class="col-md-6 ps-4">
                        <p class="mb-1 text-muted small text-uppercase fw-bold">Total Berat</p>
                        <h6 class="fw-bold text-dark mb-0"><?= number_format($order['berat_total'], 0, ',', '.') ?> Gram
                        </h6>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm" style="border-radius: 12px; background: white;">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-4 border-bottom pb-3 text-dark"><i class="fas fa-box-open text-muted me-2"></i>
                    Rincian Produk</h5>
                <div class="table-responsive">
                    <table class="table table-borderless align-middle">
                        <thead class="text-muted border-bottom">
                            <tr>
                                <th class="fw-bold text-uppercase small">Produk</th>
                                <th class="fw-bold text-uppercase small">Harga</th>
                                <th class="fw-bold text-uppercase small">Qty</th>
                                <th class="text-end fw-bold text-uppercase small">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="text-dark">
                            <?php foreach ($details as $item): ?>
                            <tr>
                                <td>
                                    <div class="fw-bold"><?= $item['nama_produk'] ?></div>
                                </td>
                                <td>Rp <?= number_format($item['harga_satuan'], 0, ',', '.') ?></td>
                                <td><?= $item['qty'] ?></td>
                                <td class="text-end fw-bold">Rp <?= number_format($item['subtotal'], 0, ',', '.') ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot class="border-top">
                            <tr>
                                <td colspan="3" class="text-end text-muted">Total Belanja:</td>
                                <td class="text-end text-dark fw-bold">Rp
                                    <?= number_format($order['total_belanja'], 0, ',', '.') ?></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-end text-muted">Ongkos Kirim:</td>
                                <td class="text-end text-dark fw-bold">Rp
                                    <?= number_format($order['ongkir'], 0, ',', '.') ?></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-end fw-bold"
                                    style="color: var(--lux-gold); font-size: 1.1rem;">TOTAL TAGIHAN:</td>
                                <td class="text-end fw-bold" style="color: var(--lux-gold); font-size: 1.1rem;">Rp
                                    <?= number_format($order['gross_amount'], 0, ',', '.') ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-sm" style="border-radius: 12px; background: white;">
            <div class="card-header border-0 py-3 bg-light" style="border-radius: 12px 12px 0 0;">
                <h6 class="mb-0 fw-bold text-center text-dark"><i class="fas fa-cog text-muted me-2"></i> PANEL AKSI
                </h6>
            </div>
            <div class="card-body p-4 text-center">

                <?php
                $status_db = strtolower($order['status_pesanan'] ?? '');
                ?>

                <?php if ($status_db == 'pending'): ?>
                <div class="alert alert-warning text-dark text-start border-0 shadow-sm mb-4">
                    <i class="fas fa-hourglass-half me-2"></i> <strong>Menunggu Pembayaran!</strong><br>
                    <small>Sistem menunggu pelanggan mentransfer uang via Komerce.</small>
                </div>

                <a href="<?= site_url('admin/pesanan/sync/' . $order['order_id']) ?>"
                    class="btn w-100 fw-bold mb-3 shadow-sm text-white" style="background-color: #0dcaf0; border:none;">
                    <i class="fas fa-sync-alt me-2"></i> CEK STATUS PEMBAYARAN
                </a>

                <a href="<?= site_url('admin/pesanan/batal/' . $order['order_id']) ?>"
                    onclick="return confirm('Yakin ingin membatalkan pesanan ini secara sepihak?')"
                    class="btn btn-outline-danger w-100 fw-bold">
                    BATALKAN PESANAN
                </a>

                <?php elseif ($status_db == 'paid' || $status_db == 'success'): ?>
                <div class="alert alert-success text-dark text-start border-0 shadow-sm mb-4">
                    <i class="fas fa-check-circle me-2"></i> <strong>Pembayaran Lunas!</strong><br>
                    <small>Silakan kemas barang dan masukkan nomor resi pengiriman kurir.</small>
                </div>
                <form action="<?= site_url('admin/pesanan/update-resi') ?>" method="POST" class="text-start mt-4">

                    <?= csrf_field() ?>
                    <input type="hidden" name="order_id" value="<?= $order['order_id'] ?>">

                    <div class="mb-3 border rounded p-3 bg-light">
                        <label class="form-label text-dark fw-bold small text-uppercase">Nomor Resi
                            (<?= strtoupper($order['kurir']) ?>)</label>
                        <input type="text" name="no_resi" class="form-control bg-white border"
                            placeholder="Contoh: 004123..." required>
                    </div>
                    <button type="submit" class="btn w-100 fw-bold text-white shadow-sm"
                        style="background: var(--lux-gold); border: none;">
                        <i class="fas fa-paper-plane me-2"></i> PROSES & KIRIM
                    </button>
                </form>

                <?php elseif ($status_db == 'shipped'): ?>
                <div class="alert alert-primary text-start border-0 shadow-sm">
                    <i class="fas fa-truck me-2"></i> <strong>Barang Sedang Dikirim</strong>
                </div>
                <div class="p-3 bg-light border rounded text-start mb-4 text-center">
                    <small class="text-muted d-block mb-1 text-uppercase fw-bold">Nomor Resi Pelacakan</small>
                    <h4 class="text-dark mb-0 fw-bold" style="letter-spacing: 1px;"><?= $order['no_resi'] ?></h4>
                </div>
                <a href="<?= site_url('admin/pesanan/selesai/' . $order['order_id']) ?>"
                    onclick="return confirm('Tandai pesanan ini sebagai Selesai?')"
                    class="btn btn-success w-100 fw-bold shadow-sm">
                    <i class="fas fa-check me-2"></i> TANDAI SELESAI
                </a>

                <?php elseif ($status_db == 'completed'): ?>
                <div class="text-success my-4">
                    <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex p-4 mb-3">
                        <i class="fas fa-check-double fa-3x"></i>
                    </div>
                    <h4 class="fw-bold">PESANAN SELESAI</h4>
                    <p class="text-muted small">Transaksi ini telah ditutup dengan sukses.</p>
                </div>

                <?php elseif ($status_db == 'canceled'): ?>
                <div class="text-danger my-4">
                    <div class="bg-danger bg-opacity-10 rounded-circle d-inline-flex p-4 mb-3">
                        <i class="fas fa-times-circle fa-3x"></i>
                    </div>
                    <h4 class="fw-bold">DIBATALKAN</h4>
                    <p class="text-muted small">Pesanan ini telah dibatalkan.</p>
                </div>

                <?php else: ?>
                <div class="alert alert-secondary text-dark text-start border-0 shadow-sm mb-4">
                    <i class="fas fa-exclamation-circle me-2"></i> <strong>Status Tidak Dikenali!</strong><br>
                    <small>Data status pesanan kosong atau error ("<?= $order['status_pesanan'] ?>").</small>
                </div>
                <a href="<?= site_url('admin/pesanan/sync/' . $order['order_id']) ?>"
                    class="btn w-100 fw-bold mb-3 shadow-sm text-white" style="background-color: #0dcaf0; border:none;">
                    <i class="fas fa-sync-alt me-2"></i> TARIK ULANG STATUS DARI API
                </a>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>