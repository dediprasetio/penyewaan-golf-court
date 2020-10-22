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
				<div class="dashboard-wraper">
					<div class="form-submit">	
						<h4>Change Your Password</h4>
						<form action="<?= site_url('Users/Member/changePasswordAction') ?>" method="POST">
							<div class="submit-section">
								<div class="form-row">
									<div class="form-group col-lg-12 col-md-6">
										<label>Old Password<span class="text-danger">*</span></label>
										<input type="password" placeholder="Enter Old Password" name="oldPass" class="form-control" required="">
									</div>

									<div class="form-group col-md-6">
										<label>New Password<span class="text-danger">*</span></label>
										<input type="password" placeholder="Enter New Password" name="newPass" class="form-control" required="">
									</div>

									<div class="form-group col-md-6">
										<label>Confirm password<span class="text-danger">*</span></label>
										<input type="password" placeholder="Matches Password" name="rePass" class="form-control" required="">
									</div>

									<div class="form-group col-lg-12 col-md-12">
										<input class="btn btn-theme" type="submit" value="Save Changes">
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>

		</div>
	</div>
</section>
			<!-- ============================ Dashboard End ================================== -->