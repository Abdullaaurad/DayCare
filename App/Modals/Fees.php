<?php

    namespace Modal;

    defined('ROOTPATH') or exit('Access Denied!');

    class Fees{
        use Modal;

        protected $table = 'fees';
        protected $allowedColumns = [
            'Amount',
            'ChildID',
            'DueDate',
            'Status'
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