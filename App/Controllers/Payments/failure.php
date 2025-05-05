<?php

    namespace Controller;

    defined('ROOTPATH') or exit('Access denied');

    class Failure{
        use MainController;
        public function index(){
            $this->view('Payments/failure');
        }
    }
?>