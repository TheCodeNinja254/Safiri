<?php include 'include/header.php';?>
<?php include 'include/nav.php';?>

<div class="wrapper">
    <div class="header header-filter" style="background-image: url('/assets/img/banner2.jpeg');">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="brand">
                        <h1>Safiri Car Rental.</h1>
                        <h5>Register today and start earning.</h5>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="main ">
        <div class="section section-basic">

                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="content">
                                <center><h3 class=""><i class="fa fa-user-plus text-main"></i> <br ><strong>Why Register with us </strong></h3></center>
                                <ul>
                                    <li>We provide you with  many ready customers on our platform.</li>
                                    <li>Provides a faster way to connect with clients.</li>
                                    <li>We have flexible and great prices</li>
                                    <li>Our platform is easy to use.</li>
                                    <li>Good customer service.</li>
<!--                                    <li>.</li>-->
                                </ul>
                                <center><button class="btn btn-primary-outline btn-round btn-sm text-center">Register</button></center>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="content">
                                <center><h5 class=""><i class="fa fa-user-plus text-main"></i> <br ><strong>Fill the form below to Register </strong></h5></center>
                                <div class="row">
                               <form action="api.safirirental.com/addSupplier/" method="post" id="addSupplierForm">
                                   <div class="col-md-6">
                                       <div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-user"></i>
								</span>
                                           <input type="text" name="f_name" class="form-control" placeholder="First Name" required>
                                       </div>
                                   </div>
                                   <div class="col-md-6">
                                       <div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-user"></i>
								</span>
                                           <input type="text" name="l_name" class="form-control" placeholder="Last Name" required>
                                       </div>
                                   </div>
                                   <div class="col-md-6">
                                       <div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-envelope"></i>
								</span>
                                           <input type="email" name="email_address" class="form-control" placeholder="Email" required>
                                       </div>
                                   </div>

                                   <div class="col-md-6">
                                       <div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-key"></i>
								</span>
                                           <input type="text" name="supplier_username" class="form-control" placeholder="Username" required>
                                       </div>
                                   </div>

                                   <div class="col-md-6">
                                       <div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-phone"></i>
								</span>
                                           <input type="text" name="phone_number" class="form-control" placeholder="Phone Number" required>
                                       </div>
                                   </div>
                                   <div class="col-md-6">
                                       <div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-lock"></i>
								</span>
                                           <input type="password" name="supplier_password_one" class="form-control" placeholder="Password" required>
                                       </div>
                                   </div>
                                   <div class="col-md-6">
                                       <div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-lock"></i>
								</span>
                                           <input type="password"  name="supplier_password_two" class="form-control" placeholder="Confirm Password">
                                       </div>
                                   </div>
                                   <center><button class="btn btn-danger btn-round btn-sm text-center">Clear</button>
                                       <button class="btn btn-primary btn-round btn-sm text-center">Register</button></center>
                               </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card">
                            <div class="content">
                                <center><h3 class=""><i class="fa fa-refresh text-main"></i> <br><strong>Please NOTE </strong></h3></center>
                                <ul>
                                    <li>Provide your official names.</li>
                                    <li>Provides your official email.</li>
                                    <li>Provide your active phone number</li>
                                    <li>Customer will see the above information.</li>
                                    <li>These details can be changed after login.</li>
                                    <li>An account activation email will be sent to your email after registration.</li>
                                    <li>You will only proceed to add your car after activating your account.</li>
                                    <!--                                    <li>.</li>-->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>

    </div>

    <!--    Footer, MODAL and JS -->
<?php include 'include/bottom.php';?>
<?php include 'include/scripts.php';?>
</html>

