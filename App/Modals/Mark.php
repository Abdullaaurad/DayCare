<?php

    namespace Modal;

    defined('ROOTPATH') or exit('Access Denied!');

    class Mark{
        use Modal;

        protected $table = 'report_marks';
        protected $allowedColumns = [
            'Report_ID',
            'Subject_ID',
            'Teacher_ID',
            'Marks',
            'Submitted_at'
           
        ];

        public function validate($mark){

            $this->errors = [];
    
            if (empty($mark['Marks'])) {
                $errors['mark'] = 'Mark is required';
            }
        
            if ($mark['Marks'] < 0 || $mark['Marks'] > 100) {
                $errors['range'] = 'Mark must be between 0 and 100';
                
    
            if(empty($this->errors)){
                return true;
            }
            return false;
        }

    
    }
}
?>