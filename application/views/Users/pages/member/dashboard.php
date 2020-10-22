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
<?php $row = $data['data']['result']; ?>
<!-- ============================ Dashboard Start ================================== -->

<section class="gray">
	<div class="container-fluid">
		<div class="row">

			<?= $this->load->view('Users/Pages/member/layouts/sidebar', "", TRUE); ?>

			<div class="col-lg-9 col-md-8 col-sm-12">
				<div class="dashboard-wrapers">
					
					<!-- Row -->
					<div class="row">
						<div class="col-lg-4 col-md-4 col-sm-12">
							<div class="dashboard-stat widget-1">
								<div class="dashboard-stat-content"><h4><?= $row['countAllBook'] ?></h4> <span>Total Booking</span></div>
								<div class="dashboard-stat-icon"><i class="ti-location-pin"></i></div>
							</div>	
						</div>

						<div class="col-lg-4 col-md-4 col-sm-12">
							<div class="dashboard-stat widget-2">
								<div class="dashboard-stat-content"><h4><?= $row['countPendingBook'] ?></h4> <span>Booking Pending</span></div>
								<div class="dashboard-stat-icon"><i class="ti-pie-chart"></i></div>
							</div>	
						</div>

						<div class="col-lg-4 col-md-4 col-sm-12">
							<div class="dashboard-stat widget-4">
								<div class="dashboard-stat-content"><h4><?= $row['countSuccessBook'] ?></h4> <span>Booking Success</span></div>
								<div class="dashboard-stat-icon"><i class="ti-bookmark"></i></div>
							</div>	
						</div>
					</div>

					<!-- Row -->
					<div class="row">
						<div class="col-lg-6 col-md-12">
							<div class="dashboard-gravity-list invoices with-icons">
								<h4>Draf Payment Member</h4>
								<ul>
									<?php if (count($row['paymentMember']) > 0): ?>
										<?php $i = count($row['paymentMember']); foreach ($row['paymentMember'] as $pay): ?>

											<li><i class="dash-icon-box ti-files"></i>
												<strong>Pembayaran Ke <?= $i-- ?></strong>
												<ul>
													<?php if ($pay['status_payment'] == "Reject"): ?>
														<li class="unpaid"><?= $pay['status_payment'] ?></li>
														<?php elseif ($pay['status_payment'] == "Pending") :?>
															<li class="unpaid text-warning"><?= $pay['status_payment'] ?></li>
															<?php else: ?>
																<li class="paid"><?= $pay['status_payment'] ?></li>
															<?php endif ?>
															<li>Payment Date: <?= date('d/m/Y', strtotime($pay['start_from'])) ?></li>
															<li>Expired Date: <?= date('d/m/Y', strtotime($pay['end_before'])) ?></li>
															<li>Harga : Rp <?= number_format($pay['price'],0,',','.') ?></li>
														</ul>
													</li>
												<?php endforeach ?>
												<?php else: ?>
													<li><i class="dash-icon-box far fa-calendar-times"></i>
														<strong>Belum Melakukan Payment Member</strong>
													</li>
												<?php endif ?>
											</ul>
										</div>
									</div>

									<div class="col-lg-6 col-md-12">
										<div class="dashboard-gravity-list invoices with-icons">
											<h4>Draf Booking</h4>
											<ul>
												<?php if (count($row['booking']) > 0): ?>
													<?php foreach ($row['booking'] as $book): ?>

														<li><i class="dash-icon-box ti-files"></i>
															<strong>Paket <?= $book['nama_lapangan'] ?></strong>
															<ul>
																<?php if ($book['status_pesanan'] == "Reject"): ?>
																	<li class="unpaid"><?= $book['status_pesanan'] ?></li>
																	<?php elseif ($book['status_pesanan'] == "Pending") :?>
																		<li class="unpaid text-warning"><?= $book['status_pesanan'] ?></li>
																		<?php else: ?>
																			<li class="paid"><?= $book['status_pesanan'] ?></li>
																		<?php endif ?>
																		<li>Order: #<?= $book['id_pesanan'] ?></li>
																		<li>Date Order: <?= date('d/m/Y', strtotime($book['tgl_pesan'])) ?></li>
																	</ul>
																	<div class="buttons-to-right">
																		<a href="<?= site_url('Users/Booking/successBooking/'.$book['id_pesanan']) ?>" class="button gray">View Invoice</a>
																	</div>
																</li>
															<?php endforeach ?>
															<?php else: ?>
																<li><i class="dash-icon-box far fa-calendar-times"></i>
																	<strong>Belum Melakukan Booking</strong>
																</li>
															<?php endif ?>
														</ul>
													</div>
												</div>	
											</div>

										</div>
									</div>

								</div>
							</div>
						</section>
			<!-- ============================ Dashboard End ================================== -->