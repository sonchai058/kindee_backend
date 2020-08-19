<style type="text/css">
	input[type='number']:focus,
	input:focus,
	textarea:focus,
	select:focus {
		border: .5px #7caff8 solid !important;
	}

	input,
	textarea {
		border: .5px #eee solid !important;
	}
</style>
<div class="container-scroller">
	<div class="container-fluid page-body-wrapper full-page-wrapper">
		<div class="content-wrapper d-flex align-items-center auth px-0">
			<div class="row w-100 mx-0">
				<div class="col-lg-4 mx-auto">
					<div class="auth-form-light text-left py-5 px-4 px-sm-5">
						<div class="brand-logo">
							<a href="{site_url}frontend_page" class="simple-text logo-normal">
								<img src="{base_url}/assets/images/info.kindee.kindee.png" alt="logo">
							</a>
						</div>
						<h4>kindee | inno story</h4>
						<h6 class="font-weight-light">Sign in to continue.</h6>
						<form class="form-signin pt-3" class="form-signin" role="form" method="post" id="frm_login" onsubmit="return LogIn();return false;">
							{csrf_protection_field}
							<div class="form-group">
								<input type="email" class="form-control form-control-lg" name="input_username" id="input_username" class="form-control" placeholder="อีเมลล็อคอิน" required autofocus>
							</div>
							<div class="form-group">
								<input type="password" class="form-control form-control-lg" name="input_password" id="input_password" placeholder="รหัสผ่าน" required>
							</div>
							<div class="mt-3">
								<button class="btn btn-block btn-warning btn-lg font-weight-medium auth-form-btn" id="btn_login" type="submit">SIGN IN</button>
							</div>
							<br />
							<div class="form-group row">
								<div class="col-md-6">
									<button type="button" onclick="window.location.href='{base_url}register/user_add'" class="btn btn-block btn-primary btn-sm font-weight-medium auth-form-btn" id="btn_sign_up_user">&nbsp;&nbsp;<i class="fas fa-user"></i> &nbsp;SIGN UP USER&nbsp;&nbsp;</button>
									<br />
								</div>
								<div class="col-md-6">
									<button type="button" onclick="window.location.href='{base_url}register/registershops/shop_add'" class="btn btn-block btn-secondary btn-sm font-weight-medium auth-form-btn" id="btn_sign_up_shop">&nbsp;&nbsp;<i class="fas fa-store"></i> &nbsp;SIGN UP SHOP&nbsp;&nbsp;</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- content-wrapper ends -->
	</div>
	<!-- page-body-wrapper ends -->
</div>
