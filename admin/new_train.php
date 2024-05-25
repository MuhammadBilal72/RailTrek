<?php
session_start();
if (!isset($_SESSION["current_admin"])) {
  header("location:./auth_signin.php");
  exit();
} else if ($_SESSION["role"] == "admin") {
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
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/logo.png">
  <link rel="icon" type="image/png" href="./assets/img/logo.png">
  <title>
    RailTrek Admin | Create New Train
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="./assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
</head>

<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>
  <?php
  $page_name = "Trains";
  include "shared/sidebar.php"; ?>
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <?php
    include "shared/header.php"; ?>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <div class="d-flex flex-row align-items-center justify-content-between">
                <h6>Create New Train</h6>
              </div>
            </div>
            <p class="text-success px-5">A train consists of 4 rolling stock parts</p>
            <div class="card-body px-0 pt-0 pb-2">
              <form action="controllers/create_train_controller.php" method="post" class="px-5 py-3">
                <div class="form-group">
                  <label for="type" class="form-label">Enter Train Name</label>
                  <input type="text" name="name" class="form-control" placeholder="Enter Train Name" required>
                </div>
                <?php
                $RollingStock = getData($conn, "select * from RollingStock");
                ?>
                <div class="form-group">
                  <label for="pos_1" class="form-label">Chose Rolling Stock For Train's Position 1</label>
                  <select name="pos_1" class="form-select">
                    <?php
                    foreach ($RollingStock as $RS) {
                      echo '<option value="' . $RS["id"] . '">' . $RS["type"] . '-' . $RS["name"] . '-' . $RS["series"] . '</option>';
                    }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="pos_2" class="form-label">Chose Rolling Stock For Train's Position 2</label>
                  <select name="pos_2" class="form-select">
                    <?php
                    foreach ($RollingStock as $RS) {
                      echo '<option value="' . $RS["id"] . '">' . $RS["type"] . '-' . $RS["name"] . '-' . $RS["series"] . '</option>';
                    }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="pos_3" class="form-label">Chose Rolling Stock For Train's Position 3</label>
                  <select name="pos_3" class="form-select">
                    <?php
                    foreach ($RollingStock as $RS) {
                      echo '<option value="' . $RS["id"] . '">' . $RS["type"] . '-' . $RS["name"] . '-' . $RS["series"] . '</option>';
                    }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="pos_4" class="form-label">Chose Rolling Stock For Train's Position 4</label>
                  <select name="pos_4" class="form-select">
                    <?php
                    foreach ($RollingStock as $RS) {
                      echo '<option value="' . $RS["id"] . '">' . $RS["type"] . '-' . $RS["name"] . '-' . $RS["series"] . '</option>';
                    }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <input type="submit" value="Save" class="btn btn-success">&nbsp;
                  <input type="reset" value="Reset" class="btn btn-secondary">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
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
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/argon-dashboard.min.js?v=2.0.4"></script>
</body>

</html>