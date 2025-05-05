<?php

    namespace Modal;

    defined('ROOTPATH') or exit('Access Denied!');

    class AssignMaid{
        use Modal;

        protected $table = 'assignmaid';
        protected $allowedColumns = [
            'MaidID',
            'ChildID',
            'Date',
            'AgeGroup',
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