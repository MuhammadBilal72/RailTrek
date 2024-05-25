<?php
session_start();
if (!isset($_SESSION["current_admin"])) {
  header("location:./auth_signin.php");
  exit();
} else if ($_SESSION["role"] == "admin") {
  header("location:./index.php");
  exit();
} else if (!isset($_REQUEST["id"])) {
  header("location:./index.php");
  exit();
}

include "./../config.php";
include "./../utils/functions.php";

$id = intval($_REQUEST["id"]);
$schedule = getData($conn, "SELECT train_id, route_id, TIME(departure_time) AS departure_time, TIME(arrival_time) AS arrival_time FROM schedules WHERE id = $id;");
if (count($schedule) == 0) {
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
    RailTrek Admin | Edit New Schedule
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
  $page_name = "Schedules";
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
                <h6>Create New Schedule</h6>
              </div>
              <?php if(isset($_REQUEST["invalid_time"])) { ?>
                <div class="alert alert-danger text-light fw-bold">
                  Invalid Time. Please make sure Departure time is less than Arrival time
                </div>
              <?php } ?>
              <?php if(isset($_REQUEST["departure_exist"])) { ?>
                <div class="alert alert-danger text-light fw-bold">
                  Sorry there is another train exist on same departure time and route
                </div>
              <?php } ?>
              <?php if(isset($_REQUEST["arrival_exist"])) { ?>
                <div class="alert alert-danger text-light fw-bold">
                  Sorry there is another train exist on same arrival time and route
                </div>
              <?php } ?>
              <p class="text-success">You can create schedule on New Train Only which is currently not in use</p>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <form action="controllers/create_schedule_controller.php" method="post" class="px-5 py-3">
                <?php
                $trains = getData($conn, "SELECT * from Trains");
                ?>
                <div class="form-group">
                  <label for="pos_1" class="form-label">Choose Desired Train</label>
                  <select name="train" class="form-select">
                    <?php
                    foreach ($trains as $train) {
                      $selected = $train["id"] == $schedule[0]["train_id"] ? "selected" : "";
                      echo '<option value="' . $train["id"] . '" '.$selected.'>' . $train["name"] . '</option>';
                    }
                    ?>
                  </select>
                </div>
                <input type="hidden" name="id" value="<?php echo $_REQUEST["id"] ?>">
                <?php
                $routes = getData($conn, "SELECT 
                Routes.*,
                start_station.name AS start_station_name,
                end_station.name AS end_station_name
            FROM 
                Routes
            INNER JOIN 
                Stations AS start_station ON Routes.start_station_id = start_station.id
            INNER JOIN 
                Stations AS end_station ON Routes.end_station_id = end_station.id;");
                ?>
                <div class="form-group">
                  <label for="route" class="form-label">Choose Desired Route</label>
                  <select name="route" class="form-select">
                    <?php
                    foreach ($routes as $route) {
                      $selectedRoute = $route["id"] == $schedule[0]["route_id"] ? "selected" : "";
                      echo '<option value="' . $route["id"] . '" '.$selectedRoute.'>'.$route["start_station_name"].'-'.$route["end_station_name"].'</option>';
                    }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="depTime" class="form-label">Departure Time</label>
                  <input type="time" value="<?php echo $schedule[0]["departure_time"] ?>" class="form-control" name="depTime"/>
                </div>
                <div class="form-group">
                  <label for="arrTime" class="form-label">Arrival Time</label>
                  <input type="time" value="<?php echo $schedule[0]["arrival_time"] ?>" class="form-control" name="arrTime"/>
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