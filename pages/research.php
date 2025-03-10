<?php
session_start();
if (!isset($_SESSION['member_id'])) {
    header('location: ../index.php');
    exit();
}

include '../components/config.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Research Centers</title>
    <link rel="stylesheet" href="../styles/styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">
</head>
<body>

    <?php include '../components/header.php'; ?>

    <div class="container mt-4">
        <h2 class="text-center text-muted">Research Centers</h2>
            
        <form action="../controllers/save_researchController.php" method="POST">
            <div class="mb-4">
                <button type="button" class="btn btn-primary" onclick="addRow()">Add Row</button>
                <button type="submit" class="btn btn-success">Save</button>
            </div>
            <table class="table table-bordered" id="researchTable">
                <thead class="table-light">
                    <tr>
                        <th>Name of Research Center</th>
                        <th>Nature of Researches Conducted</th>
                        <th>Collaborating Agencies</th>
                        <th>Research Funding Support to ISU</th>
                        <th>Supports on what SDGs?</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <script>
                        for (let i = 0; i < 5; i++) {
                            document.write(`<tr>
                                <td><input type='text' name='research_center[]' class='form-control'></td>
                                <td><input type='text' name='nature_of_research[]' class='form-control'></td>
                                <td><input type='text' name='collaborating_agencies[]' class='form-control'></td>
                                <td><input type='text' name='funding_support[]' class='form-control'></td>
                                <td><input type='text' name='sdgs_support[]' class='form-control'></td>
                                <td><button class='btn btn-danger btn-sm' onclick='deleteRow(this)'>Delete</button></td>
                            </tr>`);
                        }
                    </script>
                </tbody>
            </table>
        </form>
        <div class="container row">
            <h3 class="text-center text-muted">*** Add more rows is neccesarry ***</h3>
        </div>
    </div>

    <script>
        function addRow() {
            let table = document.getElementById("researchTable").getElementsByTagName('tbody')[0];
            let newRow = table.insertRow();
            for (let i = 0; i < 5; i++) {
                let cell = newRow.insertCell(i);
                let input = document.createElement("input");
                input.type = "text";
                input.name = ['research_center[]', 'nature_of_research[]', 'collaborating_agencies[]', 'funding_support[]', 'sdgs_support[]'][i];
                input.className = "form-control";
                cell.appendChild(input);
            }
            let actionCell = newRow.insertCell(5);
            let deleteBtn = document.createElement("button");
            deleteBtn.className = "btn btn-danger btn-sm";
            deleteBtn.innerText = "Delete";
            deleteBtn.onclick = function () { table.deleteRow(newRow.rowIndex - 1); };
            actionCell.appendChild(deleteBtn);
        }

        function deleteRow(btn) {
            let row = btn.parentNode.parentNode;
            row.parentNode.removeChild(row);
        }
    </script>

    <?php include '../components/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    
</body>
</html>