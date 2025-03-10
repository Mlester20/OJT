<?php
include './components/config.php';

if(isset($_POST['submit'])) {
    $first_name = mysqli_real_escape_string($con, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($con, $_POST['last_name']);
    $gender = mysqli_real_escape_string($con, $_POST['gender']);
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $office_id = mysqli_real_escape_string($con, $_POST['office_id']);
    $salut_id = mysqli_real_escape_string($con, $_POST['salut_id']);
    $rank_id = mysqli_real_escape_string($con, $_POST['rank_id']);
    $designation_id = mysqli_real_escape_string($con, $_POST['designation_id']);

    $query = mysqli_query($con, "INSERT INTO member (member_first, member_last, member_gender, username, password, 
              office_id, salut_id, rank_id, designation_id, role) 
              VALUES ('$first_name', '$last_name', '$gender', '$username', '$password', 
              '$office_id', '$salut_id', '$rank_id', '$designation_id', 'user')") or die (mysqli_connect($con));
    if($query){
        echo "<script>alert('Registered Successfully!');document.location='index.php'</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create an Account - <?php include 'components/title.php'; ?> </title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
    <link rel="stylesheet" href="styles/registerstyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

    <div class="header">
        <div class="logo">
            <img src="images/logo.png" alt="ISU-R Logo" class="img-responsive img-circle"
                style="max-height: 50px; display: inline-block; vertical-align: middle;">
            <p class="h4" style="display: inline-block; vertical-align: middle; margin-left: 10px;">Planning, Management of Information and Services, Gender and Development</p>
        </div>
        <div class="date hidden-xs hidden-sm">
            <!-- Hide date/time on small screens -->
            <p id="currentDate" class="h5">Today is: </p>
        </div>
    </div>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-body p-4">
                        <h2 class="text-center mb-4 text-muted card-title">Register Account</h2>
                        
                        <form action="" method="POST">
                            <!-- Name Section -->
                            <div class="row mb-4">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <label class="form-label fw-semibold">First Name</label>
                                    <input type="text" name="first_name" class="form-control form-control-lg" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Last Name</label>
                                    <input type="text" name="last_name" class="form-control form-control-lg" required>
                                </div>
                            </div>

                            <!-- Gender and Office Section -->
                            <div class="row mb-4">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <label class="form-label fw-semibold">Gender</label>
                                    <select name="gender" class="form-select form-select-lg" required>
                                        <option value="">Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Office</label>
                                    <select name="office_id" class="form-select form-select-lg" required>
                                        <option value="">Select Office</option>
                                        <?php
                                        $query = "SELECT * FROM office_name ORDER BY office_name";
                                        $result = mysqli_query($con, $query);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<option value='".$row['office_id']."'>".$row['office_name']."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <!-- Details Section -->
                            <div class="row mb-4">
                                <div class="col-md-4 mb-3 mb-md-0">
                                    <label class="form-label fw-semibold">Salutation</label>
                                    <select name="salut_id" class="form-select form-select-lg" required>
                                        <option value="">Salutation</option>
                                        <?php
                                        $query = "SELECT * FROM salut ORDER BY salut_id";
                                        $result = mysqli_query($con, $query);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<option value='".$row['salut_id']."'>".$row['salut']."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3 mb-md-0">
                                    <label class="form-label fw-semibold">Rank</label>
                                    <select name="rank_id" class="form-select form-select-lg" required>
                                        <option value="">Rank</option>
                                        <?php
                                        $query = "SELECT * FROM `rank` ORDER BY rank_id";
                                        $result = mysqli_query($con, $query);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<option value='".$row['rank_id']."'>".$row['rank']."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Designation</label>
                                    <select name="designation_id" class="form-select form-select-lg" required>
                                        <option value="">Designation</option>
                                        <?php
                                        $query = "SELECT * FROM designation ORDER BY designation_id";
                                        $result = mysqli_query($con, $query);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<option value='".$row['designation_id']."'>".$row['designation_name']."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <!-- Login Details Section -->
                            <div class="row mb-4">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <label class="form-label fw-semibold">Username</label>
                                    <input type="text" name="username" class="form-control form-control-lg" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Password</label>
                                    <input type="password" name="password" class="form-control form-control-lg" required>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="row">
                                <div class="col-6">
                                    <a href="index.php" class="text-decoration-none" style = "font-size: 1.5rem;">Already have an account? Login</a>
                                </div>
                                <div class="col-6 text-end">
                                    <button type="submit" name="submit" class="btn btn-primary btn-lg px-5">Register</button>
                                </div>
                             </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



        <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
        <script src="plugins/fastclick/fastclick.min.js"></script>
        <script src="dist/js/app.min.js"></script>
        <script src="dist/js/demo.js"></script>
        <script>
        document.addEventListener("DOMContentLoaded", function() {
            function updateDateTime() {
                var today = new Date();
                var options = {
                    timeZone: 'Asia/Manila',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    weekday: 'long',
                    hour: 'numeric',
                    minute: 'numeric',
                    second: 'numeric',
                    hour12: true
                };
                var dateTime = today.toLocaleString('en-US', options);
                document.getElementById('currentDate').textContent = "Today is: " + dateTime;
            }

            // Update date and time every second
            setInterval(updateDateTime, 1000);
        });
        </script>
    
</body>
</html>