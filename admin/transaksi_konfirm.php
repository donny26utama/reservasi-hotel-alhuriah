<?php
include 'header.php';
$id = $_GET['id'];
$query = "
  select *
  from check_in, punya, customer, kamar
  where
    kamar.kamar_id=punya.kamar_id AND
    customer.no_ktp=check_in.no_ktp AND
    punya.id_transaksi=check_in.id_transaksi AND
    punya.id_transaksi='$id'";
$q = mysqli_query($koneksi, $query);
$dt = mysqli_fetch_object($q);
$tglco = date('Y-m-d', strtotime($dt->tgl_check_in. ' + '.$dt->lama_inap.' days'));
$lt = "SELECT * FROM ambil, layanan_tambahan WHERE layanan_tambahan.lt_id=ambil.lt_id AND ambil.id_transaksi='$id'";
$qlt = mysqli_query($koneksi, $lt);
$tambahan = array();
while ($dtlt = mysqli_fetch_object($qlt)) {
  $tambahan[] = sprintf('- %s (Rp. %s)', $dtlt->lt_nama, number_format($dtlt->harga, 0));
}
?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Transaksi
      <small>Konfirmasi Pembayaran</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Transaksi</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <section class="col-lg-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Detil Transaksi</h3>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-md-6">
                <table class="table table-bordered table-striped">
                  <tbody>
                    <tr>
                      <td>No. Faktur</td>
                      <td><?= $dt->invoice_no ?></td>
                    </tr>
                    <tr>
                      <td>Tanggal Transaksi</td>
                      <td><?= $dt->tgl_transaksi ?></td>
                    </tr>
                    <tr>
                      <td>Kamar yang Dipesan</td>
                      <td>
                        <?= $dt->kamar_kategori ?>
                        <?= $dt->kamar_nama ?>,
                        <?= $dt->kamar_ranjang ?> bed
                        (Rp. <?= number_format($dt->harga*$dt->lama_inap,0) ?> untuk <?= $dt->lama_inap ?> malam)
                      </td>
                    </tr>
                    <tr>
                      <td>Layanan Tambahan</td>
                      <td><?= !empty($tambahan) ? implode("<br>", $tambahan) : '-' ?></td>
                    </tr>
                    <tr>
                      <td>Tanggal Check-In</td>
                      <td>
                        <?= $dt->tgl_check_in ?>
                        sampai
                        <?= $tglco ?>
                      </td>
                    </tr>
                    <tr>
                      <td>Nama Customer</td>
                      <td>
                        <?= $dt->customer_nama ?>
                        <br>
                        telp: <?= $dt->customer_hp ?>
                      </td>
                    </tr>
                    <tr>
                      <td>Jumlah Tamu</td>
                      <td><?= $dt->jumlahorang ?> Orang</td>
                    </tr>
                    <tr>
                      <td>Catatan Reservasi</td>
                      <td><?= $dt->keterangan_reservasi ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-md-4 col-md-offset-1">
                <img src="../<?= $dt->invoice_bukti ?>" class="img-responsive" alt="gambar-bukti">
              </div>
            </div>
            <div class="row" style="margin-top: 30px;">
              <div class="col-md-6">
                <div class="col-lg-6">
                  <form action="transaksi_konfirm_act.php" method="post">
                    <div class="form-group">
                      <label>Nomor Kamar</label>
                      <input type="hidden" name="trx_id" value="<?= $dt->id_transaksi ?>">
                      <input type="hidden" name="kamar_id" value="<?= $dt->kamar_id ?>">
                      <select class="form-control" name="nokamar" id="trx-no_kamar" required>
                        <option value="">--Pilih Kamar--</option>
                        <?php
                          $list_kamar = "SELECT * FROM nokamar WHERE kamar_id='$dt->kamar_id' and kosong='Y'";
                          $qnokamar = mysqli_query($koneksi, $list_kamar);
                          while($dtnokamar = mysqli_fetch_object($qnokamar)):
                        ?>
                            <option value="<?= $dtnokamar->nokamar ?>"><?= $dtnokamar->nokamar ?></option>
                        <?php endwhile; ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <input type="submit" name="aksi" id="trx-btn-konfirm" class="btn btn-primary" value="Konfirm">
                      <input type="submit" name="aksi" id="trx-btn-tolak" class="btn btn-danger" value="Tolak">
                    </div>
                  </form>
                </div>
              </div>
              <div class="col-md-6"></div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </section>
</div>
<?php include 'footer.php'; ?>
