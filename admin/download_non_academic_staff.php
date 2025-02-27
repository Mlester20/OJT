<?php
session_start();
include '../components/config.php';

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=non_academic_staff.csv');

$output = fopen('php://output', 'w');

// Add the headers
fputcsv($output, array('GENERIC RANK', 'Total no. of Personnel'));
fputcsv($output, array('Category', 'Male Count', 'Female Count', 'Total Count'));

$query = "SELECT category, male_count, female_count, total_count FROM non_academic_staff";
$result = mysqli_query($con, $query);

$totalMale = 0;
$totalFemale = 0;
$totalOverall = 0;

while ($row = mysqli_fetch_assoc($result)) {
    fputcsv($output, $row);
    $totalMale += $row['male_count'];
    $totalFemale += $row['female_count'];
    $totalOverall += $row['total_count'];
}

// Add the total counts at the bottom
fputcsv($output, array('TOTAL', '', $totalMale, $totalFemale, $totalOverall));

fclose($output);
exit();
?>