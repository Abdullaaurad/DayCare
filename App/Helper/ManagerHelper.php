<?php

    namespace App\Helpers;

    class ManagerHelper
    {
        public function Check_Manager(){
            $session = new \Core\Session;
            $Manager = $session->get('Manager');

            if(!$Manager){
                redirect ('main/Login');
            }
        }
    }

?>