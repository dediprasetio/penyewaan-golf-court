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
					<form action="<?= site_url('Users/Member/profileAction') ?>" method="POST" name="frm-member-profile">
						<!-- Basic Information -->
						<div class="form-submit">	
							<h4>My Account</h4>
							<div class="submit-section icon-form">
								<div class="form-row">
									<input type="text" name="id" value="<?= base64_encode($row['member']->id_member) ?>" hidden="">
									<div class="form-group col-md-12">
										<label>Nama Lengkap<span class="text-danger">*</span></label>
										<div class="input-with-icon">
											<input type="text" class="form-control" name="nama" placeholder="Nama Lengkap" value="<?= $row['member']->nama_member ?>" required="">
											<i class="ti-user"></i>
										</div>
									</div>

									<div class="form-group col-md-12">
										<label>Email<span class="text-danger">*</span></label>
										<div class="input-with-icon">
											<input type="email" class="form-control" name="email" placeholder="Enter Email" required="" value="<?= $row['member']->email ?>">
											<i class="ti-email"></i>
										</div>
									</div>

									<div class="form-group col-md-12">
										<label>No Telephone<span class="text-danger">*</span></label>
										<div class="input-with-icon">
											<input type="number" class="form-control" name="notelp" placeholder="Nama Lengkap" required="" value="<?= $row['member']->no_telp ?>">
											<i class="fas fa-phone"></i>
										</div>
									</div>

									<div class="form-group col-md-12">
										<label>Jenis Kelamin<span class="text-danger">*</span></label>
										<div class="input-with-icon">
											<?php $jk = array("Laki-Laki","Perempuan"); ?>
											<select class="form-control" name="jenkel" required="">
												<?php foreach ($jk as $key => $val): ?>
													<?php if ($val == $row['member']->jenis_kelamin): ?>
														<option selected="" value="<?= $val ?>"><?= $val ?></option>
													<?php else: ?>
														<option value="<?= $val ?>"><?= $val ?></option>
													<?php endif ?>
												<?php endforeach ?>
											</select>
											<i class="fas fa-transgender"></i>
										</div>
									</div>

									<div class="form-group col-md-12">
										<label>Tempat Lahir<span class="text-danger">*</span></label>
										<div class="input-with-icon">
											<input type="text" class="form-control" name="tempat" placeholder="Tempat Lahir" required="" value="<?= $row['member']->tempat_lahir ?>">
											<i class="fas fa-map-marker-alt"></i>
										</div>
									</div>

									<div class="form-group col-md-12">
										<label>Tanggal Lahir<span class="text-danger">*</span></label>
										<div class="input-with-icon">
											<input type="text" name="tgllahir" class="form-control" required="" id="datepick" value="<?= @$row['member']->tgl_lahir ? date('m/d/Y', strtotime($row['member']->tgl_lahir)) : "01/01/2000" ?>" placeholder="<?= @$row['member']->tgl_lahir ? date('m/d/Y', strtotime($row['member']->tgl_lahir)) : "01/01/2000" ?>">
											<i class="far fa-calendar-alt"></i>
										</div>
									</div>


									<div class="form-group col-md-12">
										<label>Alamat<span class="text-danger">*</span></label>
										<div class="input-with-icon">
											<textarea style="resize: none;" name="alamat" class="form-control" placeholder="Alamat Lengkap" required=""><?= $row['member']->alamat ?></textarea>
											<i class="fas fa-map-marker-alt"></i>
										</div>
									</div>

								</div>
							</div>
						</div>

						<div class="form-submit">	
							<div class="submit-section">
								<div class="form-row">
									<div class="form-group col-lg-12 col-md-12 mt-2">
										<input class="btn btn-theme" type="submit" value="Save Changes">
										<a href="javascript:;" onclick="window.history.back(-1)" class="btn btn-theme" style="background: #31a7ff; border-color: #31a7ff">Cancel</a>
									</div>

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