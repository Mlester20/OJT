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

// Handle the form submission to update profile details
if (isset($_POST['update'])) {
    // Get form data and escape it to prevent SQL injection
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    // Update query to update the user's details
    $update_query = "UPDATE admin SET username = '$username', password = '$password' WHERE user_id = '$id'";

    // Check if update is successful
    if (mysqli_query($con, $update_query)) {
        echo "<script>alert('Profile updated successfully.'); window.location.href='profile.php';</script>";
    } else {
        echo "<script>alert('Error updating profile: " . mysqli_error($con) . "');</script>";
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
        <div class="container">
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <h4>Profile Details</h4>
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" 
                                       value="<?php echo isset($row['username']) ? $row['username'] : ''; ?>" 
                                       name="username" placeholder="Username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" 
                                       value="<?php echo isset($row['password']) ? $row['password'] : ''; ?>" 
                                       name="password" placeholder="Password" required>
                            </div>
                            <button type="submit" name="update" class="btn btn-primary mt-3">Update Profile</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
    
</body>
</html>
