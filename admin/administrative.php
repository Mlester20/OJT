<?php
session_start();
include '../components/config.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salut - <?php include '../components/title.php'; ?></title>
    <link rel="stylesheet" href="../styles/styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">
    <link rel="stylesheet" href="../styles/header_style.css">
</head>
<style>
        .table-container {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
            padding: 20px;
            margin: 20px 0;
        }

        .btn-custom {
            padding: 8px 20px;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.3s ease;
            margin-right: 10px;
        }

        .btn-add-row {
            background: #28a745;
            border: none;
            color: white;
        }

        .btn-add-row:hover {
            background: #218838;
            transform: translateY(-2px);
        }

        .btn-add-column {
            background: #17a2b8;
            border: none;
            color: white;
        }

        .btn-add-column:hover {
            background: #138496;
            transform: translateY(-2px);
        }

        .table {
            margin-top: 15px;
            background: white;
        }

        .table thead th {
            background: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
            color: #495057;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9rem;
        }

        .table td, .table th {
            padding: 12px;
            vertical-align: middle;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
            transition: background-color 0.3s ease;
        }

        .action-buttons .btn {
            padding: 5px 10px;
            margin: 0 3px;
            font-size: 0.875rem;
        }
</style>
<body>
    <?php include '../components/header_admin.php'; ?>

    <div class="container d-flex justify-content-center">
        <div class="p-4 rounded shadow" style="background-color: #f8f9fa; max-width: 800px; width: 100%; margin-top: 30px;">
            <h3 class="card-title text-center text-muted">Awards and Recognition Received</h3>
        </div>
    </div>

    <div class="container" style="margin-top: 2rem;">
        <div class="table-container">
            <div class="mb-4">
                <button id="addRowBtn" class="btn btn-custom btn-add-row">
                    <i class="fas fa-plus"></i> Add Row
                </button>
                <!-- <button id="addColumnBtn" class="btn btn-custom btn-add-column">
                    <i class="fas fa-columns"></i> Add Column
                </button> -->
            </div>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr id="dynamicTableHeader">
                            <th>#</th>
                            <th>Awards/Recognition</th>
                            <th>Conferred to</th>
                            <th>Conferred by</th>
                            <th>Date</th>
                            <th>Venue</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="dynamicTableBody">
                        <tr>
        
                        </tr>
                    </tbody>
                </table>
                <div class="add-row-btn">**insert more rows if necessary</div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="../js/dynamicTable.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
        let editButtons = document.querySelectorAll(".edit-btn");

        editButtons.forEach(button => {
            button.addEventListener("click", function () {
                let salutId = this.getAttribute("data-id");
                let salutName = this.getAttribute("data-name");

                document.getElementById("editSalutId").value = salutId;
                document.getElementById("editSalutName").value = salutName;
            });
        });
    });
    </script>
</body>
</html>