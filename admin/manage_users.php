<?php
session_start();
include '../components/config.php';

if (!isset($_SESSION['member_id'])) {
    header('Location: ../index.php');
    exit();
}

if(isset($_POST['submit'])) {
    $first_name = mysqli_real_escape_string($con, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($con, $_POST['last_name']);
    $gender = mysqli_real_escape_string($con, $_POST['gender']);
    $role = mysqli_real_escape_string($con, $_POST['role']);
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']); // Raw password input
    $office_id = mysqli_real_escape_string($con, $_POST['office_id']);
    $salut_id = mysqli_real_escape_string($con, $_POST['salut_id']);
    $rank_id = mysqli_real_escape_string($con, $_POST['rank_id']);
    $designation_id = mysqli_real_escape_string($con, $_POST['designation_id']);

    // Hash password using MD5 before storing
    $hashed_password = md5($password);

    $query = mysqli_query($con, "INSERT INTO member (member_first, member_last, member_gender, role, username, password, 
              office_id, salut_id, rank_id, designation_id) 
              VALUES ('$first_name', '$last_name', '$gender', '$role', '$username', '$hashed_password', 
              '$office_id', '$salut_id', '$rank_id', '$designation_id')") or die (mysqli_error($con));

    if($query){
        echo "<script>alert('Member Added Successfully!'); document.location='manage_users.php'</script>";
    }
}


//edit function
if(isset($_POST['update'])) {
    $member_id = mysqli_real_escape_string($con, $_POST['edit_member_id']);
    $first_name = mysqli_real_escape_string($con, $_POST['edit_first_name']);
    $last_name = mysqli_real_escape_string($con, $_POST['edit_last_name']);
    $gender = mysqli_real_escape_string($con, $_POST['edit_gender']);
    $username = mysqli_real_escape_string($con, $_POST['edit_username']);
    $office_id = mysqli_real_escape_string($con, $_POST['edit_office_id']);
    $salut_id = mysqli_real_escape_string($con, $_POST['edit_salut_id']);
    $rank_id = mysqli_real_escape_string($con, $_POST['edit_rank_id']);
    $designation_id = mysqli_real_escape_string($con, $_POST['edit_designation_id']);

    $update_query = "UPDATE member SET 
        member_first = ?, 
        member_last = ?, 
        member_gender = ?, 
        username = ?, 
        office_id = ?, 
        salut_id = ?, 
        rank_id = ?, 
        designation_id = ? 
        WHERE member_id = ?";
    
    $stmt = $con->prepare($update_query);
    $stmt->bind_param("ssssiiiis", $first_name, $last_name, $gender, $username, 
                      $office_id, $salut_id, $rank_id, $designation_id, $member_id);
    
    if($stmt->execute()){
        echo "<script>alert('Member Updated Successfully!');document.location='manage_users.php'</script>";
    } else {
        echo "<script>alert('Error updating member.');</script>";
    }
    $stmt->close();
}

if(isset($_POST['delete'])){
    $delete_id = $_POST['delete_id'];
    $stmt = $con->prepare("DELETE FROM member WHERE member_id = ?");
    $stmt->bind_param("i", $delete_id); // "i" means integer
    if($stmt->execute()){
        echo "<script>alert('Member Deleted Successfully!');document.location='manage_users.php'</script>";
    } else {
        echo "<script>alert('Error deleting member.');</script>";
    }
    $stmt->close();
}

// Reactivate function
if(isset($_POST['reactivate'])){
    $reactivate_id = $_POST['reactivate_id'];
    $stmt = $con->prepare("UPDATE member SET is_suspended = FALSE, failed_attempts = 0, last_failed_attempt = NULL WHERE member_id = ?");
    $stmt->bind_param("i", $reactivate_id);
    if($stmt->execute()){
        echo "<script>alert('Member Reactivated Successfully!');document.location='manage_users.php'</script>";
    } else {
        echo "<script>alert('Error reactivating member.');</script>";
    }
    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User - <?php include('../components/title.php'); ?></title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../styles/styles.css">
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">
    <link rel="stylesheet" href="../styles/header_style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../styles/darkLight.css">
    <script src="../js/darkLight.js"></script>
</head>
<body>
    <?php include('../components/header_admin.php'); ?>
    <div class="container" style="margin-top: 30px">
        <div class="header-section">
            <h3 class="card-title text-center">Members</h3>
            <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#addMemberModal">
                <i class="fas fa-plus"></i> Add Member
            </button>
        </div>

        <table class="table table-bordered table-hover w-100">
            <thead class="table-light">
                <tr>
                    <th>Name</th>
                    <th>Office</th>
                    <th>Salutation</th>
                    <th>Rank</th>
                    <th>Designation</th>
                    <th>Role</th>
                    <th>Actions</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT m.*, 
                        o.office_name,
                        s.salut,
                        r.rank,
                        d.designation_name
                        FROM member m
                        LEFT JOIN office_name o ON m.office_id = o.office_id
                        LEFT JOIN salut s ON m.salut_id = s.salut_id
                        LEFT JOIN `rank` r ON m.rank_id = r.rank_id
                        LEFT JOIN designation d ON m.designation_id = d.designation_id
                        ORDER BY m.member_id DESC";

                $result = mysqli_query($con, $query);
                if (!$result) {
                    die("Query failed: " . mysqli_error($con));
                }

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>
                            <td>' . $row['member_first'] . ' ' . $row['member_last'] . '</td>
                            <td>' . $row['office_name'] . '</td>
                            <td>' . $row['salut'] . '</td>
                            <td>' . $row['rank'] . '</td>
                            <td>' . $row['designation_name'] . '</td>
                            <td>' . $row['role'] . '</td>
                            <td>
                                <button class="btn btn-primary btn-sm edit-btn" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editMemberModal"
                                    data-id="' . $row['member_id'] . '"
                                    data-first="' . $row['member_first'] . '"
                                    data-last="' . $row['member_last'] . '"
                                    data-gender="' . $row['member_gender'] . '"
                                    data-username="' . $row['username'] . '"
                                    data-office="' . $row['office_id'] . '"
                                    data-salut="' . $row['salut_id'] . '"
                                    data-rank="' . $row['rank_id'] . '"
                                    data-designation="' . $row['designation_id'] . '">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="" method="POST" class="d-inline">
                                    <input type="hidden" name="delete_id" value="' . $row['member_id'] . '">
                                    <button type="submit" name="delete" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this User?\')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                            <td>';
                        if ($row['is_suspended']) {
                            echo '<form action="" method="POST">
                                    <input type="hidden" name="reactivate_id" value="' . $row['member_id'] . '">
                                    <button type="submit" name="reactivate" class="btn btn-warning btn-sm" onclick="return confirm(\'Are you sure you want to reactivate this User?\')">
                                        <i class="fas fa-undo"></i> Reactivate
                                    </button>
                                </form>';
                        } else {
                            echo '<span class="badge bg-success">Active</span>';
                        }
                        echo '</td>
                        </tr>';
                    }
                }
                ?>
            </tbody>
        </table>

    </div>

    <div class="modal fade" id="addMemberModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">First Name</label>
                                <input type="text" name="first_name" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Last Name</label>
                                <input type="text" name="last_name" class="form-control" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Gender</label>
                                <select name="gender" class="form-select" required>
                                    <option value="">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Role</label>
                                <select name="role" class="form-select" required>
                                    <option value="">Select Role</option>
                                    <option value="admin">admin</option>
                                    <option value="user">user</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Office</label>
                                <select name="office_id" class="form-select" required>
                                    <option value="">Select Office</option>
                                    <?php
                                    $query = "SELECT * FROM office_name ORDER BY office_name";
                                    $result = mysqli_query($con, $query);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='".$row['office_id']."'>".$row['office_name']."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Salutation</label>
                                <select name="salut_id" class="form-select" required>
                                    <option value="">Salutation</option>
                                    <?php
                                    $query = "SELECT * FROM salut ORDER BY salut_id";
                                    $result = mysqli_query($con, $query);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='".$row['salut_id']."'>".$row['salut']."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Rank</label>
                                <select name="rank_id" class="form-select" required>
                                    <option value="">Rank</option>
                                    <?php
                                    $query = "SELECT * FROM `rank` ORDER BY rank_id";
                                    $result = mysqli_query($con, $query);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='".$row['rank_id']."'>".$row['rank']."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Designation</label>
                                <select name="designation_id" class="form-select" required>
                                    <option value="">Designation</option>
                                    <?php
                                    $query = "SELECT * FROM designation ORDER BY designation_id";
                                    $result = mysqli_query($con, $query);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='".$row['designation_id']."'>".$row['designation_name']."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Username</label>
                                <input type="text" name="username" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" name="submit" class="btn btn-primary">Add User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

     <!-- Add Edit Member Modal -->
     <div class="modal fade" id="editMemberModal" tabindex="-1" aria-labelledby="editMemberModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editMemberModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <input type="hidden" name="edit_member_id" id="edit_member_id">
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">First Name</label>
                                <input type="text" name="edit_first_name" id="edit_first_name" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Last Name</label>
                                <input type="text" name="edit_last_name" id="edit_last_name" class="form-control" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Gender</label>
                                <select name="edit_gender" id="edit_gender" class="form-select" required>
                                    <option value="">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Office</label>
                                <select name="edit_office_id" id="edit_office_id" class="form-select" required>
                                    <option value="">Select Office</option>
                                    <?php
                                    $query = "SELECT * FROM office_name ORDER BY office_name";
                                    $result = mysqli_query($con, $query);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='".$row['office_id']."'>".$row['office_name']."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Salutation</label>
                                <select name="edit_salut_id" id="edit_salut_id" class="form-select" required>
                                    <option value="">Salutation</option>
                                    <?php
                                    $query = "SELECT * FROM salut ORDER BY salut_id";
                                    $result = mysqli_query($con, $query);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='".$row['salut_id']."'>".$row['salut']."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Rank</label>
                                <select name="edit_rank_id" id="edit_rank_id" class="form-select" required>
                                    <option value="">Rank</option>
                                    <?php
                                    $query = "SELECT * FROM `rank` ORDER BY rank_id";
                                    $result = mysqli_query($con, $query);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='".$row['rank_id']."'>".$row['rank']."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Designation</label>
                                <select name="edit_designation_id" id="edit_designation_id" class="form-select" required>
                                    <option value="">Designation</option>
                                    <?php
                                    $query = "SELECT * FROM designation ORDER BY designation_id";
                                    $result = mysqli_query($con, $query);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='".$row['designation_id']."'>".$row['designation_name']."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Username</label>
                                <input type="text" name="edit_username" id="edit_username" class="form-control" required>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" name="update" class="btn btn-primary">Update User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <?php include '../components/footer.php'; ?>

    <script src="../js/controls.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="../js/notif.js"></script>
    

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let editButtons = document.querySelectorAll(".edit-btn");

            editButtons.forEach(button => {
                button.addEventListener("click", function () {
                    // Get all the data attributes
                    let memberId = this.getAttribute("data-id");
                    let firstName = this.getAttribute("data-first");
                    let lastName = this.getAttribute("data-last");
                    let gender = this.getAttribute("data-gender");
                    let username = this.getAttribute("data-username");
                    let officeId = this.getAttribute("data-office");
                    let salutId = this.getAttribute("data-salut");
                    let rankId = this.getAttribute("data-rank");
                    let designationId = this.getAttribute("data-designation");

                    // Set the values in the edit form
                    document.getElementById("edit_member_id").value = memberId;
                    document.getElementById("edit_first_name").value = firstName;
                    document.getElementById("edit_last_name").value = lastName;
                    document.getElementById("edit_gender").value = gender;
                    document.getElementById("edit_username").value = username;
                    document.getElementById("edit_office_id").value = officeId;
                    document.getElementById("edit_salut_id").value = salutId;
                    document.getElementById("edit_rank_id").value = rankId;
                    document.getElementById("edit_designation_id").value = designationId;
                });
            });
        });
    </script>
</body>
</html>