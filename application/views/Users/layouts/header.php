<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="topbar-wrap">

				<div class="topbar-left">
					<ul class="tp-list">
						<li><a href="#"><i class="ti-facebook"></i></a></li>
						<li><a href="#"><i class="ti-twitter"></i></a></li>
						<li><a href="#"><i class="ti-instagram"></i></a></li>
					</ul>
					<ul class="tp-list ml-2 nbr">
						<li><a href="mailto:marketingmerapigolf@gmail.com">marketingmerapigolf@gmail.com</a></li>
					</ul>
				</div>

				<div class="topbar-right">
					<ul class="tp-list">
						<li><a href="#">(+62) 8112664455</a></li>
					</ul class="tp-list">
					<?php if (!$data['data']['name']): ?>
						<ul class="tp-list ml-2">
							<li><a href="#" data-toggle="modal" data-target="#login"> <i class="fas fa-user-circle"></i> Login as Member</a></li>
						</ul>
						<?php else: ?>
							<ul class="tp-list nbr ml-2">
								<li class="dropdown dropdown-currency hidden-xs hidden-sm">
									<a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-circle"></i> <?= $this->session->userdata('nama'); ?><i class="ml-1 fa fa-angle-down"></i></a>
									<ul class="dropdown-menu mlix-wrap">
										<li><a href="<?= site_url('Users/Member/dashboard') ?>">Profile </a></li>
										<li><a href="<?= site_url('Users/Login/logout') ?>">Logout</a></li>
									</ul>
								</li>
							</ul>
						<?php endif ?>
					</div>
				</div>
			</div>
		</div>
	</div>