<?php
    include("connection.php");
    session_start();
    
    if (isset($_POST["sub_tt"])) {
        $sym = $_POST['symbol'];
        $quantit = $_POST['quantity'];
        $price = $_POST['price'];
        $uid = $_SESSION['user_id'];
        $uid2 = $_POST['uid'];
        
        $tdate = $_POST['transaction_date'];
        $tdate = $_POST['transaction_date'];
        $fd = date('Y-m-d', strtotime($tdate));
        $type = $_POST['type'];
        //echo $type;
        //echo "gotten";
        // Check if the type is "bought" or "sold"
        if ($type == 'bought') {
            $sql_q = "INSERT INTO TRANSACTION (DATE_OF_PURCHASE, USER_ID_PURCHASED, STOCK_ID, PRICE, QUANTITY, USER_ID_BOUGHT)
            VALUES ('$fd', '$uid', '$sym', '$price', '$quantit', '$uid2');";
        } else {
            $sql_q = "INSERT INTO TRANSACTION (DATE_OF_PURCHASE, USER_ID_PURCHASED, STOCK_ID, PRICE, QUANTITY, USER_ID_BOUGHT)
            VALUES ('$fd', '$uid2', '$sym', '$price', '$quantit', '$uid');";
        }

        if (mysqli_query($conn, $sql_q)) {
            echo "Added successfully!";
        } else {
            echo "Error inserting record: " . mysqli_error($conn);
        }


        if ($type == 'bought') {
            $sql_q = "INSERT INTO portfolio (user_id, quantity, buy_price, stock_id)
            VALUES ('$uid', '$quantit', '$price', '$sym')
            ON DUPLICATE KEY UPDATE
            quantity = quantity + VALUES(quantity),
            buy_price = VALUES(buy_price);";
        } else {
            $sql_q = "INSERT INTO portfolio (user_id, quantity, buy_price, stock_id)
            VALUES ('$uid2', '$quantit', '$price', '$sym')
            ON DUPLICATE KEY UPDATE
            quantity = quantity + VALUES(quantity),
            buy_price = VALUES(buy_price);";
        }

        if (mysqli_query($conn, $sql_q)) {
            echo "Added successfully!";
        } else {
            echo "Error inserting record: " . mysqli_error($conn);
        }
        
        // Redirect to the transaction page
        header("Location: transaction.php");
        exit();
    }
?>
