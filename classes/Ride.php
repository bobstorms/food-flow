<?php

    class Ride {
        private $date;
        private $client_id;
        private $is_ready;

        public static function getRidesByDate($date) {
            include_once("./database/Db.php");
            $conn = Db::getInstance();

            $q = $conn->prepare("SELECT ride.id, client.name, client.address_street, client.address_number, client.postal_code, client.city, ride.is_ready FROM ride, client WHERE ride.date = :date AND ride.client_id = client.id");
            $q->bindValue(":date", $date);
            $q->execute();
            
            $rides = $q->fetchAll();

            if(!$rides[0]) {
                throw new Exception("Er werden geen ritten gevonden voor deze datum.");
            }

            return $rides;
        }

    }