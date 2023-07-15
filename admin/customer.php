<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Customer
      <small>Data Customer</small>
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
            <h3 class="box-title">Customer</h3>
            <a href="customer_tambah.php" class="btn btn-default btn-sm pull-right"><i class="fa fa-plus"></i> &nbsp Tambah Customer Baru</a>              
          </div>
          <div class="box-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr>
                    <th width="1%">NO</th>
                    <th>NAMA</th>
                    <th>EMAIL</th>
                    <th>HP</th>
                    <th>NO.KTP</th>
                    <th>ALAMAT</th>
                    <th width="10%">OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $no=1;
                  $data = mysqli_query($koneksi,"SELECT * FROM customer");
                  while($d = mysqli_fetch_array($data)){
                    ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $d['customer_nama']; ?></td>
                      <td><?php echo $d['customer_email']; ?></td>
                      <td><?php echo $d['customer_hp']; ?></td>
                       <td><?php echo $d['no_ktp']; ?></td>
                      <td><?php echo $d['customer_alamat']; ?></td>
                      <td>                        
                        <a class="btn btn-warning btn-sm" href="customer_edit.php?id=<?php echo $d['no_ktp'] ?>"><i class="fa fa-cog"></i></a>
                        <a class="btn btn-danger btn-sm" href="customer_hapus_konfir.php?id=<?php echo $d['no_ktp'] ?>"><i class="fa fa-trash"></i></a>
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