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
            echo $e->getMessage();
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

    public function sf_auth_generate_csk(){

        $length_one = 12;
        $length_two = 12;
        $csk_prefix = "safiri";
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

    /**
     * @param $pass
     * @return string
     */
    public function hash_password($pass) {
        $salt = "@^sas8876&997hJH&^bjj%&^z£a8)*&()5";
        return sha1($pass . $salt);
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
                                                    AND password = :hash_password');

            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':hash_password', $hash_password);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {

                $counter = 0;
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $counter++;

                    $current_session_key = self::sf_auth_generate_csk();

                    if((bool)self::sf_auth_set_csk($username, $current_session_key)){

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


}


