<?php
include '../components/config.php';
session_start();

// Ensure session is started and member_id exists
if (!isset($_SESSION['member_id'])) {
    die(json_encode(['status' => 'error', 'message' => 'Member ID is missing in session.']));
}

$member_id = $_SESSION['member_id'];

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die(json_encode(['status' => 'error', 'message' => 'Invalid request method.']));
}

// Define levels
$levels = ["Doctorate", "Masters", "Post-Baccalaureate", "Baccalaureate", "Non-Degree"];

// Insert data for each level
$stmt = $con->prepare("
    INSERT INTO instruction_enrollments (
        member_id, level, male_priority, female_priority, male_all, female_all,
        starting_degree_male, starting_degree_female,
        first_gen_male, first_gen_female
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
");

if (!$stmt) {
    die(json_encode(['status' => 'error', 'message' => 'Database error: ' . $con->error]));
}

foreach ($levels as $level) {
    $male_priority = isset($_POST["{$level}_male_priority"]) ? (int)$_POST["{$level}_male_priority"] : 0;
    $female_priority = isset($_POST["{$level}_female_priority"]) ? (int)$_POST["{$level}_female_priority"] : 0;
    $male_all = isset($_POST["{$level}_male_all"]) ? (int)$_POST["{$level}_male_all"] : 0;
    $female_all = isset($_POST["{$level}_female_all"]) ? (int)$_POST["{$level}_female_all"] : 0;
    $starting_degree_male = isset($_POST['starting_degree_male']) ? (int)$_POST['starting_degree_male'] : 0;
    $starting_degree_female = isset($_POST['starting_degree_female']) ? (int)$_POST['starting_degree_female'] : 0;
    $first_gen_male = isset($_POST['first_gen_male']) ? (int)$_POST['first_gen_male'] : 0;
    $first_gen_female = isset($_POST['first_gen_female']) ? (int)$_POST['first_gen_female'] : 0;

    $stmt->bind_param(
        "isiiiiiiii",
        $member_id,
        $level,
        $male_priority,
        $female_priority,
        $male_all,
        $female_all,
        $starting_degree_male,
        $starting_degree_female,
        $first_gen_male,
        $first_gen_female
    );

    if (!$stmt->execute()) {
        die(json_encode(['status' => 'error', 'message' => 'Database error: ' . $stmt->error]));
    }
}

$stmt->close();
$con->close();

echo json_encode(['status' => 'success', 'message' => 'Data successfully saved!']);
?>