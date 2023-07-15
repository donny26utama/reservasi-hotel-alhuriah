<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
     BILL
      <small>Data BILL</small>
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
            <h3 class="box-title">BILL</h3>
          </div>
          <div class="box-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr>
                    <th width="1%">NO</th>
                    <th>NO BILL</th>
                    <th>TANGGAL BILL</th>
                    <th>NAMA PEMESAN </th>
                    <th>JENIS KAMAR </th>
                    <th>KETERANGAN </th>
                    <th class="text-center" width="30%">OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $no = 1;
                 $data = mysqli_query($koneksi,"SELECT * FROM bill,pembayaran,customer,transaksi_inap,mempunyai where bill.bill_id=check_out.bill_id and  customer.no_ktp=transaksi_inap.no_ktp and transaksi_inap.id_transaksi=mempunyai.id_transaksi");
                  while($i = mysqli_fetch_array($data)){
                    ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td>BILL_00<?php echo $i['bill_id']; ?></td>
                      <td><?php echo $i['tanggal']; ?></td>
                      <td><?php echo $i['customer_nama'] ?></td>
                      <td><?php echo $i['kamar_kategori'] ?></td>
                      <td><?php echo $i['keterangan'] ?></td>
                     
                      <td class="text-center">    
                           
                              <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                        </div>

                        <a class='btn btn-sm btn-danger' onclick="return confirm('Yakin ingin hapus?')" href="transaksi_hapus.php?id=<?php echo $i['bill_id']; ?>"><i class="fa fa-trash"></i></a>
                        
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