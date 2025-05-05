<?php

    namespace Modal;

    defined('ROOTPATH') or exit('Access Denied!');

    class ChildNotification{
        use Modal;

        protected $table = 'ChildNotification';
        protected $allowedColumns = [
            'ChildID',
            'Description',
            'Date',
            'Seen',
            'Location',
            'Time'
        ];

    }
?>