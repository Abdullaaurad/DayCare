<?php

    namespace Modal;

    defined('ROOTPATH') or exit('Access Denied!');

    class AddmissionMeeting{
        use Modal;

        protected $table = 'admissionmeeting';
        protected $allowedColumns = [
            'MeetingID',
            'name',
            'nic',
            'Time',
            'Date'
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