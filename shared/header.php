<!-- ======= Header ======= -->
<header id="header">
  <div class="container d-flex align-items-center justify-content-between">

    <div class="logo">
      <h1><a href="index.php">RailTrek<span>.</span></a></h1>
    </div>

    <nav id="navbar" class="navbar">
      <?php
        $booking_link = "login.php";
        if (isset($_SESSION["user"])) {
          $booking_link = "booking.php";
        }
      ?>
      <ul>
        <li><a class="nav-link scrollto active" href="index.php#hero">Home</a></li>
        <li><a class="nav-link scrollto" href="index.php#about">About Us</a></li>
        <li><a class="nav-link scrollto" href="index.php#stations">Stations</a></li>
        <li><a class="nav-link scrollto" href="index.php#schedule">Scehdules</a></li>
        <li><a class="nav-link scrollto" href="index.php#rollingstock">Rolling Stock</a></li>
        <li><a class="getstarted scrollto" href="<?php echo $booking_link ?>">Book Now</a></li>
        <?php if(isset($_SESSION["user"])) { ?>
        <li><a class="nav-link" href="profile.php" style="border: 1px solid gray;
          padding: 0px;
          padding-top: 15px;
          padding-bottom: 15px;
          padding-right: 8px;
          padding-left: 4px;
          border-radius: 48px; margin-left: 20px">
            <i class="fa fa-user fa-lg" style="font-size: 18px"></i>
          </a>
        </li>
        <li><a href="logout.php" class="nav-link" href="profile.php">
          Logout
          </a>
        </li>
        <?php } ?>
      </ul>
      <i class="bi bi-list mobile-nav-toggle"></i>
    </nav><!-- .navbar -->

  </div>
</header><!-- End Header -->