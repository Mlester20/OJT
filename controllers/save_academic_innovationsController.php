<?php
include '../components/config.php';

session_start();

// Add this at the top of your controller file for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['member_id'])) {
    die("Error: User is not logged in.");
}

$member_id = $_SESSION['member_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['innovations'])) {
    $innovations = json_decode($_POST['innovations'], true);

    if (empty($innovations)) {
        die("Error: No innovations received.");
    }

    $stmt = $con->prepare("INSERT INTO academic_services_innovation (name_of_innovation, description, member_id) VALUES (?, ?, ?)");
    
    if (!$stmt) {
        die("Prepare failed: " . $con->error);
    }

    foreach ($innovations as $innovation) {
        $name = $innovation['innovation'];
        $description = $innovation['description'];

        // Corrected parameter order to match the SQL statement
        $stmt->bind_param("ssi", $name, $description, $member_id);
        
        if (!$stmt->execute()) {
            die("Execute failed: " . $stmt->error);
        }
        
    }

    echo "Innovations saved successfully!";
} else {
    die("Error: Invalid request.");
}
?>