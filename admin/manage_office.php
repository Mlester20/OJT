<?php
session_start();
include '../components/config.php';

if(isset($_POST['save'])){
    $office = mysqli_real_escape_string($con, $_POST['office_name']);
    $office_address = mysqli_real_escape_string($con, $_POST['office_address']);
    $query = mysqli_query($con, "INSERT INTO `office_name` (office_name, office_address) VALUES ('$office', '$office_address')") or die(mysqli_error($con));
    if($query){
        echo "<script>alert('Office Added Successfully!');document.location='manage_office.php'</script>";
    }
}

// Update Office
if(isset($_POST['update'])){
    $office_id = $_POST['office_id'];
    $office_name = mysqli_real_escape_string($con, $_POST['office_name']);
    $updateQuery = mysqli_query($con, "UPDATE office_name SET office_name='$office_name' WHERE office_id='$office_id'") or die(mysqli_error($con));
    if($updateQuery){
        echo "<script>alert('Office Updated Successfully!');document.location='manage_office.php'</script>";
    }
}


// Delete Office
if(isset($_POST['delete'])){
    $delete_id = $_POST['delete_id'];
    $deleteQuery = mysqli_query($con, "DELETE FROM office_name WHERE office_id='$delete_id'");
    if($deleteQuery){
        echo "<script>alert('Office Deleted Successfully!');document.location='manage_office.php'</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Office - <?php include '../components/title.php'; ?> </title>
    <link rel="stylesheet" href="../styles/styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<style>
.header-section {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.add-office-btn {
    background-color: #28a745;
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 4px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 5px;
}

.add-office-btn:hover {
    background-color: #218838;
}
</style>

<body>
    <?php include '../components/header_admin.php'; ?>

    <div class="container" style="margin-top: 30px;">
        <div class="header-section">
            <h3 class="card-title text-center">All Offices and Departments</h3>
            <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#addOfficeModal">
                <i class="fas fa-plus"></i> Add Office
            </button>
        </div>

        <table class="table table-bordered" style="margin-top: 15px">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Department Names</th>
                    <th class="col">Office Address</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $select = mysqli_query($con, "SELECT * FROM office_name ORDER BY office_name");
                    while($row = mysqli_fetch_assoc($select)){
                        echo '
                            <tr>
                                <th scope="row">'.$row['office_id'].'</th>
                                <td>'.$row['office_name'].'</td>
                                <td> '.$row['office_address'].' </td>
                                <td>
                                    <button class="btn btn-primary btn-sm edit-btn" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editOfficeModal"
                                        data-id="'.$row['office_id'].'"
                                        data-name="'.$row['office_name'].'">Edit
                                    </button>

                                    <form action="" method="POST" class="d-inline">
                                        <input type="hidden" name="delete_id" value="'.$row['office_id'].'">
                                        <button type="submit" name="delete" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this office?\')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        ';
                    }
                ?>
            </tbody>

        </table>
    </div>

    <!-- Add Office Modal -->
    <div class="modal fade" id="addOfficeModal" tabindex="-1" aria-labelledby="addOfficeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addOfficeModalLabel">Add New Office</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" enctype='multipart/form-data'>
                        <div class="mb-3">
                            <label for="officeName" class="form-label">Office Name</label>
                            <input type="text" class="form-control" id="officeName" name="office_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="officeAdd" class="form-label">Office Address</label>
                            <input type="text" class="form-control" id="officeAdd" name="office_address" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success" name='save'>Save Office</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Office Modal -->
    <div class="modal fade" id="editOfficeModal" tabindex="-1" aria-labelledby="editOfficeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editOfficeModalLabel">Edit Office</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php
                        // Check if there is an edit_id in the URL
                        if (isset($_GET['edit_id'])) {
                            $office_id = $_GET['edit_id'];
                            // Fetch the office details based on the office_id
                            $result = mysqli_query($con, "SELECT * FROM office_name WHERE office_id = '$office_id'");
                            $office = mysqli_fetch_assoc($result);
                        }
                    ?>
                    <form action="" method="POST">
                        <input type="hidden" id="editOfficeId" name="office_id" value="<?php echo isset($office['office_id']) ? $office['office_id'] : ''; ?>">
                        <div class="mb-3">
                            <label for="editOfficeName" class="form-label">Office Name</label>
                            <input type="text" class="form-control" id="editOfficeName" name="office_name" value="<?php echo isset($office['office_name']) ? $office['office_name'] : ''; ?>" required>
                        </div>
                        <div class="mb-3">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success" name="update">Update Office</button>
                        </div>
                    </form>
                </div>
            </div>
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
                    let officeId = this.getAttribute("data-id");
                    let officeName = this.getAttribute("data-name");

                    document.getElementById("editOfficeId").value = officeId;
                    document.getElementById("editOfficeName").value = officeName;
                });
            });
        });

    </script>

</body>
</html>
