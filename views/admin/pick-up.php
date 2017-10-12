<?php include 'includes/header.php';?>
<?php include 'includes/nav.php';?><br><br>
<div class="main">
            <div class="container-fluid">
                <div class="col-lg-12 col-md-12">
                    <div class="row">
                        <div class="card">
                            <h4 class="text-center text-main">Use the Fields Below to Add New Pick-Up Point</h4>
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
                                                <table class="table table-hover">
                                                    <thead class="text-main">
                                                    <tr><th><strong>ID</strong></th>
                                                        <th><strong>Location</strong></th>
                                                    </tr></thead>
                                                    <tbody>
                                                    <tr>
                                                        <td>01</td>
                                                        <td>Nairobi</td>
                                                    </tr>
                                                    <tr>
                                                        <td>02</td>
                                                        <td>Mombasa</td>
                                                    </tr>
                                                    <tr>
                                                        <td>03</td>
                                                        <td>Kisumu</td>
                                                    </tr>
                                                    <tr>
                                                        <td>04</td>
                                                        <td>Nakuru</td>
                                                    </tr>
                                                    <tr>
                                                        <td>05</td>
                                                        <td>Eldoret</td>
                                                    </tr>
                                                    <tr>
                                                        <td>06</td>
                                                        <td>Kericho</td>
                                                    </tr>
                                                    <tr>
                                                        <td>07</td>
                                                        <td>Thika</td>
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