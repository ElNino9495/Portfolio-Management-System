<?php
    include("connection.php");
    session_start();
    if (isset($_SESSION['email'])) {
        $uid = $_SESSION['user_id'];
        $username=$_SESSION['usern'];
        $role=$_SESSION['role'];
        if($role=="admin"){
            header("Location: dash.php");
            exit();
        }
        $sql="select * from portfolio where user_id='$uid'";
        $result = $conn->query($sql);
        if ($result) {
            
        } 
            // Use $username as needed 
        else {
            // User not founds
            echo "User not found.";
        }
        
        // Use the user information to personalize the dashboard
    } 
    else {
        // Redirect the user to the login page if not logged in
        header("Location: login.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../static/style.css">
    <link rel="stylesheet" href="../static/font-awesome/css/font-awesome.min.css">
<style>
    button.btn a{
        color:azure;
    }
</style>

</head>


<body>
    <nav class="navbar navbar-expand-xl navbar-dark" style="background-color:rgb(18, 62, 105);">
        <div class="container-fluid">
            <a class="navbar-brand fw-normal text-center" href="#" onclick="window.location.href='dash.php'"><?php echo $username; ?> Portfolio</a>         
        </div>
        <form method="POST" action='logout.php'>
                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#logoutModal" type="submit"
                        name="logout">Logout</button>
                </form>
    </nav>

    <h1 style="color: rgb(50, 241, 75); text-align: center;">Welcome <?php echo $username; ?> </h1>
    <br><h2 style="color:rgb(252, 209, 19); font-size:x-large ; text-align: center;">Your Holdings
    </h2>
    <button class="btn btn-success float-right" action="add_transaction.php"><a href="add_to_portfolio.php">Add New
            transaction</a></button>
    
    <br>
    <div class="table-responsive justify-content-center float-center">
        <table class="table table-sm">
            <thead>
                <tr>
                    <th scope="col">Stock Symbol</th>
                    <th scope="col">Stock Name</th>
                    <th scope="col">Stock Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total Price</th>
                    <th scope="col">Sell</th>
                </tr>
            </thead>
            <tbody>
            <?php
            if(mysqli_num_rows($result) > 0){
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $row['STOCK_ID'] . "</td>";
                    $stock_id = $row['STOCK_ID'];
                    $sql_stc = "SELECT * FROM company WHERE stock_id = '$stock_id' ";
                    $res_stc = mysqli_query($conn, $sql_stc);
                    if ($res_stc) {
                        $stc_row = mysqli_fetch_assoc($res_stc);
                        echo "<td>" . $stc_row['STOCK_NAME'] . "</td>";
                    } 
                    else {
                        echo "<td>Stock Name Not Found</td>";
                    }
                    $p=$row['buy_price'];
                    $q=$row['quantity'];
                    $t=$p*$q;
                    echo "<td>" . $row['buy_price'] . "</td>";
                    echo "<td>" . $row['quantity'] . "</td>";
                    echo "<td>" . $t . "</td>";
                    echo "<td><button onclick=\"deleteRecord('" . $row['STOCK_ID'] . "')\">Sell</button></td>";
                    echo "</tr>";
                }
            }
            else{
                echo "<tr>";
                echo "<td> No Data Added";
                echo "<td> No Data Added";
                echo "<td> No Data Added";
                echo "<td> No Data Added";
                echo "<td> No Data Added";
                echo "<tr>";
            }
                ?>
            </tbody>
        </table>
    </div>
    <script>
        function deleteRecord(stockId) {
            var stocksToSell = prompt("How many stocks do you want to sell?");

            if (stocksToSell !== null && stocksToSell !== "") {
                var confirmDelete = confirm("Are you sure you want to sell " + stocksToSell + " stocks?");

                if (confirmDelete) {
                    window.location.href = "del_portfolio.php?stock_id=" + stockId + "&stocks_to_sell=" + stocksToSell;
                }
            } else {
                alert("Please enter a valid number of stocks to sell.");
            }
        }
    </script>
    <center>
        <div id="myDivT" style="width:1000px; height:500px;"></div>
    </center>


   
    <footer class="container">
        <center><p>&copy; 2023 Portfolio Management System</p>
        <p class="float-center"><a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
        </center>
        
    </footer>
</body>

</html>