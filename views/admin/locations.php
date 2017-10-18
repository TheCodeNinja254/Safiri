<?php include 'includes/header.php';?>
<?php include 'includes/nav.php';?><br><br>
<div class="main">
            <div class="container-fluid">
                <div class="col-lg-12 col-md-12">
                    <div class="row">
                        <div class="card">
                            <h4 class="text-center text-main">Use the Field Below to Add New Locations</h4>
                            <form id="addLocationFormAdmin" action="https://api.safirirental.com/addLocatio/web/" method="post">
                                <div class="row" style="padding-left: 10px">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" value="" name="location_name" placeholder="Enter New Rentals Location" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <center>
                                        <button class="btn btn-danger btn-sm" type="reset">CLEAR</button>
                                        <button type="submit" class="btn btn-success btn-sm">ADD</button>
                                        </center>
                                    </div></div>
                            </form>
                        </div></div></div></div>
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
<h3 class="text-center">Your Locations</h3>
                                <div class="card-content table-responsive">
                                                <table class="table table-hover text-center" id="allLocationsDataTable">
                                                    <thead class="text-main">
                                                    <tr><th class="text-center"><strong>ID</strong></th>
                                                        <th class="text-center"><strong>Location Code</strong></th>
                                                        <th class="text-center"><strong>Location Name</strong></th>
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


<?php include 'includes/scripts.php';?>
<script type="application/javascript">
    $( document ).ready(function() {
        populate_all_locations_datatable();
    });
</script>
</body>
</html>