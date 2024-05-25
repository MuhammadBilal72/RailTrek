<?php
  session_start();
  include "./../../config.php";
  include "./../../utils/functions.php";

  $id = intval($_REQUEST["id"]);

  $q = "update trains set is_deleted = 1 where id = $id";
  mysqli_query($conn, $q) or die(mysqli_error($conn));
  header("location:./../trains.php?deleted");
?>