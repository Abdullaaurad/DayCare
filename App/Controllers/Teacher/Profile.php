<?php

    namespace Controller;

    class Profile{
        use MainController;

        public function index(){
            
            $this->view('Teacher/Profile');
           
        }
    }
?>

