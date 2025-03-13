<?php
session_start();
if (!isset($_SESSION['member_id'])) {
    header('location: ../index.php');
    exit();
}

include '../components/config.php';

$success_message = '';
if (isset($_SESSION['success_message'])) {
    $success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Research Linkages - <?php include '../components/title.php'; ?> </title>
    <link rel="stylesheet" href="../styles/styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">
    <link rel="stylesheet" href="../styles/hover.css">
</head>
<body>
    <?php include '../components/header.php'; ?>

    <div class="container mt-4">
        <h2 class="text-center">Administrative Linkages</h2>
        
        <?php if ($success_message): ?>
            <script>
                alert('<?php echo $success_message; ?>');
            </script>
        <?php endif; ?>

        <form action="../controllers/save_administrative_linkagesController.php" method="POST">
            <h4>International</h4>
            <div class="mb-4">
                <button type="button" class="btn btn-primary" onclick="addRow('international')">Add Row</button>
                <button type="submit" class="btn btn-success">Save</button>
            </div>
            <table id="international-table" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name of Institution</th>
                        <th>Title of MOA/MOU</th>
                        <th>Nature of Linkage</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <script>
                        for (let i = 0; i < 5; i++) {
                            document.write(`
                                <tr>
                                    <td><input type="text" class="form-control" name="institution[]"></td>
                                    <td><input type="text" class="form-control" name="moa_mou[]"></td>
                                    <td><input type="text" class="form-control" name="linkage[]"></td>
                                    <td><input type="date" class="form-control" name="date_from[]"></td>
                                    <td><input type="date" class="form-control" name="date_to[]"></td>
                                    <td>
                                        <input type="hidden" name="linkage_type[]" value="international">
                                        <button type="button" class="btn btn-danger" onclick="removeRow(this)">Remove</button>
                                    </td>
                                </tr>
                            `);
                        }
                    </script>
                </tbody>
            </table>
            
            <h4 class="mt-4">Regional</h4>
            <div class="mb-4">
                <button type="button" class="btn btn-primary" onclick="addRow('regional')">Add Row</button>
                <button type="submit" class="btn btn-success">Save</button>
            </div>
            <table id="regional-table" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name of Institution</th>
                        <th>Title of MOA/MOU</th>
                        <th>Nature of Linkage</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="text" class="form-control" name="institution[]"></td>
                        <td><input type="text" class="form-control" name="moa_mou[]"></td>
                        <td><input type="text" class="form-control" name="linkage[]"></td>
                        <td><input type="date" class="form-control" name="date_from[]"></td>
                        <td><input type="date" class="form-control" name="date_to[]"></td>
                        <td>
                            <input type="hidden" name="linkage_type[]" value="regional">
                            <button type="button" class="btn btn-danger" onclick="removeRow(this)">Remove</button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <h4 class="mt-4">Municipal/Regional</h4>
            <div class="mb-4">
                <button type="button" class="btn btn-primary" onclick="addRow('municipal')">Add Row</button>
                <button type="submit" class="btn btn-success">Save</button>
            </div>
            <table id="municipal-table" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name of Institution</th>
                        <th>Title of MOA/MOU</th>
                        <th>Nature of Linkage</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="text" class="form-control" name="institution[]"></td>
                        <td><input type="text" class="form-control" name="moa_mou[]"></td>
                        <td><input type="text" class="form-control" name="linkage[]"></td>
                        <td><input type="date" class="form-control" name="date_from[]"></td>
                        <td><input type="date" class="form-control" name="date_to[]"></td>
                        <td>
                            <input type="hidden" name="linkage_type[]" value="municipal">
                            <button type="button" class="btn btn-danger" onclick="removeRow(this)">Remove</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>

    <?php include '../components/footer.php'; ?>

    <script>
        function addRow(tableId) {
            let table = document.getElementById(tableId + '-table').getElementsByTagName('tbody')[0];
            let newRow = table.insertRow();
            newRow.innerHTML = `
                <td><input type="text" class="form-control" name="institution[]"></td>
                <td><input type="text" class="form-control" name="moa_mou[]"></td>
                <td><input type="text" class="form-control" name="linkage[]"></td>
                <td><input type="date" class="form-control" name="date_from[]"></td>
                <td><input type="date" class="form-control" name="date_to[]"></td>
                <td>
                    <input type="hidden" name="linkage_type[]" value="${tableId}">
                    <button type="button" class="btn btn-danger" onclick="removeRow(this)">Remove</button>
                </td>
            `;
        }

        function removeRow(button) {
            let row = button.parentNode.parentNode;
            row.parentNode.removeChild(row);
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>