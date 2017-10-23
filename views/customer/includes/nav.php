<?php
/**
 * Created by PhpStorm.
 * User: Greats
 * Date: 9/19/2017
 * Time: 2:28 AM
 */?>

<body>
    <div class="wrapper">
        <div class="sidebar" data-color="purple" data-image="assets/img/sidebar-1.jpg">

            <div class="logo">
                <a href="<?php echo $host_name; ?>/customer/dashboard/" class="simple-text">
                   SAFIRI APP
                </a>
            </div>
            <div class="sidebar-wrapper ps-container ps-theme-default" data-ps-id="200dec3b-e6fe-1e46-dc17-26f4c021bf6e">
                <ul class="nav">
                    <li class="">
                        <a href="<?php echo $host_name; ?>/">
                            <i class="fa fa-home"></i>
                            <p>Home</p>
                        </a>
                    </li>
                    <li class="">
                        <a href="<?php echo $host_name; ?>/customer/dashboard/home/">
                            <i class="fa fa-dashboard"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $host_name; ?>/customer/dashboard/cars/">
                            <i class="fa fa-car"></i>
                            <p>Add Cars</p>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $host_name; ?>/customer/dashboard/my-cars/">
                            <i class="fa fa-taxi"></i>
                            <p>You Cars</p>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $host_name; ?>/customer/dashboard/reviews/">
                            <i class="fa fa-commenting"></i>
                            <p>Reviews and Comments</p>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $host_name; ?>/customer/dashboard/subscriptions/">
                            <i class="fa fa-money"></i>
                            <p>Subscriptions</p>
                        </a>
                    </li>
                    <li>
                        <a href="#" data-toggle="modal" data-target="#changepasswordModal">
                            <i class="fa fa-lock"></i>
                            <p>Change Password</p>
                        </a>
                    </li>
                    <li>
                        <a href="#" data-toggle="modal" data-target="#editAccountModal">
                            <i class="fa fa-edit"></i>
                            <p>Edit Account</p>
                        </a>
                    </li>
                                      <!--</li>-->
                </ul>
            <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 0px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
        <div class="sidebar-background" style="background-image: url(../assets/img/sidebar-1.jpg) "></div></div>
        <div class="main-panel ps-container ps-theme-default ps-active-y" data-ps-id="088d08e4-6b96-f185-1ea9-2f69c5682e1a">
            <nav class="navbar navbar-transparent navbar-absolute">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#"> Hey <span id="x-user-display-main"></span>, Welcome </a>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right ">

                            <li class="dropdown hidden-xs hidden-sm">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-fw fa-user text-center"></i> <span id="x-user"></span> <i class="fa fa-fw fa-chevron-down"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="#" data-toggle="modal" data-target="#editAccountModal">Edit Account</a>
                                    </li>
                                    <li>
                                        <a href="#" data-toggle="modal" data-target="#changepasswordModal">Change Password</a>
                                    </li>
                                    <li>
                                        <a href="#" onclick="logout()">Logout</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>