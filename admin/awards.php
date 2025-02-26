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
    <link rel="stylesheet" href="../styles/hover.css">
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
        .category-container {
            margin-bottom: 40px;
        }
        .category-header {
            background: #f0f8f0;
            padding: 10px;
            border-left: 5px solid #2c5282;
            font-weight: bold;
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

    <?php include '../components/header_admin.php'; ?>

    <div class="container my-5">
        <div class="awards-header text-center mb-4">
            <h1 class="h2 mb-0">AWARDS AND RECOGNITIONS RECEIVED</h1>
        </div>

        <?php
        $categories = ["International", "National", "Regional/Provincial", "Local"];
        foreach ($categories as $category):
        ?>
        <div class="container category-container">
            <h3 class="category-header"><?= $category ?></h3>
            <div class="d-flex justify-content-end gap-3 mb-3">
                <button class="btn btn-success addRowBtn" data-category="<?= $category ?>">Add Row</button>
                <button class="btn btn-primary submitData" data-category="<?= $category ?>">Save Data</button>
            </div>
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
                <tbody id="table-<?= $category ?>" class="dynamicTableBody">
                    <!-- Rows will be added dynamically -->
                </tbody>
            </table>
            <div class="add-row-btn">**insert more rows if necessary</div>
        </div>
        <?php endforeach; ?>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Function to add a new row to a specific category
            function addNewRow(category) {
                let tableBody = document.getElementById("table-" + category);
                let newRow = tableBody.insertRow();

                for (let i = 0; i < 5; i++) {
                    let newCell = newRow.insertCell();
                    if (i === 3) {
                        newCell.innerHTML = '<input type="date">';
                    } else {
                        newCell.contentEditable = "true";
                    }
                }
                let actionCell = newRow.insertCell();
                actionCell.innerHTML = '<button class="btn btn-danger deleteRow">Delete</button>';
                attachDeleteEvent(newRow);
            }

            // Function to attach delete event to a row
            function attachDeleteEvent(row) {
                row.querySelector(".deleteRow").addEventListener("click", function () {
                    row.remove();
                });
            }

            // Add default rows to each table
            document.querySelectorAll(".dynamicTableBody").forEach(tableBody => {
                let category = tableBody.id.replace("table-", "");
                for (let i = 0; i < 4; i++) {  
                    addNewRow(category);
                }
            });

            // Event listeners for adding rows
            document.querySelectorAll(".addRowBtn").forEach(button => {
                button.addEventListener("click", function () {
                    let category = this.getAttribute("data-category");
                    addNewRow(category);
                });
            });

            // Event listeners for submitting data
            document.querySelectorAll(".submitData").forEach(button => {
                button.addEventListener("click", function () {
                    let category = this.getAttribute("data-category");
                    let tableBody = document.getElementById("table-" + category);
                    let data = [];

                    Array.from(tableBody.rows).forEach(row => {
                        let rowData = [];
                        Array.from(row.cells).forEach((cell, index) => {
                            if (index < 5) {
                                rowData.push(index === 3 ? cell.querySelector("input").value : cell.textContent.trim());
                            }
                        });
                        data.push(rowData);
                    });

                    fetch("save.php", {
                        method: "POST",
                        headers: { "Content-Type": "application/json" },
                        body: JSON.stringify({ category: category, tableData: data })
                    })
                    .then(response => response.text())
                    .then(result => alert(category + " Data Saved!\n" + result))
                    .catch(error => console.error("Error:", error));
                });
            });
        });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    
</body>
</html>