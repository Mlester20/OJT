<?php
include '../components/config.php';

header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=employees_list.csv");
header("Pragma: no-cache");
header("Expires: 0");

// Output CSV headers
echo "Employee ID,Name,Sex,Employment Status,Disability Type,Campus,Year Complied\n";

// SQL Query
$query = "SELECT 
            employee_id, 
            name, 
            sex, 
            employment_status, 
            disability_type, 
            campus, 
            year
          FROM employees
          WHERE year = 2025
          ORDER BY date_created DESC";

$result = mysqli_query($con, $query);

if (!$result) {
    die("SQL Error: " . mysqli_error($con)); 
}

while ($row = mysqli_fetch_assoc($result)) {
    // Properly outputting data for CSV formatting
    echo '"' . htmlspecialchars($row['employee_id']) . '",'
        . '"' . htmlspecialchars($row['name']) . '",'
        . '"' . htmlspecialchars($row['sex']) . '",'
        . '"' . htmlspecialchars($row['employment_status']) . '",'
        . '"' . htmlspecialchars($row['disability_type']) . '",'
        . '"' . htmlspecialchars($row['campus']) . '",'
        . '"' . htmlspecialchars($row['year']) . '"'
        . "\n";
}
?>