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
    <title>National Certification Performance (TESDA)</title>
    <link rel="stylesheet" href="../styles/styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">
    <link rel="stylesheet" href="../styles/hover.css">
</head>
<body>

    <?php include '../components/header.php'; ?>

    <div class="container mt-4">
        <h2 class="text-center text-muted">National Certification Performance (TESDA)</h2>
        <form action="../controllers/save_certification_performanceController.php" method="POST">
            <div class="mb-4">
                <button type="button" class="btn btn-primary" onclick="addRow()">Add Row</button>
                <button type="submit" class="btn btn-success">Save</button>
            </div>
            <table class="table table-bordered" id="certificationTable">
                <thead class="table-light">
                    <tr>
                        <th>National Certification</th>
                        <th>Date (Complete)</th>
                        <th>Total No. of Examinees (Male)</th>
                        <th>Total No. of Examinees (Female)</th>
                        <th>Total No. of Examinees (Total)</th>
                        <th>Total Number of Passers (Male)</th>
                        <th>Total Number of Passers (Female)</th>
                        <th>Total Number of Passers (Total)</th>
                        <th>Institutional Passing Rate (Male)</th>
                        <th>Institutional Passing Rate (Female)</th>
                        <th>Institutional Passing Rate (Total)</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i = 0; $i < 5; $i++): ?>
                    <tr>
                        <td><input type='text' name='certification[]' class='form-control'></td>
                        <td><input type='date' name='date_complete[]' class='form-control'></td>
                        <td><input type='number' name='examinees_male[]' class='form-control' oninput='calculateTotals(this)'></td>
                        <td><input type='number' name='examinees_female[]' class='form-control' oninput='calculateTotals(this)'></td>
                        <td><input type='number' name='examinees_total[]' class='form-control' readonly></td>
                        <td><input type='number' name='passers_male[]' class='form-control' oninput='calculateTotals(this)'></td>
                        <td><input type='number' name='passers_female[]' class='form-control' oninput='calculateTotals(this)'></td>
                        <td><input type='number' name='passers_total[]' class='form-control' readonly></td>
                        <td><input type='number' step='0.01' name='passing_rate_male[]' class='form-control' readonly></td>
                        <td><input type='number' step='0.01' name='passing_rate_female[]' class='form-control' readonly></td>
                        <td><input type='number' step='0.01' name='passing_rate_total[]' class='form-control' readonly></td>
                        <td><button type='button' class='btn btn-danger btn-sm' onclick='deleteRow(this)'>Delete</button></td>
                    </tr>
                    <?php endfor; ?>
                </tbody>
            </table>
        </form>
        <div class="container row">
            <h3 class="text-center text-muted">*** Insert more rows if necessary ***</h3>
        </div>
    </div>

    <script>
        function addRow() {
            let table = document.getElementById("certificationTable").getElementsByTagName('tbody')[0];
            let newRow = table.insertRow();
            let cells = [
                "<input type='text' name='certification[]' class='form-control'>",
                "<input type='date' name='date_complete[]' class='form-control'>",
                "<input type='number' name='examinees_male[]' class='form-control' oninput='calculateTotals(this)'>",
                "<input type='number' name='examinees_female[]' class='form-control' oninput='calculateTotals(this)'>",
                "<input type='number' name='examinees_total[]' class='form-control' readonly>",
                "<input type='number' name='passers_male[]' class='form-control' oninput='calculateTotals(this)'>",
                "<input type='number' name='passers_female[]' class='form-control' oninput='calculateTotals(this)'>",
                "<input type='number' name='passers_total[]' class='form-control' readonly>",
                "<input type='number' step='0.01' name='passing_rate_male[]' class='form-control' readonly>",
                "<input type='number' step='0.01' name='passing_rate_female[]' class='form-control' readonly>",
                "<input type='number' step='0.01' name='passing_rate_total[]' class='form-control' readonly>",
                "<button type='button' class='btn btn-danger btn-sm' onclick='deleteRow(this)'>Delete</button>"
            ];
            cells.forEach(cell => {
                let newCell = newRow.insertCell();
                newCell.innerHTML = cell;
            });
        }

        function deleteRow(btn) {
            let row = btn.parentNode.parentNode;
            row.parentNode.removeChild(row);
        }

        function calculateTotals(input) {
            let row = input.parentNode.parentNode;
            let examineesMale = parseInt(row.querySelector("input[name='examinees_male[]']").value) || 0;
            let examineesFemale = parseInt(row.querySelector("input[name='examinees_female[]']").value) || 0;
            let passersMale = parseInt(row.querySelector("input[name='passers_male[]']").value) || 0;
            let passersFemale = parseInt(row.querySelector("input[name='passers_female[]']").value) || 0;

            let examineesTotal = examineesMale + examineesFemale;
            let passersTotal = passersMale + passersFemale;
            let passingRateMale = examineesMale ? (passersMale / examineesMale * 100).toFixed(2) : 0;
            let passingRateFemale = examineesFemale ? (passersFemale / examineesFemale * 100).toFixed(2) : 0;
            let passingRateTotal = examineesTotal ? (passersTotal / examineesTotal * 100).toFixed(2) : 0;

            row.querySelector("input[name='examinees_total[]']").value = examineesTotal;
            row.querySelector("input[name='passers_total[]']").value = passersTotal;
            row.querySelector("input[name='passing_rate_male[]']").value = passingRateMale;
            row.querySelector("input[name='passing_rate_female[]']").value = passingRateFemale;
            row.querySelector("input[name='passing_rate_total[]']").value = passingRateTotal;
        }
    </script>

    <?php include '../components/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    
</body>
</html>