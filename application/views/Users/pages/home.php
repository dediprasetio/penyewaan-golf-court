<?php $row = $data['data']['result']; ?>
<!-- ======================= Start Banner ===================== -->
<div class="main-banner" style="background-image:url(<?= base_url('assets/users/') ?>assets/img/slider-1.jpg);" data-overlay="5">
	<div class="container">
		<div class="col-md-12 col-sm-12">

			<div class="caption cl-white hace-desti">
				<div class="hace-desti-sub">
					<span class="stylish">Make your tours awesome</span>
					<h2>You want to Play Golf,<br>We have a place for to Play</h2>
				</div>
			</div>

		</div>
	</div>
</div>
<!-- ======================= End Banner ===================== -->


<!-- ================= Travel start ========================= -->
<section class="min">
	<div class="container">

		<div class="row">
			<div class="col-lg-12 col-md-12">
				<div class="sec-heading center">
					<p>Court Golf Available</p>
					<h2>Lapangan Golf untuk di Booking</h2>
				</div>
			</div>
		</div>

		<div class="row">

			<?php $i = 0; foreach ($row['court'] as $court): ?>
			<?php $url = site_url('Users/Booking/formBooking/'.base64_encode($court['id_lapangan'])) ?>
			<!-- Single Tour Place -->
			<div class="col-lg-4 col-md-6 col-sm-12">
				<div class="tour-simple-wrap style-2">
					<?php if (@$this->session->userdata('member')): ?>
						<span class="onsale-section"><span class="onsale">Save <?= $row['fasilitas']->diskon_member ?>%</span></span>
					<?php endif ?>
					<div class="tour-simple-thumb">
						<a href="<?= $url; ?>"><img src="<?= base_url('assets/users/assets/img/court/'.$i++.'2.jpg') ?>" class="img-fluid img-responsive" alt=""></a>
						<?php $i = $i == 3 ? 0 : $i; ?>
					</div>
					<div class="tour-simple-caption">
						<div class="ts-caption-left">
							<h4 class="ts-title"><a href="<?= $url; ?>">Paket <?= $court['nama_lapangan'] ?></a></h4>
							<?php $desc = @$this->session->userdata('member') ? "Price Member" : "Price Guest" ?>
							<span><?= $desc ?></span>
						</div>
						<div class="ts-caption-right">
							&nbsp;
						</div>
					</div>
				</div>
			</div>
		<?php endforeach ?>

	</div>

</div>
</section>
<!-- ========================= End Travel Section ============================ -->

<!-- ================= true Facts start ========================= -->
<section class="theme-bg">
	<div class="container">
		<div class="row">

			<div class="col-lg-3 col-md-3 col-sm-6">
				<div class="facts-wrap light">
					<div class="facts-icon">
						<i class="ti-dropbox-alt"></i>
					</div>
					<div class="facts-detail">
						<h2><?= $row['countCourt'] ?></h2>
						<p>Total Paket Court</p>
					</div>
				</div>
			</div>

			<div class="col-lg-3 col-md-3 col-sm-6">
				<div class="facts-wrap light">
					<div class="facts-icon">
						<i class="fas fa-book-reader"></i>
					</div>
					<div class="facts-detail">
						<h2><?= $row['countAllBook'] ?></h2>
						<p>Already Booking</p>
					</div>
				</div>
			</div>

			<div class="col-lg-3 col-md-3 col-sm-6">
				<div class="facts-wrap light">
					<div class="facts-icon">
						<i class="fas fa-users"></i>
					</div>
					<div class="facts-detail">
						<h2><?= $row['countMember'] ?></h2>
						<p>All Member Register</p>
					</div>
				</div>
			</div>

			<div class="col-lg-3 col-md-3 col-sm-6">
				<div class="facts-wrap light">
					<div class="facts-icon">
						<i class="ti-face-smile"></i>
					</div>
					<div class="facts-detail">
						<h2><?= $row['countNonMemberBook'] ?></h2>
						<p>Non Member Already Booking</p>
					</div>
				</div>
			</div>

		</div>
	</div>
</section>
<!-- ================= End true Facts ========================= -->

<!-- ================= testimonial start ========================= -->
<link href="<?= base_url('assets/users/') ?>assets\css\custom.css" rel="stylesheet">

<section class="min gray">
	<div class="container">

		<div class="row">
			<div class="col-lg-12 col-md-12">
				<div class="sec-heading center" style="margin-bottom: 0px;">
					<p>List Paket Sewa</p>
					<h2>Daftar list Paket Sewa Available</h2>
				</div>
			</div>
		</div>
		<div class="row">
			<?php foreach ($row['paket'] as $paket): ?>
				<div class="col-xl-4 mt-4">
					<div class="single-price">
						<div class="price-title">
							<h4><?= $paket['nama_paket'] ?></h4>
						</div>
						<div class="price-tag">
							<h2>Rp. <?= number_format($paket['harga_paket'],0,',','.') ?></h2>
						</div>
						<div class="price-item">
							<ul>
								<?php $dt = $paket[0];
								if (count($dt) > 0): ?>
									<?php foreach ($dt as $key => $value): ?>
										<li><span style="font-weight: bold;"><?= $value['qty'] ?> pcs</span> <?= $value['deskripsi_barang'] ?></li>
									<?php endforeach ?>
								<?php endif ?>
							</ul>
						</div>
					</div>
				</div>
			<?php endforeach ?>
			
		</div>
	</div>
</section>
<!-- ================= End testimonial ========================= -->

<!-- ============================ Newsletter Start ================================== -->
<section class="alert-wrap pt-5 pb-5" style="background:#ff5722 url(assets/img/bg-new.png);">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-6">
				<div class="jobalert-sec">
					<h3 class="mb-1 text-light">Get New Notification!</h3>
					<p class="text-light">Subscribe & get all related notification.</p>
				</div>
			</div>

			<div class="col-lg-6 col-md-6">
				<div class="input-group">
					<input type="text" class="form-control" id="emailnih" placeholder="Enter Your Email">
					<div class="input-group-append">
						<button type="button" onclick="clickmeyow()" class="btn btn-black black">Subscribe</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
		<!-- ============================ Newsletter Start ================================== -->

<script type="text/javascript">
	function clickmeyow() {
		alert("Thanks to Subscribe")
		document.getElementById('emailnih').value = '';
	}
</script>