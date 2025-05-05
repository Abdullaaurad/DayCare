<?php

    namespace Controller;

    defined('ROOTPATH') or exit('Access denied');

    class Visitorerror{
        use MainController;
        public function index(){
            $this->view('Receptionist/Visitorerror');
        }
    }
?>