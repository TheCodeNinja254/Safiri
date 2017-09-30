<?php
/**
 * Created by PhpStorm.
 * User: Greats
 * Date: 9/23/2017
 * Time: 10:18 AM
 */
?>
<footer class="footer ">
    <div class="container">
        <nav class="pull-left sharing-area">
            <ul>
                <li>
                    SAFIRI © <script>document.write(new Date().getFullYear());</script>
                </li>
                <li>
                    <a href="http://www.creative-tim.com">
                        PRIVACY
                    </a>
                </li>
                <li>
                    <a href="http://presentation.creative-tim.com">
                        TERMS
                    </a>
                </li>
                <li>
                    <a href="http://blog.creative-tim.com">
                        CAREERS
                    </a>
                </li>
                <li>
                    <a href="#">
                        ABOUT US
                    </a>
                </li>
                <li>
                    <a href="#" >
                        CONTACT
                    </a>
                </li>
            </ul>
        </nav>
        <div class=" pull-right sharing-area">

            <button href="#" class="btn btn-twitter btn-sm btn-round ">
                <i class="fa fa-twitter text-center"></i>
            </button>

            <button href="#" class="btn btn-facebook btn-sm btn-round">
                <i class="fa fa-facebook-square"></i>
            </button>
        </div>
</footer>
</div>

<!-- Sart Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <i class="material-icons">clear</i>
                </button>
                <h4 class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body">
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth. Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-simple">Nice Button</button>
                <button type="button" class="btn btn-danger btn-simple" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!--  End Modal -->

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
											<i class="material-icons">email</i>
										</span>
                                <input type="text" name="lg_username" class="form-control" placeholder="Username...">
                            </div>

                            <div class="input-group">
										<span class="input-group-addon">
											<i class="material-icons">lock_outline</i>
										</span>
                                <input type="password" name="lg_password" placeholder="Password..." class="form-control" />
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
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default btn-simple">Nice Button</button>
        <button type="button" class="btn btn-danger btn-simple" data-dismiss="modal">Close</button>
    </div>
</div>

<!--   Core JS Files   -->


