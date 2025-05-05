<?php

    namespace Modal;

    defined('ROOTPATH') or exit('Access Denied!');

    class Guardian{
        use Modal;

        protected $table = 'guardian';
        protected $allowedColumns = [
            'ParentID',
            'Last_Name',
            'First_Name',
            'Relation',
            'Phone_Number',
            'Language',
            'Address',
            'NID',
            'Email',
            'Gender',
            'Image',
        ];

        public function validate() {
            $errors = [];
        
            // First Name: must be non-empty and only letters, spaces, hyphens, apostrophes
            if (empty($_POST['First_Name']) || !preg_match("/^[a-zA-Z\s'-]+$/", $_POST['First_Name'])) {
                $errors['First_Name'] = "First Name must contain only letters.";
            }
        
            // Last Name: same as First Name
            if (empty($_POST['Last_Name']) || !preg_match("/^[a-zA-Z\s'-]+$/", $_POST['Last_Name'])) {
                $errors['Last_Name'] = "Last Name must contain only letters.";
            }
        
            // NID: must be numeric
            if (empty($_POST['NID']) || !is_numeric($_POST['NID'])) {
                $errors['NID'] = "NID must be a valid number.";
            }
        
            // Email
            if (empty($_POST['Email']) || !filter_var($_POST['Email'], FILTER_VALIDATE_EMAIL)) {
                $errors['Email'] = "Email is not valid.";
            }
        
            // Relation: only letters and spaces
            if (empty($_POST['Relation']) || !preg_match("/^[a-zA-Z\s'-]+$/", $_POST['Relation'])) {
                $errors['Relation'] = "Relation must contain only letters.";
            }
        
            return $errors;
        }        
    }
?>