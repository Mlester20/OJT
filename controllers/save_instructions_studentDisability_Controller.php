<?php
session_start();
include '../components/config.php';
var_dump($_POST);
if (empty($_SESSION['member_id'])) {
    header('HTTP/1.1 401 Unauthorized');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Debug: Check if POST data is received
    if (empty($_POST)) {
        die(json_encode(['status' => 'error', 'message' => 'No POST data received.']));
    }

    $member_id = $_SESSION['member_id'];
    $name = $_POST['name'] ?? '';
    $sex = $_POST['sex'] ?? '';
    $program_enrolled = $_POST['program'] ?? '';
    $year_level = $_POST['yearLevel'] ?? '';
    $type_of_disability = $_POST['disability'] ?? '';
    $campus = $_POST['campus'] ?? '';

    if (!$name || !$sex || !$program_enrolled || !$year_level || !$campus) {
        die(json_encode(['status' => 'error', 'message' => 'Missing required fields.']));
    }

    $stmt = $con->prepare("INSERT INTO instruction_student_disability (member_id, name, sex, program_enrolled, year_level, type_of_disability, campus) VALUES (?, ?, ?, ?, ?, ?, ?)");
    
    if ($stmt === false) {
        die(json_encode(['status' => 'error', 'message' => 'SQL Error: ' . $con->error]));
    }
    
    $stmt->bind_param("issssss", $member_id, $name, $sex, $program_enrolled, $year_level, $type_of_disability, $campus);
    
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Record inserted successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to insert record.']);
    }
    
    $stmt->close();
}
?>
