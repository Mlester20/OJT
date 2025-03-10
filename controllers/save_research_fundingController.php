<?php
session_start();
$member_id = $_SESSION['member_id'];

include '../components/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $funds = $_POST['fund'];
    $no_of_researches_funded = $_POST['no_of_researches_funded'];
    $no_of_researchers_male = $_POST['no_of_researchers_male'];
    $no_of_researchers_female = $_POST['no_of_researchers_female'];
    $total_budgets = $_POST['total_budget'];

    $total_budget_sum = 0;
    $total_researchers_sum = 0;

    for ($i = 0; $i < count($funds); $i++) {
        $fund = $funds[$i];
        $researches_funded = $no_of_researches_funded[$i];
        $researchers_male = $no_of_researchers_male[$i];
        $researchers_female = $no_of_researchers_female[$i];
        $total_budget = $total_budgets[$i];

        $total_budget_sum += $total_budget;
        $total_researchers_sum += $researchers_male + $researchers_female;

        $sql = "INSERT INTO research_funding (member_id, fund, no_of_researches_funded, no_of_researchers_male, no_of_researchers_female, total_budget) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($sql);
        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($con->error));
        }
        $stmt->bind_param("isiiid", $member_id, $fund, $researches_funded, $researchers_male, $researchers_female, $total_budget);
        if ($stmt->execute() === false) {
            die('Execute failed: ' . htmlspecialchars($stmt->error));
        }
    }

    $_SESSION['success_message'] = "Research funding data saved successfully! Total Budget: " . number_format($total_budget_sum, 2) . " Total Researchers: " . $total_researchers_sum;
    header('Location: ../admin/research_funding.php');
    exit();
}
?>