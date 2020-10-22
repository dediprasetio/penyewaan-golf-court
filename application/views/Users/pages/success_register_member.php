<!-- =================== Sidebar Search ==================== -->
<section class="gray">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12">

				<div class="checkout-wrap">

					<div class="checkout-head">
						<div class="success-message">
							<span class="thumb-check"><i class="ti-check"></i></span>
							<h4>Already Member Now!</h4>
							<p>Harap lakukan konfirmasi ke Admin!</p>
						</div>
					</div>

					<div class="checkout-body">


						<div class="row">
							<div class="col-md-12 col-lg-12">

								<ul class="booking-detail-list">
									<li>ID Member<span><?= $this->session->userdata('id'); ?></span></li>
									<li>Nama Member<span><?= $this->session->userdata('nama'); ?></span></li>
									<li>Email Member<span><?= $this->session->userdata('email'); ?></span></li>
									<li>No Telephone<span><?= $this->session->userdata('no_telp'); ?></span></li>
									<li>Jenis Kelamin<span><?= $this->session->userdata('jenis_kelamin'); ?></span></li>
									<li>Tempat, Tanggal Lahir<span><?= $this->session->userdata('tempat_lahir'); ?>, <?= date('d F Y', strtotime($this->session->userdata('tgl_lahir'))); ?></span></li>
									<li>Alamat<span><?= $this->session->userdata('alamat') ?></span></li>
									<li>Waktu Registrasi<span><?= date('d-m-Y H:i:s', strtotime($data['data']['result']['member']->register_date)) ?></span></li>
									<li>Status Member<span><?= $this->session->userdata('status');  ?></span></li>
								</ul>
								<hr>

								<h4>Informasi Tambahan</h4>
								<p>Silahkan kabari admin untuk mengaktifkan status Member yang di sediakan di menu Profil.
									<div class="row">
										<div class="col-lg-12 col-md-12 col-sm-12">
											<div class="form-group text-center">
												<a href="<?= site_url('Users/Member/Dashboard') ?>" class="btn btn-theme">Go To Profile Menu</a>
											</div>
										</div>
									</div>
								</p>
							</div>
						</div>
					</div>

				</div>

			</div>
		</div>
	</div>
</section>
<!-- =================== Sidebar Search ==================== -->
