<?php
session_start();
include '../components/config.php';

    if(isset($_POST['save'])){
        $office = mysqli_real_escape_string($con, $_POST['office_name']);

        $query = mysqli_query($con, "INSERT INTO `office_name` (office_name) VALUES ('$office')") or die (mysqli_connect());
        if($query){
            echo "<script type='text/javascript'>alert('Office Added Successfully!');
				document.location='manage_office.php'</script>";
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
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">
</head>

<style>
.container {
    margin-top: 30px;
    max-width: 500px;
    margin: 0 auto;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    background-color: #ffffff;
}

.office-form {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.input-field {
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 16px;
}

.submit-button {
    padding: 10px 20px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s;
}

.submit-button:hover {
    background-color: #45a049;
}
</style>

<body>

    <?php include '../components/header_admin.php'; ?>
    
    <div class="container">
        <form action="" method="post" class="office-form">
            <input type="text" name="office_name" class="input-field" placeholder="Enter Office Name...">
            <input type="submit" value="Save Office" name="save" class="submit-button">
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>