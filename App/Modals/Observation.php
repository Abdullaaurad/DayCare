<?php

    namespace Modal;

    defined('ROOTPATH') or exit('Access Denied!');

    class Observation{
        use Modal;

        protected $table = 'observations';
        protected $allowedColumns = [
            'StudentID',
            'TeacherID',
            'Scored_Date'
           
        ];

        public function validate($data) {
            $this->errors = [];
        
            if (empty($data['Team Work']) && empty($data['Communicaiton']) && empty($data['Critical Thinking']) && empty($data['Emotional Control']) && empty($data['Self Care'])) {
                $this->errors['error'] = 'At least one skill is required';
            }
            //var_dump($this->errors);
            return empty($this->errors);    
        }
        
    
    }
?>