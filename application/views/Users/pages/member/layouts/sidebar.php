<?php $submition = $data['data']['checkPayment']; 
	$waLink = $data['data']['whatsAppApi'];
?>

	<?php if ($this->session->userdata('status') == "Expire") : ?>
		<div class="col-sm-12">
			<div class="alert alert-custom alert-danger" role="alert" style="padding: 25px; background:#c0392b; ">
				<div class="alert-text"><h5 style="color: white !important;">Member aktif telah mencapai tanggal expired. Silahkan hubungi admin untuk perpanjangan masa aktif member. <a class="text-a" href="<?= $waLink; ?>" >Click Di Sini!</a></h5>
				</div>
			</div>
		</div>
	<?php elseif ($this->session->userdata('status') == "Not Payment") :?>
		<div class="col-sm-12">
			<div class="alert alert-custom alert-info" role="alert" style="padding: 25px; background:#4FC3F7; ">
				<div class="alert-text"><h5 style="color: white !important;">Status Member Belum Active. Silahkan hubungi admin untuk mengaktifkan member. <a class="text-a" href="<?= $waLink; ?>" >Click Di Sini!</a></h5>
				</div>
			</div>
		</div>
	<?php endif ?>
		<div class="col-md-12">
			<?= $this->session->flashdata('notif'); ?>
		</div>
		<div class="col-lg-3 col-md-4 col-sm-12">
			<div class="dashboard-navbar">

				<div class="d-user-avater">
					<img src="<?= base_url('assets/users/') ?>assets\img\user.jpg" class="img-fluid avater" alt="">
					<h4><?= $this->session->userdata('nama'); ?></h4>
					<span>Expired Date : <span class="text-primary" style="font-weight: bold;"><u><?= @$this->session->userdata('expire_date') ? date('d-m-Y', strtotime($this->session->userdata('expire_date'))) : '-'; ?></u></span></span>
				</div>

				<div class="d-navigation">
					<ul>
						<li <?= $data['description'] == 'dashboard' ? 'class="active"' : '' ?>><a href="<?= site_url('Users/Member/dashboard') ?>"><i class="ti-dashboard"></i>Dashboard</a></li>
						<li <?= $data['description'] == 'profile' ? 'class="active"' : '' ?>><a href="<?= site_url('Users/Member/profile') ?>"><i class="ti-user"></i>My Profile</a></li>
						<li <?= $data['description'] == 'myBooking' ? 'class="active"' : '' ?>><a href="<?= site_url('Users/Member/myBooking') ?>"><i class="ti-layers"></i>My Booking</a></li>
						<li <?= $data['description'] == 'change' ? 'class="active"' : '' ?>> <a href="<?= site_url('Users/Member/changePassword') ?>"><i class="ti-unlock"></i>Change Password</a></li>
						<li><a href="<?= site_url('Users/Login/logout') ?>"><i class="ti-power-off"></i>Log Out</a></li>
					</ul>
				</div>

			</div>
		</div>