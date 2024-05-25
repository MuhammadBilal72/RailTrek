<?php
  session_start();
  include "./../../config.php";
  include "./../../utils/functions.php";

  $user = $_SESSION["current_admin"];
  $train_id = intval($_REQUEST["id"]);

  $q = "insert into cancel_request (admin_id, train_id) values('$user', '$train_id')";
  mysqli_query($conn, $q) or die(mysqli_error($conn));
  header("location:./../trains.php?cancel_submitted");
  exit();
?>