<?php
session_start();
include "./../utils/functions.php";
include "./../config.php";

$my_id = $_SESSION["user"];
$source = intval($_REQUEST["source"]);
$destination = intval($_REQUEST["destination"]);
$booking_date = $_REQUEST["booking_date"];
$seats = intval($_REQUEST["seats"]);
$departure_time_data = $_REQUEST["departure_time"];
$dep_data = explode("-", $departure_time_data);
$route = $dep_data[0];
$schedule = $dep_data[1];
$departure_time = $dep_data[2];
$price = 10 * abs($source - $destination) * $seats;
// Combine booking date and departure time
$combined_datetime = date_create_from_format('Y-m-d h:i A', $booking_date . ' ' . $departure_time);

if ($combined_datetime === false) {
  // Error occurred while parsing the datetime
  echo "Error: Failed to parse the combined datetime.";
} else {
  // Current datetime
  $current_datetime = new DateTime();

  // Compare combined datetime with current datetime
  if ($combined_datetime > $current_datetime) {
    $insQ = "insert into booking (user, source, destination, route, schedule, seats, booking_time, booking_date, price) values ('$my_id', '$source', '$destination', '$route', '$schedule', '$seats', '$departure_time', '$booking_date', '$price')";
    mysqli_query($conn, $insQ) or die(mysqli_error($conn));
    header("location:./../booking.php?created");
    exit();
  } else {
    header("location:./../booking.php?invalid_date");
    exit();
  }
}
?>
