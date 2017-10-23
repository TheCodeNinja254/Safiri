<?php include 'includes/header.php';?>
<?php include 'includes/nav.php';?>


            <div class="content">
                <div class="container-fluid" id="with-dl_check">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card card-nav-tabs">
                                <div class="card-header" data-background-color="blue">
                                    <div class="nav-tabs-navigation">
                                        <div class="nav-tabs-wrapper ">
                                            <!--<span class="nav-tabs-title">Categories:</span>--><center>
                                            <ul class="nav nav-tabs " data-tabs="tabs">
                                                <li class="active ">
                                                    <a href="#verified" data-toggle="tab">
                                                        <i class="fa fa-check "></i> Verified
                                                        <div class="ripple-container"></div>
                                                    </a>
                                                </li>
                                                <li class="">
                                                    <a href="#unverified" data-toggle="tab">
                                                        <i class="fa fa-times"></i> Unverified
                                                        <div class="ripple-container"></div>
                                                    </a>
                                                </li>
                                                <li class="">
                                                    <a href="#all" data-toggle="tab">
                                                        <i class="fa fa-globe"></i> All cars
                                                        <div class="ripple-container"></div>
                                                    </a>
                                                </li>
                                            </ul></center>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="verified">
                                            <div class="card-content table-responsive">
                                                <table class="table table-hover" id="allCarsDataTable">
                                                    <thead class="text-main">
                                                    <tr>
                                                        <th><strong>Owner</strong></th>
                                                        <th><strong>Reg Number</strong></th>
                                                        <th><strong>Make</strong></th>
                                                        <th><strong>Model</strong></th>
                                                        <th><strong>Type</strong></th>
                                                        <th><strong>Location</strong></th>
                                                        <th><strong>Price</strong></th>
                                                        <th><strong>Status</strong></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="unverified">
                                            <div class="card-content table-responsive">
                                                <table class="table table-hover">
                                                    <thead class="text-main">
                                                    <tr><th><strong>Reg Number</strong></th>
                                                        <th><strong>Make</strong></th>
                                                        <th><strong>Model</strong></th>
                                                        <th><strong>Type</strong></th>
                                                        <th><strong>Location</strong></th>
                                                        <th><strong>Owner</strong></th>
                                                        <th><strong>Action</strong></th>
                                                    </tr></thead>
                                                    <tbody>
                                                    <tr>
                                                        <td>KBA 232</td>
                                                        <td>Toyota</td>
                                                        <td>Noah</td>
                                                        <td>Van</td>
                                                        <td>Nairobi</td>
                                                        <td>James</td>
                                                        <td class=""><i class="fa fa-check text-success"></i>/<i class="fa fa-times text-danger"></i> <B>VERIFY</B></td>
                                                    </tr>
                                                    <tr>
                                                        <td>KBA 232</td>
                                                        <td>Toyota</td>
                                                        <td>Noah</td>
                                                        <td>Van</td>
                                                        <td>Nairobi</td>
                                                        <td>James</td>
                                                        <td class=""><i class="fa fa-check text-success"></i>/<i class="fa fa-times text-danger"></i> <B>VERIFY</B></td>
                                                    </tr>
                                                    <tr>
                                                        <td>KBA 232</td>
                                                        <td>Toyota</td>
                                                        <td>Noah</td>
                                                        <td>Van</td>
                                                        <td>Nairobi</td>
                                                        <td>James</td>
                                                        <td class=""><i class="fa fa-check text-success"></i>/<i class="fa fa-times text-danger"></i> <B>VERIFY</B></td>
                                                    </tr>
                                                    <tr>
                                                        <td>KBA 232</td>
                                                        <td>Toyota</td>
                                                        <td>Noah</td>
                                                        <td>Van</td>
                                                        <td>Nairobi</td>
                                                        <td>James</td>
                                                        <td class=""><i class="fa fa-check text-success"></i>/<i class="fa fa-times text-danger"></i> <B>VERIFY</B></td>
                                                    </tr>
                                                    <tr>
                                                        <td>KBA 232</td>
                                                        <td>Toyota</td>
                                                        <td>Noah</td>
                                                        <td>Van</td>
                                                        <td>Nairobi</td>
                                                        <td>James</td>
                                                        <td class=""><i class="fa fa-check text-success"></i>/<i class="fa fa-times text-danger"></i> <B>VERIFY</B></td>
                                                    </tr>
                                                    <tr>
                                                        <td>KBA 232</td>
                                                        <td>Toyota</td>
                                                        <td>Noah</td>
                                                        <td>Van</td>
                                                        <td>Nairobi</td>
                                                        <td>James</td>
                                                        <td class=""><i class="fa fa-check text-success"></i>/<i class="fa fa-times text-danger"></i> <B>VERIFY</B></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="all">
                                            <div class="card-content table-responsive">
                                                <table class="table table-hover">
                                                    <thead class="text-main">
                                                    <tr><th><strong>Reg Number</strong></th>
                                                        <th><strong>Make</strong></th>
                                                        <th><strong>Model</strong></th>
                                                        <th><strong>Type</strong></th>
                                                        <th><strong>Location</strong></th>
                                                        <th><strong>Owner</strong></th>
                                                        <th><strong>Status</strong></th>
                                                    </tr></thead>
                                                    <tbody>
                                                    <tr>
                                                        <td>KBA 232</td>
                                                        <td>Toyota</td>
                                                        <td>Noah</td>
                                                        <td>Van</td>
                                                        <td>Nairobi</td>
                                                        <td>James</td>
                                                        <td class=""><i class="fa fa-check text-success"></i> <B>VERIFIED</B></td>
                                                    </tr>
                                                    <tr>
                                                        <td>KBA 232</td>
                                                        <td>Toyota</td>
                                                        <td>Noah</td>
                                                        <td>Van</td>
                                                        <td>Nairobi</td>
                                                        <td>James</td>
                                                        <td class=""><i class="fa fa-times text-danger"></i> <B>UNVERIFIED</B></td>
                                                    </tr>
                                                    <tr>
                                                        <td>KBA 232</td>
                                                        <td>Toyota</td>
                                                        <td>Noah</td>
                                                        <td>Van</td>
                                                        <td>Nairobi</td>
                                                        <td>James</td>
                                                        <td class=""><i class="fa fa-check text-success"></i> <B>VERIFIED</B></td>
                                                    </tr>
                                                    <tr>
                                                        <td>KBA 232</td>
                                                        <td>Toyota</td>
                                                        <td>Noah</td>
                                                        <td>Van</td>
                                                        <td>Nairobi</td>
                                                        <td>James</td>
                                                        <td class=""><i class="fa fa-times text-danger"></i> <B>UNVERIFIED</B></td>
                                                    </tr>
                                                    <tr>
                                                        <td>KBA 232</td>
                                                        <td>Toyota</td>
                                                        <td>Noah</td>
                                                        <td>Van</td>
                                                        <td>Nairobi</td>
                                                        <td>James</td>
                                                        <td class=""><i class="fa fa-check text-success"></i> <B>VERIFIED</B></td>
                                                    </tr>
                                                    <tr>
                                                        <td>KBA 232</td>
                                                        <td>Toyota</td>
                                                        <td>Noah</td>
                                                        <td>Van</td>
                                                        <td>Nairobi</td>
                                                        <td>James</td>
                                                        <td class=""><i class="fa fa-times text-danger"></i> <B>UNVERIFIED</B></td>
                                                    </tr>
                                                    <tr>
                                                        <td>KBA 232</td>
                                                        <td>Toyota</td>
                                                        <td>Noah</td>
                                                        <td>Van</td>
                                                        <td>Nairobi</td>
                                                        <td>James</td>
                                                        <td class=""><i class="fa fa-check text-success"></i> <B>VERIFIED</B></td>
                                                    </tr>
                                                    <tr>
                                                        <td>KBA 232</td>
                                                        <td>Toyota</td>
                                                        <td>Noah</td>
                                                        <td>Van</td>
                                                        <td>Nairobi</td>
                                                        <td>James</td>
                                                        <td class=""><i class="fa fa-times text-danger"></i> <B>UNVERIFIED</B></td>
                                                    </tr>
                                                    <tr>
                                                        <td>KBA 232</td>
                                                        <td>Toyota</td>
                                                        <td>Noah</td>
                                                        <td>Van</td>
                                                        <td>Nairobi</td>
                                                        <td>James</td>
                                                        <td class=""><i class="fa fa-check text-success"></i> <B>VERIFIED</B></td>
                                                    </tr>
                                                    <tr>
                                                        <td>KBA 232</td>
                                                        <td>Toyota</td>
                                                        <td>Noah</td>
                                                        <td>Van</td>
                                                        <td>Nairobi</td>
                                                        <td>James</td>
                                                        <td class=""><i class="fa fa-times text-danger"></i> <B>UNVERIFIED</B></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer text-center">
                <div class="container-fluid">
                    <p class="copyright">
                        &copy;
                        <script>
                            document.write(new Date().getFullYear())
                        </script>
                        <a href="http://www.creative-tim.com">Safiri APP </a>
                    </p>
                </div>
            </footer>
        </div>
    </div>
</body>

<?php include 'includes/scripts.php';?>
<script type="application/javascript">
    $( document ).ready(function() {
        populate_all_cars_datatable();
    });
</script>
