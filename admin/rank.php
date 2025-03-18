<?php
session_start();
include '../components/config.php';

if (empty($_SESSION['member_id'])):
    header('Location: ../index.php');
    exit();
endif;

    if(isset($_POST['save'])){
        $rank = mysqli_real_escape_string($con, $_POST['rank']);

        //query to insert data into database
        $query = mysqli_query($con, "INSERT INTO `rank` (rank) VALUES ('$rank')") or die(mysqli_connect($con));
        if($query){
            echo "<script>alert('Rank Added Successfully!');document.location='rank.php'</script>";
        }
    }

    if(isset($_POST['update'])){
        $rank_id = $_POST['rank_id'];
        $rank = mysqli_real_escape_string($con, $_POST['rank']);
        $updateQuery = mysqli_query($con, "UPDATE rank SET rank='$rank' WHERE rank_id='$rank_id'") or die(mysqli_error($con));
        if($updateQuery){
            echo "<script>alert('Rank Updated Successfully!');document.location='rank.php'</script>";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rank - <?php include '../components/title.php'; ?> </title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">
    <link rel="stylesheet" href="../styles/styles.css">
    <link rel="stylesheet" href="../styles/header_style.css">
</head>
<body>

    <?php include '../components/header_admin.php'; ?>

    <div class="container" style="margin-top: 30px">
        <div class="header-section">
            <h3 class="card-title text-center text-muted">Rank</h3>
            <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#addRankModal">
                <i class="fas fa-plus"></i> Add Rank
            </button>
        </div>

        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Rank</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $query = mysqli_query($con, "SELECT * FROM rank ORDER BY rank ") or die(mysqli_error($con));
                    if($query){
                        while($row = mysqli_fetch_assoc($query)){
                            echo '
                                <tr>
                                    <th scope="row">'.$row['rank_id'].'</th>
                                    <td>'. $row['rank'] .'</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm edit-btn" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editRankModal"
                                            data-id="'.$row['rank_id'].'"
                                            data-name="'.$row['rank'].'">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <form action="" method="POST" class="d-inline">
                                            <input type="hidden" name="delete_id" value="'.$row['rank_id'].'">
                                            <button type="submit" name="delete" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this Rank?\')">
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

    <div class="modal fade" id="addRankModal" tabindex="-1" aria-labelledby="addRankModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSalutationModalLabel">Add New Rank</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="rankName" class="form-label">Rank Name</label>
                            <input type="text" class="form-control" id="rankName" name="rank" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success" name="save">Save Rank</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editRankModal" tabindex="-1" aria-labelledby="editRankModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editRankModalLabel">Edit Rank</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <input type="hidden" id="editRankId" name="rank_id">
                        <div class="mb-3">
                            <label for="editRankName" class="form-label">Salutation Name</label>
                            <input type="text" class="form-control" id="editRankName" name="rank" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success" name="update">Update Rank</button>
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
    <script src="../js/notif.js"></script>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        let editButtons = document.querySelectorAll(".edit-btn");

        editButtons.forEach(button => {
            button.addEventListener("click", function () {
                let salutId = this.getAttribute("data-id");
                let salutName = this.getAttribute("data-name");

                document.getElementById("editRankId").value = salutId;
                document.getElementById("editRankName").value = salutName;
            });
        });
    });
    </script>
    
</body>
</html>