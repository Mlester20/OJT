<?php
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logging Out...</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .logout-container {
            text-align: center;
            animation: fadeOut 2s forwards;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .spinner {
            border: 4px solid rgba(0, 0, 0, 0.1);
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border-left-color: #343a40;
            animation: spin 1s linear infinite;
            margin-bottom: 10px;
        }
        .logout-text {
            font-size: 1.5rem;
            color: #343a40;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        @keyframes fadeOut {
            0% { opacity: 1; }
            100% { opacity: 0; }
        }
    </style>
</head>
<body>
    <div class="logout-container">
        <div class="spinner"></div>
        <div class="logout-text">Logging out...</div>
    </div>

    <script>
        setTimeout(function() {
            window.location.href = '../index.php';
        }, 2000); // Redirect after 2 seconds
    </script>
</body>
</html>