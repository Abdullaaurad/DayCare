<?php

    namespace Modal;

    defined('ROOTPATH') or exit('Access Denied!');

    class Maid_leave{
        use Modal;

        protected $table = 'maid_leave';
        protected $allowedColumns = [
            'LeaveID',
            'MaidID',
            'Leave_Type',
            'Start_Date',
            'End_Date',
            'Duration',
            'Description',
            'Status'
        ];

        public function validate($data) {
            $this->errors = [];        
            // Validate Leave Type
            if (empty($data['Leave_Type'])) {
                $this->errors['Leave_Type'] = 'Leave type is required';
            }
            // Validate Start Date
            if (empty($data['Start_Date'])) {
                $this->errors['Start_Date'] = 'Start date is required';
            } elseif (!strtotime($data['Start_Date'])) {
                $this->errors['Start_Date'] = 'Invalid date format';
            }elseif(strtotime($data['Start_Date']) <= strtotime(date('Y-m-d'))){
                $this->errors['Start_Date'] = 'Start date must be a date after today';
            }
            // Validate End Date
            if (empty($data['End_Date'])) {
                $this->errors['End_Date'] = 'End date is required';
            } elseif (!strtotime($data['End_Date'])) {
                $this->errors['End_Date'] = 'Invalid date format';
            } elseif (strtotime($data['End_Date']) < strtotime($data['Start_Date'])) {
                $this->errors['End_Date'] = 'End date must be after start date';
            }
        
            // Validate Description
            if (empty($data['Description'])) {
                $this->errors['Description'] = 'Leave description is required';
            } elseif (strlen($data['Description']) < 10) {
                $this->errors['Description'] = 'Description must be at least 10 characters long';
            }
            return empty($this->errors);
        }


        public function requestLeave($TeacherID){
            $query = "SELECT Duration  From {$this->table} where TeacherID = :TeacherID";
            $params = [
                'TeacherID' => $TeacherID
            ];
            $result = $this->query($query, $params);
            if($result){
                return $result[0]['LeaveType'];
            }
            return false;
        }
    }
?>