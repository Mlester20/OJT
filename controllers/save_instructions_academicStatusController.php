<?php
session_start();
include '../components/config.php'; // Ensure $con is included

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if user is logged in
    if (!isset($_SESSION['member_id'])) {
        echo "Unauthorized";
        exit();
    }

    $member_id = $_SESSION['member_id'];
    $programs = $_POST['programs'];
    $levels = $_POST['level'];
    $validity_dates = $_POST['validity_date'];
    $survey_dates = $_POST['survey_date'];
    $survey_actions = $_POST['board_action'];
    $remarks = $_POST['remarks'];

    for ($i = 0; $i < count($programs); $i++) {
        // Skip empty rows
        if (!empty($programs[$i])) {
            $program = mysqli_real_escape_string($con, $programs[$i]);
            $level = mysqli_real_escape_string($con, $levels[$i]);
            $validity_date = !empty($validity_dates[$i]) ? "'" . mysqli_real_escape_string($con, $validity_dates[$i]) . "'" : "NULL";
            $survey_date = !empty($survey_dates[$i]) ? "'" . mysqli_real_escape_string($con, $survey_dates[$i]) . "'" : "NULL";
            $survey_action = mysqli_real_escape_string($con, $survey_actions[$i]);
            $remark = mysqli_real_escape_string($con, $remarks[$i]);

            // Insert data into the table
            $query = "INSERT INTO instruction_academic_status 
                      (program, level, validity_date, latest_survey_visit_date, latest_survey_visit_board_action, remarks, member_id) 
                      VALUES ('$program', '$level', $validity_date, $survey_date, '$survey_action', '$remark', '$member_id')";
            
            mysqli_query($con, $query);
        }
    }
    echo "Success";
}
?>
