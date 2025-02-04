<?php
session_start();
include '../components/config.php';

    if(isset($_POST['save'])){
        $office = mysqli_real_escape_string($con, $_POST['office_name']);

        $query = mysqli_query($con, "INSERT INTO `office_name` (office_name) VALUES ('$office')") or die (mysqli_connect());
        if($query){
            echo "<script type='text/javascript'>alert('Office Added Successfully!');
				document.location='office_name.php'</script>";
        }else{
            echo "<script type='text/javascript'>alert('Something went wrong!');
				document.location='office_name.php'</script>";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Office - <?php include('../components/title.php'); ?> </title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>

    <?php include '../components/header_admin.php'; ?>
    
    <div class="container mt-10">
        <form action="" method="post">
            <input type="text" name="office_name" placeholder="Enter Office Name...">
            <input type="submit" value="Save Office" name="save">
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>