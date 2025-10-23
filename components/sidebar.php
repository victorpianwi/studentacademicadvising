<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu"><button type="button"
        class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect"><i
            class="ion-close"></i></button><!-- LOGO -->
    <div class="topbar-left">
        <div class="text-center">
            <a href="dashboard" class="logo"><img src="assets/images/logo.png" height="80" alt="logo"></a>
        </div>
    </div>
    <div class="sidebar-inner slimscrollleft">
        <div id="sidebar-menu">
            <ul>
                <?php if($_SESSION["admin"]){ ?>
                    <li class="menu-title">Admin Menu</li>
                    <li><a class='waves-effect' href='admin'><i class="mdi mdi-home"></i> <span>Dashboard
                                </a></li>
                    <li><a class='waves-effect' href='departments'><i class="mdi mdi-book-multiple"></i> <span>Departments
                                </a></li>

                    <li><a class='waves-effect' href='courses'><i class="mdi mdi-book-open"></i> <span>Courses
                                </a></li>                         
                    <li><a class='waves-effect' href='users'><i class="mdi mdi-account-multiple"></i> <span>Users
                                </a></li>                         

                    <!-- <li><a class='waves-effect' href='gpa-tracking'><i class="mdi mdi-chart-line"></i> <span>Analytics -->
                                </a></li>
                    <li><a class='waves-effect' href='log-out'><i class="mdi mdi-logout"></i> <span>Log Out
                                </a></li>

                <?php } else { ?>

                    <li class="menu-title">Menu</li>
                    <li><a class='waves-effect' href='dashboard'><i class="mdi mdi-home"></i> <span>Dashboard
                                </a></li>
                    <li><a class='waves-effect' href='course-registration'><i class="mdi mdi-calendar-text"></i> <span>Course Registration
                                </a></li>

                    <li><a class='waves-effect' href='gpa-tracking'><i class="mdi mdi-chart-line"></i> <span>GPA Tracking
                                </a></li>
                    <!-- <li><a class='waves-effect' href='credit-tracking'><i class="fa fa-graduation-cap"></i> <span>Credit Tracking -->
                                </a></li>
                    <!-- <li><a class='waves-effect' href='get-advice'><i class="mdi mdi-briefcase-check"></i> <span>Get Advice -->
                                </a></li>
                    <li><a class='waves-effect' href='input-result'><i class="mdi mdi-file-document"></i> <span>Input Result
                                </a></li>
                    <li><a class='waves-effect' href='log-out'><i class="mdi mdi-logout"></i> <span>Log Out
                                </a></li>

                <?php } ?>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div><!-- end sidebarinner -->
</div><!-- Left Sidebar End -->