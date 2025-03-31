<?php
session_start();
include '../components/config.php';

    if (!isset($_SESSION['member_id'])) {
        header('Location: ../index.php');
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Resource - <?php include '../components/title.php'; ?> </title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.min.js"></script>
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">
    <link rel="stylesheet" href="../styles/hover.css">
    <link rel="stylesheet" href="../styles/tableDesign.css">
    <link rel="stylesheet" href="../styles/darkLight.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    
    <?php include '../components/header.php'; ?>


    <div class="table-responsive">
        <h3 class="text-center mt-4 mb-4">EXTERNAL LINKAGES AND INTERNATIONAL AFFAIRS</h3>
        <form action="" method="POST">
            <div class="text-center mt-4 mb-4">
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
            <table id="indicatorsTable" class="table table-bordered">
                <thead>
                    <tr class="table-header">
                        <th style="width: 40%">Indicator</th>
                        <th style="width: 15%">FY 2025 Targets</th>
                        <th style="width: 15%">Budgetary Requirements</th>
                        <th style="width: 15%">Source of Funds</th>
                        <th style="width: 15%">Responsible Office</th>
                    </tr>
                </thead>
                <tbody>
                <tr><td colspan="5"><strong>PERFORMANCE INDICATORS</strong></td></tr>
                    <tr>
                        <td>Number of established EIA office</td>
                        <td><input type="text" name="eia_office" value="<?= $data['eia_office'] ?? '' ?>"></td>
                        <td><input type="text" name="budget_eia_office" value="<?= $data['budget_eia_office'] ?? '' ?>"></td>
                        <td><input type="text" name="fund_eia_office" value="<?= $data['fund_eia_office'] ?? '164' ?>"></td>
                        <td><input type="text" name="office_eia_office" value="<?= $data['office_eia_office'] ?? 'EIAO' ?>"></td>
                    </tr>
                    <tr>
                        <td>Number of staff designated to the established EIA office</td>
                        <td><input type="text" name="eia_office" value="<?= $data['eia_office'] ?? '' ?>"></td>
                        <td><input type="text" name="budget_eia_office" value="<?= $data['budget_eia_office'] ?? '' ?>"></td>
                        <td><input type="text" name="fund_eia_office" value="<?= $data['fund_eia_office'] ?? '164' ?>"></td>
                        <td><input type="text" name="office_eia_office" value="<?= $data['office_eia_office'] ?? 'A' ?>"></td>
                    </tr>
                    <tr>
                        <td>Number of EIA office fully equipped with facilities</td>
                        <td><input type="text" name="eia_office" value="<?= $data['eia_office'] ?? '' ?>"></td>
                        <td><input type="text" name="budget_eia_office" value="<?= $data['budget_eia_office'] ?? '' ?>"></td>
                        <td><input type="text" name="fund_eia_office" value="<?= $data['fund_eia_office'] ?? '164' ?>"></td>
                        <td><input type="text" name="office_eia_office" value="<?= $data['office_eia_office'] ?? 'EIAO' ?>"></td>
                    </tr>
                    <tr>
                        <td>Number of data base set-up</td>
                        <td><input type="text" name="eia_office" value="<?= $data['eia_office'] ?? '' ?>"></td>
                        <td><input type="text" name="budget_eia_office" value="<?= $data['budget_eia_office'] ?? '' ?>"></td>
                        <td><input type="text" name="fund_eia_office" value="<?= $data['fund_eia_office'] ?? '164' ?>"></td>
                        <td><input type="text" name="office_eia_office" value="<?= $data['office_eia_office'] ?? 'EIAO' ?>"></td>
                    </tr>
                    <tr>
                        <td>Number of EIA activities updated in the database</td>
                        <td><input type="text" name="eia_office" value="<?= $data['eia_office'] ?? '' ?>"></td>
                        <td><input type="text" name="budget_eia_office" value="<?= $data['budget_eia_office'] ?? '' ?>"></td>
                        <td><input type="text" name="fund_eia_office" value="<?= $data['fund_eia_office'] ?? '164' ?>"></td>
                        <td><input type="text" name="office_eia_office" value="<?= $data['office_eia_office'] ?? 'EIAO' ?>"></td>
                    </tr>
                    <tr>
                        <td>Percentage of fund utilized from the allocated budget</td>
                        <td><input type="text" name="eia_office" value="<?= $data['eia_office'] ?? '' ?>"></td>
                        <td><input type="text" name="budget_eia_office" value="<?= $data['budget_eia_office'] ?? '' ?>"></td>
                        <td><input type="text" name="fund_eia_office" value="<?= $data['fund_eia_office'] ?? '164' ?>"></td>
                        <td><input type="text" name="office_eia_office" value="<?= $data['office_eia_office'] ?? 'EIAO' ?>"></td>
                    </tr>
                    <tr>
                        <td>Number of constructed international guest house/dormitories for foreign students</td>
                        <td><input type="text" name="eia_office" value="<?= $data['eia_office'] ?? '' ?>"></td>
                        <td><input type="text" name="budget_eia_office" value="<?= $data['budget_eia_office'] ?? '' ?>"></td>
                        <td><input type="text" name="fund_eia_office" value="<?= $data['fund_eia_office'] ?? '164' ?>"></td>
                        <td><input type="text" name="office_eia_office" value="<?= $data['office_eia_office'] ?? 'EIAO' ?>"></td>
                    </tr>
                    <tr>
                        <td>Number of BOR approved policies for EIA services</td>
                        <td><input type="text" name="eia_office" value="<?= $data['eia_office'] ?? '' ?>"></td>
                        <td><input type="text" name="budget_eia_office" value="<?= $data['budget_eia_office'] ?? '' ?>"></td>
                        <td><input type="text" name="fund_eia_office" value="<?= $data['fund_eia_office'] ?? '164' ?>"></td>
                        <td><input type="text" name="office_eia_office" value="<?= $data['office_eia_office'] ?? 'EIAO' ?>"></td>
                    </tr>
                    <tr>
                        <td>Number of collaborative projects implemented with foreign academic partners</td>
                        <td><input type="text" name="eia_office" value="<?= $data['eia_office'] ?? '' ?>"></td>
                        <td><input type="text" name="budget_eia_office" value="<?= $data['budget_eia_office'] ?? '' ?>"></td>
                        <td><input type="text" name="fund_eia_office" value="<?= $data['fund_eia_office'] ?? '164' ?>"></td>
                        <td><input type="text" name="office_eia_office" value="<?= $data['office_eia_office'] ?? 'EIAO' ?>"></td>
                    </tr>
                    <tr>
                        <td>Number of international network activities participated</td>
                        <td><input type="text" name="eia_office" value="<?= $data['eia_office'] ?? '' ?>"></td>
                        <td><input type="text" name="budget_eia_office" value="<?= $data['budget_eia_office'] ?? '' ?>"></td>
                        <td><input type="text" name="fund_eia_office" value="<?= $data['fund_eia_office'] ?? '164' ?>"></td>
                        <td><input type="text" name="office_eia_office" value="<?= $data['office_eia_office'] ?? 'EIAO' ?>"></td>
                    </tr>
                    <tr>
                        <td>Number of capacity building conducted for international activities</td>
                        <td><input type="text" name="eia_office" value="<?= $data['eia_office'] ?? '' ?>"></td>
                        <td><input type="text" name="budget_eia_office" value="<?= $data['budget_eia_office'] ?? '' ?>"></td>
                        <td><input type="text" name="fund_eia_office" value="<?= $data['fund_eia_office'] ?? '164' ?>"></td>
                        <td><input type="text" name="office_eia_office" value="<?= $data['office_eia_office'] ?? 'EIAO' ?>"></td>
                    </tr>
                    <tr>
                        <td>Number of students participated in outbound academic mobility program</td>
                        <td><input type="text" name="eia_office" value="<?= $data['eia_office'] ?? '' ?>"></td>
                        <td><input type="text" name="budget_eia_office" value="<?= $data['budget_eia_office'] ?? '' ?>"></td>
                        <td><input type="text" name="fund_eia_office" value="<?= $data['fund_eia_office'] ?? '164' ?>"></td>
                        <td><input type="text" name="office_eia_office" value="<?= $data['office_eia_office'] ?? 'EIAO' ?>"></td>
                    </tr>
                    <tr>
                        <td>Number of students participated in inbound academic mobility program</td>
                        <td><input type="text" name="eia_office" value="<?= $data['eia_office'] ?? '' ?>"></td>
                        <td><input type="text" name="budget_eia_office" value="<?= $data['budget_eia_office'] ?? '' ?>"></td>
                        <td><input type="text" name="fund_eia_office" value="<?= $data['fund_eia_office'] ?? '164' ?>"></td>
                        <td><input type="text" name="office_eia_office" value="<?= $data['office_eia_office'] ?? 'EIAO' ?>"></td>
                    </tr>
                    <tr>
                        <td>Number of faculty participated for outbound academic mobility program</td>
                        <td><input type="text" name="eia_office" value="<?= $data['eia_office'] ?? '' ?>"></td>
                        <td><input type="text" name="budget_eia_office" value="<?= $data['budget_eia_office'] ?? '' ?>"></td>
                        <td><input type="text" name="fund_eia_office" value="<?= $data['fund_eia_office'] ?? '164' ?>"></td>
                        <td><input type="text" name="office_eia_office" value="<?= $data['office_eia_office'] ?? 'EIAO' ?>"></td>
                    </tr>
                    <tr>
                        <td>Number of faculty participated for inbound academic mobility program</td>
                        <td><input type="text" name="eia_office" value="<?= $data['eia_office'] ?? '' ?>"></td>
                        <td><input type="text" name="budget_eia_office" value="<?= $data['budget_eia_office'] ?? '' ?>"></td>
                        <td><input type="text" name="fund_eia_office" value="<?= $data['fund_eia_office'] ?? '164' ?>"></td>
                        <td><input type="text" name="office_eia_office" value="<?= $data['office_eia_office'] ?? 'EIAO' ?>"></td>
                    </tr>
                    <tr>
                        <td>Number of programs offering foreign languages</td>
                        <td><input type="text" name="eia_office" value="<?= $data['eia_office'] ?? '' ?>"></td>
                        <td><input type="text" name="budget_eia_office" value="<?= $data['budget_eia_office'] ?? '' ?>"></td>
                        <td><input type="text" name="fund_eia_office" value="<?= $data['fund_eia_office'] ?? '164' ?>"></td>
                        <td><input type="text" name="office_eia_office" value="<?= $data['office_eia_office'] ?? 'EIAO' ?>"></td>
                    </tr>
                    <tr>
                        <td>Number of conducted benchmarking with HEIs on internationalization</td>
                        <td><input type="text" name="eia_office" value="<?= $data['eia_office'] ?? '' ?>"></td>
                        <td><input type="text" name="budget_eia_office" value="<?= $data['budget_eia_office'] ?? '' ?>"></td>
                        <td><input type="text" name="fund_eia_office" value="<?= $data['fund_eia_office'] ?? '164' ?>"></td>
                        <td><input type="text" name="office_eia_office" value="<?= $data['office_eia_office'] ?? 'EIAO' ?>"></td>
                    </tr>
                  
                    <tr>
                        <th>TOTAL</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>

    <?php include '../components/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="../js/notif.js"></script>
    <script src="../js/darkLight.js"></script>

</body>
</html>