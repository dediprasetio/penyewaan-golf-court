<style type="text/css">
	.side-booking-wrap.over-top {
		margin-top: 10px; 
	}
	.daterangepicker {
		z-index: 999999999;
	}
	.custom-alert{
		padding: 20px;
		font-size: 15px;
	}
</style>
<?php $row = $data['data']['result']; ?>
<div class="featured-slick">
	<div class="image-cover page-title" style="background:url(<?= base_url('assets/users/') ?>assets/img/court/4.jpg) no-repeat;" data-overlay="6">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12">

					<h2 class="ipt-title"><?= $data['subtitel'] ?></h2>
					<span class="ipn-subtitle text-light"><?= $data['description'] ?></span>
				</div>
			</div>
		</div>
	</div>
</div>



<!-- ============================ Page Title End ================================== -->

<!-- ============================ Property Detail Start ================================== -->
<section class="gray pt-0">
	<div class="container">
		<div class="row">

			<div class="col-md-12">
				<?= $this->session->flashdata('notif'); ?>
			</div>

			<!-- property main detail -->
			<div class="col-lg-8 col-md-12 col-sm-12 order-lg-1 order-md-2 order-2">

				<!-- Single Block Wrap -->

				<div class="rating-overview">
					<div class="rating-overview-box">
						<span class="rating-overview-box-total"><?= $row['fasilitas']->diskon_member ?>% </span>
						<span class="rating-overview-box-percent">Diskon Booking for Member</span>
					</div>
					<div class="text-center" style="width: 100%; margin: 0 auto;">
						
						<div class="side-booking-body">
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12">
									<h5>Apa yang di tunggu segera</h5>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12">
									<div class="stbooking-footer mt-2">
										<div class="form-group mb-0 pb-0">
											<a href="#" data-toggle="modal" data-target="#register" class="btn full-width btn-theme clickRegist">Register to Member</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>

				<!-- Single Block Wrap -->
				<div class="block-wrap">

					<div class="block-header">
						<h4 class="block-title">Fasilitas Member yang di Dapat</h4>
					</div>

					<div class="block-body">
						<ul class="avl-features third">

							<?php foreach ($row['detailFasilitas'] as $detail): ?>
								<li><b><?= $detail['qty'] ?> Items </b><?= $detail['deskripsi'] ?></li>
							<?php endforeach ?>
						</ul>
					</div>

				</div>

			</div>

			<!-- property Sidebar -->
			<div class="col-lg-4 col-md-12 col-sm-12 order-lg-1 order-md-2 order-1">

				<div class="side-booking-wrap over-top radius-0 mt-4">
					<div class="side-booking-header">
						<span>Harga Member</span>
						<h3 class="price">Rp <?= number_format($row['price']->price,0,',','.') ?><sub>/Tahun</sub></h3>
					</div>
					<div class="side-booking-body">
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12">
								<div class="stbooking-footer mt-2">
									<div class="form-group mb-0 pb-0">
										<a href="#" data-toggle="modal" data-target="#register" class="btn full-width btn-theme clickRegist">Register to Member</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="page-sidebar">

					<!-- Business Info -->
					<div class="tr-single-box">
						<div class="tr-single-header">
							<h4><i class="ti-direction"></i> Listing Info</h4>
						</div>

						<div class="tr-single-body">
							<ul class="extra-service">
								<li>
									<div class="icon-box-icon-block">
										<a href="#">
											<div class="icon-box-round">
												<i class="lni-map-marker"></i>
											</div>
											<div class="icon-box-text">
												Jl. Golf No 1 Kepuharjo, Sleman - Yogyakarta
											</div>
										</a>
									</div>
								</li>

								<li>
									<div class="icon-box-icon-block">
										<a href="#">
											<div class="icon-box-round">
												<i class="lni-phone-handset"></i>
											</div>
											<div class="icon-box-text">
												(62 274) 896176 &nbsp; 896177 &nbsp; 896178
											</div>
										</a>
									</div>
								</li>

								<li>
									<div class="icon-box-icon-block">
										<a href="#">
											<div class="icon-box-round">
												<i class="lni-envelope"></i>
											</div>
											<div class="icon-box-text">
												<span>marketingmerapigolf@gmail.com</span>
											</div>
										</a>
									</div>
								</li>

							</ul>
						</div>

					</div>

				</div>
			</div>

		</div>
	</div>
</section>
<!-- ============================ Property Detail End ================================== -->


<?php if (!$this->session->userdata('member')): 
	$android = stripos($_SERVER['HTTP_USER_AGENT'], "android");
	$iphone = stripos($_SERVER['HTTP_USER_AGENT'], "iphone");
	$ipad = stripos($_SERVER['HTTP_USER_AGENT'], "ipad");

	$whatsappNumber = $row['admin'];
	$whatsappLink = '';
	$text = str_replace(' ', '%20', "Saya tertarik menjadi Bagian dari Anggota Member PT Golf Court Indonesia");
	
if($android !== false || $ipad !== false || $iphone !== false) {
	$whatsappLink = 'https://wa.me/'.$whatsappNumber.'?text='.$text;
} else {
	$whatsappLink = 'https://wa.me/'.$whatsappNumber.'?text='.$text;
}

?>
<!-- <div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Register To Member</h5>
				<span class="mod-close" data-dismiss="modal"><i class="ti-close"></i></span>
			</div>
			<div class="modal-body icon-form">
				<div class="login-form text-center">
					<div class="mb-5">
					<h4 >Silahkan Hubungi Admin</h4>
					<span class="text-muted mt-2">Apabila ingin menjadi bagian dari Member Golf Court Indonesia, di harapkan konfirmasi ke Admin. Click Button di bawah ini!</span>
					</div>
					<a href="<?= $whatsappLink; ?>" target="_blank" class="btn full-width btn-theme">Contect Admin</a>
				</div>
			</div>
		</div>
	</div>
</div> -->
<div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Register To Member</h5>
				<span class="mod-close" data-dismiss="modal"><i class="ti-close"></i></span>
			</div>
			<div class="modal-body icon-form">
				<div class="login-form">
					<form action="<?= site_url('Users/Member/register') ?>" method="POST" name="register">
						<div class="form-group">
							<label>Nama Lengkap<span class="text-danger">*</span></label>
							<div class="input-with-icon">
								<input type="text" class="form-control" name="nama" placeholder="Nama Lengkap" required="">
								<i class="ti-user"></i>
							</div>
						</div>

						<div class="form-group">
							<label>Email<span class="text-danger">*</span></label>
							<div class="input-with-icon">
								<input type="email" class="form-control" name="email" placeholder="Enter Email" required="">
								<i class="ti-email"></i>
							</div>
						</div>

						<div class="form-group">
							<label>No Telephone<span class="text-danger">*</span></label>
							<div class="input-with-icon">
								<input type="number" class="form-control" name="notelp" placeholder="No Telephone Member" required="">
								<i class="fas fa-phone"></i>
							</div>
						</div>

						<div class="form-group">
							<label>Jenis Kelamin<span class="text-danger">*</span></label>
							<div class="input-with-icon">

								<select class="form-control" name="jenkel" required="">
									<option value="Laki-Laki">Laki-Laki</option>
									<option value="Perempuan">Perempuan</option>
								</select>
								<i class="fas fa-transgender"></i>
							</div>
						</div>

						<div class="form-group">
							<label>Tempat Lahir<span class="text-danger">*</span></label>
							<div class="input-with-icon">
								<input type="text" class="form-control" name="tempat" placeholder="Tempat Lahir" required="">
								<i class="fas fa-map-marker-alt"></i>
							</div>
						</div>

						<div class="form-group">
							<label>Tanggal Lahir<span class="text-danger">*</span></label>
							<div class="input-with-icon">
								<input type="text" name="tgllahir" class="form-control" required="" id="datepick" value="01/01/2000" placeholder="mm/dd/yyyy">
								<i class="far fa-calendar-alt"></i>
							</div>
						</div>


						<div class="form-group">
							<label>Alamat<span class="text-danger">*</span></label>
							<div class="input-with-icon">
								<textarea style="resize: none;" name="alamat" class="form-control" placeholder="Alamat Lengkap" required=""></textarea>
								<i class="fas fa-map-marker-alt"></i>
							</div>
						</div>

						<div class="form-group">
							<label>Password<span class="text-danger">*</span></label>
							<div class="input-with-icon">
								<input type="password" class="form-control" name="pass" placeholder="*******" required="">
								<i class="ti-unlock"></i>
							</div>
						</div>

						<div class="form-group">
							<input type="submit" class="btn btn-md full-width pop-login" value="Register to Member">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php else: ?>
	<script type="text/javascript">
		$('.clickRegist').click(()=>{
			alert('You are already member')
		})
	</script>
<?php endif ?>
