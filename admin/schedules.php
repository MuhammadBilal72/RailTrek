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
    RailTrek Admin | Schedules
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
                <h6>All Schedules</h6>
                <?php
                if ($_SESSION["role"] == "back-office") {
                  echo '<a href="new_schedule.php" class="btn btn-success">New Schedules</a>';
                }
                ?>
              </div>
              <?php
              if (isset($_REQUEST["created"])) {
                echo '<div class="alert alert-success text-light fw-bold">New Schedules has been created successfully</div>';
              } else if (isset($_REQUEST["deleted"])) {
                echo '<div class="alert alert-success text-light fw-bold">Schedules has been deleted successfully</div>';
              } else if (isset($_REQUEST["updated"])) {
                echo '<div class="alert alert-success text-light fw-bold">Schedules has been updated successfully</div>';
              }
              ?>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Train</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Route
                      </th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Departure Time
                      </th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Arrival Time
                      </th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action
                      </th>
                    </tr>
                  </thead>
                  <?php
                  $scQ = "SELECT 
                  Schedules.id AS schedule_id,
                  Trains.name AS train_name, 
                  CONCAT(departure_station.name, ' - ', arrival_station.name) AS route,
                  DATE_FORMAT(Schedules.departure_time, '%r') AS departure_time,
                  DATE_FORMAT(Schedules.arrival_time, '%r') AS arrival_time
              FROM 
                  Trains
              INNER JOIN 
                  Schedules ON Trains.id = Schedules.train_id
              INNER JOIN 
                  Routes ON Schedules.route_id = Routes.id
              INNER JOIN 
                  Stations AS departure_station ON Routes.start_station_id = departure_station.id
              INNER JOIN 
                  Stations AS arrival_station ON Routes.end_station_id = arrival_station.id;
              ";
                  $schedule_data = getData($conn, $scQ);
                  foreach ($schedule_data as $scd) {
                    ?>
                    <tr>
                      <td>
                        <?php echo $scd["train_name"] ?>
                      </td>
                      <td>
                        <?php echo $scd["route"] ?>
                      </td>
                      <td class="text-center">
                        <?php echo $scd["departure_time"] ?>
                      </td>
                      <td class="text-center">
                        <?php echo $scd["arrival_time"] ?>
                      </td>
                      <td class="text-center">
                        <a href="edit_schedule.php?id=<?php echo $scd['schedule_id'] ?>" class="btn btn-warning">
                          <i class="fa fa-pencil"></i>
                        </a> &nbsp;
                        <a href="controllers/delete_schedule_controller.php?id=<?php echo $scd['schedule_id'] ?>"
                          class="btn btn-danger">
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
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <script src="../assets/js/argon-dashboard.min.js?v=2.0.4"></script>
</body>

</html>