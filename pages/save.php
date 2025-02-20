<?php
session_start();
if (!isset($_SESSION["member_id"])) {
    die("Unauthorized access.");
}
$member_id = $_SESSION["member_id"];

include '../components/config.php';

$data = json_decode(file_get_contents("php://input"), true);

if (!empty($data["tableData"]) && !empty($data["category"])) {
    $category = $data["category"];
    
    // Map "Regional/Provincial" to "Regional" to match the enum
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

        // Skip empty rows
        if (empty($award) && empty($conferredTo) && empty($conferredBy) && empty($date) && empty($venue)) {
            continue;
        }

        // CHECK if award already exists for this member and category
        $check_sql = "SELECT COUNT(*) AS count FROM awards 
                      WHERE member_id = '$member_id' 
                      AND category = '$category'
                      AND award = '$award' 
                      AND conferred_to = '$conferredTo' 
                      AND conferred_by = '$conferredBy' 
                      AND date = '$date' 
                      AND venue = '$venue'";

        $result = mysqli_query($con, $check_sql);
        $row = mysqli_fetch_assoc($result);

        if ($row["count"] == 0) {
            // INSERT only if no duplicate found
            $sql = "INSERT INTO awards (member_id, category, award, conferred_to, conferred_by, date, venue) 
                    VALUES ('$member_id', '$category', '$award', '$conferredTo', '$conferredBy', '$date', '$venue')";
            if (!mysqli_query($con, $sql)) {
                echo "Error: " . mysqli_error($con);
                exit;
            }
        }
    }
    echo "Data saved successfully for " . $data["category"] . " category!";
} else {
    echo "No data received or category missing.";
}

mysqli_close($con);
?>