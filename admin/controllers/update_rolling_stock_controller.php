<?php
  session_start();
  include "./../../config.php";
  include "./../../utils/functions.php";

  $id = intval($_REQUEST["id"]);
  $type = $_REQUEST["type"];
  $name = trim($_REQUEST["name"]);
  $series = trim($_REQUEST["series"]);
  $seats = intval($_REQUEST["seats"]);
  $stock = intval($_REQUEST["stock"]);

  $q = "update RollingStock set type='$type' , name = '$name' ,series='$series' , seats='$seats', stock='$stock' where id = $id";
  mysqli_query($conn, $q) or die(mysqli_error($conn));
  header("location:./../rolling_stock.php?updated");
?>