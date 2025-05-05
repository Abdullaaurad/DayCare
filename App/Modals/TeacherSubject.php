<?php

    namespace Modal;

    defined('ROOTPATH') or exit('Access Denied!');

    class TeacherSubject{
        use Modal;

        protected $table = 'teacher_subject';
        protected $allowedColumns = [
            'teacher_id',
            'subject_id',
            'is_main_teacher',
            'assigned_date'
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