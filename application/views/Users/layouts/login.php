<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Log In</h5>
			<span class="mod-close" data-dismiss="modal"><i class="ti-close"></i></span>
		</div>
		<div class="modal-body icon-form">
			<div class="login-form">
				<form action="<?= site_url('Users/Login/checklog') ?>" method="POST">

					<div class="form-group">
						<label>Email Terdaftar</label>
						<div class="input-with-icon">
							<input type="email" class="form-control" name="email" placeholder="Enter Email">
							<i class="ti-user"></i>
						</div>
					</div>

					<div class="form-group">
						<label>Password</label>
						<div class="input-with-icon">
							<input type="password" name="password" class="form-control" placeholder="Enter Password">
							<i class="ti-unlock"></i>
						</div>
					</div>

					<div class="form-group">
						<input type="submit" class="btn btn-md full-width pop-login" value="Login">
					</div>

				</form>
			</div>
			<div class="text-center">
				<p class="mt-3"><a href="#" class="link">Forgot password?</a></p>
			</div>
		</div>
	</div>
</div>