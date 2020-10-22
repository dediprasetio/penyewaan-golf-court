<?php  
	if (@$this->session->userdata('level')) {
		redirect('Admin','refresh');
	}
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<title><?= $data['title'] ?></title>
	<link rel="shortcut icon" href="<?= base_url('assets/users/assets/images/logo.png') ?>" />

	<!-- All Plugins Css -->
	<link rel="stylesheet" href="<?= base_url('assets/users/') ?>assets\css\plugins.css">


	<!-- Custom CSS -->
	<link href="<?= base_url('assets/users/') ?>assets\css\styles.css" rel="stylesheet">

	<!-- Custom Color Option -->
	<link href="<?= base_url('assets/users/') ?>assets\css\colors.css" rel="stylesheet">
		<!-- ============================================================== -->
	<!-- All Jquery -->
	<!-- ============================================================== -->
	<script src="<?= base_url('assets/users/') ?>assets\js\jquery.min.js"></script>
	<script src="<?= base_url('assets/users/') ?>assets\js\circleMagic.min.js"></script>
	<script src="<?= base_url('assets/users/') ?>assets\js\popper.min.js"></script>
	<script src="<?= base_url('assets/users/') ?>assets\js\bootstrap.min.js"></script>
	<script src="<?= base_url('assets/users/') ?>assets\js\rangeslider.js"></script>
	<script src="<?= base_url('assets/users/') ?>assets\js\select2.min.js"></script>
	<script src="<?= base_url('assets/users/') ?>assets\js\aos.js"></script>
	<script src="<?= base_url('assets/users/') ?>assets\js\owl.carousel.min.js"></script>
	<script src="<?= base_url('assets/users/') ?>assets\js\jquery.magnific-popup.min.js"></script>
	<script src="<?= base_url('assets/users/') ?>assets\js\slick.js"></script>
	<script src="<?= base_url('assets/users/') ?>assets\js\slider-bg.js"></script>
	<script src="<?= base_url('assets/users/') ?>assets\js\lightbox.js"></script> 
	<script src="<?= base_url('assets/users/') ?>assets\js\imagesloaded.js"></script>
	<script src="<?= base_url('assets/users/') ?>assets\js\isotope.min.js"></script>

	<script src="<?= base_url('assets/users/') ?>assets\js\custom.js"></script>
	<!-- ============================================================== -->
	<!-- This page plugins -->
	<!-- ============================================================== -->

	<!-- Date Booking Script -->
	<script src="<?= base_url('assets/users/') ?>assets\js\moment.min.js"></script>
	<script src="<?= base_url('assets/users/') ?>assets\js\daterangepicker.js"></script>

</head>

<body class="orange-skin">
	
	<!-- ============================================================== -->
	<!-- Preloader - style you can find in spinners.css -->
	<!-- ============================================================== -->
	<div id="preloader"><div class="preloader"><span></span><span></span></div></div>

	<!-- ============================================================== -->
	<!-- Main wrapper - style you can find in pages.scss -->
	<!-- ============================================================== -->
	<div id="main-wrapper">
		
		<!-- ============================================================== -->
		<!-- Top header  -->
		<!-- ============================================================== -->
		<!-- Start Navigation -->
		<div class="topbar-head">
			<?= $this->load->view('Users/layouts/header', '', TRUE); ?>
		</div>
		<div class="header header-light">
			<?= $this->load->view('Users/layouts/sub_header', '', TRUE); ?>
		</div>
		<!-- End Navigation -->
		<div class="clearfix"></div>
		<!-- ============================================================== -->
		<!-- Top header  -->
		<!-- ============================================================== -->
		

		<div>
			<?= @$content ? $this->load->view($content, '', TRUE) : ''; ?>
		</div>


		<!-- ============================ Footer Start ================================== -->
		<footer class="dark-footer skin-dark-footer">
			<?= $this->load->view('Users/layouts/footer', '', TRUE); ?>
		</footer>
		<!-- ============================ Footer End ================================== -->

		<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<?= $this->load->view('Users/layouts/login', '', TRUE); ?>
		</div>			
		<!-- End Modal -->			

		<a id="back2Top" class="top-scroll" title="Back to top" href="#"><i class="ti-arrow-up"></i></a>



	</div>
	<!-- ============================================================== -->
	<!-- End Wrapper -->
	<!-- ============================================================== -->

	<script type="text/javascript">
		<?= $this->session->flashdata('notif'); ?>
		<?= $this->session->flashdata('alert'); ?>

	</script>
</body>
</html>