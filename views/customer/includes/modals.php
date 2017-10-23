<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content card card-signup">
            <div class="modal-headertext-center">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <i class="material-icons">clear</i>
                </button>
            </div>
            <div class="modal-body">
                <div class="">
                    <form id="loginForm" class="form" method="post" action="https://api.safirirental.com/userLogin/web/">
                        <p class="title">Login</p>
                        <div class="content">
                            <div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-fw fa-envelope"></i>
										</span>
                                <input type="text" id="dashboard_username_verification" value="" name="lg_username" class="form-control" placeholder="Username, Email, Phone, ID Number" readonly required>
                            </div>

                            <div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-fw fa-lock"></i>
										</span>
                                <input type="password" name="lg_password" placeholder="Password..." class="form-control" required/>
                            </div>


                            <div class="checkbox text-center">
                                <button type="submit" class="btn btn-simple btn-primary btn-sm btn-round">LOGIN</button>
                    </form>

                    <strong>OR </strong><a href="<?php echo $host_name; ?>/home/rent" class="btn btn-success btn-sm btn-round">REGISTER</a>
                </div>
            </div>
            <div class="footer text-center">
            </div>
            </form>
        </div>

    </div>
</div>

<div class="modal fade" id="changepasswordModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content card card-signup">
            <div class="modal-headertext-center">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <i class="material-icons">clear</i>
                </button>
            </div>
            <div class="modal-body">
                <div class="">
                    <form id="loginForm" class="form" method="post" action="https://api.safirirental.com/userChangePassword/web/">
                        <p class="title">Login</p>
                        <div class="content">
                            <div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-fw fa-envelope"></i>
										</span>
                                <input type="password" id="old_password" value="" name="lg_username" class="form-control" placeholder="Old Password" required>
                            </div>

                            <div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-fw fa-lock"></i>
										</span>
                                <input type="password" name="lg_password" placeholder="New Password" class="form-control" required/>
                            </div>

                            <div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-fw fa-lock"></i>
										</span>
                                <input type="password" name="lg_password" placeholder="Re-enter Password" class="form-control" required/>
                            </div>


                            <div class="checkbox text-center">
                                <button type="submit" class="btn btn-simple btn-primary btn-sm btn-round">LOGIN</button>
                    </form>

                    <strong>OR </strong><a href="<?php echo $host_name; ?>/home/rent" class="btn btn-success btn-sm btn-round">REGISTER</a>
                </div>
            </div>
            <div class="footer text-center">
            </div>
            </form>
        </div>

    </div>
</div>

<div class="modal fade" id="editAccountModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content card card-signup">
            <div class="modal-headertext-center">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <i class="material-icons">clear</i>
                </button>
            </div>
            <div class="modal-body">
                <div class="">
                    <form id="loginForm" class="form" method="post" action="https://api.safirirental.com/userChangePassword/web/">
                        <p class="title">Login</p>
                        <div class="content">
                            <div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-fw fa-envelope"></i>
										</span>
                                <input type="text" id="old_password" value="" name="lg_username" class="form-control" placeholder="First Name" required>
                            </div>

                            <div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-fw fa-lock"></i>
										</span>
                                <input type="text" name="lg_password" placeholder="Last Name" class="form-control" required/>
                            </div>

                            <div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-fw fa-lock"></i>
										</span>
                                <input type="text" name="lg_password" placeholder="Phone Number" class="form-control" required/>
                            </div>

                            <div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-fw fa-lock"></i>
										</span>
                                <input type="text" name="lg_password" placeholder="Email address" class="form-control" required/>
                            </div>

                            <div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-fw fa-lock"></i>
										</span>
                                <input type="text" name="lg_password" placeholder="ID Number" class="form-control" required/>
                            </div>


                            <div class="checkbox text-center">
                                <button type="submit" class="btn btn-simple btn-primary btn-sm btn-round">UPDATE</button>
                    </form>

                </div>
            </div>
            <div class="footer text-center">
            </div>
            </form>
        </div>

    </div>
</div>
