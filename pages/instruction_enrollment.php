<?php  
session_start();
include '../components/config.php';

if (!isset($_SESSION['member_id'])) {
    header('location: ../index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrollment - <?php include '../components/title.php'; ?> </title>
    <link rel="stylesheet" href="../styles/styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../styles/darkLight.css">
    <script src="../js/darkLight.js"></script>
    <link rel="stylesheet" href="../styles/hover.css">
</head>
<body>

    <?php include '../components/header.php'; ?>

    <div class="container">
        <h3 class="mt-4">Enrollment</h3>
        <form action="" method="POST" id="enrollmentForm">
            <button class="mb-4" type="submit">Submit Data</button>

            <div class="form-section">
                <table>
                    <tr>
                        <th rowspan="2">Level</th>
                        <th colspan="3">Total No. of Students in Priority and Mandated Courses</th>
                        <th colspan="3">Total No. of Students in All Programs</th>
                    </tr>
                    <tr>
                        <th>Male</th>
                        <th>Female</th>
                        <th>Total</th>
                        <th>Male</th>
                        <th>Female</th>
                        <th>Total</th>
                    </tr>

                    <!-- Reusable Row Function -->
                    <script>
                        function generateRow(level) {
                            return `
                                <tr>
                                    <td>${level}</td>
                                    <td><input type="number" name="${level}_male_priority" class="priority-male" data-target="${level}_priority_total"></td>
                                    <td><input type="number" name="${level}_female_priority" class="priority-female" data-target="${level}_priority_total"></td>
                                    <td><input type="number" name="${level}_priority_total" class="priority-total" readonly></td>
                                    <td><input type="number" name="${level}_male_all" class="all-male" data-target="${level}_all_total"></td>
                                    <td><input type="number" name="${level}_female_all" class="all-female" data-target="${level}_all_total"></td>
                                    <td><input type="number" name="${level}_all_total" class="all-total" readonly></td>
                                </tr>
                            `;
                        }
                    </script>
                    <script>
                        document.write(generateRow("Doctorate"));
                        document.write(generateRow("Masters"));
                        document.write(generateRow("Post-Baccalaureate"));
                        document.write(generateRow("Baccalaureate"));
                        document.write(generateRow("Non-Degree"));
                    </script>
                    <tr>
                        <td><strong>Total</strong></td>
                        <td><input type="number" name="total_male_priority" id="total_male_priority" readonly></td>
                        <td><input type="number" name="total_female_priority" id="total_female_priority" readonly></td>
                        <td><input type="number" name="total_priority_total" id="total_priority_total" readonly></td>
                        <td><input type="number" name="total_male_all" id="total_male_all" readonly></td>
                        <td><input type="number" name="total_female_all" id="total_female_all" readonly></td>
                        <td><input type="number" name="total_all_total" id="total_all_total" readonly></td>
                    </tr>
                </table>
            </div>

            <div class="form-section">
                <h3>Particulars</h3>
                <table>
                    <tr>
                        <th>Particular</th>
                        <th>Male</th>
                        <th>Female</th>
                        <th>Total</th>
                    </tr>
                    <tr>
                        <td>Number of Students Starting a Degree</td>
                        <td><input type="number" name="starting_degree_male" class="starting-male" data-target="starting_degree_total"></td>
                        <td><input type="number" name="starting_degree_female" class="starting-female" data-target="starting_degree_total"></td>
                        <td><input type="number" name="starting_degree_total" id="starting_degree_total" readonly></td>
                    </tr>
                    <tr>
                        <td>Number of First-Generation Students Starting a Degree</td>
                        <td><input type="number" name="first_gen_male" class="first-gen-male" data-target="first_gen_total"></td>
                        <td><input type="number" name="first_gen_female" class="first-gen-female" data-target="first_gen_total"></td>
                        <td><input type="number" name="first_gen_total" id="first_gen_total" readonly></td>
                    </tr>
                </table>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener("input", function(event) {
            if (event.target.matches("input[type='number']")) {
                const rowTotalId = event.target.getAttribute("data-target");
                if (rowTotalId) {
                    const row = event.target.closest("tr");
                    const maleInput = row.querySelector("input[class*='male']");
                    const femaleInput = row.querySelector("input[class*='female']");
                    const totalInput = row.querySelector("input[class*='total']");

                    const maleValue = parseInt(maleInput.value) || 0;
                    const femaleValue = parseInt(femaleInput.value) || 0;

                    totalInput.value = maleValue + femaleValue;
                }
            }

            // Compute column totals
            function computeColumnTotal(className, totalId) {
                let sum = 0;
                document.querySelectorAll(className).forEach(input => {
                    sum += parseInt(input.value) || 0;
                });
                document.getElementById(totalId).value = sum;
            }

            computeColumnTotal(".priority-male", "total_male_priority");
            computeColumnTotal(".priority-female", "total_female_priority");
            computeColumnTotal(".priority-total", "total_priority_total");

            computeColumnTotal(".all-male", "total_male_all");
            computeColumnTotal(".all-female", "total_female_all");
            computeColumnTotal(".all-total", "total_all_total");

            computeColumnTotal(".starting-male", "starting_degree_total");
            computeColumnTotal(".starting-female", "starting_degree_total");

            computeColumnTotal(".first-gen-male", "first_gen_total");
            computeColumnTotal(".first-gen-female", "first_gen_total");
        });
    </script>

    <?php include '../components/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="../js/notif.js"></script>

    <script>
        $(document).ready(function() {
            $('#enrollmentForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    type: 'POST',
                    url: '../controllers/save_EnrollmentController.php',
                    data: $(this).serialize(),
                    success: function(response) {
                        console.log(response); // Log the response
                        alert('Enrollment data saved successfully!');
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText); // Log the error response
                        alert('Error saving enrollment data.');
                    }
                });
            });
        });
    </script>
</body>
</html>