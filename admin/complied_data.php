<?php
session_start();
include '../components/config.php';
include '../controllers/fetch_data.php';

if (!isset($_SESSION['member_id'])) {
    header('Location: ../index.php');
}

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
    <link rel="stylesheet" href="../styles/darkLight.css">
    <script src="../js/darkLight.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        <h1 class="h2 mb-4 text-center">List of Complied Data</h1>

        <h2 class="section-title">Awards</h2>
        <div class="text-end mb-3 fade-in d-flex flex-column flex-md-row align-items-md-center gap-2">
            <select id="categorySelect" class="form-select w-50 w-md-auto">
                <option value="">Select Category</option>
                <option value="All">All Category</option>
                <option value="International">International</option>
                <option value="National">National</option>
                <option value="Regional">Regional</option>
                <option value="Local">Local</option>
            </select>
            <button id="printButton" class="btn btn-primary w-50 w-md-auto" onclick="printAwards()">Print Awards</button>
        </div>

        <div class="table-responsive fade-in">
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

        function printAwards() {
            const category = document.getElementById('categorySelect').value;
            if (category) {
                const filteredData = category === 'All' ? awardsData : awardsData.filter(row => row.category === category);
                const printWindow = window.open('', '_blank');

                printWindow.document.write(`
                    <html>
                    <head>
                        <title>Print Awards - ${category}</title>
                        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
                        <style>
                            .header { text-align: center; margin-bottom: 2rem; }
                            .header img { height: 80px; margin-bottom: 10px; }
                            .table { width: 100%; margin-bottom: 1rem; color: #212529; }
                            .table th, .table td { padding: 0.75rem; text-align: center; border: 1px solid #dee2e6; }
                            .container { max-width: 900px; margin: auto; }
                        </style>
                    </head>
                    <body>
                        <div class="container">
                            <div class="header">
                                <img src="../images/isu-logo.png" alt="ISU Logo">
                                <h5>Isabela State University <br>Roxas, Isabela</h5>
                                <h6 style="margin-top: 25px;">${category} Awards</h6>
                            </div>
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
                                    </tr>
                                </thead>
                                <tbody>
                `);

                if (filteredData.length > 0) {
                    filteredData.forEach(row => {
                        printWindow.document.write(`
                            <tr>
                                <td>${row.award}</td>
                                <td>${row.conferred_to}</td>
                                <td>${row.conferred_by}</td>
                                <td>${row.date}</td>
                                <td>${row.date_ended}</td>
                                <td>${row.venue}</td>
                                <td>${row.category}</td>
                            </tr>
                        `);
                    });
                } else {
                    printWindow.document.write(`<tr><td colspan="7">No awards data found for ${category} category.</td></tr>`);
                }

                printWindow.document.write(`
                                </tbody>
                            </table>
                        </div>
                        <script>window.print();<\/script>
                    </body>
                    </html>
                `);
                printWindow.document.close();
            } else {
                alert('Please select a category.');
            }
        }

        // Update table when category is selected
        document.getElementById('categorySelect').addEventListener('change', function() {
            const category = this.value;
            const tableBody = document.getElementById('awardsTableBody');
            tableBody.innerHTML = '';
            
            if (category === '' || category === 'All') {
                // Show all data when "All" or no category is selected
                awardsData.forEach(row => {
                    addRowToTable(row, tableBody);
                });
            } else {
                // Filter data by selected category
                const filteredData = awardsData.filter(row => row.category === category);
                
                if (filteredData.length > 0) {
                    filteredData.forEach(row => {
                        addRowToTable(row, tableBody);
                    });
                } else {
                    tableBody.innerHTML = `<tr><td colspan="11" class="text-center">No awards data found for ${category} category.</td></tr>`;
                }
            }
        });

        function addRowToTable(row, tableBody) {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>${row.award}</td>
                <td>${row.conferred_to}</td>
                <td>${row.conferred_by}</td>
                <td>${row.date}</td>
                <td>${row.date_ended}</td>
                <td>${row.venue}</td>
                <td>${row.category}</td>
                <td>${row.year}</td>
                <td>${row.member_first}</td>
                <td>${row.member_last}</td>
                <td>${row.office_name}</td>
            `;
            tableBody.appendChild(tr);
        }
        </script>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="../js/notif.js"></script>
</body>
</html>