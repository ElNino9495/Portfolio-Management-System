<?php
    include("connection.php");
    session_start();
    
    if (isset($_POST["sub_t"])) {
        $sym = $_POST['symbol'];
        $quantit = $_POST['quantity'];
        $price = $_POST['price'];
        $uid = $_SESSION['user_id'];
        
        // Check if the stock_id already exists in the portfolio
        $check_sql = "SELECT stock_id FROM portfolio WHERE user_id = '$uid' AND stock_id = '$sym'";
        $check_result = mysqli_query($conn, $check_sql);
        
        if (mysqli_num_rows($check_result) > 0) {
            // Stock_id already exists, update the existing record
            $update_sql = "UPDATE portfolio SET quantity = quantity + '$quantit' WHERE user_id = '$uid' AND stock_id = '$sym'";
            if (mysqli_query($conn, $update_sql)) {
                echo "Updated successfully!";
            } else {
                echo "Error updating record: " . mysqli_error($conn);
            }
        } else {
            // Stock_id doesn't exist, insert a new record
            $insert_sql = "INSERT INTO portfolio (user_id, quantity, buy_price, stock_id) VALUES ('$uid', '$quantit', '$price', '$sym')";
            if (mysqli_query($conn, $insert_sql)) {
                echo "Added successfully!";
            } else {
                echo "Error inserting record: " . mysqli_error($conn);
            }
        }
        
        // Redirect to the portfolio page
        header("Location: portfolio.php");
        exit();
    }
?> 
