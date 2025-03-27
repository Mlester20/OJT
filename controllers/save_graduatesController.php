<?php
include '../components/config.php';
session_start();

// Check if member_id exists in the session
if (!isset($_SESSION['member_id'])) {
    http_response_code(401);
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized access. Please log in.']);
    exit();
}

// Retrieve and sanitize member_id from the session
$member_id = mysqli_real_escape_string($con, $_SESSION['member_id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Log all received POST data
    error_log("Received POST data: " . print_r($_POST, true));

    // Save first table data
    $levels = ['Doctorate', 'Masters', 'Post-Baccalaureate', 'Baccalaureate', 'Non-Degree', 'TOTAL'];
    foreach ($levels as $level) {
        $priorityMale = isset($_POST['priority_male'][$level]) ? intval($_POST['priority_male'][$level]) : 0;
        $priorityFemale = isset($_POST['priority_female'][$level]) ? intval($_POST['priority_female'][$level]) : 0;
        $priorityTotal = isset($_POST['priority_total'][$level]) ? intval($_POST['priority_total'][$level]) : 0;
        $allMale = isset($_POST['all_male'][$level]) ? intval($_POST['all_male'][$level]) : 0;
        $allFemale = isset($_POST['all_female'][$level]) ? intval($_POST['all_female'][$level]) : 0;
        $allTotal = isset($_POST['all_total'][$level]) ? intval($_POST['all_total'][$level]) : 0;

        // Prepare SQL with parameterized query
        $stmt = $con->prepare("INSERT INTO instruction_graduates (member_id, level, priority_male, priority_female, priority_total, all_male, all_female, all_total) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        
        if (!$stmt) {
            error_log("Prepare failed: " . $con->error);
            continue;
        }
        
        $stmt->bind_param("ssiiiiis", $member_id, $level, $priorityMale, $priorityFemale, $priorityTotal, $allMale, $allFemale, $allTotal);
        
        if (!$stmt->execute()) {
            error_log("Execute failed for level $level: " . $stmt->error);
        } else {
            error_log("Successfully inserted data for level: $level");
        }
        
        $stmt->close();
    }

    // Save second table data
    $categories = [
        'Number of Graduates in Health Profession',
        'Number of Graduates from Law and Enforcement Related Courses',
        'Number of Graduates who Garnered a Qualification that entitled to Teach Primary School Level',
        'STEM', 'Medicine', 'Arts & Humanities / Social Sciences'
    ];
    foreach ($categories as $category) {
        $male = isset($_POST['male'][$category]) ? intval($_POST['male'][$category]) : 0;
        $female = isset($_POST['female'][$category]) ? intval($_POST['female'][$category]) : 0;
        $total = isset($_POST['total'][$category]) ? intval($_POST['total'][$category]) : 0;

        // Prepare SQL with parameterized query
        $stmt = $con->prepare("INSERT INTO graduates_data (member_id, category, male_count, female_count, total_count) VALUES (?, ?, ?, ?, ?)");
        
        if (!$stmt) {
            error_log("Prepare failed: " . $con->error);
            continue;
        }
        
        $stmt->bind_param("ssiii", $member_id, $category, $male, $female, $total);
        
        if (!$stmt->execute()) {
            error_log("Execute failed for category $category: " . $stmt->error);
        } else {
            error_log("Successfully inserted data for category: $category");
        }
        
        $stmt->close();
    }

    // Return success response
    echo json_encode(['status' => 'success', 'message' => 'Data saved successfully!']);
    exit();
} else {
    // Return error response for invalid request method
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
    exit();
}
?>