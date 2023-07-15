<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Admin
      <small>Data Admin</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Data Admin</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-12">
        <div class="box">

          <div class="box-header">
            <h3 class="box-title">Admin</h3>
            <a href="admin_tambah.php" class="btn btn-default btn-sm pull-right"><i class="fa fa-plus"></i> &nbsp Tambah Admin Baru</a>              
          </div>
          <div class="box-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr>
                    <th width="1%">NO</th>
                    <th>NAMA</th>
                    <th>USERNAME</th>
                    
                    <th width="10%">OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  include '../koneksi.php';
                  $no=1;
                  $data = mysqli_query($koneksi,"SELECT * FROM admin");
                  while($d = mysqli_fetch_array($data)){
                    ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $d['admin_nama']; ?></td>
                      <td><?php echo $d['admin_username']; ?></td>

                      <td>                        
                        <a class="btn btn-warning btn-sm" href="admin_edit.php?id=<?php echo $d['admin_username'] ?>"><i class="fa fa-cog"></i></a>
                        
                          <a class="btn btn-danger btn-sm" href="admin_hapus.php?id=<?php echo $d['admin_username'] ?>"><i class="fa fa-trash"></i></a>
                       
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