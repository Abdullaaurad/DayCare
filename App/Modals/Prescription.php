<?php

    namespace Modal;

    defined('ROOTPATH') or exit('Access Denied!');

    class Prescription{
        use Modal;

        protected $table = 'prescriptions';
        protected $allowedColumns = [
            'AppointmentID',
            'Medication_Name',
            'Dosage',
            'Frequency',
            'Route_of_Administration',
            'Issued_At',
            'DoctorID'
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