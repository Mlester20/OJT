<?php
session_start();
include '../components/config.php';

if (!isset($_POST['id'])) {
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
    exit();
}

$notif_id = $_POST['id'];

// Update notification status to read
$query = "UPDATE notifications SET is_read = 1 WHERE id = ?";
$stmt = $con->prepare($query);

if ($stmt === false) {
    die(json_encode(["status" => "error", "message" => "SQL Error: " . $con->error]));
}

$stmt->bind_param("i", $notif_id);
$stmt->execute();
$stmt->close();

echo json_encode(["status" => "success"]);
?>
