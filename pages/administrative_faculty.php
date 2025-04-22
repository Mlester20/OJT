<?php
session_start();
include '../components/config.php';

    //check if user is not logged in
    if(!isset($_SESSSION['member_id'])){
        header('location: ../index.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php include '../components/title.php'; ?> - Faculty Profile </title>
</head>
<body>
    

    <?php include '../components/header.php'; ?>

    

    <!-- footer -->
     <?php include '../components/footer.php'; ?>

</body>
</html>