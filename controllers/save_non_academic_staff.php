<?php
session_start();
include '../components/config.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $member_id = $_POST['member_id'];
    $data = $_POST['data'];

    foreach ($data as $row) {
        $category = $row['category'];
        $male = $row['male'];
        $female = $row['female'];

        $stmt = $con->prepare("INSERT INTO non_academic_staff (member_id, category, male_count, female_count) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isii", $member_id, $category, $male, $female);
        $stmt->execute();
    }

    echo "Data saved successfully!";
}
?>