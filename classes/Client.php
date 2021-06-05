<?php

    class Client {
        private $name;
        private $addressStreet;
        private $addressNumber;
        private $city;
        private $postalCode;
        private $phone;
        private $email;

        public static function getAllClients() {
            include_once("./database/Db.php");
            $conn = Db::getInstance();

            $q = $conn->prepare("SELECT * FROM client ORDER BY name ASC");
            $q->execute();
            
            $clients = $q->fetchAll();
            return $clients;
        }

        public function loadClientById($id) {
            include_once("./database/Db.php");
            $conn = Db::getInstance();

            $q = $conn->prepare("SELECT * FROM client WHERE id = :id");
            $q->bindValue(':id', $id);
            $q->execute();

            $client = $q->fetch();

            if(!$client[0]) {
                throw new Exception("De klant waarvan u de gegevens wilt opvragen, bestaat niet.");
            }

            $this->name = $client["name"];
            $this->addressStreet = $client["address_street"];
            $this->addressNumber = $client["address_number"];
            $this->city = $client["city"];
            $this->postalCode = $client["postal_code"];
            $this->phone = $client["phone"];
            $this->email = $client["email"];
        }

        public function getName() {
            return $this->name;
        }

        public function setName($name) {
            $this->name = $name;
            return $this;
        }
    }