<?php

    namespace Modal;

    defined('ROOTPATH') or exit('Access Denied!');

    class ReceptionistLeave{
        use Modal;

        protected $table = 'receptionist_leave';
        protected $allowedColumns = [
            'LeaveID',
            'ReceptionistID',
            'Duration',
            'Start_Date',
            'End_Date',
            'Description',
            'Leave_Type',
            'Status',
            'RecID'
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