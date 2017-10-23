<?php
/**
 * Created by PhpStorm.
 * User: Greats
 * Date: 9/23/2017
 * Time: 10:16 AM
 */?>


<body class="index-page">
<!-- Navbar -->
<nav class="navbar navbar-white  navbar-fixed-top ">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-index">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a href="">
            <div class="logo-container">
                <div class="logo">
                    <img src="<?php echo $host_name; ?>/assets/img/logo.png" alt="Safiri APP">
                </div>
                <div class="brand text-main">
                    Safiri car Rental
                </div>


            </div>
        </a>
    </div>
    <div class="container">

        <div class="collapse navbar-collapse" id="navigation-index">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="<?php echo $host_name; ?>/home/" >
                        <i class="fa fa-home"></i> Home
                    </a>
                </li>
                <li>
                    <a href="<?php echo $host_name; ?>/home/rent/" >
                        <i class="fa fa-taxi"></i> Register to Rent
                    </a>
                </li>
                <li>
                    <a href="<?php echo $host_name; ?>/home/about/" >
                        <i class="fa fa-info-circle"></i> About Us
                    </a>
                </li>
                <li>
                    <a href="<?php echo $host_name; ?>/home/careers/" >
                        <i class="fa fa-briefcase"></i> Careers
                    </a>
                </li>
                <li>
                    <a href="<?php echo $host_name; ?>/home/contact/" >
                        <i class="fa fa-envelope"></i> Contact Us
                    </a>
                </li>
                <li id="no-user-logged">
                    <a href="#" data-toggle="modal" data-target="#loginModal">
                        <i class="fa fa-user"></i> ACCOUNT
                    </a>
                </li>
                <li id="admin-on-home">
                    <a href="<?php echo $host_name; ?>/admin/dashboard/" >
                        <i class="fa fa-user"></i> <span id="x-user-admin"></span>
                    </a>
                </li>
                <li id="supplier-on-home">
                    <a href="<?php echo $host_name; ?>/customer/dashboard/" >
                        <i class="fa fa-user"></i> <span id="x-user-supplier"></span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->

