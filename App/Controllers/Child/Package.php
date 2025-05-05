<?php

    namespace Controller;
    use App\Helpers\SidebarHelper;

    defined('ROOTPATH') or exit('Access denied');

    class Package{
        use MainController;
        public function index(){

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

            $session->set("Location" , 'Child/Package');
            $this->view('Child/package',$data);
        }

        private function selectedchild($selectedchild){
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

        public function store_package(){
            header('Content-Type: application/json');
        
            $requestData = json_decode(file_get_contents("php://input"), true);
            $filterMax = $requestData['Max_price'] ?? null;
            $filterMin = $requestData['Min_price'] ?? null;
        
            $session = new \core\Session;
            $ChildModal = new \Modal\Child;
            $ChildID = $session->get("CHILDID");
            $Child = $ChildModal->first(["ChildID" => $ChildID]);
        
            // Calculate child's age at the start of the year
            $currentYear = (new \DateTime())->format('Y');
            $startOfYear = new \DateTime("$currentYear-01-01");
            $dob = new \DateTime($Child->DOB);
            $filterAge = $dob->diff($startOfYear)->y; // Child's age at the start of the year
        
            $PackageModal = new \Modal\Package;
            $Packages = $PackageModal->findall();
        
            // Filter by price range
            if ($filterMax !== null || $filterMin !== null) {
                $Packages = array_filter($Packages, function ($row) use ($filterMax, $filterMin) {
                    $price = (float)$row->Price;
                    return ($filterMax === null || $price <= $filterMax) && ($filterMin === null || $price >= $filterMin);
                });
            }
        
            // Filter by age group
            $Packages = array_filter($Packages, function ($row) use ($filterAge) {
                // Handle "All" age group (no restriction)
                if ($row->AgeGroup === 'All') {
                    return true;
                }
        
                // Parse age group range (e.g., "2-3" -> min: 2, max: 3)
                if (preg_match('/^(\d+)-(\d+)$/', $row->AgeGroup, $matches)) {
                    $minAge = (int)$matches[1];
                    $maxAge = (int)$matches[2];
        
                    // Check if child's age falls within the range
                    return $filterAge >= $minAge && $filterAge <= $maxAge;
                }
        
                // If AgeGroup format is invalid, exclude the package
                return false;
            });
        
            if (empty($Packages)) {
                echo json_encode(['success' => true, 'message' => 'No packages found for the selected filters']);
            } else {
                echo json_encode(['success' => true, 'data' => $Packages]);
            }
        }     

        public function setchildsession(){

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
            $session = new \core\Session();
            $session->logout();

            echo json_encode(["success" => true]);
            exit;
        }
    }
?>