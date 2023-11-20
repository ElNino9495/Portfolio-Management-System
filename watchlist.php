
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
        $sql_userid = "SELECT * FROM watchlist WHERE user_id = '$user_id'";
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
    <title>Watchlist</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../static/style.css">
    <link rel="stylesheet" href="../static/font-awesome/css/font-awesome.min.css">
</head>

<body>
    <nav class= "navbar" style="background-color:rgb(18, 62, 105);">
        <div class="container-fluid">
            <a class="navbar-brand" href="#" onclick="window.location.href='dash.php'">
                Watchlist
            </a>
            
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search Symbol..." aria-label="Search">
                
            
            </form>
            
        </div>
    </nav>
<br>
    <button class="btn btn-danger float-right"><a style="color: black;" href="#" onclick="window.location.href='add_to_watch.php'">+ Add New</a></button>
    <div class="table-responsive justify-content-center float-center">
        <table class="table table-sm">
            <thead>
                <tr>
                    <th scope="col">Symbol</th>
                    <th scope="col">Company Name</th>
                    <th scope="col">Currenct Price</th>
                    <th scope="col">Action</th>
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
                        echo "<td>" . $row['STOCK_PRICE'] . "</td>";
                        echo "<td><button onclick=\"deleteRecord('" . $row['STOCK_ID'] . "')\">Delete</button></td>";
                        echo "</tr>";
                    }
                }
                else{
                    echo "<tr>";
                    echo "<td>No Data Added<td>";
                    echo "<td>No Data Added<td>";
                    echo "</tr>";
                }
                
                ?>
            </tbody>
        </table>
    </div>
    <script>
    function deleteRecord(stockId) {
        window.location.href = "del_watch.php?stock_id=" + stockId;
    }
</script>

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
