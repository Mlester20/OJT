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
    $_SESSION['office_address'] = $row['office_address']; // Store office address in session

    $name = $_SESSION['salut'] . ' ' . $_SESSION['member_first'] . ' ' . $_SESSION['member_last'];
    $_SESSION['full_name'] = $name; 

    // Log activity with office address
    $member_id = $row['member_id'];
    $office_id = $row['office_id'];
    $office_address = $row['office_address'];

    $log_query = "INSERT INTO member_activityLog (member_id, office_id, office_address) 
                  VALUES ('$member_id', '$office_id', '$office_address')";
    mysqli_query($con, $log_query);

    if ($row['office_name'] && strtolower($row['office_name']) === 'ccje') {
        header('location: ./ccje/home.php');
    } else if ($row['office_name'] && strtolower($row['office_name']) === 'iict') {
        header('location: ./iict/home.php');
    } else if($row['office_name'] && strtolower(trim($row['office_name'])) === 'planning, management of information and services'){
        header('location: ./admin/dashboard.php');
    }    
    exit();
} else {
    echo "<script type='text/javascript'>alert('Invalid Username or Password!');
          document.location='index.php'</script>";
}
?>