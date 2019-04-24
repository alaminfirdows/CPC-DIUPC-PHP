<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <!-- Twitter meta-->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:site" content="@pratikborsadiya">
    <meta property="twitter:creator" content="@pratikborsadiya">
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Vali Admin">
    <meta property="og:title" content="Vali - Free Bootstrap 4 admin theme">
    <meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin">
    <meta property="og:image" content="http://pratikborsadiya.in/blog/vali-admin/hero-social.png">
    <meta property="og:description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <title>Vali Admin - Free Bootstrap 4 Admin Template</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets');?>/styles/admin.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <div class="logo">
        <a class="" href="<?=base_url();?>"><img src="<?=base_url('assets');?>/img/logo.png" alt="Stage 4 Cancer Community" style="height: 40px;"/></a>
      </div>
      <?php
        $responce = get_flush_data('login_responce');
        if (isset($responce) && !empty($responce)):
      ?>
        <div class="row">
          <div class="col-md-12">
            <div class="alert <?php if($responce['type'] == 'error') { echo 'alert-danger'; } else if($responce['type'] == 'success') { echo 'alert-success'; } else { echo 'alert-info'; } ?> alert-dismissible show" role="alert">
              <?= $responce['data']; ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          </div>
        </div>
      <?php endif; ?>
      <div class="login-box">
        <form action="" method="POST" id="login_form" class="login-form">
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>SIGN IN</h3>
          <div class="form-group">
            <label class="control-label">USERNAME</label>
            <input class="form-control" type="text" placeholder="Email or username" id="user" name="user" required autofocus>
          </div>
          <div class="form-group">
            <label class="control-label">PASSWORD</label>
            <input class="form-control" type="password" id="pass" name="pass" placeholder="Password" required>
          </div>
          <div class="form-group">
            <div class="utility">
              <div class="animated-checkbox">
                <label>
                  <input type="checkbox"><span class="label-text">Stay Signed in</span>
                </label>
              </div>
              <p class="semibold-text mb-2"><a href="#" data-toggle="flip">Forgot Password ?</a></p>
            </div>
          </div>
          <div class="form-group btn-container">
            <button class="btn btn-primary btn-block" type="submit" id="login" name="login" ><i class="fa fa-sign-in fa-lg fa-fw"></i>SIGN IN</button>
          </div>
        </form>

        <form class="forget-form" action="index.html">
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>Forgot Password ?</h3>
          <div class="form-group">
            <label class="control-label">EMAIL</label>
            <input class="form-control" type="text" placeholder="Email">
          </div>
          <div class="form-group btn-container">
            <button class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i>RESET</button>
          </div>
          <div class="form-group mt-3">
            <p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i> Back to Login</a></p>
          </div>
        </form>
      </div>
    </section>
            </main>
        <!-- Essential javascripts for application to work-->
        <script type="text/javascript" src="<?=base_url('assets');?>/js/jquery.min.js"></script>
        <script type="text/javascript" src="<?=base_url('assets');?>/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?=base_url('assets');?>/js/jquery.stellar.min.js"></script>
        <script type="text/javascript" src="<?=base_url('assets');?>/js/admin.js"></script>

        <script type="text/javascript" src="<?=base_url('assets');?>/js/plugins/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="<?=base_url('assets');?>/js/plugins/dataTables.bootstrap.min.js"></script>
        <script type="text/javascript" src="<?=base_url('assets');?>/js/plugins/select2.min.js"></script>
        <script type="text/javascript" src="<?=base_url('assets');?>/js/plugins/pace.min.js"></script>
    <script type="text/javascript" src="<?=base_url('assets');?>/js/plugins/chart.js"></script>
        
    <script src="https://cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>

        <script type="text/javascript">
            if ( $('.ckeditor').length ) { CKEDITOR.replace( '.ckeditor' ); }
            if ( $('.select2').length ) { $('.select2').select2(); }
            if ( $('.jsDataTable').length ) { $('.jsDataTable').DataTable(); }
            // Login Page Flipbox control
            $('.login-content [data-toggle="flip"]').click(function() {
              $('.login-box').toggleClass('flipped');
              return false;
            });
        </script>
    </body>
</html>
