<?php include 'includes/header.php';?>
<?php include 'includes/nav.php';?><br><br>
<div class="main">
            <div class="container-fluid">
                <div class="col-lg-12 col-md-12">
                    <div class="row">
                        <div class="card">
                            <h4 class="text-center text-main">Use the Field Below to Add New Makes</h4>
                            <form>
                                <div class="row" style="padding-left: 10px">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" value="" placeholder="Enter New Rentals Location" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <center>
                                        <button class="btn btn-danger btn-sm" type="reset">CLEAR</button>
                                        <button type="submit" class="btn btn-success btn-sm" href="//localhost/safiri/photos/" >ADD</button>
                                        </center>
                                    </div></div>
                            </form>
                        </div></div></div></div>
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
<h3 class="text-center">Your Locations</h3>
                                <div class="card-content table-responsive">
                                                <table class="table table-hover text-center">
                                                    <thead class="text-main">
                                                    <tr><th class="text-center"><strong>ID</strong></th>
                                                        <th class="text-center"><strong>Make</strong></th>
                                                        <th class="text-center"><strong>Action</strong></th>
                                                    </tr></thead>
                                                    <tbody>
                                                    <tr>
                                                        <td>01</td>
                                                        <td>Toyota</td>
                                                        <td><button class="btn btn-danger btn-sm">Delete</button></td>
                                                    </tr>
                                                    <tr>
                                                        <td>02</td>
                                                        <td>Nissan</td>
                                                        <td><button class="btn btn-danger btn-sm">Delete</button></td>
                                                    </tr>
                                                    <tr>
                                                        <td>03</td>
                                                        <td>Mitsubishi</td>
                                                        <td><button class="btn btn-danger btn-sm">Delete</button></td>
                                                    </tr>
                                                    <tr>
                                                        <td>04</td>
                                                        <td>Volkswagen</td>
                                                        <td><button class="btn btn-danger btn-sm">Delete</button></td>
                                                    </tr>
                                                    <tr>
                                                        <td>05</td>
                                                        <td>Subaru</td>
                                                        <td><button class="btn btn-danger btn-sm">Delete</button></td>
                                                    </tr>
                                                    <tr>
                                                        <td>06</td>
                                                        <td>Mercedes Benz</td>
                                                        <td><button class="btn btn-danger btn-sm">Delete</button></td>

                                                    </tr>
                                                    <tr>
                                                        <td>07</td>
                                                        <td>BMW</td>
                                                        <td><button class="btn btn-danger btn-sm">Delete</button></td>
                                                    </tr>




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
</body>

<?php include 'includes/scripts.php';?>