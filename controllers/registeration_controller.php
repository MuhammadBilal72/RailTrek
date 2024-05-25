<?php
  session_start();
  include "./../utils/functions.php";
  include "./../config.php";

  $fullname = trim($_REQUEST["fullname"]);
  $email = trim($_REQUEST["email"]);
  $password = trim($_REQUEST["password"]);

  if ($fullname == "" || $email == "" || $password == "") {
    header("location:./../register.php?missing_details");
    exit();
  } else if (strlen($password) < 6 ) {
    header("location:./../register.php?password_short");
    exit();
  } else {
    $emailQ = "select * from users where email = '$email'";
    $email_count = getCount($conn, $emailQ);
    if ($email_count == 0) {
      $insQ = "insert into users (fullname, email, password) values('$fullname', '$email', '$password')";
      mysqli_query($conn, $insQ) or die(mysqli_error($conn));
      header("location:./../register.php?created");
      exit();
    } else {
      header("location:./../register.php?email_persistent");
      exit();
    }
  }
?>