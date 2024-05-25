<?php
  session_start();
  include "./../../config.php";
  include "./../../utils/functions.php";

  $user = $_SESSION["current_admin"];

  $q = "insert into new_train_request (admin_id) values('$user')";
  mysqli_query($conn, $q) or die(mysqli_error($conn));
  header("location:./../trains.php?new_submitted");
  exit();
?>