<?php
session_start();
include "./../../config.php";
include "./../../utils/functions.php";

$name = trim($_REQUEST["name"]);
$part_1 = intval($_REQUEST["pos_1"]);
$part_2 = intval($_REQUEST["pos_2"]);
$part_3 = intval($_REQUEST["pos_3"]);
$part_4 = intval($_REQUEST["pos_4"]);

try {
    // Start the transaction
    $conn->begin_transaction();

    // First query: insert into Trains
    $name = $conn->real_escape_string($name);
    $q = "INSERT INTO Trains (name) VALUES ('$name')";
    if (!$conn->query($q)) {
        throw new Exception("Error inserting into Trains: " . $conn->error);
    }
    $train_id = $conn->insert_id;

    // Function to insert into TrainComposition and update RollingStock
    function insertAndUpdateStock($conn, $train_id, $part_id, $position) {
        $insert_query = "INSERT INTO TrainComposition (train_id, rolling_stock_id, position) VALUES ('$train_id', '$part_id', $position)";
        if (!$conn->query($insert_query)) {
            throw new Exception("Error inserting part $part_id into TrainComposition: " . $conn->error);
        }

        $update_query = "UPDATE RollingStock SET stock = stock - 1 WHERE id = '$part_id'";
        if (!$conn->query($update_query)) {
            throw new Exception("Error updating stock for part $part_id: " . $conn->error);
        }
    }

    // Insert parts into TrainComposition and update stock
    insertAndUpdateStock($conn, $train_id, $part_1, 1);
    insertAndUpdateStock($conn, $train_id, $part_2, 2);
    insertAndUpdateStock($conn, $train_id, $part_3, 3);
    insertAndUpdateStock($conn, $train_id, $part_4, 4);

    $conn->commit();

    header("location:./../trins.php?created");
} catch (Exception $e) {
    $conn->rollback();
    echo "Transaction rolled back. Error: " . $e->getMessage();
}
  $conn->close();
?>
