<?php
session_start();
header("Content-Type: application/json");

require '../components/config.php';

// Ensure user is logged in
if (!isset($_SESSION["member_id"])) {
    echo json_encode(["status" => "error", "message" => "Unauthorized access."]);
    exit;
}

$member_id = $_SESSION["member_id"]; 
$data = json_decode(file_get_contents("php://input"), true);

// Check if tableData and category exist
if (!$data || !isset($data['tableData']) || !isset($data['category'])) {
    echo json_encode(["status" => "error", "message" => "Invalid input data."]);
    exit;
}

$tableData = $data['tableData'];
$category = $data['category'];

$stmt = $con->prepare("INSERT INTO scholarship_grants (member_id, category, type_of_scholarship, doctorate_male, doctorate_female, doctorate_total, masters_male, masters_female, masters_total, post_baccalaureate_male, post_baccalaureate_female, post_baccalaureate_total, baccalaureate_male, baccalaureate_female, baccalaureate_total, non_degree_male, non_degree_female, non_degree_total, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())");

if (!$stmt) {
    echo json_encode(["status" => "error", "message" => "Failed to prepare statement: " . $con->error]);
    exit;
}

// Loop through the table data and insert each row
foreach ($tableData as $row) {
    $stmt->bind_param("issiiiiiiiiiiiiiii", 
        $member_id, $category, $row[0], $row[1], $row[2], $row[3], 
        $row[4], $row[5], $row[6], $row[7], $row[8], 
        $row[9], $row[10], $row[11], $row[12], $row[13], 
        $row[14], $row[15]
    );

    if (!$stmt->execute()) {
        echo json_encode(["status" => "error", "message" => "Insert failed: " . $stmt->error]);
        exit;
    }
}

$stmt->close();
$con->close();

echo json_encode(["status" => "success", "message" => "Data inserted successfully."]);
?>
