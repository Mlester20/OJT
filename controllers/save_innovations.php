<?php
include '../components/config.php';

session_start();
include '../components/config.php';

if (!isset($_SESSION['member_id'])) {
    die("Error: User is not logged in.");
}

    $member_id = $_SESSION['member_id'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['innovations'])) {
        $innovations = json_decode($_POST['innovations'], true);

        if (empty($innovations)) {
            die("Error: No innovations received.");
        }

        $stmt = $con->prepare("INSERT INTO innovations (member_id, name_of_innovation, description) VALUES (?, ?, ?)");
        
        if (!$stmt) {
            die("Prepare failed: " . $con->error);
        }

        foreach ($innovations as $innovation) {
            $name = $innovation['innovation'];
            $description = $innovation['description'];

            $stmt->bind_param("iss", $member_id, $name, $description);
            
            if (!$stmt->execute()) {
                die("Execute failed: " . $stmt->error);
            }
        }

        echo "Innovations saved successfully!";
    } else {
        die("Error: Invalid request.");
    }

?>