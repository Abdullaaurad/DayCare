<?php

    namespace Controller;

    class Message{
        use MainController;

        public function index(){
            
            $this->view('Teacher/Message');
           
        }
    }
?>
