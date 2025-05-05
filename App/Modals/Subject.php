<?php

    namespace Modal;

    defined('ROOTPATH') or exit('Access Denied!');

    class Subject{
        use Modal;

        protected $table = 'subjects';
        protected $allowedColumns = [
            'Subject_ID ',
            'Subject_Name'

           
        ];

        public function validate($mark){

            $this->errors = [];
    
            
    
            if(empty($this->errors)){
                return true;
            }
            return false;
        }

    
    }

?>