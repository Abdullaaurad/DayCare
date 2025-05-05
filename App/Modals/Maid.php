<?php

    namespace Modal;

    defined('ROOTPATH') or exit('Access Denied!');

    class Maid{
        use Modal;

        protected $table = 'maid';
        protected $allowedColumns = [
            'UserID',
            'MaidID',
            'Last_Name',
            'First_Name',
            'Phone_Number',
            'Address',
            'NID',
            'Language',
            'Last_Seen',
            'Age_Group',
            'Image',
            
            
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