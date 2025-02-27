<?php 
session_start();
include '../components/config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Year Category - <?php include '../components/title.php'; ?> </title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.min.js"></script>
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">
    <link rel="stylesheet" href="../styles/hover.css">
    <link rel="stylesheet" href="../styles/tableDesign.css">
    <style>
        .year-folder {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            margin-top: 50px;
        }
        .year-folder a {
            text-decoration: none;
            color: #000;
            text-align: center;
        }
        .year-folder i {
            font-size: 50px;
            color: #007bff;
        }
        .year-folder span {
            display: block;
            margin-top: 10px;
            font-size: 18px;
        }
        .year-folder a.disabled {
            pointer-events: none;
            color: #ccc;
        }
        .year-folder a.disabled i {
            color: #ccc;
        }
        .indicator {
            text-align: center;
            margin-top: 30px;
            font-size: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    
    <?php include '../components/header_admin.php'; ?> 

    <div class="container my-5">
        <div class="indicator">
            Choose a folder to open all files that are compiled
        </div>
        <div class="year-folder">
            <a href="view_all.php">
                <i class="fas fa-folder"></i>
                <span>2025</span>
            </a>
            <a href="#" class="disabled">
                <i class="fas fa-folder"></i>
                <span>2026</span>
            </a>
            <a href="#" class="disabled">
                <i class="fas fa-folder"></i>
                <span>2027</span>
            </a>
            <a href="#" class="disabled">
                <i class="fas fa-folder"></i>
                <span>2028</span>
            </a>
            <a href="#" class="disabled">
                <i class="fas fa-folder"></i>
                <span>2029</span>
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>