<?php

//error_reporting(0);

include_once 'safiri.php';
$driver = new SafiriRentalDriver();

/** @var Time Initialization $date */
date_default_timezone_set('Africa/Nairobi');
$date = date("j  F Y  g.i", time());



//To allow/Restrict cross domain RESTApi requests
header("Access-Control-Allow-Origin: https://safirirental.com");
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

if ($method === 'getApiKey') {

    $driver -> sf_auth_generate_csk();

}

if ($method === 'addSupplier') {

    $driver-> api_key_verifier();

    $user_type = "supplier";
    $f_name = array_key_exists("f_name", $_REQUEST) ? $_REQUEST["f_name"] : null;
    $m_name = array_key_exists("m_name", $_REQUEST) ? $_REQUEST["m_name"] : null;
    $l_name = array_key_exists("l_name", $_REQUEST) ? $_REQUEST["l_name"] : null;
    $national_id_num = array_key_exists("national_id_num", $_REQUEST) ? $_REQUEST["national_id_num"] : null;
    $postal_address = array_key_exists("postal_address", $_REQUEST) ? $_REQUEST["postal_address"] : null;
    $email_adddress = array_key_exists("email_address", $_REQUEST) ? $_REQUEST["email_address"] : null;
    $phone_num = array_key_exists("phone_number", $_REQUEST) ? $_REQUEST["phone_number"] : null;
    $date_of_registration = $date;
    $username = array_key_exists("username", $_REQUEST) ? $_REQUEST["username"] : null;
    $password = array_key_exists("password", $_REQUEST) ? $_REQUEST["password"] : null;
    $uri_copy_of_id = "00";
    
    
    $driver -> add_user($f_name, $m_name, $l_name, $national_id_num, $postal_address, $email_adddress, $phone_num, $date_of_registration, $username, $password, $user_type, $uri_copy_of_id);

}

if ($method === 'addCustomer') {

    $driver-> api_key_verifier();

    $user_type = "customer";
    $f_name = array_key_exists("f_name", $_REQUEST) ? $_REQUEST["f_name"] : null;
    $m_name = array_key_exists("m_name", $_REQUEST) ? $_REQUEST["m_name"] : null;
    $l_name = array_key_exists("l_name", $_REQUEST) ? $_REQUEST["l_name"] : null;
    $national_id_num = array_key_exists("national_id_num", $_REQUEST) ? $_REQUEST["national_id_num"] : null;
    $postal_address = array_key_exists("postal_address", $_REQUEST) ? $_REQUEST["postal_address"] : null;
    $email_adddress = array_key_exists("email_address", $_REQUEST) ? $_REQUEST["email_address"] : null;
    $phone_num = array_key_exists("phone_number", $_REQUEST) ? $_REQUEST["phone_number"] : null;
    $date_of_registration = $date;
    $username = array_key_exists("username", $_REQUEST) ? $_REQUEST["username"] : null;
    $password = array_key_exists("password", $_REQUEST) ? $_REQUEST["password"] : null;
    $uri_copy_of_id = "00";

    $driver->add_user($f_name, $m_name, $l_name, $national_id_num, $postal_address, $email_adddress, $phone_num, $date_of_registration, $username, $password, $user_type, $uri_copy_of_id);
}

if ($method === 'safiriOauth') {

    $driver-> api_key_verifier();

    $user_type = "customer";

    $username = array_key_exists("username", $_REQUEST) ? $_REQUEST["username"] : null;
    $password = array_key_exists("password", $_REQUEST) ? $_REQUEST["password"] : null;;


    $driver->sf_auth_login($username, $password);
}




