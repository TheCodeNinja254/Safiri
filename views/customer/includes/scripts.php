<?php
include "modals.php";

global $host;

$host =  $_SERVER['SERVER_NAME'];

if($host === 'localhost'){
    $host_name = "//localhost/safiri";
}else{
    $host_name = "";
}

?>
<script src="<?php echo $host_name; ?>/assets/js/jquery-3.js" type="text/javascript"></script>
<script src="<?php echo $host_name; ?>/assets/js/bootstrap.js" type="text/javascript"></script>
<script src="<?php echo $host_name; ?>/assets/js/material.js" type="text/javascript"></script>
<!--  Charts Plugin -->
<!--<script src="--><?php //echo $host_name; ?><!--/assets/js/chartist.js"></script>-->

<!--  Dynamic Elements plugin -->
<script src="<?php echo $host_name; ?>/assets/js/arrive.js"></script>
<!--  Sharrre Plugin -->
<!--<script src="--><?php //echo $host_name; ?><!--/assets/js/jquery.js"></script>-->
<!--  PerfectScrollbar Library -->
<!--<script src="--><?php //echo $host_name; ?><!--/assets/js/perfect-scrollbar.js"></script>-->
<!--  Notifications Plugin    -->
<script src="<?php echo $host_name; ?>/assets/js/bootstrap-notify.js"></script>
<script src="<?php echo $host_name; ?>/assets/js/jasny-bootstrap.min.js" type="text/javascript"></script>
<!-- Material Dashboard javascript methods -->
<script src="<?php echo $host_name; ?>/assets/js/material-dashboard.js"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<!--<script src="--><?php //echo $host_name; ?><!--/assets/js/demo.js"></script>-->
<!-- Select! -->
<script src="<?php echo $host_name; ?>/assets/js/bootstrap-select.min.js"></script>
<script src="<?php echo $host_name; ?>/assets/js/jquery.cookie.js"></script>
<!-- File Upload! -->
<!--<script src="--><?php //echo $host_name; ?><!--/assets/js/jasny-bootstrap.min.js"></script>-->
<script src="<?php echo $host_name; ?>/assets/FreddieDataTables/datatables.js"></script>
<script src="<?php echo $host_name; ?>/assets/js/safiri/safiri_custom.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

        // Javascript method's body can be found in assets/js/demos.js
//        demo.initDashboardPageCharts();

    });
</script>
<script type="text/javascript">

    $().ready(function(){
        // the body of this function is in assets/material-kit.js
        materialKit.initSliders();
        window_width = $(window).width();

        if (window_width >= 992){
            big_image = $('.wrapper > .header');

            $(window).on('scroll', materialKitDemo.checkScrollForParallax);
        }

    });
</script>

