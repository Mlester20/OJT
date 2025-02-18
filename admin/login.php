<?php
session_start();
include '../components/config.php';
if (!isset($_POST['login'])) {
    header('location: index.php');
    exit();
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM admin WHERE username = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if ($row = mysqli_fetch_assoc($result)) {
        if ($password === $row['password']) {  
            // Set session variables
            $_SESSION['user_id'] = $row['user_id'];  
            $_SESSION['name'] = $row['name'];
            
            $log_sql = "INSERT INTO activity_log (user_id, action) VALUES (?, ?)";
            $log_stmt = mysqli_prepare($con, $log_sql);
            $action = 'Admin Logged in';
            mysqli_stmt_bind_param($log_stmt, "is", $row['user_id'], $action);
            mysqli_stmt_execute($log_stmt);
            
            header('location: dashboard.php');
            exit();
        }
    }
    
    echo "<script>
        alert('Invalid Username or Password!');
        window.location.href = 'index.php';
    </script>";
    exit();
}
?>