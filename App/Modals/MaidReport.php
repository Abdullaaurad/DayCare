<?php

    namespace Modal;

    defined('ROOTPATH') or exit('Access Denied!');

    class MaidReport{
        use Modal;

        protected $table = 'maidreport';
        protected $allowedColumns = [
            'AttendanceID',
            'Viewed',
            'MaidID'
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