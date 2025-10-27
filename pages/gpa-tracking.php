<?php
require_once "components/head.php";

$username = isset($_SESSION["username"]) ? $_SESSION["username"] : null;

if ($username == null) {
    header("Location: log-in");
    exit();
}

require_once "controllers/user.php";

?>

<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
    <title>GPA Tracking || Student Academic Advisory System</title>
    <meta content="Admin Dashboard" name="description">
    <meta content="Mannatthemes" name="author">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="assets/images/favicon.ico"><!-- DataTables -->
    <link href="assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
    <link href="assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css"><!-- Responsive datatable examples -->
    <link href="assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css">
    <!-- Sweet Alert -->
    <link href="assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">
    <style>
        @media(max-width: 575.98px){
            .mobileresponsive{
                overflow: scroll !important;
            }
        }
        
    </style>
</head>

<body class="fixed-left"><!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner"></div>
        </div>
    </div><!-- Begin page -->
    <div id="wrapper"><!-- ========== Left Sidebar Start ========== -->
        <?php require_once "components/sidebar.php"; ?><!-- Start right Content here -->
        <div class="content-page"><!-- Start content -->
            <div class="content"><!-- Top Bar Start -->
                <?php require_once "components/header.php"; ?>
                <div class="page-content-wrapper">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title-box">
                                    <?php require_once "components/userdetails.php";?>
                                    <h4 class="page-title">GPA Tracking</h4>
                                </div>
                            </div>
                        </div><!-- end page title end breadcrumb -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <h4 class="mt-0 header-title">GPA Tracking
                                            <div class="float-right">
                                                <div class="text-center">
                                                    <button type="button" class="btn btn-primary waves-effect waves-light" onclick="window.print();">Print</button>
                                                </div>
                                            </div>
                                        </h4>
                                        <p class="text-muted m-b-30 font-14"></p>
                                        <div class="mobileresponsive">
                                            <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Level</th>
                                                    <th>First Semester GPA</th>
                                                    <th>Second Semester GPA</th>
                                                    <th>CGPA</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if($first_level->num_rows || $second_level->num_rows || $third_level->num_rows || $fourth_level->num_rows || $fifth_level->num_rows) {
                                                ?>

                                                    <?php if($first_level->num_rows){
                                                        $first_level_credit = 0;
                                                        $first_level_result = 0;
                                                        ?>
                                                        <tr>
                                                            <td>100</td>
                                                            <td>
                                                                <?php if($first_level_first_semester->num_rows){

                                                                    $first_level_first_semester->fetch_assoc();

                                                                    $total_credit = 0;
                                                                    $total_result = 0;

                                                                    foreach($first_level_first_semester as $semester){

                                                                        $course_id = $semester["course_id"];

                                                                        $sql = "SELECT * FROM courses WHERE course_id = ? LIMIT 1";
                                                                        $stmt = $conn->prepare($sql);
                                                                        $stmt->bind_param("s", $course_id);
                                                                        $stmt->execute();
                                                                        $course = $stmt->get_result()->fetch_assoc();

                                                                        $total_credit += floatval($course["credit"]);

                                                                        $result = $semester["result"];

                                                                        if($result == "A"){
                                                                            $product = floatval($course["credit"]) * 5;
                                                                            $total_result += $product;
                                                                        } else if($result == "B"){
                                                                            $product = floatval($course["credit"]) * 4;
                                                                            $total_result += $product;
                                                                        } else if($result == "C"){
                                                                            $product = floatval($course["credit"]) * 3;
                                                                            $total_result += $product;
                                                                        } else if($result == "D"){
                                                                            $product = floatval($course["credit"]) * 2;
                                                                            $total_result += $product;
                                                                        } else if($result == "E"){
                                                                            $product = floatval($course["credit"]) * 1;
                                                                            $total_result += $product;
                                                                        } else if($result == "F"){
                                                                            $product = floatval($course["credit"]) * 0;
                                                                            $total_result += $product;
                                                                        }
                                                                    }

                                                                    $first_level_credit += $total_credit;
                                                                    $first_level_result += $total_result;

                                                                    $gpa = $total_result / $total_credit;
                                                                    echo number_format($gpa, 2);
                                                                    
                                                                    ?>
                                                                <?php } else { ?>
                                                                    0.00
                                                                <?php } ?>
                                                            </td>
                                                            <td>
                                                                <?php if($first_level_second_semester->num_rows){

                                                                    $first_level_second_semester->fetch_assoc();

                                                                    $total_credit = 0;
                                                                    $total_result = 0;

                                                                    foreach($first_level_second_semester as $semester){

                                                                        $course_id = $semester["course_id"];

                                                                        $sql = "SELECT * FROM courses WHERE course_id = ? LIMIT 1";
                                                                        $stmt = $conn->prepare($sql);
                                                                        $stmt->bind_param("s", $course_id);
                                                                        $stmt->execute();
                                                                        $course = $stmt->get_result()->fetch_assoc();

                                                                        $total_credit += floatval($course["credit"]);

                                                                        $result = $semester["result"];

                                                                        if($result == "A"){
                                                                            $product = floatval($course["credit"]) * 5;
                                                                            $total_result += $product;
                                                                        } else if($result == "B"){
                                                                            $product = floatval($course["credit"]) * 4;
                                                                            $total_result += $product;
                                                                        } else if($result == "C"){
                                                                            $product = floatval($course["credit"]) * 3;
                                                                            $total_result += $product;
                                                                        } else if($result == "D"){
                                                                            $product = floatval($course["credit"]) * 2;
                                                                            $total_result += $product;
                                                                        } else if($result == "E"){
                                                                            $product = floatval($course["credit"]) * 1;
                                                                            $total_result += $product;
                                                                        } else if($result == "F"){
                                                                            $product = floatval($course["credit"]) * 0;
                                                                            $total_result += $product;
                                                                        }
                                                                    }

                                                                    $first_level_credit += $total_credit;
                                                                    $first_level_result += $total_result;

                                                                    $gpa = $total_result / $total_credit;
                                                                    echo number_format($gpa, 2);
                                                                    
                                                                    ?>
                                                                <?php } else { ?>
                                                                    0.00
                                                                <?php } ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                $cgpa = $first_level_result / $first_level_credit;
                                                                echo number_format($cgpa, 2);
                                                                ?>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>

                                                    <?php if($second_level->num_rows){
                                                        $second_level_credit = 0;
                                                        $second_level_result = 0;
                                                        ?>
                                                        <tr>
                                                            <td>200</td>
                                                            <td>
                                                                <?php if($second_level_first_semester->num_rows){

                                                                    $second_level_first_semester->fetch_assoc();

                                                                    $total_credit = 0;
                                                                    $total_result = 0;

                                                                    foreach($second_level_first_semester as $semester){

                                                                        $course_id = $semester["course_id"];

                                                                        $sql = "SELECT * FROM courses WHERE course_id = ? LIMIT 1";
                                                                        $stmt = $conn->prepare($sql);
                                                                        $stmt->bind_param("s", $course_id);
                                                                        $stmt->execute();
                                                                        $course = $stmt->get_result()->fetch_assoc();

                                                                        $total_credit += floatval($course["credit"]);

                                                                        $result = $semester["result"];

                                                                        if($result == "A"){
                                                                            $product = floatval($course["credit"]) * 5;
                                                                            $total_result += $product;
                                                                        } else if($result == "B"){
                                                                            $product = floatval($course["credit"]) * 4;
                                                                            $total_result += $product;
                                                                        } else if($result == "C"){
                                                                            $product = floatval($course["credit"]) * 3;
                                                                            $total_result += $product;
                                                                        } else if($result == "D"){
                                                                            $product = floatval($course["credit"]) * 2;
                                                                            $total_result += $product;
                                                                        } else if($result == "E"){
                                                                            $product = floatval($course["credit"]) * 1;
                                                                            $total_result += $product;
                                                                        } else if($result == "F"){
                                                                            $product = floatval($course["credit"]) * 0;
                                                                            $total_result += $product;
                                                                        }
                                                                    }

                                                                    $second_level_credit += $total_credit;
                                                                    $second_level_result += $total_result;

                                                                    $gpa = $total_result / $total_credit;
                                                                    echo number_format($gpa, 2);
                                                                    
                                                                    ?>
                                                                <?php } else { ?>
                                                                    0.00
                                                                <?php } ?>
                                                            </td>
                                                            <td>
                                                                <?php if($second_level_second_semester->num_rows){

                                                                    $second_level_second_semester->fetch_assoc();

                                                                    $total_credit = 0;
                                                                    $total_result = 0;

                                                                    foreach($second_level_second_semester as $semester){

                                                                        $course_id = $semester["course_id"];

                                                                        $sql = "SELECT * FROM courses WHERE course_id = ? LIMIT 1";
                                                                        $stmt = $conn->prepare($sql);
                                                                        $stmt->bind_param("s", $course_id);
                                                                        $stmt->execute();
                                                                        $course = $stmt->get_result()->fetch_assoc();

                                                                        $total_credit += floatval($course["credit"]);

                                                                        $result = $semester["result"];

                                                                        if($result == "A"){
                                                                            $product = floatval($course["credit"]) * 5;
                                                                            $total_result += $product;
                                                                        } else if($result == "B"){
                                                                            $product = floatval($course["credit"]) * 4;
                                                                            $total_result += $product;
                                                                        } else if($result == "C"){
                                                                            $product = floatval($course["credit"]) * 3;
                                                                            $total_result += $product;
                                                                        } else if($result == "D"){
                                                                            $product = floatval($course["credit"]) * 2;
                                                                            $total_result += $product;
                                                                        } else if($result == "E"){
                                                                            $product = floatval($course["credit"]) * 1;
                                                                            $total_result += $product;
                                                                        } else if($result == "F"){
                                                                            $product = floatval($course["credit"]) * 0;
                                                                            $total_result += $product;
                                                                        }
                                                                    }

                                                                    $second_level_credit += $total_credit;
                                                                    $second_level_result += $total_result;

                                                                    $gpa = $total_result / $total_credit;
                                                                    echo number_format($gpa, 2);
                                                                    
                                                                    ?>
                                                                <?php } else { ?>
                                                                    0.00
                                                                <?php } ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                $cgpa = $second_level_result / $second_level_credit;
                                                                echo number_format($cgpa, 2);
                                                                ?>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>

                                                    <?php if($third_level->num_rows){
                                                        $third_level_credit = 0;
                                                        $third_level_result = 0;
                                                        ?>
                                                        <tr>
                                                            <td>300</td>
                                                            <td>
                                                                <?php if($third_level_first_semester->num_rows){

                                                                    $third_level_first_semester->fetch_assoc();

                                                                    $total_credit = 0;
                                                                    $total_result = 0;

                                                                    foreach($third_level_first_semester as $semester){

                                                                        $course_id = $semester["course_id"];

                                                                        $sql = "SELECT * FROM courses WHERE course_id = ? LIMIT 1";
                                                                        $stmt = $conn->prepare($sql);
                                                                        $stmt->bind_param("s", $course_id);
                                                                        $stmt->execute();
                                                                        $course = $stmt->get_result()->fetch_assoc();

                                                                        $total_credit += floatval($course["credit"]);

                                                                        $result = $semester["result"];

                                                                        if($result == "A"){
                                                                            $product = floatval($course["credit"]) * 5;
                                                                            $total_result += $product;
                                                                        } else if($result == "B"){
                                                                            $product = floatval($course["credit"]) * 4;
                                                                            $total_result += $product;
                                                                        } else if($result == "C"){
                                                                            $product = floatval($course["credit"]) * 3;
                                                                            $total_result += $product;
                                                                        } else if($result == "D"){
                                                                            $product = floatval($course["credit"]) * 2;
                                                                            $total_result += $product;
                                                                        } else if($result == "E"){
                                                                            $product = floatval($course["credit"]) * 1;
                                                                            $total_result += $product;
                                                                        } else if($result == "F"){
                                                                            $product = floatval($course["credit"]) * 0;
                                                                            $total_result += $product;
                                                                        }
                                                                    }

                                                                    $third_level_credit += $total_credit;
                                                                    $third_level_result += $total_result;

                                                                    $gpa = $total_result / $total_credit;
                                                                    echo number_format($gpa, 2);
                                                                    
                                                                    ?>
                                                                <?php } else { ?>
                                                                    0.00
                                                                <?php } ?>
                                                            </td>
                                                            <td>
                                                                <?php if($third_level_second_semester->num_rows){

                                                                    $third_level_second_semester->fetch_assoc();

                                                                    $total_credit = 0;
                                                                    $total_result = 0;

                                                                    foreach($third_level_second_semester as $semester){

                                                                        $course_id = $semester["course_id"];

                                                                        $sql = "SELECT * FROM courses WHERE course_id = ? LIMIT 1";
                                                                        $stmt = $conn->prepare($sql);
                                                                        $stmt->bind_param("s", $course_id);
                                                                        $stmt->execute();
                                                                        $course = $stmt->get_result()->fetch_assoc();

                                                                        $total_credit += floatval($course["credit"]);

                                                                        $result = $semester["result"];

                                                                        if($result == "A"){
                                                                            $product = floatval($course["credit"]) * 5;
                                                                            $total_result += $product;
                                                                        } else if($result == "B"){
                                                                            $product = floatval($course["credit"]) * 4;
                                                                            $total_result += $product;
                                                                        } else if($result == "C"){
                                                                            $product = floatval($course["credit"]) * 3;
                                                                            $total_result += $product;
                                                                        } else if($result == "D"){
                                                                            $product = floatval($course["credit"]) * 2;
                                                                            $total_result += $product;
                                                                        } else if($result == "E"){
                                                                            $product = floatval($course["credit"]) * 1;
                                                                            $total_result += $product;
                                                                        } else if($result == "F"){
                                                                            $product = floatval($course["credit"]) * 0;
                                                                            $total_result += $product;
                                                                        }
                                                                    }

                                                                    $third_level_credit += $total_credit;
                                                                    $third_level_result += $total_result;

                                                                    $gpa = $total_result / $total_credit;
                                                                    echo number_format($gpa, 2);
                                                                    
                                                                    ?>
                                                                <?php } else { ?>
                                                                    0.00
                                                                <?php } ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                $cgpa = $third_level_result / $third_level_credit;
                                                                echo number_format($cgpa, 2);
                                                                ?>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>

                                                    <?php if($fourth_level->num_rows){
                                                        $fourth_level_credit = 0;
                                                        $fourth_level_result = 0;
                                                        ?>
                                                        <tr>
                                                            <td>400</td>
                                                            <td>
                                                                <?php if($fourth_level_first_semester->num_rows){

                                                                    $fourth_level_first_semester->fetch_assoc();

                                                                    $total_credit = 0;
                                                                    $total_result = 0;

                                                                    foreach($fourth_level_first_semester as $semester){

                                                                        $course_id = $semester["course_id"];

                                                                        $sql = "SELECT * FROM courses WHERE course_id = ? LIMIT 1";
                                                                        $stmt = $conn->prepare($sql);
                                                                        $stmt->bind_param("s", $course_id);
                                                                        $stmt->execute();
                                                                        $course = $stmt->get_result()->fetch_assoc();

                                                                        $total_credit += floatval($course["credit"]);

                                                                        $result = $semester["result"];

                                                                        if($result == "A"){
                                                                            $product = floatval($course["credit"]) * 5;
                                                                            $total_result += $product;
                                                                        } else if($result == "B"){
                                                                            $product = floatval($course["credit"]) * 4;
                                                                            $total_result += $product;
                                                                        } else if($result == "C"){
                                                                            $product = floatval($course["credit"]) * 3;
                                                                            $total_result += $product;
                                                                        } else if($result == "D"){
                                                                            $product = floatval($course["credit"]) * 2;
                                                                            $total_result += $product;
                                                                        } else if($result == "E"){
                                                                            $product = floatval($course["credit"]) * 1;
                                                                            $total_result += $product;
                                                                        } else if($result == "F"){
                                                                            $product = floatval($course["credit"]) * 0;
                                                                            $total_result += $product;
                                                                        }
                                                                    }

                                                                    $fourth_level_credit += $total_credit;
                                                                    $fourth_level_result += $total_result;

                                                                    $gpa = $total_result / $total_credit;
                                                                    echo number_format($gpa, 2);
                                                                    
                                                                    ?>
                                                                <?php } else { ?>
                                                                    0.00
                                                                <?php } ?>
                                                            </td>
                                                            <td>
                                                                <?php if($fourth_level_second_semester->num_rows){

                                                                    $fourth_level_second_semester->fetch_assoc();

                                                                    $total_credit = 0;
                                                                    $total_result = 0;

                                                                    foreach($fourth_level_second_semester as $semester){

                                                                        $course_id = $semester["course_id"];

                                                                        $sql = "SELECT * FROM courses WHERE course_id = ? LIMIT 1";
                                                                        $stmt = $conn->prepare($sql);
                                                                        $stmt->bind_param("s", $course_id);
                                                                        $stmt->execute();
                                                                        $course = $stmt->get_result()->fetch_assoc();
                                                                        
                                                                        $total_credit += floatval($course["credit"]);

                                                                        $result = $semester["result"];

                                                                        if($result == "A"){
                                                                            $product = floatval($course["credit"]) * 5;
                                                                            $total_result += $product;
                                                                        } else if($result == "B"){
                                                                            $product = floatval($course["credit"]) * 4;
                                                                            $total_result += $product;
                                                                        } else if($result == "C"){
                                                                            $product = floatval($course["credit"]) * 3;
                                                                            $total_result += $product;
                                                                        } else if($result == "D"){
                                                                            $product = floatval($course["credit"]) * 2;
                                                                            $total_result += $product;
                                                                        } else if($result == "E"){
                                                                            $product = floatval($course["credit"]) * 1;
                                                                            $total_result += $product;
                                                                        } else if($result == "F"){
                                                                            $product = floatval($course["credit"]) * 0;
                                                                            $total_result += $product;
                                                                        }
                                                                    }

                                                                    $fourth_level_credit += $total_credit;
                                                                    $fourth_level_result += $total_result;

                                                                    $gpa = $total_result / $total_credit;
                                                                    echo number_format($gpa, 2);
                                                                    
                                                                    ?>
                                                                <?php } else { ?>
                                                                    0.00
                                                                <?php } ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                $cgpa = $fourth_level_result / $fourth_level_credit;
                                                                echo number_format($cgpa, 2);
                                                                ?>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>

                                                    <?php if($fifth_level->num_rows){
                                                        $fifth_level_credit = 0;
                                                        $fifth_level_result = 0;
                                                        ?>
                                                        <tr>
                                                            <td>500</td>
                                                            <td>
                                                                <?php if($fifth_level_first_semester->num_rows){

                                                                    $fifth_level_first_semester->fetch_assoc();

                                                                    $total_credit = 0;
                                                                    $total_result = 0;

                                                                    foreach($fifth_level_first_semester as $semester){

                                                                        $course_id = $semester["course_id"];

                                                                        $sql = "SELECT * FROM courses WHERE course_id = ? LIMIT 1";
                                                                        $stmt = $conn->prepare($sql);
                                                                        $stmt->bind_param("s", $course_id);
                                                                        $stmt->execute();
                                                                        $course = $stmt->get_result()->fetch_assoc();

                                                                        $total_credit += floatval($course["credit"]);

                                                                        $result = $semester["result"];

                                                                        if($result == "A"){
                                                                            $product = floatval($course["credit"]) * 5;
                                                                            $total_result += $product;
                                                                        } else if($result == "B"){
                                                                            $product = floatval($course["credit"]) * 4;
                                                                            $total_result += $product;
                                                                        } else if($result == "C"){
                                                                            $product = floatval($course["credit"]) * 3;
                                                                            $total_result += $product;
                                                                        } else if($result == "D"){
                                                                            $product = floatval($course["credit"]) * 2;
                                                                            $total_result += $product;
                                                                        } else if($result == "E"){
                                                                            $product = floatval($course["credit"]) * 1;
                                                                            $total_result += $product;
                                                                        } else if($result == "F"){
                                                                            $product = floatval($course["credit"]) * 0;
                                                                            $total_result += $product;
                                                                        }
                                                                    }

                                                                    $fifth_level_credit += $total_credit;
                                                                    $fifth_level_result += $total_result;

                                                                    $gpa = $total_result / $total_credit;
                                                                    echo number_format($gpa, 2);
                                                                    
                                                                    ?>
                                                                <?php } else { ?>
                                                                    0.00
                                                                <?php } ?>
                                                            </td>
                                                            <td>
                                                                <?php if($fifth_level_second_semester->num_rows){

                                                                    $fifth_level_second_semester->fetch_assoc();

                                                                    $total_credit = 0;
                                                                    $total_result = 0;

                                                                    foreach($fifth_level_second_semester as $semester){

                                                                        $course_id = $semester["course_id"];

                                                                        $sql = "SELECT * FROM courses WHERE course_id = ? LIMIT 1";
                                                                        $stmt = $conn->prepare($sql);
                                                                        $stmt->bind_param("s", $course_id);
                                                                        $stmt->execute();
                                                                        $course = $stmt->get_result()->fetch_assoc();

                                                                        $total_credit += floatval($course["credit"]);

                                                                        $result = $semester["result"];

                                                                        if($result == "A"){
                                                                            $product = floatval($course["credit"]) * 5;
                                                                            $total_result += $product;
                                                                        } else if($result == "B"){
                                                                            $product = floatval($course["credit"]) * 4;
                                                                            $total_result += $product;
                                                                        } else if($result == "C"){
                                                                            $product = floatval($course["credit"]) * 3;
                                                                            $total_result += $product;
                                                                        } else if($result == "D"){
                                                                            $product = floatval($course["credit"]) * 2;
                                                                            $total_result += $product;
                                                                        } else if($result == "E"){
                                                                            $product = floatval($course["credit"]) * 1;
                                                                            $total_result += $product;
                                                                        } else if($result == "F"){
                                                                            $product = floatval($course["credit"]) * 0;
                                                                            $total_result += $product;
                                                                        }
                                                                    }

                                                                    $fifth_level_credit += $total_credit;
                                                                    $fifth_level_result += $total_result;

                                                                    $gpa = $total_result / $total_credit;
                                                                    echo number_format($gpa, 2);
                                                                    
                                                                    ?>
                                                                <?php } else { ?>
                                                                    0.00
                                                                <?php } ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                $cgpa = $fifth_level_result / $fifth_level_credit;
                                                                echo number_format($cgpa, 2);
                                                                ?>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>

                                                
                                                <?php } else { ?>
                                                    <tr>
                                                        <td>No Results Entered</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end col -->
                        </div><!-- end row -->
                    </div><!-- container -->
                </div><!-- Page content Wrapper -->
            </div><!-- content -->
            <?php require_once "components/footer.php"; ?>
        </div><!-- End Right content here -->
    </div><!-- END wrapper --><!-- jQuery  -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/modernizr.min.js"></script>
    <script src="assets/js/detect.js"></script>
    <script src="assets/js/fastclick.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/jquery.blockUI.js"></script>
    <script src="assets/js/waves.js"></script>
    <script src="assets/js/jquery.nicescroll.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script><!-- Required datatable js -->
    <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/plugins/datatables/dataTables.bootstrap4.min.js"></script><!-- Buttons examples -->
    <script src="assets/plugins/datatables/dataTables.buttons.min.js"></script>
    <script src="assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
    <script src="assets/plugins/datatables/jszip.min.js"></script>
    <script src="assets/plugins/datatables/pdfmake.min.js"></script>
    <script src="assets/plugins/datatables/vfs_fonts.js"></script>
    <script src="assets/plugins/datatables/buttons.html5.min.js"></script>
    <script src="assets/plugins/datatables/buttons.print.min.js"></script>
    <script src="assets/plugins/datatables/buttons.colVis.min.js"></script><!-- Responsive examples -->
    <script src="assets/plugins/datatables/dataTables.responsive.min.js"></script>
    <script src="assets/plugins/datatables/responsive.bootstrap4.min.js"></script><!-- Datatable init js -->
    <!-- Sweet-Alert  -->
    <script src="assets/plugins/sweet-alert2/sweetalert2.min.js"></script>
    <script src="assets/pages/datatables.init.js"></script><!-- App js -->
    <script src="assets/js/app.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#datatable2').DataTable();
        });
    </script>
    <script>

        $(document).ready(function(e) {
            $("#form").on('submit', (function(e) {
                e.preventDefault();

                swal({
                    title: "Are you sure?", text: "Do you want to submit result?", type: "question", showCancelButton: !0, confirmButtonText: "Yes, create it!", cancelButtonText: "No, cancel!", confirmButtonClass: "btn btn-success", cancelButtonClass: "btn btn-danger m-l-10", buttonsStyling: !1
                }).then(function () {
                    $.ajax({
                        url: "controllers/submit-result.php",
                        type: "POST",
                        data: new FormData(document.querySelector("#form")),
                        contentType: false,
                        cache: false,
                        processData: false,
                        beforeSend: function() {
                        
                        },
                        success: function(data) {
                            let response = JSON.parse(data);                  
                            if (response.status.trim() == 'success') {
                                swal("Done",response.message, "success").then(function(){
                                    window.location.reload();

                                });
                            } else {
                                swal("Failed",response.message, "error").then(function(){});
                            }
                        },
                        error: function(e) {
                            swal("Failed",e, "error").then(function(){});
                        }
                    });
                }, function (t) {
                    "cancel" === t && swal("Cancelled", "Department addition cancelled", "error")
                })
                
            }));
        });

    </script>
</body>

</html>