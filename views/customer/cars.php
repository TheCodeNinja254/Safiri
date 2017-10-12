<?php include 'includes/header.php';?>
<?php include 'includes/nav.php';?>

            <div class="content">
                <div class="container-fluid">
                    <div class="card">
                        <h4 class="text-center text-main">Please provide CORRECT information of your</h4>
                        <form>
                    <div class="row" style="padding-left: 10px">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <select class="selectpicker" data-style="btn-primary" data-width="100%"  title="Choose your Car Make...">
                                                    <option>Toyota</option>
                                                    <option>Nissan</option>
                                                    <option>Mazda</option>
                                                    <option>Mitsubishi</option>
                                                    <option>Hyundai</option>
                                                    <option>Volkswagen</option>
                                                    <option>Audi</option>
                                                    <option>BMW</option>
                                                    <option>Mercedes-Benz</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" value="" placeholder="Enter Your car Model" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="selectpicker" data-style="btn-primary" data-width="100%"  title="Choose your Car Body Type...">
                                        <option>Saloon</option>
                                        <option>Station Wagon</option>
                                        <option>Hatch Back</option>
                                        <option>Pick Up</option>
                                        <option>SUV</option>
                                        <option>Canter</option>
                                        <option>Lorry</option>
                                        <option>Luxury Class</option>
                                        <option>Mercedes-Benz</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" value="" placeholder="Enter Your car Number Plate" class="form-control" />
                                </div>
                            </div>
                            </div>
                                </div>
                                <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" value="" placeholder="Enter Your Price per Day" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" value="" placeholder="Enter Your car Pick Up Point" class="form-control" />
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
                                                        <input type="file" name="..." />
                                                    </span>
                                        <br />
                                        <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                    </div>
                                </div><br>
                                    <button class="btn btn-success btn-sm" type="submit">SAVE</button>
                                    <a class="btn btn-primary btn-sm" href="<?php echo $host_name ?>/photos/" >UPload Photos</a>
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
