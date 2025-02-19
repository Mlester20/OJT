<?php
session_start();
include '../components/config.php';


if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}


$member_id = $_SESSION["member_id"] ?? null;

if (!$member_id) {
    die("Error: Member ID not found in session.");
}


$query = "SELECT * FROM awards WHERE member_id = ?";
$stmt = $con->prepare($query);

if (!$stmt) {
    die("SQL error: " . $con->error);
}

$stmt->bind_param("i", $member_id);
$stmt->execute();
$result = $stmt->get_result();

$accomplishments = [];
while ($row = $result->fetch_assoc()) {
    $accomplishments[] = $row;
}

$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Home -  <?php include '../components/title.php'; ?></title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../styles/styles.css">
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../styles/user_header.css">
    <link rel="stylesheet" href="../styles/hover.css">
</head>
<body>
    
    <?php include '../components/header.php'; ?>

    <div class="container mt-4">
        <h3 class="card-title text-center text-muted">My Accomplishments</h3>

        <?php if (!empty($accomplishments)) : ?>
            <div class="table-responsive mt-3">
                <table class="table table-striped table-bordered text-center">
                    <thead class="text-light">
                        <tr>
                            <th>#</th>
                            <th>Award</th>
                            <th>Conferred To</th>
                            <th>Conferred By</th>
                            <th>Date</th>
                            <th>Venue</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($accomplishments as $index => $accomplishment) : ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= htmlspecialchars($accomplishment['award']) ?></td>
                                <td><?= htmlspecialchars($accomplishment['conferred_to']) ?></td>
                                <td><?= htmlspecialchars($accomplishment['conferred_by']) ?></td>
                                <td><?= date("F d, Y", strtotime($accomplishment['date'])) ?></td>
                                <td><?= htmlspecialchars($accomplishment['venue']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else : ?>
            <p class="text-center text-muted mt-3">No accomplishments found.</p>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
