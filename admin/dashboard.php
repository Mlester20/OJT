<?php
session_start();
include '../components/config.php';
if (empty($_SESSION['user_id'])):
    header('Location: index.php');
    exit();
endif;

// Existing queries
$query = "SELECT COUNT(*) as total_members FROM member";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);
$total_members = $row['total_members'];

$query = mysqli_query($con, "SELECT COUNT(*) as total_office FROM office_name") or die(mysqli_error($con));
$row = mysqli_fetch_assoc($query);
$total_office = $row['total_office'];

// New query for office compliance statistics
$office_compliance_query = "SELECT 
    o.office_name,
    COUNT(a.id) as compliance_count
    FROM office_name o
    LEFT JOIN member m ON o.office_id = m.office_id
    LEFT JOIN awards a ON m.member_id = a.member_id
    GROUP BY o.office_id, o.office_name
    ORDER BY compliance_count DESC
    LIMIT 5";
$office_compliance_result = mysqli_query($con, $office_compliance_query);

// Original awards query
$awards_query = "SELECT 
    a.*,
    m.member_first,
    m.member_last,
    o.office_name
    FROM awards a
    LEFT JOIN member m ON a.member_id = m.member_id
    LEFT JOIN office_name o ON m.office_id = o.office_id
    ORDER BY a.date DESC";
$awards_result = mysqli_query($con, $awards_query) or die(mysqli_error($con));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - <?php include('../components/title.php'); ?></title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.min.js"></script>
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">
    <style>
        /* Keep existing styles and add: */
        .compliance-card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 20px;
            margin-bottom: 20px;
        }
        .compliance-bar {
            height: 20px;
            background: #e9ecef;
            border-radius: 10px;
            margin-top: 5px;
        }
        .compliance-fill {
            height: 100%;
            background: #0d6efd;
            border-radius: 10px;
            transition: width 0.5s ease-in-out;
        }
    </style>

</head>
<body>
    <?php include('../components/header_admin.php'); ?>

    <div class="container-fluid py-3">
        <h3 class="text-center text-muted my-3">Dashboard</h3>

        <!-- New Top Offices Section -->
        <div class="container mt-4">
            <div class="p-4 rounded shadow" style="background-color: #f8f9fa;">
                <h3 class="text-center text-muted mb-4">Top Performing Offices</h3>
                
                <div class="row">
                    <?php 
                    // Get the highest compliance count for percentage calculation
                    $max_compliance = 0;
                    $office_data = array();
                    while($office_row = mysqli_fetch_assoc($office_compliance_result)) {
                        $office_data[] = $office_row;
                        if($office_row['compliance_count'] > $max_compliance) {
                            $max_compliance = $office_row['compliance_count'];
                        }
                    }
                    
                    // Display office compliance data
                    foreach($office_data as $office): 
                        $percentage = ($max_compliance > 0) ? ($office['compliance_count'] / $max_compliance) * 100 : 0;
                    ?>
                    <div class="col-md-6 mb-3">
                        <div class="compliance-card">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0"><?php echo htmlspecialchars($office['office_name']); ?></h5>
                                <span class="badge bg-primary"><?php echo $office['compliance_count']; ?> compliances</span>
                            </div>
                            <div class="compliance-bar">
                                <div class="compliance-fill" style="width: <?php echo $percentage; ?>%"></div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="row" style="margin-left: 5rem; margin-top: 20px;">
            <div class="d-flex gap-3">
                <!-- Existing stat cards -->
                <div class="card text-white bg-primary shadow-sm" style="width: 15rem;">
                    <div class="card-body text-center">
                        <i class="fas fa-users fa-3x mb-2"></i>
                        <h3>Total Members</h3>
                        <h2><?php echo $total_members; ?></h2>
                    </div>
                </div>

                <div class="card text-white bg-success shadow-sm" style="width: 15rem;">
                    <div class="card-body text-center">
                        <i class="fas fa-building fa-3x mb-2"></i>
                        <h3>Total Offices</h3>
                        <h2><?php echo $total_office; ?></h2>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="container d-flex justify-content-center">
                <div class="p-4 rounded shadow" style="background-color: #f8f9fa; max-width: 800px; width: 100%; margin-top: 30px;">
                    <h3 class="card-title text-center text-muted">List of Offices/Department Complied</h3>
                </div>
            </div>

            <div class="container my-5">
                <div class="table-responsive mt-4">
                    <table class="table table-hover">`
                        <thead>
                            <tr>
                                <th>Award</th>
                                <th>Conferred To</th>
                                <th>Conferred By</th>
                                <th>Date</th>
                                <th>Venue</th>
                                <th>Member Name</th>
                                <th>Office</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = mysqli_fetch_assoc($awards_result)): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['award']); ?></td>
                                <td><?php echo htmlspecialchars($row['conferred_to']); ?></td>
                                <td><?php echo htmlspecialchars($row['conferred_by']); ?></td>
                                <td><?php echo date('M d, Y', strtotime($row['date'])); ?></td>
                                <td><?php echo htmlspecialchars($row['venue']); ?></td>
                                <td><?php echo htmlspecialchars($row['member_first'] . ' ' . $row['member_last']); ?></td>
                                <td><?php echo htmlspecialchars($row['office_name']); ?></td>
                                <td>
                                    <a href="edit_award.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="delete_award.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this award?');">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>    
            </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src='../js/modal.js'></script>
    <script src="../js/data.js"></script>



</body>
</html>