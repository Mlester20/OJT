<?php
session_start();

if (empty($_SESSION['user_id'])):
    header('Location:../index.php');
endif;
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
        <h3 class="card-title text-center text-muted"  style="margin-top: 20px;">Dashboard</h3>
        <div class="row g-3"  style="margin-top: 10px;">
            <!-- Top Paying Clients -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="card-title mb-0">Top Office/Department/Unit to Complied</h6>
                            <button class="btn btn-link p-0">⋮</button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Id</th>
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
                                            <small class="text-muted">Qa</small>
                                        </td>
                                        <td>Elite Admin</td>
                                        <td><span class="priority-badge priority-low">Low</span></td>
                                        <td>Not complied</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>
                                            <div>Andrew McDownland</div>
                                            <small class="text-muted">Project Manager</small>
                                        </td>
                                        <td>Real Homes WP Theme</td>
                                        <td><span class="priority-badge priority-medium">Medium</span></td>
                                        <td>Complied</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>
                                            <div>Christopher Jamil</div>
                                            <small class="text-muted">Project Manager</small>
                                        </td>
                                        <td>MedicalPro WP Theme</td>
                                        <td><span class="priority-badge priority-high">High</span></td>
                                        <td>Complied</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Traffic Distribution -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Accomplishment</h6>
                        <div class="text-center mb-2">
                            <h4></h4>
                            <small class="text-success">+9% last year</small>
                        </div>
                        <div class="chart-container">
                            <canvas id="trafficChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container" style="margin-top: 10px;">
        <h4 class="card-title text-center text-muted">Accomplishment</h4>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src='../js/modal.js'></script>
    
    <script>
        // Traffic Distribution Chart
        const trafficCtx = document.getElementById('trafficChart').getContext('2d');
        new Chart(trafficCtx, {
            type: 'doughnut',
            data: {
                labels: ['Organic', 'Referral'],
                datasets: [{
                    data: [60, 40],
                    backgroundColor: ['#0d6efd', '#ffc0cb']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: {
                                size: 11
                            }
                        }
                    }
                }
            }
        });
    </script>

    <script src="../js/script.js"></script>

</body>
</html>