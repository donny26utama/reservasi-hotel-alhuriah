<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Customer
      <small>Tambah Customer Baru</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-6">       
        <div class="box box-default">

          <div class="box-header">
            <h3 class="box-title">Tambah Customer Baru</h3>
            <a href="customer.php" class="btn btn-default btn-sm pull-right"><i class="fa fa-reply"></i> &nbsp Kembali</a> 
          </div>



          <div class="box-body">
            <form action="customer_act.php" method="post">
              <div class="form-group">
                <label>No KTP</label>
                <input type="text" maxlength="16" class="form-control" name="no_ktp" required="required" placeholder="Masukkan No KTP">
              </div>

              <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control" name="customer_nama" required="required" placeholder="Masukkan Nama customer..">
              </div>

              <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="customer_email" required="required" placeholder="Masukkan email customer..">
              </div>

              <div class="form-group">
                <label>HP</label>
                <input type="number" class="form-control" name="customer_hp" required="required" placeholder="Masukkan no.hp customer..">
              </div>

              <div class="form-group">
                <label>Alamat</label>
                <input type="text" class="form-control" name="customer_alamat" required="required" placeholder="Masukkan alamat customer..">
              </div>

               <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="customer_password" required="required" placeholder="Masukkan password customer..">
              </div>

              <div class="form-group">
                <input type="submit" class="btn btn-sm btn-primary" value="Simpan">
              </div>
            </form>
          </div>

        </div>
      </section>
    </div>
  </section>

</div>
<?php include 'footer.php'; ?>