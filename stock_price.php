<?php
    include("connection.php");
    session_start();
    
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        //echo $user_id;
        $sql_userid = "SELECT * FROM company_performance group by stock_id";
        $result = mysqli_query($conn, $sql_userid);
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                // while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                //     // Access and display individual data from $row
                //     echo "Other Data: " . $row['STOCK_ID'] . "<br>";
                //     echo "Item Name: " . $row['STOCK_PRICE'] . "<br>";
                // }
            } else {
                header("Location: dash.php"); // Redirect to the index page if no rows found
                exit();
            }
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
                <h2 href="#" style="color: white; cursor: pointer;" onclick="window.location.href='dash.php'">Company Profile</h2>
            </a>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search Symbol..." aria-label="Search">
                
            </form>
        </div>
    </nav>


    <div class="table-responsive justify-content-center float-center">
        <table class="table table-sm">
            <thead>
                <tr>
                    <th scope="col">Symbol</th>
                    <th scope="col">Company Name</th>
                    <th scope="col">Date</th>
                    <th scope="col">Open Price</th>
                    <th scope="col">Close Price</th>
                    <th scope="col">Lowest Price</th>
                    <th scope="col">Highest Price</th>
                    <?php if ($_SESSION['role'] == 'admin') : ?>
                    <!-- Display the "Actions" column only if the user is an admin -->
                    <th scope="col">Actions</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php
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
                    echo "<td>" . $row['DATE'] . "</td>";
                    echo "<td>" . $row['OPEN_PRICE'] . "</td>";
                    echo "<td>" . $row['CLOSE_PRICE'] . "</td>";
                    echo "<td>" . $row['LOWEST_PRICE'] . "</td>";
                    echo "<td>" . $row['HIGHEST_PRICE'] . "</td>";
                    if ($_SESSION['role'] == 'admin') {
                        echo '<td><button class="btn btn-info btn-sm" onclick="editStock(' . 
                            "'" . $row['STOCK_ID'] . "'," . 
                            "'" . $row['OPEN_PRICE'] . "'," . 
                            "'" . $row['CLOSE_PRICE'] . "'," . 
                            "'" . $row['LOWEST_PRICE'] . "'," . 
                            "'" . $row['HIGHEST_PRICE'] . "'" . 
                            ')">Edit</button></td>';
                    }
                    echo "</tr>";
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
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


<script>
    // Function to prompt for values and perform the edit
    function editStock(stockId, openPrice, closePrice, lowestPrice, highestPrice) {
        const newOpenPrice = prompt('Enter new Open Price:', openPrice);
        const newClosePrice = prompt('Enter new Close Price:', closePrice);
        const newLowestPrice = prompt('Enter new Lowest Price:', lowestPrice);
        const newHighestPrice = prompt('Enter new Highest Price:', highestPrice);

        if (newOpenPrice !== null && newClosePrice !== null && newLowestPrice !== null && newHighestPrice !== null) {
            // Use AJAX to send the values to a PHP script for processing
            $.ajax({
                url: 'update_stock.php',
                type: 'POST',
                data: {
                    stockId: stockId,
                    newOpenPrice: newOpenPrice,
                    newClosePrice: newClosePrice,
                    newLowestPrice: newLowestPrice,
                    newHighestPrice: newHighestPrice
                },
                success: function (response) {
                    console.log('Update successful');
                    // Redirect back to the stock page
                    window.location.href = 'stock_price.php';
                },
                error: function () {
                    console.log('Update failed');
                }
            });
        } else {
            console.log('Editing canceled');
        }
    }
</script>
    
<footer class="container">
        <center><p>&copy; 2023 Portfolio Management System</p>
        <p class="float-center"><a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
        </center>
        
</footer>
</body>

</html>