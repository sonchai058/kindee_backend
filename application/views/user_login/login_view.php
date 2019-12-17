 <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="{base_url}/assets/images/info.kindee.kindee.png" alt="logo">
              </div>
              <h4>Hello! let's inno story</h4>
              <h6 class="font-weight-light">Sign in to continue.</h6>
              <form class="form-signin pt-3" class="form-signin" role="form" method="post" id="frm_login" 
    onsubmit="return LogIn();return false;">
                {csrf_protection_field}
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" name="input_username"  id="input_username" class="form-control" 
        placeholder="อีเมลล็อคอิน" required autofocus>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" name="input_password"  id="input_password" placeholder="รหัสผ่าน" required>
                </div>
                <div class="mt-3">
                  <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" id="btn_login" type="submit">SIGN IN</button>
                </div>
                <!--
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Keep me signed in
                    </label>
                  </div>
                  <a href="#" class="auth-link text-black">Forgot password?</a>
                </div>
                <div class="mb-2">
                  <button type="button" class="btn btn-block btn-facebook auth-form-btn">
                    <i class="mdi mdi-facebook mr-2"></i>Connect using facebook
                  </button>
                </div>
                <div class="text-center mt-4 font-weight-light">
                  Don't have an account? <a href="#" class="text-primary">Create</a>
                </div>
                -->
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>