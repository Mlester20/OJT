<?php
session_start();
include '../components/config.php';

// Ensure the user is logged in
if (!isset($_SESSION['member_id'])) {
    header('location: ../index.php');
    exit();
}

$member_id = $_SESSION['member_id'];
$full_name = $_SESSION['full_name']; // Mr. Carlito Antolin
$username = '';

// Fetch user details
$sql = "SELECT m.*, s.salut_name 
        FROM member m
        LEFT JOIN salut s ON m.salut_id = s.salut_id
        WHERE m.member_id = '$member_id'";
$result = mysqli_query($con, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $username = $row['username'];
    $full_name = $row['salut_name'] . " " . $row['member_first'] . " " . $row['member_last']; 
}

// Handle profile update
if (isset($_POST['update'])) {
    $new_name = mysqli_real_escape_string($con, $_POST['name']);
    $new_username = mysqli_real_escape_string($con, $_POST['username']);
    $new_password = mysqli_real_escape_string($con, $_POST['password']);
    $current_password = mysqli_real_escape_string($con, $_POST['confirm_password']);

    // Verify current password
    $check_pass = "SELECT password FROM member WHERE member_id = '$member_id'";
    $pass_result = mysqli_query($con, $check_pass);
    $pass_row = mysqli_fetch_assoc($pass_result);

    if ($pass_row['password'] !== $current_password) {
        echo "<script>alert('Incorrect current password!'); window.location='profile.php';</script>";
        exit();
    }

    // Update query
    if (!empty($new_password)) {
        $update_sql = "UPDATE member SET member_first='$new_name', username='$new_username', password='$new_password' WHERE member_id='$member_id'";
    } else {
        $update_sql = "UPDATE member SET member_first='$new_name', username='$new_username' WHERE member_id='$member_id'";
    }

    if (mysqli_query($con, $update_sql)) {
        $_SESSION['full_name'] = $new_name; // Update session name
        echo "<script>alert('Profile updated successfully!'); window.location='profile.php';</script>";
    } else {
        echo "<script>alert('Error updating profile!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Details - <?php include '../components/title.php'; ?></title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../styles/styles.css">
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../styles/user_header.css">
</head>
<body>
    
    <?php include '../components/header.php'; ?>

    <div class="content-wrapper">
        <div class="container py-5">
            <section class="content">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h4 class="text-center mb-4">Profile Details</h4>
                                <form action="" method="post">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Full Name</label>
                                        <input type="text" class="form-control" 
                                            value="<?php echo htmlspecialchars($full_name); ?>" 
                                            name="name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control" 
                                            value="<?php echo htmlspecialchars($username); ?>" 
                                            name="username" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">New Password (Optional)</label>
                                        <input type="password" class="form-control" 
                                            name="password" placeholder="Enter new password (leave blank to keep current)">
                                    </div>
                                    <div class="mb-3">
                                        <label for="confirm_password" class="form-label">Enter Current Password</label>
                                        <input type="password" class="form-control" name="confirm_password" placeholder="Enter your current password" required>
                                    </div>
                                    <button type="submit" name="update" class="btn btn-primary w-100 mt-3">Update Profile</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
