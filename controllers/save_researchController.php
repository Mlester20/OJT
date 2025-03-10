<?php
session_start();
$member_id = $_SESSION['member_id'];

include '../components/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $research_centers = $_POST['research_center'];
    $nature_of_researches = $_POST['nature_of_research'];
    $collaborating_agencies = $_POST['collaborating_agencies'];
    $funding_supports = $_POST['funding_support'];
    $sdgs_supports = $_POST['sdgs_support'];

    for ($i = 0; $i < count($research_centers); $i++) {
        $research_center = $research_centers[$i];
        $nature_of_research = $nature_of_researches[$i];
        $collaborating_agency = $collaborating_agencies[$i];
        $funding_support = $funding_supports[$i];
        $sdgs_support = $sdgs_supports[$i];

        $sql = "INSERT INTO research_centers (name, nature_of_research, collaborating_agencies, funding_support, supported_sdgs, member_id) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($sql);
        if($stmt){
            echo "<script>alert('Research Added Successfully!');document.location='research.php'</script>";
        }
        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($con->error));
        }
        $stmt->bind_param("sssssi", $research_center, $nature_of_research, $collaborating_agency, $funding_support, $sdgs_support, $member_id);
        if ($stmt->execute() === false) {
            die('Execute failed: ' . htmlspecialchars($stmt->error));
        }
    }

    header('Location: ../admin/research.php');
    exit();
}
?>