<?php
session_start();
include '../components/config.php';

if (!isset($_SESSION['member_id'])) {
    die('Member ID not set in session.');
}

$member_id = $_SESSION['member_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (file_exists($target_file)) {
        echo "<script>alert('Sorry, file already exists.');document.location='upload.php'</script>";
        $uploadOk = 0;
    }

    if ($_FILES["file"]["size"] > 5000000) {
        echo "<script>alert('Sorry, your file is too large.');document.location='upload.php'</script>";
        $uploadOk = 0;
    }

    $allowed_types = array("jpg", "png", "jpeg", "gif", "pdf", "doc", "docx", "xls", "xlsx");
    if (!in_array($fileType, $allowed_types)) {
        echo "<script>alert('Sorry, only JPG, JPEG, PNG, GIF, PDF, DOC, DOCX, XLS, and XLSX files are allowed.');document.location='upload.php'</script>";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "<script>alert('Sorry, your file was not uploaded.');document.location='upload.php'</script>";
    } else {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            $file_name = basename($_FILES["file"]["name"]);
            $file_path = $target_file;

            // Insert file info into database
            $stmt = $con->prepare("INSERT INTO uploads (member_id, file_name, file_path) VALUES (?, ?, ?)");
            if ($stmt === false) {
                die('Prepare failed: ' . htmlspecialchars($con->error));
            }
            $stmt->bind_param("iss", $member_id, $file_name, $file_path);
            if ($stmt->execute()) {
                echo "<script>alert('File Uploaded Successfully!');document.location='upload.php'</script>";
            } else {
                echo "<script>alert('Sorry, there was an error uploading your file.');document.location='upload.php'</script>";
            }
            $stmt->close();
        } else {
            echo "<script>alert('Sorry, there was an error uploading your file.');document.location='upload.php'</script>";
        }
    }
}

// Fetch all uploaded files
$files_query = "
    SELECT 
        u.file_name, 
        u.file_path, 
        u.upload_date, 
        m.member_first, 
        m.member_last, 
        o.office_name 
    FROM 
        uploads u
    JOIN 
        member m ON u.member_id = m.member_id
    JOIN 
        office_name o ON m.office_id = o.office_id
";
$stmt = $con->prepare($files_query);
if ($stmt === false) {
    die('Prepare failed: ' . htmlspecialchars($con->error));
}
$stmt->execute();
$files_result = $stmt->get_result();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Files - <?php include '../components/title.php'; ?></title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/styles.css">
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">
</head>
<body>

    <?php include '../components/header_admin.php'; ?>

    <div class="container my-5">
        <h3 class="text-center">Archives</h3>
        <!-- Upload Modal -->
        <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="uploadModalLabel">Upload File</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="upload.php" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="file" class="form-label">Choose file to upload:</label>
                                <input type="file" class="form-control" id="file" name="file" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search Input -->
        <div class="row justify-content-between align-items-center" style="margin-top: 2rem;">
            <div class="col-auto">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadModal">
                    Upload File
                </button>
            </div>
            <div class="col-md-4">
                <input type="text" id="searchInput" class="form-control" placeholder="Search Files...">
            </div>
        </div>




        <h4 class="card-title text-muted text-center text-success" style="margin-top: 2rem;">Uploaded Files</h4>
        <table class="table table-bordered" style="margin-top: 2rem;">
            <thead>
                <tr>
                    <th>File Name</th>
                    <th>Upload Date</th>
                    <th>Member Name</th>
                    <th>Office</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="fileTableBody">
                <?php
                if ($files_result && mysqli_num_rows($files_result) > 0) {
                    while ($row = mysqli_fetch_assoc($files_result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['file_name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['upload_date']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['member_first'] . ' ' . $row['member_last']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['office_name']) . "</td>";
                        echo "<td><a href='" . htmlspecialchars($row['file_path']) . "' download class='btn btn-success btn-sm'>Download</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No files uploaded yet.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('#fileTableBody tr');

            rows.forEach(function(row) {
                let fileName = row.cells[0].textContent.toLowerCase();
                let memberName = row.cells[2].textContent.toLowerCase();
                let officeName = row.cells[3].textContent.toLowerCase();
                if (fileName.includes(filter) || memberName.includes(filter) || officeName.includes(filter)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>