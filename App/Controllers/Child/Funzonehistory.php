<?php

    namespace Controller;
    use App\Helpers\SidebarHelper;

    defined('ROOTPATH') or exit('Access denied');

    class FunzoneHistory{
        use MainController;
        public function index(){
            $session = new \Core\Session;
            $session->set("USERID", 1);
            $session = new \Core\Session;
            $session->check_login();
            $session->check_child('Parent');
            $ChildID = $session->get('CHILDID');
    
            $data = [];
            $SidebarHelper = new SidebarHelper();
            $data = $SidebarHelper->store_sidebar();
    
            $ChildModal = new \Modal\Child;
            $select = $ChildModal->first(['ChildID' => $ChildID]);
            $data['child_id'] = $ChildID;
    
            if (!empty($select)) {
                $data2 = $this->selectedchild($select);
                $data = $data + $data2;
            }

            $this->view('Child/funzonehistory', $data);
        }    

        public function store_media(){
            $session = new \Core\Session;
            $session->set("USERID", 1);
            header('Content-Type: application/json');
            $requestData = json_decode(file_get_contents("php://input"), true);
            
            $type = $requestData['type'] ?? 'All';
            $filterDate = $requestData['Date'] ?? null; // Date from request
            $Session = new \core\session;
            $ChildID = $Session->get("CHILDID");
        
            $MediaModal = new \Modal\Media;
            $TeacherModal = new \Modal\Teacher;
            $WhishlistModal = new \Modal\MediaHistory;
            $MediaModal = new \Modal\Media;
            $Data = $WhishlistModal->where_order_desc(["ChildID" => $ChildID]);
            $Data = array_reverse($Data);
        
            $groupedData = [];
        
            foreach ($Data as &$row) {

                if ($type !== 'All') {
                    $Media = $MediaModal->first(["MediaID" => $row->MediaID, "MediaType" => $type]);
                } else {
                    $Media = $MediaModal->first(["MediaID" => $row->MediaID]);
                }

                $Teacher = $TeacherModal->first(["TeacherID" => $Media->UserID]);
                $row->User = $Teacher->First_Name . ' ' . $Teacher->Last_Name;
        
                if ($Media) {
                    $row->MediaType = !empty($Media->MediaType) ? $Media->MediaType : '';
                    $row->URL = !empty($Media->URL) ? $Media->URL : '';
                    $row->ImageType = !empty($Media->ImageType) ? $Media->ImageType : '';
        
                    $base64Image = (!empty($Media->ImageData) && is_string($Media->ImageData))
                        ? 'data:' . $row->ImageType . ';base64,' . base64_encode($row->Image)
                        : null;
        
                    $row->Image = !empty($base64Image) ? $base64Image : '';
        
                    $row->Title = !empty($Media->Title) ? $Media->Title : '';
                    $row->Description = !empty($Media->Description) ? $Media->Description : '';
                    $row->Format = !empty($Media->Format) ? $Media->Format : '';
        
                    // Convert and format date
                    $date = date("Y-m-d", strtotime($row->DateTime));
        
                    // Apply the date filter if a filterDate is provided
                    if ($filterDate && $date !== $filterDate) {
                        continue; // Skip if the date does not match
                    }
        
                    // Format date for grouping
                    if ($date == date("Y-m-d")) {
                        $formattedDate = "Today";
                    } elseif ($date == date("Y-m-d", strtotime("-1 day"))) {
                        $formattedDate = "Yesterday";
                    } elseif (date("Y", strtotime($date)) == date("Y")) {
                        $formattedDate = date("M d", strtotime($date)); // Jan 02
                    } else {
                        $formattedDate = date("Y/m/d", strtotime($date)); // 2024/12/01
                    }
        
                    $groupedData[$formattedDate][] = $row;
                }
            }

            uksort($groupedData, function ($a, $b) {
                return strtotime($b) - strtotime($a);
            });        

            $groupedData['selected_date'] = $filterDate;
        
            if (empty($groupedData)) {
                echo json_encode(['success' => true, 'message' => 'No events found for the selected filters']);
            } else {
                echo json_encode(['success' => true, 'data' => $groupedData]);
            }
        }

        
        private function selectedchild($selectedchild){
            $session = new \Core\Session;
            $session->set("USERID", 1);
            $data = [];

            $imageData = $selectedchild->Image;
            $imageType = $selectedchild->ImageType;

            // If image data is available, construct the Base64 string using the correct MIME type
            $base64Image = (!empty($imageData) && is_string($imageData))
                ? 'data:' . $imageType . ';base64,' . base64_encode($imageData)
                : null;

            $data['selectedchildren'] = [
                'fullname' => $selectedchild->First_Name . ' ' . $selectedchild->Last_Name,
                'name' => $selectedchild->First_Name,
                'image' => $base64Image,
                'age' => agecalculate($selectedchild->DOB),
                'language' => $selectedchild->Language,
                'religion' => $selectedchild->Religion,
                'id' => str_pad($selectedchild->ChildID, 5, '0', STR_PAD_LEFT),
            ];
            return $data;
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

        public function removechildsession()
        {
            $session = new \Core\Session;
            $session->set("USERID", 1);
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            header('Content-Type: application/json');
            $response = [];

            $session = new \Core\Session;
            $ChildID = $session->get("CHILDID");

            if (isset($ChildID)) {
                $session->unset("CHILDID");
                $response = ['success' => true, 'message' => 'Child session removed.'];
            } else {
                $response = ['success' => false, 'message' => 'No child session to remove.'];
            }

            echo json_encode($response);  // Send JSON response
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