<?php

//error_reporting(0);

include_once 'safiri.php';
$driver = new SafiriRentalDriver();

/** @var Time Initialization $date */
date_default_timezone_set('Africa/Nairobi');
$date = date("j  F Y  g.i", time());


//To allow/Restrict cross domain RESTApi requests
$http_origin = $_SERVER['HTTP_ORIGIN'];

if ($http_origin == "https://www.safirirental.com" || $http_origin == "https://safirirental.com")
{
    header("Access-Control-Allow-Origin: $http_origin");
}
header("Access-Control-Allow-Methods: POST, GET, HEAD");
header("Access-Control-Max-Age: 86400");
header("Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7");
header('Content-Type: application/json');


//setcookie(name, value, expire, path, domain, secure, httponly);

//methodInit
$path = array_key_exists("method", $_REQUEST) ? $_REQUEST["method"] : null;
$pathTrimmed = trim($path, '/');
$pathTokens = explode('/', $pathTrimmed);

$method = $pathTokens[0];


if ($method === null || !isset($method) || $method === '') {
    $driver->error_reporting("METHOD_MISSING");
}

$driver-> api_key_verifier();


/**
 * SafiriRental API
 *
 * For the SafiriRental Public Portal
 * Made with by the Nerds at SafiriRental
 *
 * */

if ($method === 'getApiKey') {

    $driver->sf_auth_generate_csk();

}

if ($method === 'addSupplier') {


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


    $driver->add_user($f_name, $m_name, $l_name, $national_id_num, $postal_address, $email_adddress, $phone_num, $date_of_registration, $username, $password, $user_type, $uri_copy_of_id);

}

if ($method === 'addCustomer') {


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

    $username = array_key_exists("username", $_REQUEST) ? $_REQUEST["username"] : null;
    $password = array_key_exists("password", $_REQUEST) ? $_REQUEST["password"] : null;;


    $driver->sf_auth_login($username, $password);
}


if ($method === 'getLocations') {

    $driver->sf_get_locations();
}

if ($method === 'getPickUpPoints') {

    $location_code = array_key_exists("location_code", $_REQUEST) ? $_REQUEST["location_code"] : null;
    $driver->sf_get_pickup_points($location_code);
}

if ($method === 'getBodyTypes') {

    $driver->sf_get_body_types();
}

if ($method === 'getCars') {

    $pick_up_point = array_key_exists("pick_up_point", $_REQUEST) ? $_REQUEST["pick_up_point"] : null;
    $body_type = array_key_exists("body_type", $_REQUEST) ? $_REQUEST["body_type"] : null;

    $driver->sf_get_cars_per_pickup($pick_up_point, $body_type);
}

if ($method === 'addLocation') {

    $location_name = array_key_exists("location_name", $_REQUEST) ? $_REQUEST["location_name"] : null;

    $driver->add_location($location_name);
}

if ($method === 'addBodyType') {

    $type = array_key_exists("body_type", $_REQUEST) ? $_REQUEST["body_type"] : null;
    $body_type_placeholder = array_key_exists("body_type_placeholder", $_REQUEST) ? $_REQUEST["body_type_placeholder"] : null;

    $driver->add_body_types($type, $body_type_placeholder);
}

if ($method === 'addPickupPoint') {

    $location_code = array_key_exists("location_code", $_REQUEST) ? $_REQUEST["location_code"] : null;
    $pick_up_point = array_key_exists("pick_up_point", $_REQUEST) ? $_REQUEST["pick_up_point"] : null;

    $driver->add_pick_up_point($pick_up_point, $location_code);
}

if ($method === 'addCar') {
    
    $make = array_key_exists("make", $_REQUEST) ? $_REQUEST["make"] : null;
    $model = array_key_exists("model", $_REQUEST) ? $_REQUEST["model"] : null;
    $body_type = array_key_exists("body_type", $_REQUEST) ? $_REQUEST["body_type"] : null;
    $pick_up_point = array_key_exists("pick_up_point", $_REQUEST) ? $_REQUEST["pick_up_point"] : null;
    $hire_price_per_day = array_key_exists("hire_price_per_day", $_REQUEST) ? $_REQUEST["hire_price_per_day"] : null;
    $owner_username = "admin";

    $temp = explode(".", $_FILES["post_file"]["name"]);
    $newFileName = "safiri" . "-" . round(microtime(true)) . '.' . end($temp);

    $uri_log_book = "https://cdn.safirirental.com/files/" . $newFileName;

    $driver->uploadFile($newFileName);
    $driver->add_car($make, $model, $uri_log_book, $body_type, $hire_price_per_day, $owner_username, $pick_up_point);
}

if ($method === 'sfOAuthLogout') {

    $username = array_key_exists("username", $_REQUEST) ? $_REQUEST["username"] : null;
    $driver->sf_auth_logout($username);

}

if ($method === 'addCarMake') {

    $make = array_key_exists("make", $_REQUEST) ? $_REQUEST["make"] : null;
    $driver->add_make($make);

}

if ($method === 'getCarMake') {

    $driver->sf_get_car_make();

}


if ($method === 'getMyCars') {

//    $owner = $_SESSION['username'];
    $owner = 'admin';//for test
    $driver->sf_get_cars_per_owner($owner);
}

if ($method === 'getAllCars') {

    $driver->sf_get_all_cars();
}

if ($method === 'uploadCarPhotos') {

    $car_id = array_key_exists("car_id_from_list", $_REQUEST) ? $_REQUEST["car_id_from_list"] : null;
    $driver->upload_to_cdn($car_id);
}










