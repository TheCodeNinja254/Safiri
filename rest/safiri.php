<?php

/**
 * Host: ctfsmysqlvm.cloudapp.net
 * Username: mshaharaonline
 * Password:  codetechcloud
 */
/*SELECT
  music_masterlist.deezer_track_preview,
  music_masterlist.itunes_track_id,
  music_masterlist.deezer_track_id,
  music_masterlist.spotify_track_id,
  music_masterlist.youtube_vid,
  music_masterlist.itunes_track_id
FROM music_masterlist
WHERE music_masterlist.africabeat_song_id = "51d4fe4eb1e04a1db092e6e56f0b6a4b";*/

class AfricaBeatDriver
{

    private $DB_con;

    /**
     * AfricaBeatDriver constructor.
     */
    function __construct()
    {
        try {
            $DB_host = "ctfsmysqlvm.cloudapp.net";
            $DB_user = "mshaharaonline";
            $DB_pass = "codetechcloud";
            /*$DB_host = "localhost";
            $DB_user = "root";
            $DB_pass = "";*/
            $DB_name = "africabeat";
            $this->DB_con = new PDO("mysql:host={$DB_host};dbname={$DB_name}", $DB_user, $DB_pass);
            $this->DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

     /**
     * @param $current-week json
     * @param $one-step-back json
     *
     */

    public function weeklySongStats($current_week,$sb_current_week){

      try{
        $current_array = json_decode($current_week, true);
        $sb_current_week_array = json_decode($sb_current_week, true);

          foreach ($current_array as $key => $data_response) {
             foreach ($data_response as $array_key => $response){
                 if($response === false){
                     $row["response"] = false;
                     $row["error"] = "NO_DATA";
                     $jsonData["data"] = $row;

                     echo json_encode($jsonData);
                     die();
                 }
             }
          }

        for ($i=0; $i < sizeof($current_array['data']) ; $i++) { 
          for ($j=0; $j < sizeof($sb_current_week_array['data']) ; $j++) { 
            if ($current_array['data'][$i]['africabeat_song_id'] == $sb_current_week_array['data'][$j]['africabeat_song_id']) {

              $current_array['data'][$i]['last_week_position']=$sb_current_week_array['data'][$j]['number'];
              $current_postion=$current_array['data'][$i]['number'];
              $prev_position=$sb_current_week_array['data'][$j]['number'];
              $current_array['data'][$i]['status'] = ($current_postion > $prev_position )? '<i style="font-size:15px;" class="text-danger text-center fa fa-arrow-down" aria-hidden="true"></i>' : '<i style="font-size:15px;" class="text-center text-success fa fa-arrow-up" aria-hidden="true"></i>';

              $current_array['data'][$i]['status'] = ($current_postion == $prev_position )? '<i  style="font-size:15px;" class="text-center text-warning fa fa-stop-circle-o" aria-hidden="true"></i>' : $current_array['data'][$i]['status'];

              $current_array['data'][$i]['performance'] = ($current_postion > $prev_position )? '1' : '2';
              $current_array['data'][$i]['performance'] = ($current_postion == $prev_position )? '0' : $current_array['data'][$i]['performance'];

            }
          }
        }
        $allowed =  array('gif','png' ,'jpg', 'jpeg');
        for ($k=0; $k < sizeof($current_array['data']) ; $k++) {
          if (!array_key_exists('last_week_position', $current_array['data'][$k])) {
              $current_array['data'][$k]['last_week_position']='New';
              $current_array['data'][$k]['status']='<i style="font-size:15px;" class="text-center text-primary fa fa-plus-circle" aria-hidden="true"></i>';
          }
          if (array_key_exists('album_cover_art', $current_array['data'][$k])) {
            $ext=end(@explode('.', $current_array['data'][$k]['album_cover_art']));
            if (!in_array($ext,$allowed)) {
              $current_array['data'][$k]['album_cover_art']='/assets/uploads/chart-row-placeholder.jpg';
            }
            //THIS IMAGE IS REPLACED BY HARD CODE SINCE ITS ALWAYS SAYS UNAUTHPROZED FROM DEEZER, ADMIN HANDLE IT
            if ('http://e-cdn-images.deezer.com/images/cover/bdf38cbd6faabf4c8a020153c3977afc/250x250-000000-80-0-0.jpg'==$current_array['data'][$k]['album_cover_art']) {
              $current_array['data'][$k]['album_cover_art']='/assets/uploads/chart-row-placeholder.jpg';
            }
          }
        }
        echo json_encode($current_array);
      }catch(Exception $e){
        echo $e->getMessage();
      }
    }


    /**
     * @param $week_start_date
     * @param $week_end_date
     *
     * Charts, public viewable
     */
    public function get_africabeat_top_hundred($week_start_date, $week_end_date)
    {
        $jsonData = array();

        try {
            $stmt = $this->DB_con->prepare('SELECT COUNT(*) AS
                  plays,
                  music_masterlist.title,
                  artists.aka,
                  albums.album_cover_art,
                  music_masterlist.africabeat_song_id,
                  music_masterlist.deezer_track_preview,
                  music_masterlist.itunes_track_id,
                  music_masterlist.deezer_track_id,
                  music_masterlist.spotify_track_id,
                  music_masterlist.youtube_vid,
                  music_masterlist.itunes_track_id,
                  0 AS weeks_in_chart
            FROM radio_airplay_log, music_masterlist, artists, albums
            WHERE radio_airplay_log.timestamp_utc
                  BETWEEN :week_start_date AND :week_end_date
                  AND radio_airplay_log.acrid = music_masterlist.acrid
                  AND music_masterlist.africabeat_artist_id = artists.africabeat_artist_id
                  AND albums.africabeat_album_id = music_masterlist.africabeat_album_id
                  AND radio_airplay_log.play_type NOT IN ( 0 )
            GROUP BY radio_airplay_log.acrid
            ORDER BY plays DESC
            LIMIT 100');
            $stmt->bindParam(':week_start_date', $week_start_date);
            $stmt->bindParam(':week_end_date', $week_end_date);
            $stmt->execute();


            if (!$this->isChartsApproved($week_start_date, $week_end_date)) {
                if ($stmt->rowCount() > 0) {


                    $counter = 0;
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $counter++;


                        $jsonData["response"] = true;
                        $jsonData["week_end_date"] = $week_end_date;
                        $jsonData["week_start_date"] = $week_start_date;
                        $row["number"] = $counter;
                        $jsonData["data"][] = $row;
                    }

                } else {

                    $row["response"] = false;
                    $row["error"] = "NO_DATA";
                    $row["week_end_date"] = $week_end_date;
                    $row["week_start_date"] = $week_start_date;
                    $jsonData["data"] = $row;

                }
            } else {
                $row["response"] = false;
                $row["error"] = "NOT_APPROVED";
                $jsonData["data"] = $row;
            }

        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return json_encode($jsonData);
    }

//    public function get_previos_week_postion($week_start_date, $africabeat_song_id){
//       $new_week_start = date('Y-m-d', strtotime('-1 week', strtotime($week_start_date)));
//        $enw_week_end = $week_start_date;
//
//        try {
//            $stmt = $this->DB_con->prepare('SELECT COUNT(*) AS
//                  plays,
//                  music_masterlist.title,
//                  artists.aka,
//                  albums.album_cover_art,
//                  music_masterlist.africabeat_song_id,
//                  music_masterlist.deezer_track_preview,
//                  music_masterlist.itunes_track_id,
//                  music_masterlist.deezer_track_id,
//                  music_masterlist.spotify_track_id,
//                  music_masterlist.youtube_vid,
//                  music_masterlist.itunes_track_id
//            FROM radio_airplay_log, music_masterlist, artists, albums
//            WHERE radio_airplay_log.timestamp_utc
//                  BETWEEN :week_start_date AND :week_end_date
//                  AND radio_airplay_log.acrid = music_masterlist.acrid
//                  AND music_masterlist.africabeat_artist_id = artists.africabeat_artist_id
//                  AND albums.africabeat_album_id = music_masterlist.africabeat_album_id
//                  AND music_masterlist.africabeat_song_id = :africabeat_song_id
//                  AND radio_airplay_log.play_type NOT IN ( 0 )
//            GROUP BY radio_airplay_log.acrid
//            ORDER BY plays DESC
//            LIMIT 100');
//            $stmt->bindParam(':week_start_date', $new_week_start);
//            $stmt->bindParam(':week_end_date', $enw_week_end);
//            $stmt->bindParam(':africabeat_song_id', $africabeat_song_id);
//            $stmt->execute();
//
//
//                if ($stmt->rowCount() > 0) {
//
//
//                    $counter = 0;
//                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
//                        $counter++;
//
//                       return $row['']
//                    }
//
//                } else {
//
//
//
//                }
//
//        } catch (Exception $e) {
//            echo $e->getMessage();
//        }
//
//    }

    /**
     * @param $week_start
     * @param $week_end
     * @return bool
     */
    public function isChartsApproved($week_start, $week_end)
    {
        try {
            $stmt = $this->DB_con->prepare('SELECT status FROM charts WHERE week_start=:week_start AND week_end=:week_end');
            $stmt->bindParam(':week_start', $week_start);
            $stmt->bindParam(':week_end', $week_end);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $status = $stmt->fetch(PDO::FETCH_ASSOC)['status'];
                if ($status == 'approved') {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @param $week_start_date
     * @param $week_end_date
     *
     * Charts, public viewable
     */
    public function get_africabeat_top_fifty($week_start_date, $week_end_date)
    {
        $jsonData = array();
        try {
            $stmt = $this->DB_con->prepare('SELECT COUNT(*) AS
                  plays,
                  music_masterlist.title,
                  artists.aka,
                  albums.album_cover_art,
                  music_masterlist.africabeat_song_id,
                  music_masterlist.deezer_track_preview,
                  music_masterlist.itunes_track_id,
                  music_masterlist.deezer_track_id,
                  music_masterlist.spotify_track_id,
                  music_masterlist.youtube_vid,
                  music_masterlist.itunes_track_id,
                   0 AS weeks_in_chart
            FROM radio_airplay_log, music_masterlist, artists, albums
            WHERE radio_airplay_log.timestamp_utc
                  BETWEEN :week_start_date AND :week_end_date
                  AND radio_airplay_log.acrid = music_masterlist.acrid
                  AND music_masterlist.africabeat_artist_id = artists.africabeat_artist_id
                  AND albums.africabeat_album_id = music_masterlist.africabeat_album_id
                  AND radio_airplay_log.play_type NOT IN ( 0 )
            GROUP BY radio_airplay_log.acrid
            ORDER BY plays DESC
            LIMIT 50');
            $stmt->bindParam(':week_start_date', $week_start_date);
            $stmt->bindParam(':week_end_date', $week_end_date);
            $stmt->execute();
            if (!$this->isChartsApproved($week_start_date, $week_end_date)) {
                if ($stmt->rowCount() > 0) {

                    $counter = 0;
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $counter++;

                        $jsonData["response"] = true;
                        $row["number"] = $counter;
                        $jsonData["response"] = true;
                        $jsonData["data"][] = $row;
                    }

                } else {

                    $row["response"] = false;
                    $row["error"] = "NO_DATA";
                    $jsonData["data"] = $row;

                }
            } else {
                $row["response"] = false;
                $row["error"] = "NOT_APPROVED";
                $jsonData["data"] = $row;
            }

        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return json_encode($jsonData);
    }

    /**
     * @param $week_start_date
     * @param $week_end_date
     *
     * Charts, public viewable
     */
    public function get_africabeat_top_fifty_gospel($week_start_date, $week_end_date)
    {
        $jsonData = array();
        try {
            $stmt = $this->DB_con->prepare('SELECT COUNT(*) AS
                  plays,
                  music_masterlist.title,
                  artists.aka,
                  albums.album_cover_art,
                  music_masterlist.africabeat_song_id,
                  music_masterlist.deezer_track_preview,
                  music_masterlist.itunes_track_id,
                  music_masterlist.deezer_track_id,
                  music_masterlist.spotify_track_id,
                  music_masterlist.youtube_vid,
                  music_masterlist.itunes_track_id,
                  0 AS weeks_in_chart
            FROM radio_airplay_log, music_masterlist, artists, albums
            WHERE radio_airplay_log.timestamp_utc
                  BETWEEN :week_start_date AND :week_end_date
                  AND radio_airplay_log.acrid = music_masterlist.acrid
                  AND music_masterlist.africabeat_artist_id = artists.africabeat_artist_id
                  AND albums.africabeat_album_id = music_masterlist.africabeat_album_id
                  AND radio_airplay_log.play_type NOT IN ( 0 )
            GROUP BY radio_airplay_log.acrid
            ORDER BY plays DESC
            LIMIT 50');
            $stmt->bindParam(':week_start_date', $week_start_date);
            $stmt->bindParam(':week_end_date', $week_end_date);
            $stmt->execute();

            if (!$this->isChartsApproved($week_start_date, $week_end_date)) {
                if ($stmt->rowCount() > 0) {

                    $counter = 0;
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $counter++;

                        $jsonData["response"] = true;
                        $row["number"] = $counter;
                        $jsonData["response"] = true;
                        $jsonData["data"][] = $row;
                    }

                } else {

                    $row["response"] = false;
                    $row["error"] = "NO_DATA";
                    $jsonData["data"] = $row;

                }
            } else {
                $row["response"] = false;
                $row["error"] = "NOT_APPROVED";
                $jsonData["data"] = $row;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return json_encode($jsonData);
    }

    /**
     * @param $week_start_date
     * @param $week_end_date
     *
     * Returns Weeks data for the dashboard, authenticated
     */
    public function get_africabeat_weeks_data($week_start_date, $week_end_date)
    {
        $jsonData = array();
        try {
            $stmt = $this->DB_con->prepare('SELECT COUNT(*) AS
                      plays,
                      music_masterlist.title,
                      artists.aka,
                      albums.album_cover_art,
                      artists.artist_pic_url,
                      music_masterlist.africabeat_song_id,
                      music_masterlist.deezer_track_preview,
                      music_masterlist.itunes_track_id,
                      music_masterlist.deezer_track_id,
                      music_masterlist.spotify_track_id,
                      music_masterlist.youtube_vid,
                      music_masterlist.itunes_track_id,
                      music_masterlist.isrc,
                      music_masterlist.upc,
                      music_masterlist.acrid, 
                      music_masterlist.chart_id,
                      music_masterlist.africabeat_artist_id,
                      music_masterlist.africabeat_album_id,
                      music_masterlist.africabeat_genre_id,
                      music_masterlist.release_date,
                      artists.africabeat_artist_id,
                      albums.africabeat_album_id,
                      0 AS weeks_in_chart
                    FROM radio_airplay_log, music_masterlist, artists, albums
                    WHERE radio_airplay_log.timestamp_utc
                          BETWEEN :week_start_date AND :week_end_date
                          AND radio_airplay_log.acrid = music_masterlist.acrid
                          AND music_masterlist.africabeat_artist_id = artists.africabeat_artist_id
                          AND albums.africabeat_album_id = music_masterlist.africabeat_album_id
                          AND radio_airplay_log.play_type NOT IN ( 0 )
                    GROUP BY radio_airplay_log.acrid
                    ORDER BY plays DESC
                    LIMIT 0,50');
            $stmt->bindParam(':week_start_date', $week_start_date);
            $stmt->bindParam(':week_end_date', $week_end_date);
            $stmt->execute();

            if (!$this->isChartsApproved($week_start_date, $week_end_date)) {
                if ($stmt->rowCount() > 0) {

                    $counter = 0;
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $counter++;

                        $row["number"] = $counter;
                        $jsonData["response"] = true;
                        $jsonData["count"] = $stmt->rowCount();
                        $jsonData["data"][] = $row;
                    }

                } else {

                    $row["response"] = false;
                    $row["error"] = "NO_DATA";
                    $jsonData["data"] = $row;

                }
            } else {
                $row["response"] = false;
                $row["error"] = "NOT_APPROVED";
                $jsonData["data"] = $row;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        echo json_encode($jsonData);
    }

    /**
     * @param $week_start
     * @param $week_end
     * @param $chart
     */
    public function isChartsApprovedController($week_start, $week_end, $chart)
    {
        $jsonData = array();
        try {
            $stmt = $this->DB_con->prepare('SELECT status FROM charts WHERE week_start=:week_start AND week_end=:week_end');
            $stmt->bindParam(':week_start', $week_start);
            $stmt->bindParam(':week_end', $week_end);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $status = $stmt->fetch(PDO::FETCH_ASSOC)['status'];
                if ($status == 'approved') {

                    $row["response"] = true;
                    $row["error"] = "NO_DATA";
                    $jsonData["data"] = $row;

                } else {
                    $row["response"] = false;
                    $row["error"] = "NOT_APPROVED";
                    $jsonData["data"] = $row;
                }
            } else {
                $row["response"] = false;
                $row["error"] = "FATAL_ERROR";
                $jsonData["data"] = $row;
            }

        } catch (Exception $e) {
            echo $e->getMessage();
        }

        echo json_encode($jsonData);

    }

    /**
     * @return array
     */
    function getWeekStartEndDate()
    {
        $week_start = date('Y-m-d', strtotime('previous saturday'));
        $week_end = date('Y-m-d', strtotime("previous friday"));
        return array('week_start' => $week_start . ' 00:00:00', 'week_end' => $week_end . ' 23:59:59');
    }

    /**
     * @param $givenDate
     * @return array
     *
     */
    function getWeekStartEndDateGivenDate($givenDate)
    {
        try {
            $week_start = date('Y-m-d', strtotime('previous friday', strtotime($givenDate)));
            $week_end = date('Y-m-d', strtotime('previous friday', strtotime($givenDate)));
            $week_end = date('Y-m-d', strtotime($week_end) - 6 * 86400 + 7200);
            return array('week_end' => $week_start . ' 23:59:59', 'week_start' => $week_end . ' 00:00:00');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }



    /**
     * @param $acrid
     * @param $week_start_date
     * @param $week_end_date
     *
     * set rest record as all time jingle
     */
    public function is_jingle($acrid)
    {
        $jsonData = array();

        if (is_array($acrid)) {

            foreach ($acrid as $key => $acr_id) {

                self::update_jingle($acr_id);
            }

        } else {

            self::update_jingle($acrid);
        }

        $row["response"] = true;
        $row["array"] = $acrid;
        $jsonData["data"] = $row;

        echo json_encode($jsonData);
    }

    /**
     * @param $acrid
     * @param $week_start_date
     * @param $week_end_date
     *
     * set rest record as jingle for passed week
     */
    public function is_jingle_weekly($acrid, $week_start_date, $week_end_date)
    {
        $jsonData = array();

        if (is_array($acrid)) {

            foreach ($acrid as $key => $acr_id) {

                self::update_weekly_jingle($acr_id, $week_start_date, $week_end_date);
            }

        } else {

                self::update_weekly_jingle($acrid, $week_start_date, $week_end_date);
        }

        $row["response"] = true;
        $row["array"] = $acr_id;
        $row["week_start"] = $week_start_date;
        $row["week_end"] = $week_end_date;
        $jsonData["data"] = $row;

        echo json_encode($jsonData);
    }

    /**
     * @param $acrid
     */
    public function update_jingle($acrid)
    {
        try {
            $stmt = $this->DB_con->prepare('UPDATE radio_airplay_log
                                                SET radio_airplay_log.play_type = 0
                                                WHERE radio_airplay_log.acrid = :acrid');

            $stmt->bindParam(':acrid', $acrid);
            $stmt->execute();

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @param $acrid
     * @param $week_start_date
     * @param $week_end_date
     */
    public function update_weekly_jingle($acrid, $week_start_date, $week_end_date)
    {
        try {
            $stmt = $this->DB_con->prepare('UPDATE radio_airplay_log
                                            SET radio_airplay_log.play_type = 0
                                            WHERE radio_airplay_log.acrid = :acrid 
                                            AND radio_airplay_log.timestamp_utc
                                            BETWEEN :week_start_date AND :week_end_date');

            $stmt->bindParam(':acrid', $acrid);
            $stmt->bindParam(':week_start_date', $week_start_date);
            $stmt->bindParam(':week_end_date', $week_end_date);
            $stmt->execute();


        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }


    /**
     * @param $africabeat_album_id
     * @param $africabeat_art_url
     */
    public function update_album_art($africabeat_album_id, $africabeat_art_url)
    {
        $jsonData = array();

        try {
            $stmt = $this->DB_con->prepare('UPDATE albums
                                            SET albums.album_cover_art = :africabeat_art_url
                                            WHERE albums.africabeat_album_id = :africabeat_album_id');

            $stmt->bindParam(':africabeat_album_id', $africabeat_album_id);
            $stmt->bindParam(':africabeat_art_url', $africabeat_art_url);
            $stmt->execute();

            if($stmt->rowCount() > 0){

                $row["response"] = true;
                $jsonData["data"] = $row;

            }else{

                $row["response"] = false;
                $row["error"] = "UPDATE_FAILED";
                $jsonData["data"] = $row;
            }

        } catch (Exception $e) {
            echo $e->getMessage();
        }
        echo json_encode($jsonData);
    }


    /**
     * @param $africabeat_artist_id
     * @param $artist_pic_url
     */
    public function update_artist_pic($africabeat_artist_id, $artist_pic_url)
    {
        $jsonData = array();

        try {
            $stmt = $this->DB_con->prepare('UPDATE artists
                                            SET artists.artist_pic_url = :artist_pic_url
                                            WHERE artists.africabeat_artist_id = :africabeat_artist_id');

            $stmt->bindParam(':africabeat_artist_id', $africabeat_artist_id);
            $stmt->bindParam(':artist_pic_url', $artist_pic_url);
            $stmt->execute();

            if($stmt->rowCount() > 0){

                $row["response"] = true;
                $jsonData["data"] = $row;

            }else{

                $row["response"] = false;
                $row["error"] = "UPDATE_FAILED";
                $jsonData["data"] = $row;
            }

        } catch (Exception $e) {
            echo $e->getMessage();
        }
        echo json_encode($jsonData);
    }

    /**
     * @param $pass
     * @return string
     */
    public function hash_password($pass) {
        $salt = "@^3cu433saass3$%&^z£a8)*&()5";
        return sha1($pass . $salt);
    }


    /**
     * @param $newphotoname
     * @return bool
     */
    public function uploadImage($newphotoname){

        //File Upload Library
        $target_dir = "uploads/"; //uploads refers to the preferred folder
        $target_file = $target_dir . $newphotoname;
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

        // Check if image file is rest actual image or fake image

            $check = getimagesize($_FILES["post_image"]["tmp_name"]);


            if ($_FILES["post_image"]["size"] > 30000000 ) {


            return false;

            }

        // Allow certain file formats
        if($imageFileType != "jpg"
            && $imageFileType != "png"
            && $imageFileType != "jpeg"
            && $imageFileType != "gif"
            && $imageFileType != "JPG"
            && $imageFileType != "GIF"
            && $imageFileType != "JPEG" ) {

//                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;

            return false;

        }

        if($_FILES['post_image']['error']) {
            // handle the error

            echo $_FILES["post_image"]["error"];
        } else {
            // process

            if (move_uploaded_file($_FILES["post_image"]["tmp_name"], $target_file)) {

                return true;

            } else {

                echo $target_dir;
                echo "::::";
                echo $target_file;
                echo "::::";
                echo $_FILES['post_image']['temp_name'];
                echo "::::";
                echo "Sorry, there was an error uploading your file. Error => " . $_FILES["post_image"]["error"];
                ini_set('display_errors', 1);
                error_reporting(E_ALL);

                return false;
            }
        }
    }


    /**
     * @param $youtube_vid
     * @param $africabeat_song_id
     */
    public function update_youtube_id($youtube_vid, $africabeat_song_id)
    {
        $jsonData = array();

        try {
            $stmt = $this->DB_con->prepare('UPDATE africabeat.music_masterlist SET music_masterlist.youtube_vid = :youtube_vid WHERE music_masterlist.africabeat_song_id = :africabeat_song_id');

            $stmt->bindParam(':youtube_vid', $youtube_vid);
            $stmt->bindParam(':africabeat_song_id', $africabeat_song_id);
            $stmt->execute();

            if($stmt->rowCount() > 0){

                $row["response"] = true;
                $jsonData["data"] = $row;

            }else{

                $row["response"] = false;
                $row["error"] = "UPDATE_FAILED";
                $jsonData["data"] = $row;
            }

        } catch (Exception $e) {
            echo $e->getMessage();
        }
        echo json_encode($jsonData);
    }

    public function ab_auth_login($username, $password)
    {

//        ab_oauth_v1
        $jsonData = array();

        $hash_password = self::hash_password($password);

        if((bool)self::ab_auth_set_csk($username, "")){

            try {
                $stmt = $this->DB_con->prepare('SELECT user_id, 
                                                    username, 
                                                    email_address,
                                                    phone_no, 
                                                    f_name, 
                                                    m_name, 
                                                    l_name, 
                                                    access_level 
                                                    FROM users 
                                                    WHERE username = :username
                                                    AND password = :hash_password');

                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':hash_password', $hash_password);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {

                    $counter = 0;
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $counter++;

                        $current_session_key = self::ab_auth_generate_csk();

                        if((bool)self::ab_auth_set_csk($username, $current_session_key)){

                            $jsonData["response"] = true;
                            $row["current_session_key"] = $current_session_key;
                            $jsonData["data"] = $row;

                        }else{

                            $row["response"] = false;
                            $row["error"] = "AUTH_FAILED";
                            $row["extended_error"] = "CSK_SET_FAILED";
                            $row["ab_csk"] = null;
                            $jsonData["data"] = $row;
                        }
                    }

                } else {

                    $row["response"] = false;
                    $row["error"] = "AUTH_FAILED";
                    $row["current_session_key"] = null;
                    $jsonData["data"] = $row;

                }


            } catch (Exception $e) {
                $row["response"] = false;
                $row["error"] = "AUTH_FAILED";
                $row["extended_error"] = $e->getMessage();
                $row["current_session_key"] = null;
                $jsonData["data"] = $row;
            }
        }else{
            $row["response"] = false;
            $row["error"] = "AUTH_FAILED";
            $row["extended_error"] = "CSK_UNSET_FAILED";
            $row["current_session_key"] = null;
            $jsonData["data"] = $row;
        }

        echo json_encode($jsonData);
    }

    private function ab_auth_set_csk($username,$csk)
    {

        try {
            $stmt = $this->DB_con->prepare('UPDATE africabeat.users 
                                            SET users.current_session_key = :csk 
                                            WHERE users.username = :username');

            $stmt->bindParam(':csk', $csk);
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            if($stmt->rowCount() > 0){

                return true;

            }else{

                return false;
            }

        } catch (Exception $e) {

            return false;
        }

    }

    private function crypto_rand_secure($min, $max)
    {
        $range = $max - $min;
        if ($range < 1) return $min; // not so random...
        $log = ceil(log($range, 2));
        $bytes = (int) ($log / 8) + 1; // length in bytes
        $bits = (int) $log + 1; // length in bits
        $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd > $range);
        return $min + $rnd;
    }

    public function ab_auth_generate_csk(){

        $length = 69;
        $csk_prefix = "ab";
        $csk_microtime = round(microtime(true));
        $csk_rand = rand(10000000000,99999999999999);
        $csk_rand_key = "";

        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet.= "0123456789";
        $max = strlen($codeAlphabet); // edited

        for ($i=0; $i < $length; $i++) {
            $csk_rand_key .= $codeAlphabet[self::crypto_rand_secure(0, $max-1)];
        }

        //Finally
        define("CURRENT_SESSION_KEY", $csk_prefix."-".$csk_microtime."-".$csk_rand."-".$csk_rand_key);
        return CURRENT_SESSION_KEY;
    }

    /**
     * ab_method_oauth
     *
     * AfricaBeat API Authentication
     * in Beta
     */
    public function ab_method_oauth()
    {

        $jsonData = array();

        //        Getting token from URI
        $path = array_key_exists("method", $_REQUEST) ? $_REQUEST["method"] : null;
        $pathTrimmed = trim($path, '/');
        $pathTokens = explode('/', $pathTrimmed);
        $ab_method_access_token_from_url = $pathTokens[1];

//        Getting token from POST or GET
        if(isset($_REQUEST['ab_method_access_token']) && !empty($_REQUEST['ab_method_access_token'])){

            $ab_method_access_token = $_REQUEST['ab_method_access_token'];

        }elseif (isset($ab_method_access_token_from_url) && !empty($ab_method_access_token_from_url)){

            $ab_method_access_token = $ab_method_access_token_from_url;

        }

        if (!isset($ab_method_access_token) || empty($ab_method_access_token)) {
            $row["response"] = false;
            $row["error"] = "OAUTH_ERROR";
            $row["extended_error"] = "NO_AB_OAUTH_TOKEN";
            $jsonData["data"] = $row;

            echo json_encode($jsonData);
            die();
        }else{
            if((bool)self::ab_oauth_verify_csk($ab_method_access_token)){

                    if((bool)self::session_log_commit($ab_method_access_token)){

//                        echo "some happended";
                    }else{

                    }

            }else{
                $row["response"] = false;
                $row["error"] = "OAUTH_ERROR";
                $row["extended_error"] = "INVALID_AB_OAUTH_TOKEN";
                $jsonData["data"] = $row;

                echo json_encode($jsonData);
                die();
            }
        }
    }

    private function ab_oauth_verify_csk($current_session_key){

        try {
            $stmt = $this->DB_con->prepare('SELECT users.username 
                                            FROM africabeat.users 
                                            WHERE users.current_session_key = :current_session_key');

            $stmt->bindParam(':current_session_key', $current_session_key);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {

                return true;

            } else {

                return false;
            }


        } catch (Exception $e) {
            return false;
        }
    }

     private   function get_real_ip_address(){
            if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
            {
                $ip=$_SERVER['HTTP_CLIENT_IP'];
            }
            elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
            {
                $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
            }
            else
            {
                $ip=$_SERVER['REMOTE_ADDR'];
            }
            return $ip;
        }

     private  function get_method_accessed(){
            $path = array_key_exists("method", $_REQUEST) ? $_REQUEST["method"] : null;
            $pathTrimmed = trim($path, '/');
            $pathTokens = explode('/', $pathTrimmed);
            return $method = $pathTokens[0];
        }

      private  function get_method_access_time(){
            date_default_timezone_set('Africa/Nairobi');
            return $date = date("j  F Y  g.i rest", time());
        }




    private function get_logged_user($csk){

        try {
            $stmt = $this->DB_con->prepare('SELECT users.username 
                                            FROM africabeat.users 
                                            WHERE users.current_session_key = :current_session_key');

            $stmt->bindParam(':current_session_key', $csk);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                    return $row['username'];
                }

            } else {

                return false;
            }


        } catch (Exception $e) {
            return false;
        }
    }

    private function session_log_commit($csk){

        $device_id = "";
        $sample = "some value";
        $method_accessed = self::get_method_accessed();
        $ip_address = self::get_real_ip_address();
        $username = self::get_logged_user($csk);
        $time_accessed = self::get_method_access_time();

        try {
            $stmt = $this->DB_con->prepare('INSERT INTO session_logs 
                                          (method_accessed, 
                                          time_of_access, 
                                          ip_address, 
                                          device_id, 
                                          token, 
                                          username) 
                                          VALUES (
                                          :method_accessed,
                                          :time_of_access,
                                          :ip_address,
                                          :device_id,
                                          :token,
                                          :username
                                          )');

            $stmt->bindParam(':method_accessed', $method_accessed);
            $stmt->bindParam(':time_of_access', $time_accessed);
            $stmt->bindParam(':ip_address', $ip_address);
            $stmt->bindParam(':device_id', $device_id);
            $stmt->bindParam(':token', $csk);
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {

               return true;

            } else {

                return false;
            }


        } catch (Exception $e) {
            return false;
        }
    }


}

