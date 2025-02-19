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

<body>
    <?php include '../components/header_admin.php'; ?>


    <div class="container py-5">
        <div class="awards-header text-center mb-4">
            <h1 class="h2 mb-0">AWARDS AND RECOGNITIONS RECEIVED</h1>
        </div>

        <!-- International Awards -->
        <div class="category-header">International</div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th width="5%">#</th>
                        <th width="30%">Award/Recognition</th>
                        <th width="25%">Conferred to</th>
                        <th width="20%">Conferred by</th>
                        <th width="10%">Date</th>
                        <th width="10%">Venue</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td contenteditable="true"></td>
                        <td contenteditable="true"></td>
                        <td contenteditable="true"></td>
                        <td contenteditable="true"></td>
                        <td contenteditable="true"></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td contenteditable="true"></td>
                        <td contenteditable="true"></td>
                        <td contenteditable="true"></td>
                        <td contenteditable="true"></td>
                        <td contenteditable="true"></td>
                    </tr>
                </tbody>
            </table>
            <div class="add-row-btn">**insert more rows if necessary</div>
        </div>

        <!-- National Awards -->
        <div class="category-header">National</div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th width="5%">#</th>
                        <th width="30%">Award/Recognition</th>
                        <th width="25%">Conferred to</th>
                        <th width="20%">Conferred by</th>
                        <th width="10%">Date</th>
                        <th width="10%">Venue</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td contenteditable="true"></td>
                        <td contenteditable="true"></td>
                        <td contenteditable="true"></td>
                        <td contenteditable="true"></td>
                        <td contenteditable="true"></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td contenteditable="true"></td>
                        <td contenteditable="true"></td>
                        <td contenteditable="true"></td>
                        <td contenteditable="true"></td>
                        <td contenteditable="true"></td>
                    </tr>
                </tbody>
            </table>
            <div class="add-row-btn">**insert more rows if necessary</div>
        </div>

        <!-- Regional/Provincial Awards -->
        <div class="category-header">Regional / Provincial</div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th width="5%">#</th>
                        <th width="30%">Award/Recognition</th>
                        <th width="25%">Conferred to</th>
                        <th width="20%">Conferred by</th>
                        <th width="10%">Date</th>
                        <th width="10%">Venue</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td contenteditable="true"></td>
                        <td contenteditable="true"></td>
                        <td contenteditable="true"></td>
                        <td contenteditable="true"></td>
                        <td contenteditable="true"></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td contenteditable="true"></td>
                        <td contenteditable="true"></td>
                        <td contenteditable="true"></td>
                        <td contenteditable="true"></td>
                        <td contenteditable="true"></td>
                    </tr>
                </tbody>
            </table>
            <div class="add-row-btn">**insert more rows if necessary</div>
        </div>

        <!-- Local Awards -->
        <div class="category-header">Local</div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th width="5%">#</th>
                        <th width="30%">Award/Recognition</th>
                        <th width="25%">Conferred to</th>
                        <th width="20%">Conferred by</th>
                        <th width="10%">Date</th>
                        <th width="10%">Venue</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td contenteditable="true"></td>
                        <td contenteditable="true"></td>
                        <td contenteditable="true"></td>
                        <td contenteditable="true"></td>
                        <td contenteditable="true"></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td contenteditable="true"></td>
                        <td contenteditable="true"></td>
                        <td contenteditable="true"></td>
                        <td contenteditable="true"></td>
                        <td contenteditable="true"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="../js/controls.js"></script>

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