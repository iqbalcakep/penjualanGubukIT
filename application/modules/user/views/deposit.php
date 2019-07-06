<!DOCTYPE HTML>
<html>
	<head>
		<title>Penjualan Online</title>

		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/font-awesome/css/font-awesome.min.css">		
		<link href="https://fonts.googleapis.com/css?family=Istok+Web" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,700" rel="stylesheet">
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/magnific-popup.css">

		<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/main.css">
	</head>

	<body>
		<!-- Wrapper -->
		<section class="head" id="header">
			<div class="wrapper">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
						<?php include('header.php'); ?>
							<!-- Menu -->
							<nav id="menu">
								<h2>Menu</h2>
								<ul>
									<li><a href="<?php echo base_url() ?>user/">Home</a></li>
									<li><a href="<?php echo base_url() ?>user/User/deposit">Deposit Saldo</a></li>
									<li><a href="<?php echo base_url() ?>login/Login/log_out">Log Out</a></li>
								</ul>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- Main -->

		<section class="main-body">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<center><p class="drescription">Deposit Saldo Anda</p></center>
					</div>
				</div>
				<div class="tiles">
					<div class="row">
						<div class="form-group">
							<label for="jumlah_deposit">Masukkan Jumlah Deposit </label>
							<input type="text" placeholder="Jumlah Deposit" name="" id="jumlah_deposit" class="form-control form-control-line">
						</div>
						<div class="form-group">
							<input type="button" id="tambahDeposit" value="Deposit Sekarang" class="btn btn-success form-control form-control-line">
							<div id="hasil">

							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section class="footer">		
			<footer>
				<div class="container">
					<div class="row">
						<div class="col-sm-8 col-xs-9">
							<p class="right-color">&copy; Copyright 2019. All rights reserved by Iqbalcakep</a></p>
						</div>
						<div class="col-sm-4 col-xs-3" align="right">
							<a href="#" id="back-to-top" class="top text-right" >TOP <i class="fa fa-angle-up" aria-hidden="true"></i> </a>
						</div>
					</div>
				</div>											
			</footer>
		</section>
	<!-- END MAIN -->

	<!-- Scripts -->

    <script src="<?php echo base_url() ?>assets/js/jquery-3.1.0.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/jquery.magnific-popup.min.js"></script>

	<script src="<?php echo base_url() ?>assets/js/script.js"></script>
	
	<!-- SCRIPT CHECKOUT -->

	<script type="text/javascript">	
		$(document).ready(function(){
			var rupiah = document.getElementById("jumlah_deposit");
			rupiah.addEventListener("keyup", function(e) {
			rupiah.value = formatRupiah(this.value, "Rp. ");
			});

			function formatRupiah(angka, prefix) {
			var number_string = angka.replace(/[^,\d]/g, "").toString(),
				split = number_string.split(","),
				sisa = split[0].length % 3,
				rupiah = split[0].substr(0, sisa),
				ribuan = split[0].substr(sisa).match(/\d{3}/gi);
			if (ribuan) {
				separator = sisa ? "." : "";
				rupiah += separator + ribuan.join(".");
			}
			rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
			return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
			}

			$("#tambahDeposit").click(function(e){
				e.preventDefault();
				var saldo_tambah = parseInt(rupiah.value.replace(/,.*|[^0-9]/g, ''), 10);
				var id_user = "<?= $id_user; ?>";
				var nama_pengirim = "<?= $nama; ?>";
				$.ajax({
					url:"<?= base_url() ?>user/User/addDeposit",
					type:"post",
					data:{id_user,nama_pengirim,saldo_tambah},
					dataType:"json",
					success:function(response){
						if(response==="success"){
							$("#jumlah_deposit").val("");
							$("#hasil").html("<div class='alert alert-success' role='alert'>"+
								"Selamat Transaksi Berhasil"+
								"</div>"
							)
							setTimeout(() => {
								window.location="<?= base_url()?>user"
							}, 1000);
						}else{
							$("#hasil").html("<div class='alert alert-danger' role='alert'>"+
								"Pembelian tidak dapat dilakukan saat ini coba lagi nanti"+
								"</div>"
							)
							setTimeout(() => {
								$("#hasil").html("");
								$("#jumlah_deposit").val("");
							}, 1000);
						}
					},
					error:function(xhr){
						console.log(xhr.responseText);
					}
				})

				
			})
			
		})
	</script>

	<!--  ===== Scroll to Top ====  -->
	    <script>
			if ($('#back-to-top').length) {
			    $('#back-to-top').on('click', function (e) {
			        e.preventDefault();
			        $('html,body').animate({
			            scrollTop: 0
			        }, 700);
			    });
			}
		</script>
    <!--  ===== END Scroll to Top ====  -->		
	</body>
</html>