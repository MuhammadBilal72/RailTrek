<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>RailTrek - Best Tour Services Provider</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <?php include "shared/assets.php" ?>
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
  <style>
    .card{
      background: rgb(2,0,36);
      background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(247,240,44,0.53687412464986) 0%, rgba(255,199,111,0.836594012605042) 50%, rgba(190,240,110,0.20354079131652658) 100%);
    }
  </style>
</head>

<body>

    <?php include "shared/header.php"; ?>

  <!-- ======= Hero Section ======= -->
  <section id="hero">

    <div class="container">
      <div class="row d-flex align-items-center">
      <div class=" col-lg-6 py-5 py-lg-0 order-2 order-lg-1" data-aos="fade-right">
        <h1>Your Tour experience with RailTrek</h1>
        <h2>Get the best tour journey experience with Railtrek Trains. Enojy Premium Experience</h2>
        <a href="login.php" class="btn-get-started scrollto">Book Seat Now</a>
      </div>
      <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="fade-left">
        <img src="assets/img/train.png" class="img-fluid" alt="">
      </div>
    </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about section-bg">
      <div class="container">

        <div class="row gy-4">
          <div class="image col-xl-5"></div>
          <div class="col-xl-7">
            <div class="content d-flex flex-column justify-content-center ps-0 ps-xl-4">
              <h3 data-aos="fade-in" data-aos-delay="100">Enjoy Premium Features of Our Trains</h3>
              <p data-aos="fade-in">
                Our trains feature bi-level glass-dome coaches with oversized windows, providing panoramic views of the stunning scenery. Enjoy gourmet meals prepared by our expert chefs in our lower-level dining room, and sip on complimentary beverages and snacks as you take in the sights
              </p>
              <div class="row gy-4 mt-3">
                <div class="col-md-6 icon-box" data-aos="fade-up">
                  <i class="bx bx-receipt"></i>
                  <h4><a href="#"></a>Levish Journey</h4>
                  <p>Our train Compartments offer a levish journey experience</p>
                </div>
                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="100">
                  <i class="bx bx-cube-alt"></i>
                  <h4><a href="#">Comfortable Seats</a></h4>
                  <p>Premium quality seats which are built for comfortable journey</p>
                </div>
                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="200">
                  <i class="bx bx-images"></i>
                  <h4><a href="#">Healthy Refreshments</a></h4>
                  <p>We provide healthy refreshments to make your journey enjoyable</p>
                </div>
                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="300">
                  <i class="bx bx-shield"></i>
                  <h4><a href="#">Affordable Tickets</a></h4>
                  <p>We offer affordable tickets with premium features</p>
                </div>
              </div>
            </div><!-- End .content-->
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Stations Section ======= -->
    <section id="stations" class="features section-bg">
      <div class="container">

        <div class="section-title">
          <h2 data-aos="fade-in">Stations Crossed</h2>
          <p data-aos="fade-in">Our Railway Line Starts from Torre Spaventa  and ends at Villa San Felice. The Stations that our trains go through are Torre Spaventa, Prato Terra, Rocca Pietrosa, Villa Pietrosa , Villa Santa Maria, Pietra Santa Maria , Castro Marino, Porto Spigola, Porto San Felice and finally Villa San Felice</p>
        </div>

        <div class="row content">
          <div class="col-lg-12" data-aos="fade-right">
            <img src="assets/img/map.png" class="img-fluid" alt="">
          </div>
        </div>

        <div class="row content" id="schedule">
          <div class="col-lg-12 pt-5 order-2 order-md-1" data-aos="fade-right">
            <h3>Train Schedules</h3>
            <p class="fst-italic">
              Here are our Schedules on different routes by different trains
            </p>
            <?php
            include "config.php";
            $query = "SELECT Trains.name AS train_name, 
            CONCAT(departure_station.name, ' - ', arrival_station.name) AS route,
            DATE_FORMAT(Schedules.departure_time, '%r') AS departure_time,
            DATE_FORMAT(Schedules.arrival_time, '%r') AS arrival_time
            FROM Trains
            INNER JOIN Schedules ON Trains.id = Schedules.train_id
            INNER JOIN Routes ON Schedules.route_id = Routes.id
            INNER JOIN Stations AS departure_station ON Routes.start_station_id = departure_station.id
            INNER JOIN Stations AS arrival_station ON Routes.end_station_id = arrival_station.id";
            $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
            if ($result->num_rows > 0) {
              echo '<div class="table-responsive">';
              echo '<table class="table table-striped">';
              echo '<thead>';
              echo '<tr>';
              echo '<th>Train</th>';
              echo '<th>Route</th>';
              echo '<th>Departure Time</th>';
              echo '<th>Arrival Time</th>';
              echo '</tr>';
              echo '</thead>';
              echo '<tbody>';
              // Output data of each row
              while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo "<td>{$row['train_name']}</td>";
                echo "<td>{$row['route']}</td>";
                echo "<td>{$row['departure_time']}</td>";
                echo "<td>{$row['arrival_time']}</td>";
                echo '</tr>';
              }
              echo '</tbody>';
              echo '</table>';
              echo '</div>';
            } else {
                echo "0 results";
            }
            ?>
          </div>
        </div>

       

      </div>
    </section><!-- End Features Section -->

    <!-- ======= Rolling Stock Profoloo Section ======= -->
    <section id="rollingstock" class="portfolio section-bg">
      <div class="container">

        <div class="section-title">
          <h2 data-aos="fade-in">Rolling Stock</h2>
          <p data-aos="fade-in">Discover the diverse range of rolling stock available for your journey with us. From comfortable passenger carriages to powerful locomotives, we have everything you need for a safe and enjoyable travel experience. Browse through the categories below to learn more about each type of rolling stock.</p>
        </div>
        
        <div class="row">
          <div class="col-md-4">
            <div class="card shadow">
              <div class="card-body">
                <h5 class="card-title">Carriages</h5>
                <p class="card-text">Passenger carriages for comfortable travel.</p>
                <ul class="list-unstyled">
                  <li><i class="fas fa-caret-right"></i> Series 1928</li>
                  <li><i class="fas fa-caret-right"></i> Series 1930</li>
                  <li><i class="fas fa-caret-right"></i> Series 1952</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card shadow">
              <div class="card-body">
                <h5 class="card-title">Baggage Cars</h5>
                <p class="card-text">Cars for carrying luggage and other cargo.</p>
                <ul class="list-unstyled">
                  <li><i class="fas fa-caret-right"></i> Series 1910</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card shadow">
              <div class="card-body">
                <h5 class="card-title">Diesel Railcars</h5>
                <p class="card-text">Self-propelled rail vehicles powered by diesel engines.</p>
                <ul class="list-unstyled">
                  <li><i class="fas fa-caret-right"></i> AN 56.2</li>
                  <li><i class="fas fa-caret-right"></i> AN 56.4</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-4">
          <div class="col-md-4">
            <div class="card shadow">
              <div class="card-body">
                <h5 class="card-title">Locomotives</h5>
                <p class="card-text">Engine units that pull the train along the tracks.</p>
                <ul class="list-unstyled">
                  <li><i class="fas fa-caret-right"></i> SFT.3 «Cavour»</li>
                  <li><i class="fas fa-caret-right"></i> SFT.4 «Vittorio Emanuele»</li>
                  <li><i class="fas fa-caret-right"></i> SFT.6 «Garibaldi»</li>
                </ul>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Portfolio Section -->

  </main><!-- End #main -->
  <?php include "shared/footer.php" ?>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

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