<?php
session_start();

// Ensure the user is logged in
if (!isset($_SESSION["member_id"])) {
    die("Unauthorized access.");
}
$member_id = $_SESSION["member_id"];

// Include database connection
include '../components/config.php';

// Get the raw JSON data from the frontend
$data = json_decode(file_get_contents("php://input"), true);

// Check if data exists
if (!empty($data["tableData"])) {
    foreach ($data["tableData"] as $row) {
        $name = mysqli_real_escape_string($con, $row[0] ?? '');
        $sex = mysqli_real_escape_string($con, $row[1] ?? '');
        $employment_status = mysqli_real_escape_string($con, $row[2] ?? '');
        $disability_type = mysqli_real_escape_string($con, $row[3] ?? '');
        $campus = mysqli_real_escape_string($con, $row[4] ?? '');

        // Skip empty rows
        if (empty($name) && empty($sex) && empty($employment_status) && empty($disability_type) && empty($campus)) {
            continue;
        }

        // Insert employee data into the employees table
        $sql = "INSERT INTO employees (name, sex, employment_status, disability_type, campus, member_id) 
                VALUES ('$name', '$sex', '$employment_status', '$disability_type', '$campus', '$member_id')";

        if (!mysqli_query($con, $sql)) {
            echo "Error: " . mysqli_error($con);
            exit;
        }
    }
    echo "Employee data saved successfully!";
} else {
    echo "No data received.";
}

// Close the database connection
mysqli_close($con);
?>