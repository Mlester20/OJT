<?php
session_start();
include 'components/config.php';

if (!isset($_POST['login'])) {
    header('location: index.php');
    exit();
}

$user_unsafe = $_POST['username'];
$pass_unsafe = $_POST['password'];

$username = mysqli_real_escape_string($con, $user_unsafe);
$pass = mysqli_real_escape_string($con, $pass_unsafe);

// Check if the account is suspended
$suspend_check_query = "SELECT failed_attempts, last_failed_attempt, is_suspended FROM member WHERE username='$username'";
$suspend_check_res = mysqli_query($con, $suspend_check_query);

if ($suspend_check_res && mysqli_num_rows($suspend_check_res) > 0) {
    $suspend_check_row = mysqli_fetch_assoc($suspend_check_res);
    $failed_attempts = $suspend_check_row['failed_attempts'];
    $last_failed_attempt = $suspend_check_row['last_failed_attempt'];
    $is_suspended = $suspend_check_row['is_suspended'];

    // Check if the account is suspended
    if ($is_suspended) {
        echo "<script type='text/javascript'>alert('Your account was suspended. Please contact the admin to take action.');
              document.location='index.php'</script>";
        exit();
    }

    // Check if the account should be suspended
    if ($failed_attempts >= 3 && strtotime($last_failed_attempt) > strtotime('-15 minutes')) {
        $suspend_account_query = "UPDATE member SET is_suspended = TRUE WHERE username = '$username'";
        mysqli_query($con, $suspend_account_query);
        echo "<script type='text/javascript'>alert('Your account was suspended due to multiple failed login attempts. Please contact the admin to take action.');
              document.location='index.php'</script>";
        exit();
    }
}

$sql = "SELECT m.*, o.office_name, o.office_address, s.salut 
        FROM member m
        LEFT JOIN office_name o ON m.office_id = o.office_id
        LEFT JOIN salut s ON m.salut_id = s.salut_id
        WHERE m.username='$username' AND m.password='$pass'";

$res = mysqli_query($con, $sql);

if (!$res) {
    die("Query failed: " . mysqli_error($con));
}

if (mysqli_num_rows($res) > 0) {
    $row = mysqli_fetch_assoc($res);

    $_SESSION['member_id'] = $row['member_id'];
    $_SESSION['member_first'] = $row['member_first'];
    $_SESSION['member_last'] = $row['member_last'];
    $_SESSION['salut'] = $row['salut']; 
    $_SESSION['office_id'] = $row['office_id'];
    $_SESSION['office_name'] = $row['office_name'];
    $_SESSION['office_address'] = $row['office_address'];

    $name = $_SESSION['salut'] . ' ' . $_SESSION['member_first'] . ' ' . $_SESSION['member_last'];
    $_SESSION['full_name'] = $name; 

    // Log activity with office address
    $member_id = $row['member_id'];
    $office_id = $row['office_id'];
    $office_address = $row['office_address'];

    $log_query = "INSERT INTO member_activityLog (member_id, office_id, office_address) 
                  VALUES ('$member_id', '$office_id', '$office_address')";
    mysqli_query($con, $log_query);

    // Reset failed attempts on successful login
    $reset_attempts_query = "UPDATE member SET failed_attempts = 0, last_failed_attempt = NULL WHERE member_id = '$member_id'";
    mysqli_query($con, $reset_attempts_query);

    if ($row['office_name'] && strtolower(trim($row['office_name'])) === 'planning, management of information and services') {
        header('location: ./admin/dashboard.php');
    } else {
        header('location: ./pages/home.php');
    }    
    exit();
} else {
    // Increment failed attempts on unsuccessful login
    $update_attempts_query = "UPDATE member SET failed_attempts = failed_attempts + 1, last_failed_attempt = NOW() WHERE username = '$username'";
    mysqli_query($con, $update_attempts_query);

    echo "<script type='text/javascript'>alert('Invalid Username or Password!');
          document.location='index.php'</script>";
}
?>