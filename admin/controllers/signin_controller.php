<?php
  session_start();
  include "./../../config.php";
  include "./../../utils/functions.php";

  $email = $_REQUEST["email"];
  $password = $_REQUEST["password"];
  $q = "select * from Users where email='$email' and password='$password'";

  $matched_users = getData($conn, $q);

  if(count($matched_users) > 0){
    if($matched_users[0]["role"] == "admin" || $matched_users[0]["role"] == "back-office") {
      $_SESSION["role"] = $matched_users[0]["role"];
      $_SESSION["current_admin"] = $matched_users[0]["id"];
      header("location:./../index.php");
      exit();
    } else {
      header("location:./../auth_signin.php?request_unathorized");
      exit();
    }
  } else {
    header("location:./../auth_signin.php?invalid_credentials");
    exit();
  }
?>
