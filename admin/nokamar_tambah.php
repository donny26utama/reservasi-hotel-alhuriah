<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Nomor Kamar
      <small>Tambah Nomor Kamar Baru</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Nomor Kamar</li>
      <li class="active">Tambah</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-6">   

        <div class="box">

          <div class="box-header">
            <h3 class="box-title">Tambah Nomor Kamar</h3>
            <a href="fasilitas_kamar.php" class="btn btn-default btn-sm pull-right"><i class="fa fa-reply"></i> &nbsp; Kembali</a> 
          </div>
          <div class="box-body">

            <form action="nokamar_act.php" method="post">

              <div class="form-group">
                <label>Pilih Kamar</label>
                
                <select class="form-control" name="kamar_id" required>
                  <option value="">--Pilih Kamar--</option>  
                  <?php
                    $q = mysqli_query($koneksi,"SELECT * FROM kamar ");
                    while($dt = mysqli_fetch_object($q)):
                      ?>
                        <option value="<?= $dt->kamar_id ?>"><?= $dt->kamar_nama ?> <?= $dt->kamar_ranjang ?> bed</option>
                      <?php
                    endwhile;
                  ?>
                </select>
              </div>


              <div class="form-group">
                <label>Lantai</label>
                <select class="form-control" name="lantai" required>
                  <option selected value="">--Pilih Lantai--</option>
                  <option value="1">1</option>
                  <option  value="2">2</option>
                  <option  value="3">3</option>
                </select>
              </div>

              <div class="form-group">
                <label>Nomor Kamar</label>
                <input type="number" class="form-control" name="nokamar" required>
              </div>

             


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