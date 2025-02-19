<?php
session_start();

if (!isset($_SESSION["member_id"])) {
    $_SESSION["member_id"] = 1;
}

$member_id = $_SESSION["member_id"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Table with PHP & JS</title>
    <link rel="stylesheet" href="../styles/styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">
    <link rel="stylesheet" href="../styles/header_style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .btn {
            padding: 5px 10px;
            cursor: pointer;
        }
        .btn-danger {
            background-color: red;
            color: white;
        }
        .btn-success {
            background-color: green;
            color: white;
        }
        .awards-header {
            background: #000080;
            color: white;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        
        .category-header {
            background: #f0f8f0;
            padding: 10px;
            margin-top: 20px;
            border-left: 5px solid #2c5282;
            font-weight: bold;
        }
        
        .table-responsive {
            margin-bottom: 30px;
        }
        
        .table th {
            background-color: #e2e8f0;
        }
        
        .add-row-btn {
            color: #718096;
            font-style: italic;
            padding: 8px;
            background: #f7fafc;
            border: 1px dashed #cbd5e0;
            text-align: center;
            margin: 10px 0;
            border-radius: 4px;
        }
    </style>
</head>
<body>

    <?php include '../components/header.php'; ?>

    <div class="container my-5">
        <div class="awards-header text-center mb-4">
            <h1 class="h2 mb-0">AWARDS AND RECOGNITIONS RECEIVED</h1>
        </div>
        <div class="d-flex justify-content-end gap-3 mb-3">
            <button id="addRowBtn" class="btn btn-success">Add Row</button>
            <button id="submitData" class="btn btn-primary">Save Data</button>
        </div>
        <h3 class="mt-4 bg-light p-2">National</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Awards/Recognition</th>
                    <th>Conferred to</th>
                    <th>Conferred by</th>
                    <th>Date</th>
                    <th>Venue</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="dynamicTableBody">
                <!-- Rows will be added dynamically -->
            </tbody>
        </table>
        <div class="add-row-btn">**insert more rows if necessary</div>
    </div>



    <script src="../js/administrative.js"></script>

</body>
</html>
