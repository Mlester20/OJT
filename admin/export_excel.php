<?php
include '../components/config.php';

header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=awards_list.csv");
header("Pragma: no-cache");
header("Expires: 0");

// Output CSV headers
echo "Award,Conferred To,Conferred By,Date,Venue,Member Name,Office\n";

// SQL Query with JOIN
$query = "SELECT 
            a.award, 
            a.conferred_to, 
            a.conferred_by, 
            a.date, 
            a.venue, 
            m.member_first, 
            m.member_last, 
            o.office_name
          FROM awards a
          LEFT JOIN member m ON a.member_id = m.member_id
          LEFT JOIN office_name o ON m.office_id = o.office_id
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
        . '"' . date('M d, Y', strtotime($row['date'])) . '",'
        . '"' . htmlspecialchars($row['venue']) . '",'
        . '"' . htmlspecialchars($row['member_first'] . ' ' . $row['member_last']) . '",'
        . '"' . htmlspecialchars($row['office_name']) . '"' . "\n";
}

exit();
?>
