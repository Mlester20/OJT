<?php
session_start();
include '../components/config.php';

if (empty($_SESSION['member_id'])):
    header('Location: ../index.php');
    exit();
endif;

if(isset($_POST['save'])){
    $designation = mysqli_real_escape_string($con, $_POST['designation']);
    $query = mysqli_query($con, "INSERT INTO `designation` (designation_name) VALUES ('$designation')") or die(mysqli_error($con));
    if($query){
        echo "<script>alert('Designation Added Successfully!');document.location='designation.php'</script>";
    }
}

if(isset($_POST['update'])){
    $designation_id = $_POST['designation_id'];
    $designation_name = mysqli_real_escape_string($con, $_POST['designation']);
    $updateQuery = mysqli_query($con, "UPDATE designation SET designation_name='$designation_name' WHERE designation_id='$designation_id'") or die(mysqli_error($con));
    if($updateQuery){
        echo "<script>alert('Designation Updated Successfully!');document.location='designation.php'</script>";
    }
}

if(isset($_POST['delete'])){
    $delete_id = $_POST['delete_id'];
    $deleteQuery = mysqli_query($con, "DELETE FROM designation WHERE designation_id='$delete_id'");
    if($deleteQuery){
        echo "<script>alert('Data Deleted Successfully!');document.location='designation.php'</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Designation - <?php include '../components/title.php'; ?></title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.min.js"></script>
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">
    <link rel="stylesheet" href="../styles/header_style.css">
</head>
<body>
    <?php include '../components/header_admin.php'; ?>

    <div class="container" style="margin-top: 30px;">
        <div class="header-section">
            <h3 class="card-title text-center text-muted">Designation</h3>
            <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#addDesignationModal">
                <i class="fas fa-plus"></i> Add Designation
            </button>
        </div>
        
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Designation</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php  
                $query = mysqli_query($con, "SELECT * FROM designation") or die(mysqli_error($con));
                if($query){
                    while($row = mysqli_fetch_assoc($query)){
                        echo '
                            <tr>
                                <th scope="row">'. $row['designation_id'] .'</th>
                                <td>'. $row['designation_name'] .'</td>
                                <td>
                                    <button class="btn btn-primary btn-sm edit-btn" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editDesignationModal"
                                        data-id="'.$row['designation_id'].'"
                                        data-name="'.$row['designation_name'].'">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <form action="" method="POST" class="d-inline">
                                        <input type="hidden" name="delete_id" value="'.$row['designation_id'].'">
                                        <button type="submit" name="delete" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this Data?\')">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        ';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Add Designation Modal -->
    <div class="modal fade" id="addDesignationModal" tabindex="-1" aria-labelledby="addDesignationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addDesignationModalLabel">Add New Designation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="designationName" class="form-label">Designation Name</label>
                            <input type="text" class="form-control" id="designationName" name="designation" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success" name="save">Save Designation</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Designation Modal -->
    <div class="modal fade" id="editDesignationModal" tabindex="-1" aria-labelledby="editDesignationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editDesignationModalLabel">Edit Designation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <input type="hidden" id="editDesignationId" name="designation_id">
                        <div class="mb-3">
                            <label for="editDesignationName" class="form-label">Designation Name</label>
                            <input type="text" class="form-control" id="editDesignationName" name="designation" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success" name="update">Update Designation</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include '../components/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="../js/controls.js"></script>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        let editButtons = document.querySelectorAll(".edit-btn");

        editButtons.forEach(button => {
            button.addEventListener("click", function () {
                let designationId = this.getAttribute("data-id");
                let designationName = this.getAttribute("data-name");

                document.getElementById("editDesignationId").value = designationId;
                document.getElementById("editDesignationName").value = designationName;
            });
        });
    });
    </script>
    <script src="../js/notif.js"></script>

</body>
</html>