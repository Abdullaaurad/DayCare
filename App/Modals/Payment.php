<?php

    namespace Modal;

    defined('ROOTPATH') or exit('Access Denied!');

    class Payment{
        use Modal;

        protected $table = 'payment';
        protected $allowedColumns = [
            'PaymentID',
            'DateTime',
            'Amount',
            'ChildID',
            'Mode',
           
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