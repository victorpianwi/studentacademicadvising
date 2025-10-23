<?php
require_once "components/head.php";

$username = isset($_SESSION["username"]) ? $_SESSION["username"] : null;

if ($username == null) {
    header("Location: log-in");
    exit();
}

require_once "controllers/admin.php";

$all_departments = [];

if($departments->num_rows){
    $departments->fetch_assoc();

    foreach($departments as $department){
        $all_departments[$department["dep_id"]] = [
            "id" => $department["dep_id"],
            "dep_name" => $department["dep_name"],
        ];
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
    <title>Courses || Student Academic Advisory System</title>
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
                                    <h4 class="page-title">Courses</h4>
                                </div>
                            </div>
                        </div><!-- end page title end breadcrumb -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <h4 class="mt-0 header-title">All Courses
                                            <div class="float-right">
                                                <div class="text-center">
                                                    <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-animation="bounce" data-target=".bs-example-modal-center">Add Course</button>
                                                </div>
                                                <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Add Course</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="">
                                                                    <form id="form">
                                                                        <div class="form-group">
                                                                            <label>Course Name</label>
                                                                            <input type="text" class="form-control" placeholder="Enter Course Name" name="course">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Credit Unit</label>
                                                                            <input type="number" step="0.01" class="form-control" placeholder="Enter Course Credit Unit" name="credit">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Department</label>
                                                                            <select class="form-control" name="dep_id">
                                                                                <option value="">Select Department</option>
                                                                                <?php if(!empty($all_departments)) {?>
                                                                                    <?php foreach($all_departments as $key => $value) {?>
                                                                                        <option value="<?= $value["id"] ?>"><?= $value["dep_name"] ?></option>
                                                                                    <?php } ?>
                                                                                <?php } ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Level</label>
                                                                            <select class="form-control" name="level">
                                                                                <option value="">Select Level</option>
                                                                                <option value="100">100 Level</option>
                                                                                <option value="200">200 Level</option>
                                                                                <option value="300">300 Level</option>
                                                                                <option value="400">400 Level</option>
                                                                                <option value="500">500 Level</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Semester</label>
                                                                            <select class="form-control" name="semester">
                                                                                <option value="">Select Semester</option>
                                                                                <option value="1">1<sup>st</sup> Semester</option>
                                                                                <option value="2">2<sup>nd</sup> Semester</option>
                                                                            </select>
                                                                        </div>
                                                                        
                                                                        <div class="form-group">
                                                                            <div><button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button> <button type="reset" class="btn btn-secondary waves-effect m-l-5" data-dismiss="modal" aria-label="Close">Cancel</button></div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->
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
                                                    <th>Department</th>
                                                    <th>Level</th>
                                                    <th>Semester</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if($courses->num_rows) {

                                                    $courses->fetch_assoc();

                                                    $no = 1;

                                                    foreach($courses as $course){
                                                    ?>

                                                    <tr>
                                                        <td><?= $no?></td>
                                                        <td><?= $course["course"]?></td>
                                                        <td><?= $course["credit"]?></td>
                                                        <td><?= $course["dep_name"]?></td>
                                                        <td><?= $course["level"]?></td>
                                                        <td><?= $course["semester"]?><sup><?= $course["semester"] == 1 ? "st" : "nd";?></sup></td>
                                                        <td>
                                                            <button class="btn btn-outline-dark" data-toggle="modal" data-animation="bounce" data-target=".bs-edit-modal-center" onclick="getCourse(<?= $course['course_id']?>)"><i class="mdi mdi-pencil"></i></button>
                                                            <button class="btn btn-outline-danger" onclick="deleteCourse(<?= $course['course_id']?>)"><i class="mdi mdi-delete"></i></button>
                                                        </td>
                                                    </tr>

                                                    
                                                <?php $no++; } } else { ?>
                                                    <tr>
                                                        <td>No Courses</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        </div>
                                        <div class="modal fade bs-edit-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Edit Course</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="">
                                                                    <form id="editform">
                                                                        <input type="number" name="course_id" id="course_id" style="display: none;">
                                                                        <div class="form-group">
                                                                            <label>Course Name</label>
                                                                            <input type="text" class="form-control" placeholder="Enter Course Name" name="course" id="course">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Credit Unit</label>
                                                                            <input type="number" step="0.01" class="form-control" placeholder="Enter Course Credit Unit" name="credit" id="credit">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Department</label>
                                                                            <select class="form-control" name="dep_id" id="dep_id">
                                                                                <option value="">Select Department</option>
                                                                                <?php if(!empty($all_departments)) {?>
                                                                                    <?php foreach($all_departments as $key => $value) {?>
                                                                                        <option value="<?= $value["id"] ?>"><?= $value["dep_name"] ?></option>
                                                                                    <?php } ?>
                                                                                <?php } ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Level</label>
                                                                            <select class="form-control" name="level" id="level">
                                                                                <option value="">Select Level</option>
                                                                                <option value="100">100 Level</option>
                                                                                <option value="200">200 Level</option>
                                                                                <option value="300">300 Level</option>
                                                                                <option value="400">400 Level</option>
                                                                                <option value="500">500 Level</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Semester</label>
                                                                            <select class="form-control" name="semester" id="semester">
                                                                                <option value="">Select Semester</option>
                                                                                <option value="1">1<sup>st</sup> Semester</option>
                                                                                <option value="2">2<sup>nd</sup> Semester</option>
                                                                            </select>
                                                                        </div>
                                                                        
                                                                        <div class="form-group">
                                                                            <div><button type="submit" class="btn btn-primary waves-effect waves-light">Edit</button> <button type="reset" class="btn btn-secondary waves-effect m-l-5" data-dismiss="modal" aria-label="Close">Cancel</button></div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->
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
                    title: "Are you sure?", text: "Do you want to add course?", type: "question", showCancelButton: !0, confirmButtonText: "Yes, add it!", cancelButtonText: "No, cancel!", confirmButtonClass: "btn btn-success", cancelButtonClass: "btn btn-danger m-l-10", buttonsStyling: !1
                }).then(function () {
                    $.ajax({
                        url: "controllers/add-course.php",
                        type: "POST",
                        data: new FormData(document.querySelector("#form")),
                        contentType: false,
                        cache: false,
                        processData: false,
                        beforeSend: function() {
                        
                        },
                        success: function(data) {
                            if (data.trim() == 'success') {
                                swal("Done","Course Successfully Added!", "success").then(function(){
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
                    "cancel" === t && swal("Cancelled", "Course addition cancelled", "error")
                })
                
            }));
        });

        const getCourse = (course_id) => {
            let form = document.createElement("form");
            let input = document.createElement("input");
            input.setAttribute("name", "course_id");
            input.setAttribute("value", course_id);
            form.append(input);

            $.ajax({
                url: "controllers/get-course.php",
                type: "POST",
                data: new FormData(form),
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                },
                success: function(data) {

                    let response = JSON.parse(data);

                    if (response.message.trim() == 'success') {
                        document.querySelector("#course_id").value = course_id;
                        document.querySelector("#course").value = response.course;
                        document.querySelector("#credit").value = response.credit;
                        document.querySelector("#dep_id").value = response.dep_id;
                        document.querySelector("#level").value = response.level;
                        document.querySelector("#semester").value = response.semester;
                    } else {
                        swal("Failed",response.message, "error").then(function(){});
                    }
                },
                error: function(e) {
                    swal("Failed",e, "error").then(function(){});
                }
            });
        }

        $(document).ready(function(e) {
            $("#editform").on('submit', (function(e) {
                e.preventDefault();

                swal({
                    title: "Are you sure?", text: "Do you want to edit course?", type: "question", showCancelButton: !0, confirmButtonText: "Yes, edit it!", cancelButtonText: "No, cancel!", confirmButtonClass: "btn btn-success", cancelButtonClass: "btn btn-danger m-l-10", buttonsStyling: !1
                }).then(function () {
                    $.ajax({
                        url: "controllers/edit-course.php",
                        type: "POST",
                        data: new FormData(document.querySelector("#editform")),
                        contentType: false,
                        cache: false,
                        processData: false,
                        beforeSend: function() {
                        
                        },
                        success: function(data) {
                            if (data.trim() == 'success') {
                                swal("Done","Course Successfully Edited!", "success").then(function(){
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
                    "cancel" === t && swal("Cancelled", "Course editing cancelled", "error")
                })
                
            }));
        });

        const deleteCourse = (course_id) => {
            let form = document.createElement("form");
            let input = document.createElement("input");
            input.setAttribute("name", "course_id");
            input.setAttribute("value", course_id);
            form.append(input);

            swal({
                    title: "Are you sure?", text: "Do you want to delete course?", type: "question", showCancelButton: !0, confirmButtonText: "Yes, delete it!", cancelButtonText: "No, cancel!", confirmButtonClass: "btn btn-success", cancelButtonClass: "btn btn-danger m-l-10", buttonsStyling: !1
            }).then(function () {
                $.ajax({
                    url: "controllers/delete-course.php",
                    type: "POST",
                    data: new FormData(form),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                    },
                    success: function(data) {

                        if (data.trim() == 'success') {
                            swal("Done","Course Successfully Deleted!", "success").then(function(){
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
                "cancel" === t && swal("Cancelled", "Course deleting cancelled", "error")
            })
        }
    </script>
</body>

</html>