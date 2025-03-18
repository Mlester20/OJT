<?php
session_start();
include '../components/config.php';

if (!isset($_SESSION['member_id'])) {
    die('Member ID not set in session.');
}

$member_id = $_SESSION['member_id'];
$file_name = ""; // Initialize $file_name to avoid "undefined variable" error

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    $target_dir = "../uploads/";
    $file_name = basename($_FILES["file"]["name"]);
    $target_file = $target_dir . $file_name;
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "<script>alert('Sorry, file already exists.');document.location='upload_file.php'</script>";
        $uploadOk = 0;
    }

    // Check file size (limit: 5MB)
    if ($_FILES["file"]["size"] > 5000000) {
        echo "<script>alert('Sorry, your file is too large.');document.location='upload_file.php'</script>";
        $uploadOk = 0;
    }

    // Allow only specific file formats
    $allowed_types = ["jpg", "png", "jpeg", "gif", "pdf", "doc", "docx", "xls", "xlsx"];
    if (!in_array($fileType, $allowed_types)) {
        echo "<script>alert('Sorry, only JPG, JPEG, PNG, GIF, PDF, DOC, DOCX, XLS, and XLSX files are allowed.');document.location='upload_file.php'</script>";
        $uploadOk = 0;
    }

    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            $file_path = htmlspecialchars($target_file, ENT_QUOTES, 'UTF-8');

            // Insert file info into the database
            $stmt = $con->prepare("INSERT INTO uploads (member_id, file_name, file_path) VALUES (?, ?, ?)");
            if ($stmt === false) {
                die('Database Error: ' . htmlspecialchars($con->error));
            }
            $stmt->bind_param("iss", $member_id, $file_name, $file_path);
            
            if ($stmt->execute()) {
                // Insert notification into the database
                $notif_message = "User " . $member_id . " uploaded a new file: " . $file_name;
                $notif_stmt = $con->prepare("INSERT INTO notifications (member_id, message, is_read, created_at) VALUES (?, ?, 0, NOW())");
                if ($notif_stmt === false) {
                    die('Database Error: ' . htmlspecialchars($con->error));
                }
                $notif_stmt->bind_param("is", $member_id, $notif_message);
                $notif_stmt->execute();
                $notif_stmt->close();

                echo "<script>alert('File Uploaded Successfully!');document.location='upload_file.php'</script>";
            } else {
                echo "<script>alert('Sorry, there was an error uploading your file.');document.location='upload_file.php'</script>";
            }
            $stmt->close();
        } else {
            echo "<script>alert('Sorry, there was an error uploading your file.');document.location='upload_file.php'</script>";
        }
    }
}

// Fetch uploaded files
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
    WHERE 
        u.member_id = ?
";

$stmt = $con->prepare($files_query);
if ($stmt === false) {
    die('Database Error: ' . htmlspecialchars($con->error));
}
$stmt->bind_param("i", $member_id);
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../styles/styles.css">
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../styles/user_header.css">
    <link rel="stylesheet" href="../styles/hover.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

    <?php include '../components/header.php'; ?>

    <div class="container my-5">
        <h3 class="card-title text-center text-muted">Archives</h3>
        <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#uploadModal">
            Upload File
        </button>

        <!-- Upload Modal -->
        <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="uploadModalLabel">Upload File</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="upload_file.php" method="post" enctype="multipart/form-data">
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

        <h4 class="card-title text-muted">Uploaded Files</h4>
        <div class="table-responsive">
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
                <tbody>
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
    </div>

    <?php include '../components/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>