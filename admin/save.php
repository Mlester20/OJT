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

// Check if data exists and either category or tableData is set
if (!empty($data["tableData"])) {

    // If a category exists, it means we're processing award data
    if (!empty($data["category"])) {
        // Processing award data
        $category = $data["category"];

        // Handle specific case for "Regional/Provincial"
        if ($category === "Regional/Provincial") {
            $category = "Regional";
        }

        $category = mysqli_real_escape_string($con, $category);

        // Loop through award data
        foreach ($data["tableData"] as $row) {
            $award = mysqli_real_escape_string($con, $row[0] ?? '');
            $conferredTo = mysqli_real_escape_string($con, $row[1] ?? '');
            $conferredBy = mysqli_real_escape_string($con, $row[2] ?? '');
            $date = mysqli_real_escape_string($con, $row[3] ?? '');
            $dateEnded = mysqli_real_escape_string($con, $row[4] ?? '');
            $venue = mysqli_real_escape_string($con, $row[5] ?? '');

            // Skip empty rows
            if (empty($award) && empty($conferredTo) && empty($conferredBy) && empty($date) && empty($dateEnded) && empty($venue)) {
                continue;
            }

            // Check if the award already exists for this member and category
            $check_sql = "SELECT COUNT(*) AS count FROM awards 
                          WHERE member_id = '$member_id' 
                          AND category = '$category'
                          AND award = '$award' 
                          AND conferred_to = '$conferredTo' 
                          AND conferred_by = '$conferredBy' 
                          AND date = '$date' 
                          AND date_ended = '$dateEnded'
                          AND venue = '$venue'";

            $result = mysqli_query($con, $check_sql);
            $row = mysqli_fetch_assoc($result);

            if ($row["count"] == 0) {
                // Insert only if no duplicate found
                $sql = "INSERT INTO awards (member_id, category, award, conferred_to, conferred_by, date, date_ended, venue) 
                        VALUES ('$member_id', '$category', '$award', '$conferredTo', '$conferredBy', '$date', '$dateEnded', '$venue')";
                if (!mysqli_query($con, $sql)) {
                    echo "Error: " . mysqli_error($con);
                    exit;
                }
            }
        }
        echo "Award data saved successfully for the " . $data["category"] . " category!";
    } else {
        // If no category is provided, we're processing employee data
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
                    VALUES ('$name', '$sex', '$employment_status', '$disability_type', '$campus', '$member_id`')";

            if (!mysqli_query($con, $sql)) {
                echo "Error: " . mysqli_error($con);
                exit;
            }
        }
        echo "Employee data saved successfully!";
    }
} else {
    echo "No data received.";
}

// Close the database connection
mysqli_close($con);
?>