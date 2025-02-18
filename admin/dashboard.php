<?php
session_start();
include '../components/config.php';
    if (empty($_SESSION['user_id'])):
        header('Location: index.php');
        exit();
    endif;

    $query = "SELECT COUNT(*) as total_members FROM member";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $total_members = $row['total_members'];

    //count from office table

    $query = mysqli_query($con, "SELECT COUNT(*) as total_office FROM office_name ") or die(mysqli_error($con));
    $row = mysqli_fetch_assoc($query);
    $total_office = $row['total_office'];

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
        .card {
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }
        .priority-badge {
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 11px;
        }
        .priority-low {
            background-color: #0dcaf0;
            color: white;
        }
        .priority-medium {
            background-color: #6c757d;
            color: white;
        }
        .priority-high {
            background-color: #ffc0cb;
            color: #333;
        }
        .chart-container {
            height: 200px;
        }
        .table td, .table th {
            padding: 0.5rem;
            font-size: 0.9rem;
        }
        .site-footer {
            background-color: #333;
            color: white;
            padding: 40px 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .footer-info {
            flex: 2;
        }

        .footer-info h2 {
            font-size: 24px;
            margin-bottom: 10px;
            color: #fff;
        }

        .tagline {
            font-style: italic;
            color: #ccc;
            margin-bottom: 20px;
        }

        .contact-link a {
            color: white;
            text-decoration: none;
        }

        .contact-link a:hover {
            text-decoration: underline;
        }

        .copyright {
            color: #ccc;
            margin: 10px 0;
        }

        .visitor-stats {
            margin-top: 20px;
            color: #ccc;
        }

        .visitor-stats p {
            margin: 5px 0;
        }

        .footer-logo {
            flex: 1;
            text-align: right;
        }

        .footer-logo img {
            max-width: 150px;
            height: auto;
        }

        .social-links {
            position: absolute;
            right: 20px;
            margin-top: 200px;
            display: flex;
            gap: 10px;
        }

        .social-icon {
            display: inline-block;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            transition: transform 0.3s ease;
        }

        .social-icon:hover {
            transform: translateY(-3px);
        }

        .social-icon img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        @media (max-width: 768px) {
            .footer-content {
                flex-direction: column;
                text-align: center;
            }
            
            .footer-logo {
                margin-top: 20px;
                text-align: center;
            }
            
            .social-links {
                position: static;
                margin-top: 20px;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <?php include('../components/header_admin.php'); ?>

    <div class="container-fluid py-3">
        <h3 class="text-center text-muted my-3">Dashboard</h3>
        
        <div class="row g-3">
            <!-- Left Panel (Top Office/Department) -->
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="card-title mb-0">Top Office/Department/Unit to Complied</h6>
                            <button class="btn btn-link p-0"><i class="fas fa-ellipsis-v"></i></button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Assigned</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>
                                            <div>Sunil Joshi</div>
                                            <small class="text-muted">QA</small>
                                        </td>
                                        <td>Elite Admin</td>
                                        <td><span class="badge bg-success">Low</span></td>
                                        <td class="text-danger">Not complied</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>
                                            <div>Andrew McDownland</div>
                                            <small class="text-muted">Project Manager</small>
                                        </td>
                                        <td>Real Homes WP</td>
                                        <td><span class="badge bg-warning text-dark">Medium</span></td>
                                        <td class="text-success">Complied</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>
                                            <div>Christopher Jamil</div>
                                            <small class="text-muted">Project Manager</small>
                                        </td>
                                        <td>MedicalPro WP</td>
                                        <td><span class="badge bg-danger">High</span></td>
                                        <td class="text-success">Complied</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Panel (Accomplishment) -->
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h6 class="card-title">Accomplishment</h6>
                        <i class="fas fa-chart-line fa-3x text-primary mb-2"></i>
                        <h4>Progress</h4>
                        <small class="text-success">+9% last year</small>
                        <div class="chart-container mt-3">
                            <canvas id="trafficChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="d-flex gap-3">
                <!-- Total Members -->
                <div class="card text-white bg-primary shadow-sm" style="width: 15rem;">
                    <div class="card-body text-center">
                        <i class="fas fa-users fa-3x mb-2"></i>
                        <h3>Total Members</h3>
                        <h2><?php echo $total_members; ?></h2>
                    </div>
                </div>

                <!-- Total Offices -->
                <div class="card text-white bg-success shadow-sm" style="width: 15rem;">
                    <div class="card-body text-center">
                        <i class="fas fa-building fa-3x mb-2"></i>
                        <h3>Total Offices</h3>
                        <h2><?php echo $total_office; ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="container d-flex justify-content-center">
        <div class="p-4 rounded shadow" style="background-color: #f8f9fa; max-width: 800px; width: 100%; margin-top: 30px;">
            <h3 class="card-title text-center text-muted">List of Offices/Department Complied</h3>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src='../js/modal.js'></script>
    <script src="../js/data.js"></script>

</body>
</html>