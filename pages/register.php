<?php

require_once "components/publichead.php";

require_once "controllers/config.php";

$sql = "SELECT * FROM departments ORDER BY dep_name ASC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$departments = $stmt->get_result();

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
    <title>Register || Student Academic Advisory System</title>
    <meta content="Admin Dashboard" name="description">
    <meta content="Mannatthemes" name="author">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="assets/images/favicon.png">
    <!-- Sweet Alert -->
    <link href="assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">
</head>

<body class="fixed-left"><!-- Begin page -->
    <div class="accountbg"></div>
    <div class="wrapper-page">
        <div class="card">
            <div class="card-body">
                <h3 class="text-center mt-0 m-b-15"><a class='logo logo-admin' href='log-in'><img
                            src="assets/images/logo.png" height="120" alt="logo"></a></h3>
                <div class="p-3">
                    <form class="form-horizontal" id="form">
                        <div class="form-group">
                            <label>First Name </label>
                            <input type="text" class="form-control" placeholder="Enter your First Name..." name="firstname">
                        </div>
                         <div class="form-group">
                            <label>Last Name </label>
                            <input type="text" class="form-control" placeholder="Enter your Last Name..." name="lastname">
                        </div>
                        <div class="form-group">
                            <label>Email </label>
                            <input type="email" class="form-control" placeholder="Enter your Email..." name="email">
                        </div>
                        <div class="form-group">
                            <label>Gender </label>
                            <select class="form-control" name="gender">
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                         <div class="form-group">
                            <label>Department </label>
                            <select class="form-control" name="dep_id">
                                <option value="">Select Department</option>
                                <?php if(!empty($all_departments)) {?>
                                    <?php foreach($all_departments as $key => $value) {?>
                                        <option value="<?= $value["id"] ?>"><?= $value["dep_name"] ?></option>
                                    <?php } ?>
                                <?php } ?>
                                <option value="none">Department not listed</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Level </label>
                            <select class="form-control" name="level">
                                <option value="">Select Level</option>
                                <option value="100">100</option>
                                <option value="200">200</option>
                                <option value="300">300</option>
                                <option value="400">400</option>
                                <option value="500">500</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Semester </label>
                            <select class="form-control" name="semester">
                                <option value="">Select Semester</option>
                                <option value="1">1st</option>
                                <option value="2">2nd</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Mat. Number </label>
                            <input type="text" class="form-control" placeholder="Enter your Matriculation Number..." name="mat_no">
                        </div>
                        <div class="form-group">
                            <label>Username </label>
                            <input type="text" class="form-control" placeholder="Enter your Username..." name="username">
                        </div>
                         <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" placeholder="Enter your password..." name="password">
                        </div>
                        <!-- <div class="form-group row">
                            <div class="col-12">
                                <div class="custom-control custom-checkbox"><input type="checkbox"
                                        class="custom-control-input" id="customCheck1" name="agree"> <label
                                        class="custom-control-label font-weight-normal" for="customCheck1">I accept <a
                                            href="#" class="text-muted">Terms and Conditions</a></label></div>
                            </div>
                        </div> -->
                        <div class="form-group text-center row m-t-20">
                            <div class="col-12"><button class="btn btn-primary btn-block waves-effect waves-light"
                                    type="submit">Register</button></div>
                        </div>
                        <div class="form-group m-t-10 mb-0 row">
                            <div class="col-12 m-t-20 text-center"><a class='text-muted' href='log-in'>Already
                                    have account?</a></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- jQuery  -->
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
    <!-- Sweet-Alert  -->
    <script src="assets/plugins/sweet-alert2/sweetalert2.min.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script><!-- App js -->
    <script src="assets/js/app.js"></script>
    <script>
        $(document).ready(function(e) {
            $("#form").on('submit', (function(e) {
                e.preventDefault();
                $.ajax({
                    url: "controllers/register.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                    
                    },
                    success: function(data) {
                        if (data.trim() == 'success') {
                            swal("Done","Account Created Successfully", "success").then(function(){
                                window.location.assign("dashboard");
                            });
                        } else {
                            swal("Failed",data, "error").then(function(){});
                        }
                    },
                    error: function(e) {
                        swal("Failed",e, "error").then(function(){});
                    }
                });
            }));
        });
    </script>
</body>
</html>