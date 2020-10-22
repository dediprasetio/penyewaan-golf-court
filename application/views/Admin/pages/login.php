<?php  
    if (@$this->session->userdata('id')) {
        redirect('Admin/Dashboard','refresh');
    }
?>
<!DOCTYPE html>

<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0], j=d.createElement(s),dl=l!='dataLayer'?'&amp;l='+l:'';j.async=true; j.src = '<?= base_url('
		assets / ') ?>www.googletagmanager.com/gtm5445.html?id=' + i + dl;
	f.parentNode.insertBefore(j, f); })(window,document,'script','dataLayer','GTM-5FS8GGP');</script>
	<!-- End Google Tag Manager -->
	<meta charset="utf-8" />
	<title>Login Admin Pages | Booking Golf Hall</title>
	<meta name="description" content="Login page" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<!--begin::Fonts-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
	<!--end::Fonts-->
	<!--begin::Page Custom Styles(used by this page)-->
	<link href="<?= base_url('assets/'); ?>dist/assets/css/pages/login/classic/login-5526f.css?v=7.0.8" rel="stylesheet" type="text/css" />
	<!--end::Page Custom Styles-->
	<!--begin::Global Theme Styles(used by all pages)-->
	<link href="<?= base_url('assets/'); ?>dist/assets/plugins/global/plugins.bundle526f.css?v=7.0.8" rel="stylesheet" type="text/css" />
	<link href="<?= base_url('assets/'); ?>dist/assets/plugins/custom/prismjs/prismjs.bundle526f.css?v=7.0.8" rel="stylesheet" type="text/css" />
	<link href="<?= base_url('assets/'); ?>dist/assets/css/style.bundle526f.css?v=7.0.8" rel="stylesheet" type="text/css" />
	<!--end::Global Theme Styles-->
	<!--begin::Layout Themes(used by all pages)-->
	<link href="<?= base_url('assets/'); ?>dist/assets/css/themes/layout/header/base/light526f.css?v=7.0.8" rel="stylesheet" type="text/css" />
	<link href="<?= base_url('assets/'); ?>dist/assets/css/themes/layout/header/menu/light526f.css?v=7.0.8" rel="stylesheet" type="text/css" />
	<link href="<?= base_url('assets/'); ?>dist/assets/css/themes/layout/brand/dark526f.css?v=7.0.8" rel="stylesheet" type="text/css" />
	<link href="<?= base_url('assets/'); ?>dist/assets/css/themes/layout/aside/dark526f.css?v=7.0.8" rel="stylesheet" type="text/css" />
	<!--end::Layout Themes-->
	<link rel="shortcut icon" href="https://preview.keenthemes.com/metronic/theme/html/demo1/dist/assets/media/logos/favicon.ico" />
	<!-- Hotjar Tracking Code for keenthemes.com -->
	<script>(function(h,o,t,j,a,r){ h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)}; h._hjSettings={hjid:1070954,hjsv:6}; a=o.getElementsByTagName('head')[0]; r=o.createElement('script');r.async=1; r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv; a.appendChild(r); })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');</script>
	<script type="text/javascript">
		function SubmitLogin() {
			document.getElementById('kt_login_signin_form').submit();
		}
	</script>
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
	<!-- Google Tag Manager (noscript) -->
	<noscript>
		<iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5FS8GGP" height="0" width="0" style="display:none;visibility:hidden"></iframe>
	</noscript>
	<!-- End Google Tag Manager (noscript) -->
	<!--begin::Main-->
	<div class="d-flex flex-column flex-root">
		<!--begin::Login-->
		<div class="login login-5 login-signin-on d-flex flex-row-fluid" id="kt_login">
			<div class="d-flex flex-center bgi-size-cover bgi-no-repeat flex-row-fluid" style="background-image: url(<?= base_url('assets/'); ?>dist/assets/media/bg/bg-2.jpg);">
				<div class="login-form text-center text-white p-7 position-relative overflow-hidden">
					<!--begin::Login Header-->
					<div class="d-flex flex-center mb-15">
						<a href="#">
							<img src="<?= base_url('assets/'); ?>dist/assets/media/logos/logo-letter-13.png" class="max-h-75px" alt="" />
						</a>
					</div>
					<!--end::Login Header-->
					<!--begin::Login Sign in form-->
					<div class="login-signin">
						<div class="mb-20">
							<h3 class="opacity-40 font-weight-normal">Sign In To Admin</h3>
							<p class="opacity-40">Enter your details to login to your account:</p>
						</div>
						<form class="form" id="kt_login_signin_form" action="<?= site_url('Admin/Login/ceklogin') ?>" method="POST">
							<div class="form-group">
								<input class="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8" type="text" placeholder="Username" name="username" autocomplete="off" />
							</div>
							<div class="form-group">
								<input class="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8" type="password" placeholder="Password" name="password" />
							</div>
							<div class="form-group text-center mt-10">
								<input type="submit" onclick="SubmitLogin();" class="btn btn-pill btn-primary opacity-90 px-15 py-3" value="Sign In">
							</div>
						</form>
					</div>
					<!--end::Login Sign in form-->
				</div>
			</div>
		</div>
		<!--end::Login-->
	</div>
	<!--end::Main-->

	<!--begin::Global Config(global config for global JS scripts)-->
	<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>
	<!--end::Global Config-->
	<!--begin::Global Theme Bundle(used by all pages)-->
	<script src="<?= base_url('assets/'); ?>dist/assets/plugins/global/plugins.bundle526f.js?v=7.0.8"></script>
	<script src="<?= base_url('assets/'); ?>dist/assets/plugins/custom/prismjs/prismjs.bundle526f.js?v=7.0.8"></script>
	<script src="<?= base_url('assets/'); ?>dist/assets/js/scripts.bundle526f.js?v=7.0.8"></script>
	<!--end::Global Theme Bundle-->
	<!--begin::Page Scripts(used by this page)-->
	<script src="<?= base_url('assets/'); ?>dist/assets/js/pages/custom/login/login-general526f.js?v=7.0.8"></script>
	<!--end::Page Scripts-->
	<script type="text/javascript">
		<?= $this->session->flashdata('notif'); ?>
	</script>
</body>
<!--end::Body-->

<!-- Mirrored from preview.keenthemes.com/metronic/demo1/custom/pages/login/classic/login-5.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 19 Aug 2020 19:08:52 GMT -->
</html>