<?php
    include("connection.php");
    session_start();
    if (isset($_SESSION['email'])) {
        $uid = $_SESSION['user_id'];
    } 
    else {
        // Redirect the user to the login page if not logged in
        header("Location: dash.php");
        exit();
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add transaction</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../static/style.css">
    <link rel="stylesheet" href="../static/font-awesome/css/font-awesome.min.css">
</head>
<style>
    h1{
        color:rgb(255, 204, 0);
    }
    a:hover{
        color:cyan;
    }
    select,input{
        float:right;
    }
    form{
        color:rgb(78, 211, 255);
    }
</style>
<body>
    <center><h1>Add transaction</h1></center>
    <main class="container my-5" style="width: 50%; height:fit-content; float: center; justify-content: center; text-align: left; margin: 25%; padding: 2.5rem;"><h2>
        <form method="POST" action='add_t.php'>
            Symbol
            <select name="symbol" id="symbol" onchange="getSymbolCurrentPrice()">
                <?php
                    $sql = "SELECT * FROM company";
                    $result = mysqli_query($conn, $sql);
                    if ($result) {
                        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                            $companyName = $row['STOCK_ID'];
                            echo "<option value=\"$companyName\">$companyName</option>";
                        }
                
                        // Free the result set
                        mysqli_free_result($result);
                    } else {
                        echo "Error: " . mysqli_error($conn);
                    }
                
                    // Close the database connection
                    mysqli_close($conn);
                ?>
            </select>
            <br><br>
                Current Price: <span id="currentPrice"></span>
                <script>
    function getSymbolCurrentPrice() {
        var symbol = document.getElementById('symbol').value;

        // Make an AJAX request to get the current price
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'get_current_price.php?symbol=' + symbol, true);

        xhr.onload = function () {
            if (xhr.status == 200) {
                var currentPriceSpan = document.getElementById('currentPrice');
                currentPriceSpan.textContent = xhr.responseText;
                currentPriceSpan.style.color = 'black';
                currentPriceSpan.style.textAlign = 'right';
            } else {
                console.error('Request failed. Status: ' + xhr.status);
            }
        };

        xhr.send();
    }
</script>
            <br><br>
            Quantity 
            <input type='number' name='quantity' />
            <br><br>
            Price <input type="text" name="price" id="price" class="price-input" oninput="this.value = this.value.replace(/[^0-9.]/g, '')" required>
            <br><br>
            <center><input type="submit" id="button2" class="submit" name="sub_t" required></center>
        </form>
    </main>
         <center><h3><a href="#" onclick="window.location.href='dash.php'">Go back!</a></h3></center>
    
</body>
</html>