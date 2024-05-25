<?php
  session_start();
  include "./../../config.php";
  include "./../../utils/functions.php";

  $type = $_REQUEST["type"];
  $name = trim($_REQUEST["name"]);
  $series = trim($_REQUEST["series"]);
  $seats = intval($_REQUEST["seats"]);
  $stock = intval($_REQUEST["stock"]);

  $q = "insert into RollingStock(type, name, series, seats, stock) values('$type', '$name', '$series', '$seats', '$stock')";
  mysqli_query($conn, $q) or die(mysqli_error($conn));
  header("location:./../rolling_stock.php?created");
?>