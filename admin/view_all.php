<?php
session_start();
include '../components/config.php';
include '../controllers/fetch_data.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View All - <?php include '../components/title.php'; ?></title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.min.js"></script>
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">
    <link rel="stylesheet" href="../styles/hover.css">
    <link rel="stylesheet" href="../styles/tableDesign.css">
</head>
<body>

    <?php include '../components/header_admin.php'; ?>

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

        <div class="container my-5">
            <h3 class="card-title text-center text-muted text-md" style="margin-top: 10rem;">Employees</h3>

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
            <h3 class="card-title text-center text-muted text-md" style="margin-top: 10rem;">Total of Scholarship Grants for Faculty</h3>

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
                        while ($row = $facultyScholarshipResult->fetch_assoc()) {
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

        <div class="container my-5">
            <h3 class="card-title text-center text-muted text-md" style="margin-top: 10rem;">Total of Scholarship Grants for Non-Academic Staff</h3>

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
                        while ($row = $nonAcademicScholarshipResult->fetch_assoc()) {
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

        <div class="container my-5">
            <h3 class="card-title text-center text-muted">Total of Non Academic Staff</h3>
            <div class="d-flex justify-content-end mb-3">
                <a href="download_non_academic_staff.php" class="btn btn-success">
                    <i class="fas fa-file-download"></i> Download CSV
                </a>
            </div>
            <div class="table-responsive" style="margin-top: 2rem;">
                <table class="table table-hover">
                    <thead class="table-secondary">
                        <tr>
                            <th>Category</th>
                            <th>Sub Category</th>
                            <th>Male Count</th>
                            <th>Female Count</th>
                            <th>Total Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($non_academic_staff_result)) {
                            echo "<tr>
                                <td>{$row['category']}</td>
                                <td>{$row['sub_category']}</td>
                                <td>{$row['male_count']}</td>
                                <td>{$row['female_count']}</td>
                                <td>{$row['total_count']}</td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    
</body>
</html>