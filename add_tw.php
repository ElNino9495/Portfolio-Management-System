<?php
    include("connection.php");
    session_start();
    
    if (isset($_POST["sub_tw"])) {
        $sym = $_POST['symbol'];
        $uid = $_SESSION['user_id'];
        
        // Check if the stock_id already exists in the watchlist
        $check_sql = "SELECT stock_id FROM watchlist WHERE user_id = '$uid' AND stock_id = '$sym'";
        $check_result = mysqli_query($conn, $check_sql);
        
        if (mysqli_num_rows($check_result) == 0) {
            // The stock_id doesn't exist in the watchlist, so insert a new record
            $sql_price = "SELECT STOCK_PRICE FROM company WHERE stock_id = '$sym'";
            $check_result = mysqli_query($conn, $sql_price);
            
            if ($check_result && $check_result->num_rows > 0) {
                $row = $check_result->fetch_assoc();
                $p_price = $row['STOCK_PRICE'];
                
                $insert_sql = "INSERT INTO watchlist (user_id, stock_id, stock_price) VALUES ('$uid', '$sym', '$p_price')";
                if (mysqli_query($conn, $insert_sql)) {
                    echo "Added successfully!";
                } else {
                    echo "Error inserting record: " . mysqli_error($conn);
                }
            } else {
                echo "Error fetching stock price: " . mysqli_error($conn);
            }
        }
        
        // Redirect to the watchlist page
        header("Location: watchlist.php");
        exit();
    }
?>
