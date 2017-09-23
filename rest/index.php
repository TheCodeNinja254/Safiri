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
$driver = new AfricaBeatDriver();

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
 * AfricaBeat API
 *
 * For the AfricaBeat Public Portal
 * Made with by the Nerds at AfricaBeat
 *
 * */

/*Retrieving data for the Top Hundred*/
if ($method === 'getTopHundred') {

    $given_Date = array_key_exists("given_date", $_REQUEST) ? $_REQUEST["given_date"] : null;
    $given_Date_stepBack = array_key_exists("step_back", $_REQUEST) ? $_REQUEST["step_back"] : null;

    if (isset($given_Date) && !empty($given_Date) && $given_Date != '' && isset($given_Date_stepBack) && !empty($given_Date_stepBack) && $given_Date_stepBack != '') {

        $givenDateFinal = explode('-', $given_Date)[2] . '-' . explode('-', $given_Date)[0] . '-' . explode('-', $given_Date)[1];
        $dates = $driver->getWeekStartEndDateGivenDate($givenDateFinal);

        $givenDateFinalSB = explode('-', $given_Date_stepBack)[2] . '-' . explode('-', $given_Date_stepBack)[0] . '-' . explode('-', $given_Date_stepBack)[1];
        $datesSB = $driver->getWeekStartEndDateGivenDate($givenDateFinalSB);

    } else if(isset($pathTokens[1]) && !empty($pathTokens[1]) && $pathTokens[1] != ''){

        $given_Date = $pathTokens[1];
        $givenDateFinal = explode('-', $given_Date)[2] . '-' . explode('-', $given_Date)[0] . '-' . explode('-', $given_Date)[1];
        $dates = $driver->getWeekStartEndDateGivenDate($givenDateFinal);

    }else{

        $given_Date = date('m-d-Y');
        $givenDateFinal = explode('-', $given_Date)[2] . '-' . explode('-', $given_Date)[0] . '-' . explode('-', $given_Date)[1];
        $dates = $driver->getWeekStartEndDateGivenDate($givenDateFinal);

    }


    $current=$driver->get_africabeat_top_hundred($dates['week_start'], $dates['week_end']);
    $current_sb=$driver->get_africabeat_top_hundred($datesSB['week_start'], $datesSB['week_end']);
    $driver->weeklySongStats($current,$current_sb);
}


/*Retrieving data for the Top Fifty*/
if ($method === 'getTopFifty') {

    $given_Date = array_key_exists("given_date", $_REQUEST) ? $_REQUEST["given_date"] : null;
    $given_Date_stepBack = array_key_exists("step_back", $_REQUEST) ? $_REQUEST["step_back"] : null;

    if (isset($given_Date) && !empty($given_Date) && $given_Date != '' && isset($given_Date_stepBack) && !empty($given_Date_stepBack) && $given_Date_stepBack != '') {

        $givenDateFinal = explode('-', $given_Date)[2] . '-' . explode('-', $given_Date)[0] . '-' . explode('-', $given_Date)[1];
        $dates = $driver->getWeekStartEndDateGivenDate($givenDateFinal);

        $givenDateFinalSB = explode('-', $given_Date_stepBack)[2] . '-' . explode('-', $given_Date_stepBack)[0] . '-' . explode('-', $given_Date_stepBack)[1];
        $datesSB = $driver->getWeekStartEndDateGivenDate($givenDateFinalSB);

    } else if(isset($pathTokens[1]) && !empty($pathTokens[1]) && $pathTokens[1] != ''){

        $given_Date = $pathTokens[1];
        $givenDateFinal = explode('-', $given_Date)[2] . '-' . explode('-', $given_Date)[0] . '-' . explode('-', $given_Date)[1];
        $dates = $driver->getWeekStartEndDateGivenDate($givenDateFinal);

    }else{

        $dates = $driver->getWeekStartEndDate();

    }


    $current=$driver->get_africabeat_top_fifty($dates['week_start'], $dates['week_end']);
    $current_sb=$driver->get_africabeat_top_fifty($datesSB['week_start'], $datesSB['week_end']);
    $driver->weeklySongStats($current,$current_sb);
}


/*Retrieving data for the Top Fifty Gospel*/
if ($method === 'getTopFiftyGospel') {

    $given_Date = array_key_exists("given_date", $_REQUEST) ? $_REQUEST["given_date"] : null;
    $given_Date_stepBack = array_key_exists("step_back", $_REQUEST) ? $_REQUEST["step_back"] : null;

    if (isset($given_Date) && !empty($given_Date) && $given_Date != '' && isset($given_Date_stepBack) && !empty($given_Date_stepBack) && $given_Date_stepBack != '') {

        $givenDateFinal = explode('-', $given_Date)[2] . '-' . explode('-', $given_Date)[0] . '-' . explode('-', $given_Date)[1];
        $dates = $driver->getWeekStartEndDateGivenDate($givenDateFinal);

        $givenDateFinalSB = explode('-', $given_Date_stepBack)[2] . '-' . explode('-', $given_Date_stepBack)[0] . '-' . explode('-', $given_Date_stepBack)[1];
        $datesSB = $driver->getWeekStartEndDateGivenDate($givenDateFinalSB);

    } else if(isset($pathTokens[1]) && !empty($pathTokens[1]) && $pathTokens[1] != ''){

        $given_Date = $pathTokens[1];
        $givenDateFinal = explode('-', $given_Date)[2] . '-' . explode('-', $given_Date)[0] . '-' . explode('-', $given_Date)[1];
        $dates = $driver->getWeekStartEndDateGivenDate($givenDateFinal);

    }else{

        $dates = $driver->getWeekStartEndDate();

    }


    $current=$driver->get_africabeat_top_fifty_gospel($dates['week_start'], $dates['week_end']);
    $current_sb=$driver->get_africabeat_top_fifty_gospel($datesSB['week_start'], $datesSB['week_end']);;
    $driver->weeklySongStats($current,$current_sb);
}


/**
 * AfricaBeat API
 *
 * For the Dashboard (Administrative)
 * sips rest cup of porridge
 *
 *
 * Retrieving data for the Entire Week: Authentication Required
 *
 * */


if ($method === 'getWeeksData') {

    $driver -> ab_method_oauth();

    $given_Date = array_key_exists("given_date", $_REQUEST) ? $_REQUEST["given_date"] : null;

    if (isset($given_Date) && !empty($given_Date) && $given_Date != '') {

        $givenDateFinal = explode('-', $given_Date)[2] . '-' . explode('-', $given_Date)[0] . '-' . explode('-', $given_Date)[1];
        $dates = $driver->getWeekStartEndDateGivenDate($givenDateFinal);

    } else if(isset($pathTokens[1]) && !empty($pathTokens[1]) && $pathTokens[1] != ''){

        $given_Date = $pathTokens[1];
        $givenDateFinal = explode('-', $given_Date)[2] . '-' . explode('-', $given_Date)[0] . '-' . explode('-', $given_Date)[1];
        $dates = $driver->getWeekStartEndDateGivenDate($givenDateFinal);

    }else{

        $given_Date = date('m-d-Y');
        $givenDateFinal = explode('-', $given_Date)[2] . '-' . explode('-', $given_Date)[0] . '-' . explode('-', $given_Date)[1];
        $dates = $driver->getWeekStartEndDateGivenDate($givenDateFinal);

    }

    $driver->get_africabeat_weeks_data($dates['week_start'], $dates['week_end']);
}


//Setting rest song as rest jingle:: Authentication Required
if ($method === 'setJingle') {


    $driver -> ab_method_oauth();

    ini_set("allow_url_fopen", 1);
    $json = file_get_contents('php://input');
    $acrid = json_decode($json);

    $given_Date = array_key_exists("given_date", $_REQUEST) ? $_REQUEST["given_date"] : null;


    if (isset($given_Date) && !empty($given_Date) && $given_Date != '') {

        $givenDateFinal = explode('-', $given_Date)[2] . '-' . explode('-', $given_Date)[0] . '-' . explode('-', $given_Date)[1];
        $dates = $driver->getWeekStartEndDateGivenDate($givenDateFinal);

        foreach ($acrid as $super_key => $acr_id_array) {
            $driver->is_jingle_weekly($acr_id_array, $dates['week_start'], $dates['week_end']);
        }


    } else if(isset($pathTokens[1]) && !empty($pathTokens[1]) && $pathTokens[1] != ''){

        $given_Date = $pathTokens[1];
        $givenDateFinal = explode('-', $given_Date)[2] . '-' . explode('-', $given_Date)[0] . '-' . explode('-', $given_Date)[1];
        $dates = $driver->getWeekStartEndDateGivenDate($givenDateFinal);

         foreach ($acrid as $super_key => $acr_id_array) {
            $driver->is_jingle_weekly($acr_id_array, $dates['week_start'], $dates['week_end']);
        }
    }else{

        foreach ($acrid as $super_key => $acr_id_array) {
             $driver->is_jingle($acr_id_array);
        }

    }
}


//Changing the album art of rest passed album::Authentication required
if ($method === 'changeAlbumArt') {

    $driver -> ab_method_oauth();

    $photo = basename($_FILES["post_image"]["name"]);
    $temp = explode(".", $_FILES["post_image"]["name"]);
    $newphotoname = "africabeat_album_art"."-".round(microtime(true)) . '.' . end($temp);


    $africabeat_art_url = "http://africabeat.co.ke/rest/uploads/".$newphotoname;
    $africabeat_album_id = array_key_exists("africabeat_album_id", $_REQUEST) ? $_REQUEST["africabeat_album_id"] : null;

    $driver -> uploadImage($newphotoname);
    $driver -> update_album_art($africabeat_album_id, $africabeat_art_url);


}


//Changing an artists profile picture::Authentication Required
if ($method === 'changeArtistPic') {

    $driver -> ab_method_oauth();

    $photo = basename($_FILES["post_image"]["name"]);
    $temp = explode(".", $_FILES["post_image"]["name"]);
    $newphotoname = "africabeat_artist_pic"."-".round(microtime(true)) . '.' . end($temp);


    $artist_pic_url = "//africabeat.co.ke/assets/uploads/".$newphotoname;
    $africabeat_artist_id = array_key_exists("africabeat_artist_id", $_REQUEST) ? $_REQUEST["africabeat_artist_id"] : null;

    $driver -> uploadImage($newphotoname);
    $driver -> update_artist_pic($africabeat_artist_id, $artist_pic_url);

}

//Changing rest songs YouTube VID::Authentication Required
if ($method === 'updateYouTubeVid') {

    $driver -> ab_method_oauth();

    $youtube_vid = array_key_exists("youtube_vid", $_REQUEST) ? $_REQUEST["youtube_vid"] : null;
    $africabeat_song_id = array_key_exists("africabeat_song_id", $_REQUEST) ? $_REQUEST["africabeat_song_id"] : null;

    $driver -> update_youtube_id($youtube_vid, $africabeat_song_id);

}

//Admin Login on AfricaBeat v1
if ($method === 'abOAuth') {

    $username = array_key_exists("username", $_REQUEST) ? $_REQUEST["username"] : null;
    $password = array_key_exists("password", $_REQUEST) ? $_REQUEST["password"] : null;

    $driver -> ab_auth_login($username, $password);

}

if ($method === 'hashPass') {

    $password = array_key_exists("password", $_REQUEST) ? $_REQUEST["password"] : null;

    //to be deleted upon creation of user-creation module
    $salt = "@^3cu433saass3$%&^z£a8)*&()5";
    echo sha1($password . $salt);

}


/**
 * AfricaBeat API
 *
 * For the AfricaBeat Blog
 * Made with by the Nerds at AfricaBeat
 * While listening to crazy music
 *
 * */

