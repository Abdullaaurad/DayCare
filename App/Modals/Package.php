<?php

    namespace Modal;

    defined('ROOTPATH') or exit('Access Denied!');

    class Package{
        use Modal;

        protected $table = 'package';
        protected $allowedColumns = [
            'PackageID',
            'Name',
            'Price',
            'Description',
            'Monday',
            'Tuesday',
            'Wedenessday',
            'Thursday',
            'Friday',
            'Saturday',
            'Sunday',
            'AgeGroup',
            'AllHours',
            'FoodAddons',
            'Everything'
        ];

        public function validate($data){
            $this->errors = [];

            if(empty($this->errors)){
                return true;
            }
            return false;
        }
        public function findById($id) {
            $sql = "SELECT * FROM package WHERE PackageID = :id LIMIT 1";
            $data = ['id' => $id];
            
            $result = $this->query($sql, $data);
            if ($result) {
                return $result[0]; // Return the first row
            }
            return false;
        }

    }
?>