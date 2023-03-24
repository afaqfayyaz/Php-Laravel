<?php
    session_start();
    include('dbcon.php');
    if (isset($_POST['login'])) {
        $username = $_POST['name'];
        $password = $_POST['password'];
        $query = "SELECT * FROM users WHERE name='$username'";
       
        $result = mysqli_query($con, $query);
        $user=mysqli_fetch_assoc($result);
        // echo "<pre>";
        // print_r($user);
        // die();
        if (!$result) {
            echo 'Username password combination is wrong!';
        } else {
            if ($password==$user['password']) 
            {
                $_SESSION['user_id'] = $user['id'];
                echo '<p class="success">Congratulations, you are logged in!</p>';
                header("location: index.php");
            } else {
                echo '<p class="error">Username password combination is wrong!</p>';
            }
        }
    }
?>