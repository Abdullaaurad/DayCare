<?php

    namespace Modal;

    defined('ROOTPATH') or exit('Access Denied!');

    class Visitor{
        use Modal;
        
        protected $table = 'visitor';
        protected $allowedColumns = [
            'VisitorID',
            'FirstName',
            'LastName',
            'NID',
            'Date',
            'Start_Time',
            'End_Time',
            'e_mail',
            'Role',
            'Purpose',
            'Phone_Number'
        ];
        
       
    public function __construct() {
        $this->order_column = 'VisitorID'; 
    }
    
   
    public function findFirstRecords() {
        $today = date('Y-m-d');
        $query = "SELECT * FROM $this->table WHERE `Date` = :today ORDER BY $this->order_column DESC LIMIT 4"; 
        
        return $this->query($query, ['today' => $today]);
    }

        
       
        public function validate($data){
            $this->errors = [];
            if (empty($data['FirstName'])) {
                $errors['FirstName'] = 'Name is required';
            }
            if (empty($data['NID'])) {
                $errors['FirstName'] = 'NID should provide';
            }
            if (empty($data['Phone_Number'])) {
                $errors['Phone_NUMBER'] = 'Phone Number is required';
            }
        
            if (empty($data['e_mail'])) {
                $errors['e_mail'] = 'Email is required';
            } elseif (!filter_var($data['e_mail'], FILTER_VALIDATE_EMAIL)) {
                $errors['e_mail'] = 'Invalid email format';
            }
    
            // var_dump($errors);
            // exit();
            if(empty($errors)){
                return true;
            }
            return false;
        }
    }
?>