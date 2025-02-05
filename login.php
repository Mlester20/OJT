<?php
session_start();
include 'components/config.php';

if(!isset($_POST['login'])){
    header('location: index.php');
}

if (isset($_POST['login'])) {
    $user_unsafe = $_POST['username'];
    $pass_unsafe = $_POST['password'];

    $username = mysqli_real_escape_string($con, $user_unsafe);
    $pass = mysqli_real_escape_string($con, $pass_unsafe);

    $sql = "SELECT * FROM admin WHERE username='$username' AND password='$pass'";
    $res = mysqli_query($con, $sql);

    // If user is found, set session variables and redirect
    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);

        // Store user data in session variables
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['name'] = $row['name'];

        // Redirect to dashboard
        header('location: ./admin/dashboard.php');
        exit(); // Always call exit after a header redirect to stop further execution
    } else {
        // Invalid credentials, show error message
        echo "<script type='text/javascript'>alert('Invalid Username or Password!');
              document.location='index.php'</script>";
    }
}
?>
