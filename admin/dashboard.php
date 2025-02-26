<?php
session_start();
include '../components/config.php';

    if (empty($_SESSION['member_id'])):
        header('Location: ../index.php');
        exit();
    endif;

// Existing queries (same as before)
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

//query for employee with a disability
$employee_query = "SELECT 
    a.*,
    m.member_first,
    m.member_last,
    o.office_name
    FROM employees a
    LEFT JOIN member m ON a.member_id = m.member_id
    LEFT JOIN office_name o ON m.office_id = o.office_id";
$employee_result = mysqli_query($con, $employee_query) or die(mysqli_error($con));

$scholarshipQuery = "SELECT 
                type_of_scholarship,
                SUM(doctorate_male + masters_male + post_baccalaureate_male + baccalaureate_male + non_degree_male) AS male_total,
                SUM(doctorate_female + masters_female + post_baccalaureate_female + baccalaureate_female + non_degree_female) AS female_total,
                SUM(doctorate_total + masters_total + post_baccalaureate_total + baccalaureate_total + non_degree_total) AS overall_total
              FROM scholarship_grants
              GROUP BY type_of_scholarship";

$scholarshipResult = $con->query($scholarshipQuery);

// Check if query executed properly
if (!$scholarshipResult) {
    die("Query Error: " . $con->error); // Output MySQL error
}



//delete function
if (isset($_POST['delete'])) {
    $delete_id = $_POST['delete_id'];

    if (!empty($delete_id)) {
        $stmt = $con->prepare("DELETE FROM awards WHERE id = ?");
        $stmt->bind_param("i", $delete_id);
        if ($stmt->execute()) {
            echo "<script>alert('Award deleted successfully!'); window.location.href='dashboard.php';</script>";
        } else {
            echo "<script>alert('Error deleting award.'); window.location.href='dashboard.php';</script>";
        }
        $stmt->close();
    }
}

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
    <link rel="stylesheet" href="../styles/hover.css">
    <link rel="stylesheet" href="../styles/tableDesign.css">
    <style>
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
        .chart-container {
            max-width: 350px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <?php include('../components/header_admin.php'); ?>

    <div class="container-fluid py-3">
        <h3 class="text-center text-muted my-3">Dashboard</h3>

        <div class="row">
            <!-- Left Column for Top Performing Offices -->
            <div class="col-md-6">
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

            <!-- Right Column for Pie Chart and Stats -->
            <div class="col-md-6">
                <div class="d-flex flex-column align-items-center">
                    <!-- Pie Chart -->
                    <div class="chart-container mt-4">
                        <canvas id="pieChart"></canvas>
                    </div>
                    <!-- Stats below the pie chart -->
                    <div class="d-flex gap-3 mt-4">
                        <div class="card text-white bg-primary shadow-sm" style="width: 10rem;">
                            <div class="card-body text-center">
                                <i class="fas fa-users fa-3x mb-2"></i>
                                <h5>Total Members</h5>
                                <h2><?php echo $total_members; ?></h2>
                            </div>
                        </div>
                        <div class="card text-white bg-success shadow-sm" style="width: 10rem;">
                            <div class="card-body text-center">
                                <i class="fas fa-building fa-3x mb-2"></i>
                                <h5>Total Offices</h5>
                                <h2><?php echo $total_office; ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container my-5">
            <h3 class="card-title text-center text-muted text-md" style="margin-top: 10rem;">Recently Awards Complied</h3>

            <!-- Export Button -->
            <div class="d-flex justify-content-end mb-3">
                <a href="export_excel.php" class="btn btn-success">
                    <i class="fas fa-file-excel"></i> Export
                </a>
            </div>

            <div class="table-responsive" style="margin-top: 2rem;">
                <table class="table table-hover">
                    <thead class="table-secondary">
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
                                <form method="POST" action="dashboard.php" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this award?');">
                                    <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" class="btn btn-sm btn-danger" name="delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>


        <!-- displaying data of employees with special needs -->

        <div class="container my-5">
            <h3 class="card-title text-center text-muted text-md" style="margin-top: 10rem;">Employees</h3>

            <!-- Export Button -->
            <!-- <div class="d-flex justify-content-end mb-3">
                <a href="export_excel.php" class="btn btn-success">
                    <i class="fas fa-file-excel"></i> Export
                </a>
            </div> -->

            <div class="table-responsive" style="margin-top: 2rem;">
                <table class="table table-hover">
                    <thead class="table-secondary">
                        <tr>
                            <th>Name</th>
                            <th>Sex</th>
                            <th>Employment Status</th>
                            <th>Disability Type</th>
                            <th>Campus</th>
                            <th>Member</th>
                            <th>Office</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($employee_result)): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['name']); ?></td>
                                <td><?php echo htmlspecialchars($row['sex']); ?></td>
                                <td><?php echo htmlspecialchars($row['employment_status']); ?></td>
                                <td><?php echo htmlspecialchars($row['disability_type']); ?></td>
                                <td><?php echo htmlspecialchars($row['campus']); ?></td>
                                <td><?php echo htmlspecialchars($row['member_first'] . ' ' . $row['member_last']); ?></td>
                                <td><?php echo htmlspecialchars($row['office_name']); ?></td>
                                <td>
                                    <a href="edit_award.php?id=<?php echo $row['employee_id']; ?>" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" action="dashboard.php" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this award?');">
                                        <input type="hidden" name="delete_id" value="<?php echo $row['employee_id']; ?>">
                                        <button type="submit" class="btn btn-sm btn-danger" name="delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="container my-5">
            <h3 class="card-title text-center text-muted text-md" style="margin-top: 10rem;">Total of Scholarship Grants</h3>

            <div class="table-responsive" style="margin-top: 2rem;">
                <table class="table table-hover">
                    <thead class="table-secondary">
                        <tr>
                        <th>Scholarship Type</th>
                        <th>Male Scholars</th>
                        <th>Female Scholars</th>
                        <th>Total Scholars</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = $scholarshipResult->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['type_of_scholarship']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['male_total']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['female_total']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['overall_total']) . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>

                </table>
            </div>
        </div>

    </div>

    <script>
        const officeNames = <?php echo json_encode(array_column($office_data, 'office_name')); ?>;
        const complianceCounts = <?php echo json_encode(array_column($office_data, 'compliance_count')); ?>;

        const ctx = document.getElementById('pieChart').getContext('2d');
        const pieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: officeNames, 
                datasets: [{
                    label: 'Office Compliance Count',
                    data: complianceCounts, 
                    backgroundColor: ['#007bff', '#28a745', '#dc3545', '#ffc107', '#17a2b8'],
                    borderColor: ['#0056b3', '#218838', '#a71d2a', '#d39e00', '#10707f'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw + ' compliances';
                            }
                        }
                    }
                }
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="../js/datas.js"></script>

</body>
</html>