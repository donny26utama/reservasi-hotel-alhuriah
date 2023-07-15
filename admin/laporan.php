<?php
include 'header.php';

$tgl_dari = isset($_GET['tanggal_dari'])
  ? $_GET['tanggal_dari'] : '';
$tgl_sampai = isset($_GET['tanggal_sampai'])
  ? $_GET['tanggal_sampai'] : '';
?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      LAPORAN
      <small>Data Laporan</small>
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
            <h3 class="box-title">Filter Laporan</h3>
          </div>
          <div class="box-body">
            <form method="get" action="">
              <div class="row">

                <div class="col-md-3">
                  <div class="form-group">
                    <label>Mulai Tanggal</label>
                    <input autocomplete="off" type="text" value="<?= $tgl_dari ?>" name="tanggal_dari"
                      class="form-control datepicker2" placeholder="Mulai Tanggal" required="required">
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <label>Sampai Tanggal</label>
                    <input autocomplete="off" type="text" value="<?= $tgl_sampai ?>" name="tanggal_sampai"
                      class="form-control datepicker2" placeholder="Sampai Tanggal" required="required">
                  </div>
                </div>

                <div class="col-md-2">
                  <div class="form-group">
                    <br/>
                    <input type="submit" value="TAMPILKAN LAPORAN" class="btn btn-sm btn-primary">
                  </div>
                </div>

              </div>
            </form>
          </div>
        </div>

        <div class="box box-default">
          <div class="box-header">
            <h3 class="box-title">Laporan Booking</h3>
          </div>
          <div class="box-body">
            <?php if(isset($_GET['tanggal_sampai']) && isset($_GET['tanggal_dari'])): ?>
              <div class="row">
                <div class="col-lg-6">
                  <table class="table table-bordered">
                    <tr>
                      <th style="width: 30%">DARI TANGGAL</th>
                      <th style="width: 1%">:</th>
                      <td><?= $tgl_dari; ?></td>
                    </tr>
                    <tr>
                      <th>SAMPAI TANGGAL</th>
                      <th>:</th>
                      <td><?= $tgl_sampai; ?></td>
                    </tr>
                  </table>
                </div>
              </div>
              <a href="laporan_print.php?tanggal_dari=<?= $tgl_dari ?>&tanggal_sampai=<?= $tgl_sampai ?>"
                target="_blank" class="btn btn-sm btn-primary">
                <i class="fa fa-print"></i> &nbsp; PRINT
              </a>
              <div class="table-responsive">
                <table class="table table-bordered table-striped" id="table-datatable">
                  <thead>
                    <tr>
                      <th width="1%">NO</th>
                      <th>INVOICE</th>
                      <th>TANGGAL BOOKING</th>
                      <th>NAMA CUSTOMER</th>
                      <th>KAMAR</th>
                      <th>JUMLAH</th>
                      <th>STATUS</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no=1;
                      $tgl_end = date('Y-m-d', strtotime($tgl_sampai . ' +1 day'));
                      $query_layanan = "
                        SELECT
                          SUM(harga)
                        FROM ambil
                        WHERE ambil.id_transaksi = ci.id_transaksi";
                      $query = "
                        SELECT
                          ci.*,
                          c.customer_nama,
                          k.kamar_nama,
                          p.harga * p.lama_inap AS biaya_kamar,
                          ($query_layanan) AS biaya_layanan
                        FROM check_in AS ci
                        INNER JOIN customer AS c ON c.no_ktp = ci.no_ktp
                        INNER JOIN punya AS p ON p.id_transaksi = ci.id_transaksi
                        INNER JOIN kamar as k ON k.kamar_id = p.kamar_id
                        WHERE
                            ci.tgl_transaksi >= '$tgl_dari' AND
                            ci.tgl_transaksi <  '$tgl_end'
                      ";
                      $data = mysqli_query($koneksi, $query);
                      while($i = mysqli_fetch_array($data)):
                        $total_bayar = $i['biaya_kamar'] + $i['biaya_layanan'];
                    ?>
                      <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $i['invoice_no'] ?></td>
                        <td><?php echo date('d-m-Y', strtotime($i['tgl_transaksi'])); ?></td>
                        <td><?php echo $i['customer_nama'] ?></td>
                        <td><?php echo $i['kamar_nama'] ?></td>
                        <td><?php echo "Rp. ".number_format($total_bayar)." ,-" ?></td>
                        <td>
                          <?php
                          if($i['invoice_status'] == 0){
                            echo "Menunggu Pembayaran";
                          }elseif($i['invoice_status'] == 1){
                            echo "Menunggu Konfirmasi";
                          }elseif($i['invoice_status'] == 2){
                            echo "Ditolak";
                          }elseif($i['invoice_status'] == 3){
                            echo "Dikonfirmasi & Sedang Diproses";
                          }elseif($i['invoice_status'] == 4){
                            echo "Selesai";
                          }
                          ?>
                        </td>
                      </tr>
                    <?php endwhile; ?>
                  </tbody>
                </table>
              </div>
            <?php else: ?>
              <div class="alert alert-success text-center">
                Silahkan Filter Laporan Terlebih Dulu.
              </div>
            <?php endif; ?>
          </div>
        </div>
      </section>
    </div>
  </section>
</div>
<?php include 'footer.php'; ?>