<?php

    namespace Modal;

    defined('ROOTPATH') or exit('Access Denied!');

    class SnackRequest{
        use Modal;

        protected $table = 'snackrequest';
        protected $allowedColumns = [
            'ChildID',
            'SnackID',
            'Quantity',
            "Time",
            "Provide"
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