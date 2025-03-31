<?php
session_start();
include '../components/config.php'; // Database connection

// Check if the user is logged in
if (!isset($_SESSION['member_id'])) {
    header('Location: ../index.php');
    exit;
}

// Get the member ID from the session
$member_id = $_SESSION['member_id'];

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Prepare the ENUM value for the table being complied
    $table_complied = 'internalization'; // ENUM value for this table

    // Loop through the submitted data
    $indicators = $_POST['indicators'] ?? [];
    $targets = $_POST['targets'] ?? [];
    $budgets = $_POST['budgets'] ?? [];
    $sources = $_POST['sources'] ?? [];
    $offices = $_POST['offices'] ?? [];

    // Prepare the SQL statement
    $stmt = $con->prepare("
        INSERT INTO compliance_data (member_id, table_complied, indicator, target, budget, source, office)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");

    // Bind parameters and execute for each row
    foreach ($indicators as $index => $indicator) {
        $target = $targets[$index] ?? '';
        $budget = $budgets[$index] ?? '';
        $source = $sources[$index] ?? '';
        $office = $offices[$index] ?? '';

        $stmt->bind_param('issssss', $member_id, $table_complied, $indicator, $target, $budget, $source, $office);
        $stmt->execute();
    }

    // Close the statement and redirect
    $stmt->close();
    header('Location: internalization.php?success=1');
    exit;
} else {
    header('Location: internalization.php');
    exit;
}