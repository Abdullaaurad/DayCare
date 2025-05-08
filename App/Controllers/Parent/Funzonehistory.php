<?php

    namespace Controller;
    use App\Helpers\SidebarHelper;

    defined('ROOTPATH') or exit('Access denied');

    class FunzoneHistory{
        use MainController;
        public function index(){
            $session = new \Core\Session;
             
            $session->check_login();
    
            $data = [];
            $SidebarHelper = new SidebarHelper();
            $data = $SidebarHelper->store_sidebar();

            $data['test'] = $this->lol();
            $this->view('Parent/funzonehistory', $data);
        }

        public function lol() {
            $session = new \Core\Session;
             
            $type = $requestData['type'] ?? 'All';
            $filterDate = $requestData['Date'] ?? null; // Date from request
            
            $Session = new \core\session;
            $UserID = $Session->get("USERID");
        
            $MediaModal = new \Modal\Media;
            $TeacherModal = new \Modal\Teacher;
            $WhishlistModal = new \Modal\MediaHistory;
            $ParentModal = new \Modal\ParentUser;
            $ChildModal = new \Modal\Child;
        
            $parent = $ParentModal->first(["UserID"=> $UserID]);
            $Children = $ChildModal->where_norder(["ParentID" => $parent->ParentID]);
        
            $Data = []; // Initialize an empty array to store all media history
        
            foreach ($Children as $Child) {
                $Data2 = $WhishlistModal->where_order_desc(["ChildID" => $Child->ChildID]); 
                if($Data2){
                    foreach ($Data2 as &$row) {
                        $row->ChildName = $Child->First_Name; // Add corresponding child's first name
                    }
                    $Data = array_merge($Data, $Data2);
                }
                 // Correctly merge data
            }
        
            // Sort Data by DateTime (most recent first)
            usort($Data, function ($a, $b) {
                return strtotime($b->DateTime) - strtotime($a->DateTime); 
            });
        
            $groupedData = [];
        
            foreach ($Data as &$row) {
                if ($type !== 'All') {
                    $Media = $MediaModal->first(["MediaID" => $row->MediaID, "MediaType" => $type]);
                } else {
                    $Media = $MediaModal->first(["MediaID" => $row->MediaID]);
                }
        
                if ($Media) {
                    $Teacher = $TeacherModal->first(["TeacherID" => $Media->UserID]);
                    $row->User = $Teacher ? ($Teacher->First_Name . ' ' . $Teacher->Last_Name) : '';
        
                    $row->MediaType = $Media->MediaType ?? '';
                    $row->URL = $Media->URL ?? '';
                    $row->ImageType = $Media->ImageType ?? '';
        
                    $row->Image = !empty($Media->ImageData) ? 'data:' . $Media->ImageType . ';base64,' . base64_encode($Media->ImageData) : '';
        
                    $row->Title = $Media->Title ?? '';
                    $row->Description = $Media->Description ?? '';
                    $row->Format = $Media->Format ?? '';
        
                    // Extract and format date
                    $date = date("Y-m-d", strtotime($row->DateTime));
        
                    // Apply the date filter if provided
                    if ($filterDate && $date !== $filterDate) {
                        continue; // Skip if the date does not match
                    }
        
                    // Format date for grouping
                    if ($date == date("Y-m-d")) {
                        $formattedDate = "Today";
                    } elseif ($date == date("Y-m-d", strtotime("-1 day"))) {
                        $formattedDate = "Yesterday";
                    } elseif (date("Y", strtotime($date)) == date("Y")) {
                        $formattedDate = date("M d", strtotime($date)); // Example: Jan 02
                    } else {
                        $formattedDate = date("Y/m/d", strtotime($date)); // Example: 2024/12/01
                    }
        
                    $groupedData[$formattedDate][] = $row;
                }
            }
        
            $groupedData['selected_date'] = $filterDate;
            return $groupedData;
        }        

        public function store_media() {
            $session = new \Core\Session;
             
            header('Content-Type: application/json');
            $requestData = json_decode(file_get_contents("php://input"), true);
            
            $type = $requestData['type'] ?? 'All';
            $filterDate = $requestData['Date'] ?? null; // Date from request
            
            $Session = new \core\session;
            $UserID = $Session->get("USERID");
        
            $MediaModal = new \Modal\Media;
            $TeacherModal = new \Modal\Teacher;
            $WhishlistModal = new \Modal\MediaHistory;
            $ParentModal = new \Modal\ParentUser;
            $ChildModal = new \Modal\Child;
        
            $parent = $ParentModal->first(["UserID"=> $UserID]);
            $Children = $ChildModal->where_norder(["ParentID" => $parent->ParentID]);
        
            $Data = []; // Initialize an empty array to store all media history
        
            foreach ($Children as $Child) {
                $Data2 = $WhishlistModal->where_order_desc(["ChildID" => $Child->ChildID]); 
                if($Data2){
                    foreach ($Data2 as &$row) {
                        $row->ChildName = $Child->First_Name; // Add corresponding child's first name
                    }
                    $Data = array_merge($Data, $Data2);
                }
                 // Correctly merge data
            }
            
            // Sort Data by DateTime (most recent first)
            usort($Data, function ($a, $b) {
                return strtotime($b->DateTime) - strtotime($a->DateTime); 
            });
        
            $groupedData = [];
        
            foreach ($Data as &$row) {
                if ($type !== 'All') {
                    $Media = $MediaModal->first(["MediaID" => $row->MediaID, "MediaType" => $type]);
                } else {
                    $Media = $MediaModal->first(["MediaID" => $row->MediaID]);
                }
        
                if ($Media) {
                    $Teacher = $TeacherModal->first(["TeacherID" => $Media->UserID]);
                    $row->User = $Teacher ? ($Teacher->First_Name . ' ' . $Teacher->Last_Name) : '';
        
                    $row->MediaType = $Media->MediaType ?? '';
                    $row->URL = $Media->URL ?? '';
                    $row->ImageType = $Media->ImageType ?? '';
        
                    $row->Image = !empty($Media->ImageData) ? 'data:' . $Media->ImageType . ';base64,' . base64_encode($Media->ImageData) : '';
        
                    $row->Title = $Media->Title ?? '';
                    $row->Description = $Media->Description ?? '';
                    $row->Format = $Media->Format ?? '';
        
                    // Extract and format date
                    $date = date("Y-m-d", strtotime($row->DateTime));
        
                    // Apply the date filter if provided
                    if ($filterDate && $date !== $filterDate) {
                        continue; // Skip if the date does not match
                    }
        
                    // Format date for grouping
                    if ($date == date("Y-m-d")) {
                        $formattedDate = "Today";
                    } elseif ($date == date("Y-m-d", strtotime("-1 day"))) {
                        $formattedDate = "Yesterday";
                    } elseif (date("Y", strtotime($date)) == date("Y")) {
                        $formattedDate = date("M d", strtotime($date)); // Example: Jan 02
                    } else {
                        $formattedDate = date("Y/m/d", strtotime($date)); // Example: 2024/12/01
                    }
        
                    $groupedData[$formattedDate][] = $row;
                }
            }
        
            $groupedData['selected_date'] = $filterDate;
        
            if (empty($groupedData)) {
                echo json_encode(['success' => true, 'message' => 'No events found for the selected filters']);
            } else {
                echo json_encode(['success' => true, 'data' => $groupedData]);
            }
        }
        

        public function setchildsession()
        {
            $session = new \Core\Session;
             
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
             
            $session = new \core\Session();
            $session->logout();

            echo json_encode(["success" => true]);
            exit;
        }
    }
?>