<?php
require_once "components/head.php";

$username = isset($_SESSION["username"]) ? $_SESSION["username"] : null;

if($username == null){
    header("Location: log-in");
    exit();
}

require_once "controllers/user.php";

$current_gpa = 0;

$user_id = $user["user_id"];
$level = $user["level"];
$status = 1;

$sql = "SELECT r.*, c.course, c.credit FROM registered_courses r JOIN courses c ON c.course_id = r.course_id WHERE `status` = ? AND user_id = ? AND r.`level` = ? ORDER BY c.course ASC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $status, $user_id, $level);
$stmt->execute();
$current_level = $stmt->get_result();

if($current_level->num_rows){

    $total_credit = 0;
    $total_result = 0;

    $current_level->fetch_assoc();

    foreach($current_level as $current){

        $total_credit += floatval($current["credit"]);

        $result = $current["result"];

        if($result == "A"){
            $product = floatval($current["credit"]) * 5;
            $total_result += $product;
        } else if($result == "B"){
            $product = floatval($current["credit"]) * 4;
            $total_result += $product;
        } else if($result == "C"){
            $product = floatval($current["credit"]) * 3;
            $total_result += $product;
        } else if($result == "D"){
            $product = floatval($current["credit"]) * 2;
            $total_result += $product;
        } else if($result == "E"){
            $product = floatval($current["credit"]) * 1;
            $total_result += $product;
        } else if($result == "F"){
            $product = floatval($current["credit"]) * 0;
            $total_result += $product;
        }

    }

    $current_gpa = $total_result / $total_credit;

} else {
    $level = floatval($user["level"]) - 100;
    $sql = "SELECT r.*, c.course, c.credit FROM registered_courses r JOIN courses c ON c.course_id = r.course_id WHERE `status` = ? AND user_id = ? AND r.`level` = ? ORDER BY c.course ASC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $status, $user_id, $level);
    $stmt->execute();
    $current_level = $stmt->get_result();

    if($current_level->num_rows){
        $total_credit = 0;
        $total_result = 0;

        $current_level->fetch_assoc();

        foreach($current_level as $current){

            $total_credit += floatval($current["credit"]);

            $result = $current["result"];

            if($result == "A"){
                $product = floatval($current["credit"]) * 5;
                $total_result += $product;
            } else if($result == "B"){
                $product = floatval($current["credit"]) * 4;
                $total_result += $product;
            } else if($result == "C"){
                $product = floatval($current["credit"]) * 3;
                $total_result += $product;
            } else if($result == "D"){
                $product = floatval($current["credit"]) * 2;
                $total_result += $product;
            } else if($result == "E"){
                $product = floatval($current["credit"]) * 1;
                $total_result += $product;
            } else if($result == "F"){
                $product = floatval($current["credit"]) * 0;
                $total_result += $product;
            }

        }

        $current_gpa = $total_result / $total_credit;
    }
}


?>
<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
    <title>Dashboard || Student Academic Advisory System</title>
    <meta content="Student Academic Advisory System" name="description">
    <meta content="Student Academic Advisory System" name="author">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="assets/images/favicon.png">
    <link href="assets/plugins/morris/morris.css" rel="stylesheet">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">
</head>

<body class="fixed-left"><!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner"></div>
        </div>
    </div><!-- Begin page -->
    <div id="wrapper">
        <?php require_once "components/sidebar.php";?>
        <!-- Start right Content here -->
        <div class="content-page"><!-- Start content -->
            <div class="content">
                <?php require_once "components/header.php";?>
                <div class="page-content-wrapper">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title-box">
                                    <?php require_once "components/userdetails.php";?>
                                    <h4 class="page-title">Dashboard</h4>
                                </div>
                            </div>
                        </div><!-- end page title end breadcrumb -->
                        <div class="row"><!-- Column -->
                            <div class="col-md-6 col-lg-6 col-xl-4">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <div class="d-flex flex-row">
                                            <div class="col-3 align-self-center">
                                                <div class="round"><i class="mdi mdi-book-open"></i></div>
                                            </div>
                                            <div class="col-6 align-self-center text-center">
                                                <div class="m-l-10">
                                                    <h5 class="mt-0 round-inner"><?= $active_count ?></h5>
                                                    <p class="mb-0 text-muted">Active Courses</p>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div><!-- Column --><!-- Column -->
                            <div class="col-md-6 col-lg-6 col-xl-4">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <div class="d-flex flex-row">
                                            <div class="col-3 align-self-center">
                                                <div class="round"><i class="mdi mdi-chart-line"></i></div>
                                            </div>
                                            <div class="col-6 text-center align-self-center">
                                                <div class="m-l-10">
                                                    <h5 class="mt-0 round-inner"><?= number_format($current_gpa, 2) ?></h5>
                                                    <p class="mb-0 text-muted">Current GPA</p>
                                                </div>
                                            </div>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div><!-- Column --><!-- Column -->
                            <div class="col-md-6 col-lg-6 col-xl-4">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <div class="d-flex flex-row">
                                            <div class="col-3 align-self-center">
                                                <div class="round"><i class="mdi mdi-book-open"></i></div>
                                            </div>
                                            <div class="col-6 align-self-center text-center">
                                                <div class="m-l-10">
                                                    <h5 class="mt-0 round-inner"><?= $total_courses ?></h5>
                                                    <p class="mb-0 text-muted">Total Courses</p>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div><!-- Column -->
                        </div>
                    </div><!-- container -->
                </div><!-- Page content Wrapper -->
            </div><!-- content -->
            <?php require_once "components/footer.php";?>
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
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/plugins/skycons/skycons.min.js"></script>
    <script src="assets/plugins/raphael/raphael-min.js"></script>
    <script src="assets/plugins/morris/morris.min.js"></script>
    <script src="assets/pages/dashborad.js"></script><!-- App js -->
    <script src="assets/js/app.js"></script>
    <script>/* BEGIN SVG WEATHER ICON */
        if (typeof Skycons !== 'undefined') {
            var icons = new Skycons(
                { "color": "#fff" },
                { "resizeClear": true }
            ),
                list = [
                    "clear-day", "clear-night", "partly-cloudy-day",
                    "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
                    "fog"
                ],
                i;

            for (i = list.length; i--;)
                icons.set(list[i], list[i]);
            icons.play();
        };

        // scroll

        $(document).ready(function () {

            $("#boxscroll").niceScroll({ cursorborder: "", cursorcolor: "#cecece", boxzoom: true });
            $("#boxscroll2").niceScroll({ cursorborder: "", cursorcolor: "#cecece", boxzoom: true });

        });</script>
</body>
</html>