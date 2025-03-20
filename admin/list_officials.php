<?php
session_start();
include '../components/config.php';

if (empty($_SESSION['member_id'])) {
    header('Location: ../index.php');
    exit();
}

// Fetch officials
$officials_query = "
    SELECT 
        o.designation, 
        m.member_first, 
        m.member_last, 
        o.contact_info 
    FROM 
        officials o
    JOIN 
        member m ON o.member_id = m.member_id
";
$stmt = $con->prepare($officials_query);
if ($stmt === false) {
    die('Prepare failed: ' . htmlspecialchars($con->error));
}
$stmt->execute();
$officials_result = $stmt->get_result();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Officials - <?php include '../components/title.php'; ?></title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../styles/styles.css">
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../styles/user_header.css">
    <link rel="stylesheet" href="../styles/hover.css">
    <link rel="stylesheet" href="../styles/darkLight.css">
    <script src="../js/darkLight.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

    <?php include '../components/header.php'; ?>

    <div class="container my-5">
        <h3 class="card-title text-center text-muted">List of Officials (Updated)</h3>
        
        <!-- Form to add new official -->
        <form id="officialForm" class="mb-4">
            <div class="mb-3">
                <label for="member_id" class="form-label">Designation</label>
                <input type="text" class="form-control" id="designation" name="designation" required>
            </div>
            <div class="mb-3">
                <label for="designation" class="form-label">Name of Designation Official</label>
                <input type="text" class="form-control" id="designation_official" name="designation_name" required>
            </div>
            <div class="mb-3">
                <label for="contact_info" class="form-label">Contact Info</label>
                <input type="text" class="form-control" id="contact_info" name="contact_info" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Save Official</button>
        </form>


    </div>

    <?php include '../components/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="../js/notif.js"></script>
    <script>
        $(document).ready(function() {
            $('#officialForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    type: 'POST',
                    url: '../controllers/save_OfficialController.php',
                    data: $(this).serialize(),
                    success: function(response) {
                        alert('Official saved successfully!');
                        location.reload();
                    },
                    error: function() {
                        alert('Error saving official.');
                    }
                });
            });
        });
    </script>
</body>
</html>