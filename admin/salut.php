<?php
session_start();
include '../components/config.php';

if(isset($_POST['save'])){
    $salut = mysqli_real_escape_string($con, $_POST['salut']);
    $query = mysqli_query($con, "INSERT INTO `salut` (salut) VALUES ('$salut')") or die(mysqli_error($con));
    if($query){
        echo "<script>alert('Salut Added Successfully!');document.location='salut.php'</script>";
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
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">
</head>
</head>

<style>
    .header-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .add-office-btn {
        background-color: #28a745;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 4px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .add-office-btn:hover {
        background-color: #218838;
    }

    .pagination .page-link {
        color: #333;
        border-radius: 0;
        margin: 0 2px;
    }

    .pagination .page-item.active .page-link {
        background-color: #198754;
        border-color: #198754;
        color: white;
    }

    .pagination .page-link:hover {
        background-color: #e9ecef;
        color: #198754;
    }

    .pagination .page-item.disabled .page-link {
        color: #6c757d;
    }

    .table {
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }

    .table thead {
        background-color: #f8f9fa;
    }

    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }

    .btn {
        transition: all 0.3s ease;
    }

    .btn:hover {
        transform: translateY(-1px);

        .site-footer {
        background-color: #333;
        color: white;
        padding: 40px 0;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }
    }

</style>

<body>

    <?php include '../components/header_admin.php'; ?>

    <div class="container" style="margin-top: 30px">
        <div class="header-section">
            <h3 class="card-title text-center">Salutation</h3>
            <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#addOfficeModal">
                <i class="fas fa-plus"></i> Add Salut
            </button>
        </div>


        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Salut</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php 
                    $query = mysqli_query($con, "SELECT * FROM salut") or die(mysqli_error($con));
                    if($query){
                        while($row = mysqli_fetch_assoc($query)){
                            echo '
                                <tr>
                                    <th scope="row">'.$row['salut_id'].'</th>
                                </tr>
                                <td>'. $row['salut'] .' </td>
                            ';
                        }
                    }
                ?>
            </tbody>

        </table>

    </div>
    
</body>
</html>