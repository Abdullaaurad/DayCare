<?php

    namespace Controller;
    use App\Helpers\SidebarHelper;

    defined('ROOTPATH') or exit('Access denied');

    class Meal{
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

            // Retrieve parent and children data
            $ChildModal = new \Modal\Child;
            $select = $ChildModal->first(['ChildID' => $ChildID]);
            $data['child_id'] = $ChildID;

            if (!empty($select)) {
                $data2 = $this->selectedchild($select);
                $data = $data + $data2;
            }

            $session->set("Location" , 'Child/Meal');
            $this->view('Child/Meal',$data);
        }
    
        public function Snack_request(){
            $session = new \Core\Session;
            $session->set("USERID", 1);
            $session = new \Core\Session;
            $ChildID = $session->get("CHILDID");
            $requestModal = new \Modal\SnackRequest;
            $SnackModal = new \Modal\SnackPlan;

            $result = $requestModal->first(["SnackID"=>$_POST['Snack'] , "ChildID"=> $ChildID]);
            if($result){
                $requestModal->update(["SnackID"=>$_POST['Snack'] , "ChildID"=> $ChildID], ["Quantity"=> $result->Quantity+1]);
            }
            else{
                $requestModal->insert(["SnackID"=>$_POST['Snack'] , "ChildID"=> $ChildID, ["Quantity"=> 1]]);
            }

            redirect('Child/Meal');
        }

        public function delete_snack_request(){
            $session = new \Core\Session;
            $session->set("USERID", 1);
            header('Content-Type: application/json');
            
            // Get the JSON body data
            $requestData = json_decode(file_get_contents("php://input"), true);
            $Id = $requestData['ID'];

            $requestModal = new \Modal\SnackRequest;
            $requestModal->delete($Id , "RequestID");

            echo json_encode(['success' => true, 'data' => '']);
        }

        public function Snack_request_edit(){
            $session = new \Core\Session;
            $session->set("USERID", 1);
            if(isset($_POST)){
                $requestModal = new \Modal\SnackRequest;
                $requestModal->update(["RequestID" => $_POST['Request']], ["SnackID"=>$_POST['Snack'] , "Meal"=> $_POST['Meal'], "Quantity"=> 1]);
            }
            redirect("Child/meal");
        }

        private function selectedchild($selectedchild)
        {
            $session = new \Core\Session;
            $session->set("USERID", 1);
            $data = [];

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

        public function store_food() {
            $session = new \Core\Session;
            $session->set("USERID", 1);
            header('Content-Type: application/json');
            
            // Get the JSON body data
            $requestData = json_decode(file_get_contents("php://input"), true);
            $date = $requestData['date'] ?? date('Y-m-d'); // Default to today if no date provided
        
            // Define the structure for the meal plan
            $mealPlan = [
                'breakfast' => [],
                'lunch' => [],
                'dinner' => []
            ];
            
            // Fetch the meal data for the given date
            $FoodModal = new \Modal\FoodPlan;
            $results = $FoodModal->where_norder(['Date' => $date]);
            
            // Iterate through the results and categorize the food without removing existing meal data
            foreach ($results as $row) {
                $food = $row->Food;
                $time = $row->Time;

                if ($time === 'Breakfast') {
                    $mealPlan['breakfast'][] =  $food; // Append to breakfast
                } elseif ($time === 'Lunch') {
                    $mealPlan['lunch'][] = $food; // Append to lunch
                } elseif ($time === 'Dinner') {
                    $mealPlan['dinner'][] = $food; // Append to dinner
                }
            }
                    
            // Return the meal plan data in JSON format
            if (empty($mealPlan['breakfast']) && empty($mealPlan['lunch']) && empty($mealPlan['dinner'])) {
                echo json_encode(['success' => false, 'message' => 'No meal plan found for the selected date']);
            } else {
                echo json_encode(['success' => true, 'data' => $mealPlan]);
            }
        }    

        public function get_snacks(){
            $session = new \Core\Session;
            $session->set("USERID", 1);
            header('Content-Type: application/json');
            
            // Get the JSON body data
            $requestData = json_decode(file_get_contents("php://input"), true);
            $date = $requestData['date'] ?? date('Y-m-d');
            $time = $requestData['time']?? 'Breakfast';

            $SnackModal = new \Modal\SnackPlan;
            $results = $SnackModal->where_norder(['Date' => $date, 'Time' => $time]);

            if (empty($results)) {
                echo json_encode(['success' => false, 'message' => 'No meal plan found for the selected date']);
            } else {
                echo json_encode(['success' => true, 'data' => $results]);
            }
        }

        public function store_snack() {
            $session = new \Core\Session;
            $session->set("USERID", 1);
            header('Content-Type: application/json');
            
            // Get the JSON body data
            $requestData = json_decode(file_get_contents("php://input"), true);
            $date = $requestData['date'] ?? date('Y-m-d'); // Default to today if no date provided
        
            // Define the structure for the meal plan
            $snackPlan = [
                'breakfast' => [],
                'lunch' => [],
                'dinner' => []
            ];
            
            // Fetch the meal data for the given date
            $SnackModal = new \Modal\SnackPlan;
            $results = $SnackModal->where_norder(['Date' => $date]);
            
            // Iterate through the results and categorize the food without removing existing meal data
            foreach ($results as $row) {
                $food = $row->Snack;
                $time = $row->Time;

                if ($time === 'Breakfast') {
                    $snackPlan['breakfast'][] =  $food; // Append to breakfast
                } elseif ($time === 'Lunch') {
                    $snackPlan['lunch'][] = $food; // Append to lunch
                } elseif ($time === 'Dinner') {
                    $snackPlan['dinner'][] = $food; // Append to dinner
                }
            }
                    
            // Return the meal plan data in JSON format
            if (empty($snackPlan['breakfast']) && empty($snackPlan['lunch']) && empty($snackPlan['dinner'])) {
                echo json_encode(['success' => false, 'message' => 'No meal plan found for the selected date']);
            } else {
                echo json_encode(['success' => true, 'data' => $snackPlan]);
            }
        }    

        public function store_request() {
            $session = new \Core\Session;
            $session->set("USERID", 1);
            header('Content-Type: application/json');
        
            $session = new \Core\Session;
            $ChildID = $session->get("CHILDID");
        
            // Get the JSON body data
            $requestData = json_decode(file_get_contents("php://input"), true);
            $Date = $requestData['date'] ?? date('Y-m-d');
            $Date = date('Y-m-d', strtotime($Date . ' +1 day'));
        
            if (!$ChildID) {
                echo json_encode(['success' => false, 'message' => 'Child ID not found in session']);
                return;
            }
        
            $SnackRequest = new \Modal\SnackRequest;
            $SnackPlan = new \Modal\SnackPlan;
        
            // Fetch all snack requests for the child
            $snackRequests = $SnackRequest->where_norder(['ChildID' => $ChildID]);
            $groupedSnacks = [];

            $ChildModal = new \Modal\Child;
            $children = $ChildModal->first(["ChildID"=> $ChildID]);
        
            foreach ($snackRequests as $request) {

                $snackDetails = $SnackPlan->first(['SnackID' => $request->SnackID, 'Date' => $Date]);
                if ($snackDetails) {
                    $mealTime = $snackDetails->Time;
                    $snackName = $snackDetails->Snack;
                    $requestID = $request->RequestID;
        
                    // Properly group snacks under the child name
                    if (!isset($groupedSnacks[$mealTime])) {
                        $groupedSnacks[$mealTime] = [];
                    }
        
                    if (!isset($groupedSnacks[$mealTime][$snackName])) {
                        $groupedSnacks[$mealTime][$snackName] = ['quantity' => 0, 'requestID' => $requestID];
                    }
                    $groupedSnacks[$mealTime][$snackName]['quantity'] += $request->Quantity;
                }
                $requestPlan[$children->First_Name] = $groupedSnacks;
            }
        
            // Return the response
            if (empty($requestPlan)) {
                echo json_encode(['success' => false, 'message' => 'No snack requests found for the selected date']);
            } else {
                echo json_encode(['success' => true, 'data' => $requestPlan]);
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