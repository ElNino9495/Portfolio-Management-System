<?php
// Assuming you have a database connection established in your script
include("connection.php");
session_start();
if(isset($_GET['stock_id'])) {
    $stock_id = $_GET['stock_id'];
    $user_id = $_SESSION['user_id'];

    // Perform the delete operation
    $sql_delete = "DELETE FROM watchlist WHERE STOCK_ID = '$stock_id' and user_id='$user_id'";

    if(mysqli_query($conn, $sql_delete)) {
        header("Location: watchlist.php");
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    echo "Invalid stock_id parameter.";
}

// Close the database connection if you opened one
mysqli_close($conn);
?>
