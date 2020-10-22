<style type="text/css">
	a.text-a:hover{
		color: white;
	}
</style>
<!-- ============================ Page Title Start================================== -->
<div class="image-cover page-title" style="background:url(<?= base_url('assets/users/') ?>assets/img/court/4.jpg) no-repeat;" data-overlay="6">	
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12">

				<h2 class="ipt-title">Hello, <?= $this->session->userdata('nama'); ?></h2>
				<span class="ipn-subtitle text-light">Edit & View Your Profile</span>

			</div>
		</div>
	</div>
</div>
<!-- ============================ Page Title End ================================== -->
<?php $row = $data['data']['result'];
?>
<!-- ============================ Dashboard Start ================================== -->

<section class="gray">
	<div class="container-fluid">
		<div class="row">

			<?= $this->load->view('Users/Pages/member/layouts/sidebar', "", TRUE); ?>

			<div class="col-lg-9 col-md-8 col-sm-12">
				<div class="dashboard-wrapers">
					<div class="dashboard-gravity-list">
						<h4>Booking Requests</h4>
						<ul>
							<?php if (count($row['booking']) > 0): ?>
								
								<?php foreach ($row['booking'] as $book): ?>
									<?php if ($book['status_pesanan'] == "Pending"){
										$staBook = "pending-booking";
									}elseif ($book['status_pesanan'] == "Accept"){
										$staBook = "approved-booking";
									}elseif ($book['status_pesanan'] == "Reject"){
										$staBook = "canceled-booking";
									} ?>
									<li class="<?= $staBook ?>">
										<div class="list-box-listing bookings">
											<div class="list-box-listing-img"><img src="https://image.flaticon.com/icons/png/512/145/145849.png" alt=""></div>
											<div class="list-box-listing-content">
												<div class="inner">
													<h3>#<?= $book['kode_booking'] ?> 
													<span class="booking-status"><?= $book['status_pesanan'] ?></span>
													<?php if ($book['status_pesanan'] == "Pending" && @$book['bukti_bayar']): ?>
														<span class="booking-status" style="background: #1db75c">Paid</span>
														<?php elseif ($book['status_pesanan'] == "Pending" && !$book['bukti_bayar']): ?>
															<span class="booking-status unpaid" style="background: #1db75c">Unpaid</span>
														<?php endif ?>
													</h3>
													<?php $date = $book['tgl_booking'].' '.$book['jam_main'] ?>
													<div class="inner-booking-list">
														<h5>Booking Date:</h5>
														<ul class="booking-list">
															<li class="highlighted"><?= date('d-m-Y / H:i:s', strtotime($date)) ?> WIB</li>
														</ul>
													</div>

													<div class="inner-booking-list">
														<h5>Paket Lapangan:</h5>
														<ul class="booking-list">
															<li class="highlighted">Paket <?= $book['nama_lapangan'] ?></li>
														</ul>
													</div>		

													<div class="inner-booking-list">
														<h5>Total Harga:</h5>
														<ul class="booking-list">
															<li class="highlighted">Rp. <?= number_format($book['total_harga'],0,',','.') ?></li>
														</ul>
													</div>		
													<?php if (@$book['keterangan_status']): ?>

														<div class="inner-booking-list">
															<h5>Keterangan:</h5>
															<span><?= $book['keterangan_status'] ?></span>
													<!-- <ul class="booking-list">
														<li>Successful Booking and confirmed</li>
													</ul> -->
												</div>
											<?php endif ?>

										</div>
									</div>
								</div>
								<div class="buttons-to-right">
									<a href="<?= site_url('Users/Booking/successBooking/'.$book['id_pesanan']) ?>" class="button gray approve"><i class="ti-trash"></i> Lihat Detail</a>
								</div>
							</li>
						<?php endforeach ?>
					<?php else: ?>
						<li class="pending-booking">
						<div class="list-box-listing bookings" style="width: 100%; margin: 0 auto;">
							<div style="width: 100%; margin: 0 auto;">
								<h3><i class="fas fa-info-circle"></i> Belum Melakukan Booking Court</h3>
							</div>
						</div>
					</li>
					<?php endif ?>
				</ul>
			</div>
		</div>
	</div>
</div>
</div>
</section>
			<!-- ============================ Dashboard End ================================== -->