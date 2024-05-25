<?php
session_start();
if (!isset($_SESSION["current_admin"])) {
  header("location:./auth_signin.php");
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
    RailTrek Admin | Rolling Stock
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
  $page_name = "Rolling Stock";
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
                <h6>Available Rolling Stock</h6>
                <?php
                  if ($_SESSION["role"] == "back-office") {
                    echo '<a href="new_rolling_stock.php" class="btn btn-success">New Rolling Stock</a>';
                  }
                ?>
              </div>
              <?php
                if(isset($_REQUEST["created"])){
                  echo '<div class="alert alert-success text-light fw-bold">New Rolling Stock has been created successfully</div>';
                } else if(isset($_REQUEST["deleted"])) {
                  echo '<div class="alert alert-success text-light fw-bold">Rolling Stock has been deleted successfully</div>';
                } else if(isset($_REQUEST["updated"])) {
                  echo '<div class="alert alert-success text-light fw-bold">Rolling Stock has been updated successfully</div>';
                }
              ?>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Type</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Series</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name
                      </th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Seats
                      </th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Stock
                      </th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action
                      </th>
                    </tr>
                  </thead>
                  <?php
                  $rolling_stock_data = getData($conn, "select * from RollingStock");
                  foreach ($rolling_stock_data as $rsd) {
                    ?>
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">
                              <?php echo strtoupper($rsd["type"]) ?>
                            </h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <?php echo $rsd["series"] ?>
                      </td>
                      <td class="text-center">
                        <?php echo $rsd["name"] ?>
                      </td>
                      <td class="text-center">
                        <?php echo $rsd["seats"] ?>
                      </td>
                      <td class="text-center">
                        <?php echo $rsd["stock"] ?>
                      </td>
                      <td class="text-center">
                        <a href="edit_rolling_stock.php?id=<?php echo $rsd['id']?>" class="btn btn-warning">
                          <i class="fa fa-pencil"></i>
                        </a> &nbsp;
                        <a href="controllers/delete_rolling_stock_controller.php?id=<?php echo $rsd['id']?>" class="btn btn-danger">
                          <i class="fa fa-trash"></i>
                        </a>
                      </td>
                    </tr>
                  <?php } ?>
                  </tbody>
                </table>
              </div>
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
  <script src="../assets/js/argon-dashboard.min.js?v=2.0.4"></script>
</body>
</html>
