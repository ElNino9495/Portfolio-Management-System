<?php
// update_stock.php

include("connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stockId = $_POST['stockId'];
    $newOpenPrice = $_POST['newOpenPrice'];
    $newClosePrice = $_POST['newClosePrice'];
    $newLowestPrice = $_POST['newLowestPrice'];
    $newHighestPrice = $_POST['newHighestPrice'];

    // TODO: Perform the update in the database
    // Example:
    $sql = "UPDATE COMPANY_PERFORMANCE SET
            OPEN_PRICE = '$newOpenPrice',
            CLOSE_PRICE = '$newClosePrice',
            LOWEST_PRICE = '$newLowestPrice',
            HIGHEST_PRICE = '$newHighestPrice'
            WHERE STOCK_ID = '$stockId'";

    if ($conn->query($sql) === TRUE) {
        echo 'Update successful';
    } else {
        echo 'Error updating record: ' . $conn->error;
    }
} else {
    echo 'Invalid request method';
}
?>

