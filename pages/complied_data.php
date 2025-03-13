<?php
include '../controllers/fetch_complied_data.php';
include '../controllers/purchaseController.php';

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complied Data - <?php include '../components/title.php'; ?> </title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../styles/styles.css">
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../styles/user_header.css">
    <link rel="stylesheet" href="../styles/hover.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .section-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #0056b3;
            margin-top: 2rem;
            margin-bottom: 1rem;
            text-align: center;
        }
        .container {
            margin-top: 2rem;
        }
        .table {
            margin-top: 2rem;
        }
    </style>
</head>
<body>

    <?php include '../components/header.php'; ?>

    <div class="container my-5">
        <h1 class="h2 mb-4 text-center">Complied Data</h1>
        
        <h2 class="section-title">Awards</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Award</th>
                    <th>Conferred To</th>
                    <th>Conferred By</th>
                    <th>Date</th>
                    <th>Date Ended</th>
                    <th>Venue</th>
                    <th>Category</th>
                    <th>Year</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($awards_result && mysqli_num_rows($awards_result) > 0) {
                    while ($row = mysqli_fetch_assoc($awards_result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['award']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['conferred_to']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['conferred_by']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['date']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['date_ended']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['venue']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['category']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['year']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No awards data found.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <h2 class="section-title">Employees</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Sex</th>
                    <th>Status</th>
                    <th>Disability</th>
                    <th>Campus</th>
                    <th>Year</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($employee_result && mysqli_num_rows($employee_result) > 0) {
                    while ($row = mysqli_fetch_assoc($employee_result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['sex']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['employment_status']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['disability_type']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['campus']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['year']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No employees data found.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <h2 class="section-title">Faculty Scholarship Grants</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Type of Scholarship</th>
                    <th>Male Total</th>
                    <th>Female Total</th>
                    <th>Overall Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($facultyScholarshipResult && mysqli_num_rows($facultyScholarshipResult) > 0) {
                    while ($row = mysqli_fetch_assoc($facultyScholarshipResult)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['type_of_scholarship']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['male_total']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['female_total']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['overall_total']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No faculty scholarship grants data found.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <h2 class="section-title">Non-Academic Staff Scholarship Grants</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Type of Scholarship</th>
                    <th>Male Total</th>
                    <th>Female Total</th>
                    <th>Overall Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($nonAcademicScholarshipResult && mysqli_num_rows($nonAcademicScholarshipResult) > 0) {
                    while ($row = mysqli_fetch_assoc($nonAcademicScholarshipResult)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['type_of_scholarship']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['male_total']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['female_total']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['overall_total']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No non-academic staff scholarship grants data found.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <h2 class="section-title">Non-Academic Staff Details</h2>
        <table class="table table-bordered">
            <thead>
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
                if ($non_academic_staff_result && mysqli_num_rows($non_academic_staff_result) > 0) {
                    while ($row = mysqli_fetch_assoc($non_academic_staff_result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['category']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['sub_category']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['male_count']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['female_count']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['total_count']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No non-academic staff details found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        
        <div class="table-responsive">
            <h3 class="card-title text-center section-title">Major Purchases</h3>
            <table class="table table-bordered" style="margin-top: 2rem;">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Purpose</th>
                        <th>Amount</th>
                        <th>Purchase Date</th>
                        <th>Complied By</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($purchases_result && mysqli_num_rows($purchases_result) > 0) {
                        while ($row = mysqli_fetch_assoc($purchases_result)) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['item']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['purpose']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['amount']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['purchase_date']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['member_first'] . ' ' . $row['member_last']) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No purchases found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php include '../components/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>