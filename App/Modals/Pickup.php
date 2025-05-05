<?php

    namespace Modal;

    defined('ROOTPATH') or exit('Access Denied!');

    class Pickup{
        use Modal;

        protected $table = 'pickup';
        protected $allowedColumns = [
            'ChildID',
            'Date',
            'Time',
            'Person',
            'OTP',
            'Description',
            'Image',
            'ImageType',
            'AllChild',
            'NID'
        ];

        public function validate($data){
            $this->errors = [];
        
            if (isset($data['Time'])) {
                $inputTime = strtotime($data['Time']);
                $startTime = strtotime('08:00');
                $endTime = strtotime('20:00');
        
                if ($inputTime === false) {
                    $this->errors['Time'] = "Invalid time format.";
                } elseif ($inputTime < $startTime || $inputTime > $endTime) {
                    $this->errors['Time'] = "Time must be between 8:00 AM and 8:00 PM.";
                }
            } else {
                $this->errors['Time'] = "Time is required.";
            }
        
            return empty($this->errors);
        }        
    }
?>