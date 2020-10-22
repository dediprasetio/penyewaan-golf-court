<style type="text/css">
	.switchbtn.paying label.switchbtn-label img {
		max-height: 100%; 
		height: auto;
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

<!-- =================== Sidebar Search ==================== -->
<section class="gray">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12">
				<!-- 1st Step Checkout -->
				<div class="checkout-wrap">
					<div class="checkout-head">
						<div class="col-lg-12 col-md-12 col-sm-12">
							<h3 class=""><i class="fas fa-info-circle"></i> Form Booking Court</h3>
						</div>
					</div>
					<div class="checkout-body">
						<form action="<?= site_url('Users/Booking/detailBooking') ?>" method="POST">
							<div class="row mb-4">
								<div class="col-md-6">
									<div class="submit-section icon-form">

										<div class="form-group col-md-12">
											<h4>Tanggal & Jam Main<span class="text-danger">*</span></h4>
											<div class="input-with-icon">
												<input type="text" name="tgl_main" class="form-control" required="" autocomplete="off">
												<i class="far fa-calendar-alt"></i>
											</div>
										</div>

									</div>
								</div>
								
								<div class="col-md-6">
									<div class="submit-section icon-form">
										<div class="form-group col-md-12">
											<h4>Banyak Pemain<span class="text-danger">*</span></h4>
											<div class="input-with-icon">
												<select class="form-control" name="pemain" required="">
													<?php foreach ($row['pemain'] as $pemain): ?>
														<option value="<?= $pemain['banyak_penyewa'] ?>"><?= $pemain['banyak_penyewa'] ?> Orang </option>
													<?php endforeach ?>
												</select>
												<i class="fas fa-users"></i>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<div class="row mb-5">
								<div class="col-lg-12 col-md-12 col-sm-12">
									<h4 class="mb-3">Select the Court</h4>
								</div>
								<?php $i = 0; foreach ($row['court'] as $court): ?>
								
								<div class="col-lg-4 col-md-6 col-sm-12">
									<div class="switchbtn paying">
										<input  id="<?= "pay-".$i; ?>" class="switchbtn-checkbox" type="radio" value="<?= base64_encode($court['id_lapangan']) ?>" name="courts" required="" <?= $row['option'] == $court['id_lapangan'] ? 'checked=""' : '' ?>>
										<label class="switchbtn-label" for="<?= "pay-".$i; ?>">
											<div class="tour-simple-wrap style-2">
												<?php if (@$this->session->userdata('member')): ?>
													<span class="onsale-section"><span class="onsale">Save <?= $row['fasilitas']->diskon_member ?>%</span></span>
												<?php endif ?>
												<div class="tour-simple-thumb">
													<img src="<?= base_url('assets/users/assets/img/court/'.$i++.'2.jpg') ?>" class="img-fluid img-responsive" alt="">
													<?php $i = $i == 3 ? 0 : $i; ?>
												</div>
												<div class="tour-simple-caption">
													<div class="ts-caption-left">
														<h4 class="ts-title">Paket <?= $court['nama_lapangan'] ?></h4>
														<?php $desc = @$this->session->userdata('member') ? "Price Member" : "Price Guest" ?>
														<span><?= $desc ?></span>
													</div>
													<div class="ts-caption-right">
														&nbsp;
													</div>
												</div>
											</div>
										</label>
									</div>
								</div>
								<?php $i = $i == 3 ? 0 : $i; ?>
							<?php endforeach ?>

						</div>

						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 mt-6">
								<div class="form-group text-center ">
									<?php if (@$this->session->userdata('member') && ($this->session->userdata('status') == "Not Payment" || $this->session->userdata('status') == "Expire")): ?>
									<input type="submit" name="btnNext" class="btn btn-theme" style="margin-top: 25px;" value="Continue Booking" disabled="">
									<h5 class="text-danger mt-3"><b>Tidak Bisa Melakukan Booking!</b> <br> Karna Member berada di status <b><?= $this->session->userdata('status'); ?></b></h5>
									<?php else: ?>
										<input type="submit" name="btnNext" class="btn btn-theme" style="margin-top: 25px;" value="Continue Booking">
									<?php endif ?>
								</div>
							</div>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Sidebar End -->
</div>
</div>
</section>
<!-- =================== Sidebar Search ==================== -->
<script>
	$(function() {
		$('input[name="tgl_main"]').daterangepicker({
			singleDatePicker: true,
			timePicker: true,
			timePicker24Hour: true,
			startDate: moment().startOf('days'),
			endDate: moment().startOf('days').add(32, 'days'),
			minDate: moment().startOf('hour'),

			locale: {
				format: 'DD-MM-YYYY HH:mm'
			}
		}).attr('readonly','readonly');
	});
</script>