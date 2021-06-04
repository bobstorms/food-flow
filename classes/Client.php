<?php

    class Client {
        private $name;
        private $addressStreet;
        private $addressNumber;
        private $city;
        private $postalCode;
        private $phone;
        private $number;

        public static function getAllClients() {
            include_once("./database/Db.php");
            $conn = Db::getInstance();

            $q = $conn->prepare("SELECT * FROM client ORDER BY name ASC");
            $q->execute();
            
            $clients = $q->fetchAll();
            return $clients;
        }

    }