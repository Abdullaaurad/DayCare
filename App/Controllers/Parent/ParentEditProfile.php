<?php

    namespace Controller;
    use App\Helpers\ChildHelper;

    defined('ROOTPATH') or exit('Access denied');

    class ParentEditProfile{
        use MainController;
        public function index(){

            $session = new \Core\Session;
             
            $data = $this->store_data();
            $this->view('Parent/parenteditprofile', $data);
        }

        private function store_data(){
            $session = new \Core\Session;
             
            $data = [];
            $session = new \core\Session;
            $ParentModal = new \Modal\ParentUser;
            $UserModal = new \Modal\User;
            $UserID = $session->get("USERID");
        
            $User = $UserModal->first(["UserID" => $UserID]);
            $Parent = $ParentModal->first(["UserID" => $UserID]);
        
            if ($Parent) { // Check if Parent is not null
                $imageData = $Parent->Image;
                $imageType = $Parent->ImageType;
                $base64Image = (!empty($imageData) && is_string($imageData)) 
                    ? 'data:' . $imageType . ';base64,' . base64_encode($imageData) 
                    : null;
        
                $Parent->Image = $base64Image;
                $Parent->Username = $User->Username;
                $formattedID = str_pad($Parent->ParentID, 5, '0', STR_PAD_LEFT);
                $Parent->ParentID = "PRE" . $formattedID;
                $ChildHelper = new ChildHelper();
                $Parent->childcount = $ChildHelper->child_count();
                $data = (array) $Parent;
            }
        
            return $data;
        }

        public function update() {
            $session = new \Core\Session;
             
            $data = [
                "First_Name" => $_POST['First_Name'] ?? '',
                "Last_Name" => $_POST['Last_Name'] ?? '',
                "Gender" => $_POST['Gender'] ?? '',
                "Language" => $_POST['Language'] ?? '',
                "Address" => $_POST['Address'] ?? '',
                "NID" => $_POST['NID']?? ''
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
        
            $Pre = new \Modal\ParentUser;
            $Parent = $Pre->first(['UserID' => $UserID]);
        
            if ($Parent) {
                $Pre->update(["ParentID" => $Parent->ParentID], $data);
            }
        
            redirect("Parent/ParentProfile");
        }        
    }
?>