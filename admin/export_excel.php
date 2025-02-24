<?php
include '../components/config.php'; // Database connection

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=awards_list.xls");
header("Pragma: no-cache");
header("Expires: 0");

// Table headers
echo "Award\tConferred To\tConferred By\tDate\tVenue\tMember Name\tOffice\n";

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
    echo htmlspecialchars($row['award']) . "\t" .
         htmlspecialchars($row['conferred_to']) . "\t" .
         htmlspecialchars($row['conferred_by']) . "\t" .
         date('M d, Y', strtotime($row['date'])) . "\t" .
         htmlspecialchars($row['venue']) . "\t" .
         htmlspecialchars($row['member_first'] . ' ' . $row['member_last']) . "\t" .
         htmlspecialchars($row['office_name']) . "\n";
}

exit();
?>
