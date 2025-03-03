<?php
include '../components/config.php';

header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=scholarship_grants_list.csv");
header("Pragma: no-cache");
header("Expires: 0");

// Output CSV headers
echo "Type of Scholarship,Male Total,Female Total,Overall Total\n";

// SQL Query
$query = "SELECT 
            type_of_scholarship,
            SUM(doctorate_male + masters_male + post_baccalaureate_male + baccalaureate_male + non_degree_male) AS male_total,
            SUM(doctorate_female + masters_female + post_baccalaureate_female + baccalaureate_female + non_degree_female) AS female_total,
            SUM(doctorate_male + masters_male + post_baccalaureate_male + baccalaureate_male + non_degree_male +
                doctorate_female + masters_female + post_baccalaureate_female + baccalaureate_female + non_degree_female) AS overall_total
          FROM scholarship_grants
          WHERE year = 2025
          GROUP BY type_of_scholarship";

$result = mysqli_query($con, $query);

if (!$result) {
    die("SQL Error: " . mysqli_error($con)); 
}

while ($row = mysqli_fetch_assoc($result)) {
    // Properly outputting data for CSV formatting
    echo '"' . htmlspecialchars($row['type_of_scholarship']) . '",'
        . '"' . $row['male_total'] . '",'
        . '"' . $row['female_total'] . '",'
        . '"' . $row['overall_total'] . '"'
        . "\n";
}
?>