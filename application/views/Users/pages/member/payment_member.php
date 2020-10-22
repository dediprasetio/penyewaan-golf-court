<?php $submition = $data['data']['checkPayment']; ?>
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
				<div class="dashboard-wraper">

					<?php  
					$date = @$submition['staPayMember'] == "Accept" ? date('d-m-Y', strtotime($row['payment']->start_from)) : date('d-m-Y');
					$dateYear = @$submition['staPayMember'] == "Accept" ? date('d-m-Y', strtotime($row['payment']->end_before)) : date('d-m-Y', mktime(date("H"),date("i"),date("s"),date("n"),date("d"),date("Y")+1));

					?>
					<form method="POST" action="<?= site_url('Users/Member/paymentAction/'.base64_encode($this->session->userdata('id'))) ?>" enctype="multipart/form-data">
						<!-- Basic Information -->
						<div class="form-submit">	
							<h4>Payment Member Activity</h4>
							<div class="submit-section">
								<div class="form-row">

									<div class="form-group col-md-12 mt-4">
										<label>Your Account Member</label>
										<select class="form-control" name="account">
											<option selected="" value="<?= $this->session->userdata('id') ?>"><?= $this->session->userdata('nama') ?></option>
										</select>
										<input type="text" name="i" value="<?= @$row['payment']->id_payment ? base64_encode($row['payment']->id_payment) : ''; ?>" hidden="">
									</div>

									<div class="form-group col-md-12">
										<label>Harga Member</label>
										<input type="number" name="harga" id="price" value="<?= @$row['payment']->price ? $row['payment']->price : $row['price']->price ?>" class="form-control" readonly="">
									</div>
									<div class="form-group col-md-6">
										<label>Date At</label>
										<input type="text" name="dateat" class="form-control" value="<?= @$row['payment']->start_from ? date('d-m-Y', strtotime($row['payment']->start_from)) : $date ?>" readonly="">
									</div>

									<div class="form-group col-md-6">
										<label>Expired Date</label>
										<input type="text" name="expired" class="form-control" value="<?= @$row['payment']->end_before ? date('d-m-Y', strtotime($row['payment']->end_before)) : $dateYear ?>" readonly="">
									</div>

									<div class="form-group col-md-6">
										<label>Bukti Pembayaran</label>
										<input type="file" name="buktibayar" accept="image/*" id="buktibayar" class="form-control" onchange="PreviewImage();" <?= $submition['staPayMember'] == "Accept" ? 'disabled=""' : '' ?>>
										<small><i>Max image Size 2Mb</i></small>
									</div>
									<div class="form-group col-md-6">
										<div style="width: 100%; margin: 0 auto;">
											<?php $src = @$row['payment']->bukti_payment ? base_url('/assets/users/assets/img/uploaded_payment_member/'.$row['payment']->bukti_payment) : '' ?>
											<img src="<?= $src ?>" class="img-responsive" id="resultbuktibayar" alt="result bukti Pembayaran" style="width: 100%;">
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="form-submit">	
							<h4>Result Payment</h4>
							<div class="submit-section">
								<div class="form-row">

									<div class="form-group col-md-12">
										<label>Result Price Payment</label>
										<input type="number" class="form-control" name="resultPayment" id="resultPayment" value="<?= $row['price']->price ?>" readonly="">
									</div>
									<?php if (@$submition['staPayMember'] != "Accept"): ?>
										<div class="form-group col-lg-12 col-md-12">
											<input class="btn btn-theme" type="submit" value="Submit Payment" name="btnSubmit">
											<a href="javascript:;" onclick="window.history.back(-1)" class="btn btn-theme" style="background: #31a7ff; border-color: #31a7ff">Cancel</a>
										</div>
									<?php endif ?>

								</div>
							</div>
						</div>
					</form>
				</div>
			</div>

		</div>
	</div>
</section>
<!-- ============================ Dashboard End ================================== -->
<script type="text/javascript">
	function PreviewImage() {
		var oFReader = new FileReader();
		oFReader.readAsDataURL(document.getElementById("buktibayar").files[0]);
		oFReader.onload = function (oFREvent)
		{
			document.getElementById("resultbuktibayar").src = oFREvent.target.result;
		};
	};
</script>