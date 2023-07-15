<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Resepsionis
      <small>Tambah Resepsionis Baru</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Data Resepsionis</li>
      <li class="active">Tambah</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-6">       
        <div class="box">

          <div class="box-header">
            <h3 class="box-title">Tambah Resepsionis</h3>
            <a href="resepsionis.php" class="btn btn-default btn-sm pull-right"><i class="fa fa-reply"></i> &nbsp Kembali</a> 
          </div>
          <div class="box-body">
            <form action="resepsionis_act.php" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control" name="nama" required="required" placeholder="Masukkan Nama ..">
              </div>
              <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" name="username" required="required" placeholder="Masukkan Username ..">
              </div>
              <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" required="required" min="5" placeholder="Masukkan Password ..">
              </div>
              <div class="form-group">
                <label>Foto</label>
                <input type="file" name="foto">
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