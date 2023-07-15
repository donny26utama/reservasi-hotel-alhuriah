<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Layanan Tambahan
      <small>Tambah Layanan Tambahan Baru</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Layanan Tambahan</li>
      <li class="active">Tambah</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-6">   

        <div class="box">

          <div class="box-header">
            <h3 class="box-title">Tambah Layanan Tambahan</h3>
            <a href="layanan_tambahan.php" class="btn btn-default btn-sm pull-right"><i class="fa fa-reply"></i> &nbsp Kembali</a> 
          </div>
          <div class="box-body">

            <form action="layanan_tambahan_act.php" method="post">

              <div class="form-group">
                <label>Nama Layanan</label>
                <input type="text" class="form-control" name="nama" required="required" placeholder="Masukkan Nama Fasilitas..">
              </div>

              <div class="form-group">
                <label>Harga</label>
                <input type="number" class="form-control" name="harga" required="required" placeholder="Masukkan Nama Fasilitas..">
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