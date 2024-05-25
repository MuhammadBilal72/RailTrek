<?php
  session_start();
  if(!isset($_SESSION["current_admin"])) {
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
    RailTrek Admin | All Trains
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
                <h6>All Trains</h6>
                <?php
                  if($_SESSION["role"] == "admin") {
                    echo '<a href="controllers/new_train_request_controller.php" class="btn btn-success">Request New Train</a>';
                  } else {
                    echo '<a href="new_train.php" class="btn btn-success">Create New Train</a>';
                  }
                ?>
              </div>
              <?php
                if(isset($_REQUEST["created"])){
                  echo '<div class="alert alert-success text-light fw-bold">Train has been created successfully</div>';
                } else if(isset($_REQUEST["deleted"])) {
                  echo '<div class="alert alert-success text-light fw-bold">Train has been deleted successfully</div>';
                } else if(isset($_REQUEST["cancel_submitted"])) {
                  echo '<div class="alert alert-success text-light fw-bold">Train cancellation request has been submitted successfully</div>';
                } else if(isset($_REQUEST["new_submitted"])) {
                  echo '<div class="alert alert-success text-light fw-bold">New Train request has been submitted successfully</div>';
                }
              ?>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Train</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Added On</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                      <?php
                        if($_SESSION["role"] == "back-office") {
                          echo '<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Earning</th>';
                        }
                      ?>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                    </tr>
                  </thead>
                    <?php
                      $trains = getData($conn, "select * from trains where is_deleted=0");
                      foreach($trains as $train) {
                    ?>
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <img src="./assets/img/train-img.png" class="avatar avatar-sm me-3" alt="user1">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">
                              <?php echo $train["name"] ?>
                            </h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs text-secondary mb-0"><?php
                          $date = new DateTime($train["created_at"]);
                          $beautifulDate = $date->format('l, F j, Y');
                          echo $beautifulDate;
                        ?></p>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <?php
                          $train_id = $train["id"];
                          $train_used_count = getCount($conn, "select * from Schedules where train_id='$train_id'");
                          $train_in_used = true;
                          if ($train_used_count > 0) {
                            $train_in_use = true;
                            echo '<span class="badge badge-sm bg-gradient-success">In Use</span>';
                          } else {
                            echo '<span class="badge badge-sm bg-gradient-danger">Not In Use</span>';
                            $train_in_use = false;
                          }
                        ?>
                      </td>
                      <td class="text-center">
                        <?php
                          if($_SESSION["role"] == "back-office") {
                            $earning = getData($conn, "SELECT 
                            SUM(Booking.price) AS total_booking_price
                        FROM 
                            Booking
                        INNER JOIN 
                            Schedules ON Booking.schedule = Schedules.id
                        WHERE 
                            Schedules.train_id = $train_id;
                        ");
                        $earning = $earning[0]["total_booking_price"] == null ? 0 : $earning[0]["total_booking_price"];
                        echo '$'.$earning ;
                          }
                        ?>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <?php
                        if($_SESSION["role"] == "admin") {
                          if (!$train_in_use) {
                        ?>
                          <a href="controllers/cancel_train_request_controller.php?id=<?php echo $train_id ?>" class="btn btn-danger font-weight-bold text-xs mb-0">
                            Reques To Cancel
                          </a>
                        <?php } else { ?>
                          <button class="btn btn-danger font-weight-bold text-xs mb-0" disabled>
                            Cancel This Train
                          </button>
                        <?php
                          }
                        } else if ($_SESSION["role"] == "back-office") {
                          ?>
                          <a href="controllers/delete_train_controller.php?id=<?php echo $train["id"] ?>" class="btn btn-danger" data-confirm="Are you sure">
                            <i class="fa fa-trash"></i>
                          </a>
                          <?php
                        }
                      ?>
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
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/argon-dashboard.min.js?v=2.0.4"></script>
</body>

</html>