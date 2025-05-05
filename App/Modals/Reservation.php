<?php

    namespace Modal;

    defined('ROOTPATH') or exit('Access Denied!');

    class Reservation{
        use Modal;

        protected $table = 'reservation';
        protected $allowedColumns = [
            'ChildID',
            'Start_Time',
            'Date',
            'End_Time',
            'Status',
            'Notes',
            'Is_24_Hour'
        ];

        public function validate($data){
            $this->errors = [];

            if(empty($this->errors)){
                return true;
            }
            return false;
        }
    }
?>