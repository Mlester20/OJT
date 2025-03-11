<?php
session_start();

// Ensure the user is logged in
if (!isset($_SESSION["member_id"])) {
    die("Unauthorized access.");
}
$member_id = $_SESSION["member_id"];

// Include database connection
include '../components/config.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Get the raw JSON data from the frontend
$data = json_decode(file_get_contents("php://input"), true);

// Debugging - Log received data
file_put_contents('debug.log', print_r($data, true));

// Check if data exists and either category or tableData is set
if (!empty($data["tableData"])) {
    if (!empty($data["category"])) {
        // Processing award data
        $category = $data["category"];

        if ($category === "Regional/Provincial") {
            $category = "Regional";
        }

        $category = mysqli_real_escape_string($con, $category);

        foreach ($data["tableData"] as $row) {
            $award = mysqli_real_escape_string($con, $row[0] ?? '');
            $conferredTo = mysqli_real_escape_string($con, $row[1] ?? '');
            $conferredBy = mysqli_real_escape_string($con, $row[2] ?? '');
            $date = mysqli_real_escape_string($con, $row[3] ?? '');
            $date_ended = mysqli_real_escape_string($con, $row[4] ?? '');
            $venue = mysqli_real_escape_string($con, $row[5] ?? '');

            if (empty($award) && empty($conferredTo) && empty($conferredBy) && empty($date) && empty($venue)) {
                continue;
            }

            $sql = "INSERT INTO extension_awards (member_id, category, award, conferred_to, conferred_by, date, date_ended, venue) 
                    VALUES ('$member_id', '$category', '$award', '$conferredTo', '$conferredBy', '$date', '$date_ended', '$venue')";
            
            if (!mysqli_query($con, $sql)) {
                echo "Error: " . mysqli_error($con);
                exit;
            }
        }
        echo "Award data saved successfully for the " . $data["category"] . " category!";
    } else {
        echo "No category specified.";
    }
} else {
    echo "No data received.";
}

mysqli_close($con);
?>