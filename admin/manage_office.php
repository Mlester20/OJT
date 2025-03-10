<?php
session_start();
include '../components/config.php';

if (empty($_SESSION['member_id'])):
    header('Location: ../index.php');
    exit();
endif;

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
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">
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

    .pagination .page-link {
        color: #333;
        border-radius: 0;
        margin: 0 2px;
    }

    .pagination .page-item.active .page-link {
        background-color: #198754;
        border-color: #198754;
        color: white;
    }

    .pagination .page-link:hover {
        background-color: #e9ecef;
        color: #198754;
    }

    .pagination .page-item.disabled .page-link {
        color: #6c757d;
    }

    .table {
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }

    .table thead {
        background-color: #f8f9fa;
    }

    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }

    .btn {
        transition: all 0.3s ease;
    }

    .btn:hover {
        transform: translateY(-1px);
    }

    .site-footer {
        background-color: #333;
        color: white;
        padding: 40px 0;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }
</style>

<body>
    <?php include '../components/header_admin.php'; ?>

    <div class="container" style="margin-top: 30px;">
        <div class="header-section">
            <h3 class="card-title text-center">Offices/Departments</h3>
            <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#addOfficeModal">
                <i class="fas fa-plus"></i> Add Office
            </button>
        </div>

        <?php
        // Number of records per page
        $records_per_page = 10;

        // Get current page
        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
        $offset = ($current_page - 1) * $records_per_page;

        // Get total number of records
        $total_records_query = mysqli_query($con, "SELECT COUNT(*) as count FROM office_name");
        $total_records = mysqli_fetch_assoc($total_records_query)['count'];
        $total_pages = ceil($total_records / $records_per_page);

        // Get records for current page
        $select = mysqli_query($con, "SELECT * FROM office_name ORDER BY office_name LIMIT $offset, $records_per_page");
        ?>

        <div class="table-responsive">
            <table class="table table-bordered table-hover" style="margin-top: 15px">
                <thead class="table-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Office/Departments</th>
                        <th class="col">Office Address</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $counter = $offset + 1;
                    while($row = mysqli_fetch_assoc($select)){
                        echo '
                            <tr>
                                <th scope="row">'.$counter.'</th>
                                <td>'.$row['office_name'].'</td>
                                <td>'.$row['office_address'].'</td>
                                <td>
                                    <button class="btn btn-primary btn-sm edit-btn" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editOfficeModal"
                                        data-id="'.$row['office_id'].'"
                                        data-name="'.$row['office_name'].'">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    <form action="" method="POST" class="d-inline">
                                        <input type="hidden" name="delete_id" value="'.$row['office_id'].'">
                                        <button type="submit" name="delete" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this office?\')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        ';
                        $counter++;
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <?php if($total_pages > 1): ?>
        <nav aria-label="Page navigation" class="mt-4">
            <ul class="pagination justify-content-center">
                <!-- Previous button -->
                <li class="page-item <?php echo $current_page <= 1 ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $current_page - 1; ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                <?php
                // Calculate range of page numbers to show
                $range = 2;
                $initial_num = $current_page - $range;
                $condition_limit_num = ($current_page + $range) + 1;

                for($i = $initial_num; $i < $condition_limit_num; $i++) {
                    if($i > 0 && $i <= $total_pages) {
                        echo '<li class="page-item '.($current_page == $i ? 'active' : '').'">
                                <a class="page-link" href="?page='.$i.'">'.$i.'</a>
                            </li>';
                    }
                }
                ?>

                <!-- Next button -->
                <li class="page-item <?php echo $current_page >= $total_pages ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $current_page + 1; ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
        <?php endif; ?>

        <!-- Records info -->
        <div class="text-center text-muted mt-2">
            Showing <?php echo $offset + 1; ?> to <?php echo min($offset + $records_per_page, $total_records); ?> 
            of <?php echo $total_records; ?> entries
        </div>
    </div>
    <?php include '../components/footer.php'; ?>


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