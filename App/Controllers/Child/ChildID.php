<?php

    namespace Controller;

    defined('ROOTPATH') or exit('Access denied');

    class ChildID{
        use MainController;
        public function index(){
            $session = new \Core\Session;
             
            $session = new \Core\Session;
            $ChildModal = new \Modal\Child;

            $session->check_login();
            $session->check_child();
            $ChildID = $session->get("CHILDID");

            $data['Child'] = $ChildModal->first(["ChildID" => $ChildID]);
            $imageData = $data['Child']->Image;
            $imageType = $data['Child']->ImageType;
            $base64Image = (!empty($imageData) && is_string($imageData)) 
                ? 'data:' . $imageType . ';base64,' . base64_encode($imageData) 
                : null;

            $data['Child']->Image = $base64Image;
            $data['Child']->fullname = $data['Child']->First_Name . ' ' . $data['Child']->Last_Name;

            $ParentModal = new \Modal\ParentUser;
            $Parent = $ParentModal->first(["ParentID" => $data['Child']->ParentID]);

            $data['Child'] -> Contact = $Parent->Phone_Number;
            $data['Child'] -> ChildID = str_pad($data['Child']->ChildID, 5, '0', STR_PAD_LEFT);

            $dob = new \DateTime($data['Child']->DOB); // Assuming $Child->DOB is a valid date string
            $currentYear = (new \DateTime())->format('Y');
            $startOfYear = new \DateTime("{$currentYear}-01-01");
    
            // Calculate the age as of January 1st of the current year
            $ageAtStartOfYear = $dob->diff($startOfYear)->y;
            $data['Child']->Age = $ageAtStartOfYear;
            
            $this->view('Child/ChildID',$data);
        }
    }
?>