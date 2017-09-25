<?php
/**
 * Created by PhpStorm.
 * User: Greats
 * Date: 9/23/2017
 * Time: 10:16 AM
 */?>


<body class="index-page">
<!-- Navbar -->
<nav class="navbar  navbar-fixed-top ">
    <div class="container">
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
                        <img src="<?php echo $host_name; ?>/assets/img/logo.png" alt="Creative Tim Logo" rel="tooltip" title="<b>Material Kit</b> was Designed & Coded with care by the staff from <b>Creative Tim</b>" data-placement="bottom" data-html="true">
                    </div>
                    <div class="brand text-main">
                        Safiri car Rental
                    </div>


                </div>
            </a>
        </div>

        <div class="collapse navbar-collapse" id="navigation-index">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="<?php echo $host_name; ?>/home/" >
                        <i class="fa fa-home"></i> Home
                    </a>
                </li>
                <li>
                    <a href="<?php echo $host_name; ?>/home/rent/" >
                        <i class="fa fa-taxi"></i> Rent It
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

            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->

