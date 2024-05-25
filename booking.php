<?php
session_start();
if (!isset($_SESSION["user"])) {
  header("location:./login.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>RailTrek - Book Your Seat</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <?php include "shared/assets.php" ?>
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

  <?php include "shared/header.php"; ?>
  <main id="main" class="py-5">
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active">
        <?php if (isset($_REQUEST["invalid_date"])) { ?>
          <div class="alert alert-danger">
            Invalid Booking Date and time. Please chose a date and time greater than current date and time
          </div>
        <?php } else if (isset($_REQUEST["created"])) { ?>
                <div class="alert alert-success">
                  Success ! booking has been created successfully. you can view it in bookings section of your profile
                </div>
        <?php } ?>
        <div class="px-5 py-5">
          <div class="d-flex flex-row justify-content-center gap-5 align-items-center">
            <h1>Book Your Seat Now</h1>
            <h3 class="text-danger price">$0</h3>
          </div>
          <form action="controllers/booking_controller.php" method="post" id="bookingForm">
            <div class="form-group mb-3">
              <label for="">From (Departure Location): </label>
              <select name="source" class="form-select" onchange="fetchTiming(this)" oninput="fetchTiming(this)" id="source">
                <?php
                include "config.php";
                $stationQ = "select * from Stations";
                $resStation = mysqli_query($conn, $stationQ) or die(mysqli_error($conn));
                while ($rowStation = mysqli_fetch_array($resStation)) {
                  echo '<option value="' . $rowStation["id"] . '">' . $rowStation["name"] . '</option>';
                }
                ?>
              </select>
            </div>
            <div class="form-group mb-3">
              <label for="">Destination: </label>
              <select name="destination" class="form-select" onchange="fetchTiming(this)" id="destination">
                <?php
                $stationQ = "select * from Stations";
                $resStation = mysqli_query($conn, $stationQ) or die(mysqli_error($conn));
                while ($rowStation = mysqli_fetch_array($resStation)) {
                  echo '<option value="' . $rowStation["id"] . '">' . $rowStation["name"] . '</option>';
                }
                ?>
              </select>
            </div>
            <div class="form-group mb-3">
              <label for="">Booking Date: </label>
              <input type="date" name="booking_date" class="form-control" required>
            </div>
            <div class="form-group mb-3">
              <label for="">Departure Time: </label>
              <select name="departure_time" class="form-select" id="booking_time">
                <option value="11:30 AM">11:30 AM</option>
                <option value="03:00 PM">03:00 PM</option>
                <option value="06:00 PM">06:00 PM</option>
                <option value="09:00 PM">09:00 PM</option>
                <option value="12:00 AM">12:00 AM</option>
                <option value="03:00 AM">03:00 AM</option>
                <option value="05:00 AM">05:00 AM</option>
              </select>
            </div>
            <div class="form-group mb-3">
              <label for="">Seats: </label>
              <input type="number" id="seats" name="seats" class="form-control" required value="1" min="1" max="10"
                onchange="updateTicketPrice()">
            </div>
            <div class="d-flex flex-row gap-3">
              <input type="submit" value="Pay Now and Book" class="btn btn-danger">
              <input type="reset" value="Cancel" class="btn btn-outline-primary">
            </div>
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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
      integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
    <script>
      const sourceEl = document.querySelector("#source");
      const destinationEl = document.querySelector("#destination");
      const seatsEl = document.querySelector("#seats");
      const priceEL = document.querySelector(".price");
      const booking_timeEL = document.querySelector("#booking_time");
      const bookingForm = document.querySelector("#bookingForm");
      bookingForm.addEventListener("submit", function (e) {
        e.preventDefault();
        let source = parseInt(sourceEl.value);
        let destination = parseInt(destinationEl.value);
        let seats = parseInt(seatsEl.value);

        if (source == destination) {
          alert("Destination Should be different from Departure")
        } else if (seats <= 0) {
          alert("Please Enter Valid Number of Seats")
        } else if (seats > 10) {
          alert("Sorry! You can buy maximum 10 seats")
        } else {
          bookingForm.submit();
        }
      })

      function fetchTiming(station) {
        let source = parseInt(sourceEl.value);
        let destination = parseInt(destinationEl.value);

        let dep_id = 0;
        let mode = null;

        if (source < destination) {
          mode = "forward";
          dep_id = source;
        } else {
          mode = "return";
          dep_id = destination;
        }
        updateTicketPrice();

        $.ajax({
          url: 'controllers/ajax_timing_controller.php',
          type: 'POST',
          data: { mode: mode, departure: dep_id },
          success: function (response) {
            booking_timeEL.innerHTML = "";
            var parsedResponse = JSON.parse(response);
            parsedResponse.forEach(respObj => {
              booking_timeEL.innerHTML += `<option value='${respObj.route}-${respObj.schedule}-${respObj.time}'>${respObj.time}</option>`;
            });
          },
          error: function (xhr, status, error) {
            console.error('Error: ' + error);
          }
        });
      }

      function updateTicketPrice() {
        let source = parseInt(sourceEl.value);
        let destination = parseInt(destinationEl.value);
        let seats = parseInt(seatsEl.value);
        let price = 10 * Math.abs(source - destination) * seats;
        priceEL.textContent = `$${price}`;
      }
    </script>
</body>

</html>