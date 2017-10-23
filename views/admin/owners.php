<?php include 'includes/header.php';?>
<?php include 'includes/nav.php';?>
            <div class="content">
                <div class="container-fluid" id="with-dl_check">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
<h3 class="text-center">Registered Car Owners</h3>
                                <div class="card-content table-responsive">
                                    <table class="table table-hover" id="usersDataTable">
                                        <thead class="text-main text-bold">

                                        <tr><th><strong>First Name</strong></th>
                                            <th><strong>Last name</strong></th>
                                            <th><strong>Postal Address</strong></th>
                                            <th><strong>Email</strong></th>
                                            <th><strong>Username</strong></th>
                                            <th><strong>National ID</strong></th>
                                            <th><strong>Phone</strong></th>
                                            <th><strong>Date Joined</strong></th>
                                            <th><strong>Action</strong></th>
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
<script type="application/javascript">
    $( document ).ready(function() {
        populate_suppliers_datatable();
    });
</script>
</body>
</html>
