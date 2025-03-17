<?php
session_start();
include '../components/config.php';
include '../controllers/fetch_data.php';

if (!isset($_SESSION['member_id'])) {
    header('Location: ../index.php');
}

// Fetch the list of offices
$offices_query = "SELECT office_name FROM office_name";
$offices_result = mysqli_query($con, $offices_query);

// Fetch all awards data
$awards_query = "SELECT award, conferred_to, conferred_by, date, date_ended, venue, category, year, member_first, member_last, office_name 
                 FROM awards 
                 JOIN member ON awards.member_id = member.member_id 
                 JOIN office_name ON member.office_id = office_name.office_id";
$awards_result = mysqli_query($con, $awards_query);
$awards_data = [];
if ($awards_result && mysqli_num_rows($awards_result) > 0) {
    while ($row = mysqli_fetch_assoc($awards_result)) {
        $awards_data[] = $row;
    }
}
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
    <link rel="stylesheet" href="../styles/hover.css">
    <style>
        .section-title {
            text-align: center;
            margin-top: 2rem;
        }
        @media print {
            @page {
            margin: 0; /* Remove default margins */
            }
            body {
            margin: 0;
            padding: 0;
            }
            header, footer {
            display: none; /* Hide header and footer */
            }
        }
    </style>
</head>
<body>

    <?php include '../components/header_admin.php'; ?>

    <div class="container my-5">
        <h1 class="h2 mb-4 text-center text-primary">List of Complied Data</h1>

        <h2 class="section-title">Awards</h2>
        <div class="text-end mb-3 d-flex flex-column flex-md-row align-items-md-center gap-2">
            <select id="officeSelect" class="form-select w-100 w-md-auto">
                <option value="">Select Office</option>
                <?php
                if ($offices_result && mysqli_num_rows($offices_result) > 0) {
                    while ($office = mysqli_fetch_assoc($offices_result)) {
                        echo '<option value="' . htmlspecialchars($office['office_name']) . '">' . htmlspecialchars($office['office_name']) . '</option>';
                    }
                }
                ?>
            </select>
            <button id="printButton" class="btn btn-primary w-100 w-md-auto" onclick="printAwards()">Print Awards</button>
        </div>

        <div class="table-responsive">
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
                        <th>Member First</th>
                        <th>Member Last</th>
                        <th>Office Name</th>
                    </tr>
                </thead>
                <tbody id="awardsTableBody">
                    <?php
                    if (!empty($awards_data)) {
                        foreach ($awards_data as $row) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['award']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['conferred_to']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['conferred_by']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['date']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['date_ended']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['venue']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['category']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['year']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['member_first']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['member_last']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['office_name']) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='11' class='text-center'>No awards data found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <h2 class="section-title">Employees</h2>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Sex</th>
                        <th>Status</th>
                        <th>Disability</th>
                        <th>Campus</th>
                        <th>Year</th>
                        <th>Member First</th>
                        <th>Member Last</th>
                        <th>Office Name</th>
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
                            echo "<td>" . htmlspecialchars($row['member_first']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['member_last']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['office_name']) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='9' class='text-center'>No employees data found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

    <h2 class="section-title">Faculty Scholarship Grants</h2>
    <div class="table-responsive">
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
                    echo "<tr><td colspan='4' class='text-center'>No faculty scholarship grants data found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <h2 class="section-title">Non-Academic Staff Scholarship Grants</h2>
    <div class="table-responsive">
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
                    echo "<tr><td colspan='4' class='text-center'>No non-academic staff scholarship grants data found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <h2 class="section-title">Non-Academic Staff Details</h2>
    <div class="table-responsive">
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
                    echo "<tr><td colspan='5' class='text-center'>No non-academic staff details found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>


    <?php include '../components/footer.php'; ?>

    <script>
        const awardsData = <?php echo json_encode($awards_data); ?>;

        // Define a mapping of office names to image paths
        const officeImages = {
            'College of Criminal Justice Education': ['../images/ccje.jpg', '../images/isu-logo.png'],
            'Institute of Information and Communication Technology': ['../images/iict.png', '../images/isu-logo.png'],
            // Add more office names and their corresponding image paths here
        };

        function printAwards() {
            const officeName = document.getElementById('officeSelect').value;
            if (officeName) {
                const filteredData = awardsData.filter(row => row.office_name === officeName);
                const printWindow = window.open('', '_blank');
                printWindow.document.write('<html><head><title>Print Awards - ' + officeName + '</title>');
                printWindow.document.write('<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">');
                printWindow.document.write('<style>.header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; } .header img { height: 80px; } .header-text { text-align: center; flex-grow: 1; margin: 0; } .table { width: 100%; margin-bottom: 1rem; color: #212529; } .table th, .table td { padding: 0.75rem; vertical-align: top; border-top: 1px solid #dee2e6; } .table thead th { vertical-align: bottom; border-bottom: 2px solid #dee2e6; } .table tbody + tbody { border-top: 2px solid #dee2e6; } .container { max-width: 900px; margin: auto; }</style>');
                printWindow.document.write('</head><body>');
                printWindow.document.write('<div class="container">');
                const images = officeImages[officeName] || ['', ''];
                printWindow.document.write('<div class="header"><img src="' + images[1] + '" alt="Logo 1"><h5 class="header-text">' + 'Isabela State University <br>Roxas Campus</div>');
                printWindow.document.write('<table class="table table-bordered"><thead><tr><th>Award</th><th>Conferred To</th><th>Conferred By</th><th>Date</th><th>Date Ended</th><th>Venue</th><th>Category</th></tr></thead><tbody>');
                if (filteredData.length > 0) {
                    filteredData.forEach(row => {
                        printWindow.document.write('<tr>');
                        printWindow.document.write('<td>' + row.award + '</td>');
                        printWindow.document.write('<td>' + row.conferred_to + '</td>');
                        printWindow.document.write('<td>' + row.conferred_by + '</td>');
                        printWindow.document.write('<td>' + row.date + '</td>');
                        printWindow.document.write('<td>' + row.date_ended + '</td>');
                        printWindow.document.write('<td>' + row.venue + '</td>');
                        printWindow.document.write('<td>' + row.category + '</td>');
                        printWindow.document.write('</tr>');
                    });
                } else {
                    printWindow.document.write('<tr><td colspan="7">No awards data found.</td></tr>');
                }
                printWindow.document.write('</tbody></table></div>');
                printWindow.document.write('<script>window.print();<\/script>');
                printWindow.document.write('</body></html>');
                printWindow.document.close();
            } else {
                alert('Please select an office.');
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>