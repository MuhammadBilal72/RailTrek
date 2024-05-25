<?php
session_start();
include "./../../config.php";
include "./../../utils/functions.php";

$train = trim($_REQUEST["train"]);
$route = trim($_REQUEST["route"]);
$depTime = $_REQUEST["depTime"];
$arrTime = $_REQUEST["arrTime"];

if ($depTime == $arrTime || $depTime > $arrTime) {
  header("location:./../new_schedule.php?invalid_time");
  exit();
} else {
  $depCount = getCount($conn, "SELECT * FROM Schedules WHERE route_id = '$route' AND TIME(departure_time) = '$depTime'");
  $arrCount = getCount($conn, "SELECT * FROM Schedules WHERE route_id = '$route' AND TIME(arrival_time) = '$arrTime'");
  if($depCount > 0) {
    header("location:./../new_schedule.php?departure_exist");
    exit();
  } else if($arrCount > 0) {
    header("location:./../new_schedule.php?arrival_exist");
    exit();
  } else {
    $currentDate = date("Y-m-d");
    $depDateTime = date("Y-m-d H:i:s", strtotime("$currentDate $depTime"));
    $arrDateTime = date("Y-m-d H:i:s", strtotime("$currentDate $arrTime"));

    $q = "insert into Schedules (train_id, route_id, departure_time, arrival_time) values('$train', '$route', '$depDateTime', '$arrDateTime')";
    mysqli_query($conn, $q) or die(mysqli_error($conn));
    header("location:./../schedules.php?created");
    exit();
  }
}
?>
