<?php
  session_start();
  include "./../config.php";
  $password = trim($_REQUEST["password"]);
  $cpassword = trim($_REQUEST["cpassword"]);
  $my_id = $_SESSION["user"];
  if ($password == "" || $cpassword == "") {
    header("location:./../profile.php?missing_details");
  } else if ($password != $cpassword) {
    header("location:./../profile.php?password_not_matched");
    exit();
  } else if (strlen($password)<6) {
    header("location:./../profile.php?password_short");
    exit();
  } else {
    $q = "update users set password = '$password' where id = $my_id";
    mysqli_query($conn, $q) or die(mysqli_error($conn));
    header("location:./../profile.php?created");
    exit();
  }
?>