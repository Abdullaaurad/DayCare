<?php

    namespace Controller;

    defined('ROOTPATH') or exit('Access denied');

    class ChildProfile{
        use MainController;
        public function index(){

            $session = new \Core\Session;
             
            $data = [];

            $session = new \core\Session;
            $ChildID = $session->get("CHILDID");

            $child = new \Modal\Child;
            $childdocumentModal = new \Modal\ChildDocuments;
            $childmedicationModal = new \Modal\ChildMedication;
            $ParentModal = new \Modal\ParentUser;

            $data['children'] = $child->first(["ChildID"=> $ChildID]);
            $Parent = $ParentModal->first(["ParentID" => $data['children']->ParentID]);

            $data['children']->Email = $Parent->Email;
            $data['children']->Phone_Number = $Parent->Phone_Number;
            $imageData = $data['children']->Image;
            $imageType = $data['children']->ImageType;  // Get the image MIME type from the database
    
            // If image data is available, construct the Base64 string using the correct MIME type
            $base64Image = (!empty($imageData) && is_string($imageData))
                ? 'data:' . $imageType . ';base64,' . base64_encode($imageData)
                : null
            ;

            $data['children']->Image = $base64Image;

            $data['medications'] = $childmedicationModal->where_norder(["ChildID" => $ChildID]);
            if(!empty($data['documents'])){
                foreach ($data['medications'] as $medication){
                    $imageData = $medication->MedicationImage;
                    $imageType = $medication->ImageType;  // Get the image MIME type from the database
            
                    // If image data is available, construct the Base64 string using the correct MIME type
                    $base64Image = (!empty($imageData) && is_string($imageData))
                        ? 'data:' . $imageType . ';base64,' . base64_encode($imageData)
                        : null
                    ;

                    $medication->MedicationImage = $base64Image;
                }
            }
            
            $data['documents'] = $childdocumentModal->where_norder(["ChildID" => $ChildID]);
            if(!empty($data['documents'])){
                foreach ($data['documents'] as $document){
                    $imageData = $document->UploadedFile;
                    $imageType = $document->FileType;  // Get the image MIME type from the database
            
                    // If image data is available, construct the Base64 string using the correct MIME type
                    $base64Image = (!empty($imageData) && is_string($imageData))
                        ? 'data:' . $imageType . ';base64,' . base64_encode($imageData)
                        : null
                    ;

                    $document->UploadedFile = $base64Image;
                }
            }

            $this->view('Child/childprofile',$data);
        }
    }
?>