<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <base href="<?php echo base_url(); ?>">

    <title><?php echo $title; ?></title>

    <!-- Bootstrap -->
    <link href="assets/vendors/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="assets/vendors/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="assets/vendors/css/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="assets/vendors/css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="assets/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <?php 
              $flash_message = $this->session->flashdata('handler_msg');
              if( ! empty($flash_message) ) {
                echo '<p class="alert alert-'. $flash_message['type'] .'" id="flash_message"><b>'. $flash_message['msg'] .'</b></p>';
              }
            ?>
            <form action="<?php echo $form_login; ?>" method="post">
              <h1>Sistem Pakar Diet</h1>
              <div>
                <input type="text" class="form-control" name="username" placeholder="Username" required="" />
              </div>
              <div>
                <input type="password" class="form-control" name="password" placeholder="Password" required="" />
              </div>
              <div>
                <button type="submit" class="btn btn-default">Log In</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Don't Have Account?
                  <a href="#signup" class="to_register" style="color: blue;"> Sign Up </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <p>&copy;<?php echo date('Y'); ?> All Rights Reserved. @frmnqdr.</p>
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <?php 
              $flash_message = $this->session->flashdata('handler_msg');
              if( ! empty($flash_message) ) {
                echo '<p class="alert alert-'. $flash_message['type'] .'" id="flash_message"><b>'. $flash_message['msg'] .'</b></p>';
              }
            ?>
            <form>
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" name="reg_username" placeholder="Username" required="" />
              </div>
              <div>
                <input type="password" class="form-control" name="reg_password" placeholder="Password" required="" />
              </div>
              <div>
                <input type="password" class="form-control" name="reg_repassword" placeholder="Retype Password" required="" />
              </div>
              <div>
                <button type="submit" class="btn btn-warning">Submit</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already have an account ?
                  <a href="#signin" class="to_register" style="color: blue;"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <p>&copy;<?php echo date('Y'); ?> All Rights Reserved. @frmnqdr.</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
