<?php

    namespace Modal;

    defined('ROOTPATH') or exit('Access Denied!');

    class Reminder{
        use Modal;

        protected $table = 'reminder';
        protected $allowedColumns = [
            'ChildID',
            'Date',
            'Description',
        ];
    }
?>