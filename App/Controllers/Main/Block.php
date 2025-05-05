<?php

namespace Controller;

defined('ROOTPATH') or exit('Access denied');

class Block
{
    use MainController;

    public function index()
    {
        $this->view('Main/Block');
    }
}

?>