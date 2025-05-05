<?php

    namespace Modal;

    defined('ROOTPATH') or exit('Access Denied!');

    class Student{
        use Modal;

        protected $table = 'students';
        protected $allowedColumns = [
            'StudentID',
            'ChildID',
            'Last_Name',
            'First_Name',
            'Age',
            'Age_Group'
        ];

        public function validate($data){

            $this->errors = [];
    
            if (empty($arr['name'])) {
                $errors['name'] = 'Name is required';
            }
        
            if (empty($arr['email'])) {
                $errors['email'] = 'Email is required';
            } elseif (!filter_var($arr['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Invalid email format';
            }
    
            if(empty($this->errors)){
                return true;
            }
            return false;
        }
    
    
    }
?>