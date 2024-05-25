<?php
  session_start();
  include "./../../config.php";
  include "./../../utils/functions.php";

  $id = intval($_REQUEST["id"]);

  $q = "delete from Schedules where id = $id";
  mysqli_query($conn, $q) or die(mysqli_error($conn));
  header("location:./../schedules.php?deleted");
?>