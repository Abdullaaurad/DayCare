<?php

    namespace App\Helpers;

    class ParentHelper
    {
        public function store_parent(){
            $session = new \Core\Session;
            $session->set("USERID", 1);
            $session = new \Core\Session;
            $UserID = $session->get('USERID');
        
            // Fetch ParentID based on the current user's ID
            $parent = new \Modal\ParentUser;
            $pre = $parent->first(['UserID' => $UserID]);

            return $pre;
        }
    }

?>