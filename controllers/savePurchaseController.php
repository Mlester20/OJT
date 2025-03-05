<?php
session_start();
include '../components/config.php';

if (empty($_SESSION['member_id'])) {
    header('HTTP/1.1 401 Unauthorized');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $member_id = $_SESSION['member_id'];
    $item = $_POST['item'];
    $purpose = $_POST['purpose'];
    $amount = $_POST['amount'];

    $stmt = $con->prepare("INSERT INTO purchases (member_id, item, purpose, amount) VALUES (?, ?, ?, ?)");
    if ($stmt === false) {
        header('HTTP/1.1 500 Internal Server Error');
        exit();
    }
    $stmt->bind_param("issd", $member_id, $item, $purpose, $amount);
    if ($stmt->execute()) {
        header('HTTP/1.1 200 OK');
    } else {
        header('HTTP/1.1 500 Internal Server Error');
    }
    $stmt->close();
}
?>