<?php

    namespace Modal;

    defined('ROOTPATH') or exit('Access Denied!');

    class Visitorlog{
        use Modal;

        protected $table = 'visitor';
        protected $allowedColumns = [
            'FirstName',
            'LastName',
            'Role',
            'Start_time',
            'End_time',
            'Purpose'
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