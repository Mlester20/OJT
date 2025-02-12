<?php
session_start();
include 'components/config.php';

if (!isset($_POST['login'])) {
    header('location: index.php');
    exit();
}

if (isset($_POST['login'])) {
    $user_unsafe = $_POST['username'];
    $pass_unsafe = $_POST['password'];

    $username = mysqli_real_escape_string($con, $user_unsafe);
    $pass = mysqli_real_escape_string($con, $pass_unsafe);

    // Hanapin ang admin
    $sql = "SELECT * FROM admin WHERE username='$username' AND password='$pass'";
    $res = mysqli_query($con, $sql);

    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);

        // Store user data in session
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['name'] = $row['name'];

        // **Log activity** (Admin Logged in)
        $user_id = $row['user_id'];
        $log_query = "INSERT INTO activity_log (user_id, action) VALUES ('$user_id', 'Admin Logged in')";
        mysqli_query($con, $log_query);

        header('location: ./admin/dashboard.php');
        exit();
    } else {
        echo "<script type='text/javascript'>alert('Invalid Username or Password!');
              document.location='index.php'</script>";
    }
}
?>