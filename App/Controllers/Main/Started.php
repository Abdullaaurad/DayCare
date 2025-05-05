<?php

    namespace Controller;

    defined('ROOTPATH') or exit('Access denied');

    class Started{
        use MainController;
        public function index(){
            $this->view('main/Started');
        }
    }
?>