<?php

    namespace Modal;

    defined('ROOTPATH') or exit('Access Denied!');

    class Task{
        use Modal;

        protected $table = 'assignteacher';
        protected $allowedColumns = [
            'TeacherID',
            'Date',
            'Start_Time',
            'End_Time',
            'AgeGroup',
            'Activity'
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