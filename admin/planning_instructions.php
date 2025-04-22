<?php
session_start();
include '../components/config.php';

    if(!isset($_SESSION['member_id'])) {
        header('location: ../index.php');
        exit;
    }

?>
<!DOCTYPE html>
<html>

<head>
    <title>Quarterly Accomplishment Monitoring Report - <?php include '../components/title.php'; ?> </title>
    <link rel="stylesheet" href="../styles/styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">
    <link rel="stylesheet" href="../styles/header_style.css">
    <link rel="stylesheet" href="../styles/hover.css">
    <link rel="stylesheet" href="../styles/darkLight.css">
    <script src="../js/darkLight.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2,
        h3 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: auto;
            background: white;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
            word-wrap: break-word;
        }

        th {
            background-color: rgb(24, 128, 27);
            color: white;
        }

        input,
        textarea {
            width: 100%;
            min-width: 150px;
            text-align: center;
            padding: 5px;
            border: 1px solid #ccc;
            background: transparent;
            box-sizing: border-box;
            overflow: auto;
            resize: both;
        }

        .header {
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: center;
        }

        button {
            padding: 10px 15px;
            background: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            margin-top: 20px;
            display: block;
            width: 200px;
            margin-left: auto;
            margin-right: auto;
            border-radius: 5px;
            transition: 0.3s;
        }

        button:hover {
            background: #388E3C;
        }
    </style>
</head>
<body>

    <?php include '../components/header_admin.php'; ?>

    <div class="container">
        <h2 class="header mt-5">Republic of the Philippines<br>ISABELA STATE UNIVERSITY<br>Roxas Campus</h2>
        <h3 class="header mt-5">QUARTERLY ACCOMPLISHMENT MONITORING REPORT</h3>

        <form method="post" action="process.php">
            <div class="form-group">
                <label for="quarter">Quarter:</label>
                <select name="quarter" id="quarter">
                    <option value="First Quarter">First Quarter</option>
                    <option value="Second Quarter">Second Quarter</option>
                    <option value="Third Quarter">Third Quarter</option>
                    <option value="Fourth Quarter">Fourth Quarter</option>
                </select>
                <label for="year">Year:</label>
                <input type="text" name="year" value="2025" readonly>
            </div>

            <h4 style="text-align: center;">KRA: INSTRUCTION</h4>
            <p style="text-align: center;"><em>Strategic Goal 1: Sustain and Enhance Academic Excellence</em></p>

            <table>
                <tr>
                    <th>Objectives</th>
                    <th></th>
                    <th>Performance Indicators</th>
                    <th>FY 2025 Targets</th>
                    <th>Accomplishment</th>
                    <th>Variance</th>
                    <th>Explanation of Variance</th>
                    <th>Means of Verification (MOV)</th>
                </tr>
                <tr>
                    <td colspan="8"><strong>GAA/PREXC/PBB INDICATORS</strong></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <h4>HIGHER EDUCATION PROGRAM</h4>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <h4>Outcome Idicators</h4>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">1. Percentage of
                        first-time licensure exam takers that pass the licensure exams</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">60%</td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">2. Percentage of
                        graduates (2 years prior) that are employed</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">37%</td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <h4>Output Idicators</h4>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">1. Percentage of
                        undergraduate student population enrolled in CHED-identified and RDC-identified priority
                        programs</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">61.29%</td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">2. Percentage of
                        undergraduate programs with accreditation status</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">85%</td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td colspan="8"><strong>ADVANCED EDUCATION PROGRAM</strong></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <h4>Outcome Idicators</h4>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">1. Percentage of
                        graduate school faculty engaged in research work applied in any of the following:</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">a. pursuing
                        advanced research degree programs (Ph.D)</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">b. actively
                        pursuing in the last three (3) years (investigative research, basic and applied scientific
                        research, policy research, social science research)</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">54.54%</td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">c. producing
                        technologies for commercialization or livelihood improvement</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">d. whose research
                        work resulted in an extension program</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <h4>Output Idicators</h4>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">1. Percentage of
                        graduate students enrolled in research degree programs</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">97%</td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">2. Percentage of
                        accredited graduate programs</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">63%</td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <h4>SUC LEVELLING INDICATORS</h4>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>1</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">Average number of
                        weighted fulltime equivalent students (WFTEs) per semester</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">5,000.00</td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td></td>
                    <td>2</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">Average percentage
                        of students enrolled as scholars per semester (undergraduate and graduate levels) over the total
                        enrollment</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">5%</td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td></td>
                    <td>3</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">Average percentage
                        of grantees per semester over total enrollment</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">100%</td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td></td>
                    <td>4</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">Percentage of
                        students involved in inter-country mobility</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">-</td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td></td>
                    <td>5</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">Percentage of
                        graduates who were employed within the first two years after graduation</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">37%</td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td></td>
                    <td>6</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">Percentage of the
                        plantilla faculty members who are doctoral degree holders during the school year</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td></td>
                    <td>7</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">Number of
                        accredited Undergraduate programs:</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">6</td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td></td>
                    <td>8</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">Number of
                        accredited Graduate programs:</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">LEVEL I</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">LEVEL II</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">3</td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">LEVEL III</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">3</td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">LEVEL IV</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td></td>
                    <td>9</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">No. of campus ISO
                        9001:2015 Certified</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">1</td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td></td>
                    <td>10</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">Number of COE/COD:
                    </td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">- COE</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>"> NUCAF</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">- COD</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">PIAF</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">1</td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td></td>
                    <td>11</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">Average of
                        licensure/board programs with passing rate higher than the national passing percentage</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">50%</td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td colspan="8"><strong>OTHER PERFORMANCE INDICATORS</strong></td>
                </tr>
                <tr>
                    <td>Implement a unified (flagship concepts) and Program Relevance</td>
                    <td>1</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">Percentage of
                        undergraduate programs with COPC</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">100%</td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td></td>
                    <td>2</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">Percentage of
                        graduate programs with COPC</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">100% </td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td></td>
                    <td>3</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">Number of programs
                        accredited with Institutional Sustainability Assessment</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">-</td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td rowspan="2">Improve physical and other learning facilities</td>
                    <td>4</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">Number of
                        constructed and/or refurbished relevant learning facilities as required by accrediting bodies
                    </td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">1</td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td>5</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">Percentage of
                        modernized laboratory equipment and computers compliant to CHED requirement and standards</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">100%</td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td rowspan="2">Streamline and align curricular offerings with education demands in campuses</td>
                    <td>6</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">Number of
                        identified banner programs</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">1</td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td>7</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">Percentage of
                        campuses with banner programs</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">-</td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td></td>
                    <td>8</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">Increased
                        percentage of rationalized program</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">-</td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td>Promotion of program quality standards</td>
                    <td>9</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">Percentage of
                        curriculum reviewed and improved</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">-</td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td rowspan="2">Broaden access to quality programs</td>
                    <td>10</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">Number of CHED
                        accredited programs</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">8</td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td>11</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">Percentage of
                        accredited programs to total number of programs</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">50%</td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td rowspan="17">Offering of quality programs</td>
                    <td>12</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">No of IMs produced
                        per faculty per year</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">1</td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td>13</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">No. of IMs
                        evaluated by the Univ. committee/year</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">-</td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td>14</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">No. of IMs
                        accepted by the Univ. committee/year</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">-</td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td>15</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">No. of faculty
                        observed</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">50</td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td>16</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">No. of faculty
                        evaluated</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">50</td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td>17</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">No. of faculty
                        with improved performance/improved teaching strategies</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td>18</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">No. of faculty who
                        utilize pedagogical strategies to support effective and meaningful learning</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td>19</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">No. of developed
                        and implemented academic program delivery modalities</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td>20</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">No. of conducted
                        faculty development programs</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">1</td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td>21</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">No. of syllabi
                        improved and distributed to students</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td>22</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">Percentage of
                        syllabi followed in class</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">100%</td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td>23</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">No. of recruited
                        faculty who are doctorate degree holders</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">-</td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td>24</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">No. of new
                        programs offered</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">-</td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td>25</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">No. of courses
                        evaluated offering OJT/Immersion</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">7</td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td>26</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">No. of tracer
                        studies conducted/evaluated</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">1</td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td>27</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">Percentage of
                        programs having adequate laboratory facility compliant to CHED standards</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">28%</td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td>28</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">Percentage of
                        classroom with at least an AV projection facility (functional)</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">83%</td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td rowspan="12">Support the delivery of academic programs through state-of-the-art infrastrctures
                        and facilities</td>
                    <td>29</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">Percentage of
                        classroom meeting the minimum standards set by CHED</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">100%</td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td>30</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">Percentage of
                        colleges/institutes/centers having divert access to internet on online learning services</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>">100%</td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td>31</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>"></td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td>32</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>"></td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td>33</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>"></td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td>34</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>"></td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td>35</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>"></td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td>36</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>"></td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td>37</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>"></td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td>38</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>"></td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td>39</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>"></td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
                <tr>
                    <td>40</td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>"></td>
                    <td class="editable" contenteditable="<?php echo $isAdmin ? 'true' : 'false'; ?>"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                    <td class="editable" contenteditable="true"></td>
                </tr>
            </table>

            <button type="submit">Submit</button>
        </form>
    </div>

    <!-- scripts -->
    <script src="../js/controls.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="../js/notif.js"></script>

</body>
</html>