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
    <title>Input Result || Student Academic Advisory System</title>
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
                                    <h4 class="page-title">Input Result</h4>
                                </div>
                            </div>
                        </div><!-- end page title end breadcrumb -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card m-b-30">
                                    <form class="card-body" id="form">
                                        <h4 class="mt-0 header-title">Input <?= $user["level"]?> Level <?= $user["semester"]?><sup><?= $user["semester"] == 1 ? "st" : "nd";?></sup> Semester Result</h4>
                                        <p class="text-muted m-b-30 font-14"></p>
                                        <div class="mobileresponsive">
                                            <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>Course</th>
                                                    <th>Input Result</th>
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
                                                        <td>
                                                            <input type="hidden" name="course[<?= $no - 1?>][course_id]" value="<?= $course['course_id']?>">
                                                            <select class="form-control" placeholder="Enter <?= $course["course"]?> Result" name="course[<?= $no - 1?>][result]">
                                                                <option value="">Select Result</option>
                                                                <option value="A">A</option>
                                                                <option value="B">B</option>
                                                                <option value="C">C</option>
                                                                <option value="D">D</option>
                                                                <option value="E">E</option>
                                                                <option value="F">F</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                
                                                <?php $no++; } } else { ?>
                                                    <tr>
                                                        <td>No Courses Registered</td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <?php if($active_count > 0 ){?>
                                            <div style="display: flex; justify-content: center;">
                                                <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                                            </div>
                                        <?php } ?>
                                        </div>
                                    </form>
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