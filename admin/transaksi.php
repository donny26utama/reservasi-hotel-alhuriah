<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      INvoice
      <small>DATA INVOICE</small>
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
            <h3 class="box-title">INVOICE</h3>
          </div>
          <div class="box-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr>
                    <th width="1%">NO</th>
                    <th>NO.INVOICE</th>
                    <th>CUSTOMER</th>
                    <th>TOTAL BAYAR</th>
                    <th class="text-center" width="30%">OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $no = 1;
                  $invoice = mysqli_query($koneksi,"select * from invoice,customer where customer_id=invoice_customer order by invoice_id desc");
                  while($i = mysqli_fetch_array($invoice)){
                    ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td>
                        <?php echo date('d-m-Y', strtotime($i['invoice_tanggal'])); ?>
                        <br>
                        INVOICE-00<?php echo $i['invoice_id'] ?>
                      </td>
                      <td><?php echo $i['customer_nama'] ?></td>
                      <td><?php echo "Rp. ".number_format($i['invoice_total_bayar'])." ,-" ?></td>
                      
                      <td class="text-center">    
                             

                        <a class='btn btn-sm btn-success' href="transaksi_invoice.php?id=<?php echo $i['invoice_id']; ?>"><i class="fa fa-print"></i> Invoice</a>
                        <a class='btn btn-sm btn-danger' onclick="return confirm('Yakin ingin hapus?')" href="transaksi_hapus.php?id=<?php echo $i['invoice_id']; ?>"><i class="fa fa-trash"></i></a>
                        <a class='btn btn-sm btn-warning' href="transaksi_rating.php?id=<?php echo $i['invoice_id']; ?>"><i class="fa fa-star"></i> Rating</a>
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