<?php
    include("connection.php");
    session_start();
    
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $role=$_SESSION['role'];
        if($role=="admin"){
            header("Location: dash.php");
            exit();
        }
        //echo $user_id;
        $sql_userid = "SELECT * FROM transaction where user_id_purchased='$user_id' or user_id_bought='$user_id' ";
        $result = mysqli_query($conn, $sql_userid);
        if ($result) {
            // if (mysqli_num_rows($result) > 0) {
            //     // while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            //     //     // Access and display individual data from $row
            //     //     echo "Other Data: " . $row['STOCK_ID'] . "<br>";
            //     //     echo "Item Name: " . $row['STOCK_PRICE'] . "<br>";
            //     // }
            // } else {
            //     header("Location: dash.php"); // Redirect to the index page if no rows found
            //     exit();
            // }
        } else {
            // Handle database query error
            echo "Error: " . mysqli_error($conn);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Profile</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../static/style.css">
    <link rel="stylesheet" href="../static/font-awesome/css/font-awesome.min.css">
</head>

<body>

    <nav class="navbar" style="background-color:rgb(18, 62, 105);">
        <div class="container-fluid">
            <a class="navbar-brand">
                <h2 href="#" style="color: white; cursor: pointer;" onclick="window.location.href='dash.php'">Transactions</h2>
            </a>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search Symbol..." aria-label="Search">
                
            </form>
        </div>
    </nav>

    <button class="btn btn-danger float-right"><a style="color: black" href="#" onclick="window.location.href='make_transac.php'">+ Add New</a></button>
    <div class="table-responsive justify-content-center float-center">
        <table class="table table-sm">
            <thead>
                <tr>
                    <th scope="col">Transaction ID</th>
                    <th scope="col">Stock ID</th>
                    <th scope="col">Date of Purchase</th>
                    <th scope="col">Purchased By</th>
                    <th scope="col">Sold by</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Total Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(mysqli_num_rows($result) > 0){
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        echo "<tr>";
                        echo "<td>" . $row['TRANSACTION_ID'] . "</td>";
                        echo "<td>" . $row['STOCK_ID'] . "</td>";
                        echo "<td>" . $row['DATE_OF_PURCHASE'] . "</td>";
                        echo "<td>" . $row['USER_ID_PURCHASED'] . "</td>";
                        echo "<td>" . $row['USER_ID_BOUGHT'] . "</td>";
                        echo "<td>" . $row['QUANTITY'] . "</td>";
                        echo "<td>" . $row['PRICE'] . "</td>";
                        $q=$row['QUANTITY'];
                        $p=$row['PRICE'];
                        $t=$p*$q;
                        echo "<td>" . $t . "</td>";
                        echo "</tr>";
                    }
                }
                else{
                    echo "<tr>";
                    echo "<td>No Transactions Made</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
   <!--js-->
   <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
   integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
   crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
   integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
   crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
   integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
   crossorigin="anonymous"></script>
<script>
   $(document).ready(function () {
       $(".form-control").on("keyup", function () {
           var value = $(this).val().toLowerCase();
           $(".table tbody tr").filter(function () {
               $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
           });
       });
   });
</script>
<footer class="container">
        <center><p>&copy; 2023 Portfolio Management System</p>
        <p class="float-center"><a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
        </center>
        
    </footer>

</body>

</html>