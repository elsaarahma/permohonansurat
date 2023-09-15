<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/themes/admin/docs/css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>Login -  Admin</title>
  </head>
  <body>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <div class="logo">
       
      </div>
      <?php if (!empty(session()->getFlashdata('error'))) : ?>
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <h4>Periksa Entrian Form</h4>
          </hr />
          <?php echo session()->getFlashdata('error'); ?>
          </div>
      <?php endif; ?>
      <div class="login-box">
        <form action="/login_process"  method="POST" class="login-form" >
          <h3 class="login-head"><i class="bi bi-person me-2"></i>LOGIN</h3>
          <div class="mb-3">
            <label class="user_username">USERNAME</label>
            <input class="form-control" type="text" placeholder="Username" id="user_username" name="user_username">
          </div>
          <div class="mb-3">
            <label class="user_pass">PASSWORD</label>
            <input class="form-control" type="password" placeholder="Password" id="user_pass" name="user_pass">
          </div>
          <div class="mb-3">
            <div class="utility">
              <p class="semibold-text mb-2"><a href="/register" data-toggle="">Register</a></p>
              <p class="semibold-text mb-2"><a href="forgot_pass" data-toggle="flip">Forgot Password </a></p>
            </div>
          </div>
          <div class="mb-3 btn-container d-grid">
            <button class="btn btn-primary btn-block"><i class="bi bi-box-arrow-in-right me-2 fs-5"></i> LOGIN</button>
          </div>
        </form>
        <form class="forget-form" action="/forgot_pass">
          <h3 class="login-head"><i class="bi bi-person-lock me-2"></i>Forgot Password ?</h3>
          <div class="mb-3">
            <label class="form-label">EMAIL</label>
            <input class="form-control" type="text" placeholder="Email">
          </div>
          <div class="mb-3 btn-container d-grid">
            <button class="btn btn-primary btn-block"><i class="bi bi-unlock me-2 fs-5"></i>RESET</button>
          </div>
          <div class="mb-3 mt-3">
            <p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="bi bi-chevron-left me-1"></i> Back to Login</a></p>
          </div>
        </form>

      </div>
    </section>
    <!-- Essential javascripts for application to work-->
    <script src="<?php echo base_url();?>assets/themes/admin/docs/js/jquery-3.7.0.min.js"></script>
    <script src="<?php echo base_url();?>assets/themes/admin/docs/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/themes/admin/docs/js/main.js"></script>
    <script type="text/javascript">
      // Login Page Flipbox control
      $('.login-content [data-toggle="flip"]').click(function() {
      	$('.login-box').toggleClass('flipped');
      	return false;
      });
    </script>
  </body>
</html>