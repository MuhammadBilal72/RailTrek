<?php
  session_start();
  include "./../utils/functions.php";
  include "./../config.php";

  $email = trim($_REQUEST["email"]);
  $password = trim($_REQUEST["password"]);
  $users = getData($conn, "select * from users where email = '$email' and password = '$password'");
  if(count($users) > 0) {
    $_SESSION["user"] = $users[0]["id"];
    header("location:./../index.php");
    exit();
  } else {
    header("location:./../login.php?invalid_details");
    exit();
  }
?>