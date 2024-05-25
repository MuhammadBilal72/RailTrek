<?php
session_start();
if (!isset($_SESSION["user"])) {
  header("location:./login.php");
  exit();
}
$my_id = $_SESSION["user"];
include "./utils/functions.php";
include "config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>RailTrek - Profile</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <?php include "shared/assets.php" ?>
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
  <style>
    .panel {
      border: 1px solid rgb(186, 186, 186);
      width: 400px;
      margin: 0 auto;
      padding: 30px;
      display: flex;
      flex-direction: row;
      justify-content: center;
      margin-bottom: 100px;
    }

    .panel-extra-wodth {
      width: 800px !important;
    }

    .booking-cards {
      display: flex;
      flex-direction: column;
      row-gap: 20px;
      width: 100%;
    }

    .booking-cards .booking-card {
      background-color: white;
      box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
      border-radius: 6px;
      background-color: #eaeaea;
    }

    .booking-card {
      width: 100%;
    }

    .booking-card .card-heading {
      padding: 10px;
      padding-left: 30px;
      padding-right: 30px;
      border-bottom: 1px solid black;
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    .booking-card .card-heading img {
      width: 100px;
      height: 60px;
      border: 1px solid rgb(208, 208, 208);
    }


    .booking-card .card-body {
      padding: 10px;
      display: flex;
      flex-direction: row;
      justify-content: space-between;
      padding-left: 30px;
      padding-right: 30px;
      font-size: 17px;
      flex-wrap: wrap;
      row-gap: 20px;
      align-items: center;
    }
  </style>
</head>

<body>

  <?php include "shared/header.php"; ?>
  <?php if (isset($_REQUEST["missing_details"])) { ?>
    <div class="alert alert-danger">
      Please enter new password and confirm password
    </div>
  <?php } else if (isset($_REQUEST["password_not_matched"])) { ?>
      <div class="alert alert-danger">
        Sorry ! Password did not matched. please enter correct password confirmation
      </div>
  <?php } else if (isset($_REQUEST["password_short"])) { ?>
      <div class="alert alert-danger">
        Password Too Short. Minimum 6 characters
      </div>
  <?php } else if (isset($_REQUEST["created"])) { ?>
          <div class="alert alert-success">
            Success ! Password has been updated successfully
          </div>
  <?php } ?>
  <main id="main" class="py-5">

    <!-- Submenu Tabbing For Profile -->
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="personal-tab" data-bs-toggle="tab" data-bs-target="#personal" type="button"
          role="tab" aria-controls="personal" aria-selected="true">
          <i class="fa fa-home"></i>
          Home
        </button>
      </li>
      <li class="nav-item" role="presentation">
        <Bookings class="nav-link" id="bookings-tab" data-bs-toggle="tab" data-bs-target="#bookings" type="button"
          role="tab" aria-controls="bookings" aria-selected="false">
          <i class="fa fa-train"></i>
          Bookings
          </button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="password-tab" data-bs-toggle="tab" data-bs-target="#password" type="button"
          role="tab" aria-controls="password" aria-selected="false">
          <i class="fa fa-lock"></i>
          Password and Security
        </button>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="personal" role="tabpanel" aria-labelledby="home-tab">
        <?php
        $user_data = getData($conn, "select * from users where id = '$my_id'");
        $date = new DateTime($user_data[0]["created_at"]);
        $readable_date = $date->format('d M Y H:i A');
        ?>
        <div class="px-2 py-3 d-flex flex-column gap-3 justify-content-center align-items-center mt-5 mb-5">
          <h3 class="text-center">Profile Information</h3>
          <div class="d-flex flex-row justify-content-between align-items-center w-50">
            <div class="d-flex flex-row gap-2 align-items-center">
              <span><strong>Full Name :</strong></span>
              <span><?php echo $user_data[0]["fullname"] ?></span>
            </div>
            <div class="d-flex flex-row gap-2 align-items-center">
              <span><strong>Email :</strong></span>
              <span><?php echo $user_data[0]["email"] ?></span>
            </div>
          </div>
          <div class="d-flex flex-row justify-content-between align-items-center w-50">
            <div class="d-flex flex-row gap-2 align-items-center">
              <span><strong>Joined On:</strong></span>
              <span><?php echo $readable_date; ?></span>
            </div>
          </div>
          <div class="d-flex flex-row justify-content-between align-items-center w-50">
            <div class="d-flex flex-row gap-2 align-items-center">
              <a href="logout.php" class="btn btn-warning">Logout</a>
            </div>
          </div>
        </div>
        <br>
      </div>
      <div class="tab-pane fade" id="bookings" role="tabpanel" aria-labelledby="profile-tab">

        <h3 class="text-center mt-5">My Bookings</h3>
        <div class="panel panel-extra-wodth mt-4 mb-5 py-3">
          <div class="booking-cards">
            <?php
              $mybookings = getData($conn, "select * from booking where user = $my_id");
              foreach($mybookings as $booking) {
                $source_id = $booking["source"];
                $destination_id = $booking["destination"];
                $route_id = $booking["route"];
                $schedule = $booking["schedule"];
                $source_data = getData($conn,"select * from Stations where id = $source_id");
                $destination_data = getData($conn,"select * from Stations where id = $destination_id");
                $route_data = getData($conn,"select * from Routes where id = $route_id");
                $start_station_id = $route_data[0]["start_station_id"];
                $end_station_id = $route_data[0]["end_station_id"];
                $journey_start_data = getData($conn,"select * from Stations where id = $start_station_id");
                $journey_end_data = getData($conn,"select * from Stations where id = $end_station_id");
            ?>
            <div class="booking-card">
              <div class="card-heading">
                <div class="d-flex flex-row justify-content-between w-100">
                  <span><strong>🚆 From : </strong> <?php echo $source_data[0]["name"] ?></span>
                  <span><strong>🚉 To : </strong><?php echo $destination_data[0]["name"] ?> </span>
                </div>
                <div class="w-100">
                  <span><strong>🚇 Route Name : </strong> <?php echo $journey_start_data[0]["name"] ?> <font style="text-danger">to</font> <?php echo $journey_end_data[0]["name"] ?></span>
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex">
                  <span><strong>Booking Date:</strong></span>
                  <span><?php echo $booking["booking_date"] ?></span>
                </div>
                <div class="d-flex">
                  <span><strong>Booking Time:</strong></span>
                  <span><?php echo $booking["booking_time"] ?></span>
                </div>
                <div class="d-flex">
                  <span><strong>Seats:</strong></span>
                  <span><?php echo $booking["seats"] ?></span>
                </div>
                <div class="d-flex">
                  <span><strong>Total Cost (inclusive Of All Taxes):</strong></span>
                  <span>$<?php echo $booking["price"] ?></span>
                </div>
                <div class="d-flex">
                  <a href=""> <input type="button" value="Cancel Booking" class="btn btn-danger"> </a>
                </div>
              </div>
            </div>
            <?php } ?>
          </div>
        </div>

      </div>
      <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="contact-tab">
        <h3 class="text-center mt-5">Password and Security</h3>
        <div class="d-flex flex-column gap-3 w-50 align-items-center mt-5 mb-5 shadow py-5 px-5" style="margin:0 auto">
          <form action="controllers/password_controller.php" method="post" class="w-100">
            <div class="mb-3 d-flex flex-row gap-2">
              <label for="staticEmail" class="col-form-label fw-bold">Email </label>
              <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="email@example.com">
              </div>
            </div>
            <div class="mb-3 d-flex flex-column gap-2 w-100">
              <label for="inputPassword" class="col-form-label">New Password</label>
              <input type="password" name="password" class="form-control" id="inputPassword">
            </div>
            <div class="mb-3 d-flex flex-column gap-2 w-100">
              <label for="inputPassword" class="col-form-label">Confirm New Password</label>
              <input type="password" name="cpassword" class="form-control" id="inputPassword">
            </div>
            <input type="submit" value="Update Password" class="btn btn-danger">
          </form>
        </div>
      </div>
    </div>
    <!-- Submenu Tabbing For Profile End Here -->


    <?php include "shared/footer.php" ?>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
</body>

</html>