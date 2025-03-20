<?php
session_start();
include '../components/config.php';

    if(!isset($_SESSION['member_id'])){
        header('location: ../index.php');
    }    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students with a Disability - <?php include '../components/title.php'; ?> </title>
    <link rel="stylesheet" href="../styles/styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../styles/darkLight.css">
    <script src="../js/darkLight.js"></script>
    <link rel="stylesheet" href="../styles/hover.css">
</head>
<style>
    table {
        border: 2px solid #8B6F47;
        background-color: #fdf4d9;
        margin-top: 20px;
    }

    th {
        background-color: #e4cfa5;
        color: black;
        font-weight: bold;
        text-align: center;
    }

    td {
        border: 1px solid #8B6F47;
    }
</style>
<body>

    <?php include '../components/header_admin.php'; ?>


    <div class="container my-5">
        <h3 class="card-title text-center text-muted">Students with Special Needs</h3>
        <form id="studentForm" class="mb-4">
            <table class="table table-bordered" style="background-color: #fdf4d9; ">
                <thead class="table-light">
                    <tr>
                        <th>Name</th>
                        <th>Sex</th>
                        <th>Program Enrolled</th>
                        <th>Year Level</th>
                        <th>Type of Disability</th>
                        <th>Campus</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="text" class="form-control" id="name" name="name" required></td>
                        <td>
                            <select class="form-control" id="sex" name="sex" required>
                                <option value="" disabled selected>Select</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" id="program" name="program" required></td>
                        <td>
                            <select class="form-control" id="yearLevel" name="yearLevel" required>
                                <option value="" disabled selected>Select</option>
                                <option value="1st Year">1st Year</option>
                                <option value="2nd Year">2nd Year</option>
                                <option value="3rd Year">3rd Year</option>
                                <option value="4th Year">4th Year</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" id="disability" name="disability"></td>
                        <td><input type="text" class="form-control" id="campus" name="campus" required></td>
                    </tr>
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <?php include '../components/footer.php'; ?>
    

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="../js/notif.js"></script>

    <script>
        $(document).ready(function() {
            $('#studentForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    type: 'POST',
                    url: '../controllers/save_instructions_studentDisability_Controller.php',
                    data: $(this).serialize(),
                    success: function(response) {
                        console.log('Server Response:', response);
                        alert('Student record saved successfully!');
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                        alert('Error saving student record.');
                    }
                });
            });
        });
    </script>
</body>
</html>
