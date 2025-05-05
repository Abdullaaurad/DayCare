<?php

    namespace Modal;

    defined('ROOTPATH') or exit('Access Denied!');

    class ParentUser{
        use Modal;

        protected $table = 'parent';
        protected $allowedColumns = [
            'UserID',
            'Last_Name',
            'First_Name',
            'Phone_Number',
            'Address',
            'NID',
            'Email',
            'Gender',
            'Language',
            'Last_Seen',
            'Image',
            'ImageType'
        ];

        public function validate() {
            $errors = [];
        
            if (!isString($_POST['First_Name'])) {
                $errors['First_Name'] = "First Name must be a valid string";
            }
        
            if (!isString($_POST['Last_Name'])) {
                $errors['Last_Name'] = "Last Name must be a valid string";
            }
        
            if (!isNumber($_POST['NID']) || strlen($_POST['NID']) != 12) {
                $errors['NID'] = "NID must be a 12-digit valid number";
            }
        
            if (!isEmail($_POST['Email'])) {
                $errors['Email'] = "Email is not valid";
            }
        
            if (!isNumber($_POST['Phone_Number']) || strlen($_POST['Phone_Number']) != 10) {
                $errors['Phone_Number'] = "Phone Number must be a 10-digit valid number";
            }
        
            if (!in_array($_POST['Gender'], ['M', 'F'])) {
                $errors['Gender'] = "Gender must be either 'M' or 'F'";
            }
        
            return $errors;
        }        

        public function findById($id) {
            $sql = "SELECT * FROM parent WHERE UserID = :id LIMIT 1";
            $data = ['id' => $id];
            
            $result = $this->query($sql, $data);
            if ($result) {
                return $result[0]; // Return the first row
            }
            return false;
        }
    }

?>