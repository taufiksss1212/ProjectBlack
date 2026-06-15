<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <style>
        body {
            font-family: 'Times New Roman', serif;
            font-size: 13px;
            color: #000;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #000;
            padding-bottom: 15px;
        }

        .header h2 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
            letter-spacing: 2px;
        }

        .header p {
            margin: 5px 0 0 0;
            font-size: 14px;
        }

        .title {
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
            font-size: 16px;
            text-decoration: underline;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 10px;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .ttd {
            width: 100%;
            margin-top: 50px;
        }

        .ttd td {
            border: none;
            text-align: right;
            padding-right: 50px;
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>TAMARA TEXTILE</h2>
        <p>Jl. Pulau Batanta No.53 Denpasar Barat, Denpasar, Bali</p>
        <p>Telp: +62 812-3933-4764 | Email: info@tamarabalitextile.com</p>
    </div>

    <div class="title">
        LAPORAN <?= strtoupper($jenis == 'distribusi' ? 'DISTRIBUSI BARANG KELUAR' : 'KEUANGAN & PENDAPATAN BERSIH') ?>
        <br>
        <span style="font-size: 12px; font-weight: normal; text-decoration: none;">
            Periode: <?= str_replace('_', ' ', strtoupper($periode)) ?>
        </span>
    </div>

    <table>
        <?php if ($jenis == 'distribusi'): ?>
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="15%">Tanggal</th>
                    <th width="20%">No. Order</th>
                    <th width="30%">Nama Kain</th>
                    <th width="10%">Qty</th>
                    <th width="20%">Nilai Trx</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                $total = 0;
                $qty = 0;
                foreach ($transaksi as $t):
                    $total += $t['subtotal'];
                    $qty += $t['qty']; ?>
                    <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td class="text-center"><?= date('d/m/Y', strtotime($t['created_at'])) ?></td>
                        <td class="text-center"><?= $t['order_id'] ?></td>
                        <td><?= $t['nama_produk'] ?></td>
                        <td class="text-center"><?= $t['qty'] ?></td>
                        <td class="text-right">Rp <?= number_format($t['subtotal'], 0, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4" class="text-right">TOTAL KESELURUHAN</th>
                    <th class="text-center"><?= $qty ?></th>
                    <th class="text-right">Rp <?= number_format($total, 0, ',', '.') ?></th>
                </tr>
            </tfoot>
        <?php else: ?>
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="15%">Tanggal</th>
                    <th width="20%">No. Order</th>
                    <th width="15%">Metode</th>
                    <th width="15%">Ongkos Kirim</th>
                    <th width="15%">Pendapatan (Kain)</th>
                    <th width="15%">Total (Gross)</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                $tOngkir = 0;
                $tBersih = 0;
                $tGross = 0;
                foreach ($transaksi as $t):
                    $tOngkir += $t['ongkir'];
                    $tBersih += $t['total_belanja'];
                    $tGross += $t['gross_amount']; ?>
                    <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td class="text-center"><?= date('d/m/Y', strtotime($t['created_at'])) ?></td>
                        <td class="text-center"><?= $t['order_id'] ?></td>
                        <td class="text-center"><?= strtoupper($t['payment_type'] ?? '-') ?></td>
                        <td class="text-right">Rp <?= number_format($t['ongkir'], 0, ',', '.') ?></td>
                        <td class="text-right">Rp <?= number_format($t['total_belanja'], 0, ',', '.') ?></td>
                        <td class="text-right">Rp <?= number_format($t['gross_amount'], 0, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4" class="text-right">TOTAL KESELURUHAN</th>
                    <th class="text-right">Rp <?= number_format($tOngkir, 0, ',', '.') ?></th>
                    <th class="text-right">Rp <?= number_format($tBersih, 0, ',', '.') ?></th>
                    <th class="text-right">Rp <?= number_format($tGross, 0, ',', '.') ?></th>
                </tr>
            </tfoot>
        <?php endif; ?>
    </table>

    <table class="ttd">
        <tr>
            <td>
                Denpasar, <?= date('d M Y') ?><br>
                Admin Tamara Textile<br><br><br><br><br>
                <strong>( <?= session()->get('nama_lengkap') ?> )</strong>
            </td>
        </tr>
    </table>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>

</html>