<?php
include "./../config.php";
include "./../utils/functions.php";

$mode = $_REQUEST["mode"];
$departure = intval($_REQUEST["departure"]);
$data = array();
$route = 0;

if ($mode == "forward") {
    $route = 1;
    $data = getData($conn, "select * from Schedules where route_id = 1");
} else {
    $route = 2;
    $data = getData($conn, "select * from Schedules where route_id = 1");
}

$timings = array();
foreach ($data as $dt) {
    $arrival_time_at_station = calculateStationArrivalTime($dt["departure_time"], $dt["arrival_time"], $departure);
    $timings[] = ["route" => $route, "time" => $arrival_time_at_station, "schedule"=> $dt["id"]];
}

echo json_encode($timings);

function calculateStationArrivalTime($departure_time, $arrival_time, $station_number) {
  // Convert the departure and arrival times to DateTime objects
  $departure_datetime = new DateTime($departure_time);
  $arrival_datetime = new DateTime($arrival_time);

  // Calculate total travel time in minutes
  $total_travel_time = ($arrival_datetime->getTimestamp() - $departure_datetime->getTimestamp()) / 60;

  // Calculate time per station
  $time_per_station = $total_travel_time / (10 - 1);

  // Calculate arrival time at the specified station
  $arrival_time_at_station = clone $departure_datetime;
  $arrival_time_at_station->modify("+" . ($station_number - 1) * $time_per_station . " minutes");

  // Format and return the arrival time in hh:mm AM/PM format
  return $arrival_time_at_station->format('h:i A');
}
?>
