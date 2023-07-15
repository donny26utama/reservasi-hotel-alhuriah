<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Check-out
      <small>Edit Check-out</small>
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
            <h3 class="box-title">Edit Check-out</h3>
            <a href="check_out.php" class="btn btn-default btn-sm pull-right"><i class="fa fa-reply"></i> &nbsp Kembali</a> 
          </div>
          <div class="box-body">


            <?php 
            $id = $_GET['id'];
            $data = mysqli_query($koneksi,"SELECT * FROM check_out,bill,customer,transaksi_inap where check_out.bill_id=bill.bill_id and  customer.no_ktp=transaksi_inap.no_ktp");
            while($d = mysqli_fetch_array($data)){
              ?>
              <form action="check_out_update.php" method="post">
                <div class="form-group">

                 <label>Tanggal CHECK-OUT</label>
                  <input type="hidden" name="id" value="<?php echo $d['id_check_out']; ?>">
                  <input type="date" class="form-control" name="tanggal" required="required" placeholder="Masukkan tanggal check-out.." value="<?php echo $d['tgl_check_out']; ?>">
                </div>

                  <label>NAMA PEMESAN</label>
                  <input type="hidden" name="id" value="<?php echo $d['no_ktp']; ?>">
                  <input type="text" class="form-control" name="nama" required="required" placeholder="Masukkan Nama customer.." value="<?php echo $d['customer_nama']; ?>">
                </div>

                  <div class="form-group">
                  <label>Alamat</label>
                  <input type="text" class="form-control" name="alamat" required="required" placeholder="Masukkan alamat customer.." value="<?php echo $d['customer_alamat']; ?>">
                </div>

                <div class="form-group">
                  <label>HP</label>
                  <input type="number" class="form-control" name="hp" required="required" placeholder="Masukkan no.hp customer.." value="<?php echo $d['customer_hp']; ?>">
                </div>

                <div class="form-group">
                  <input type="submit" class="btn btn-sm btn-primary" value="Simpan">
                </div>
              </form>
              <?php 
            }
            ?>

          </div>

        </div>
      </section>
    </div>
  </section>

</div>
<?php include 'footer.php'; ?>