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
    <title>Archives - <?php include '../components/title.php'; ?></title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/styles.css">
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">
</head>
<body>

    <?php include '../components/header_admin.php'; ?>

    <div class="container my-5">
        <h3 class="card-title text-center text-muted text-md" style="margin-top: 1rem;">Your Archives this <?= date('Y'); ?></h3>
        
        <div class="row" style="margin-top: 2rem;">
            <!-- Awards Section -->
            <div class="col-md-4 mb-3">
                <div class="card h-100">
                    <div class="card-body">
                        <h4 class="card-title">Awards</h4>
                        <p class="card-text">View and export awards data.</p>
                        <!-- <a href="view_awards.php" class="btn btn-primary">
                            <i class="fas fa-eye"></i> View this data
                        </a> -->
                        <a href="export_excel.php" class="btn btn-success">
                            <i class="fas fa-file-excel"></i> Export as Excel
                        </a>
                    </div>
                </div>
            </div>

            <!-- Non-Academic Staff Section -->
            <div class="col-md-4 mb-3">
                <div class="card h-100">
                    <div class="card-body">
                        <h4 class="card-title">Non-Academic Staff</h4>
                        <p class="card-text">View and export non-academic staff data.</p>
                        <!-- <a href="view_non_academic_staff.php" class="btn btn-primary">
                            <i class="fas fa-eye"></i> View this data
                        </a> -->
                        <a href="download_non_academic_staff.php" class="btn btn-success">
                            <i class="fas fa-file-download"></i> Export as Excel
                        </a>
                    </div>
                </div>
            </div>

            <!-- Employees Section -->
            <div class="col-md-4 mb-3">
                <div class="card h-100">
                    <div class="card-body">
                        <h4 class="card-title">Employees</h4>
                        <p class="card-text">View and export employees data.</p>
                        <!-- <a href="view_employees.php" class="btn btn-primary">
                            <i class="fas fa-eye"></i> View this data
                        </a> -->
                        <a href="../exports/export_employees.php" class="btn btn-success">
                            <i class="fas fa-file-excel"></i> Export as Excel
                        </a>
                    </div>
                </div>
            </div>

            <!-- Scholarship Grants Section -->
            <div class="col-md-4 mb-3">
                <div class="card h-100">
                    <div class="card-body">
                        <h4 class="card-title">Scholarship Grants</h4>
                        <p class="card-text">View and export scholarship grants data.</p>
                        <!-- <a href="view_scholarship_grants.php" class="btn btn-primary">
                            <i class="fas fa-eye"></i> View this data
                        </a> -->
                        <a href="../exports/export_scholarship_grants.php" class="btn btn-success">
                            <i class="fas fa-file-excel"></i> Export as Excel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>