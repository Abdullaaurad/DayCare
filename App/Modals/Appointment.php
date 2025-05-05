<?php

    namespace Modal;

    defined('ROOTPATH') or exit('Access Denied!');

    class Appointment{
        use Modal;

        protected $table = 'appointments';
        protected $allowedColumns = [
            'AppointmentID',
            'SlotID',
            'ChildID',
            'DoctorID',
            'Booked_At'
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