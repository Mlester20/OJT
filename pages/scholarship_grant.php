<?php
session_start();

if (!isset($_SESSION["member_id"])) {
    $_SESSION["member_id"] = 1;
}

$member_id = $_SESSION["member_id"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scholarship Grants</title>
    <link rel="stylesheet" href="../styles/styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">
    <link rel="stylesheet" href="../styles/header_style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .category-header {
            background: #f0f8f0;
            padding: 10px;
            border-left: 5px solid #2c5282;
            font-weight: bold;
            text-align: center;
        }
        .btn {
            padding: 5px 10px;
            cursor: pointer;
        }
        .btn-success {
            background-color: green;
            color: white;
        }
        .btn-primary {
            background-color: blue;
            color: white;
        }
    </style>
</head>
<body>

<?php include '../components/header.php'; ?>

<div class="container my-5">
    <?php 
    $sections = [
        "Faculty" => "facultyTable",
        "Non-Academic Staff" => "staffTable"
    ];
    
    $scholarship_types = [
        "Institutional Scholarship",
        "Government-sponsored Scholarship",
        "Private, NGOs and Other Scholarship",
        "Merit Scholarship"
    ];
    
    foreach ($sections as $section => $tableId): ?>
    <div class="category-header">
        <h1 class="h2 mb-0">Scholarship Grants for <?php echo $section; ?></h1>
    </div>

    <div class="d-flex justify-content-end gap-3 mb-3">
        <button class="btn btn-success addRowBtn" data-table="<?php echo $tableId; ?>">Add Row</button>
        <button class="btn btn-primary saveDataBtn" data-table="<?php echo $tableId; ?>" data-endpoint="save_<?php echo strtolower(str_replace(' ', '_', $section)); ?>.php">Save Data</button>
    </div>
    
    <table class="table table-bordered mt-4" id="<?php echo $tableId; ?>">
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
        <tbody>
            <?php foreach ($scholarship_types as $type): ?>
                <tr>
                    <td><?php echo $type; ?></td>
                    <?php for ($i = 0; $i < 5; $i++): ?>
                        <td contenteditable="true">0</td>
                        <td contenteditable="true">0</td>
                        <td contenteditable="true">0</td>
                    <?php endfor; ?>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td><strong>TOTAL</strong></td>
                <?php for ($i = 0; $i < 5; $i++): ?>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                <?php endfor; ?>
            </tr>
        </tbody>
    </table>
    <?php endforeach; ?>
</div>

<script>
    $(document).ready(function () {
        function addRow(tableID) {
            let newRow = `<tr><td contenteditable='true'>New Scholarship Type</td>`;
            for (let i = 0; i < 5; i++) {
                newRow += `<td contenteditable='true'>0</td><td contenteditable='true'>0</td><td contenteditable='true'>0</td>`;
            }
            newRow += `</tr>`;
            $("#" + tableID + " tbody").append(newRow);
        }

        $(".addRowBtn").click(function () {
            addRow($(this).data("table"));
        });

        function saveData(tableID, endpoint) {
            let data = [];
            $("#" + tableID + " tbody tr").each(function () {
                let rowData = [];
                $(this).find("td").each(function () {
                    rowData.push($(this).text().trim());
                });
                data.push(rowData);
            });
            $.post(endpoint, { tableData: JSON.stringify(data) }, function (response) {
                alert("Data Saved!\n" + response);
            });
        }

        $(".saveDataBtn").click(function () {
            saveData($(this).data("table"), $(this).data("endpoint"));
        });
        
    });
</script>

</body>
</html>
