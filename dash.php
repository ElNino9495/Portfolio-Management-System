<?php
    include("connection.php");
    session_start();
    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
        $sql="select * from user_details where email='$email'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // User found, fetch the data
            $row = $result->fetch_assoc(); // Fetch the first row (assuming one user per email)
            // Now you can access the username
            $username=$row['name'];
            $pan=$row['pan'];
            // Use $username as needed
        } else {
            // User not found
            echo "User not found.";
        }

        // Use the user information to personalize the dashboard
    } else {
        // Redirect the user to the login page if not logged in
        header("Location: login.php");
        exit();
    }
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../static/style.css">
    <link rel="stylesheet" href="../static/font-awesome/css/font-awesome.min.css">

    <title>Portfolio Management System</title>
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@500;700&display=swap');

    .container a {
        color: rgb(255, 255, 255);
        font-family: 'Montserrat', sans-serif;
    }

    .container a:hover {
        color: rgb(141, 218, 248);
        text-transform: uppercase;
        text-decoration: none;    }

    footer.container a {
        color: rgb(224, 224, 224);
    }

    footer.container a:hover {
        color: rgb(0, 255, 234);
    }
</style>

<body>
    <nav class="navbar" style="background-color:rgb(18, 62, 105);">
        <div class="container-fluid">
            <a class="navbar-brand fw-normal" style="color: white" href="#" onclick="window.location.href='about.php'" ><?php echo $username; ?></a>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <div class="mx-2 my-2">

                    <!--Signup Modal -->
                <form method="POST" action='logout.php'>
                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#logoutModal" type="submit"
                        name="logout">Logout</button>
                </form>
        </div>
        </div>
    </nav>

    <div class="container justify-content-center text-center my-3">
        <div class="row g-6">
            <div class="col-6">
            <div class="p-4 border my-3" style="background-color:rgb(22, 90, 158); color:aliceblue;">
            <a href="#" onclick="window.location.href='portfolio.php'">Portfolio</a>
            </div>
            </div>
            <div class="col-6">
                <div class="p-4 border my-3" style="background-color:rgb(22, 90, 158);"><a href="#" onclick="window.location.href='stock_price.php'">All Stock Prices</a></div>
            </div>
            <div class="col-6">
                <div class="p-4 border my-3" style="background-color:rgb(22, 90, 158);"><a
                href="#" onclick="window.location.href='watchlist.php'">Watchlist</a></div>
            </div>
            <div class="col-6">
                <div class="p-4 border my-3" style="background-color:rgb(22, 90, 158);"><a
                        href="#" onclick="window.location.href='transaction.php'">Transactions</a></div>
            </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script> -->

    <!-- Option 2: Separate Popper and Bootstrap JS -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
    <!-- FOOTER -->
    <footer class="container">
        <center><p>&copy; 2023 Portfolio Management System</p>
        <p class="float-center"><a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
        </center>
        
    </footer>
</body>

</html>