<?php

    namespace Controller;
    use App\Helpers\ChildHelper;

    defined('ROOTPATH') or exit('Access denied');

    class ParentProfile{
        use MainController;
        public function index(){

            $data = $this->store_data();
            $this->view('Child/parentprofile', $data);
        }

        private function store_data(){
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
    }
?>