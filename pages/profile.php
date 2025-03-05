<?php
session_start();
include '../components/config.php';

// Ensure the user is logged in
if (!isset($_SESSION['member_id'])) {
    header('location: ../index.php');
    exit();
}

$member_id = $_SESSION['member_id'];

// Fetch user details
$sql = "SELECT m.*, s.salut 
        FROM member m
        LEFT JOIN salut s ON m.salut_id = s.salut_id
        WHERE m.member_id = '$member_id'";
$result = mysqli_query($con, $sql);

if (!$result) {
    die("Query Error: " . mysqli_error($con)); // Debugging
}

$row = mysqli_fetch_assoc($result);

if (!$row) {
    die("No user found with ID: " . $member_id);
}

$username = $row['username'];
$member_first = $row['member_first'];
$member_last = $row['member_last'];
$full_name = $row['salut'] . " " . $member_first . " " . $member_last;

// Handle profile update
if (isset($_POST['update'])) {
    $new_first = mysqli_real_escape_string($con, $_POST['member_first']);
    $new_last = mysqli_real_escape_string($con, $_POST['member_last']);
    $new_username = mysqli_real_escape_string($con, $_POST['username']);
    $new_password = mysqli_real_escape_string($con, $_POST['password']);
    $current_password = mysqli_real_escape_string($con, $_POST['confirm_password']);

    // Verify current password
    $check_pass = "SELECT password FROM member WHERE member_id = '$member_id'";
    $pass_result = mysqli_query($con, $check_pass);
    $pass_row = mysqli_fetch_assoc($pass_result);

    if (!$pass_row || $pass_row['password'] !== $current_password) {
        echo "<script>alert('Incorrect current password!'); window.location='profile.php';</script>";
        exit();
    }

    // Update fields only if they are not empty
    $update_fields = [];
    if (!empty($new_first)) {
        $update_fields[] = "member_first='$new_first'";
    }
    if (!empty($new_last)) {
        $update_fields[] = "member_last='$new_last'";
    }
    if (!empty($new_username)) {
        $update_fields[] = "username='$new_username'";
    }
    if (!empty($new_password)) {
        $update_fields[] = "password='$new_password'";
    }

    if (!empty($update_fields)) {
        $update_sql = "UPDATE member SET " . implode(', ', $update_fields) . " WHERE member_id='$member_id'";
        if (mysqli_query($con, $update_sql)) {
            $_SESSION['full_name'] = $new_first . " " . $new_last; // Update session name
            echo "<script>alert('Profile updated successfully!'); window.location='profile.php';</script>";
        } else {
            echo "<script>alert('Error updating profile!');</script>";
        }
    } else {
        echo "<script>alert('No changes detected.'); window.location='profile.php';</script>";
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
                                        <label for="member_first" class="form-label">First Name</label>
                                        <input type="text" class="form-control" 
                                            value="<?php echo htmlspecialchars($member_first); ?>" 
                                            name="member_first">
                                    </div>
                                    <div class="mb-3">
                                        <label for="member_last" class="form-label">Last Name</label>
                                        <input type="text" class="form-control" 
                                            value="<?php echo htmlspecialchars($member_last); ?>" 
                                            name="member_last">
                                    </div>
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control" 
                                            value="<?php echo htmlspecialchars($username); ?>" 
                                            name="username">
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
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <button type="submit" name="update" class="btn btn-primary text-sm w-100 mt-3"><a href="home.php" class="nav-link text-center">Cancel</a></button>
                                            </div>
                                            <div class="col-md-4">
                                                <button type="submit" name="update" class="btn btn-primary text-sm w-100 mt-3">Update Profile</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>  
            </section>
        </div>
    </div>

    <?php include '../components/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
