<?php
session_start();
if (!isset($_SESSION["member_id"])) {
    die("Unauthorized access.");
}
$member_id = $_SESSION["member_id"];

include '../components/config.php';

$data = json_decode(file_get_contents("php://input"), true);

if (!empty($data["tableData"])) {
    foreach ($data["tableData"] as $row) {
        $award = mysqli_real_escape_string($con, $row[0] ?? '');
        $conferredTo = mysqli_real_escape_string($con, $row[1] ?? '');
        $conferredBy = mysqli_real_escape_string($con, $row[2] ?? '');
        $date = mysqli_real_escape_string($con, $row[3] ?? '');
        $venue = mysqli_real_escape_string($con, $row[4] ?? '');

        $sql = "INSERT INTO awards (member_id, award, conferred_to, conferred_by, date, venue) 
                VALUES ('$member_id', '$award', '$conferredTo', '$conferredBy', '$date', '$venue')";
        mysqli_query($con, $sql);
    }
    echo "Data saved successfully!";
} else {
    echo "No data received.";
}

mysqli_close($con);
?>
