<?php
session_start();
include '../components/config.php';

    if(isset($_POST['save'])){
        $office = mysqli_real_escape_string($con, $_POST['office_name']);

        $query = mysqli_query($con, "INSERT INTO `office_name` (office_name) VALUES ('$office')") or die (mysqli_connect());
        if($query){
            echo "<script type='text/javascript'>alert('Office Added Successfully!');
				document.location='./admin/dashboard.php'</script>";
        }else{
            echo "<script type='text/javascript'>alert('Something went wrong!');
				document.location='office_name.php'</script>";
        }
    }

?>