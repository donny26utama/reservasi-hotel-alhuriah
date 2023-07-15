<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Tagihan
      <small>Input Tagihan</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Input Tagihan</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-12">   

        <div class="box">

          <div class="box-header">
            <h3 class="box-title">Input Tagihan</h3>
          </div>
          <div class="box-body">

           <?php 
           $id = $_GET['id'];              
           $q = mysqli_query($koneksi, "select * from check_in, punya, customer, kamar where kamar.kamar_id=punya.kamar_id AND customer.no_ktp=check_in.no_ktp AND punya.id_transaksi=check_in.id_transaksi AND punya.id_transaksi='$id'");
           $dt = mysqli_fetch_object($q);
            ?>

            <form action="inputtagihan_act.php" method="post">

              <div class="col-lg-4"> 
                <div class="form-group">
                  <label>ID Transaksi</label>
                  <input type="text" class="form-control" readonly name="id_transaksi" required value="<?= $id  ?>">
                </div>
                <div class="form-group">
                  <label>Tanggal Transaksi</label>
                  <input type="date" class="form-control" readonly name="tgl_transaksi" required value="<?= $dt->tgl_transaksi ?>">
                </div>
                <div class="form-group">

                  <label>Kamar yang Dipesan</label>
                  <input type="text" class="form-control" readonly name="kamar_nama" required value="<?= $dt->kamar_kategori  ?> <?= $dt->kamar_nama  ?> <?= $dt->kamar_ranjang  ?> bed (Rp. <?= number_format($dt->harga*$dt->lama_inap,0) ?> untuk <?= $dt->lama_inap ?> malam)">
                </div>
                <div class="form-group">
                  <label>Tanggal Tagihan</label>
                  <input type="date" class="form-control" name="bill_tanggal" required value="<?= date('Y-m-d') ?>">
                </div>
              </div><!--kiri-->

              <div class="col-lg-4"> 
                <div class="form-group">
                  <label>Tanggal Check IN</label>
                  <input type="date" class="form-control" readonly name="tgl_check_in" required value="<?= $dt->tgl_check_in ?>">
                </div>
                <div class="form-group">
                  <label>Nama Customer</label>
                  <input type="text" class="form-control" readonly name="customer_nama" required value="<?= $dt->customer_nama ?>">
                </div>
                <div class="form-group">
                  <label>Jumlah Tamu</label>
                  <input type="text" class="form-control" readonly name="jumlahorang" required value="<?= $dt->jumlahorang ?>">
                </div>
                
                <div class="form-group">
                  <label>Nomor Kamar</label>
                  <input type="hidden" name="kamar_id" value="<?= $dt->kamar_id ?>">
                  <select class="form-control" name="nokamar" required>
                    <option value="">--Pilih Kamar--</option>  
                    <?php
                      $qnokamar = mysqli_query($koneksi,"SELECT * FROM nokamar WHERE kamar_id='$dt->kamar_id' and kosong='Y'");
                      while($dtnokamar = mysqli_fetch_object($qnokamar)):
                        ?>
                          <option value="<?= $dtnokamar->nokamar ?>"><?= $dtnokamar->nokamar ?></option>
                        <?php
                      endwhile;
                    ?>
                  </select>
                </div>
              </div><!--tengah-->

              <div class="col-lg-4"> 
                <div class="form-group">
                  <label>Tanggal Check Out</label>
                  <?php
                    $tglco = date('Y-m-d', strtotime($dt->tgl_check_in. ' + '.$dt->lama_inap.' days'));
                  ?>
                  <input type="date" class="form-control" readonly name="tglco" required value="<?= $tglco ?>">
                </div>
                <div class="form-group">
                  <label>No HP Customer</label>
                  <input type="text" class="form-control" readonly name="customer_hp" required value="<?= $dt->customer_hp ?>">
                </div>
                <div class="form-group">
                  <label>Keterangan Reservasi</label>
                  <input type="text" class="form-control" readonly name="keterangan_reservasi" required value="<?= $dt->keterangan_reservasi ?>">
                </div>
                <?php
                  $qlt = mysqli_query($koneksi, "SELECT * FROM ambil, layanan_tambahan WHERE layanan_tambahan.lt_id=ambil.lt_id AND ambil.id_transaksi='$id'");
                  $x = 1;
                  while ($dtlt = mysqli_fetch_object($qlt)):
                    ?>
                    <div class="form-group">
                      <label>Layanan Tambahan <?= $x++ ?></label>
                      <input type="text" class="form-control" readonly name="lt_nama[]" required value="<?= $dtlt->lt_nama ?> (Rp. <?= number_format($dtlt->harga,0)  ?>)">
                    </div>
                    <?php
                  endwhile;
                ?>
              </div><!--kanan-->


              <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Simpan">
              </div>

            </form>

        </div>
      </div>
    </section>
  </div>
</section>
</div>
<?php include 'footer.php'; ?>