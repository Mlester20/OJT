<?php
session_start();
include '../controllers/purchaseController.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Major Purchases - <?php include '../components/title.php'; ?> </title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../styles/styles.css">
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../styles/user_header.css">
    <link rel="stylesheet" href="../styles/hover.css">
    <link rel="stylesheet" href="../styles/darkLight.css">
    <script src="../js/darkLight.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    
    <?php include '../components/header_admin.php'; ?>

    <div class="container my-5">
        <h3 class="card-title text-center text-muted">List of Major Purchases</h3>
        
        <!-- Form to add new purchase -->
        <form id="purchaseForm" class="mb-4">
            <div class="mb-3">
                <label for="item" class="form-label">Item</label>
                <input type="text" class="form-control" id="item" name="item" required>
            </div>
            <div class="mb-3">
                <label for="purpose" class="form-label">Purpose</label>
                <input type="text" class="form-control" id="purpose" name="purpose" required>
            </div>
            <div class="mb-3">
                <label for="amount" class="form-label">Amount</label>
                <input type="number" step="0.01" class="form-control" id="amount" name="amount" required>
            </div>
            <button type="submit" class="btn btn-primary">Save Purchase</button>
        </form>
    </div>

    <?php include '../components/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="../js/notif.js"></script>
    <script>
        $(document).ready(function() {
            $('#purchaseForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    type: 'POST',
                    url: '../controllers/savePurchaseController.php',
                    data: $(this).serialize(),
                    success: function(response) {
                        alert('Purchase saved successfully!');
                        location.reload();
                    },
                    error: function() {
                        alert('Error saving purchase.');
                    }
                });
            });
        });
    </script>
</body>
</html>