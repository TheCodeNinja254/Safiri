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
<!DOCTYPE html>
<html class="perfect-scrollbar-on" lang="en"><head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo $host_name; ?>/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="<?php echo $host_name; ?>/assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Safiri</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
    <meta name="viewport" content="width=device-width">>
    <meta name="keywords" content="material dashboard, bootstrap material admin, bootstrap material dashboard, material design admin, material design, creative tim, html dashboard, html css dashboard, web dashboard, freebie, free bootstrap dashboard, css3 dashboard, bootstrap admin, bootstrap dashboard, frontend, responsive bootstrap dashboard">
    <meta name="description" content="Material Dashboard is a Free Material Bootstrap Admin with a fresh, new design inspired by Google's Material Design.">

    <!-- Bootstrap core CSS     -->
    <link href="<?php echo $host_name; ?>/assets/css/admin_css/bootstrap.css" rel="stylesheet">
    <!--  Material Dashboard CSS    -->
    <link href="<?php echo $host_name; ?>/assets/css/admin_css/material-dashboard.css" rel="stylesheet">
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="<?php echo $host_name; ?>/assets/css/admin_css/demo.css" rel="stylesheet">
    <!--     Fonts and icons     -->
    <link href="<?php echo $host_name; ?>/assets/css/font-awesome-4.6.3/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo $host_name; ?>/assets/css/admin_css/css.css" rel="styleshet" type="text/css">
    <script type="text/javascript" charset="UTF-8" src="<?php echo $host_name; ?>/assets/js/common.js"></script><script type="text/javascript" charset="UTF-8" src="Material%20Dashboard%20by%20Creative%20Tim_files/util.js"></script><script type="text/javascript" charset="UTF-8" src="Material%20Dashboard%20by%20Creative%20Tim_files/stats.js"></script></head>

