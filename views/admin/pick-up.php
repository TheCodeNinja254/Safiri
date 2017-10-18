<?php include 'includes/header.php';?>
<?php include 'includes/nav.php';?><br><br>

<div class="main">
            <div class="container-fluid">
                <div class="col-lg-12 col-md-12">
                    <div class="row">
                        <div class="card">
                            <h4 class="text-center text-main">Use the Fields Below to Add New Pick-Up Point</h4>
                            <form id="addPickupPointsFormAdmin" action="http://api.safirirental.com/addPickUpPoint/web/" method="post">
                                <div class="row" style="padding-left: 10px;padding-right: 10px;">
                                    <div class="col-md-6">
                                        <center>
                                        <div class="form-group">
                                            <select id="car_location_list_admin" name="location_code" required>
                                                <option value="">Select a Location</option>
                                            </select>
                                        </div>
                                        </center>
                                    </div>
                                    <div class="col-md-6">

<center>
                                            <input type="text" name="pick_up_point" value="" placeholder="Enter Pick Up Point" class="form-control" required/>
</center>

                                    </div>
                                    <center>
                                        <button class="btn btn-danger btn-sm" type="reset">CLEAR</button>
                                        <button type="submit" class="btn btn-success btn-sm">ADD</button>
                                    </center></div>
                            </form>
                        </div></div></div></div>
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
<h3 class="text-center">Your Pickup points</h3>
                                <div class="card-content table-responsive">
                                                <table class="table table-hover text-center" id="allPickUpPointsDataTable">
                                                    <thead class="text-main ">
                                                    <tr><th class="text-center"><strong>ID</strong></th>
                                                        <th class="text-center"><strong>Location</strong></th>
                                                        <th class="text-center"><strong>pickup Point</strong></th>
                                                        <th class="text-center"><strong>Action</strong></th>
                                                    </tr></thead>
                                                    <tbody>
                                                    
                                                    </tbody>
                                                </table>
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
</body>

<?php include 'includes/scripts.php';?>
<script type="application/javascript">
    $( document ).ready(function() {
        populate_all_pickup_datatable();
        load_admin_locations_list();
    });
</script>
</body>
</html>
