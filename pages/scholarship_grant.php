<?php
session_start();

if (!isset($_SESSION["member_id"])) {
    $_SESSION["member_id"] = 1;
}

$member_id = $_SESSION["member_id"];

// Determine category from URL parameter (default to Faculty)
$category = isset($_GET['category']) ? $_GET['category'] : 'Faculty';
$categoryTitle = $category === 'Non-Academic Staff' ? 'Scholarship Grants for Non-Academic Staff' : 'Scholarship Grants for Faculty';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $categoryTitle; ?></title>
    <link rel="stylesheet" href="../styles/styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">
    <link rel="stylesheet" href="../styles/header_style.css">
    <link rel="stylesheet" href="../styles/hover.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<style>
    .toggle-buttons {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-bottom: 20px;
    }

    .toggle-btn {
        padding: 10px 20px;
        font-size: 16px;
        border: none;
        cursor: pointer;
        border-radius: 5px;
        transition: background-color 0.3s ease-in-out, color 0.3s ease-in-out;
    }

    .btn-faculty {
        background-color: #007bff;
        color: white;
    }

    .btn-non-faculty {
        background-color: #28a745;
        color: white;
    }

    .toggle-btn:hover {
        opacity: 0.8;
    }

    /* Active state */
    .toggle-btn.active {
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        transform: scale(1.05);
    }
</style>

<body>

<?php include '../components/header.php'; ?>

<div class="container my-5">
    <div class="category-header">
        <h1 class="h2 mb-0 text-center"><?php echo $categoryTitle; ?></h1>
    </div>

    <!-- Navigation buttons -->
    <div class="d-flex justify-content-end gap-3 mb-3 mt-5">
        <a href="?category=Faculty" class="btn btn-info toggle-btn" id="facultyBtn">Faculty</a>
        <a href="?category=Non-Academic Staff" class="btn btn-info toggle-btn" id="nonFacultyBtn">Non-Academic Staff</a>
        <button class="btn btn-success addRowBtn">Add Row</button>
        <button class="btn btn-primary submitData">Save Data</button>
    </div>

    
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th rowspan="2">Type of Scholarship</th>
                <th colspan="3">Doctorate Degree</th>
                <th colspan="3">Masters Degree</th>
                <th colspan="3">Post-baccalaureate Degree</th>
                <th colspan="3">Baccalaureate Degree</th>
                <th colspan="3">Non-Degree Course</th>
            </tr>
            <tr>
                <?php for ($i = 0; $i < 5; $i++): ?>
                    <th>Male</th>
                    <th>Female</th>
                    <th>Total</th>
                <?php endfor; ?>
            </tr>
        </thead>
        <tbody id="scholarshipTable">
            <?php 
            $scholarship_types = [
                "Institutional Scholarship",
                "Government-sponsored Scholarship",
                "Private, NGOs and Other Scholarship",
                "Merit Scholarship"
            ];
            
            foreach ($scholarship_types as $type): ?>
                <tr>
                    <td><?php echo $type; ?></td>
                    <?php for ($i = 0; $i < 5; $i++): ?>
                        <td contenteditable="true">0</td>
                        <td contenteditable="true">0</td>
                        <td contenteditable="true">0</td>
                    <?php endfor; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        function addNewRow() {
            let tableBody = document.getElementById("scholarshipTable");
            let newRow = tableBody.insertRow();
            
            let typeCell = newRow.insertCell(0);
            typeCell.contentEditable = "true";
            typeCell.textContent = "New Scholarship Type";
            
            for (let i = 0; i < 5; i++) {
                let maleCell = newRow.insertCell();
                maleCell.contentEditable = "true";
                maleCell.textContent = "0";
                
                let femaleCell = newRow.insertCell();
                femaleCell.contentEditable = "true";
                femaleCell.textContent = "0";
                
                let totalCell = newRow.insertCell();
                totalCell.contentEditable = "true";
                totalCell.textContent = "0";
            }
        }

        document.querySelector(".addRowBtn").addEventListener("click", addNewRow);

        document.querySelector(".submitData").addEventListener("click", function () {
            let tableBody = document.getElementById("scholarshipTable");
            let data = [];

            Array.from(tableBody.rows).forEach(row => {
                let rowData = [];
                Array.from(row.cells).forEach(cell => {
                    rowData.push(cell.textContent.trim());
                });
                data.push(rowData);
            });

            fetch("../controllers/save_scholarships.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ 
                    tableData: data, 
                    category: "<?php echo $category; ?>"
                })
            })
            .then(response => response.json())
            .then(result => {
                if (result.status === "success") {
                    alert("Data Saved Successfully!");
                } else {
                    alert("Error: " + result.message);
                }
            })
            .catch(error => console.error("Error:", error));
        });
    });
</script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="../js/hover.js"></script>

</body>
</html>