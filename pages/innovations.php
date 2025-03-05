<?php
session_start();
include '../components/config.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Innovations - <?php include '../components/title.php'; ?></title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../styles/styles.css">
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../styles/user_header.css">
    <link rel="stylesheet" href="../styles/hover.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <?php include '../components/header.php'; ?>
    
    <div class="container mt-4">
        <h3 class="text-center bg-primary text-white p-2">ADMINISTRATIVE SERVICE INNOVATIONS</h3>
        <table class="table table-bordered text-center">
            <thead class="table-success">
                <tr>
                    <th>Name of Innovation</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                <tr>
                    <td><input type="text" class="form-control" placeholder="Enter innovation" name="innovation"></td>
                    <td><input type="text" class="form-control" placeholder="Enter description" name="description"></td>
                    <td>
                        <button class="btn btn-danger" onclick="removeRow(this)">Remove</button>
                    </td>
                </tr>
                <tr>
                    <td><input type="text" class="form-control" placeholder="Enter innovation" name="innovation"></td>
                    <td><input type="text" class="form-control" placeholder="Enter description" name="description"></td>
                    <td>
                        <button class="btn btn-danger" onclick="removeRow(this)">Remove</button>
                    </td>
                </tr>
                <tr>
                    <td><input type="text" class="form-control" placeholder="Enter innovation" name="innovation"></td>
                    <td><input type="text" class="form-control" placeholder="Enter description" name="description"></td>
                    <td>
                        <button class="btn btn-danger" onclick="removeRow(this)">Remove</button>
                    </td>
                </tr>
                <tr>
                    <td><input type="text" class="form-control" placeholder="Enter innovation" name="innovation"></td>
                    <td><input type="text" class="form-control" placeholder="Enter description" name="description"></td>
                    <td>
                        <button class="btn btn-danger" onclick="removeRow(this)">Remove</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <button class="btn btn-primary" onclick="addRow()">Add Row</button>
        <button class="btn btn-success" onclick="saveInnovations()">Save Innovations</button>
        <p class="mt-3 text-center text-success">***Insert more rows if necessary***</p>
    </div>

    <?php include '../components/footer.php'; ?>

    <script>
        function addRow() {
            let tableBody = document.getElementById("tableBody");
            let newRow = document.createElement("tr");
            newRow.innerHTML = `
                <td><input type="text" class="form-control" placeholder="Enter innovation" name="innovation"></td>
                <td><input type="text" class="form-control" placeholder="Enter description" name="description"></td>
                <td>
                    <button class="btn btn-danger" onclick="removeRow(this)">Remove</button>
                </td>
            `;
            tableBody.appendChild(newRow);
        }
        
        function removeRow(button) {
            button.parentElement.parentElement.remove();
        }

        function saveInnovations() {
            let tableBody = document.getElementById("tableBody");
            let rows = tableBody.getElementsByTagName("tr");
            let innovations = [];

            for (let i = 0; i < rows.length; i++) {
                let cells = rows[i].getElementsByTagName("td");
                let innovation = cells[0].getElementsByTagName("input")[0].value.trim();
                let description = cells[1].getElementsByTagName("input")[0].value.trim();

                if (innovation !== "" && description !== "") {  // Ensure no empty values
                    innovations.push({ innovation: innovation, description: description });
                }
            }

            if (innovations.length === 0) {
                alert("Please enter at least one innovation.");
                return;
            }

            $.ajax({
                url: '../controllers/save_innovations.php',
                type: 'POST',
                data: { innovations: JSON.stringify(innovations) },
                success: function(response) {
                    alert(response); // Show response message from server
                    location.reload(); // Reload to reflect changes
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert('An error occurred while saving innovations.');
                }
            });
        }

    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>