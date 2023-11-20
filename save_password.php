<?php
    // save_password.php

    include("connection.php"); // Make sure to include your database connection file

    session_start();

    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Validate and sanitize the new password
            $newPassword = isset($_POST['newPassword']) ? htmlspecialchars($_POST['newPassword']) : '';

            // Update the password in the database
            $sql = "UPDATE user_details SET password = '$newPassword' WHERE email = '$email'";
            
            if ($conn->query($sql) === TRUE) {
                echo "Password updated successfully";
            } else {
                echo "Error updating password: " . $conn->error;
            }
        } else {
            echo "Invalid request method";
        }
    } else {
        // Redirect the user to the login page if not logged in
        header("Location: about.php");
        exit();
    }
?>
