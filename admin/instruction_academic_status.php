<?php
session_start();
include '../components/config.php';

if (!isset($_SESSION['member_id'])) {
    header('location: ../index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academic Status - <?php include '../components/title.php'; ?> </title>
    <link rel="stylesheet" href="../styles/styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../styles/darkLight.css">
    <script src="../js/darkLight.js"></script>
    <link rel="stylesheet" href="../styles/hover.css">
</head>
<body>

    <?php include '../components/header_admin.php'; ?>

    <div class="container mt-4">
        <h2 class="text-center">Academic Status Table</h2>
        <form id="academicForm">
            <div class="container mb-4">
                <button type="button" id="addRow" class="btn btn-primary">Add Row</button>
                <button type="submit" class="btn btn-success">Save</button>
            </div>
            <table class="table table-bordered">
                <thead class="table-success">
                    <tr>
                        <th>No.</th>
                        <th>Programs</th>
                        <th>Level</th>
                        <th>Validity Date</th>
                        <th>Latest Survey Visit Date</th>
                        <th>Board Action</th>
                        <th>Remarks</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <!-- 5 Default Blank Rows -->
                    <?php for ($i = 1; $i <= 5; $i++) { ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><input type="text" name="programs[]" class="form-control"></td>
                        <td><input type="text" name="level[]" class="form-control"></td>
                        <td><input type="date" name="validity_date[]" class="form-control"></td>
                        <td><input type="date" name="survey_date[]" class="form-control"></td>
                        <td><input type="text" name="board_action[]" class="form-control"></td>
                        <td><input type="text" name="remarks[]" class="form-control"></td>
                        <td><button type="button" class="btn btn-danger removeRow">Remove</button></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <button type="button" id="addRow" class="btn btn-primary">Add Row</button>
            <button type="submit" class="btn btn-success">Save</button>
        </form>
    </div>

    <?php include '../components/footer.php'; ?>

    <script>
        $(document).ready(function () {
            $("#addRow").click(function () {
                let rowCount = $("#tableBody tr").length + 1;
                let newRow = `
                <tr>
                    <td>${rowCount}</td>
                    <td><input type="text" name="programs[]" class="form-control"></td>
                    <td><input type="text" name="level[]" class="form-control"></td>
                    <td><input type="date" name="validity_date[]" class="form-control"></td>
                    <td><input type="date" name="survey_date[]" class="form-control"></td>
                    <td><input type="text" name="board_action[]" class="form-control"></td>
                    <td><input type="text" name="remarks[]" class="form-control"></td>
                    <td><button type="button" class="btn btn-danger removeRow">Remove</button></td>
                </tr>`;
                $("#tableBody").append(newRow);
            });

            $(document).on("click", ".removeRow", function () {
                $(this).closest("tr").remove();
            });

            $("#academicForm").submit(function (e) {
                e.preventDefault();
                $.ajax({
                    url: "../controllers/save_instructions_academicStatusController.php",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function (response) {
                        alert("Data saved successfully!");
                        location.reload();
                    },
                    error: function () {
                        alert("Error saving data.");
                    }
                });
            });
        });
    </script>

</body>
</html>
