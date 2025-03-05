<?php
session_start();
include '../components/config.php';

if (empty($_SESSION['member_id'])) {
    header('HTTP/1.1 401 Unauthorized');
    exit();
}

$member_id = $_SESSION['member_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $designation = $_POST['designation'];
    $designation_name = $_POST['designation_name'];
    $contact_info = $_POST['contact_info'];

    $stmt = $con->prepare("INSERT INTO officials (member_id, designation, designation_name, contact_info) VALUES (?, ?, ?, ?)");
    
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($con->error));
    }
    
    $stmt->bind_param("isss", $member_id, $designation, $designation_name, $contact_info);
    
    if ($stmt->execute()) {
        echo json_encode(["status" => "success"]);
    } else {
        die("Error executing query: " . $stmt->error);
    }
    
    $stmt->close();
}
?>