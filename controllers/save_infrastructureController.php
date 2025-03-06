<?php
session_start();
include '../components/config.php';
$member_id = $_SESSION['member_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $project_names = $_POST['project_name'];
    $budgets = $_POST['budget'];
    $durations = $_POST['duration'];
    $dates_started = $_POST['date_started'];
    $expected_completion_dates = $_POST['expected_completion_date'];
    $statuses = $_POST['status'];

    $success = true;

    for ($i = 0; $i < count($project_names); $i++) {
        $project_name = $project_names[$i];
        $budget = $budgets[$i];
        $duration = $durations[$i];
        $date_started = $dates_started[$i];
        $expected_completion_date = $expected_completion_dates[$i];
        $status = $statuses[$i];

        $sql = "INSERT INTO infrastructure_projects (member_id, name_of_project, allocated_budget, project_duration, date_started, expected_completion_date, status) 
                VALUES ('$member_id', '$project_name', '$budget', '$duration', '$date_started', '$expected_completion_date', '$status')";

        if (!mysqli_query($con, $sql)) {
            $success = false;
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }
    }

    if ($success) {
        echo "Projects saved successfully!";
    }

    header("Location: ../pages/infrastructure.php");
    exit();
}
?>