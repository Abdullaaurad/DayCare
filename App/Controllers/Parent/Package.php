<?php

    namespace Controller;

    use App\Helpers\SidebarHelper;
    use App\Helpers\ChildHelper;

    defined('ROOTPATH') or exit('Access denied');

    class Package{
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
            $session->set("Location" , 'Parent/Package');

            $this->view('Parent/package', $data);
        }

        public function store_package(){
            $session = new \Core\Session;
             
            header('Content-Type: application/json');

            $requestData = json_decode(file_get_contents("php://input"), true);
            $filterMax = $requestData['Max_price'] ?? null;
            $filterMin = $requestData['Min_price'] ?? null;
            $filterAge = $requestData['Age'] ?? null;

            $PackageModal = new \Modal\Package;
            $Packages = $PackageModal->findall();

            if ($filterMax !== null || $filterMin !== null) {
                $Packages = array_filter($Packages, function ($row) use ($filterMax, $filterMin) {
                    $price = (float)$row->Price;
                    return ($filterMax === null || $price <= $filterMax) && ($filterMin === null || $price >= $filterMin);
                });
            }
        
            if ($filterAge !== null) {
                // Define valid age groups
                $validAgeGroups = ['2-3', '4-5', '6-7', '8-9', '10-11', '12-13', '14-15', 'All'];
            
                // Check if the provided filter is valid
                if (in_array($filterAge, $validAgeGroups)) {
                    // If the selected age group is "All", no filter on age
                    if ($filterAge !== 'All') {
                        $Packages = array_filter($Packages, function ($row) use ($filterAge) {
                            return $row->AgeGroup === $filterAge || $row->AgeGroup === 'All';
                        });
                    }
                } else {
                    echo json_encode(['success' => false, 'message' => 'Invalid age group provided']);
                    return;
                }
            }
            

            if (empty($Packages)) {
                echo json_encode(['success' => true, 'message' => 'No events found for the selected filters']);
            } else {
                echo json_encode(['success' => true, 'data' => $Packages]);
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