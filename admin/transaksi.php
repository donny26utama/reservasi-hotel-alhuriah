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
                                        <th>No.Faktur</th>
                                        <th>Tamu</th>
                                        <th>Kamar</th>
                                        <th>Total Bayar</th>
                                        <th>Status</th>
                                        <th class="text-center">Opsi</th>
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
                                            data_kamar.kamar_nama
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
                                        <td>
                                            Tanggal: <?php echo date('d-m-Y', strtotime($i['tgl_transaksi'])); ?>
                                            <br>
                                            <?php echo $i['invoice_no'] ?>
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
                                            Kamar: <?= $i['kamar_nama'] ?><br>
                                            No. Kamar: <br>
                                            Layanan Tambahan:
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
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if ($i['status'] == 'booking') {
                                                    echo "<span class='badge bg-blue'>Booking</span>";
                                                } elseif($i['status'] == 'non-valid') {
                                                    echo "<span class='badge bg-light-blue'>Non Valid</span>";
                                                } elseif($i['status'] == 'valid') {
                                                    echo "<span class='badge badge-danger'>Valid</span>";
                                                } elseif($i['status'] == 'checkin') {
                                                    echo "<span class='badge bg-green'>Check-In</span>";
                                                } elseif($i['status'] == 'checkout') {
                                                    echo "<span class='badge bg-red'>Check-Out</span>";
                                                }
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <a class='btn btn-sm btn-success'
                                                href="transaksi_invoice.php?id=<?= $i['is_transaksi']; ?>">
                                                <i class="fa fa-print"></i> Faktur
                                            </a>
                                            <a class='btn btn-sm btn-danger'
                                                onclick="return confirm('Yakin ingin hapus?')"
                                                href="transaksi_hapus.php?id=<?= $i['is_transaksi']; ?>">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            <a class='btn btn-sm btn-warning'
                                                href="transaksi_rating.php?id=<?php echo $i['is_transaksi']; ?>">
                                                <i class="fa fa-star"></i> Rating
                                            </a>
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
