<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login - <?php include('components/title.php'); ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
    <link rel="stylesheet" href="../styles/hover.css">
    <style>
        body {
            background: #eee;
            margin: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-image: url('images/1.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .header {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background: #02C39A;
            /* Teal color for the header */
            color: white;
            font-size: 18px;
            position: fixed;
            top: 0;
            box-shadow: 0 4px 4px -2px rgba(0, 0, 0, 0.2);
            /* Add shadow to the bottom of the header */
            z-index: 1000;
        }

        .login-box {
            background: rgba(255, 255, 255, 0.9);
            /* Slightly transparent white background */
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 20px;
            margin-top: 80px;
            /* Add margin to ensure it doesn't overlap with the header */
        }

        /* Additional styles for responsiveness */
        @media (max-width: 767px) {
            .header .date {
                display: none;
                /* Hide date/time on small screens */
            }

            .header .logo {
                display: flex;
                /* Keep logo and title visible on mobile */
            }
        }
    </style>
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

    <div class="login-box">
        <div class="login-logo d-flex justify-content-center mb-3">
            <img src="images/isu-logo.png" alt="Image 1" class="rounded-circle" style="width: 70px; height: 70px; margin-right: 10px;">
            <img src="images/pilipinas.png" alt="Image 2" class="rounded-circle" style="width: 70px; height: 70px; margin-right: 10px;">
            <img src="images/logo.png" alt="Image 3" class="rounded-circle" style="width: 70px; height: 70px;">
            <h3 class="card-title text-muted ms-3 text-center">PMISGAD System</h3>
        </div>
        <div class="login-box-body">
            <p class="login-box-msg card-title">Sign in to start your session</p>
            <form action="login.php" method="post">

                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="Username" name="username">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Password" name="password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                
                <div class="row">
                    <div class="col-xs-6 pull-right">
                        <button type="submit" class="btn btn-primary btn-block btn-flat" name="login">Sign In</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-8 pull-left">
                        <a href="register.php" class="nav-link" style="margin-top: 2rem;">Click here to register an Account</a>
                    </div>
                </div>
            </form>
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