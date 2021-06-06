<?php

    class Wishlist {
        
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

        public static function getItemsToBeSortedByClientId($id) {
            include_once("./database/Db.php");
            $conn = Db::getInstance();

            $q = $conn->prepare("SELECT wishlist.id, product.name, product.image, wishlist.quantity FROM product, wishlist WHERE wishlist.client_id = :id AND wishlist.product_id = product.id AND wishlist.is_ready = 0");
            $q->bindValue(':id', $id);
            $q->execute();

            $result = $q->fetchAll();

            if(!$result[0]) {
                throw new Exception("Er werd geen sorteerfiche gevonden.");
            }

            return $result;
        }

    }