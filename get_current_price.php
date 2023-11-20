<?php
// get_current_price.php
    include("connection.php");
    session_start();
    
// Include your database connection code here

if (isset($_GET['symbol'])) {
    $symbol = $_GET['symbol'];

    // Modify the query to get the current price based on the selected symbol
    $sql = "SELECT stock_price FROM company WHERE STOCK_ID = '$symbol'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        echo $row['stock_price'];
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Symbol not provided.";
}

// Close the database connection if needed
mysqli_close($conn);
?>
