<?php

    class OrderTicket {
        private $userId;
        private $wishlistId;
        private $date;

        public static function getIdByDate($date) {
            include_once("./database/Db.php");
            $conn = Db::getInstance();

            $q = $conn->prepare("SELECT id FROM order_ticket WHERE date = :date");
            $q->bindValue(':date', $date);
            $q->execute();

            $id = $q->fetch()["id"];
            return $id;
        }

        public function save() {
            include_once("./database/Db.php");
            $conn = Db::getInstance();

            $q = $conn->prepare("INSERT INTO order_ticket (user_id, wishlist_id, date) VALUES (:user_id, :wishlist_id, :date)");

            $q->bindValue(':user_id', $this->userId);
            $q->bindValue(':wishlist_id', $this->wishlistId);
            $q->bindValue(':date', $this->date);

            return $q->execute();
        }

        public function getUserId() {
            return $this->userId;
        }

        public function setUserId($userId) {
            $this->userId = $userId;
            return $this;
        }

        public function getWishlistId() {
            return $this->wishlistId;
        }

        public function setWishlistId($wishlistId) {
            $this->wishlistId = $wishlistId;
            return $this;
        }

        public function getDate() {
            return $this->date;
        }

        public function setDate($date) {
            $this->date = $date;
            return $this;
        }
    }