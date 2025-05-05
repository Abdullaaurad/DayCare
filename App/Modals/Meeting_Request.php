<?php

    namespace Modal;

    defined('ROOTPATH') or exit('Access Denied!');

    class Meeting_Request{
        use Modal;

        protected $table = 'meeting_request ';
        protected $allowedColumns = [
            'Name',
            'NIC',
            'Email',
            'PhoneNumber'
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