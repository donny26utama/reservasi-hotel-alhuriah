 <?php include('header.php'); ?>


 <!-- Breadcrumb Section Begin -->
 <section class="breadcrumb-option">
 	<div class="container">
 		<div class="row">
 			<div class="col-lg-12">
 				<div class="breadcrumb__text">
 					<h4>Kamar</h4>
 					<div class="breadcrumb__links">
 						<a href="index.php">Home</a>
 						<span>Kamar</span>
 					</div>
 				</div>
 			</div>
 		</div>
 	</div>
 </section>
 <!-- Breadcrumb Section End -->

 <!-- Shop Section Begin -->
 <section class="shop spad">
 	<div class="container">
 		<div class="row">


 			
 			<div class="col-lg-12">



 				<div class="shop__product__option">
 					<div class="row">
 						<div class="col-lg-6 col-md-6 col-sm-6">
 							<div class="shop__product__option__left">
 								<?php 
 								if(isset($_GET['cari'])){
 									?>
 									Hasil Pencarian : <b><?php echo htmlspecialchars($_GET['cari']); ?></b>
 									<?php
 								}else{
 									?>
 									<p>Pilih kamar terbaikmu!</p>
 									<?php
 								}
 								?>
 							</div>
 						</div>
 						<div class="col-lg-6 col-md-6 col-sm-6">
 							<div class="shop__product__option__right">

 								<form action="" method="get">
 									<p>Sort by Price:</p>


 									<?php 
 									if(isset($_GET['cari'])){
 										$c = "&cari=".$_GET['cari'];
 										?>
 										<input type="hidden" name="cari" value="<?php echo $_GET['cari']; ?>">
 										<?php
 									}else{
 										?>

 										<?php
 									}
 									?>

 									<select name="urutan" onchange="this.form.submit()">
 										<option <?php if(isset($_GET['urutan']) && $_GET['urutan'] == "termahal"){echo "selected='selected'";} ?> value="termahal">Termahal</option>
 										<option <?php if(isset($_GET['urutan']) && $_GET['urutan'] == "termurah"){echo "selected='selected'";} ?> value="termurah">Termurah</option>
 									</select>
 								</form>
 								
 							</div>
 						</div>
 					</div>
 				</div>
 				<div class="row">

 					

 					<?php



 					$halaman = 9;
 					$page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
 					$mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
						// $result = mysqli_query($koneksi, "SELECT * FROM kamar");

 					if(isset($_GET['urutan']) && $_GET['urutan'] == "termurah"){
 						if(isset($_GET['cari'])){
 							$cari = $_GET['cari'];
 							$result = mysqli_query($koneksi,"select * from kamar where kamar_nama like '%$cari%' order by kamar_harga asc");
 						}else{
 							$result = mysqli_query($koneksi,"select * from kamar  order by kamar_harga asc");
 						}
 					}else{

 						if(isset($_GET['cari'])){
 							$cari = $_GET['cari'];
 							$result = mysqli_query($koneksi,"select * from kamar where kamar_nama like '%$cari%' order by kamar_harga desc");
 						}else{
 							$result = mysqli_query($koneksi,"select * from kamar  order by kamar_harga desc");
 						}

 					}    

 					$total = mysqli_num_rows($result);
 					$pages = ceil($total/$halaman);  
 					if(isset($_GET['urutan']) && $_GET['urutan'] == "termurah"){
 						if(isset($_GET['cari'])){
 							$cari = $_GET['cari'];
 							$data = mysqli_query($koneksi,"select * from kamar where kamar_nama like '%$cari%' order by kamar_harga asc LIMIT $mulai, $halaman");
 						}else{
 							$data = mysqli_query($koneksi,"select * from kamar   order by kamar_harga asc LIMIT $mulai, $halaman");
 						}
 					}else{

 						if(isset($_GET['cari'])){
 							$cari = $_GET['cari'];
 							$data = mysqli_query($koneksi,"select * from kamar where kamar_nama like '%$cari%' order by kamar_harga desc LIMIT $mulai, $halaman");
 						}else{
 							$data = mysqli_query($koneksi,"select * from kamar   order by kamar_harga desc LIMIT $mulai, $halaman");
 						}

 					}          
 					$no =$mulai+1;

 					while($d = mysqli_fetch_array($data)){
 						?>


 						<div class="col-lg-4 col-md-6 col-sm-6">
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
 									<h6><?php echo $d['kamar_nama'] ?> <?php echo $d['kamar_ranjang'] ?> Bed</h6>
 									<a href="kamar_detail.php?id=<?php echo $d['kamar_id']; ?>" class="add-cart"><i class="fa fa-eye"></i> Lihat kamar</a>
 									<small class="text-muted"><?php echo $d['kamar_kategori'] ?></small>
 									
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

 				<?php 
 				if($total == 0){
 					?>
 					<center><h4>Belum ada kamar.</h4></center>
 					<?php
 				}
 				?>


 				<div class="row">
 					<div class="col-lg-12">
 						<div class="product__pagination">

 							<?php for ($i=1; $i<=$pages ; $i++){ ?>
 								<?php if($page==$i){ ?>
 									<a class="active"><?php echo $i; ?></a>
 								<?php }else{ ?>

 									<?php 
 									if(isset($_GET['cari'])){
 										$cari = $_GET['cari'];
 										$c = "&cari=".$cari;
 									}else{
 										$c = "";
 									}
 									if(isset($_GET['urutan']) && $_GET['urutan'] == "harga"){
 										?>
 										<a href="?halaman=<?php echo $i; ?>&urutan=harga<?php echo $c ?>"><?php echo $i; ?></a>
 										<?php 
 									}else{
 										?>
 										<a href="?halaman=<?php echo $i; ?><?php echo $c ?>"><?php echo $i; ?></a>
 										<?php
 									}
 									?>

 								<?php } ?>
 							<?php } ?>

 						</div>
 					</div>
 				</div>
 			</div>
 		</div>
 	</div>
 </section>
 <!-- Shop Section End -->


 <?php include('footer.php'); ?>