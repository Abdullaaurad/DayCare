<?php

    namespace Controller;

    defined('ROOTPATH') or exit('Access denied');

    class GuardianEditProfile{
        use MainController;
        public function index(){

            $session = new \Core\Session;
             
            $data = $this->store_data();
            $this->view('Parent/guardianeditprofile', $data);
        }

        private function store_data(){
            $session = new \Core\Session;
             
            $data = [];
            $session = new \core\Session;
            $ParentModal = new \Modal\ParentUser;
            $GuardianModal = new \Modal\Guardian;
            $UserID = $session->get("USERID");
        
            $Parent = $ParentModal->first(["UserID" => $UserID]);
            $Guardian = $GuardianModal->first(["ParentID" => $Parent->ParentID]);
        
            if ($Guardian) {
                $imageData = $Guardian->Image;
                $imageType = $Guardian->ImageType;
                $base64Image = (!empty($imageData) && is_string($imageData)) 
                    ? 'data:' . $imageType . ';base64,' . base64_encode($imageData) 
                    : null;
        
                $Guardian->Image = $base64Image;
                $data = (array) $Guardian;
            }
        
            return $data;
        }

        public function update() {
            $session = new \Core\Session;
             
            
            $data = [
                "First_Name" => $_POST['First_Name'] ?? '',
                "Lirst_Name" => $_POST['Lirst_Name'] ?? '',
                "Gender" => $_POST['Gender'] ?? '',
                "Language" => $_POST['Language'] ?? '',
                "Address" => $_POST['Address'] ?? '',
                "Email" => $_POST['Email'] ?? '',
                "Phone_Number" => $_POST['Phone_Number'] ?? '',
                "NID" => $_POST['NID'] ?? ''
            ];
        
            // Remove empty fields
            $data = array_filter($data, function ($value) {
                return !empty($value);
            });
        
            // Process image if uploaded
            if (!empty($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $imageFile = $_FILES['image'];
                $imageType = mime_content_type($imageFile['tmp_name']);
        
                // Read raw binary image data
                $imageBlob = file_get_contents($imageFile['tmp_name']);
        
                if ($imageBlob !== false) {
                    $data['Image'] = $imageBlob;  // Store as raw binary (BLOB)
                    $data['ImageType'] = $imageType;
                } else {
                    $errors['Image'] = "Failed to read the image file.";
                }
            }
        
            $session = new \core\Session;
            $UserID = $session->get("USERID");
        
            $GuardianModal = new \Modal\Guardian;
            $ParentModal = new \Modal\ParentUser;
            $pre = $ParentModal->first(["UserID" => $UserID]);
            $Parent = $GuardianModal->first(['ParentID' => $pre->ParentID]);
        
            if ($Parent) {
                $GuardianModal->update(["ParentID" => $pre->ParentID], $data);
            }
        
            redirect("Parent/GuardianProfile");
        }   
    }
?>