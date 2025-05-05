<?php

    namespace Controller;

    defined('ROOTPATH') or exit('Access denied');

    class Paymenterror{
        use MainController;
        public function index(){
            
           
           
            $this->view('Receptionist/Paymenterror');
        }
    }
?>