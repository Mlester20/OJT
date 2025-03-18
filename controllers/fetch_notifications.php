<?php
session_start();
include '../components/config.php';

if (!isset($_SESSION['member_id'])) {
    echo json_encode(["status" => "error", "message" => "User not logged in"]);
    exit();
}

if (!$con) {
    die(json_encode(["status" => "error", "message" => "Database connection failed: " . mysqli_connect_error()]));
}

$query = "SELECT n.id, m.member_first, 
                 REPLACE(n.message, CONCAT('User ', m.member_id), m.member_first) AS message, 
                 n.is_read, 
                 DATE_FORMAT(n.created_at, '%M %d, %Y %h:%i %p') AS created_at 
          FROM notifications n
          JOIN member m ON n.member_id = m.member_id
          ORDER BY n.created_at DESC";

$stmt = $con->prepare($query);

if ($stmt === false) {
    die(json_encode(["status" => "error", "message" => "SQL Error: " . $con->error]));
}

$stmt->execute();
$result = $stmt->get_result();

$notifications = [];
while ($row = $result->fetch_assoc()) {
    $notifications[] = $row;
}

$stmt->close();
echo json_encode(["status" => "success", "notifications" => $notifications]);
?>
