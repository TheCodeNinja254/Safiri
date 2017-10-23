<?php include 'includes/header.php';?>
<?php include 'includes/nav.php';?>

            <div class="content">
                <div class="container-fluid" id="with-dl_check">
                    <div class="row"><center>
                        <div class="col-lg-2 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header" data-background-color="orange">
                                    <i class="fa fa-car"></i>
                                </div>
                                <div class="card-content">
                                    <p class="category">Cars</p>
                                    <h3 class="title">49
                                    </h3>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="fa fa-eye"></i>
                                        <a href="/admin/dashboard/cars">View</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header" data-background-color="green">
                                    <i class="fa fa-users"></i>
                                </div>
                                <div class="card-content">
                                    <p class="category">Customers</p>
                                    <h3 class="title">245</h3>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="fa fa-eye"></i>
                                        <a href="/admin/dashboard/customers">View</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header" data-background-color="red">
                                    <i class="fa fa-taxi"></i>
                                </div>
                                <div class="card-content">
                                    <p class="category">Car owners</p>
                                    <h3 class="title">75</h3>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="fa fa-eye"></i>
                                        <a href="/admin/dashboard/owners">View</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header" data-background-color="green">
                                    <i class="fa fa-map-marker"></i>
                                </div>
                                <div class="card-content">
                                    <p class="category">Locations</p>
                                    <h3 class="title">75</h3>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="fa fa-eye"></i>
                                        <a href="/admin/dashboard/owners">View</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header" data-background-color="orange">
                                    <i class="fa fa-street-view"></i>
                                </div>
                                <div class="card-content">
                                    <p class="category">Pick-Up Points</p>
                                    <h3 class="title">75</h3>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="fa fa-eye"></i>
                                        <a href="/admin/dashboard/owners">View</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header" data-background-color="red">
                                    <i class="fa fa-taxi"></i>
                                </div>
                                <div class="card-content">
                                    <p class="category">Car Makes</p>
                                    <h3 class="title">75</h3>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="fa fa-eye"></i>
                                        <a href="/admin/dashboard/owners">View</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </center> </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-header text-center " data-background-color="blue">
                                    <h4 class="title">New cars</h4>
<!--                                    <p class="category">Some cars have not been authorized</p>-->
                                </div>
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
                        <a href="https://safirirental.com/home/">Safiri APP </a>
                    </p>
                </div>
            </footer>


<?php include 'includes/scripts.php';?>
<script type="application/javascript">
    $( document ).ready(function() {
        populate_all_cars_datatable();
    });
</script>

