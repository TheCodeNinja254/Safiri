<?php
/**
 * Created by AfricaBeat.
 * User: AfricaBeat
 * Date: 8/22/17
 * Time: 2:52 PM
 *
 * Default Page
 */

include_once 'rest/safiri.php';

error_reporting(0);

$driver = new SafiriRentalDriver();
//$path = @$_GET['path'];

$path = array_key_exists("path", $_REQUEST) ? $_REQUEST["path"] : null;
$pathTrimmed = trim($path, '/');
$pathTokens = explode('/', $pathTrimmed);

$base = $pathTokens[0];

if (!isset($path)) {
    
    include 'views/home.php';
    die();
}

//Home Parser
if($base === "home"){
    if($pathTokens[1] === 'rent'){
        include 'views/rent.php';
    }else if($pathTokens[1] === 'about'){
        include 'views/about.php';
    }else if($pathTokens[1] === 'careers'){
        include 'views/career.php';
    }else if($pathTokens[1] === 'contact'){
        include 'views/contact.php';
    }else if($pathTokens[1] === 'home'){
        include 'views/home.php';
    }else{
        include 'views/home.php';
    }

    die();
}

//Admin Parser
if($base === "admin"){
    if($pathTokens[2] === 'home') {
        include 'views/admin/index.php';
    }else if($pathTokens[2] === 'cars') {
        include 'views/admin/cars.php';
    }else if($pathTokens[2] === 'customers') {
        include 'views/admin/customers.php';
    }else if($pathTokens[2] === 'owners') {
        include 'views/admin/owners.php';
    }else{
        include 'views/admin/index.php';
    }

    die();
}

//Customer Parser
if($base === "customer"){
    if($pathTokens[2] === 'cars') {
        include 'views/customer/cars.php';
    }else if($pathTokens[2] === 'customers') {
        include 'views/customer/customers.php';
    }else if($pathTokens[2] === 'id-upload') {
        include 'views/customer/id.php';
    }else if($pathTokens[2] === 'owners') {
        include 'views/customer/id.php';
    }else if($pathTokens[2] === 'photo-upload') {
        include 'views/customer/photos.php';
    }else{
        include 'views/customer/index.php';
    }

    die();
}

//Base Cleaner
if($base != "home" || $base != "admin" || $base != "customer"){
    include_once "views/404.php";
}