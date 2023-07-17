<?php
include 'header.php';

$id = $_SESSION['customer_id'];
$id_transaksi = mysqli_escape_string($koneksi, $_GET['id']);
$query = "
    select
        check_in.*,
        customer.customer_nama,
        customer.customer_hp,
        punya.kamar_id,
        punya.harga,
        punya.lama_inap
    from check_in
    inner join customer on customer.no_ktp = check_in.no_ktp
    inner join punya on punya.id_transaksi = check_in.id_transaksi
    where check_in.no_ktp='$id' and check_in.id_transaksi='$id_transaksi'";
$invoice = mysqli_query($koneksi, $query);
?>

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Dashboard Customer</h4>
                    <div class="breadcrumb__links">
                        <a href="index.php">Home</a>
                        <a href="#">Customer</a>
                        <span>Pesanan</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="row">
            <div id="aside" class="col-md-3">
                <?php include 'customer_sidebar.php'; ?>
            </div>

            <div id="main" class="col-md-9">
                <h4><b>FAKTUR</b></h4>
                <br>
                <small class="text-muted">Detail pesanan kamar</small>
                <br>
                <br>
                <div class="row">
                    <?php while($i = mysqli_fetch_array($invoice)): ?>
                        <div class="col-lg-12">
                            <a href="customer_pesanan.php" class="btn btn-warning btn-sm">
                                <i class="fa fa-arrow-left"></i> KEMBALI
                            </a>
                            <a href="customer_invoice_cetak.php?id=<?php echo $_GET['id'] ?>"
                                target="_blank" class="btn btn-primary btn-sm">
                                <i class="fa fa-print"></i> CETAK
                            </a>
                            <br/>
                            <br/>
                            <h4><?php echo $i['invoice_no'] ?></h4>
                            <br/>
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 20%;">Nama</th>
                                    <td><?php echo $i['customer_nama']; ?></td>
                                </tr>
                                <tr>
                                    <th>HP</th>
                                    <td><?php echo $i['customer_hp']; ?></td>
                                </tr>
                            </table>
                            <br/>

                            <?php
                                $no=1;
                                $kamar_id = $i['kamar_id'];
                                $kamar = mysqli_query($koneksi, "SELECT * FROM kamar where kamar_id='$kamar_id'");
                                $k = mysqli_fetch_assoc($kamar);
                            ?>

                            <div class="row">
                                <div class="col-lg-2">
                                    <?php if($k['kamar_foto1'] == ""): ?>
                                        <img src="gambar/sistem/kamar.png" style="width: auto;height: auto">
                                    <?php else: ?>
                                        <img src="gambar/kamar/<?php echo $k['kamar_foto1'] ?>" style="width: auto; height: auto;">
                                    <?php endif; ?>
                                </div>
                                <div class="col-lg-10">
                                    <h5><?php echo $k['kamar_nama']; ?></h5>
                                    <small class="text-muted">
                                        <?php echo $k['kategori_nama']; ?>
                                        |
                                        Ranjang : <?php echo $k['kamar_ranjang']; ?>
                                        |
                                        Ukuran Kamar : <?php echo $k['kamar_ukuran']; ?> m2
                                        <br>
                                        Fasilitas :
                                        <?php
                                        $id_kamar = $k['kamar_id'];
                                        $fasilitas = mysqli_query($koneksi, "select * from fasilitas_kamar where kamar_id='$id_kamar'");
                                        $fasil = [];
                                        foreach (mysqli_fetch_assoc($fasilitas) as $f_nama => $f_value) {
                                            if (in_array($f_nama, array('id_fk', 'kamar_id'))) { continue; }
                                            $fasil[] = str_replace('_', ' ', $f_nama);
                                        }
                                        echo implode(', ', $fasil);
                                        ?>
                                        <br>
                                        Harga : <b><?php echo "Rp. ".number_format($k['kamar_harga']).",-"; ?></b> / mlm

                                    </small>

                                </div>

                            </div>

                            <br>

                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th>Harga Kamar</th>
                                            <td class="text-center">
                                                <?php
                                                    $biaya_kamar = $i['harga'] * $i['lama_inap'];
                                                    echo "Rp. ".number_format($biaya_kamar)." ,-";
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                Lama Menginap :
                                                <br>
                                                <small class="text-muted">
                                                    <?php
                                                        $durasi = sprintf('%s +%s days', $i['tgl_check_in'], $i['lama_inap']);
                                                        $check_in = date('d/m/Y', strtotime($i['tgl_check_in']));
                                                        $check_out = date('d/m/Y', strtotime($durasi));
                                                        echo $check_in, ' - ', $check_out;
                                                    ?>
                                                </small>
                                            </th>
                                            <td class="text-center">
                                                <?php echo $i['lama_inap'] ?> Hari
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                Layanan Tambahan :
                                                <br>
                                                <?php
                                                    $harga_layanan = 0;
                                                    $id_invoice = $i['id_transaksi'];
                                                    $query_layanan_tambahan = "
                                                        select *
                                                        from ambil
                                                        inner join layanan_tambahan
                                                            on layanan_tambahan.lt_id = ambil.lt_id
                                                        where ambil.id_transaksi='$id_invoice'
                                                    ";
                                                    $template = '- %s (Rp. %s ,-)';
                                                    $layanan = mysqli_query($koneksi, $query_layanan_tambahan);
                                                    while($l = mysqli_fetch_array($layanan)):
                                                        $harga_layanan += $l['lt_harga'];
                                                        $lt_harga = number_format($l['lt_harga']);
                                                ?>
                                                    <small class="text-muted">
                                                        <?php echo sprintf($template, $l['lt_nama'], $lt_harga) ?>
                                                    </small>
                                                    <br>
                                                <?php endwhile; ?>
                                            </th>
                                            <td class="text-center">
                                                <?php echo "Rp. ".number_format($harga_layanan)." ,-"; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Total Bayar</th>
                                            <td class="text-center bg-primary text-white font-weight-bold">
                                                <?php
                                                    $total_bayar = $biaya_kamar + $harga_layanan;
                                                    echo "Rp. ".number_format($total_bayar)." ,-";
                                                ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>


                            <br>
                            <h5>STATUS :</h5>
                            <?php
                            if($i['invoice_status'] == 0){
                                echo "<span class='label label-warning'>Menunggu Pembayaran</span>";
                            }elseif($i['invoice_status'] == 1){
                                echo "<span class='label label-default'>Menunggu Konfirmasi</span>";
                            }elseif($i['invoice_status'] == 2){
                                echo "<span class='label label-danger'>Ditolak</span>";
                            }elseif($i['invoice_status'] == 3){
                                echo "<span class='label label-primary'>Dikonfirmasi</span>";
                            }elseif($i['invoice_status'] == 4){
                                echo "<span class='label label-success'>Selesai</span>";
                            }
                            ?>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Checkout Section End -->

<?php include 'footer.php'; ?>
