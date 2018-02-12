

    <body class="fixed-left skin-blue">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <div class="topbar">
                <!-- LOGO -->
                <div class="topbar-left">
                    <div class="text-center">
                        <a href="index.html" class="logo"><span>MCGRAW</span>Admin</a>
                        <a href="index.html" class="logo-sm"><span>W</span></a>
                        <!--<a href="index.html" class="logo"><img src="assets/images/logo_white_2.png" height="28"></a>-->
                        <!--<a href="index.html" class="logo-sm"><img src="assets/images/logo_sm.png" height="36"></a>-->
                    </div>
                </div>
                <!-- Button mobile view to collapse sidebar menu -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">
                        <div class="">
                            <div class="pull-left">
                                <button type="button" class="button-menu-mobile open-left waves-effect waves-light">
                                    <i class="ion-navicon"></i>
                                </button>
                                <span class="clearfix"></span>
                            </div>
                            <form class="navbar-form pull-left" role="search">
                                <div class="form-group">
                                    <input type="text" class="form-control search-bar" placeholder="Search...">
                                </div>
                                <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
                            </form>

                            <ul class="nav navbar-nav navbar-right pull-right">
                                <li class="dropdown hidden-xs">
                                    <a href="#" data-target="#" class="dropdown-toggle waves-effect waves-light notification-icon-box" data-toggle="dropdown" aria-expanded="true" style="display: none;">
                                        <i class="fa fa-bell"></i> <span class="badge badge-xs badge-danger"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-lg">
                                        <li class="text-center notifi-title">Notification <span class="badge badge-xs badge-success">3</span></li>
                                        <li class="list-group">
                                           <!-- list item-->
                                           <a href="javascript:void(0);" class="list-group-item">
                                              <div class="media">
                                                 <div class="media-heading">Your order is placed</div>
                                                 <p class="m-0">
                                                   <small>Dummy text of the printing and typesetting industry.</small>
                                                 </p>
                                              </div>
                                           </a>
                                           <!-- list item-->
                                            <a href="javascript:void(0);" class="list-group-item">
                                              <div class="media">
                                                 <div class="media-body clearfix">
                                                    <div class="media-heading">New Message received</div>
                                                    <p class="m-0">
                                                       <small>You have 87 unread messages</small>
                                                    </p>
                                                 </div>
                                              </div>
                                            </a>
                                            <!-- list item-->
                                            <a href="javascript:void(0);" class="list-group-item">
                                              <div class="media">
                                                 <div class="media-body clearfix">
                                                    <div class="media-heading">Your item is shipped.</div>
                                                    <p class="m-0">
                                                       <small>It is a long established fact that a reader will</small>
                                                    </p>
                                                 </div>
                                              </div>
                                            </a>
                                           <!-- last list item -->
                                            <a href="javascript:void(0);" class="list-group-item">
                                              <small class="text-primary">See all notifications</small>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="hidden-xs">
                                    <a href="#" id="btn-fullscreen" class="waves-effect waves-light notification-icon-box"><i class="mdi mdi-fullscreen"></i></a>
                                </li>
                                <li class="dropdown">
                                    <a href="" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">
                                        <img src="assets/images/users/avatar-1.jpg" alt="user-img" class="img-circle">
                                        <span class="profile-username">
                                            <?php
                                                echo $_SESSION["username"];
                                            ?>
                                        </span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li style="display: none;"><a href="javascript:void(0)"> Profile</a></li>
                                        <li style="display: none;"><a href="javascript:void(0)"><span class="badge badge-success pull-right">5</span> Settings </a></li>
                                        <li style="display: none;"><a href="javascript:void(0)"> Lock screen</a></li>
                                        <li class="divider"></li>
                                        <li><a href="login.php?logout=y"> Logout</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <!--/.nav-collapse -->
                    </div>
                </div>
            </div>
            <!-- Top Bar End -->


            <!-- ========== Left Sidebar Start ========== -->

            <div class="left side-menu">
                <div class="slimscrollleft">

                    <div class="user-details">
                        <div class="text-center">
                            <img src="assets/images/users/avatar-1.jpg" alt="" class="img-circle">
                        </div>
                        <div class="user-info">
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><?php echo $_SESSION["username"];?></a>
                            </div>

                            <p class="text-muted m-0"><i class="fa fa-dot-circle-o text-success"></i> Online</p>
                        </div>
                    </div>
                    <!--- Divider -->


                    <div id="sidebar-menu">
                        <ul class="sidebar-menu tree">
                            <li class="treeview">
                                <a href="index.php" class="waves-effect"><i class="mdi mdi-home"></i><span> Dashboard <span class="pull-right"></span></span></a>
                            </li>

                            <li>
                                <a href="main.php" class="waves-effect"><i class="ion-ios7-home-outline"></i> <span> Asset </span> <span class="pull-right"></span></a>
                            </li>

                            <li>
                                <a href="tenant.php" class="waves-effect"><i class="ion-ios7-person-outline"></i> <span> Tenant </span> <span class="pull-right"></span></a>
                            </li>

                            <li>
                                <a href="workorder.php" class="waves-effect"><i class="ion-clipboard"></i><span> Work Orders </span><span class="pull-right"></i></span></a>
                            </li>   
                            <li>
                                <a href="customer.php" class="waves-effect"><i class="ion-ios7-person-outline"></i><span> Customer </span><span class="pull-right"></i></span></a>
                            </li>   
                            <li>
                                <a href="vendor.php" class="waves-effect"><i class="ion-ios7-person-outline"></i><span> Vendor </span><span class="pull-right"></i></span></a>
                            </li>              
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div> <!-- end sidebarinner -->
            </div>
             <!-- Left Sidebar End -->