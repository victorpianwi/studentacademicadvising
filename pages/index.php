<?php require_once "components/publichead.php";?>
<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
    <title>Log In || Student Academic Advisory System</title>
    <meta content="Student Academic Advisory System" name="description">
    <meta content="Student Academic Advisory System" name="author">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="assets/images/favicon.png">
    <!-- Sweet Alert -->
    <link href="assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">
</head>

<body class="fixed-left">
    <div class="accountbg"></div>
    <div class="wrapper-page">
        <div class="card">
            <div class="card-body">
                <h3 class="text-center mt-0 m-b-15"><a class='logo logo-admin' href='index.html'><img
                            src="assets/images/logo.png" height="120" alt="logo"></a></h3>
                <div class="p-3">
                    <form class="form-horizontal m-t-20" id="form" method="POST">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" placeholder="Enter your username..." name="username">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" placeholder="Enter your password..." name="password">
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <div class="custom-control custom-checkbox"><input type="checkbox"
                                        class="custom-control-input" id="customCheck1"> <label
                                        class="custom-control-label" for="customCheck1">Remember me</label></div>
                            </div>
                        </div>
                        <div class="form-group text-center row m-t-20">
                            <div class="col-12"><button class="btn btn-primary btn-block waves-effect waves-light"
                                    type="submit">Log In</button></div>
                        </div>
                        <div class="form-group m-t-10 mb-0 row">
                            <!-- <div class="col-sm-7 m-t-20"><a class='text-muted' href='pages-recoverpw.html'><i
                                        class="mdi mdi-lock"></i> <small>Forgot your password ?</small></a></div> -->
                            <div class="col-sm-5 m-t-20"><a class='text-muted' href='register'><i
                                        class="mdi mdi-account-circle"></i> <small>Create an account ?</small></a></div>
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
                    url: "controllers/log-in.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                    
                    },
                    success: function(data) {
                        if (data.trim() == 'success') {
                            swal("Done","Log In Successful", "success").then(function(){
                                <?php if(isset($_GET["rd"])) {?>
                                    window.location.assign("<?= $_GET["rd"]?>");
                                <?php } else {?>
                                    window.location.assign("dashboard");
                                <?php } ?>

                            });
                        } else if (data.trim() == 'admin') {
                             swal("Done","Log In Successful", "success").then(function(){
                                <?php if(isset($_GET["rd"])) {?>
                                    window.location.assign("<?= $_GET["rd"]?>");
                                <?php } else {?>
                                    window.location.assign("admin");
                                <?php } ?>

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