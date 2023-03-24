<?php
    session_start();
    include('dbcon.php');

    if (isset($_POST['register'])) {
        $username = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];     

        $query = "INSERT INTO users(name,password,email) VALUES ('$username','$password','$email')";
        $result =mysqli_query($con, $query);

        if ($result) {
            echo 'Your registration was successful!';
            header("Location: login.php");
        } else {
            echo 'Something went wrong!';
        }
        }
?>