<?php

    namespace Controller;

    defined('ROOTPATH') or exit('Access denied');

    class Leavesupdate{
        use MainController;
        public function index(){
           show($_POST);
           exit();
            
            $this->view('Maid/leavesupdate', $data);
        }
      
    }
?>