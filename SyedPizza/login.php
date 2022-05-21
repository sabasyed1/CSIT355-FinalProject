<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NJ Pizzeria</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
     <!-- BS Stepper -->
  <link rel="stylesheet" href="plugins/bs-stepper/css/bs-stepper.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    </head>
<body class="hold-transition login-page">
<div class="login-box hidden">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="login.php" class="h1"><b>NJ</b>Pizzeria</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>
<div class="card-body p-0">
                <div class="bs-stepper">
                  <div class="bs-stepper-header" role="tablist">
                    <!-- your steps here -->
                    <div class="step" data-target="#email-part">
                      <button type="button" class="step-trigger" role="tab" aria-controls="logins-part" id="logins-part-trigger">
                        <span class="bs-stepper-circle">1</span>
                        <span class="bs-stepper-label">Email</span>
                      </button>
                    </div>
                    <div class="step" data-target="#password-part">
                      <button type="button" class="step-trigger" role="tab" aria-controls="information-part" id="information-part-trigger">
                        <span class="bs-stepper-circle">2</span>
                        <span class="bs-stepper-label">Password</span>
                      </button>
                    </div>
                  </div>
                  <div class="bs-stepper-content">
                    <!-- your steps content here -->
                      <form action="FunctionsCode/loginCode.php" method="post">
                          <div id="email-part" class="content" role="tabpanel" aria-labelledby="logins-part-trigger">
                            <div class="input-group mb-3">
                              <input type="text" id="username" name="username" class="form-control" placeholder="Username">
                              <div class="input-group-append">
                                <div class="input-group-text">
                                  <span class="fas fa-envelope"></span>
                                </div>
                              </div>
                            </div>
                          <button class="btn btn-info btn-block" id="nxtBtn" type="button" onclick="stepper.next()">Next</button>
                              <div class="row">
                                <span>&nbsp;</span>
                            </div>
                              <div class="row">
                                <span>&nbsp;</span>
                            </div>
                        </div>
                          <div id="password-part" class="content" role="tabpanel" aria-labelledby="information-part-trigger">
                              <div class="input-group mb-3">
                                  <input type="password" name="pwd" id="pwd" class="form-control" placeholder="Password">
                                  <div class="input-group-append">
                                    <div class="input-group-text">
                                      <span class="fas fa-lock"></span>
                                    </div>
                                  </div>
                             </div>
                              <button class="btn btn-info btn-block" type="button" onclick="stepper.previous()">Previous</button>
                              <button type="submit" class="btn btn-success btn-block">Login</button>
                          </div>
                        <div class="row">
                            <span>&nbsp;</span>
                        </div>
                          
                      </form>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <a href="register.php" class="text-center">Register a new membership</a>
              </div>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->
    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/bs-stepper/js/bs-stepper.min.js"></script>
    <script>
// BS-Stepper Init
  document.addEventListener('DOMContentLoaded', function () {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  })
        $('#username').keypress(function(event){
	var keycode = (event.keyCode ? event.keyCode : event.which);
	if(keycode == '13'){
		event.preventDefault();
	}

});
</script>
<?php 

include 'Shared_Pages/footer.php';

?>