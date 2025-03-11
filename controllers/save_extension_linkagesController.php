<?php
session_start();
$member_id = $_SESSION['member_id'];

include '../components/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $institutions = $_POST['institution'];
    $moa_mous = $_POST['moa_mou'];
    $linkages = $_POST['linkage'];
    $dates_from = $_POST['date_from'];
    $dates_to = $_POST['date_to'];
    $linkage_types = $_POST['linkage_type'];

    for ($i = 0; $i < count($institutions); $i++) {
        $institution = $institutions[$i];
        $moa_mou = $moa_mous[$i];
        $linkage = $linkages[$i];
        $date_from = $dates_from[$i];
        $date_to = $dates_to[$i];
        $linkage_type = $linkage_types[$i];
        $linkage_level = ($linkage_type == 'international') ? 'International' : 'Regional';

        $sql = "INSERT INTO extension_linkages (member_id, institution, moa_mou, linkage, date_from, date_to, linkage_type, linkage_level) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($sql);
        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($con->error));
        }
        $stmt->bind_param("isssssss", $member_id, $institution, $moa_mou, $linkage, $date_from, $date_to, $linkage_type, $linkage_level);
        if ($stmt->execute() === false) {
            die('Execute failed: ' . htmlspecialchars($stmt->error));
        }
    }

    $_SESSION['success_message'] = "Research linkages saved successfully!";
    header('Location: ../admin/administrative_linkages.php');
    exit();
}
?>