<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Fasilitas
      <small>Tambah Fasilitas Baru</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Fasilitas</li>
      <li class="active">Tambah</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-6">   

        <div class="box">

          <div class="box-header">
            <h3 class="box-title">Tambah Fasilitas</h3>
            <a href="fasilitas.php" class="btn btn-default btn-sm pull-right"><i class="fa fa-reply"></i> &nbsp Kembali</a> 
          </div>
          <div class="box-body">

            <form action="fasilitas_act.php" method="post">

              <div class="form-group">
                <label>Nama Fasilitas</label>
                <input type="text" class="form-control" name="nmfas" required="required" placeholder="Masukkan Nama Fasilitas..">
              </div>

              <div class="form-group">
                <label>Harga</label>
                <input type="number" class="form-control" name="hrgfas" required="required" placeholder="Masukkan Harga Fasilitas..">
              </div>

              <br>
              
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