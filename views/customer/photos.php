<?php include 'includes/header.php';?>
<?php include 'includes/nav.php';?>
            <div class="content">
                <div class="container-fluid">
                    <div class="card">
                        <h4 class="text-center text-main">Please Upload photos of your car<small>(Maximum Photos 5)</small> </h4>
                        <form id="uploadCarPhotosWebForm" action="https://api.safirirental.com/uploadCarPhotos/web/" method="post" enctype="multipart/form-data" >
                    <div class="row" style="padding-left: 10px">
                        <div class="col-md-12">
                            <center>
                                            <div class="form-group">
                                                <select class="" id="owner_cars_list_select" name="car_id_from_list" data-style="btn-primary" data-width="300px"  title="Choose your Car..." required>
                                                    <option value="">Select a car</option>
                                                </select>
                                            </div>
                            </center></div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3">
                                        <legend class="text-center">Car Photo 1</legend>
                                        <center>
                                            <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail img-circle">
                                                    <img src="<?php echo $host_name;?>/assets/img/automobile.png" alt="...">
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail img-circle"></div>
                                                <div>
                                                    <span class="btn btn-round btn-primary btn-file">
                                                        <span class="fileinput-new">Select photo</span>
                                                        <span class="fileinput-exists">Change</span>
                                                        <input type="file" name="post_image_one" accept="image/*" required/>
                                                    </span>
                                                    <br />
                                                    <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                                </div>
                                            </div><br>
                                        </center>
                                    </div>
                                    <div class="col-md-3">
                                        <legend class="text-center">Car Photo 2</legend>
                                        <center>
                                            <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail img-circle">
                                                    <img src="<?php echo $host_name;?>/assets/img/automobile.png" alt="...">
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail img-circle"></div>
                                                <div>
                                                    <span class="btn btn-round btn-primary btn-file">
                                                        <span class="fileinput-new">Select photo</span>
                                                        <span class="fileinput-exists">Change</span>
                                                        <input type="file" name="post_image_two" accept="image/*" required/>
                                                    </span>
                                                    <br />
                                                    <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                                </div>
                                            </div><br>
                                        </center>
                                    </div>
                                    <div class="col-md-3">
                                        <legend class="text-center">Car Photo 3</legend>
                                        <center>
                                            <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail img-circle">
                                                    <img src="<?php echo $host_name;?>/assets/img/automobile.png" alt="...">
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail img-circle"></div>
                                                <div>
                                                    <span class="btn btn-round btn-primary btn-file">
                                                        <span class="fileinput-new">Select photo</span>
                                                        <span class="fileinput-exists">Change</span>
                                                        <input type="file" name="post_image_three" accept="image/*" required/>
                                                    </span>
                                                    <br />
                                                    <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                                </div>
                                            </div><br>
                                        </center>
                                    </div>
                                    <div class="col-md-3">
                                        <legend class="text-center">Car Photo 4</legend>
                                        <center>
                                            <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail img-circle">
                                                    <img src="<?php echo $host_name;?>/assets/img/automobile.png" alt="...">
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail img-circle"></div>
                                                <div>
                                                    <span class="btn btn-round btn-primary btn-file">
                                                        <span class="fileinput-new">Select photo</span>
                                                        <span class="fileinput-exists">Change</span>
                                                        <input type="file" name="post_image_four" accept="image/*" required/>
                                                    </span>
                                                    <br />
                                                    <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                                </div>
                                            </div><br>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        <div class="col-md-12">
                            <center>
                            <button class="btn btn-success btn-sm" type="submit">SAVE</button>
                            </center>
                        </div>
                    </div>
                        </form>
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
</body>

<?php include 'includes/scripts.php';?>
<script type="application/javascript">
    $( document ).ready(function() {
       load_owner_cars_list();
    });
</script>
