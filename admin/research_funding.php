<?php
session_start();
if (!isset($_SESSION['member_id'])) {
    header('location: ../index.php');
    exit();
}

include '../components/config.php';

$success_message = '';
if (isset($_SESSION['success_message'])) {
    $success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Research Funding - <?php include '../components/title.php'; ?> </title>
    <link rel="stylesheet" href="../styles/styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">
    <link rel="stylesheet" href="../styles/hover.css">
    <link rel="stylesheet" href="../styles/darkLight.css">
    <script src="../js/darkLight.js"></script>
</head>
<body>
    <?php include '../components/header_admin.php'; ?>

    <div class="container mt-4">
        <h2 class="text-center">Research Funding</h2>
        
        <?php if ($success_message): ?>
            <script>
                alert('<?php echo $success_message; ?>');
            </script>
        <?php endif; ?>

        <form action="../controllers/save_research_fundingController.php" method="POST">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Fund</th>
                        <th>No of Researches Funded</th>
                        <th>No. of Researchers Involved (Male)</th>
                        <th>No. of Researchers Involved (Female)</th>
                        <th>Total Budget</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>SB</td>
                        <td><input type="number" class="form-control" name="no_of_researches_funded[]"></td>
                        <td><input type="number" class="form-control" name="no_of_researchers_male[]"></td>
                        <td><input type="number" class="form-control" name="no_of_researchers_female[]"></td>
                        <td><input type="number" step="0.01" class="form-control" name="total_budget[]"></td>
                        <input type="hidden" name="fund[]" value="SB">
                    </tr>
                    <tr>
                        <td>GAA</td>
                        <td><input type="number" class="form-control" name="no_of_researches_funded[]"></td>
                        <td><input type="number" class="form-control" name="no_of_researchers_male[]"></td>
                        <td><input type="number" class="form-control" name="no_of_researchers_female[]"></td>
                        <td><input type="number" step="0.01" class="form-control" name="total_budget[]"></td>
                        <input type="hidden" name="fund[]" value="GAA">
                    </tr>
                    <tr>
                        <td>External</td>
                        <td><input type="number" class="form-control" name="no_of_researches_funded[]"></td>
                        <td><input type="number" class="form-control" name="no_of_researchers_male[]"></td>
                        <td><input type="number" class="form-control" name="no_of_researchers_female[]"></td>
                        <td><input type="number" step="0.01" class="form-control" name="total_budget[]"></td>
                        <input type="hidden" name="fund[]" value="External">
                    </tr>
                </tbody>
                <tfoot class="table-light">
                    <tr>
                        <td>Total</td>
                        <td id="total_researches_funded">0</td>
                        <td id="total_researchers_male">0</td>
                        <td id="total_researchers_female">0</td>
                        <td id="total_budget">0.00</td>
                    </tr>
                </tfoot>
            </table>
            <button type="submit" class="btn btn-success">Save</button>
        </form>
    </div>

    <?php include '../components/footer.php'; ?>

    <script>
        document.addEventListener('input', function() {
            let totalResearchesFunded = 0;
            let totalResearchersMale = 0;
            let totalResearchersFemale = 0;
            let totalBudget = 0.00;

            document.querySelectorAll('input[name="no_of_researches_funded[]"]').forEach(input => {
                totalResearchesFunded += parseInt(input.value) || 0;
            });

            document.querySelectorAll('input[name="no_of_researchers_male[]"]').forEach(input => {
                totalResearchersMale += parseInt(input.value) || 0;
            });

            document.querySelectorAll('input[name="no_of_researchers_female[]"]').forEach(input => {
                totalResearchersFemale += parseInt(input.value) || 0;
            });

            document.querySelectorAll('input[name="total_budget[]"]').forEach(input => {
                totalBudget += parseFloat(input.value) || 0.00;
            });

            document.getElementById('total_researches_funded').innerText = totalResearchesFunded;
            document.getElementById('total_researchers_male').innerText = totalResearchersMale + totalResearchersFemale;
            document.getElementById('total_researchers_female').innerText = totalResearchersFemale;
            document.getElementById('total_budget').innerText = totalBudget.toFixed(2);
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="../js/notif.js"></script>
</body>
</html>