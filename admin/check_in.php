<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
     Check In
      <small>Check In</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-12">
        <div class="box box-default">

          <div class="box-header">
            <h3 class="box-title">Check-in</h3>
                          
          </div>
          <div class="box-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr>
                    <th width="1%">NO</th>
                    <th>KODE BOOKING</th>
                    <th>TANGGAL CHECK_IN</th>
                    <th>NAMA PEMESAN</th>
                    <th>ALAMAT</th>
                    <th>HP</th>
                    <th width="10%">OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $no=1;
                  $data = mysqli_query($koneksi,"SELECT * FROM check_in,customer,booking_kamar where booking_kamar.booking_id=check_in.booking_id and  customer.customer_id=booking_kamar.customer_id");
                  while($d = mysqli_fetch_array($data)){
                    ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td>CHECK-IN_00<?php echo $d['booking_id']; ?></td>
                      <td><?php echo $d['tgl_check_in']; ?></td>
                      <td><?php echo $d['customer_nama']; ?></td>
                      <td><?php echo $d['customer_alamat']; ?></td>
                      <td><?php echo $d['customer_hp']; ?></td>
                      <td>                        
                        <a class="btn btn-warning btn-sm" href="check_in_edit.php?id=<?php echo $d['kd_check_in'] ?>"><i class="fa fa-cog"></i></a>
                        <a class="btn btn-danger btn-sm" href="check_in_hapus_konfir.php?id=<?php echo $d['kd_check_in'] ?>"><i class="fa fa-trash"></i></a>
                      </td>
                    </tr>
                    <?php 
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>

        </div>
      </section>
    </div>
  </section>

</div>
<?php include 'footer.php'; ?>