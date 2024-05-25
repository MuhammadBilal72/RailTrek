<?php
session_start();
include "./../../config.php";
include "./../../utils/functions.php";

$id = intval($_REQUEST["id"]);
$train = intval($_REQUEST["train"]);
$route = intval($_REQUEST["route"]);
$depTime = $_REQUEST["depTime"];
$arrTime = $_REQUEST["arrTime"];

if ($depTime == $arrTime || $depTime > $arrTime) {
  header("location:./../new_schedule.php?invalid_time");
  exit();
} else {
  $depCount = getCount($conn, "SELECT * FROM Schedules WHERE route_id = '$route' AND TIME(departure_time) = '$depTime'");
  $arrCount = getCount($conn, "SELECT * FROM Schedules WHERE route_id = '$route' AND TIME(arrival_time) = '$arrTime'");
  if($depCount > 0) {
    header("location:./../edit_schedule.php?departure_exist&id=".$id);
    exit();
  } else if($arrCount > 0) {
    header("location:./../edit_schedule.php?arrival_exist&id=".$id);
    exit();
  } else {
    $currentDate = date("Y-m-d");
    $depDateTime = date("Y-m-d H:i:s", strtotime("$currentDate $depTime"));
    $arrDateTime = date("Y-m-d H:i:s", strtotime("$currentDate $arrTime"));

    $q = "update Schedules set train_id = '$train', route_id = '$route' , departure_time = '$depTime' , arrival_time = '$arrTime' where id = '$id'";
    mysqli_query($conn, $q) or die(mysqli_error($conn));
    header("location:./../schedules.php?created");
    exit();
  }
}
?>
