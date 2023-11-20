<?php
// Assuming you have a database connection established in your script
include("connection.php");
session_start();

if(isset($_GET['stock_id']) && isset($_GET['stocks_to_sell'])) {
    $stock_id = $_GET['stock_id'];
    $stocks_to_sell = $_GET['stocks_to_sell'];
    $user_id = $_SESSION['user_id'];

    // Retrieve the current number of stocks
    $sql_select = "SELECT * FROM portfolio WHERE STOCK_ID = '$stock_id' AND user_id='$user_id'";
    $result = mysqli_query($conn, $sql_select);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $current_stocks = $row['quantity'];

        // Check if the user has enough stocks to sell
        if ($current_stocks >= $stocks_to_sell) {
            // Calculate the new number of stocks after selling
            $new_stocks = $current_stocks - $stocks_to_sell;

            // Update the number of stocks in the portfolio
            $sql_update = "UPDATE portfolio SET quantity = '$new_stocks' WHERE STOCK_ID = '$stock_id' AND user_id='$user_id'";
            
            if (mysqli_query($conn, $sql_update)) {
                // Check if the updated quantity is zero, delete the record
                if ($new_stocks == 0) {
                    $sql_delete = "DELETE FROM portfolio WHERE STOCK_ID = '$stock_id' AND user_id='$user_id'";
                    
                    if (mysqli_query($conn, $sql_delete)) {
                        header("Location: portfolio.php");
                    } else {
                        echo "Error deleting record: " . mysqli_error($conn);
                    }
                } else {
                    header("Location: portfolio.php");
                }
            } else {
                echo "Error updating record: " . mysqli_error($conn);
            }
        } else {
            header("Location: portfolio.php");
        }
    } else {
        echo "Error retrieving stock information: " . mysqli_error($conn);
    }

    mysqli_free_result($result);
} else {
    echo "Invalid parameters.";
}

// Close the database connection if you opened one
mysqli_close($conn);
?>

