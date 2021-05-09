<?php

    class User {
        private $first_name;
        private $last_name;
        private $email;
        private $password;
        private $is_admin;

        /**
         * Get the value of first_name
         */ 
        public function getFirst_name()
        {
                return $this->first_name;
        }

        /**
         * Set the value of first_name
         *
         * @return  self
         */ 
        public function setFirst_name($first_name)
        {
                $this->first_name = $first_name;

                return $this;
        }

        /**
         * Get the value of last_name
         */ 
        public function getLast_name()
        {
                return $this->last_name;
        }

        /**
         * Set the value of last_name
         *
         * @return  self
         */ 
        public function setLast_name($last_name)
        {
                $this->last_name = $last_name;

                return $this;
        }

        /**
         * Get the value of email
         */ 
        public function getEmail()
        {
                return $this->email;
        }

        /**
         * Set the value of email
         *
         * @return  self
         */ 
        public function setEmail($email)
        {
                $this->email = $email;

                return $this;
        }

        /**
         * Get the value of password
         */ 
        public function getPassword()
        {
                return $this->password;
        }

        /**
         * Set the value of password
         *
         * @return  self
         */ 
        public function setPassword($password)
        {
                $this->password = $password;

                return $this;
        }

        /**
         * Get the value of is_admin
         */ 
        public function getIs_admin()
        {
                return $this->is_admin;
        }

        /**
         * Set the value of is_admin
         *
         * @return  self
         */ 
        public function setIs_admin($is_admin)
        {
                $this->is_admin = $is_admin;

                return $this;
        }
    }