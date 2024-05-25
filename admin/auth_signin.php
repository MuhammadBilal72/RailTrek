<?php
  session_start();
  if(isset($_SESSION["current_admin"])) {
    header("location:./index.php");
    exit();
  }
  include "./../config.php";
  include "./../utils/functions.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="/assets/img/favicon.png">
  <title>
   RailTrek | Administrative Login
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="./assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
</head>

<body class="">
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
              <div class="card card-plain">
                <div class="card-header pb-0 text-start">
                  <h4 class="font-weight-bolder">Sign In to <font style="color: gold">RailTrek</font> Administrative Portal</h4>
                </div>
                <?php if (isset($_REQUEST["request_unathorized"])) { ?>
                  <div class="alert alert-danger text-light fw-bold">
                    *You are not authorized to access this resource
                  </div>
                <?php } else if (isset($_REQUEST["invalid_credentials"])) { ?>
                  <div class="alert alert-danger text-light fw-bold">
                    *Invalid email or password. please try again
                  </div>
                <?php } ?>
                <div class="card-body">
                  <form action="controllers/signin_controller.php" method="POST">
                    <div class="mb-3">
                      <input type="email" class="form-control form-control-lg" name="email" placeholder="Email" aria-label="Email">
                    </div>
                    <div class="mb-3">
                      <input type="password" class="form-control form-control-lg" name="password" placeholder="Password" aria-label="Password">
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Sign in</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
              <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden" style="background-image: url('assets/img/login-train.png');
              background-size: cover;">
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <!--   Core JS Files   -->
  <script src="./assets/js/core/popper.min.js"></script>
  <script src="./assets/js/core/bootstrap.min.js"></script>
  <script src="./assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="./assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <script src="/assets/js/argon-dashboard.min.js?v=2.0.4"></script>
</body>

</html>