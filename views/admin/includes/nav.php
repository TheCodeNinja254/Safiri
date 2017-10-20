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
                <a href="https://safirirental.com/home/" class="simple-text">
                   SAFIRI APP
                </a>
            </div>
            <div class="sidebar-wrapper ps-container ps-theme-default" data-ps-id="200dec3b-e6fe-1e46-dc17-26f4c021bf6e">
                <ul class="nav">
                    <li class="">
                        <a href="<?php echo $host_name; ?>/admin/dashboard/">
                            <i class="fa fa-home"></i>
                            <p>Home</p>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $host_name; ?>/admin/dashboard/cars/">
                            <i class="fa fa-car"></i>
                            <p>Cars</p>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $host_name; ?>/admin/dashboard/customers/">
                            <i class="fa fa-users"></i>
                            <p>Customers</p>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $host_name; ?>/admin/dashboard/owners/">
                            <i class="fa fa-taxi"></i>
                            <p>Car Owners</p>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $host_name; ?>/admin/dashboard/locations/">
                            <i class="fa fa-map-marker"></i>
                            <p>Locations</p>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $host_name; ?>/admin/dashboard/pick-up/">
                            <i class="fa fa-street-view"></i>
                            <p>Pick-up Points</p>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $host_name; ?>/admin/dashboard/makes/">
                            <i class="fa fa-taxi"></i>
                            <p>Car Makes</p>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $host_name; ?>/admin/dashboard/reviews/">
                            <i class="fa fa-commenting"></i>
                            <p>Reviews and Comments</p>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $host_name; ?>/admin/dashboard/subscription/">
                            <i class="fa fa-money"></i>
                            <p>Subscriptions</p>
                        </a>
                    </li>
                    <!--<li class="hidden-md hidden-md">-->
                        <!--<a href="http://demos.creative-tim.com/material-dashboard/examples/maps.html">-->
                            <!--<i class="fa fa-user"></i>-->
                            <!--<p>Profile</p>-->
                        <!--</a>-->
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
                        <a class="navbar-brand" href="#"> Hey Admin, Welcome </a>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right ">

                            <li class="dropdown hidden-xs hidden-sm">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-user text-center"></i> <span id="x-user"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="#">Change password</a>
                                    </li>
                                    <li>
                                        <a href="#">Edit Account</a>
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