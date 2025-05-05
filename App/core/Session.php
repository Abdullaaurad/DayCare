<?php

    /**
     * Session class
     * Save or read data to the current session
     */

    namespace Core;

use SessionHandler;

    defined('ROOTPATH') or exit('Access Denied!');

    class Session
    {

        public $mainkey = 'APP';
        public $userkey = 'Logged_In';

        /** activate session if not yet started **/
        private function start_session(): int
        {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            return 1;
        }

        /** put data into the session **/
        public function set(mixed $keyOrArray, mixed $value = ''): int
        {
            $this->start_session();

            if (is_array($keyOrArray)) {
                foreach ($keyOrArray as $key => $value) {
                    $_SESSION[$this->mainkey][$key] = $value;
                }

                return 1;
            }

            $_SESSION[$this->mainkey][$keyOrArray] = $value;

            return 1;
        }

        public function unset(mixed $key = null): int
        {
            $this->start_session();  // Ensure session is started

            if ($key != null){
                // If a specific key is provided, unset that particular key
                unset($_SESSION[$this->mainkey][$key]);
            }

            return 1;
        }


        /** get data from the session. default is return if data not found **/
        public function get(string $key, mixed $default = ''): mixed
        {

            $this->start_session();

            if (isset($_SESSION[$this->mainkey][$key])) {
                return $_SESSION[$this->mainkey][$key];
            }

            return $default;
        }

        /** saves the user row data into the session after a login **/
        public function auth(mixed $user_row): int
        {
            $this->start_session();

            $_SESSION[$this->userkey] = $user_row;

            return 0;
        }

        /** removes user data from the session **/
        public function logout(): int
        {
            $this->start_session();
            $_SESSION = [];
            session_unset();
            session_destroy();
            return 0;
        }

        /** checks if user is logged in **/
        public function is_logged_in(): bool
        {
            $this->start_session();
            $session = new Session;
    
            if (!empty($session->get('Logged_In'))) {
                return true;
            }
        
            return false;
        }

        /** gets data from a column in the session user data **/
        public function user(string $key = '', mixed $default = ''): mixed
        {
            $this->start_session();

            if (empty($key) && !empty($_SESSION[$this->userkey])) {

                return $_SESSION[$this->userkey];
            } else

            if (!empty($_SESSION[$this->userkey]->$key)) {

                return $_SESSION[$this->userkey]->$key;
            }

            return $default;
        }

        /** returns data from a key and deletes it **/
        public function pop(string $key, mixed $default = ''): mixed
        {
            $this->start_session();

            if (!empty($_SESSION[$this->mainkey][$key])) {

                $value = $_SESSION[$this->mainkey][$key];
                unset($_SESSION[$this->mainkey][$key]);
                return $value;
            }

            return $default;
        }

        /** returns all data from the APP array **/
        public function all(): mixed
        {
            $this->start_session();

            if (isset($_SESSION[$this->mainkey])) {
                return $_SESSION[$this->mainkey];
            }

            return [];
        }

        public function check_login() {
            if (!$this->is_logged_in()) {
                redirect('Main/Login');
                exit;
            }
        }

        public function check_child(){
            $this->start_session();
            $session = new Session;
    
            if (empty($session->get('CHILDID'))) {
                redirect ('Parent/Home');
            }
        
            return false;
        }
    }
?>
