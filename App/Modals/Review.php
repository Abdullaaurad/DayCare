<?php

    namespace Modal;

    defined('ROOTPATH') or exit('Access Denied!');

    class Review{
        use Modal;

        protected $table = 'review';
        protected $allowedColumns = [
            'Res_Id',
            'Reason',
            'Review',
            'Stars'
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