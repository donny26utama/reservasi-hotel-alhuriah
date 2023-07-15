<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Kamar
      <small>Tambah Kamar Baru</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-12">       
        <div class="box">

          <div class="box-header">
            <h3 class="box-title">Tambah Kamar</h3>
            <a href="kamar.php" class="btn btn-default btn-sm pull-right"><i class="fa fa-reply"></i> &nbsp Kembali</a> 
          </div>
          <div class="box-body">

            <form action="kamar_act.php" method="post" enctype="multipart/form-data">



              <div class="row">

                <div class="col-lg-6">
                  <div class="form-group">
                    <label>Nama Kamar</label>
                    <input type="text" class="form-control" name="kamar_nama" required="required" placeholder="Masukkan Nama Kamar..">
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="form-group">
                    <label>Jenis Ranjang</label>
                    <select name="kamar_ranjang" required="required" class="form-control">
                      <option value="">- Pilih Ranjang Kamar -</option>
                      <option value="Single">Single</option>
                      <option value="Double">Double</option>
                      <option value="King">King</option>
                    </select>
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="form-group">
                    <label>Ukuran Kamar</label>
                    <input type="number" class="form-control" name="kamar_ukuran" required="required" placeholder="Masukkan Ukuran Kamar (m2) ..">
                  </div>
                </div>


                <div class="col-lg-6">
                  <div class="form-group">
                    <label>Kategori Kamar</label>
                    <select name="kamar_kategori" required="required" class="form-control">
                      <option value="">--Pilih Kategori Kamar--</option>
                      <option>standart</option>
                      <option>superior</option>
                       <option>bussiness</option>
                       <option>deluxe</option>
                    </select>
                  </div>
                </div>


                <div class="col-lg-6">
                  <div class="form-group">
                    <label>Harga</label>
                    <input type="number" class="form-control" name="kamar_harga" required="required" placeholder="Masukkan Harga / malam ..">
                  </div>
                </div>


                <div class="col-lg-6">
                  <div class="form-group">
                    <label>Jumlah Kamar</label>
                    <input type="number" class="form-control" name="kamar_jumlah" required="required" placeholder="Masukkan Jumlah Kamar ..">
                  </div>
                </div>


                <div class="col-lg-4">
                  <div class="form-group">
                    <label>Foto 1 (Foto Utama)</label>
                    <input type="file" name="kamar_foto1">
                  </div>
                </div>


      
              <br>
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