<?php
session_start();
include '../components/config.php';

    if(isset($_POST['save'])){
        $salut = mysqli_real_escape_string($con, $_POST['salut']){
            $query = mysqli_query($con, "INSERT INTO `salut` (salut) VALUES ('$salut')"){
                
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salut - <?php include '../components/title.php'; ?> </title>
    <link rel="stylesheet" href="../styles/styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
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
            <input type="text" name="salut" class="input-field" placeholder="Enter Salut">
            <input type="submit" value="Save Office" name="save" class="submit-button">
        </form>
    </div>
    
</body>
</html>