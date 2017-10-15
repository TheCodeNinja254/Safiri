<?php include 'includes/header.php';?>
<?php include 'includes/nav.php';?>

            <div class="content">
                <div class="container-fluid">
                    <div class="card">
                        <h4 class="text-center text-main">Please provide CORRECT information of your</h4>
                        <form  id="addCarWebForm" action="https://api.safirirental.com/addCar/web/" method="post" enctype="multipart/form-data">
                    <div class="row" style="padding-left: 10px">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <select id="car_make_list" name="ad_car_make" class="selectpicker" data-style="btn-primary" data-width="100%"  title="Choose your Car Make...">
                                                    <option value="">Select Make</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" name="ad_car_model" value="" placeholder="Enter Your car Model" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select id="car_body_type_list" name="ad_car_body_type" class="selectpicker" data-style="btn-primary" data-width="100%"  title="Choose your Car Body Type...">
                                        <option value="">Select Body Type</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="ad_car_number_plate" value="" placeholder="Enter Your car Number Plate" class="form-control" />
                                </div>
                            </div>
                            </div>
                                </div>
                                <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select id="car_location_list" name="ad_car_location" class="selectpicker" data-style="btn-primary" data-width="100%"  title="Select a Location...">
                                                <option value="">Nairobi</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="ad_price_per_day" value="" placeholder="Enter Your Price per Day" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select id="car_pickup_point_list" name="ad_car_pickup_point" class="selectpicker" data-style="btn-primary" data-width="100%"  title="Select a Pickup point">
                                                <option value="">Dandora</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                            <div class="col-md-4">
                                <legend class="text-center">Please Upload a scanned Logbook</legend>
                                <center>
                                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail img-circle">
                                        <img src="https://safirirental.com/assets/img/placeholder.jpg" alt="...">
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail img-circle"></div>
                                    <div>
                                                    <span class="btn btn-round btn-primary btn-file">
                                                        <span class="fileinput-new">Upload Logbook</span>
                                                        <span class="fileinput-exists">Change</span>
                                                        <input type="file" name="post_file" accept="*"/>
                                                    </span>
                                        <br />
                                        <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                    </div>
                                </div><br>
                                    <button class="btn btn-success btn-sm" type="submit">SAVE</button>
                                    <a class="btn btn-primary btn-sm" href="<?php echo $host_name ?>/customer/dashboard/photo-upload/" >Upload Photos</a>
                                </center>
                            </div>
                        </form>
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
                        <a href="http://www.safirirental.com">Safiri APP </a>
                    </p>
                </div>
            </footer>
        </div>
    </div>
<?php include 'includes/scripts.php';?>
<script type="application/javascript">
    $( document ).ready(function() {
        load_car_make();
        load_body_types();
        load_car_location_list();
    });
</script>
