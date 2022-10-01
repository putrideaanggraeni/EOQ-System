<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
		<title>Kawan Ban</title>
		<link rel="shortcut icon" href="<?=base_url()?>assets/kawanbanlogo.png" type="image/x-icon" class="img-circle profile_img">

		<!-- Bootstrap CSS CDN JS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"> </script>
		<script src="<?php echo base_url();?>assets/dist/libs/apexcharts/dist/apexcharts/min.js"></script>
		<script src="<?php echo base_url();?>assets/dist/libs/bootstrap/dist/js/bootstrap-bundle.min.js"></script>
		<script src="<?php echo base_url();?>assets/dist/libs/apexcharts/dist/apexcharts.min.js"></script>
		<!-- Datatables CDN -->
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css"> </script>
		<!-- Custom CSS -->
		<link rel="stylesheet" href="<?=base_url()?>assets/style.css">
		<!-- Font Awesome JS -->
		<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
		<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="fontawesome/css/all.css">
		<!--SweetAlert-->
		<link rel ="stylesheet" href="<?php echo base_url();?>assets/dist/libs/sweetalert/sweetalert2.min.css">
	
	</head>

	<body>
		<div class="wrapper">
			<!-- Sidebar  -->
			<nav id="sidebar">
			
				<div class="sidebar-header">
					<h3>Kawan Ban</h3>
					<div class="profile clearfix">
					<div class="profile_pic">
					 <a href="<?=site_url('profile')?>">
					   <img src="<?=base_url('assets/images/') . $this->fungsi->user_login()->gambar?>" height="55" width="55" alt="" class="img-circle profile_img">
					</div>
					<div class="profile_info">
						<span><?= $this->fungsi->user_login()->username?></span>
						 <h2><?= $this->fungsi->user_login()->nama?></h2> </a>
					</div>
					</div>
				</div>

				<ul class="list-unstyled components">
					<li class="active" >
						<a href="<?=site_url('dashboard')?>"> <i class="fas fa-chart-line"> </i>   Dashboard </a>
					</li>
					<?php if($this->session->userdata('level') == 1) { ?>
					<li>
						<a href="<?=site_url('user')?>"> <i class="fas fa-user"></i> User</a>
					</li>
					<li>
						<a href="<?=site_url('customer')?>"><i class="fas fa-users"></i>  Customer</a>
					</li>
					<li>
						<a href="<?=site_url('diskon')?>"><i class="fas fa-percent"></i>  Diskon</a>
					</li>
					<li>
						<a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> <i class="fas fa-box"></i> Barang</a>
					<ul class="collapse list-unstyled" id="homeSubmenu">
					<li>
						<a href="<?=site_url('kategori')?>"><i class="fas fa-th"></i>  Kategori</a>
						<a href="<?=site_url('brand')?>"><i class="fas fa-cubes"></i>  Brand</a>
						<a href="<?=site_url('item')?>"><i class="fas fa-boxes"></i> Items</a>
					</li>
					</ul>
					</li>
					
					<li>
						<a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> <i class="fas fa-box"></i> Stock</a>
					<ul class="collapse list-unstyled" id="pageSubmenu">
					<li>
						<a href="<?=site_url('stock/in')?>"><i class="fas fa-boxes"></i> Stock In</a>
						<a href="<?=site_url('stock/out')?>"><i class="fas fa-boxes"></i> Stock Out</a>
					</li>
					</ul>
					</li>
					<?php } ?>
					<?php if($this->session->userdata('level') == 2) { ?>
					<li>
						<a href="<?=site_url('transaksi')?>"><i class="fas fa-cart-plus"></i> Transaksi Penjualan</a>
					</li>
					<?php } ?>
					<?php if($this->session->userdata('level') == 1 || $this->session->userdata('level') == 3 ) { ?>
					<li>
					<a href="#pageSubmenu2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> <i class="fas fa-calculator"></i> Analisa EOQ dan ROP</a>
					<ul class="collapse list-unstyled" id="pageSubmenu2">
					<?php } ?>
					<li>
						<?php if($this->session->userdata('level') == 1) { ?>
						<a href="<?=site_url('EOQ/kelola')?>"> <i class="fa fa-file-alt"> </i> Kelola Kriteria EOQ dan ROP</a>
						<?php } ?>
						<?php if($this->session->userdata('level') == 1 || $this->session->userdata('level') == 3 ) { ?>
						<a href="<?=site_url('EOQ')?>"><i class="fa fa-file"> </i> Hasil Analisa EOQ dan ROP</a>
					</li>
					</ul>
					</li>
					<?php } ?>
					<?php if($this->session->userdata('level') == 3 ) { ?>
					<li>
						<a href="<?=site_url('laporan')?>"><i class="fa fa-file-medical-alt"></i> Laporan Penjualan</a>
					</li>
					<?php } ?>
				</ul>
				<ul class="list-unstyled CTAs">
					<li>
						<a href="<?=site_url('auth/logout')?>" class="logout">Logout</a>
					</li>
				</ul>
			</nav>
        <!-- Page Content  -->
		<?php echo $contents ?>
        
		
    </div>
</body>
</html>	
	<!-- Swal JS -->
	<script src="<?php echo base_url();?>assets/dist/libs/sweetalert/sweetalert2.min.js"></script>
    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
	<!--datatables-->
	<script src="main.js"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
	
	<script>
	//swal.fire('Any fool can use a computer')
	</script>
	
	<script>
	var flash = $('#flash').data('flash');
	var flasherror = $('#flasherror').data('flasherror');
	if(flash) {
		Swal.fire({
			icon: 'success',
			title: 'Success',
			text: flash,
			confirmButtonColor: '#1E90FF'
		})
	}
	
	if(flasherror) {
		Swal.fire({
			icon: 'errpr',
			title: 'Error',
			text: flasherror
		})
	}
	
	$(document).on('click', '#btn-hapus', function(e) {
		e.preventDefault();
		var link = $(this).attr('href');
		
		Swal.fire({
			title: 'Apakah Anda Yakin?',
			text: "Data akan dihapus!",
			icon : 'warning',
			showCancelButton: true,
			confirmButtonColor: '#1E90FF',
			cancelButtonColor: '#87CEFA',
			confirmButtonText: 'Ya, Hapus Data!'
		}).then((result) => {
			if (result.isConfirmed) {
				window.location = link;
			}	
		})
	})
	</script>
	
	
	<script>
	$('.custom-file-input').on('change', function() {
		let fileName = $(this).val().split('\\').pop();
		$(this).next('.custom-file-label').addClass("selected").html(fileName);
	});
	</script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
				$(this).toggleClass('active');
            });
        });
    </script>


	<script>
	$(document).ready(function() {
		$('#example').DataTable();
	} );
	</script>
	<script>
	$(document).ready(function() {
		$('#example2').DataTable();
	} );
	</script>
</body>
</html>	