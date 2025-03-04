<?php
session_start();
include '../components/config.php';

// Set content type to JSON for proper AJAX response
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $response = ['success' => false, 'message' => ''];
    
    // Validate input
    if (!isset($_POST['member_id']) || !isset($_POST['data'])) {
        $response['message'] = 'Missing required parameters';
        echo json_encode($response);
        exit;
    }

    $member_id = $_POST['member_id'];
    $data = json_decode($_POST['data'], true); 
    
    if ($data === null) {
        $response['message'] = 'Invalid JSON data';
        echo json_encode($response);
        exit;
    }
    
    try {
        // Start transaction
        $con->begin_transaction();
        
        // First, delete existing records for this member to avoid duplicates
        $delete_stmt = $con->prepare("DELETE FROM trainings_conferences WHERE member_id = ?");
        $delete_stmt->bind_param("i", $member_id);
        $delete_stmt->execute();
        $delete_stmt->close();
        
        // Prepare the SQL statement for insertion
        $stmt = $con->prepare("INSERT INTO trainings_conferences (member_id, level, faculty_male, faculty_female, faculty_total, non_academic_male, non_academic_female, non_academic_total, total_male, total_female, total) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        if ($stmt === false) {
            throw new Exception('Prepare failed: ' . $con->error);
        }
        
        foreach ($data as $row) {
            $level = $row['level'];
            $faculty_male = (int)$row['faculty_male'];
            $faculty_female = (int)$row['faculty_female'];
            $non_academic_male = (int)$row['non_academic_male'];
            $non_academic_female = (int)$row['non_academic_female'];
            
            // Calculate totals
            $faculty_total = $faculty_male + $faculty_female;
            $non_academic_total = $non_academic_male + $non_academic_female;
            $total_male = $faculty_male + $non_academic_male;
            $total_female = $faculty_female + $non_academic_female;
            $total = $total_male + $total_female;
            
            // Bind the parameters
            $stmt->bind_param("isiiiiiiiii", $member_id, $level, $faculty_male, $faculty_female, $faculty_total, 
                $non_academic_male, $non_academic_female, $non_academic_total, $total_male, $total_female, $total);
            
            // Execute the statement
            if (!$stmt->execute()) {
                throw new Exception('Execute failed: ' . $stmt->error);
            }
        }
        
        $stmt->close();
        
        // Commit transaction
        $con->commit();
        
        $response['success'] = true;
        $response['message'] = 'Data saved successfully!';
    } catch (Exception $e) {
        // Rollback transaction on error
        $con->rollback();
        $response['message'] = 'Error: ' . $e->getMessage();
    } finally {
        $con->close();
    }
    
    echo json_encode($response);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>