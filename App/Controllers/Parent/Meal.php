<?php
    
    namespace Controller;

    use App\Helpers\SidebarHelper;
    use App\Helpers\ChildHelper;

    defined('ROOTPATH') or exit('Access denied');

    class Meal{
        use MainController;
        public function index(){

            $session = new \Core\Session;
             
            $session = new \Core\Session;
            $session->check_login();

            $data = [];
            $SidebarHelper = new SidebarHelper();
            $data = $SidebarHelper->store_sidebar();
            
            $ChildHelper = new ChildHelper();
            $data['Child_Count'] = $ChildHelper->child_count();
            $session->set("Location" , 'Parent/Event');

            $this->view('Parent/Meal', $data);
        }

        public function Snack_request(){
            $session = new \Core\Session;
             
            show($_POST);
            $requestModal = new \Modal\SnackRequest;
            $SnackModal = new \Modal\SnackPlan;

            $result = $requestModal->first(["SnackID"=>$_POST['Snack'] , "ChildID"=> $_POST['Child']]);
            if($result){
                $requestModal->update(["SnackID"=>$_POST['Snack'] , "ChildID"=> $_POST['Child']], ["Quantity"=> $result->Quantity+1]);
            }
            else{
                $requestModal->insert(["SnackID"=>$_POST['Snack'] , "ChildID"=> $_POST['Child'], ["Quantity"=> 1]]);
            }

            redirect('Parent/Meal');
        }

        public function delete_snack_request(){
            $session = new \Core\Session;
             
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
             

            show($_POST);
            if(isset($_POST)){
                $requestModal = new \Modal\SnackRequest;
                $requestModal->update(["RequestID" => $_POST['Request']], ["SnackID"=>$_POST['Snack'] , "ChildID"=> $_POST['Child'], "Meal"=> $_POST['Meal'], "Quantity"=> 1]);
            }
        }

        public function store_food() {
            $session = new \Core\Session;
             
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
             
            header('Content-Type: application/json');
        
            // Get the JSON body data
            $requestData = json_decode(file_get_contents("php://input"), true);
            $Date = $requestData['date'] ?? date('Y-m-d');
            $Date = date('Y-m-d', strtotime($Date . ' +1 day'));
            $Meal = $requestData['meal'] ?? 'Breakfast';
        
            $ChildHelper = new ChildHelper();
            $children = $ChildHelper->store_child();

            $requestPlan = []; 

            $SnackRequest = new \Modal\SnackRequest;
            $SnackPlan = new \Modal\SnackPlan;
        
            foreach ($children as $childRow) {
                $ChildID = $childRow->ChildID;
                $ChildName = $childRow->First_Name;
        
                // Fetch all snack requests for the current child
                $snackRequests = $SnackRequest->where_norder(['ChildID' => $ChildID]);
                $groupedSnacks = [
                    "Breakfast" => [],
                    "Lunch" => [],
                    "Dinner" => []
                ];

                foreach ($snackRequests as $request) {
                    $snackDetails = $SnackPlan->first(['SnackID' => $request->SnackID, 'Date' => $Date, 'Time'=> $Meal]);
                    if ($snackDetails) {
                        $mealTime = $snackDetails->Time;
                        $snackName = $snackDetails->Snack;
                        $requestID = $request->RequestID;
        
                        if (!isset($groupedSnacks[$snackName])) {
                            if (!isset($groupedSnacks[$mealTime][$snackName])) {
                                $groupedSnacks[$mealTime][$snackName] = ['quantity' => 0, 'requestID' => $requestID];
                            }
                            $groupedSnacks[$mealTime][$snackName]['quantity'] += $request->Quantity;
                        }
                    }
                }
                $requestPlan[$ChildName] = $groupedSnacks;
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

            echo json_encode($response);  // Send JSON response
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