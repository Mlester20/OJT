<?php 
session_start();
include '../components/config.php';

if (!isset($_SESSION['member_id'])) {
    header('location: ../index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Graduates - <?php include '../components/title.php'; ?> </title>
    <link rel="stylesheet" href="../styles/styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../styles/darkLight.css">
    <script src="../js/darkLight.js"></script>
    <link rel="stylesheet" href="../styles/hover.css">

<style>
    <style>
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ccc;
            text-align: center;
            padding: 8px;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        .category-header {
            background-color: #d9ead3;
            font-weight: bold;
        }
        .sub-header {
            background-color: #ffffcc;
            font-weight: bold;
        }
    </style>
</style>

</head>
<body>
    
    <?php include '../components/header_admin.php'; ?>

    <div class="container mt-5">
        <h2 class="text-center">Graduates Data Entry Form</h2>
        <form method="post" id="graduatesForm">
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
            <!-- First Table -->
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th rowspan="2">Level</th>
                        <th colspan="3" class="category-header">Total No. of Graduates in Priority and Mandated Courses</th>
                        <th colspan="3" class="category-header">Total No. of Graduates in All Programs</th>
                    </tr>
                    <tr>
                        <th class="sub-header">Male</th>
                        <th class="sub-header">Female</th>
                        <th class="sub-header">Total</th>
                        <th class="sub-header">Male</th>
                        <th class="sub-header">Female</th>
                        <th class="sub-header">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $levels = ['Doctorate', 'Masters', 'Post-Baccalaureate', 'Baccalaureate', 'Non-Degree', 'TOTAL'];
                    foreach ($levels as $level) {
                        echo "<tr>
                            <td>$level</td>
                            <td><input type='number' name='priority_male[$level]' class='form-control'></td>
                            <td><input type='number' name='priority_female[$level]' class='form-control'></td>
                            <td><input type='number' name='priority_total[$level]' class='form-control' readonly></td>
                            <td><input type='number' name='all_male[$level]' class='form-control'></td>
                            <td><input type='number' name='all_female[$level]' class='form-control'></td>
                            <td><input type='number' name='all_total[$level]' class='form-control' readonly></td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>

            <!-- Second Table -->
            <h4 class="mt-4 text-center">Number of Graduates</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th>Particular</th>
                        <th class="sub-header">Male</th>
                        <th class="sub-header">Female</th>
                        <th class="sub-header">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $categories = [
                        'Number of Graduates in Health Profession',
                        'Number of Graduates from Law and Enforcement Related Courses',
                        'Number of Graduates who Garnered a Qualification that entitled to Teach Primary School Level',
                        'STEM', 'Medicine', 'Arts & Humanities / Social Sciences'
                    ];
                    foreach ($categories as $category) {
                        echo "<tr>
                            <td>$category</td>
                            <td><input type='number' name='male[$category]' class='form-control'></td>
                            <td><input type='number' name='female[$category]' class='form-control'></td>
                            <td><input type='number' name='total[$category]' class='form-control' readonly></td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </form>
    </div>

    <?php include '../components/footer.php' ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="../js/notif.js"></script>

    <script>
        $(document).ready(function () {
            // Calculate totals for the first table
            $('input[name^="priority_male"], input[name^="priority_female"], input[name^="all_male"], input[name^="all_female"]').on('input', function () {
                const row = $(this).closest('tr');
                const priorityMale = parseInt(row.find('input[name^="priority_male"]').val()) || 0;
                const priorityFemale = parseInt(row.find('input[name^="priority_female"]').val()) || 0;
                const allMale = parseInt(row.find('input[name^="all_male"]').val()) || 0;
                const allFemale = parseInt(row.find('input[name^="all_female"]').val()) || 0;

                row.find('input[name^="priority_total"]').val(priorityMale + priorityFemale);
                row.find('input[name^="all_total"]').val(allMale + allFemale);
            });

            // Calculate totals for the second table
            $('input[name^="male"], input[name^="female"]').on('input', function () {
                const row = $(this).closest('tr');
                const male = parseInt(row.find('input[name^="male"]').val()) || 0;
                const female = parseInt(row.find('input[name^="female"]').val()) || 0;

                row.find('input[name^="total"]').val(male + female);
            });

            // Submit form data to API
            $('#graduatesForm').on('submit', function (e) {
                e.preventDefault(); // Prevent the default form submission

                const formData = $(this).serialize(); // Serialize the form data

                $.ajax({
                    url: '../controllers/save_graduatesController.php', // API endpoint
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        alert('Data saved successfully!'); // Show success message
                        console.log(response); // Log the response for debugging
                    },
                    error: function (xhr, status, error) {
                        alert('An error occurred while saving the data.'); // Show error message
                        console.error(xhr.responseText); // Log the error for debugging
                    }
                });
            });
        });
    </script>
    
 
</body>
</html>