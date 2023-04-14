<?php

class ConnectionPDO
{

    private static $instance;

    public function __construct() {}
    public function __clone() {}
    public function __wakeup() {}
    
    /**
    *
    * @return object PDO connection
    *
    */

    public static function getinstance () {
        if (!isset(self::$instance)) {
            $host = "localhost";
            $database = "Agenda";
            $username = ""; # Username
            $password = ""; # Password

            try {
                self::$instance = new PDO("mysql:host=$host;dbname=$database", $username, $password);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch (PDOException $err) {
                echo "ERRO: ". $err->getMessage();
                exit();
            } catch (Exception $err) {
                echo "ERRO: ". $err->getMessage();
            } 
        }
        return self::$instance;
    }
}
