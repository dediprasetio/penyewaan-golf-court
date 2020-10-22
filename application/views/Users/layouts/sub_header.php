<div class="container">
	<nav id="navigation" class="navigation navigation-landscape">
		<div class="nav-header">
			<a class="nav-brand" href="#">
				<img src="<?= base_url('assets/users/assets/images/logo-fix-2.png') ?>" class="logo" alt="">
			</a>
			<div class="nav-toggle"></div>
		</div>
		<div class="nav-menus-wrapper" style="transition-property: none;">
			<ul class="nav-menu">
				<li <?= $data['active'] == "home" ? 'class="active"' : '' ?>>
					<a href="<?= site_url('Users/Dashboard') ?>">Home</a>
				</li>

				<li <?= $data['active'] == "fasilitas" ? 'class="active"' : '' ?>>
					<a href="<?= site_url('Users/Fasilitas') ?>">Fasilitas Member</a>
				</li>

				
				<li <?= $data['active'] == "payment" ? 'class="active"' : '' ?>>
					<a href="<?= site_url('Users/Booking/confirmBooking') ?>">Konfirmasi Pemesanan</a>
				</li>
				<li <?= $data['active'] == "about" ? 'class="active"' : '' ?>>
					<a href="<?= site_url('Users/About') ?>">About Us</a>
				</li>
				
				
			</ul>

			<?php if (!$this->session->userdata('member')): ?>
				<ul class="nav-menu nav-menu-social align-to-right">
					<li class="add-listing theme-bg"><a href="<?= site_url('Users/Fasilitas') ?>">Daftar Member</a></li>
				</ul>
				<?php else: ?>
					<ul class="nav-menu nav-menu-social align-to-right">

						<li class="login-attri">
							<div class="btn-group account-drop">
								<button type="button" class="btn btn-order-by-filt theme-cl" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<img src="<?= base_url('assets/users/') ?>assets\img\user.jpg" class="avater-img" alt="">Hi, <?php $nameTunggal = explode(' ', $this->session->userdata('nama')); echo $nameTunggal[0]; ?>
								</button>
								<div class="dropdown-menu pull-right animated flipInX">
									<a href="<?= site_url('Users/Member/dashboard') ?>"><i class="ti-dashboard"></i>Dashboard</a>
									<a href="<?= site_url('Users/Member/profile') ?>"><i class="ti-user"></i>My Profile</a>                                  									
									<a href="<?= site_url('Users/Member/myBooking') ?>"><i class="ti-plus"></i>My Booking</a>               
									<a href="<?= site_url('Users/Login/logout') ?>"><i class="ti-power-off"></i>Log Out</a>
								</div>
							</div>
						</li>

					</ul>
				<?php endif ?>
			</div>
		</nav>
	</div>