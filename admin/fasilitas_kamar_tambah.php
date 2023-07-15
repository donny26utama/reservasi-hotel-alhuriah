<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Fasilitas Kamar
      <small>Tambah Fasilitas Kamar Baru</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Fasilitas Kamar</li>
      <li class="active">Tambah</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-6">   

        <div class="box">

          <div class="box-header">
            <h3 class="box-title">Tambah Fasilitas Kamar</h3>
            <a href="fasilitas_kamar.php" class="btn btn-default btn-sm pull-right"><i class="fa fa-reply"></i> &nbsp Kembali</a> 
          </div>
          <div class="box-body">

            <form action="fasilitas_kamar_act.php" method="post">

              <div class="form-group">
                <label>Pilih Kamar</label>
                
                <select class="form-control" name="kamar_id" required>
                  <option value="">--Pilih Kamar--</option>  
                  <?php
                    $q = mysqli_query($koneksi,"SELECT * FROM kamar where kamar_id not in (select kamar_id from fasilitas_kamar)");
                    while($dt = mysqli_fetch_object($q)):
                      ?>
                        <option value="<?= $dt->kamar_id ?>"><?= $dt->kamar_nama ?> <?= $dt->kamar_ranjang ?> bed</option>
                      <?php
                    endwhile;
                  ?>
                </select>
              </div>


              <div class="form-group">
                <label>Shower</label>
                <select class="form-control" name="Shower" required>
                  <option selected value="Y">Ya</option>
                  <option  value="T">Tidak</option>
                </select>
              </div>

              <div class="form-group">
                <label>Closet Jongkok</label>
                <select class="form-control" name="Closet_Jongkok" required>
                  <option selected value="Y">Ya</option>
                  <option  value="T">Tidak</option>
                </select>
              </div>

              <div class="form-group">
                <label>Closet Duduk</label>
                <select class="form-control" name="Closet_Duduk" required>
                  <option selected value="Y">Ya</option>
                  <option  value="T">Tidak</option>
                </select>
              </div>


              <div class="form-group">
                <label>TV</label>
                <select class="form-control" name="TV" required>
                  <option selected value="Y">Ya</option>
                  <option  value="T">Tidak</option>
                </select>
              </div>

              <div class="form-group">
                <label>Wifi</label>
                <select class="form-control" name="Wifi" required>
                  <option selected value="Y">Ya</option>
                  <option  value="T">Tidak</option>
                </select>
              </div>



              <div class="form-group">
                <label>Breakfast</label>
                <select class="form-control" name="Breakfast" required>
                  <option selected value="Y">Ya</option>
                  <option  value="T">Tidak</option>
                </select>
              </div>

              <div class="form-group">
                <label>Lunch</label>
                <select class="form-control" name="Lunch" required>
                  <option selected value="Y">Ya</option>
                  <option  value="T">Tidak</option>
                </select>
              </div>


              <div class="form-group">
                <label>Lemari</label>
                <select class="form-control" name="Lemari" required>
                  <option selected value="Y">Ya</option>
                  <option  value="T">Tidak</option>
                </select>
              </div>

              <div class="form-group">
                <label>AC</label>
                <select class="form-control" name="AC" required>
                  <option selected value="Y">Ya</option>
                  <option  value="T">Tidak</option>
                </select>
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