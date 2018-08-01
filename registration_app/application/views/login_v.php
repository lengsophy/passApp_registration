<!DOCTYPE html>
<html lang="en">
<?php
/*if (isset($this->session->userdata['logged_in'])) {

header("location: http://localhost/passin/index.php/login/login");
}*/
?>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>PassApp Helpdesk</title>
  <!-- Bootstrap core CSS-->
  <link href="<?php echo asset_url();?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="<?php echo asset_url();?>vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="<?php echo asset_url();?>css/sb-admin.css" rel="stylesheet">
</head>

<body class="bg-dark">
  <?php
    if (isset($logout_message)) {
    echo "<div class='message'>";
    echo $logout_message;
    echo "</div>";
    }
    ?>
    <?php
    if (isset($message_display)) {
    echo "<div class='message'>";
    echo $message_display;
    echo "</div>";
    }
    ?>
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>
      <div class="card-body">
        <?= $this->session->flashdata('message');  ?>
        <form  name="myForm" class="login-form" method="POST" action="<?php echo site_url('authentication/authen_c/verify_user'); ?>">
          <div class="form-group">
            <label for="name">Username</label>
            <input class="form-control" id="name" name="username" type="text" placeholder="Username">
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" id="password" name="password" type="password" placeholder="Password">
          </div>
          <div class="form-group">
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" type="checkbox"> Remember Password</label>
            </div>
          </div>
          <!-- <a class="btn btn-primary btn-block" onclick="document.getElementById('myform').submit()">Login</a> -->
          <div class="form-group">
                <input class="btn btn-primary btn-block" type="submit" value=" Log in">
          </div>
        </form>
        <!-- <div class="text-center">
          <a class="d-block small mt-3" href="register.html">Register an Account</a>
          <a class="d-block small" href="forgot-password.html">Forgot Password?</a>
        </div>
      -->
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo asset_url();?>vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo asset_url();?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="<?php echo asset_url();?>vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>
