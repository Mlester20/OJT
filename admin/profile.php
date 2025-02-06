<?php
session_start();
include '../components/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

$id = $_SESSION['user_id'];
$query = mysqli_query($con, "SELECT * FROM admin WHERE user_id = '$id'") or die(mysqli_error($con));

if (mysqli_num_rows($query) > 0) {
    $row = mysqli_fetch_array($query);
} else {
    echo "<script>alert('User not found. Please try logging in again.'); window.location.href='../index.php';</script>";
    exit();
}

// Handle form submission
if (isset($_POST['update'])) {
    // Get input values
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $new_password = mysqli_real_escape_string($con, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($con, $_POST['confirm_password']);

    // Fetch current password from database
    $result = mysqli_query($con, "SELECT password FROM admin WHERE user_id = '$id'");
    $user = mysqli_fetch_assoc($result);

    if (!$user) {
        echo "<script>alert('User not found. Please try logging in again.'); window.location.href='../index.php';</script>";
        exit();
    }

    // Check if entered password matches the stored password (plain text comparison)
    if ($confirm_password !== $user['password']) {
        echo "<script>alert('Incorrect password! Please enter your correct current password.');</script>";
    } else {
        // If a new password is provided, update it
        $password_query = "";
        if (!empty($new_password)) {
            $password_query = ", password = '$new_password'";
        }

        // Update user details
        $update_query = "UPDATE admin SET name = '$name', username = '$username' $password_query WHERE user_id = '$id'";

        if (mysqli_query($con, $update_query)) {
            echo "<script>alert('Profile updated successfully.'); window.location.href='profile.php';</script>";
        } else {
            echo "<script>alert('Error updating profile: " . mysqli_error($con) . "');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Details - <?php include '../components/title.php'; ?> </title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../styles/styles.css">

    

</head>
<body>

    <?php include '../components/header_admin.php'; ?>

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
                                            value="<?php echo isset($row['name']) ? $row['name'] : ''; ?>" 
                                            name="name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control" 
                                            value="<?php echo isset($row['username']) ? $row['username'] : ''; ?>" 
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
    
</body>
</html>