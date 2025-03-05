<?php
include '../components/config.php';

if (empty($_SESSION['member_id'])) {
    header('Location: ../index.php');
    exit();
}

$member_id = $_SESSION['member_id'];

// Fetch purchases
$purchases_query = "
    SELECT 
        p.item, 
        p.purpose, 
        p.amount, 
        p.purchase_date, 
        m.member_first, 
        m.member_last 
    FROM 
        purchases p
    JOIN 
        member m ON p.member_id = m.member_id
    WHERE 
        p.member_id = ?
";
$stmt = $con->prepare($purchases_query);
if ($stmt === false) {
    die('Prepare failed: ' . htmlspecialchars($con->error));
}
$stmt->bind_param("i", $member_id);
$stmt->execute();
$purchases_result = $stmt->get_result();
$stmt->close();
?>