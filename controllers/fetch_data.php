<?php
//fetch data for awards
$awards_query = "SELECT 
    a.*,
    m.member_first,
    m.member_last,
    o.office_name
    FROM awards a
    LEFT JOIN member m ON a.member_id = m.member_id
    LEFT JOIN office_name o ON m.office_id = o.office_id
    ORDER BY a.date DESC";
$awards_result = mysqli_query($con, $awards_query) or die(mysqli_error($con));

//fetch data for employees
$employee_query = "SELECT 
a.*,
m.member_first,
m.member_last,
o.office_name
FROM employees a
LEFT JOIN member m ON a.member_id = m.member_id
LEFT JOIN office_name o ON m.office_id = o.office_id";
$employee_result = mysqli_query($con, $employee_query) or die(mysqli_error($con));

//fetch data for faculty scholarships grants 
$facultyScholarshipQuery = "SELECT 
    type_of_scholarship,
    SUM(doctorate_male + masters_male + post_baccalaureate_male + baccalaureate_male + non_degree_male) AS male_total,
    SUM(doctorate_female + masters_female + post_baccalaureate_female + baccalaureate_female + non_degree_female) AS female_total,
    SUM(doctorate_male + masters_male + post_baccalaureate_male + baccalaureate_male + non_degree_male +
        doctorate_female + masters_female + post_baccalaureate_female + baccalaureate_female + non_degree_female) AS overall_total
    FROM scholarship_grants
    WHERE category = 'Faculty'
    GROUP BY type_of_scholarship";

$facultyScholarshipResult = $con->query($facultyScholarshipQuery);

if (!$facultyScholarshipResult) {
    die("Query Error: " . $con->error); 
}

//fetch data for non-academic staff scholarships grants 
$nonAcademicScholarshipQuery = "SELECT 
    type_of_scholarship,
    SUM(doctorate_male + masters_male + post_baccalaureate_male + baccalaureate_male + non_degree_male) AS male_total,
    SUM(doctorate_female + masters_female + post_baccalaureate_female + baccalaureate_female + non_degree_female) AS female_total,
    SUM(doctorate_male + masters_male + post_baccalaureate_male + baccalaureate_male + non_degree_male +
        doctorate_female + masters_female + post_baccalaureate_female + baccalaureate_female + non_degree_female) AS overall_total
    FROM scholarship_grants
    WHERE category = 'Non-Academic Staff'
    GROUP BY type_of_scholarship";

$nonAcademicScholarshipResult = $con->query($nonAcademicScholarshipQuery);

if (!$nonAcademicScholarshipResult) {
    die("Query Error: " . $con->error); 
}

//fetch data for non academic staff
$non_academic_staff_query = "SELECT 
staff_id,
member_id,
category,
sub_category,
male_count,
female_count,
total_count
FROM non_academic_staff";

$non_academic_staff_result = mysqli_query($con, $non_academic_staff_query) or die(mysqli_error($con));

?>