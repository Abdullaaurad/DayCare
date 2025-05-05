<?php

    namespace Modal;

    defined('ROOTPATH') or exit('Access Denied!');

    class MaidLeave{
        use Modal;

        protected $table = 'maid_leave';
        protected $allowedColumns = [
            'MaidID',
            'Duration',
            'Start_Date',
            'End_Date',
            'Description',
            'Leave_Type',
            'Status',
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