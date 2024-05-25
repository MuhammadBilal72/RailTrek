<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
  id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
      aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0" href="index.php"
      target="_blank">
      <img src="./assets/img/logo.png" class="navbar-brand-img h-100" alt="main_logo">
      <span class="ms-1 font-weight-bold">RailTrek Admin</span>
    </a>
  </div>
  <hr class="horizontal dark mt-0">
  <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link <?php echo $page_name == 'Dashboard' ? 'active' : '' ?>" href="index.php">
          <div
            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Dashboard</span>
        </a>
      </li>
      <?php if($_SESSION["role"] == "back-office"){ ?>
        <li class="nav-item">
          <a class="nav-link <?php echo $page_name == 'Rolling Stock' ? 'active' : '' ?>" href="rolling_stock.php">
            <div
              class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-cubes text-secondary opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Rolling Stock</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo $page_name == 'Schedules' ? 'active' : '' ?>" href="schedules.php">
            <div
              class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-calendar text-danger text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Schedules</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo $page_name == 'Train Requests' ? 'active' : '' ?>" href="train_requests.php">
            <div
              class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-bell text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Train Requests</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo $page_name == 'Train Cancel Requests' ? 'active' : '' ?>" href="cancel_requests.php">
            <div
              class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-ban text-danger text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Train Cancel Requests</span>
          </a>
        </li>
      <?php } ?>
      <li class="nav-item">
        <a class="nav-link <?php echo $page_name == 'Trains' ? 'active' : '' ?>" href="trains.php">
          <div
            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-train text-warning text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Trains</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php echo $page_name == 'Users' ? 'active' : '' ?>" href="users.php">
          <div
            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-users text-success text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Users</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="logout.php">
          <div
            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-lock text-info text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Logout</span>
        </a>
      </li>
    </ul>
  </div>
  <span class="text-primary text-center px-3">Logged in As: <strong class="text-warning"><?php echo strtoupper($_SESSION["role"]) ?></strong> </span>
</aside>
