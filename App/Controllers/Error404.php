<?php

    namespace Controller;

    class Error404{
        use MainController;
        public function index(){
            $this->view('404');
        }
    }
?>