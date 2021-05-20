<?php

    class Password {

        public static function hash($password) {
            $options = [
                "cost" => 15
            ];
            return password_hash($password, PASSWORD_DEFAULT, $options);
        }

    }