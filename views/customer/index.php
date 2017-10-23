<?php include 'includes/header.php';?>
<?php include 'includes/nav.php';?>
            <div class="content">
                <div class="container-fluid" id="with-dl_check">
                    <div class="row"><center>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header" data-background-color="orange">
                                    <i class="fa fa-car"></i>
                                </div>
                                <div class="card-content">
                                    <a class="btn btn-warning btn-sm" href="<?php echo $host_name; ?>cars"><i class="fa fa-eye"></i> View your cars</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header" data-background-color="green">
                                    <i class="fa fa-taxi"></i>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <a class="btn btn-success btn-sm" href="<?php echo $host_name; ?>/customer/dashboard/cars/"><i class="fa fa-plus-circle"></i> Add a car</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header" data-background-color="red">
                                    <i class="fa fa-taxi"></i>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <a class="btn btn-danger btn-sm" href="#pablo"><i class="fa fa-minus-circle"></i> Remove a car</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </center> </div>
                    <div class="row">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="card card-nav-tabs">
                                    <div class="card-header card-header-table" data-background-color="blue">
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
                                                    <table class="table table-hover table-responsive" id="ownersCarsDataTable">

                                                        <thead class="text-main">
                                                        <tr><th>Reg Number</th>
                                                            <th>Make</th>
                                                            <th>Model</th>
                                                            <th>Body Type</th>
                                                            <th>Pick Up Point</th>
                                                            <th>Price per day</th>
                                                            <th>Status</th>
                                                        </tr></thead>
                                                        <tbody>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="unverified">
                                                <div class="card-content table-responsive">
                                                    <table class="table table-hover">
                                                        <thead class="text-main">
                                                        <tr><th>Reg Number</th>
                                                            <th>Make</th>
                                                            <th>Model</th>
                                                            <th>Type</th>
                                                            <th>Location</th>
                                                            <th>Price per day</th>
                                                            <th>Status</th>
                                                        </tr></thead>
                                                        <tbody>
                                                        <tr>
                                                            <td>KBA 232</td>
                                                            <td>Toyota</td>
                                                            <td>Noah</td>
                                                            <td>Van</td>
                                                            <td>Nairobi</td>
                                                            <td>3000</td>
                                                            <td>Unverified</td>
                                                        </tr>
                                                        <tr>
                                                            <td>KBA 232</td>
                                                            <td>Toyota</td>
                                                            <td>Noah</td>
                                                            <td>Van</td>
                                                            <td>Nairobi</td>
                                                            <td>3000</td>
                                                            <td>UnVerified</td>
                                                        </tr>
                                                        <tr>
                                                            <td>KBA 232</td>
                                                            <td>Toyota</td>
                                                            <td>Noah</td>
                                                            <td>Van</td>
                                                            <td>Nairobi</td>
                                                            <td>3000</td>
                                                            <td>Unverified</td>
                                                        </tr>
                                                        <tr>
                                                            <td>KBA 232</td>
                                                            <td>Toyota</td>
                                                            <td>Noah</td>
                                                            <td>Van</td>
                                                            <td>Nairobi</td>
                                                            <td>3000</td>
                                                            <td>UnVerified</td>
                                                        </tr>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="all">
                                                <div class="card-content table-responsive">
                                                    <table class="table table-hover">
                                                        <thead class="text-main">
                                                        <tr><th>Reg Number</th>
                                                            <th>Make</th>
                                                            <th>Model</th>
                                                            <th>Type</th>
                                                            <th>Price per day</th>
                                                            <th>Status</th>
                                                        </tr></thead>
                                                        <tbody>


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

<?php include 'includes/scripts.php';?>

<!--populate_owners_car_datatable()-->
<script type="application/javascript">
    $( document ).ready(function() {
        populate_owners_car_datatable();
    });
</script>


