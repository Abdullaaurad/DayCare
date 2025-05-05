<?php

    namespace Modal;

    defined('ROOTPATH') or exit('Access Denied!');

    class Receptionist{
        use Modal;

        protected $table = 'receptionist';
        protected $allowedColumns = [
            'Last_Name',
            'First_Name',
            'Image',
            'ImageType',
            "Phone_Number",
            "Address",
            "Email",
            "NID",
            "Gender",
            "Language",
            "Last_Seen",
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