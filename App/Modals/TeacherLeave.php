<?php

    namespace Modal;

    defined('ROOTPATH') or exit('Access Denied!');

    class TeacherLeave{
        use Modal;

        protected $table = 'teacher_leave';
        protected $allowedColumns = [
            'TeacherID',
            'Leave_Type',
            'Start_Date',
            'End_Date',
            'Duration',
            'Status',
            'Description'
        ];

        public function validate($data) {
            $this->errors = [];

            
        
            // Validate Leave Type
            if (empty($data['Leave_Type'])) {
                $this->errors['Leave_Type'] = 'Leave type is required';
            }
        
            // Validate Start Date
            if (empty($data['Start_Date'])) {
                $this->errors['Start_Date'] = 'Start date is required';
            } elseif (!strtotime($data['Start_Date'])) {
                $this->errors['Start_Date'] = 'Invalid date format';
            }elseif(strtotime($data['Start_Date']) < time()){
                $this->errors['Start_Date'] = 'Start date must be in the future';
            }
            
            
            // Validate End Date
            if (empty($data['End_Date'])) {
                $this->errors['End_Date'] = 'End date is required';
            } elseif (!strtotime($data['End_Date'])) {
                $this->errors['End_Date'] = 'Invalid date format';
            } elseif (strtotime($data['End_Date']) < strtotime($data['Start_Date'])) {
                $this->errors['End_Date'] = 'End date must be after start date';
            }
        
            // Validate Description
            if (empty($data['Description'])) {
                $this->errors['Description'] = 'Leave description is required';
            } elseif (strlen($data['Description']) < 10) {
                $this->errors['Description'] = 'Description must be at least 10 characters long';
            }

           
            return empty($this->errors);

            // echo "<pre>";
            // print_r($data); // Print the data being inserted
            // echo "</pre>";
            // exit;

           
        }
        
    

    }
?>