<?php
session_start();
include '../components/config.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Home -  <?php include '../components/title.php'; ?></title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../styles/styles.css">
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../styles/user_header.css">
<style>
/* Para sa main dropdown */
.dropdown-item-hover {
  position: relative;
}

.dropdown-submenu {
  position: absolute;
  left: -150px;
  top: 0;
  background: white;
  border: 1px solid #ccc;
  list-style: none;
  padding: 10px 0;
  display: none;
  min-width: 150px;
}

.dropdown-submenu li {
  padding: 5px 15px;
}

.dropdown-submenu li a {
  text-decoration: none;
  color: black;
  display: block;
}

.dropdown-submenu li a:hover {
  background: #f1f1f1;
}

.dropdown-item-hover:hover > .dropdown-submenu {
  display: block;
}

.sub-left {
  position: absolute;
  left: -100%; 
  top: 0;
}

</style>

</head>
<body>
    
    <?php include '../components/header.php'; ?>

    <div class="container">
        <h3 class="card-title text-center text-muted" style="margin-top: 3rem;">Hello End User</h3>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>