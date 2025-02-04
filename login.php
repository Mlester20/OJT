<?php
session_start();
include 'components/config.php';

    if(isset($_POST['login'])){
        $user_unsafe = $_POST['username'];
        $pass_unsafe = $_POST['password'];

        $username = mysqli_real_escape_string($con, $user_unsafe);
        $pass = mysqli_real_escape_string($con, $pass_unsafe);

        $sql = "SELECT * FROM admin WHERE username='$username' AND password = '$pass'";
        $res = mysqli_query($con, $sql);

        if(mysqli_num_rows($res) > 0){
            $row = mysqli_fetch_assoc($res);
            $_SESSION = $row['user_id'];
            $_SESSION = $row['name'];
            header('location: ./admin/dashboard.php');
        }else{
            echo "<script type='text/javascript'>alert('Invalid Username or Password!');
				document.location='index.php'</script>";
        }
    }

?>