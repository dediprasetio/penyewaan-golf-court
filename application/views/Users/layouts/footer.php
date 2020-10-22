<div>
	<div class="container">
		<div class="row">

			<div class="col-lg-3 col-md-3">
				<div class="footer-widget">
					<img src="<?= base_url('assets/users/assets/images/logo-bg.png') ?>" class="img-footer" alt="">
					<div class="footer-add">
						<p><strong>Email:</strong><br><a href="mailto:marketingmerapigolf@gmail.com">marketingmerapigolf@gmail.com</a></p>
						<p><strong>Call:</strong>
							<br>(62 274) 896176 <br>(62 274) 896177 <br>(62 274) 896178
						</p>
						
						<ul class="footer-bottom-social mt-2">
							<li><a href="#"><i class="ti-facebook"></i></a></li>
							<li><a href="#"><i class="ti-twitter"></i></a></li>
							<li><a href="#"><i class="ti-instagram"></i></a></li>
							<li><a href="#"><i class="ti-linkedin"></i></a></li>
						</ul>
					</div>

				</div>
			</div>		

			<?php if (@$this->session->userdata('member')): ?>
				<div class="col-lg-3 col-md-3 col-lg-offset-4" >
					<div class="footer-widget">
						<h4 class="widget-title">Navigations</h4>
						<ul class="footer-menu">
							<li>
								<a href="<?= site_url('Users/Dashboard') ?>">Home</a>
							</li>

							<li>
								<a href="<?= site_url('Users/Fasilitas') ?>">Fasilitas Member</a>
							</li>


							<li>
								<a href="<?= site_url('Users/Booking/confirmBooking') ?>">Konfirmasi Pemesanan</a>
							</li>
							<li>
								<a href="<?= site_url('Users/About') ?>">About Us</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-3">
					<div class="footer-widget">
						<h4 class="widget-title">My Account</h4>
						<ul class="footer-menu">
							<li><a href="<?= site_url('Users/Member/dashboard') ?>">Dashboard</a></li>
							<li><a href="<?= site_url('Users/Member/profile') ?>">My Profile</a></li>
							<li><a href="<?= site_url('Users/Member/myBooking') ?>">My Booking</a></li>
							<li><a href="<?= site_url('Users/Login/logout') ?>">Log Out</a></li>
						</ul>
					</div>
				</div>
				<?php else: ?>
					<div class="col-lg-6 col-md-3 col-md-offset-3" >
						<div class="footer-widget">
							<h4 class="widget-title">Navigations</h4>
							<ul class="footer-menu">
								<li>
									<a href="<?= site_url('Users/Dashboard') ?>">Home</a>
								</li>

								<li>
									<a href="<?= site_url('Users/Fasilitas') ?>">Fasilitas Member</a>
								</li>


								<li>
									<a href="<?= site_url('Users/Booking/confirmBooking') ?>">Konfirmasi Pemesanan</a>
								</li>
								<li>
									<a href="<?= site_url('Users/About') ?>">About Us</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="col-lg-3 col-md-12">
						<div class="footer-widget">
							<h4 class="widget-title">Get Members</h4>
							<a href="#" class="other-store-link">
								<div class="other-store-app">
									<div class="os-app-icon">
										<i class="fas fa-users theme-cl"></i>
									</div>
									<div class="os-app-caps">
										Registration Member
										<span>Get It Now</span>
									</div>
								</div>
							</a>
						</div>
					</div>

				<?php endif ?>


			</div>
		</div>
	</div>

	<div class="footer-bottom">
		<div class="container">
			<div class="row align-items-center">

				<div class="col-lg-6 col-md-6">
					<p class="mb-0">© 2020 All Rights Reserved - Merapi Golf Yogyakarta</p>
				</div>
			</div>
		</div>
	</div>