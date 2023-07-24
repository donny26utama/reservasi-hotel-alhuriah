<?php include 'header.php'; ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Transaksi
            <small>Data Transaksi / Booking</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <section class="col-lg-12">
                <div class="box box-default">
                    <div class="box-header">
                        <h3 class="box-title">Transaksi / Booking</h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped"
                                id="table-datatable" aria-describedby="mydesc">
                                <thead>
                                    <tr>
                                        <th style="width: 1%">#</th>
                                        <th class="text-center">Opsi</th>
                                        <th>No.Faktur</th>
                                        <th>Tamu</th>
                                        <th>Kamar</th>
                                        <th>Total Bayar</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $no = 1;
                                    $query = "
                                        SELECT
                                            check_in.*,
                                            customer.customer_nama,
                                            customer.customer_email,
                                            customer.customer_hp,
                                            data_kamar.kamar_nama,
                                            data_kamar.nokamar
                                        FROM check_in
                                        INNER JOIN customer
                                            ON customer.no_ktp = check_in.no_ktp
                                        INNER JOIN (
                                            SELECT
                                                punya.*,
                                                kamar.kamar_nama
                                            FROM punya
                                            INNER JOIN kamar
                                                ON kamar.kamar_id = punya.kamar_id
                                        ) AS data_kamar
                                            ON data_kamar.id_transaksi = check_in.id_transaksi
                                        ORDER BY id_transaksi desc";
                                    $invoice = mysqli_query($koneksi, $query);
                                    while ($i = mysqli_fetch_array($invoice)):
                                ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default">Opsi</button>
                                                <button type="button" class="btn btn-default dropdown-toggle"
                                                    data-toggle="dropdown">
                                                    <span class="caret"></span>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <?php if($i['invoice_status'] == 1): ?>
                                                        <li>
                                                            <a href="transaksi_konfirm.php?id=<?= $i['id_transaksi']; ?>">
                                                                <i class="fa fa-check-square-o text-blue"></i>
                                                                Konfirmasi Pembayaran
                                                            </a>
                                                        </li>
                                                    <?php elseif($i['invoice_status'] > 1): ?>
                                                        <li>
                                                            <a href="../<?= $i['invoice_bukti'] ?>" target="_blank">
                                                                <i class="fa fa-search text-light-blue"></i>
                                                                Lihat Bukti Bayar
                                                            </a>
                                                        </li>
                                                    <?php endif; ?>
                                                    <li>
                                                        <a href="invoice_cetak.php?id=<?= $i['id_transaksi']; ?>">
                                                            <i class="fa fa-print text-navy"></i> Cetak Bukti Check In
                                                        </a>
                                                    </li>
                                                    <?php if($i['status'] == 'valid'): ?>
                                                    <li>
                                                        <a href="transaksi_checkin.php?id=<?= $i['id_transaksi']; ?>">
                                                            <i class="fa fa-bed text-green"></i> Check-In
                                                        </a>
                                                    </li>
                                                    <?php endif; ?>
                                                    <?php if($i['status'] == 'checkin'): ?>
                                                    <li>
                                                        <a href="transaksi_checkout.php?id=<?= $i['id_transaksi']; ?>">
                                                            <i class="fa fa-sign-in text-red"></i> Check-Out
                                                        </a>
                                                    </li>
                                                    <?php endif; ?>
                                                    <?php if($i['status'] == 'checkout'): ?>
                                                    <li style="display: none;">
                                                        <a href="transaksi_rating.php?id=<?= $i['id_transaksi']; ?>">
                                                            <i class="fa fa-star text-yellow"></i> Beri Rating
                                                        </a>
                                                    </li>
                                                    <?php endif; ?>
                                                    <li class="divider" style="display: none;"></li>
                                                    <li style="display: none;">
                                                        <a onclick="return confirm('Yakin ingin hapus?')"
                                                            class="text-red"
                                                            href="transaksi_hapus.php?id=<?= $i['id_transaksi']; ?>">
                                                            <i class="fa fa-trash"></i> Batalkan Transaksi
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <small>
                                                    Tanggal: <?= date('d-m-Y', strtotime($i['tgl_transaksi'])); ?>
                                                </small>
                                            </div>
                                            <div>
                                                <b><?php echo $i['invoice_no'] ?></b>
                                            </div>
                                            <div>
                                                <small>
                                                    Keterangan Reservasi: <?= $i['keterangan_reservasi'] ?: '-' ?>
                                                </small>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <b><?php echo $i['customer_nama'] ?></b>
                                            </div>
                                            <div>
                                                <small>
                                                    KTP: <?= $i['no_ktp'] ?>
                                                </small>
                                            </div>
                                            <div>
                                                <small>
                                                    Email: <?= $i['customer_email'] ?>
                                                </small>
                                            </div>
                                            <div>
                                                <small>
                                                    Telp: <?= $i['customer_hp'] ?>
                                                </small>
                                            </div>
                                        </td>
                                        <td>
                                            <div><b><?= $i['kamar_nama'] ?></b></div>
                                            <div>No. Kamar: <?= $i['nokamar'] ?: '-' ?></div>
                                            <div>Layanan Tambahan:</div>
                                            <?php
                                                $id_transkasi = $i['id_transaksi'];
                                                $query_tambahan = "
                                                    SELECT
                                                        ambil.*,
                                                        layanan_tambahan.lt_nama
                                                    FROM ambil
                                                    INNER JOIN layanan_tambahan
                                                        on layanan_tambahan.lt_id = ambil.lt_id
                                                    WHERE ambil.id_transaksi='$id_transkasi'";
                                                $tambahan = mysqli_query($koneksi, $query_tambahan);
                                                while($l = mysqli_fetch_array($tambahan)):
                                            ?>
                                                <div><small>- <?= $l['lt_nama'] ?></small></div>
                                            <?php endwhile; ?>
                                        </td>
                                        <td>
                                            <?php echo "Rp. ".number_format($i['invoice_total'])." ,-" ?>
                                            <br>
                                            <?php
                                                if ($i['invoice_status'] == 0) {
                                                    echo "<span class='badge bg-yellow'>Menunggu Pembayaran</span>";
                                                } elseif($i['invoice_status'] == 1) {
                                                    echo "<span class='badge bg-light-blue'>Menunggu Konfirmasi</span>";
                                                } elseif($i['invoice_status'] == 2) {
                                                    echo "<span class='badge bg-red'>Ditolak</span>";
                                                } elseif($i['invoice_status'] == 3) {
                                                    echo "<span class='badge bg-blue'>Dikonfirmasi</span>";
                                                } elseif($i['invoice_status'] == 4) {
                                                    echo "<span class='badge bg-green'>Selesai</span>";
                                                }
                                                echo "<br>";
                                                if ($i['invoice_status'] > 1) {
                                                    echo "<small>Dikonfirmasi oleh: <b>" . $i['admin_username'] . "</b></small>";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if ($i['status'] == 'booking') {
                                                    echo "<span class='badge bg-blue'>Booking</span>";
                                                } elseif($i['status'] == 'non-valid') {
                                                    echo "<span class='badge bg-light-blue'>Non Valid</span>";
                                                } elseif($i['status'] == 'valid') {
                                                    echo "<span class='badge bg-olive'>Valid</span>";
                                                } elseif($i['status'] == 'checkin') {
                                                    echo "<span class='badge bg-green'>Check-In</span>";
                                                } elseif($i['status'] == 'checkout') {
                                                    echo "<span class='badge bg-red'>Check-Out</span>";
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>
</div>
<?php include 'footer.php'; ?>
