<?php

    class Db {
        private static $conn;

        public static function getInstance() {
            if(self::$conn != null) { // Return connection if it already exists.
                return self::$conn;
            } else {
                $config = include_once("./config/config.php"); // Include config file                
                self::$conn = new PDO("mysql:host=" . $config["db_host"] . ";dbname=" . $config["db_name"] . "", "" . $config["db_username"] . "", "" . $config["db_password"] . "");
                return self::$conn;
            }
        }
    }