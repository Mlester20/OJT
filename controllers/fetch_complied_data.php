<?php
include '../components/config.php';
session_start();

if (!isset($_SESSION['member_id'])) {
    die('Member ID not set in session.');
}

$member_id = $_SESSION['member_id']; 
$current_year = date('Y'); 

// Fetch awards for the logged-in user
$awards_query = "SELECT 
    award,
    conferred_to,
    conferred_by,
    date,
    date_ended,
    venue,
    category,
    year
    FROM awards
    WHERE year = ? AND member_id = ?
    ORDER BY date DESC";

$stmt = $con->prepare($awards_query);
if ($stmt === false) {
    die('Prepare failed: ' . htmlspecialchars($con->error));
}
$stmt->bind_param("ii", $current_year, $member_id);
$stmt->execute();
$awards_result = $stmt->get_result();
if ($awards_result === false) {
    die('Execute failed: ' . htmlspecialchars($stmt->error));
}
$stmt->close();

// Fetch employees for the logged-in user
$employee_query = "SELECT 
    name,
    sex,
    employment_status,
    disability_type,
    campus,
    year
    FROM employees
    WHERE year = ? AND member_id = ?";

$stmt = $con->prepare($employee_query);
if ($stmt === false) {
    die('Prepare failed: ' . htmlspecialchars($con->error));
}
$stmt->bind_param("ii", $current_year, $member_id);
$stmt->execute();
$employee_result = $stmt->get_result();
if ($employee_result === false) {
    die('Execute failed: ' . htmlspecialchars($stmt->error));
}
$stmt->close();

// Fetch faculty scholarship grants
$facultyScholarshipQuery = "SELECT 
    type_of_scholarship,
    SUM(doctorate_male + masters_male + post_baccalaureate_male + baccalaureate_male + non_degree_male) AS male_total,
    SUM(doctorate_female + masters_female + post_baccalaureate_female + baccalaureate_female + non_degree_female) AS female_total,
    SUM(doctorate_male + masters_male + post_baccalaureate_male + baccalaureate_male + non_degree_male +
        doctorate_female + masters_female + post_baccalaureate_female + baccalaureate_female + non_degree_female) AS overall_total
    FROM scholarship_grants
    WHERE category = 'Faculty' AND year = ? AND member_id = ?
    GROUP BY type_of_scholarship";

$stmt = $con->prepare($facultyScholarshipQuery);
if ($stmt === false) {
    die('Prepare failed: ' . htmlspecialchars($con->error));
}
$stmt->bind_param("ii", $current_year, $member_id);
$stmt->execute();
$facultyScholarshipResult = $stmt->get_result();
if ($facultyScholarshipResult === false) {
    die('Execute failed: ' . htmlspecialchars($stmt->error));
}
$stmt->close();

// Fetch non-academic staff scholarship grants
$nonAcademicScholarshipQuery = "SELECT 
    type_of_scholarship,
    SUM(doctorate_male + masters_male + post_baccalaureate_male + baccalaureate_male + non_degree_male) AS male_total,
    SUM(doctorate_female + masters_female + post_baccalaureate_female + baccalaureate_female + non_degree_female) AS female_total,
    SUM(doctorate_male + masters_male + post_baccalaureate_male + baccalaureate_male + non_degree_male +
        doctorate_female + masters_female + post_baccalaureate_female + baccalaureate_female + non_degree_female) AS overall_total
    FROM scholarship_grants
    WHERE category = 'Non-Academic Staff' AND year = ? AND member_id = ?
    GROUP BY type_of_scholarship";

$stmt = $con->prepare($nonAcademicScholarshipQuery);
if ($stmt === false) {
    die('Prepare failed: ' . htmlspecialchars($con->error));
}
$stmt->bind_param("ii", $current_year, $member_id);
$stmt->execute();
$nonAcademicScholarshipResult = $stmt->get_result();
if ($nonAcademicScholarshipResult === false) {
    die('Execute failed: ' . htmlspecialchars($stmt->error));
}
$stmt->close();

// Fetch non-academic staff details
$non_academic_staff_query = "SELECT 
    category,
    sub_category,
    male_count,
    female_count,
    total_count
    FROM non_academic_staff
    WHERE year = ? AND member_id = ?";

$stmt = $con->prepare($non_academic_staff_query);
if ($stmt === false) {
    die('Prepare failed: ' . htmlspecialchars($con->error));
}
$stmt->bind_param("ii", $current_year, $member_id);
$stmt->execute();
$non_academic_staff_result = $stmt->get_result();
if ($non_academic_staff_result === false) {
    die('Execute failed: ' . htmlspecialchars($stmt->error));
}
$stmt->close();

?>