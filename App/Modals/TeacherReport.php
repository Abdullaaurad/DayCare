<?php

    namespace Modal;

    defined('ROOTPATH') or exit('Access Denied!');

    class TeacherReport{
        use Modal;

        protected $table = 'teacherreport';
        protected $allowedColumns = [
            'Attendance_ID',
            'Maid_ID',
            'Viewed'
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