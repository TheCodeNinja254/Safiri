<?php include 'includes/header.php';?>
<?php include 'includes/nav.php';?><br><br>

<div class="main">
            <div class="container-fluid">
                <div class="col-lg-12 col-md-12">
                    <div class="row">
                        <div class="card">
                            <h4 class="text-center text-main">Use the Fields Below to Add New Pick-Up Point</h4>
                            <form>
                                <div class="row" style="padding-left: 10px;padding-right: 10px;">
                                    <div class="col-md-6">
                                        <center>
                                        <div class="form-group">
                                            <select id="car_make_list" class="selectpicker" data-style="btn-primary" data-width="80%"  title="Select Location/City...">
                                                <option value="Nairobi">Nairobi</option>
                                                <option value="Mombasa">Mombasa</option>
                                                <option value="Kisumu">Kisumu</option>
                                                <option value="Nakuru">Nakuru</option>
                                                <option value="Eldoret">Eldoret</option>
                                                <option value="Kericho">Kericho</option>                                            </select>
                                        </div>
                                        </center>
                                    </div>
                                    <div class="col-md-6">

<center>
                                            <input type="text" value="" placeholder="Enter Pick Up Point" class="form-control" />
</center>

                                    </div>
                                    <center>
                                        <button class="btn btn-danger btn-sm" type="reset">CLEAR</button>
                                        <button type="submit" class="btn btn-success btn-sm" href="//localhost/safiri/photos/" >ADD</button>
                                    </center></div>
                            </form>
                        </div></div></div></div>
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
<h3 class="text-center">Your Pickup points</h3>
                                <div class="card-content table-responsive">
                                                <table class="table table-hover text-center">
                                                    <thead class="text-main ">
                                                    <tr><th class="text-center"><strong>ID</strong></th>
                                                        <th class="text-center"><strong>Location</strong></th>
                                                        <th class="text-center"><strong>pickup Point</strong></th>
                                                        <th class="text-center"><strong>Action</strong></th>
                                                    </tr></thead>
                                                    <tbody>
                                                    <tr>
                                                        <td>01</td>
                                                        <td>Nairobi</td>
                                                        <td>Westalands</td>
                                                        <td><button class="btn btn-danger btn-sm">Delete</button></td>
                                                    </tr>
                                                    <tr>
                                                        <td>01</td>
                                                        <td>Nairobi</td>
                                                        <td>Westalands</td>
                                                        <td><button class="btn btn-danger btn-sm">Delete</button></td>
                                                    </tr>
                                                    <tr>
                                                        <td>01</td>
                                                        <td>Nairobi</td>
                                                        <td>Westalands</td>
                                                        <td><button class="btn btn-danger btn-sm">Delete</button></td>
                                                    </tr>
                                                    <tr>
                                                        <td>01</td>
                                                        <td>Nairobi</td>
                                                        <td>Westalands</td>
                                                        <td><button class="btn btn-danger btn-sm">Delete</button></td>
                                                    </tr>
                                                    <tr>
                                                        <td>01</td>
                                                        <td>Nairobi</td>
                                                        <td>Westalands</td>
                                                        <td><button class="btn btn-danger btn-sm">Delete</button></td>
                                                    </tr>
                                                    <tr>
                                                        <td>01</td>
                                                        <td>Nairobi</td>
                                                        <td>Westalands</td>
                                                        <td><button class="btn btn-danger btn-sm">Delete</button></td>
                                                    </tr>
                                                    <tr>
                                                        <td>01</td>
                                                        <td>Nairobi</td>
                                                        <td>Westalands</td>
                                                        <td><button class="btn btn-danger btn-sm">Delete</button></td>
                                                    </tr>




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