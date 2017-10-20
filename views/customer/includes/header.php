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
<html class="" lang="en" ><head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo $host_name; ?>/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="<?php echo $host_name; ?>/assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Safiri</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
    <meta name="viewport" content="width=device-width">
    <!-- Canonical SEO -->
    <link rel="canonical" href="https://safirirental.com/">
    <!--  Social tags      -->
    <meta name="keywords" content="Car Hire Services">
    <meta name="description" content="Car Hire Services">

    <!-- Bootstrap core CSS     -->
    <link href="<?php echo $host_name; ?>/assets/css/customer_css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo $host_name; ?>/assets/css/customer_css/bootstrap-select.min.css" rel="stylesheet">
    <!--  Material Dashboard CSS    -->
    <link href="<?php echo $host_name; ?>/assets/css/customer_css/material-dashboard.css" rel="stylesheet">
    <!--  Style & Select    -->
    <link href="<?php echo $host_name; ?>/assets/css/customer_css/demo.css" rel="stylesheet">
    <link href="<?php echo $host_name; ?>/assets/css/customer_css/bootstrap-select.min.css" rel="stylesheet">

    <!--     Fonts and icons     -->
    <link href="<?php echo $host_name; ?>/assets/css/font-awesome-4.6.3/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo $host_name; ?>/assets/css/customer_css/css.css" rel="styleshet" type="text/css">
    <link href="<?php echo $host_name; ?>/assets/FreddieDataTables/datatables.css" rel="styleshet" type="text/css">
<style>
    html{
        height: 100% !important;
    }
</style>
    </head>


