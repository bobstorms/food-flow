<?php

    class User {
        private $firstName;
        private $lastName;
        private $email;
        private $password;
        private $isAdmin;

        public function save() {
            include_once("./database/Db.php");
            $conn = Db::getInstance();

            $q = $conn->prepare("INSERT INTO user (first_name, last_name, email, password, is_admin) VALUES (:first_name, :last_name, :email, :password, :is_admin)");
            $q->bindValue(':first_name', $this->firstName);
            $q->bindValue(':last_name', $this->lastName);
            $q->bindValue(':email', $this->email);
            $q->bindValue(':password', $this->password);
            $q->bindValue(':is_admin', $this->isAdmin);
            
            return $q->execute();
        }

        public function getFirstName() {
            return $this->firstName;
        }

        public function setFirstName($firstName) {
            $this->firstName = $firstName;
            return $this;
        }

        public function getLastName() {
            return $this->lastName;
        }

        public function setLastName($lastName) {
            $this->lastName = $lastName;
            return $this;
        }

        public function getEmail() {
            return $this->email;
        }

        public function setEmail($email) {
            $this->email = $email;
            return $this;
        }

        public function getPassword() {
            return $this->password;
        }

        public function setPassword($password) {
            include_once("./functions/Password.php");
            $this->password = Password::hash($password);
            return $this;
        }

        public function getIsAdmin() {
            return $this->isAdmin;
        }

        public function setIsAdmin($isAdmin) {
            $this->isAdmin = $isAdmin;
            return $this;
        }
    }