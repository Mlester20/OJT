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
            $venue = mysqli_real_escape_string($con, $row[4] ?? '');

            if (empty($award) && empty($conferredTo) && empty($conferredBy) && empty($date) && empty($venue)) {
                continue;
            }

            $sql = "INSERT INTO awards (member_id, category, award, conferred_to, conferred_by, date, venue) 
                    VALUES ('$member_id', '$category', '$award', '$conferredTo', '$conferredBy', '$date', '$venue')";
            
            if (!mysqli_query($con, $sql)) {
                echo "Error: " . mysqli_error($con);
                exit;
            }
        }
        echo "Award data saved successfully for the " . $data["category"] . " category!";
    } else {
        // Processing employee data
        foreach ($data["tableData"] as $row) {
            $name = mysqli_real_escape_string($con, $row[0] ?? '');
            $sex = mysqli_real_escape_string($con, $row[1] ?? '');
            $employment_status = mysqli_real_escape_string($con, $row[2] ?? '');
            $disability_type = mysqli_real_escape_string($con, $row[3] ?? '');
            $campus = mysqli_real_escape_string($con, $row[4] ?? '');

            if (empty($name) && empty($sex) && empty($employment_status) && empty($disability_type) && empty($campus)) {
                continue;
            }

            $sql = "INSERT INTO employees (name, sex, employment_status, disability_type, campus) 
                    VALUES ('$name', '$sex', '$employment_status', '$disability_type', '$campus')";

            if (!mysqli_query($con, $sql)) {
                echo "Error: " . mysqli_error($con);
                exit;
            }
        }
        echo "Employee data saved successfully!";
    }
    
    // Processing scholarship grants data
    foreach ($data["tableData"] as $row) {
        $section = mysqli_real_escape_string($con, $row[0] ?? '');
        $type_of_scholarship = mysqli_real_escape_string($con, $row[1] ?? '');
        $doctorate_male = (int) ($row[2] ?? 0);
        $doctorate_female = (int) ($row[3] ?? 0);
        $doctorate_total = (int) ($row[4] ?? 0);
        $masters_male = (int) ($row[5] ?? 0);
        $masters_female = (int) ($row[6] ?? 0);
        $masters_total = (int) ($row[7] ?? 0);
        $baccalaureate_male = (int) ($row[8] ?? 0);
        $baccalaureate_female = (int) ($row[9] ?? 0);
        $baccalaureate_total = (int) ($row[10] ?? 0);
        
        $sql = "INSERT INTO scholarship_grants (member_id, section, type_of_scholarship, doctorate_male, doctorate_female, doctorate_total, 
                masters_male, masters_female, masters_total, baccalaureate_male, baccalaureate_female, baccalaureate_total) 
                VALUES ('$member_id', '$section', '$type_of_scholarship', '$doctorate_male', '$doctorate_female', '$doctorate_total',
                '$masters_male', '$masters_female', '$masters_total', '$baccalaureate_male', '$baccalaureate_female', '$baccalaureate_total')";
        
        if (!mysqli_query($con, $sql)) {
            echo "Error: " . mysqli_error($con);
            exit;
        }
    }
    echo "Scholarship grants data saved successfully!";
} else {
    echo "No data received.";
}

mysqli_close($con);
?>
