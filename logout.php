<?php

session_start();

if (isset($_POST["logout"])) {
    // Unset or destroy the user session
    session_unset(); // This removes all session variables
    session_destroy(); // This destroys the session
    header("Location: index.php"); // Redirect to the login page or any other page
    exit();
}
else{
    session_unset(); // This removes all session variables
    session_destroy(); // This destroys the session
    header("Location: index.php"); // Redirect to the login page or any other page
    exit();
}
?>