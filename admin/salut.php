<?php
session_start();
include '../components/config.php';

if(isset($_POST['save'])){
    $salut = mysqli_real_escape_string($con, $_POST['salut']);
    $query = mysqli_query($con, "INSERT INTO `salut` (salut) VALUES ('$salut')") or die(mysqli_error($con));
    if($query){
        echo "<script>alert('Salut Added Successfully!');document.location='salut.php'</script>";
    }
}

if(isset($_POST['update'])){
    $salut_id = $_POST['salut_id'];
    $salut = mysqli_real_escape_string($con, $_POST['salut']);
    $updateQuery = mysqli_query($con, "UPDATE salut SET salut='$salut' WHERE salut_id='$salut_id'") or die(mysqli_error($con));
    if($updateQuery){
        echo "<script>alert('Salutation Updated Successfully!');document.location='salut.php'</script>";
    }
}

if(isset($_POST['delete'])){
    $delete_id = $_POST['delete_id'];
    $deleteQuery = mysqli_query($con, "DELETE FROM salut WHERE salut_id='$delete_id'");
    if($deleteQuery){
        echo "<script>alert('Salutation Deleted Successfully!');document.location='salut.php'</script>";
    }
}
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

<body>
    <?php include '../components/header_admin.php'; ?>

    <div class="container" style="margin-top: 30px">
        <div class="header-section">
            <h3 class="card-title text-center">Salutation</h3>
            <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#addSalutationModal">
                <i class="fas fa-plus"></i> Add Salut
            </button>
        </div>

        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Salut</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $query = mysqli_query($con, "SELECT * FROM salut") or die(mysqli_error($con));
                    if($query){
                        while($row = mysqli_fetch_assoc($query)){
                            echo '
                                <tr>
                                    <th scope="row">'.$row['salut_id'].'</th>
                                    <td>'. $row['salut'] .'</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm edit-btn" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editSalutModal"
                                            data-id="'.$row['salut_id'].'"
                                            data-name="'.$row['salut'].'">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <form action="" method="POST" class="d-inline">
                                            <input type="hidden" name="delete_id" value="'.$row['salut_id'].'">
                                            <button type="submit" name="delete" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this Salut?\')">
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

    <!-- Add Modal -->
    <div class="modal fade" id="addSalutationModal" tabindex="-1" aria-labelledby="addSalutationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSalutationModalLabel">Add New Salutation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="salutName" class="form-label">Salutation Name</label>
                            <input type="text" class="form-control" id="salutName" name="salut" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success" name="save">Save Salut</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editSalutModal" tabindex="-1" aria-labelledby="editSalutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSalutModalLabel">Edit Salutation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <input type="hidden" id="editSalutId" name="salut_id">
                        <div class="mb-3">
                            <label for="editSalutName" class="form-label">Salutation Name</label>
                            <input type="text" class="form-control" id="editSalutName" name="salut" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success" name="update">Update Salut</button>
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