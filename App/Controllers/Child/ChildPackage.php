<?php
    namespace Controller;

    defined('ROOTPATH') or exit('Access denied');
    
    class ChildPackage {
        use MainController;
    
        public function index() {
            $session = new \Core\Session;
             
            $session = new \Core\Session;
            $session->check_login();
            $UserID = $session->get("USERID");
            $ChildID = $session->get('CHILDID');
    
            $data = [];
            $parent = new \Modal\ParentUser;
            $Pre = $parent->first(["UserID" => $UserID]);
            $child = new \Modal\Child;
            $children = $child->where_norder(["ParentID" => $Pre->ParentID]);

            $data['Package'] = $this->getcurrent();

            $location = $session->get("Location");
            $this->view('Child/ChildPackage', $data);
        }

        public function getcurrent(){
            $session = new \Core\Session;
             

            $child = new \Modal\Child;
            $PackageModal = new \Modal\Package;
            $session = new \Core\Session;
            $ChildID = $session->get('CHILDID');

            $child = $child->first(["ChildID" =>$ChildID]);
            $Package = $PackageModal->first(["PackageID" => $child->PackageID]);

            return $Package;
        }
    
        public function handleFormSubmission() {    
            
            $session = new \Core\Session;
             

            $child = new \Modal\Child;
            $session = new \Core\Session;
            $ChildID = $session->get('CHILDID');

            if(!isset($_POST['selectedPackage'])){
                $_POST['selectedPackage'] = 101;
            }

            $child->update(["ChildID" => $ChildID], ["PackageID" => $_POST['selectedPackage']]);
            $location = $session->get("Location");
            redirect($location);
        }

        public function store_package() {
            $session = new \Core\Session;
             
            header('Content-Type: application/json');
        
            // Get the selected dates (days) from the request
            $requestData = json_decode(file_get_contents("php://input"), true);
            $selectedDays = $requestData['data'] ?? []; // Assuming days are sent in the 'data' key
        
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
        
            // Filter by age group
            $Packages = array_filter($Packages, function ($row) use ($filterAge) {
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

            // Filter packages by selected days
            $filteredPackages = array_filter($Packages, function ($package) use ($selectedDays) {
                // Get all the days that are true for the package (as an array)
                $packageDays = array_filter(get_object_vars($package), function ($value) {
                    return $value == 1; // Compare against '1' (not true) since the database stores '1' or '0'
                });

                // Get the keys (day names) from the filtered package days
                $packageDayKeys = array_keys($packageDays);

                // Compare if the package days exactly match the selected days
                return count($packageDayKeys) === count($selectedDays) && !array_diff($packageDayKeys, $selectedDays);
            });

        
            if (empty($filteredPackages)) {
                echo json_encode(['success' => true, 'message' => 'No packages found for the selected filters']);
            } else {
                echo json_encode(['success' => true, 'data' => $filteredPackages]);
            }
        }        
    }    

?>
