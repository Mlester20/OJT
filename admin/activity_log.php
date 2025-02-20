<?php
session_start();
include '../components/config.php';

if (empty($_SESSION['member_id'])):
    header('Location: ../index.php');
    exit();
endif;

// Set pagination variables
$limit = 10; // Entries per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Fetch total number of entries
$total_query = "SELECT COUNT(*) as total FROM member_activityLog";
$total_result = mysqli_query($con, $total_query);
$total_row = mysqli_fetch_assoc($total_result);
$total_entries = $total_row['total'];
$total_pages = ceil($total_entries / $limit);

// Fetch paginated activity logs
$query = "SELECT mal.*, m.member_first, m.member_last, o.office_name, mal.office_address 
          FROM member_activityLog mal
          JOIN member m ON mal.member_id = m.member_id
          JOIN office_name o ON mal.office_id = o.office_id
          ORDER BY mal.login_datetime DESC
          LIMIT $start, $limit";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity Log</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../styles/styles.css">
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">
</head>
<body>

    <?php include '../components/header_admin.php'; ?>

    <div class="container mt-5">
        <h3 class="card-title card-muted text-center">Recent Member Activity Log</h3>
        <table class="table table-bordered" style="margin-top: 10px;">
            <thead>
                <tr>
                    <th>Users</th>
                    <th>Office</th>
                    <th>Office Address</th>
                    <th>Login Date & Time</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['member_first'] . ' ' . $row['member_last']; ?></td>
                        <td><?php echo $row['office_name']; ?></td>
                        <td><?php echo isset($row['office_address']) ? $row['office_address'] : 'N/A'; ?></td>
                        <td><?php echo $row['login_datetime']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <nav>
            <ul class="pagination justify-content-center">
                <?php if ($page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=1">First</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $page - 1; ?>">Previous</a>
                    </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($page < $total_pages): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $page + 1; ?>">Next</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $total_pages; ?>">Last</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>

    </div>

</body>
</html>
