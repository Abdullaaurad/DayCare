<?php

    namespace Controller;
    use App\Helpers\SidebarHelper;

    defined('ROOTPATH') or exit('Access denied');

    class FunzoneWhishlist{
        use MainController;
        public function index(){
            $session = new \Core\Session;
            $session->check_login();
            $session = new \Core\Session;
            $session->set("USERID", 1);
    
            $data = [];
            $SidebarHelper = new SidebarHelper();
            $data = $SidebarHelper->store_sidebar();

            $this->view('Parent/funzonewhishlist', $data);
        }
        
        public function store_media(){
            $session = new \Core\Session;
            $session->set("USERID", 1);
            header('Content-Type: application/json');
            $requestData = json_decode(file_get_contents("php://input"), true);
            
            $type = $requestData['type']?? 'All';
            $Session = new \core\session;
            $ChildModal = new \Modal\Child;
            $ParentModal = new \Modal\ParentUser;
            $WhishlistModal = new \Modal\MediaWhishlist;
            $MediaModal = new \Modal\Media;
            
            $UserID = $Session->get("USERID");
            $Parent = $ParentModal->first(["UserID" => $UserID]);
            $Children = $ChildModal->where_norder(["ParentID" => $Parent->ParentID]);
            
            $Data = [];
            
            foreach ($Children as $Child) {
                $ChildData = $WhishlistModal->where_order_desc(["ChildID" => $Child->ChildID]);
                if (!empty($ChildData)) {
                    foreach ($ChildData as &$row) {
                        $Media = ($type !== 'All') 
                            ? $MediaModal->first(["MediaID" => $row->MediaID, "MediaType" => $type]) 
                            : $MediaModal->first(["MediaID" => $row->MediaID]);
                        
                        if ($Media) {
                            $mediaItem = [
                                "MediaType" => !empty($Media->MediaType) ? $Media->MediaType : '',
                                'Date' => !empty($row->Date) ? $row->Date : '',
                                "Time" => !empty($row->Time) ? $row->Time : '',
                                "URL" => !empty($Media->URL) ? $Media->URL : '',
                                "Image" => !empty($Media->Image) ? $Media->Image : '',
                                "ImageType" => !empty($Media->ImageType) ? $Media->ImageType : '',
                                "MediaID" => !empty($Media->MediaID) ? $Media->MediaID : '',
                                "WhishlistID" => !empty($Media->WhishlistID) ? $Media->WhishlistID : '',
                                "Title" => !empty($Media->Title) ? $Media->Title : '',
                                "Description" => !empty($Media->Description) ? $Media->Description : '',
                                "Format" => !empty($Media->Format) ? $Media->Format : '',
                                "ChildName" => $Child->First_Name
                            ];
                            
                            $base64Image = (!empty($mediaItem["Image"]) && is_string($mediaItem["Image"]))
                                ? 'data:' . $mediaItem["ImageType"] . ';base64,' . base64_encode($mediaItem["Image"])
                                : null;
                            $mediaItem["Image"] = $base64Image;
                            
                            $Data[] = $mediaItem;
                        }
                    }
                }
            }

            $Data = array_filter($Data);
            $Data = array_values($Data);

            usort($Data, function ($a, $b) {
                $dateTimeA = strtotime(($a['Date'] ?? '') . ' ' . ($a['Time'] ?? ''));
                $dateTimeB = strtotime(($b['Date'] ?? '') . ' ' . ($b['Time'] ?? ''));
            
                return $dateTimeB - $dateTimeA; // Sort descending (newest first)
            });            
            
            if (empty($Data)) {
                echo json_encode(['success' => true, 'message' => 'No events found for the selected filters']);
            } else {
                echo json_encode(['success' => true, 'data' => $Data]);
            }
        }       

        public function delete_Reminder(){
            $session = new \Core\Session;
            $session->set("USERID", 1);
            header('Content-Type: application/json');
            $requestData = json_decode(file_get_contents("php://input"), true);

            $Session = new \core\session;
            $ReminderModal = new \Modal\MediaReminder;
            $WhishlistModal = new \Modal\MediaWhishlist;
            $ChildID = $Session->get("CHILDID");

            if (isset($requestData['WhishlistID'])) {
                $WhishlistID = $requestData['WhishlistID'];
                $Whish = $WhishlistModal->first(['WishlistID' => $WhishlistID]);
                $Reminder = $ReminderModal->first(["MediaID" => $Whish->MediaID, "ChildID" => $ChildID]);
                $WhishlistModal->update(["WishlistID" => $WhishlistID], ["Reminder" => 0]);


                $ReminderModal->delete($Reminder->ReminderID, "ReminderID");
                echo json_encode(['success' => true, 'message' => $WhishlistID]);
            } else {
                echo json_encode(['success' => false, 'message' => 'WishlistID not provided']);
            }
        }
        
        public function AddReminders(){
            $session = new \Core\Session;
            $session->set("USERID", 1);
            $Session = new \core\session;
            $ChildID = $Session->get("CHILDID");

            $WhishlistModal = new \Modal\MediaWhishlist;
            $WhishlistModal->update(["WishlistID" => $_POST['WhishlistID']], ["Reminder" => 1]);

            $Whish = $WhishlistModal->first(['WishlistID' => $_POST['WhishlistID']]);
            $_POST['MediaID'] = $Whish->MediaID;
            $_POST['ChildID'] = $ChildID;

            $ReminderModal = new \Modal\MediaReminder;
            unset($_POST['WhishlistID']);
            $ReminderModal->insert($_POST);
            redirect("Child/FunzoneWhishlist");
        }
        
        public function delete_whish() {
            $session = new \Core\Session;
            $session->set("USERID", 1);
            header('Content-Type: application/json');
        
            // Read the raw POST data
            $requestData = json_decode(file_get_contents("php://input"), true);
            
            // Make sure WishlistID is received
            if (isset($requestData['WishlistID'])) {
                $WishlistID = $requestData['WishlistID'];
                $WhishlistModal = new \Modal\MediaWhishlist;
                $WhishlistModal->delete($WishlistID, "WishlistID");
        
                echo json_encode(['success' => true, 'message' => 'Wishlist item deleted', 'WhishlistID' => $WishlistID]);
            } else {
                echo json_encode(['success' => false, 'message' => 'WishlistID not provided']);
            }
        }        

        public function setchildsession()
        {
            $session = new \Core\Session;
            $session->set("USERID", 1);
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            header('Content-Type: application/json');
            $request = json_decode(file_get_contents('php://input'), true);
            $response = [];

            $session = new \Core\Session;
            if (isset($request['ChildID'])) {
                $session->set('CHILDID', $request['ChildID']);
                $response = ['success' => true, 'message' => 'Child session removed.'];
            } else {
                $response = ['success' => false, 'message' => 'No child session to remove.'];
            }

            echo json_encode($response);
            exit();
        }

        public function Logout(){
            $session = new \Core\Session;
            $session->set("USERID", 1);
            $session = new \core\Session();
            $session->logout();

            echo json_encode(["success" => true]);
            exit;
        }
    }
?>