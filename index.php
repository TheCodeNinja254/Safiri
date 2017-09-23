<?php
/**
 * Created by AfricaBeat.
 * User: AfricaBeat
 * Date: 8/22/17
 * Time: 2:52 PM
 *
 * Default Page
 */

include_once 'REST/africabeat.php';

//error_reporting(0);

$driver = new AfricaBeatDriver();
$path = @$_GET['path'];


if (!isset($path)) {
    
    include 'views/default.php';
    die();
    
} else {
    include 'views/default.php';
    die();
}