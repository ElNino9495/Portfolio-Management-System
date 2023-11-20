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
            $dob=$row['dob'];
            $pass=$row['password'];


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


<style>
* {
    margin: 0;
}

body {
    background-color: #e8f5ff;
    font-family: Arial;
    overflow: hidden;
}

/* NavbarTop */
.navbar-top {
    background-color: #fff;
    color: #333;
    box-shadow: 0px 4px 8px 0px grey;
    height: 70px;
}

.title {
    font-family: 'Dancing Script', cursive;
    padding-top: 15px;
    position: absolute;
    left: 45%;
}

.navbar-top ul {
    float: right;
    list-style-type: none;
    margin: 0;
    overflow: hidden;
    padding: 18px 50px 0 40px;
}

.navbar-top ul li {
    float: left;
}

.navbar-top ul li a {
    color: #333;
    padding: 14px 16px;
    text-align: center;
    text-decoration: none;
}

.icon-count {
    background-color: #ff0000;
    color: #fff;
    float: right;
    font-size: 11px;
    left: -25px;
    padding: 2px;
    position: relative;
}

/* End */

/* Sidenav */
.sidenav {
    background-color: #fff;
    color: #333;
    border-bottom-right-radius: 25px;
    height: 86%;
    left: 0;
    overflow-x: hidden;
    padding-top: 20px;
    position: absolute;
    top: 70px;
    width: 250px;
}

.profile {
    margin-bottom: 20px;
    margin-top: -12px;
    text-align: center;
}

.profile img {
    border-radius: 50%;
    box-shadow: 0px 0px 5px 1px grey;
}

.name {
    font-size: 20px;
    font-weight: bold;
    padding-top: 20px;
}

.job {
    font-size: 16px;
    font-weight: bold;
    padding-top: 10px;
}

.url, hr {
    text-align: center;
}

.url hr {
    margin-left: 20%;
    width: 60%;
}

.url a {
    color: #818181;
    display: block;
    font-size: 20px;
    margin: 10px 0;
    padding: 6px 8px;
    text-decoration: none;
}

.url a:hover, .url .active {
    background-color: #e8f5ff;
    border-radius: 28px;
    color: #000;
    margin-left: 14%;
    width: 65%;
}

/* End */

/* Main */
.main {
    margin-top: 2%;
    margin-left: 29%;
    font-size: 28px;
    padding: 0 10px;
    width: 58%;
}

.main h2 {
    color: #333;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-size: 24px;
    margin-bottom: 10px;
}

.main .card {
    background-color: #fff;
    border-radius: 18px;
    box-shadow: 1px 1px 8px 0 grey;
    height: auto;
    margin-bottom: 20px;
    padding: 20px 0 20px 50px;
}

.main .card table {
    border: none;
    font-size: 16px;
    height: 270px;
    width: 80%;
}

.edit {
    position: absolute;
    color: #e7e7e8;
    right: 14%;
}

.social-media {
    text-align: center;
    width: 90%;
}

.social-media span {
    margin: 0 10px;
}

.fa-facebook:hover {
    color: #4267b3 !important;
}

.fa-twitter:hover {
    color: #1da1f2 !important;
}

.fa-instagram:hover {
    color: #ce2b94 !important;
}

.fa-invision:hover {
    color: #f83263 !important;
}

.fa-github:hover {
    color: #161414 !important;
}

.fa-whatsapp:hover {
    color: #25d366 !important;
}

.fa-snapchat:hover {
    color: #fffb01 !important;
}
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>

    <!-- Custom Css -->
    <link rel="stylesheet" href="style.css">

    <!-- FontAwesome 5 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
</head>
<body>
    <!-- Navbar top -->
    <div class="navbar-top">
        <div class="title">
            <h1 onclick="window.location.href='dash.php'" style="cursor: pointer;">About Page</h1>
        </div>

        <!-- Navbar -->
        <ul>
            <li>
                <a href="#sign-out" onclick="window.location.href='logout.php'">
                    <i class="fa fa-sign-out-alt fa-2x"></i>
                </a>
            </li>
        </ul>
        <!-- End -->
    </div>
    <!-- End -->
    <div class="main">
        <div class="card">
            <div class="card-body">
                <i class="fa fa-pen fa-xs edit"></i>
                <table>
                    <tbody>
                        <tr>
                            <td>User ID</td>
                            <td>:</td>
                                <?php
                                echo "<td>";
                                echo $_SESSION['user_id'];
                                echo "</td>";
                                ?>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td>:</td>
                                <?php
                                echo "<td>";
                                echo $username;
                                echo "</td>";
                                ?>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <?php
                                echo "<td>";
                                echo $email;
                                echo "</td>";
                                ?>
                        </tr>
                        <tr>
                            <td>Pan</td>
                            <td>:</td>
                            <?php
                                echo "<td>";
                                echo $pan;
                                echo "</td>";
                            ?>
                        </tr>
                        <tr>
                            <td>DOB</td>
                            <td>:</td>
                            <?php
                                echo "<td>";
                                echo $dob;
                                echo "</td>";
                            ?>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td>:</td>
                            <?php
                            echo "<td id='passwordField'>";
                            echo $pass;
                            echo "</td>";
                            ?>
                            <td>
                            <button onclick="editPassword()">Edit</button>
                            </td>
                            <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    function editPassword() {
        var passwordField = document.getElementById('passwordField');
        var passwordValue = passwordField.innerHTML;

        // Replace label with input box and save changes button
        passwordField.innerHTML = '<form id="passwordForm">';
        passwordField.innerHTML += '<input type="password" name="newPassword" id="newPassword" value="' + passwordValue + '">';
        passwordField.innerHTML += '<button type="button" onclick="saveChanges()">Save Changes</button>';
        passwordField.innerHTML += '</form>';
    }

    function saveChanges() {
        var newPassword = $('#newPassword').val();

        // AJAX request to save the new password
        $.ajax({
            type: 'POST',
            url: 'save_password.php',
            data: { newPassword: newPassword },
            success: function(response) {
                // Update UI or provide feedback to the user
                var passwordField = document.getElementById('passwordField');
                passwordField.innerHTML = newPassword;
                alert(response); // You can replace this with a more user-friendly notification
            },
            error: function(error) {
                console.log(error);
                alert('Error updating password.');
            }
        });
    }
</script>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        
    </div>
    <!-- End -->
</body>

<footer class="container">
        <center><p>&copy; 2023 Portfolio Management System</p>
        <p class="float-center"><a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
        </center>
        
    </footer>
</html>