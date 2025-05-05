<?php

    namespace Modal;

    defined('ROOTPATH') or exit('Access Denied!');

    class TimeSlot{
        use Modal;

        protected $table = 'timeslots';
        protected $allowedColumns = [
            'SlotID',
            'DoctorID',
            'Slot_Date',
            'Start_Time',
            'End_Time',
            'Status'
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