<?php

namespace Controller;

defined('ROOTPATH') or exit('Access denied');

class VerificationEmail
{
    use MainController;
    public function index($data = null)
    {
        $session = new \Core\Session;
        $session->check_login();

        $this->view('main/VerificationEmail', $data);
    }
}

?>