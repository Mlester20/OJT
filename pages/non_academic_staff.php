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
    <title>Dynamic Table with PHP & JS</title>
    <link rel="stylesheet" href="../styles/styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">
    <link rel="stylesheet" href="../styles/header_style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background-color: #f8fafc;
            font-family: Arial, sans-serif;
        }

        .table-container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .personnel-header {
            background: #002060;
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            border-radius: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #cbd5e0;
            padding: 12px;
            text-align: ;
            font-size: 14px;
            width: 100px;
        }

        th {
            background-color: #d9e2c7;
            font-weight: bold;
        }

        .category {
            background-color: #e6efdb;
            font-weight: ;
            text-align: left;
        }

        .sub-category {
            font-style: italic;
            text-align: left;
            padding-left: 20px;
        }

        .male {
            background-color: #b4c7e7;
        }

        .female {
            background-color: #fcd5b4;
        }

        .total {
            background-color: #eaeaea;
            font-weight: bold;
        }

        tfoot td {
            background-color: #d9e2c7;
            font-weight: bold;
        }

        input {
            width: 60px;
            text-align: center;
            border: none;
            background: transparent;
            font-weight: bold;
        }

        input:focus {
            outline: none;
            background: #fff;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>
<?php include '../components/header.php'; ?>

    <div class="container my-5">
        <div class="personnel-header">NON-ACADEMIC STAFF</div>
        <div class="table-container">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th rowspan="2">GENERIC RANK</th>
                        <th colspan="3">Total no. of Personnel</th>
                    </tr>
                    <tr>
                        <th class="male">Male</th>
                        <th class="female">Female</th>
                        <th class="total">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $categories = [
                        "Permanent/Regular" => [
                            "Administrative Officers and other employees holding positions requiring CS Prof or PRC License",
                            "Administrative Aides and other employees holding positions requiring CS Sub-prof or TESDA Certification",
                            "Other employees holding positions not requiring CS Eligibility or TESDA Certification"
                        ],
                        "Casual" => ["University", "Campus"],
                        "Contractual" => [],
                        "Job Order" => [],
                        "Job Contract/COS" => []
                    ];

                    foreach ($categories as $category => $subcategories) {
                        echo "<tr class='category'>
                                <td>$category</td>
                                <td class='male'><input type='number' class='male-input' value='0'></td>
                                <td class='female'><input type='number' class='female-input' value='0'></td>
                                <td class='total'><span>0</span></td>
                              </tr>";
                        
                        foreach ($subcategories as $sub) {
                            echo "<tr class='sub-category'>
                                    <td>$sub</td>
                                    <td class='male'><input type='number' class='male-input' value='0'></td>
                                    <td class='female'><input type='number' class='female-input' value='0'></td>
                                    <td class='total'><span>0</span></td>
                                  </tr>";
                        }
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td>TOTAL</td>
                        <td class="male"><span id="total-male">0</span></td>
                        <td class="female"><span id="total-female">0</span></td>
                        <td class="total"><span id="grand-total">0</span></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            function calculateTotals() {
                let totalMale = 0, totalFemale = 0, grandTotal = 0;

                $("tbody tr").each(function() {
                    let male = parseInt($(this).find(".male-input").val()) || 0;
                    let female = parseInt($(this).find(".female-input").val()) || 0;
                    let rowTotal = male + female;

                    $(this).find(".total span").text(rowTotal);
                    totalMale += male;
                    totalFemale += female;
                });

                grandTotal = totalMale + totalFemale;
                $("#total-male").text(totalMale);
                $("#total-female").text(totalFemale);
                $("#grand-total").text(grandTotal);
            }

            $(".male-input, .female-input").on("input", function() {
                calculateTotals();
            });

            calculateTotals(); // Initial Calculation
        });
    </script>
</body>
</html>
