<?php

    namespace Modal;

    defined('ROOTPATH') or exit('Access Denied!');

    class Inventory{
        use Modal;

        protected $table = 'Inventory';
        protected $allowedColumns = [
            'Activity',
            'UserID',
            'ItemID',
            'Quantity',
            'Notes',
            'Date',
            'Time',
            'Activity',
            'Returned'
        ];
    }