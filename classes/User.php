<?php

    class User {
        private $firstName;
        private $lastName;
        private $email;
        private $password;
        private $isAdmin;

        private function checkIfEmailExists($email) {
            include_once("./database/Db.php");
            $conn = Db::getInstance();

            $q = $conn->prepare("SELECT * FROM user WHERE email = :email");
            $q->bindValue(':email', $email);
            $q->execute();
            $result = $q->fetch();
            
            if($result[0]) {
                return true;
            } else {
                return false;
            }
        }

        public function save() {
            include_once("./database/Db.php");
            include_once("./functions/Password.php");
            $conn = Db::getInstance();

            $q = $conn->prepare("INSERT INTO user (first_name, last_name, email, password, is_admin) VALUES (:first_name, :last_name, :email, :password, :is_admin)");
            $q->bindValue(':first_name', $this->firstName);
            $q->bindValue(':last_name', $this->lastName);
            $q->bindValue(':email', $this->email);
            $hash = Password::hash($this->password);
            var_dump($this->password);
            var_dump($hash);
            $q->bindValue(':password', $hash);
            $q->bindValue(':is_admin', $this->isAdmin);

            return $q->execute();
        }

        public function login($email, $password) {

            if(empty($email)) {
                throw new Exception("Gelieve een e-mailadres in te vullen.");
            } else if(empty($password)) {
                throw new Exception("Gelieve een wachtwoord in te vullen.");
            }

            $this->email = $email;
            $this->password = $password;

            include_once("./database/Db.php");
            include_once("./functions/Password.php");
            $conn = Db::getInstance();

            $q = $conn->prepare("SELECT * FROM user WHERE email = :email");
            $q->bindValue(':email', $this->email);
            $q->execute();

            $result = $q->fetch();
            $approved = $result["is_approved"];

            if(!$approved) {
                throw new Exception("Je account is nog niet goedgekeurd.");
            }

            $hash = $result["password"];

            if(Password::verify($this->password, $hash)) {
                session_start();
                $_SESSION["user"] = $this->email;
            } else {
                throw new Exception("Het e-mailadres en/of wachtwoord is niet correct.");
            }

        }

        public function getFirstName() {
            return $this->firstName;
        }

        public function setFirstName($firstName) {
            if(empty($firstName)) {
                throw new Exception("Gelieve een voornaam in te vullen.");
            } else {
                $this->firstName = $firstName;
                return $this;
            }
        }

        public function getLastName() {
            return $this->lastName;
        }

        public function setLastName($lastName) {
            if(empty($lastName)) {
                throw new Exception("Gelieve een achternaam in te vullen.");
            } else {
                $this->lastName = $lastName;
                return $this;
            }
        }

        public function getEmail() {
            return $this->email;
        }

        public function setEmail($email) {
            if(empty($email)) {
                throw new Exception("Gelieve een e-mailadres in te vullen.");
            } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new Exception("Gelieve een geldig e-mailadres in te vullen.");
            } else if($this->checkIfEmailExists($email)) {
                throw new Exception("Dit e-mailadres is reeds in gebruik.");
            } else {
                $this->email = $email;
                return $this;
            }
        }

        public function getPassword() {
            return $this->password;
        }

        public function setPassword($password) {
            if(empty($password)) {
                throw new Exception("Gelieve een wachtwoord in te vullen.");
            } else {
                $this->password = $password;
                return $this;
            }
        }

        public function getIsAdmin() {
            return $this->isAdmin;
        }

        public function setIsAdmin($isAdmin) {
            $this->isAdmin = $isAdmin;
            return $this;
        }
    }