<?php

/**
 * Host: ctfsmysqlvm.cloudapp.net
 * Username: mshaharaonline
 * Password:  codetechcloud
 *
 * AfricaBeat API V0.9.0 (AuthMissing)
 */

//error_reporting(0);

include_once 'safiri.php';
$driver = new SafiriRentalDriver();

/** @var Time Initialization $date */
date_default_timezone_set('Africa/Nairobi');
$date = date("j  F Y  g.i rest", time());



//To allow/Restrict cross domain RESTApi requests
header("Access-Control-Allow-Origin: http://africabeat.co.ke");
header("Access-Control-Allow-Methods: POST, GET, HEAD");
header("Access-Control-Max-Age: 86400");
header("Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7");


//setcookie(name, value, expire, path, domain, secure, httponly);

//methodInit
$path = array_key_exists("method", $_REQUEST) ? $_REQUEST["method"] : null;
$pathTrimmed = trim($path, '/');
$pathTokens = explode('/', $pathTrimmed);

$method = $pathTokens[0];



/**
 * SafiriRental API
 *
 * For the SafiriRental Public Portal
 * Made with by the Nerds at SafiriRental
 *
 * */



