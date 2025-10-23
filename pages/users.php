<?php
require_once "components/head.php";

$username = isset($_SESSION["username"]) ? $_SESSION["username"] : null;

if ($username == null) {
    header("Location: log-in");
    exit();
}

require_once "controllers/admin.php";

?>

<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
    <title>Users || Student Academic Advisory System</title>
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
                                    <h4 class="page-title">Users</h4>
                                </div>
                            </div>
                        </div><!-- end page title end breadcrumb -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <h4 class="mt-0 header-title">All Users</h4>
                                        <p class="text-muted m-b-30 font-14"></p>
                                        <div class="mobileresponsive">
                                            <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>First Name</th>
                                                    <th>Last Name</th>
                                                    <th>Email</th>
                                                    <th>Gender</th>
                                                    <th>Department</th>
                                                    <th>Mat. No</th>
                                                    <!-- <th>Action</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if($users->num_rows) {

                                                    $users->fetch_assoc();

                                                    $no = 1;

                                                    foreach($users as $user){
                                                    ?>

                                                    <tr>
                                                        <td><?= $no?></td>
                                                        <td><?= $user["firstname"]?></td>
                                                        <td><?= $user["lastname"]?></td>
                                                        <td><?= $user["email"]?></td>
                                                        <td><?= $user["gender"]?></td>
                                                        <td><?= $user["dep_name"]?></td>
                                                        <td><?= $user["mat_no"]?></td>
                                                        <!-- <td> <button class="btn btn-outline-dark" data-toggle="modal" data-animation="bounce" data-target=".bs-edit-modal-center" onclick="getDepartment(<?= $department['dep_id']?>)"><i class="mdi mdi-pencil"></i></button> </td> -->
                                                    </tr>

                                                    
                                                <?php $no++; } } else { ?>
                                                    <tr>
                                                        <td>No Departments</td>
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
                                                                <h5 class="modal-title" id="exampleModalLabel">Edit Department</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="">
                                                                    <form id="editform">
                                                                        <input type="number" name="dep_id" id="dep_id" style="display: none;">
                                                                        <div class="form-group">
                                                                            <label>Department Name</label>
                                                                            <input type="text" class="form-control" required="" placeholder="Enter Department Name" onblur="this.setCustomValidity('')" oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Department Name is required!')" name="dep_name" id="dep_name">
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label>Faculty</label>
                                                                            <input type="text" class="form-control" required="" placeholder="Enter Faculty Name" onblur="this.setCustomValidity('')" oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Faculty Name is required!')" name="fac_name" id="fac_name">
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
                    title: "Are you sure?", text: "Do you want to create department?", type: "question", showCancelButton: !0, confirmButtonText: "Yes, create it!", cancelButtonText: "No, cancel!", confirmButtonClass: "btn btn-success", cancelButtonClass: "btn btn-danger m-l-10", buttonsStyling: !1
                }).then(function () {
                    $.ajax({
                        url: "controllers/add-department.php",
                        type: "POST",
                        data: new FormData(document.querySelector("#form")),
                        contentType: false,
                        cache: false,
                        processData: false,
                        beforeSend: function() {
                        
                        },
                        success: function(data) {
                            if (data.trim() == 'success') {
                                swal("Done","Department Successfully Added!", "success").then(function(){
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
                    "cancel" === t && swal("Cancelled", "Department addition cancelled", "error")
                })
                
            }));
        });

        const getDepartment = (dep_id) => {
            let form = document.createElement("form");
            let input = document.createElement("input");
            input.setAttribute("name", "dep_id");
            input.setAttribute("value", dep_id);
            form.append(input);

            $.ajax({
                url: "controllers/get-department.php",
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
                        document.querySelector("#dep_id").value = dep_id;
                        document.querySelector("#dep_name").value = response.dep_name;
                        document.querySelector("#fac_name").value = response.fac_name;
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
                    title: "Are you sure?", text: "Do you want to edit department?", type: "question", showCancelButton: !0, confirmButtonText: "Yes, edit it!", cancelButtonText: "No, cancel!", confirmButtonClass: "btn btn-success", cancelButtonClass: "btn btn-danger m-l-10", buttonsStyling: !1
                }).then(function () {
                    $.ajax({
                        url: "controllers/edit-department.php",
                        type: "POST",
                        data: new FormData(document.querySelector("#editform")),
                        contentType: false,
                        cache: false,
                        processData: false,
                        beforeSend: function() {
                        
                        },
                        success: function(data) {
                            if (data.trim() == 'success') {
                                swal("Done","Department Successfully Edited!", "success").then(function(){
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
                    "cancel" === t && swal("Cancelled", "Department editing cancelled", "error")
                })
                
            }));
        });
    </script>
</body>

</html>