<?php
session_start();
include '../components/config.php';

if (!isset($_SESSION['member_id'])) {
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Infrastructure - <?php include '../components/title.php'; ?> </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../styles/styles.css">
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../styles/user_header.css">
    <link rel="stylesheet" href="../styles/hover.css">
    <link rel="stylesheet" href="../styles/darkLight.css">
    <script src="../js/darkLight.js"></script>
</head>
<body>
    <?php include '../components/header.php'; ?>

    <div class="container mt-5">
        <h2 class="text-center mb-4 text-success">List of Infrastructure Projects</h2>
        <form id="projectForm" method="POST" action="../controllers/save_infrastructureController.php">
            <div class="d-flex justify-content-between mb-3">
                <button type="button" class="btn btn-success" onclick="addRow()">Add Row</button>
                <button type="submit" class="btn btn-primary">Save Projects</button>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Name of Infrastructure Project</th>
                            <th>Allocated Budget</th>
                            <th>Project Duration</th>
                            <th>Date Started</th>
                            <th>Expected Date of Completion</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="projectTableBody">
                        <?php for ($i = 0; $i < 5; $i++): ?>
                        <tr>
                            <td><input type="text" name="project_name[]" class="form-control" placeholder="Project Name"></td>
                            <td><input type="number" name="budget[]" class="form-control" placeholder="Budget"></td>
                            <td><input type="text" name="duration[]" class="form-control" placeholder="Duration"></td>
                            <td><input type="date" name="date_started[]" class="form-control"></td>
                            <td><input type="date" name="expected_completion_date[]" class="form-control"></td>
                            <td>
                                <select name="status[]" class="form-select">
                                    <option>Pending</option>
                                    <option>Ongoing</option>
                                    <option>Completed</option>
                                    <option>Cancelled</option>
                                </select>
                            </td>
                            <td><button type="button" class="btn btn-danger" onclick="removeRow(this)">Remove</button></td>
                        </tr>
                        <?php endfor; ?>
                    </tbody>
                </table>
            </div>
        </form>
        <div class="container">
            <h4 class="text-center text-muted">*** Add rows if necessary ***</h4>
        </div>
    </div>

    <?php include '../components/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function addRow() {
            let table = document.getElementById("projectTableBody");
            let row = table.insertRow();
            row.innerHTML = `
                <td><input type="text" name="project_name[]" class="form-control" placeholder="Project Name"></td>
                <td><input type="number" name="budget[]" class="form-control" placeholder="Budget"></td>
                <td><input type="text" name="duration[]" class="form-control" placeholder="Duration"></td>
                <td><input type="date" name="date_started[]" class="form-control"></td>
                <td><input type="date" name="expected_completion_date[]" class="form-control"></td>
                <td>
                    <select name="status[]" class="form-select">
                        <option>Pending</option>
                        <option>Ongoing</option>
                        <option>Completed</option>
                        <option>Cancelled</option>
                    </select>
                </td>
                <td><button type="button" class="btn btn-danger" onclick="removeRow(this)">Remove</button></td>
            `;
        }

        function removeRow(button) {
            let row = button.parentElement.parentElement;
            row.remove();
        }
    </script>
</body>
</html>