<?php

    namespace Modal;

    defined('ROOTPATH') or exit('Access Denied!');

    class Attendance{
        use Modal;

        protected $table = 'attendance';
        protected $allowedColumns = [
            'ChildID',
            'Start_Date',
            'Start_Time',
            'End_Date',
            'End_Time',
            'Pickup',
            'Status',
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