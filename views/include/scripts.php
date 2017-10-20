<?php
/**
 * Created by PhpStorm.
 * User: freddie
 * Date: 9/23/17
 * Time: 8:41 PM
 */

global $host;

$host =  $_SERVER['SERVER_NAME'];

if($host === 'localhost'){
    $host_name = "//localhost/safiri";
}else{
    $host_name = "";
}

?>

<!--   Core JS Files   -->


<script src="<?php echo $host_name; ?>/assets/js/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo $host_name; ?>/assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo $host_name; ?>/assets/js/material.min.js"></script>

<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="<?php echo $host_name; ?>/assets/js/nouislider.min.js" type="text/javascript"></script>

<!--  Plugin for the Datepicker, full documentation here: http://www.eyecon.ro/bootstrap-datepicker/ -->
<script src="<?php echo $host_name; ?>/assets/js/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="<?php echo $host_name; ?>/assets/js/bootstrap-notify.js" type="text/javascript"></script>
<script src="<?php echo $host_name; ?>/assets/js/toastr.min.js" type="text/javascript"></script>
<script src="<?php echo $host_name; ?>/assets/js/jasny-bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo $host_name; ?>/assets/js/safiri/myToast.js" type="text/javascript"></script>
<script src="<?php echo $host_name; ?>/assets/js/jquery.cookie.js" type="text/javascript"></script>
<script src="<?php echo $host_name; ?>/assets/js/safiri/safiri_custom.js" type="text/javascript"></script>

<!-- Control Center for Material Kit: activating the ripples, parallax effects, scripts from the example pages etc -->
<script src="<?php echo $host_name; ?>/assets/js/material-kit.js" type="text/javascript"></script>

<!--    Plugin For Google Maps   -->

