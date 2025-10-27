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
    <title>Course Registration || Student Academic Advisory System</title>
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
                                    <h4 class="page-title">Course Registration</h4>
                                </div>
                            </div>
                        </div><!-- end page title end breadcrumb -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <h4 class="mt-0 header-title"><?= $user["level"]?> Level <?= $user["semester"]?><sup><?= $user["semester"] == 1 ? "st" : "nd";?></sup> Semester Course Registration
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
                                                    <th>S/N</th>
                                                    <th>Course</th>
                                                    <th>Credit Unit</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if($active_count > 0 && $active_courses->num_rows > 0) {
                                                    $active_courses->fetch_assoc();

                                                    $no = 1;

                                                    foreach($active_courses as $course){
                                                ?>
                                                    <tr>
                                                        <td><?= $no?></td>
                                                        <td><?= $course["course"]?></td>
                                                        <td><?= $course["credit"]?></td>
                                                    </tr>
                                                <?php $no++; } } else if($new_courses->num_rows) {

                                                    $new_courses->fetch_assoc();

                                                    $no = 1;

                                                    foreach($new_courses as $course){
                                                    ?>

                                                    <tr>
                                                        <td><?= $no?></td>
                                                        <td><?= $course["course"]?></td>
                                                        <td><?= $course["credit"]?></td>
                                                    </tr>

                                                    
                                                <?php $no++; } } else { ?>
                                                    <tr>
                                                        <td>No Courses</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <?php if($active_courses->num_rows < 1) {?>
                                            <div style="display: flex; justify-content: center;">
                                                <button type="button" class="btn btn-primary waves-effect waves-light" onclick="registerCourse(<?= $user_id ?>)">Register</button>
                                            </div>
                                        <?php } else { ?>
                                            <div style="display: flex; justify-content: center;">
                                                <button type="button" class="btn btn-primary waves-effect waves-light" disabled>Courses Registered</button>
                                            </div>
                                        <?php } ?>
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

        const registerCourse = (user_id) => {

            let form = document.createElement("form");
            let user = document.createElement("input");
            user.setAttribute("name", "user_id");
            user.setAttribute("value", user_id);
            form.append(user);

            swal({
                    title: "Are you sure?", text: "Do you want to register the courses?", type: "question", showCancelButton: !0, confirmButtonText: "Yes, register it!", cancelButtonText: "No, cancel!", confirmButtonClass: "btn btn-success", cancelButtonClass: "btn btn-danger m-l-10", buttonsStyling: !1
                }).then(function () {
                    $.ajax({
                        url: "controllers/register-course.php",
                        type: "POST",
                        data: new FormData(form),
                        contentType: false,
                        cache: false,
                        processData: false,
                        beforeSend: function() {
                        },
                        success: function(data) {

                            if (data.trim() == 'success') {
                                swal("Done","Courses Successfully Registered", "success").then(function(){
                                    window.location.reload();
                                });
                            } else {
                                swal("Failed",data, "error").then(function(){});
                            }
                        },
                        error: function(e) {
                            swal("Failed",e, "error").then(function(){});
                        }
                    });
                }, function (t) {
                    "cancel" === t && swal("Cancelled", "Course Registration Cancelled", "error")
                })
        }

    </script>
</body>

</html>