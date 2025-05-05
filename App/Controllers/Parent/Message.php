<?php

    namespace Controller;

    defined('ROOTPATH') or exit('Access denied');

    class Message{
        use MainController;
        public function index(){
            $this->view('Parent/message');
        }

        public function Logout(){
            $session = new \core\Session();
            $session->logout();

            echo json_encode(["success" => true]);
            exit;
        }
    }
?>