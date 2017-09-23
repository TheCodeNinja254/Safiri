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
    



}

