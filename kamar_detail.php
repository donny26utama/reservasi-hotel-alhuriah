 <?php include('header.php'); ?>

<?php
  if (isset($_SESSION['customer_id'])) {
    $belumlogin = FALSE;
  } else {
    $belumlogin = TRUE;
  }
?>

 <?php 


 $id_kamar = mysqli_real_escape_string($koneksi, $_GET['id']);
 $data = mysqli_query($koneksi,"select * from kamar where   kamar_id='$id_kamar'");
 while($d=mysqli_fetch_array($data)){
 	?>
 	<!-- Shop Details Section Begin -->
 	<section class="shop-details">
 		<div class="product__details__pic">
 			<div class="container">

 				<div class="row">
 					<div class="col-lg-3 col-md-3">
 						<ul class="nav nav-tabs" role="tablist">

 							<?php if($d['kamar_foto1'] == ""){ ?>
 								<li class="nav-item">
 									<a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">
 										<div class="product__thumb__pic set-bg" data-setbg="gambar/sistem/kamar.png"></div>
 									</a>
 								</li>
 							<?php }else{ ?>
 								<li class="nav-item">
 									<a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">
 										<div class="product__thumb__pic set-bg" data-setbg="gambar/kamar/<?php echo $d['kamar_foto1'] ?>"></div>
 									</a>
 								</li>
 							<?php } ?>

 							

 						</ul>
 					</div>
 					<div class="col-lg-6 col-md-9">
 						<div class="tab-content">

 							<?php if($d['kamar_foto1'] == ""){ ?>
 								<div class="tab-pane active" id="tabs-1" role="tabpanel">
 									<div class="product__details__pic__item">
 										<img src="gambar/sistem/kamar.png" alt="">
 									</div>
 								</div>
 							<?php }else{ ?>
 								<div class="tab-pane active" id="tabs-1" role="tabpanel">
 									<div class="product__details__pic__item">
 										<img src="gambar/kamar/<?php echo $d['kamar_foto1'] ?>" alt="">
 									</div>
 								</div>
 							<?php } ?>

 							

 						</div>
 					</div>
 				</div>
 			</div>
 		</div>
 		<div class="product__details__content">
 			<div class="container">
 				<div class="row d-flex justify-content-center">
 					<div class="col-lg-8">
 						<div class="product__details__text">
 							<h2 class="font-weight-bold"><?php echo $d['kamar_nama']; ?></h2>
 							
 							<br>

 							<h4><?php echo "Rp. ".number_format($d['kamar_harga']).",-"; ?> / Malam </h4>

 							<br>
 							<p class="mb-0">Pelayanan kamar terbaik untuk menemani waktu liburanmu bersama keluarga, kerabat atau orang-orang tersayang. jangan lewatkan, segera booking sekarang!</p>
 							<br>
 							<p class="mb-0">Fasilitas :</p>
 							<div class="shop__sidebar__tags mb-5">
                <?php
                  $idkamarnya = $d['kamar_id'];
                  $qfasilitas = mysqli_query($koneksi,"select * from fasilitas_kamar where kamar_id='$idkamarnya'");
                  $dtfasilitas = mysqli_fetch_object($qfasilitas);
                  echo ($dtfasilitas->Shower=="Y") ? '<a class="btn-default">Shower</a>' : "";
                  echo ($dtfasilitas->Closet_Jongkok=="Y") ? '<a class="btn-default">Closet Jongkok</a>' : "";
                  echo ($dtfasilitas->Closet_Duduk=="Y") ? '<a class="btn-default">Closet Duduk</a>' : "";
                  echo ($dtfasilitas->TV=="Y") ? '<a class="btn-default">TV</a>' : "";
                  echo ($dtfasilitas->Wifi=="Y") ? '<a class="btn-default">Wifi</a>' : "";
                  echo ($dtfasilitas->Breakfast=="Y") ? '<a class="btn-default">Breakfast</a>' : "";
                  echo ($dtfasilitas->Lunch=="Y") ? '<a class="btn-default">Lunch</a>' : "";
                  echo ($dtfasilitas->Lemari=="Y") ? '<a class="btn-default">Lemari</a>' : "";
                  echo ($dtfasilitas->AC=="Y") ? '<a class="btn-default">AC</a>' : "";
                ?>
                      
                  
 							</div>

 							<?php 
 								$jumlahkamar = $d['kamar_jumlah']; 

 								/*$qcek = mysqli_query($koneksi,"select count(*) N from terima  where  kamar_id='$id_kamar'");
 								$dtcek=mysqli_fetch_object($qcek);
 								$kamardipesan = $dtcek->N;*/
 							?>
                          
                          
                        <style>
                            .not-allowed{
                             cursor: not-allowed! important;
                                
                            }
                          </style>    

 							<div class="product__details__cart__option"> 	
                <?php
                  if ($belumlogin==TRUE):
                    #belum login gak boleh booking
                    ?><span class="primary-btn not-allowed" title="Login dulu">Booking Kamar</span><?php
                  elseif ($belumlogin==FALSE):
                    #sudah login boleh booking
                    ?><a href="booking.php?id=<?php echo $d['kamar_id'] ?>" class="primary-btn">Booking Kamar</a><?php
                  endif;
                ?>							
 								
 							</div>

 							<div class="product__details__last__option">	
 								<ul>
 									<li><span>Ukuran Kamar:</span> <?php echo $d['kamar_ukuran'] ?> m2</li>
 									<li><span>Ranjang:</span> <?php echo $d['kamar_ranjang'] ?></li>
 									<li><span>Kategori:</span> <?php echo $d['kamar_kategori'] ?></li>
 								</ul>
 							</div>
 						</div>
 					</div>
 				</div>
 				
 									</div>
 								</div>
 								
 							</div>
 						</div>
 					</div>
 				</div>
 			</div>
 		</div>
 	</section>
 	<!-- Shop Details Section End -->

 	<?php 
 }
 ?>


 <br>
 <br>

 <div class="container">
 	<hr>	
 </div>
 <br>
 <br>

 <!-- Related Section Begin -->
 <section class="related spad">
 	<div class="container">
 		<div class="row">
 			<div class="col-lg-12">
 				<h3 class="related-title">Rekomendasi Kamar Lainnya</h3>
 			</div>
 		</div>
 		<div class="row">

 			<?php           
 			$data = mysqli_query($koneksi,"select * from kamar   order by rand() limit 4");
 			while($d = mysqli_fetch_array($data)){
 				?>

 				<div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
 					<div class="product__item">
 						
 						<?php if($d['kamar_foto1'] == ""){ ?>

 							<ul class="product__hover">
 								<li>
 									<a href="kamar_detail.php?id=<?php echo $d['kamar_id']; ?>">
 										<img src="gambar/sistem/kamar.png">
 									</a>
 								</li>
 							</ul>
 						<?php }else{ ?>

 							<ul class="product__hover">
 								<li>
 									<a href="kamar_detail.php?id=<?php echo $d['kamar_id']; ?>">
 										<img src="gambar/kamar/<?php echo $d['kamar_foto1'] ?>">
 									</a>
 								</li>
 							</ul>

 						<?php } ?>



 						<div class="product__item__text">
 							<h6><?php echo $d['kamar_nama'] ?></h6>
 							<a href="kamar_detail.php?id=<?php echo $d['kamar_id']; ?>" class="add-cart"><i class="fa fa-eye"></i> Lihat kamar</a>
 							<small class="text-muted"><?php echo $d['kamar_kategori'] ?></small>
 							<div class="rating">
 								
 								<?php 
 								$rata = bintang($d['kamar_id']);
 								?>

 								<?php if($rata >= 1){ ?>
 									<i class="fa fa-star text-warning"></i>
 								<?php }else{ ?>
 									<i class="fa fa-star-o"></i>
 								<?php } ?>
 								<?php if($rata >= 2){ ?>
 									<i class="fa fa-star text-warning"></i>
 								<?php }else{ ?>
 									<i class="fa fa-star-o"></i>
 								<?php } ?>
 								<?php if($rata >= 3){ ?>
 									<i class="fa fa-star text-warning"></i>
 								<?php }else{ ?>
 									<i class="fa fa-star-o"></i>
 								<?php } ?>
 								<?php if($rata >= 4){ ?>
 									<i class="fa fa-star text-warning"></i>
 								<?php }else{ ?>
 									<i class="fa fa-star-o"></i>
 								<?php } ?>
 								<?php if($rata >= 5){ ?>
 									<i class="fa fa-star text-warning"></i>
 								<?php }else{ ?>
 									<i class="fa fa-star-o"></i>
 								<?php } ?>

 							</div>
 							<h5><?php echo "Rp. ".number_format($d['kamar_harga']).",-"; ?></h5>
 							<div class="product__color__select">

 								<small class="text-muted"><?php echo $d['kamar_kategori'] ?></small>

 							</div>
 						</div>

 					</div>
 				</div>

 				


 				<?php 
 			}
 			?>
 			
 			
 		</div>
 	</div>
 </section>
 <!-- Related Section End -->


 <?php include('footer.php'); ?>