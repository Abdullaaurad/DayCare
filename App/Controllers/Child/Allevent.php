<?php

    namespace Controller;
    use App\Helpers\SidebarHelper;

    defined('ROOTPATH') or exit('Access denied');

    class Allevent{
        use MainController;
        public function index(){

            $session = new \Core\Session;
            $session->set("USERID", 1);
            $session = new \Core\Session;
            $session->check_login();
            $session->check_child();
            $ChildID = $session->get("CHILDID");

            $data = [];
            $SidebarHelper = new SidebarHelper();
            $data = $SidebarHelper->store_sidebar();

            $ChildModal = new \Modal\Child;
            $select = $ChildModal->first(['ChildID' => $ChildID ]);
            $data['child_id'] = $ChildID;

            if (!empty($select)) {
                $data2 = $this->selectedchild($select);
                $data = $data + $data2;
            }

            $session->set("Location" , 'Child/Allevent');
            $this->view('Child/allevent',$data);
        }

        private function selectedchild($selectedchild){
            $session = new \Core\Session;
            $session->set("USERID", 1);
            $data = [];

            // Retrieve the specific child's profile image and details

            $imageData = $selectedchild->Image;
            $imageType = $selectedchild->ImageType;  // Get the image MIME type from the database

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

        public function store_events() {
            $session = new \Core\Session;
            $session->set("USERID", 1);
            header('Content-Type: application/json');
        
            // Parse incoming JSON request
            $requestData = json_decode(file_get_contents("php://input"), true);
            $filterDate = $requestData['date'] ?? null;

            $session = new \core\session;
            $ChildID = $session->get("CHILDID");

            $ChildModal = new \Modal\Child;
            $child = $ChildModal->first(["ChildID"=> $ChildID]);

            $childDOB = $child->DOB ?? null;
        
            if (!$childDOB) {
                echo json_encode(['success' => false, 'message' => 'Child DOB is required']);
                return;
            }
        
            // Calculate the child's age as of the start of the year
            $currentYear = (new \DateTime())->format('Y');
            $startOfYear = new \DateTime("$currentYear-01-01");
            $dob = new \DateTime($childDOB);
            $childAge = $dob->diff($startOfYear)->y; // Calculate age in years
        
            // Get all events or filter by date if provided
            $EventModal = new \Modal\Event;
            $Events = $filterDate ? $EventModal->where_norder(["Date" => $filterDate]) : $EventModal->findall();
        
            $validAgeGroups = ['3-5', '6-9', '10-13'];
        
            // Filter events based on the child's age and allowed age groups
            $Events = array_filter($Events, function ($event) use ($childAge, $validAgeGroups) {
                if ($event->AgeGroup === 'All') {
                    return true; // Event is open to all age groups
                }
        
                if (!in_array($event->AgeGroup, $validAgeGroups)) {
                    return false; // Invalid age group in the event
                }
        
                // Extract min and max age for the event
                [$eventMinAge, $eventMaxAge] = explode('-', $event->AgeGroup);
        
                // Check if the child's age falls within the event's allowed age range
                return $childAge >= $eventMinAge && $childAge <= $eventMaxAge;
            });
        
            // Add base64-encoded images to the event data
            foreach ($Events as $Event) {
                $imageData = $Event->Image;
                $imageType = $Event->ImageType;
                $base64Image = (!empty($imageData) && is_string($imageData)) 
                    ? 'data:' . $imageType . ';base64,' . base64_encode($imageData) 
                    : null;
                
                $Event->Image = $base64Image;
            }
        
            // Return the filtered events or an appropriate message
            if (empty($Events)) {
                echo json_encode(['success' => true, 'message' => 'No events found for the selected filters']);
            } else {
                echo json_encode(['success' => true, 'data' => $Events]);
            }
        }        

        public function setchildsession(){
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

        public function removechildsession(){
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