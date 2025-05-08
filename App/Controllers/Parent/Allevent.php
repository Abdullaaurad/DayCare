<?php

    namespace Controller;
    use App\Helpers\SidebarHelper;
    use App\Helpers\ChildHelper;

    defined('ROOTPATH') or exit('Access denied');

    class Allevent{
        use MainController;
        public function index(){

            $session = new \Core\Session;
             
            $session = new \Core\Session;
            $SidebarHelper = new SidebarHelper();
            $ChildHelper = new ChildHelper();
            $session->check_login();

            $data = [];
            $data = $SidebarHelper->store_sidebar();

            $data['Child_Count'] = $ChildHelper->child_count();
            $session->set("Location" , 'Parent/Allevent');

            $this->view('Parent/allevent', $data);
        }

        public function store_allowedchild() {
            header('Content-Type: application/json');
            $requestData = json_decode(file_get_contents("php://input"), true);
            $session = new \Core\Session;
             
            $eventId = $requestData['Id'] ?? null;

            $EventModal = new \Modal\Event;
            $Event = $EventModal->first(["EventID" => $eventId]);
            $filterAgeGroup = $Event->AgeGroup;
        
            $ChildHelper = new ChildHelper();
            $children = $ChildHelper->store_child();
        
            if (!$children) {
                echo json_encode(['success' => false, 'message' => 'No child data found']);
                return;
            }
        
            $filteredChildren = array_filter($children, function($child) use ($filterAgeGroup) {
                $dob = new \DateTime($child->DOB); // Access property using -> notation
                $currentDate = new \DateTime(); // Get the current date
                $age = $currentDate->format('Y') - $dob->format('Y'); // Calculate the age using only the year
        
                if ($filterAgeGroup === 'All') {
                    return true; // Include all children if 'All' is specified
                }
        
                $ageRange = explode('-', $filterAgeGroup);
                if (count($ageRange) === 2) {
                    $minAge = (int)$ageRange[0];
                    $maxAge = (int)$ageRange[1];
                    return $age >= $minAge && $age <= $maxAge;
                }
        
                return false;
            });
        
            // Map only ChildID and childName from the filtered results
            $result = array_map(function($child) {
                return [
                    'ChildID' => $child->ChildID,
                    'childName' => $child->First_Name
                ];
            }, $filteredChildren);
        
            if (empty($result)) {
                echo json_encode(['success' => true, 'message' => 'No events found for the selected filters']);
            } else {
                // Correctly return the filtered children in JSON format
                echo json_encode(['success' => true, 'data' => $result]);
            }
        }        

        public function store_events() {
            $session = new \Core\Session;
             
            header('Content-Type: application/json');
        
            $requestData = json_decode(file_get_contents("php://input"), true);
            $filterDate = $requestData['date'] ?? null;
            $filterAge = $requestData['Age'] ?? null;
        
            $EventModal = new \Modal\Event;
            $Events = $filterDate ? $EventModal->where_norder(["Date" => $filterDate]) : $EventModal->findall();
        
            if ($filterAge !== null) {
                $validAgeGroups = ['3-5', '6-9', '10-13', 'All'];
        
                if (in_array($filterAge, $validAgeGroups)) {
                    if ($filterAge !== 'All') {
                        [$filterMinAge, $filterMaxAge] = explode('-', $filterAge);
        
                        $Events = array_filter($Events, function ($row) use ($filterMinAge, $filterMaxAge) {
                            if ($row->AgeGroup === 'All') {
                                return true; // Show "All" age groups regardless of the filter
                            }
                            [$eventMinAge, $eventMaxAge] = explode('-', $row->AgeGroup);
        
                            // Check if the age ranges overlap
                            return $filterMinAge <= $eventMaxAge && $filterMaxAge >= $eventMinAge;
                        });
                    }
                } else {
                    echo json_encode(['success' => false, 'message' => 'Invalid age group provided']);
                    return;
                }
            }

            foreach($Events as $Event){
                $imageData = $Event->Image;
                $imageType = $Event->ImageType;
                $base64Image = (!empty($imageData) && is_string($imageData)) 
                    ? 'data:' . $imageType . ';base64,' . base64_encode($imageData) 
                    : null;
                
                $Event->Image = $base64Image;
            }
        
            if (empty($Events)) {
                echo json_encode(['success' => true, 'message' => 'No events found for the selected filters']);
            } else {
                echo json_encode(['success' => true, 'data' => $Events]);
            }
        }

        public function setchildsession(){
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
            $session = new \core\Session();
            $session->logout();

            echo json_encode(["success" => true]);
            exit;
        }
    }
?>