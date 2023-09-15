<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url (); ?>assets/themes/admin/docs/css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>Register - Admin</title>
  </head>
  <body>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      
      <?php if (!empty(session()->getFlashdata('error'))) : ?>
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <h4>Periksa Entrian Form</h4>
          </hr />
          <?php echo session()->getFlashdata('error'); ?>
          </div>
      <?php endif; ?>

      <div class="login-box">
        <form  method="POST" class="login-form" action="/register_process">
          <h4 class="login" align="center"><i class="bi bi-person me-2"></i>Register</h4>
          <div class="mb-2">
            <label class="user_nama">Name</label>
            <input class="form-control" type="text" name="user_nama" id="user_nama"  placeholder="Masukan Nama" >
          </div>
          <div class="mb-2">
            <label class="user_email">Email</label>
            <input class="form-control" type="email" placeholder=" Masukan Email @gmail.com" name="user_email" id="user_email">
          </div>
          <div class="mb-2">
            <label class="user_username">Username</label>
            <input class="form-control" type="text" placeholder="Masukkan Username" name="user_username" id="user_username">
          </div>
          <div class="mb-2">
            <label class="user_pass">Password</label>
            <input class="form-control" type="password" placeholder="Masukan Password" name="user_pass" id="user_pass">
          </div>
              <div class="mb-3 btn-container d-grid">
                <button class="btn btn-primary btn-block"><i class="bi bi-box-arrow-in-right me-2 fs-6"></i>REGISTER</button>
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