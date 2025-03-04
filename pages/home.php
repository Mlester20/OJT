<?php
session_start();
include '../components/config.php';

// Get current user's member_id from session
$member_id = $_SESSION['member_id'];
$currentYear = date('Y');

// Modified query to filter by member_id
$sql = "SELECT 
            category,
            COUNT(*) as count 
        FROM awards 
        WHERE YEAR(date) = ? 
        AND member_id = ?
        GROUP BY category";
$stmt = $con->prepare($sql);
$stmt->bind_param("ss", $currentYear, $member_id);
$stmt->execute();
$result = $stmt->get_result();

$categories = [
    'Local' => 0,
    'Regional' => 0,
    'National' => 0,
    'International' => 0
];

$totalAwards = 0;
while ($row = $result->fetch_assoc()) {
    $categories[$row['category']] = $row['count'];
    $totalAwards += $row['count'];
}

// Calculate percentages
$targetTotal = 100;
$currentProgress = ($totalAwards / 16) * 100;
$currentProgress = min(100, $currentProgress);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - <?php include '../components/title.php'; ?></title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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

    <div class="container mt-5">
        <h3 class="card-title text-center text-muted mb-4">My Accomplishment this Year <?= date('Y'); ?></h3>
        
        <!-- Overall Progress Card -->
        <div class="row justify-content-center mb-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Overall Progress</h5>
                        <div class="progress" style="height: 25px;">
                            <div class="progress-bar bg-success" 
                                 role="progressbar" 
                                 style="width: <?= $currentProgress ?>%;" 
                                 aria-valuenow="<?= $currentProgress ?>" 
                                 aria-valuemin="0" 
                                 aria-valuemax="100">
                                <?= number_format($currentProgress, 1) ?>%
                            </div>
                        </div>
                        <p class="mt-2 text-center">Total Accomplishments: <?= $totalAwards ?> out of 16</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <!-- Category Cards -->
            <div class="col-md-8">
                <div class="row">
                    <?php foreach ($categories as $category => $count): ?>
                    <div class="col-md-6 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?= $category ?></h5>
                                <div class="progress mb-2">
                                    <div class="progress-bar" 
                                         role="progressbar" 
                                         style="width: <?= ($count / 4) * 100 ?>%;" 
                                         aria-valuenow="<?= ($count / 4) * 100 ?>" 
                                         aria-valuemin="0" 
                                         aria-valuemax="100">
                                        <?= ($count / 4) * 100 ?>%
                                    </div>
                                </div>
                                <p class="card-text text-center"><?= $count ?> / 4</p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Smaller Pie Chart -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Category Distribution</h5>
                        <div style="height: 200px;"> <!-- Control pie chart height -->
                            <canvas id="categoryPieChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include '../components/footer.php'; ?>

    <script>
    // Pie Chart initialization with smaller size
    const ctx = document.getElementById('categoryPieChart').getContext('2d');
    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: <?= json_encode(array_keys($categories)) ?>,
            datasets: [{
                data: <?= json_encode(array_values($categories)) ?>,
                backgroundColor: [
                    '#FF6384',
                    '#36A2EB',
                    '#FFCE56',
                    '#4BC0C0'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>