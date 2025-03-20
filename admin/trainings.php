<?php
session_start();

if (!isset($_SESSION["member_id"])) {
    $_SESSION["member_id"] = 1;
}

$member_id = $_SESSION["member_id"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Table with PHP & JS</title>
    <link rel="stylesheet" href="../styles/styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">
    <link rel="stylesheet" href="../styles/header_style.css">
    <link rel="stylesheet" href="../styles/hover.css">
    <link rel="stylesheet" href="../styles/darkLight.css">
    <script src="../js/darkLight.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <?php include '../components/header.php'; ?>
    
    <div class="container my-5">
        <div class="personnel-header">
            <h3 class="card-title text-center text-muted">TRAININGS AND CONFERENCES ATTENDED BY FACULTY AND STAFF</h3>
            <div class="save-button-container text-end">
                <button id="save-button" class="btn btn-primary">Save</button>
            </div>
        </div>
        <div class="table-container mt-4">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th rowspan="2">Level</th>
                        <th colspan="3">No. of Faculty</th>
                        <th colspan="3">No. of Non-academic Staff</th>
                        <th colspan="3">TOTAL</th>
                    </tr>
                    <tr>
                        <th class="male">Male</th>
                        <th class="female">Female</th>
                        <th class="total">Total</th>
                        <th class="male">Male</th>
                        <th class="female">Female</th>
                        <th class="total">Total</th>
                        <th class="male">Male</th>
                        <th class="female">Female</th>
                        <th class="total">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $levels = ["International", "National", "Regional", "Local"];
                    foreach ($levels as $level) {
                        echo "<tr>
                                <td>$level</td>
                                <td class='male'><input type='number' class='faculty-male' value='0'></td>
                                <td class='female'><input type='number' class='faculty-female' value='0'></td>
                                <td class='total'><span>0</span></td>
                                <td class='male'><input type='number' class='non-academic-male' value='0'></td>
                                <td class='female'><input type='number' class='non-academic-female' value='0'></td>
                                <td class='total'><span>0</span></td>
                                <td class='male'><span>0</span></td>
                                <td class='female'><span>0</span></td>
                                <td class='total'><span>0</span></td>
                              </tr>";
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td>TOTAL</td>
                        <td class="faculty-male"><span id="total-faculty-male">0</span></td>
                        <td class="faculty-female"><span id="total-faculty-female">0</span></td>
                        <td class="faculty-total"><span id="total-faculty">0</span></td>
                        <td class="non-academic-male"><span id="total-non-academic-male">0</span></td>
                        <td class="non-academic-female"><span id="total-non-academic-female">0</span></td>
                        <td class="non-academic-total"><span id="total-non-academic">0</span></td>
                        <td class="total-male"><span id="total-male">0</span></td>
                        <td class="total-female"><span id="total-female">0</span></td>
                        <td class="total"><span id="grand-total">0</span></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <?php include '../components/footer.php'; ?>

    <script>
        $(document).ready(function() {
            function calculateTotals() {
                let totalFacultyMale = 0, totalFacultyFemale = 0, totalNonAcademicMale = 0, totalNonAcademicFemale = 0;

                $("tbody tr").each(function() {
                    let facultyMale = parseInt($(this).find(".faculty-male").val()) || 0;
                    let facultyFemale = parseInt($(this).find(".faculty-female").val()) || 0;
                    let nonAcademicMale = parseInt($(this).find(".non-academic-male").val()) || 0;
                    let nonAcademicFemale = parseInt($(this).find(".non-academic-female").val()) || 0;

                    let facultyTotal = facultyMale + facultyFemale;
                    let nonAcademicTotal = nonAcademicMale + nonAcademicFemale;
                    let rowTotalMale = facultyMale + nonAcademicMale;
                    let rowTotalFemale = facultyFemale + nonAcademicFemale;
                    let rowTotal = rowTotalMale + rowTotalFemale;

                    $(this).find(".faculty-total span").text(facultyTotal);
                    $(this).find(".non-academic-total span").text(nonAcademicTotal);
                    $(this).find(".total-male span").text(rowTotalMale);
                    $(this).find(".total-female span").text(rowTotalFemale);
                    $(this).find(".total span").text(rowTotal);

                    totalFacultyMale += facultyMale;
                    totalFacultyFemale += facultyFemale;
                    totalNonAcademicMale += nonAcademicMale;
                    totalNonAcademicFemale += nonAcademicFemale;
                });

                let totalFaculty = totalFacultyMale + totalFacultyFemale;
                let totalNonAcademic = totalNonAcademicMale + totalNonAcademicFemale;
                let grandTotalMale = totalFacultyMale + totalNonAcademicMale;
                let grandTotalFemale = totalFacultyFemale + totalNonAcademicFemale;
                let grandTotal = grandTotalMale + grandTotalFemale;

                $("#total-faculty-male").text(totalFacultyMale);
                $("#total-faculty-female").text(totalFacultyFemale);
                $("#total-faculty").text(totalFaculty);
                $("#total-non-academic-male").text(totalNonAcademicMale);
                $("#total-non-academic-female").text(totalNonAcademicFemale);
                $("#total-non-academic").text(totalNonAcademic);
                $("#total-male").text(grandTotalMale);
                $("#total-female").text(grandTotalFemale);
                $("#grand-total").text(grandTotal);
            }

            $(".faculty-male, .faculty-female, .non-academic-male, .non-academic-female").on("input", function() {
                calculateTotals();
            });

            calculateTotals(); // Initial Calculation

            $("#save-button").on("click", function() {
                let data = [];
                $("tbody tr").each(function() {
                    let level = $(this).find("td:first").text();
                    let facultyMale = parseInt($(this).find(".faculty-male").val()) || 0;
                    let facultyFemale = parseInt($(this).find(".faculty-female").val()) || 0;
                    let nonAcademicMale = parseInt($(this).find(".non-academic-male").val()) || 0;
                    let nonAcademicFemale = parseInt($(this).find(".non-academic-female").val()) || 0;
                    data.push({ 
                        level: level, 
                        faculty_male: facultyMale, 
                        faculty_female: facultyFemale, 
                        non_academic_male: nonAcademicMale, 
                        non_academic_female: nonAcademicFemale 
                    });
                });

                $.ajax({
                    url: '../controllers/trainingController.php',
                    type: 'POST',
                    data: { 
                        member_id: <?php echo $member_id; ?>, 
                        data: JSON.stringify(data) 
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            alert(response.message);
                        } else {
                            alert("Error: " + response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error:", status, error);
                        console.log("Response:", xhr.responseText);
                        alert("An error occurred while saving data. Check console for details.");
                    }
                });
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="../js/notif.js"></script>
</body>
</html>