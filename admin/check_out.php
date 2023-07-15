<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
     Check Out
      <small>Check Out</small>
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
            <h3 class="box-title">Check-out</h3>
                          
          </div>
          <div class="box-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr>
                    <th width="1%">NO</th>
                    <th>KODE TRANSAKSI INAP</th>
                    <th>TANGGAL CHECK_OUT</th>
                    <th>NAMA PEMESAN</th>
                    <th>ALAMAT</th>
                    <th>HP</th>
                    <th width="10%">OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $no=1;
                  $data = mysqli_query($koneksi,"SELECT * FROM check_out,bill,customer,transaksi_inap where check_out.bill_id=bill.bill_id and  customer.no_ktp=transaksi_inap.no_ktp");
                  while($d = mysqli_fetch_array($data)){
                    ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td>TRANSAKSI INAP_00<?php echo $d['id_check_out']; ?></td>
                      <td><?php echo $d['tgl_check_out']; ?></td>
                      <td><?php echo $d['customer_nama']; ?></td>
                      <td><?php echo $d['customer_alamat']; ?></td>
                      <td><?php echo $d['customer_hp']; ?></td>
                      <td>                        
                        <a class="btn btn-warning btn-sm" href="check_out_edit.php?id=<?php echo $d['id_check_out'] ?>"><i class="fa fa-cog"></i></a>
                        <a class="btn btn-danger btn-sm" href="check_out_hapus_konfir.php?id=<?php echo $d['id_check_out'] ?>"><i class="fa fa-trash"></i></a>
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