<?php

    class Weight {
        private $orderTicketId;
        private $weight;

        public function save() {
            include_once("./database/Db.php");
            $conn = Db::getInstance();

            $q = $conn->prepare("INSERT INTO weight (order_ticket_id, weight) VALUES (:order_ticket_id, :weight)");

            $q->bindValue(':order_ticket_id', $this->orderTicketId);
            $q->bindValue(':weight', $this->weight);

            return $q->execute();
        }

        public function getOrderTicketId() {
            return $this->orderTicketId;
        }

        public function setOrderTicketId($orderTicketId) {
            $this->orderTicketId = $orderTicketId;
            return $this;
        }

        public function getWeight() {
            return $this->weight;
        }

        public function setWeight($weight) {
            $this->weight = $weight;
            return $this;
        }
    }