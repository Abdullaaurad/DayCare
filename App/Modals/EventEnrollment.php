<?php

    namespace Modal;

    defined('ROOTPATH') or exit('Access Denied!');

    class EventEnrollment{
        use Modal;

        protected $table = 'eventenrollment';
        protected $allowedColumns = [
            'ChildID',
            'EventID',
            'Reason',
            'Review',
            'Rating',
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