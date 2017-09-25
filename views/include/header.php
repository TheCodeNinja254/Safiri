<?php

global $host;

$host =  $_SERVER['SERVER_NAME'];

if($host === 'localhost'){
    $host_name = "//localhost/safiri";
}else{
    $host_name = "";
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo $host_name; ?>/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="<?php echo $host_name; ?>/assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Safiri</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

    <!--     Fonts and icons     -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" />
    <link rel="stylesheet" href="<?php echo $host_name; ?>/assets/css/font-awesome-4.6.3/css/font-awesome.min.css" />

    <!-- CSS Files -->
    <link href="<?php echo $host_name; ?>/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo $host_name; ?>/assets/css/material-kit.css" rel="stylesheet"/>

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="<?php echo $host_name; ?>/assets/css/style.css" rel="stylesheet" />

</head>
