<?php

    namespace Modal;

    defined('ROOTPATH') or exit('Access Denied!');

    class Expense{
        use Modal;

        protected $table = 'Expense';
        protected $allowedColumns = [
            'UpdatedDate',
            'ChildID',
            'Amount',
            'Description',
            'Date',
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