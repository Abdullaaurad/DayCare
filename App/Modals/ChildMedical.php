<?php

    namespace Modal;

    defined('ROOTPATH') or exit('Access Denied!');

    class ChildMedical{
        use Modal;

        protected $table = 'childmedical';
        protected $allowedColumns = [
            'ChildID',
            'DoctorID ',
            'Start_Time',
            'Diagnosis',
            'DateTime',
            'Notes'
            
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