<?php
include '../components/config.php';

header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=awards_list.csv");
header("Pragma: no-cache");
header("Expires: 0");

// Output CSV headers
echo "Award,Conferred To,Conferred By,Date Started,Date Ended,Venue,Category\n";

// SQL Query with JOIN
$query = "SELECT 
            a.award, 
            a.conferred_to, 
            a.conferred_by, 
            a.date AS date_started, 
            a.date_ended, 
            a.venue, 
            a.category
          FROM awards a
          ORDER BY a.date DESC";

$result = mysqli_query($con, $query);

if (!$result) {
    die("SQL Error: " . mysqli_error($con)); 
}

while ($row = mysqli_fetch_assoc($result)) {
    // Properly outputting data for CSV formatting
    echo '"' . htmlspecialchars($row['award']) . '",'
        . '"' . htmlspecialchars($row['conferred_to']) . '",'
        . '"' . htmlspecialchars($row['conferred_by']) . '",'
        . '"' . date('M d, Y', strtotime($row['date_started'])) . '",'
        . '"' . date('M d, Y', strtotime($row['date_ended'])) . '",'
        . '"' . htmlspecialchars($row['venue']) . '",'
        . '"' . htmlspecialchars($row['category']) . '"' . "\n";
}

exit();
?>