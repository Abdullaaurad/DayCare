<?php

    namespace Modal;

    defined('ROOTPATH') or exit('Access Denied!');

    class Enrollments{
        use Modal;

        protected $table = 'child';
        protected $allowedColumns = [
            'ChildID',
            'EnrollDate'
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