<?php
session_start();
if (!isset($_SESSION["current_admin"])) {
  header("location:./auth_signin.php");
  exit();
} else if ($_SESSION["role"] == "admin" || (!isset($_REQUEST["id"]))) {
  header("location:./index.php");
  exit();
} 
include "./../config.php";
include "./../utils/functions.php";
$stock_id = intval($_REQUEST["id"]);
$rolling_stock = getData($conn, "select * from RollingStock where id = $stock_id");

if (count($rolling_stock) == 0){
  header("location:./index.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/logo.png">
  <link rel="icon" type="image/png" href="./assets/img/logo.png">
  <title>
    RailTrek Admin | Edit Rolling Stock
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
                <h6>Edit Rolling Stock</h6>
                
              </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <form action="controllers/update_rolling_stock_controller.php" method="post" class="px-5 py-3">
                <div class="form-group">
                  <label for="type" class="form-label">Choose Stock Type</label>
                  <select name="type" class="form-select">
                    <option value="carriage" <?php echo $rolling_stock[0]["type"] == "carriage" ? "selected" : "" ?>>Carriage</option>
                    <option value="baggageCar" <?php echo $rolling_stock[0]["type"] == "baggageCar" ? "selected" : "" ?>>Baggage Car</option>
                    <option value="dieselRailcar" <?php echo $rolling_stock[0]["type"] == "dieselRailcar" ? "selected" : "" ?>>Diesel Car</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="name" class="form-label">Name</label>
                 <input type="text" value="<?php echo $rolling_stock[0]["name"] ?>" name="name" class="form-control" placeholder="Enter Name">
                </div>
                <div class="form-group">
                  <label for="series" class="form-label">Series</label>
                 <input type="text" value="<?php echo $rolling_stock[0]["series"] ?>" name="series" class="form-control" placeholder="Enter Series">
                </div>
                <div class="form-group">
                  <label for="seats" class="form-label">Enter No of Seats</label>
                 <input type="number" value="<?php echo $rolling_stock[0]["seats"] ?>" name="seats" class="form-control" placeholder="Enter Number of Seats" min="0" >
                </div>
                <input type="hidden" name="id" value="<?php echo $rolling_stock[0]["id"] ?>">
                <div class="form-group">
                  <label for="stock" class="form-label">Enter No of Stock Quantity</label>
                 <input type="number" value="<?php echo $rolling_stock[0]["stock"] ?>" name="stock" class="form-control" placeholder="Enter Stock Quantity" min="1" required>
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