<?php


class SafiriRentalDriver
{

    private $DB_con;

    /**
     * SafiriRentalDriver constructor.
     */
    function __construct()
    {
        try {
            $DB_host = "localhost";
            $DB_user = "safirire_safiri";
            $DB_pass = "safiri@2017";
            $DB_name = "safirire_safiri";
            $this->DB_con = new PDO("mysql:host={$DB_host};dbname={$DB_name}", $DB_user, $DB_pass);
            $this->DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
//            echo $e->getMessage();
        }
    }

    public function sf_method_oauth()
    {

        $jsonData = array();

        //        Getting token from URI
        $path = array_key_exists("method", $_REQUEST) ? $_REQUEST["method"] : null;
        $pathTrimmed = trim($path, '/');
        $pathTokens = explode('/', $pathTrimmed);
        $current_session_key_from_url = $pathTokens[2];

//        Getting token from POST or GET
        if(isset($_REQUEST['current_session_key']) && !empty($_REQUEST['current_session_key'])){

            $current_session_key = $_REQUEST['current_session_key'];

        }elseif (isset($current_session_key_from_url) && !empty($current_session_key_from_url)){

            $current_session_key = $current_session_key_from_url;

        }

        if (!isset($current_session_key) || empty($current_session_key)) {
            $row["response"] = false;
            $row["error"] = "OAUTH_ERROR";
            $row["extended_error"] = "NO_SF_OAUTH_TOKEN";
            $jsonData["data"] = $row;

            echo json_encode($jsonData);
            die();
        }else{
            if($current_session_key === "0000"){

                $row["response"] = false;
                $row["error"] = "OAUTH_ERROR";
                $row["extended_error"] = "INVALID_SF_OAUTH_TOKEN";
                $jsonData["data"] = $row;

                echo json_encode($jsonData);
                die();

            }else if((bool)self::ab_oauth_verify_csk($current_session_key)){

                if((bool)self::session_log_commit($current_session_key)){

//                        echo "some happended";
                }else{

                }

            }else{
                $row["response"] = false;
                $row["error"] = "OAUTH_ERROR";
                $row["extended_error"] = "INVALID_SF_OAUTH_TOKEN";
                $jsonData["data"] = $row;

                echo json_encode($jsonData);
                die();
            }
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
        return $date = date("j  F Y  g.i a", time());
    }

    
    private function get_logged_user($csk){

        try {
            $stmt = $this->DB_con->prepare('SELECT users.username 
                                            FROM safirire_safiri.users 
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
            $stmt = $this->DB_con->prepare('INSERT INTO safirire_safiri.session_logs 
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


    private function ab_oauth_verify_csk($current_session_key){

        try {
            $stmt = $this->DB_con->prepare('SELECT users.username 
                                            FROM safirire_safiri.users 
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

    public function double_login_prevention($csk){

        $jsonData = array();

        if((bool)self::ab_oauth_verify_csk($csk)){
            $row["response"] = true;
            $jsonData["data"] = $row;
        }else{
            $row["response"] = false;
            $row["error"] = "DOUBLE_LOGIN";
            $row["extended_error"] = "OTHER_COMPUTER_LOGGED_IN";
            $jsonData["data"] = $row;
        }

        echo json_encode($jsonData);
    }


    public function api_key_verifier(){
        //Getting API KEY FROM URL

        $path = array_key_exists("method", $_REQUEST) ? $_REQUEST["method"] : null;
        $pathTrimmed = trim($path, '/');
        $pathTokens = explode('/', $pathTrimmed);
        $api_key = $pathTokens[1];

        if(isset($api_key) && !empty($api_key)){


            if($api_key === "web"){
//                continue
            }else if((bool)self::api_key_get_owner($api_key)){
//                continue
            }else{
                $row["response"] = false;
                $row["error"] = "API_OAUTH_ERROR";
                $row["extended_error"] = "INVALID_API_KEY";
                $jsonData["data"] = $row;

                echo json_encode($jsonData);
                die();
            }
        }else{
            $row["response"] = false;
            $row["error"] = "API_OAUTH_ERROR";
            $row["extended_error"] = "MISSING_API_KEY";
            $jsonData["data"] = $row;

            echo json_encode($jsonData);
            die();
        }
    }

    private function api_key_get_owner($api_key){
        try {
            $stmt = $this->DB_con->prepare('SELECT api_key_owner
                                            FROM safirire_safiri.api_keys
                                            WHERE api_keys.api_key = :passed_api_key');

            $stmt->bindParam(':passed_api_key', $api_key);
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

    /**
     * @param $f_name
     * @param $m_name
     * @param $l_name
     * @param $national_id_num
     * @param $postal_address
     * @param $email_adddress
     * @param $phone_num
     * @param $date_of_registration
     * @param $username
     * @param $password
     * @param $user_type
     * @param $uri_copy_of_id
     */
    public function add_user($f_name, $m_name, $l_name, $national_id_num, $postal_address, $email_adddress, $phone_num, $date_of_registration, $username, $password, $user_type, $uri_copy_of_id){
        $jsonData = array();

        //Statics
        $status = "unverified";
        $access_level = 1;
        $hash_password = self::hash_password($password);

        try {
            $stmt = $this->DB_con->prepare('INSERT INTO safirire_safiri.users (
                                                  f_name, 
                                                  m_name, 
                                                  l_name, 
                                                  national_id_num, 
                                                  postal_address, 
                                                  email_adddress, 
                                                  phone_num, 
                                                  date_of_registration, 
                                                  username, 
                                                  password, 
                                                  access_level, 
                                                  user_type, 
                                                  uri_copy_of_id, 
                                                  status)
                                          VALUES (
                                                  :f_name, 
                                                  :m_name, 
                                                  :l_name, 
                                                  :national_id_num, 
                                                  :postal_address, 
                                                  :email_adddress, 
                                                  :phone_num, 
                                                  :date_of_registration, 
                                                  :username, 
                                                  :password, 
                                                  :access_level, 
                                                  :user_type, 
                                                  :uri_copy_of_id, 
                                                  :status
                                          )');

            $stmt->bindParam(':f_name', $f_name);
            $stmt->bindParam(':m_name', $m_name);
            $stmt->bindParam(':l_name', $l_name);
            $stmt->bindParam(':national_id_num', $national_id_num);
            $stmt->bindParam(':postal_address', $postal_address);
            $stmt->bindParam(':date_of_registration', $date_of_registration);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':phone_num', $phone_num);
            $stmt->bindParam(':email_adddress', $email_adddress);
            $stmt->bindParam(':password', $hash_password);
            $stmt->bindParam(':access_level', $access_level);
            $stmt->bindParam(':user_type', $user_type);
            $stmt->bindParam(':user_type', $user_type);
            $stmt->bindParam(':uri_copy_of_id', $uri_copy_of_id);
            $stmt->bindParam(':status', $status);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {

                $row["response"] = true;
                $jsonData["data"] = $row;

            } else {

                $row["response"] = false;
                $row["error"] = "UPDATE_FAILED";
                $jsonData["data"] = $row;
            }


        } catch (Exception $e) {
            $row["response"] = false;
            $row["error"] = $e->getMessage();
            $jsonData["data"] = $row;
        }
        echo json_encode($jsonData);
    }

    /**
     * @param $pass
     * @return string
     */
    public function hash_password($pass) {
        $salt = "@^sas8876&997hJH&^bjj%&^z£a8)*&()5";
        return sha1($pass . $salt);
    }

    /**
     * @param $username
     * @param $password
     */
    public function sf_auth_login($username, $password)
    {

//       sf_auth
        $jsonData = array();

        $hash_password = self::hash_password($password);
        self::sf_auth_set_csk($username, "0000");

        try {
            $stmt = $this->DB_con->prepare('SELECT id, f_name, m_name, l_name, postal_address, email_adddress, username, user_type, national_id_num, phone_num, date_of_registration, uri_copy_of_id
                                                    FROM safirire_safiri.users 
                                                    WHERE username = :username
                                                    OR email_adddress = :username
                                                    OR phone_num = :username
                                                    OR national_id_num = :username
                                                    AND password = :hash_password');

            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':hash_password', $hash_password);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {

                $counter = 0;
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $counter++;

                    $current_session_key = self::sf_auth_generate_csk();
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['phone_num'] = $row['phone_num'];
                    $_SESSION['email_address'] = $row['email_address'];
                    $_SESSION['csk'] = $current_session_key;
                    setcookie("username", $username, 86400, "/", "htts://safirirental.com", "httpsonly");
                    setcookie("csk", $current_session_key, 86400, "/", "htts://safirirental.com", "httpsonly");

                    $csk_set_username = $row['username'];
                    if((bool)self::sf_auth_set_csk($csk_set_username, $current_session_key)){

                        $jsonData["response"] = true;
                        $row["current_session_key"] = $current_session_key;
                        $jsonData["data"] = $row;

                    }else{

                        $jsonData["response"] = false;
                        $jsonData["status"] = 403;
                        $row["error"] = "AUTH_FAILED";
                        $row["extended_error"] = "CSK_SET_FAILED";
                        $row["current_session_key"] = null;
                        $jsonData["data"] = $row;
                    }
                }

            } else {

                $jsonData["response"] = false;
                $jsonData["status"] = 403;
                $row["error"] = "AUTH_FAILED";
                $row["current_session_key"] = null;
                $jsonData["data"] = $row;

            }


        } catch (Exception $e) {
            $jsonData["response"] = false;
            $jsonData["status"] = 500;
            $row["error"] = "AUTH_FAILED";
            $row["extended_error"] = $e->getMessage();
            $row["current_session_key"] = null;
            $jsonData["data"] = $row;
        }

        echo json_encode($jsonData);
    }

    private function sf_auth_set_csk($username,$csk)
    {

        try {
            $stmt = $this->DB_con->prepare('UPDATE safirire_safiri.users 
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

    public function sf_auth_generate_csk(){

        $length_one = 12;
        $length_two = 12;
        $csk_prefix = "SAFIRI";
        $csk_microtime = round(microtime(true));
        $csk_rand = rand(10000000000,99999999999999);
        $csk_rand_key_one = "";
        $csk_rand_key_two = "";

        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet.= "0123456789";
        $max = strlen($codeAlphabet); // edited

        for ($i=0; $i < $length_one; $i++) {
            $csk_rand_key_one .= $codeAlphabet[self::crypto_rand_secure(0, $max-1)];
        }

        for ($i=0; $i < $length_two; $i++) {
            $csk_rand_key_two .= $codeAlphabet[self::crypto_rand_secure(0, $max-1)];
        }

        //Finally
        define("CSK", $csk_prefix."-".$csk_microtime."-".$csk_rand."-".$csk_rand_key_one."-".$csk_rand_key_two);
        return CSK;
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

    public function sf_get_locations()
    {

        $jsonData = array();

        try {
            $stmt = $this->DB_con->prepare('SELECT *
                                                    FROM safirire_safiri.location 
                                                    ORDER BY id DESC');

            $stmt->execute();

            if ($stmt->rowCount() > 0) {

                $counter = 0;
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $counter++;


                        $jsonData["response"] = true;
                        $jsonData["status"] = 200;
                        $jsonData["data"][] = $row;

                }

            } else {

                $jsonData["response"] = false;
                $jsonData["status"] = 403;
                $row["error"] = "FAILED";
                $jsonData["data"] = $row;

            }


        } catch (Exception $e) {
            $jsonData["response"] = false;
            $row["error"] = "AUTH_FAILED";
            $row["extended_error"] = $e->getMessage();
            $jsonData["status"] = 500;
            $jsonData["data"] = $row;
        }

        echo json_encode($jsonData);
    }

    public function sf_get_car_make()
    {

        $jsonData = array();

        try {
            $stmt = $this->DB_con->prepare('SELECT *
                                                    FROM safirire_safiri.make 
                                                    ORDER BY make_id DESC');

            $stmt->execute();

            if ($stmt->rowCount() > 0) {

                $counter = 0;
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $counter++;


                    $jsonData["response"] = true;
                    $jsonData["status"] = 200;
                    $jsonData["data"][] = $row;

                }

            } else {

                $jsonData["response"] = false;
                $jsonData["status"] = 403;
                $row["error"] = "FAILED";
                $jsonData["data"] = $row;

            }


        } catch (Exception $e) {
            $jsonData["response"] = false;
            $row["error"] = "AUTH_FAILED";
            $row["extended_error"] = $e->getMessage();
            $jsonData["status"] = 500;
            $jsonData["data"] = $row;
        }

        echo json_encode($jsonData);
    }

    public function sf_get_car_pictures($car_id)
    {

        $jsonData = array();

        try {
            $stmt = $this->DB_con->prepare('SELECT *
                                                    FROM safirire_safiri.car_pictures 
                                                    WHERE car_id = :car_id
                                                    ORDER BY pic_id DESC');

            $stmt-> bindParam(":car_id", $car_id);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {

                $counter = 0;
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $counter++;

                    $jsonData[] = $row;

                }

            } else {

                $row["result"] = "No Pictures Uploaded";
                $jsonData["pictures"][] = $row;

            }


        } catch (Exception $e) {
            $row["result"] = "No Pictures Uploaded";
            $jsonData["pictures"][] = $row;
        }

        return $jsonData;
    }


    public function sf_get_pickup_points($location_code)
    {

        $jsonData = array();

        try {
            $stmt = $this->DB_con->prepare('SELECT *
                                                    FROM safirire_safiri.pick_up_points
                                                    WHERE location_code = :location_code
                                                    ORDER BY pick_up_point_id DESC');

            $stmt->bindParam(':location_code', $location_code);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {

                $counter = 0;
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $counter++;


                    $jsonData["response"] = true;
                    $jsonData["status"] = 200;
                    $jsonData["data"][] = $row;

                }

            } else {

                $jsonData["response"] = false;
                $jsonData["status"] = 403;
                $row["error"] = "FAILED";
                $jsonData["data"] = $row;

            }


        } catch (Exception $e) {
            $jsonData["response"] = false;
            $row["error"] = "AUTH_FAILED";
            $row["extended_error"] = $e->getMessage();
            $jsonData["status"] = 500;
            $jsonData["data"] = $row;
        }

        echo json_encode($jsonData);
    }

    public function sf_get_all_pickup()
    {

        $jsonData = array();

        try {
            $stmt = $this->DB_con->prepare('SELECT *
                                                    FROM safirire_safiri.pick_up_points, safirire_safiri.location
                                                    WHERE pick_up_points.location_code = location.location_code
                                                    ORDER BY pick_up_point_id DESC');
            
            $stmt->execute();

            if ($stmt->rowCount() > 0) {

                $counter = 0;
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $counter++;


                    $jsonData["response"] = true;
                    $jsonData["status"] = 200;
                    $jsonData["data"][] = $row;

                }

            } else {

                $jsonData["response"] = false;
                $jsonData["status"] = 403;
                $row["error"] = "FAILED";
                $jsonData["data"] = $row;

            }


        } catch (Exception $e) {
            $jsonData["response"] = false;
            $row["error"] = "AUTH_FAILED";
            $row["extended_error"] = $e->getMessage();
            $jsonData["status"] = 500;
            $jsonData["data"] = $row;
        }

        echo json_encode($jsonData);
    }

    public function sf_get_all_users($type)
    {

        $jsonData = array();
        $admin_flag = "admin";
        try {
            $stmt = $this->DB_con->prepare('SELECT f_name, m_name, l_name, national_id_num, postal_address, email_adddress, phone_num, date_of_registration, username
                                                    FROM safirire_safiri.users
                                                    WHERE user_type != :admin
                                                    AND user_type = :type
                                                    ORDER BY id DESC');

            $stmt->bindParam(":admin", $admin_flag);
            $stmt->bindParam(":type", $type);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {

                $counter = 0;
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $counter++;


                    $jsonData["response"] = true;
                    $jsonData["status"] = 200;
                    $jsonData["data"][] = $row;

                }

            } else {

                $jsonData["response"] = false;
                $jsonData["status"] = 403;
                $row["error"] = "FAILED";
                $jsonData["data"] = $row;

            }


        } catch (Exception $e) {
            $jsonData["response"] = false;
            $row["error"] = "AUTH_FAILED";
            $row["extended_error"] = $e->getMessage();
            $jsonData["status"] = 500;
            $jsonData["data"] = $row;
        }

        echo json_encode($jsonData);
    }

    public function sf_get_body_types()
    {

        $jsonData = array();

        try {
            $stmt = $this->DB_con->prepare('SELECT *
                                                    FROM safirire_safiri.body_type
                                                    ORDER BY type_id DESC');

            $stmt->execute();

            if ($stmt->rowCount() > 0) {

                $counter = 0;
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $counter++;


                    $jsonData["response"] = true;
                    $jsonData["status"] = 200;
                    $jsonData["count"] = $counter;
                    $jsonData["data"][] = $row;

                }

            } else {

                $jsonData["response"] = false;
                $jsonData["status"] = 403;
                $row["error"] = "FAILED";
                $jsonData["data"] = $row;

            }


        } catch (Exception $e) {
            $jsonData["response"] = false;
            $row["error"] = "AUTH_FAILED";
            $row["extended_error"] = $e->getMessage();
            $jsonData["status"] = 500;
            $jsonData["data"] = $row;
        }

        echo json_encode($jsonData);
    }

    public function sf_get_cars_per_pickup($pick_up_point, $body_type)
    {

        $jsonData = array();

        try {
            $stmt = $this->DB_con->prepare('SELECT *, NULL AS password, NULL AS current_session_key, NULL AS date_of_registration, NULL AS user_type, NULL AS username, NULL AS uri_log_book
                                                    FROM safirire_safiri.cars, safirire_safiri.pick_up_points,  safirire_safiri.make, safirire_safiri.users, safirire_safiri.body_type
                                                    WHERE cars.pick_up_point = :pick_up_point
                                                    AND cars.body_type = :body_type
                                                    AND cars.body_type = body_type.type_code
                                                    AND cars.pick_up_point = pick_up_points.pick_up_point_id
                                                    AND cars.make = make.make_id
                                                    AND cars.owner_username = users.username
                                                    ORDER BY cars.car_id DESC');

            $stmt->bindParam(':pick_up_point', $pick_up_point);
            $stmt->bindParam(':body_type', $body_type);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {

                $counter = 0;
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $counter++;

                    $car_id = $row['car_id'];
                    $row["pictures"] = self::sf_get_car_pictures($car_id);
                    $jsonData["response"] = true;
                    $jsonData["status"] = 200;
                    $jsonData["count"] = $counter;
                    $jsonData["data"][] = $row;

                }

            } else {

                $jsonData["response"] = false;
                $jsonData["status"] = 403;
                $row["error"] = "FAILED";
                $jsonData["data"] = $row;

            }


        } catch (Exception $e) {
            $jsonData["response"] = false;
            $row["error"] = "AUTH_FAILED";
            $row["extended_error"] = $e->getMessage();
            $jsonData["status"] = 500;
            $jsonData["data"] = $row;
        }

        echo json_encode($jsonData);
    }

    public function sf_get_cars_per_owner($owner)
    {
            
        $jsonData = array();

        try {

            $stmt = $this->DB_con->prepare("SELECT *, 
                                            NULL AS password, 
                                            NULL AS current_session_key, 
                                            NULL AS date_of_registration, 
                                            NULL AS user_type, 
                                            NULL AS username 
                                            FROM safirire_safiri.cars, 
                                            safirire_safiri.pick_up_points, 
                                            safirire_safiri.make, 
                                            safirire_safiri.users, 
                                            safirire_safiri.body_type 
                                            WHERE cars.owner_username = :owner_username
                                            AND cars.body_type = body_type.type_code 
                                            AND cars.pick_up_point = pick_up_points.pick_up_point_id 
                                            AND cars.make = make.make_id 
                                            AND cars.owner_username = users.username 
                                            ORDER BY cars.car_id DESC");

            $stmt->bindParam(':owner_username', $owner);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {

                $counter = 0;
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $counter++;

                    $car_id = $row['car_id'];
                    $row["pictures"] = self::sf_get_car_pictures($car_id);
                    $jsonData["response"] = true;
                    $jsonData["status"] = 200;
                    $jsonData["count"] = $counter;
                    $jsonData["data"][] = $row;

                }

            } else {

                $jsonData["response"] = false;
                $jsonData["status"] = 403;
                $row["error"] = "FAILED";
                $jsonData["data"] = $row;

            }


        } catch (Exception $e) {
            $jsonData["response"] = false;
            $row["error"] = "AUTH_FAILED";
            $row["extended_error"] = $e->getMessage();
            $jsonData["status"] = 500;
            $jsonData["data"] = $row;
        }

        echo json_encode($jsonData);
    }

    public function sf_get_all_cars()
    {

        $jsonData = array();

        try {
            $stmt = $this->DB_con->prepare('SELECT *, NULL AS password, NULL AS current_session_key, NULL AS date_of_registration, NULL AS user_type, NULL AS username
                                                    FROM safirire_safiri.cars, safirire_safiri.pick_up_points, safirire_safiri.make, safirire_safiri.users, safirire_safiri.body_type
                                                    WHERE  cars.body_type = body_type.type_code
                                                    AND cars.pick_up_point = pick_up_points.pick_up_point_id
                                                    AND cars.make = make.make_id
                                                    AND cars.owner_username = users.username
                                                    ORDER BY cars.car_id DESC');

            $stmt->execute();

            if ($stmt->rowCount() > 0) {

                $counter = 0;
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $counter++;

                    $car_id = $row['car_id'];
                    $row["pictures"] = self::sf_get_car_pictures($car_id);
                    $jsonData["response"] = true;
                    $jsonData["status"] = 200;
                    $jsonData["count"] = $counter;
                    $jsonData["data"][] = $row;

                }

            } else {

                $jsonData["response"] = false;
                $jsonData["status"] = 403;
                $row["error"] = "FAILED";
                $jsonData["data"] = $row;

            }


        } catch (Exception $e) {
            $jsonData["response"] = false;
            $row["error"] = "AUTH_FAILED";
            $row["extended_error"] = $e->getMessage();
            $jsonData["status"] = 500;
            $jsonData["data"] = $row;
        }

        echo json_encode($jsonData);
    }


    public function add_location($location_name){
        $jsonData = array();

        $location_code = rand(1000000, 99999999);
        try {
            $stmt = $this->DB_con->prepare('INSERT INTO safirire_safiri.location (location_code, location_name)
                                                  
                                          VALUES (
                                                  :location_code, 
                                                  :location_name
                                                  
                                          )');

            $stmt->bindParam(':location_code', $location_code);
            $stmt->bindParam(':location_name', $location_name);

            $stmt->execute();

            if ($stmt->rowCount() > 0) {

                $row["response"] = true;
                $row["status"] = 200;
                $jsonData["data"] = $row;

            } else {

                $row["response"] = false;
                $row["status"] = 200;
                $row["error"] = "INSERT_FAILED";
                $jsonData["data"] = $row;
            }


        } catch (Exception $e) {
            $row["response"] = false;
            $row["status"] = 500;
            $row["error"] = $e->getMessage();
            $jsonData["data"] = $row;
        }
        echo json_encode($jsonData);
    }


    public function add_make($make){
        $jsonData = array();
        
        try {
            $stmt = $this->DB_con->prepare('INSERT INTO safirire_safiri.make (make)
                                                  
                                          VALUES (:make)');

            $stmt->bindParam(':make', $make);

            $stmt->execute();

            if ($stmt->rowCount() > 0) {

                $row["response"] = true;
                $row["status"] = 200;
                $jsonData["data"] = $row;

            } else {

                $row["response"] = false;
                $row["status"] = 200;
                $row["error"] = "INSERT_FAILED";
                $jsonData["data"] = $row;
            }


        } catch (Exception $e) {
            $row["response"] = false;
            $row["status"] = 500;
            $row["error"] = $e->getMessage();
            $jsonData["data"] = $row;
        }
        echo json_encode($jsonData);
    }


    public function add_body_types($type, $body_type_placeholder){
        $jsonData = array();

        $type_code = rand(1000000, 99999999);
        try {
            $stmt = $this->DB_con->prepare('INSERT INTO safirire_safiri.body_type (type_code, type, body_type_placeholder)
                                                  
                                          VALUES (
                                                  :type_code, 
                                                  :type, 
                                                  :body_type_placeholder
                                                  
                                          )');

            $stmt->bindParam(':type_code', $type_code);
            $stmt->bindParam(':type', $type);
            $stmt->bindParam(':body_type_placeholder', $body_type_placeholder);

            $stmt->execute();

            if ($stmt->rowCount() > 0) {

                $row["response"] = true;
                $row["status"] = 200;
                $jsonData["data"] = $row;

            } else {

                $row["response"] = false;
                $row["status"] = 200;
                $row["error"] = "INSERT_FAILED";
                $jsonData["data"] = $row;
            }


        } catch (Exception $e) {
            $row["response"] = false;
            $row["status"] = 500;
            $row["error"] = $e->getMessage();
            $jsonData["data"] = $row;
        }
        echo json_encode($jsonData);
    }

    public function add_pick_up_point($pick_up_point, $location_code){
        $jsonData = array();
        
        try {
            $stmt = $this->DB_con->prepare('INSERT INTO safirire_safiri.pick_up_points(location_code, pick_up_point)
                                                  
                                          VALUES (
                                                  :location_code, 
                                                  :pick_up_point
                                                  
                                          )');

            $stmt->bindParam(':location_code', $location_code);
            $stmt->bindParam(':pick_up_point', $pick_up_point);

            $stmt->execute();

            if ($stmt->rowCount() > 0) {

                $row["response"] = true;
                $row["status"] = 200;
                $jsonData["data"] = $row;

            } else {

                $row["response"] = false;
                $row["status"] = 500;
                $row["error"] = "INSERT_FAILED";
                $jsonData["data"] = $row;
            }


        } catch (Exception $e) {
            $row["response"] = false;
            $row["status"] = 500;
            $row["error"] = $e->getMessage();
            $jsonData["data"] = $row;
        }
        echo json_encode($jsonData);
    }

    public function add_car($make, $model, $uri_log_book, $body_type, $hire_price_per_day, $owner_username, $pick_up_point, $car_number_plate){
        $jsonData = array();

        $hire_status = 00;
        try {
            $stmt = $this->DB_con->prepare('INSERT 
                                            INTO safirire_safiri.cars (
                                            make, 
                                            model, 
                                            uri_log_book, 
                                            body_type, 
                                            hire_price_per_day, 
                                            pick_up_point, 
                                            owner_username, 
                                            hire_status, 
                                            car_number_plate)
                                                  
                                          VALUES (
                                                  :make,
                                                  :model,
                                                  :uri_log_book,
                                                  :body_type,
                                                  :hire_price_per_day,
                                                  :pick_up_point,
                                                  :owner_username,
                                                  :hire_status,
                                                  :car_number_plate
                                                  
                                          )');

            $stmt->bindParam(':make', $make);
            $stmt->bindParam(':model', $model);
            $stmt->bindParam(':uri_log_book', $uri_log_book);
            $stmt->bindParam(':body_type', $body_type);
            $stmt->bindParam(':hire_price_per_day', $hire_price_per_day);
            $stmt->bindParam(':pick_up_point', $pick_up_point);
            $stmt->bindParam(':owner_username', $owner_username);
            $stmt->bindParam(':hire_status', $hire_status);
            $stmt->bindParam(':car_number_plate', $car_number_plate);

            $stmt->execute();

            if ($stmt->rowCount() > 0) {

                $row["response"] = true;
                $row["status"] = 200;
                $jsonData["data"] = $row;

            } else {

                $row["response"] = false;
                $row["status"] = 500;
                $row["error"] = "INSERT_FAILED";
                $jsonData["data"] = $row;
            }


        } catch (Exception $e) {
            $row["response"] = false;
            $row["status"] = 500;
            $row["error"] = $e->getMessage();
            $jsonData["data"] = $row;
        }
        echo json_encode($jsonData);
    }

    public function sf_auth_logout($username){
        $jsonData = array();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie('username', '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httsponly"]
            );

            setcookie('email_adddress', '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httsponly"]
            );

            setcookie('phone_num', '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httsponly"]
            );

            setcookie('current_session_key', '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httsponly"]
            );
        }

// Finally, destroy the session.
        session_unset();
        session_destroy();

        self::sf_auth_set_csk($username, "0000");
        $row["response"] = true;
        $row["username"] = $username;
        $jsonData["data"] = $row;
        
        
        echo json_encode($jsonData);
    }

    public function uploadFile($newfilename){

        //File Upload Library

        $target_dir = "uploads/files/"; //uploads refers to the preferred folder
        $target_file = $target_dir . $newfilename;
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

        // Check if image file is a actual image or fake image

        $check = getimagesize($_FILES["post_file"]["tmp_name"]);


        if ($_FILES["post_file"]["size"] > 30000000 ) {


            return false;

        }

        // Allow certain file formats
        if($imageFileType != "pdf"
            && $imageFileType != "doc"
            && $imageFileType != "docx"
            && $imageFileType != "jpg"
            && $imageFileType != "DOC"
            && $imageFileType != "DOCX"
            && $imageFileType != "ODT"
            && $imageFileType != "PDF" ) {

//                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;

            return false;

        }

        if($_FILES['post_file']['error']) {
            // handle the error

            echo $_FILES["post_file"]["error"];
        } else {
            // process

            if (move_uploaded_file($_FILES["post_file"]["tmp_name"], $target_file)) {

                return true;

            } else {

//                echo $target_dir;
//                echo "::::";
//                echo $target_file;
//                echo "::::";
//                echo $_FILES['post_file']['temp_name'];
//                echo "::::";
//                echo "Sorry, there was an error uploading your file. Error => " . $_FILES["post_image"]["error"];
//                ini_set('display_errors', 1);
//                error_reporting(E_ALL);
//
//                return false;
            }
        }
    }

    public function error_reporting($err){
        $jsonData = array();

        $ERROR = "";
        $DESCRIPTION = "";

        if($err === "METHOD_MISSING"){
            $ERROR = "METHOD_MISSING";
            $DESCRIPTION = "The Callback-Method is missing from your query. Contact Developers.";
        }

        $row["response"] = false;
        $row["status"] = 500;
        $row["error"] = $ERROR;
        $row["error_description"] = $DESCRIPTION;
        $jsonData["data"] = $row;

        echo json_encode($jsonData);
        die();
    }

    public function upload_to_cdn($car_id){
        //globals
        $jsonData = array();
        $cdn = $pic_url = "https://cdn.safirirental.com/images/";

        //First Photo;

        $temp = explode(".", $_FILES["post_image_one"]["name"]);

        if(end($temp) != null){

            $newFileName = "safiri"."-".round(microtime(true)) .rand(1000000,99999999). '.' . end($temp);

            $pic_url = $cdn.$newFileName;
            $pic_type = 00;

            $tempName = "post_image_one";
            self:: uploadImageToCDN($newFileName, $tempName);
            if(self::upload_car_photos($car_id, $pic_url, $pic_type)) {
                $row['pic_one_upload_ok'] = true;
            } else {
                $row['pic_one_upload_ok'] = false;
            }
        }else{
            $row['pic_one_upload_ok'] = false;
        }

        //---------------------------


        //Second Photo
        $temp1 = explode(".", $_FILES["post_image_two"]["name"]);

        if(end($temp1) != null) {
            $newFileName1 = "safiri" . "-" . round(microtime(true)) . rand(1000000, 99999999) . '.' . end($temp1);

            $pic_url1 = $cdn . $newFileName1;
            $pic_type = 00;

            $tempName1 = "post_image_two";
            self:: uploadImageToCDN($newFileName1, $tempName1);
            if (self::upload_car_photos($car_id, $pic_url1, $pic_type)) {
                $row['pic_two_upload_ok'] = true;
            } else {
                $row['pic_two_upload_ok'] = false;
            }
        }else{
            $row['pic_two_upload_ok'] = false;
        }
        //---------------------------


        //Third Photo
        $temp2 = explode(".", $_FILES["post_image_three"]["name"]);

        if(end($temp2) != null) {
            $newFileNam2 = "safiri" . "-" . round(microtime(true)) . rand(1000000, 99999999) . '.' . end($temp2);

            $pic_url2 = $cdn . $newFileNam2;
            $pic_type = 00;

            $tempName2 = "post_image_three";
            self:: uploadImageToCDN($newFileNam2, $tempName2);
            if (self::upload_car_photos($car_id, $pic_url2, $pic_type)) {
                $row['pic_three_upload_ok'] = true;
            } else {
                $row['pic_three_upload_ok'] = false;
            }
        }else{
            $row['pic_three_upload_ok'] = false;
        }
        //---------------------------


        //Fourth Photo
        $temp3 = explode(".", $_FILES["post_image_four"]["name"]);

        if(end($temp3) != null) {
            $newFileName3 = "safiri" . "-" . round(microtime(true)) . rand(1000000, 99999999) . '.' . end($temp3);

            $pic_url3 = $cdn . $newFileName3;
            $pic_type = 00;

            $tempName3 = "post_image_four";
            self:: uploadImageToCDN($newFileName3, $tempName3);
            if (self::upload_car_photos($car_id, $pic_url3, $pic_type)) {
                $row['pic_four_upload_ok'] = true;
            } else {
                $row['pic_four_upload_ok'] = false;
            }
        }else{
            $row['pic_four_upload_ok'] = false;
        }
        //---------------------------

//    Commit
        $row["response"] = true;
        $row["status"] = 200;
        $jsonData["data"] = $row;

        echo json_encode($jsonData);

    }

    /**
     * @param $newphotoname
     * @return bool
     */
    public function uploadImage($newphotoname){

        //File Upload Library
        $target_dir = "uploads/images/"; //uploads refers to the preferred folder
        $target_file = $target_dir . $newphotoname;
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

        // Check if image file is a actual image or fake image

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

//            echo $_FILES["post_image"]["error"];
            return false;

        } else {
            // process

            if (move_uploaded_file($_FILES["post_image"]["tmp_name"], $target_file)) {

                return true;

            } else {

                //For Debugging purposes only
//                echo $target_dir;
//                echo "::::";
//                echo $target_file;
//                echo "::::";
//                echo $_FILES['post_image']['temp_name'];
//                echo "::::";
//                echo "Sorry, there was an error uploading your file. Error => " . $_FILES["post_image"]["error"];
//                ini_set('display_errors', 1);
//                error_reporting(E_ALL);

                return false;
            }
        }
    }

    public function uploadImageToCDN($newphotoname, $tempName){

        //File Upload Library
        $target_dir = "uploads/images/"; //uploads refers to the preferred folder
        $target_file = $target_dir . $newphotoname;
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

        // Check if image file is a actual image or fake image

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

//            echo $_FILES["post_image"]["error"];
            return false;

        } else {
            // process

            if (move_uploaded_file($_FILES[$tempName]["tmp_name"], $target_file)) {

                return true;

            } else {

                //For Debugging purposes only
//                echo $target_dir;
//                echo "::::";
//                echo $target_file;
//                echo "::::";
//                echo $_FILES['post_image']['temp_name'];
//                echo "::::";
//                echo "Sorry, there was an error uploading your file. Error => " . $_FILES["post_image"]["error"];
//                ini_set('display_errors', 1);
//                error_reporting(E_ALL);

                return false;
            }
        }
    }

    public function upload_car_photos($car_id, $pic_url, $pic_type){

        try {
            $stmt = $this->DB_con->prepare('INSERT 
                                            INTO safirire_safiri.car_pictures (
                                            car_id, 
                                            pic_url, 
                                            pic_type)
                                                  
                                          VALUES (
                                                  :car_id,
                                                  :pic_url,
                                                  :pic_type
                                                  
                                          )');

            $stmt->bindParam(':car_id', $car_id);
            $stmt->bindParam(':pic_url', $pic_url);
            $stmt->bindParam(':pic_type', $pic_type);

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


