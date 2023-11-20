<?php
    include("connection.php");
    session_start();
    if(isset($_POST["signin"])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = "select * from user_details where email = '$email' and password = '$password'";
        $result = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($result);

        if ($count == 1) {
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            echo "id: " . $row["user_id"] . " - Name: " . $row["name"] . "<br>";
            $_SESSION['email']=$email;
            $_SESSION['user_id']=$row["user_id"];
            $_SESSION['usern']=$row['name'];
            $_SESSION['role']=$row['role'];
            header("Location: dash.php"); // Redirect to the index page
            exit();
        }
        else {
            echo("Incorrect Password");
            header("Location: index.php"); // Redirect to the index page
            exit();
        }
    }
?>
