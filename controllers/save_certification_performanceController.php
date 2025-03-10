<?php
session_start();
$member_id = $_SESSION['member_id'];

include '../components/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $certifications = $_POST['certification'];
    $dates_complete = $_POST['date_complete'];
    $examinees_male = $_POST['examinees_male'];
    $examinees_female = $_POST['examinees_female'];
    $passers_male = $_POST['passers_male'];
    $passers_female = $_POST['passers_female'];
    $passing_rate_male = $_POST['passing_rate_male'];
    $passing_rate_female = $_POST['passing_rate_female'];
    $passing_rate_total = $_POST['passing_rate_total'];

    for ($i = 0; $i < count($certifications); $i++) {
        $certification = $certifications[$i];
        $date_complete = $dates_complete[$i];
        $examinees_male_count = $examinees_male[$i];
        $examinees_female_count = $examinees_female[$i];
        $passers_male_count = $passers_male[$i];
        $passers_female_count = $passers_female[$i];
        $passing_rate_male_value = $passing_rate_male[$i];
        $passing_rate_female_value = $passing_rate_female[$i];
        $passing_rate_total_value = $passing_rate_total[$i];

        $sql = "INSERT INTO national_certification_performance (member_id, certification, date_complete, examinees_male, examinees_female, passers_male, passers_female, passing_rate_male, passing_rate_female, passing_rate_total) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($sql);
        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($con->error));
        }
        $stmt->bind_param("issiiiiddd", $member_id, $certification, $date_complete, $examinees_male_count, $examinees_female_count, $passers_male_count, $passers_female_count, $passing_rate_male_value, $passing_rate_female_value, $passing_rate_total_value);
        if ($stmt->execute() === false) {
            die('Execute failed: ' . htmlspecialchars($stmt->error));
        }
    }

    $_SESSION['success_message'] = "Certification performance data saved successfully!";
    header('Location: ../admin/national_certificate.php');
    exit();
}
?>