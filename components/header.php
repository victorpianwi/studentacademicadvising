<!-- Top Bar Start -->
<div class="topbar">
    <nav class="navbar-custom">
        <ul class="list-inline float-right mb-0">
            <li class="list-inline-item dropdown notification-list"><a
                    class="nav-link dropdown-toggle arrow-none waves-effect nav-user"
                    data-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                    aria-expanded="false"><img src="assets/images/users/avatar-1.jpg" alt="user"
                        class="rounded-circle"></a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown"><!-- item-->
                    <div class="dropdown-item noti-title">
                        <h5>Welcome <?= $user["firstname"]?></h5>
                    </div>
                    <!-- <a class="dropdown-item" href="#"><i
                            class="mdi mdi-account-circle m-r-5 text-muted"></i> Profile</a>  -->
                    <div class="dropdown-divider"></div><a class="dropdown-item" href="log-out"><i
                            class="mdi mdi-logout m-r-5 text-muted"></i> Logout</a>
                </div>
            </li>
        </ul>
        <div class="clearfix"></div>
    </nav>
</div><!-- Top Bar End -->