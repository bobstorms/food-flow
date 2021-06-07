<?php

    class Wishlist {

        public static function setWishlistReady($client_id, $product_id) {
            include_once("./database/Db.php");
            $conn = Db::getInstance();

            $q = $conn->prepare("UPDATE wishlist SET is_ready = 1 WHERE client_id = :client_id AND product_id = :product_id");
            $q->bindValue(':client_id', $client_id);
            $q->bindValue(':product_id', $product_id);
            
            return $q->execute();
        }

        public static function getOrderTicketDateByClientId($id) {
            include_once("./database/Db.php");
            $conn = Db::getInstance();

            $q = $conn->prepare("SELECT order_ticket.date FROM order_ticket, wishlist WHERE order_ticket.wishlist_id = wishlist.id AND wishlist.client_id = :id ORDER BY date DESC LIMIT 1");
            $q->bindValue(':id', $id);
            $q->execute();

            $date = $q->fetch()["date"];
            $date = DateTime::createFromFormat("d/m/Y H:i:s", $date);

            $day = $date->format("j");
            $month = $date->format("m");
            $year = $date->format("Y");
    
            switch($month) {
                case "01":
                    $month = "januari";
                    break;
                
                case "02":
                    $month = "februari";
                    break;
                
                case "03":
                    $month = "maart";
                    break;
                
                case "04":
                    $month = "april";
                    break;
                
                case "05":
                    $month = "mei";
                    break;
                
                case "06":
                    $month = "juni";
                    break;
                
                case "07":
                    $month = "juli";
                    break;
                
                case "08":
                    $month = "augustus";
                    break;
                
                case "09":
                    $month = "september";
                    break;
                
                case "10":
                    $month = "oktober";
                    break;
                
                case "11":
                    $month = "november";
                    break;
                
                case "12":
                    $month = "december";
                    break;
            }            

            $date = $day . " " . $month . " " . $year;

            return $date;
        }

        public static function getTotalWeightByClientId($id) {
            include_once("./database/Db.php");
            $conn = Db::getInstance();

            $q = $conn->prepare("SELECT SUM(weight.weight) total_weight FROM wishlist, product, order_ticket, weight WHERE wishlist.client_id = :id AND wishlist.product_id = product.id AND order_ticket.wishlist_id = wishlist.id AND weight.order_ticket_id = order_ticket.id");
            $q->bindValue(':id', $id);
            $q->execute();

            $total_weight = $q->fetch()["total_weight"];
            $total_weight = str_replace(".", ",", $total_weight);

            return $total_weight;
        }

        public static function getAllItemsAndWeightsByClientId($id) {
            include_once("./database/Db.php");
            $conn = Db::getInstance();

            $q = $conn->prepare("SELECT product.name, SUM(weight.weight) total_weight, wishlist.is_ready FROM wishlist, product, order_ticket, weight WHERE wishlist.client_id = :id AND wishlist.product_id = product.id AND order_ticket.wishlist_id = wishlist.id AND weight.order_ticket_id = order_ticket.id GROUP BY product.name ORDER BY wishlist.id");
            $q->bindValue(':id', $id);
            $q->execute();

            $result = $q->fetchAll();

            if(!$result[0]) {
                throw new Exception("Er werd geen leveringsbon gevonden.");
            }

            $items = [];

            foreach($result as $r) {
                $r["total_weight"] = str_replace(".", ",", $r["total_weight"]);
                array_push($items, $r);
            }

            return $items;
        }
        
        public static function getAllItemsByClientId($id) {
            include_once("./database/Db.php");
            $conn = Db::getInstance();

            $q = $conn->prepare("SELECT product.name, wishlist.quantity, wishlist.is_ready FROM product, wishlist WHERE wishlist.client_id = :id AND wishlist.product_id = product.id");
            $q->bindValue(':id', $id);
            $q->execute();

            $result = $q->fetchAll();

            if(!$result[0]) {
                throw new Exception("Er werd geen sorteerfiche gevonden.");
            }

            $items = [];

            foreach($result as $r) {
                $r["is_ready"] = filter_var($r["is_ready"], FILTER_VALIDATE_BOOLEAN);
                array_push($items, $r);
            }

            return $items;
        }

        public static function getItemToBeSortedByClientId($id) {
            include_once("./database/Db.php");
            $conn = Db::getInstance();

            $q = $conn->prepare("SELECT wishlist.id, wishlist.product_id, product.name, product.image, wishlist.quantity FROM product, wishlist WHERE wishlist.client_id = :id AND wishlist.product_id = product.id AND wishlist.is_ready = 0 LIMIT 1");
            $q->bindValue(':id', $id);
            $q->execute();

            $result = $q->fetch();

            if(!$result[0]) {
                throw new Exception("Alle items werden gesorteerd.");
            }

            return $result;
        }

    }