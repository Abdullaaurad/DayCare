<?php

    namespace Controller;
    use App\Helpers\SidebarHelper;
    use App\Helpers\ChildHelper;

    defined('ROOTPATH') or exit('Access denied');

    class Blog{
        use MainController;
        public function index(){

            $session = new \Core\Session;
            $session->set("USERID", 1);
            $session = new \Core\Session;
            $session->check_login();

            $data = [];
            $SidebarHelper = new SidebarHelper();
            $data = $SidebarHelper->store_sidebar();

            $ChildHelper = new ChildHelper();
            $data['Child_Count'] = $ChildHelper->child_count();
            $session->set("Location" , 'Parent/Blog');

            $this->view('Parent/blog', $data);
        }

        private function store($username, $children, $pre){
            $data = [];
            
            // Retrieve the parent's profile image
            $parentImage = getProfileImageUrl($username);
            $data['parent'] = [
                'fullname' => $pre[0]->First_Name . ' ' . $pre[0]->Last_Name,
                'username' => $username,
                'image' => !empty($parentImage) ? $parentImage : null,
                'childcount' => count($children),
                'lastseen' => $pre[0]->Last_Seen,
                'firstname' => $pre[0]->First_Name,
                'lastname' => $pre[0]->Last_Name,
                'lastseen' => lastSeen($pre[0]->Last_Seen),
            ];
    
            // Retrieve each child's profile image and store by index
            foreach ($children as $index => $child) {
                $fullName = $child->First_Name . " " . $child->Last_Name ;
                $childImage = getProfileImageUrl($username, $child->First_Name);
                $data['children'][$index] = [
                    'name' => $child->First_Name,
                    'fullname' => $fullName,
                    'image' => !empty($childImage) ? $childImage : null,
                ];
            }
    
            return $data;
        }

        public function setchildsession(){

            $response = ['called' => true];
            defined('ROOTPATH') or define('ROOTPATH', __DIR__); // Define the root if not already defined

            // Session and JSON response settings
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
        
            header('Content-Type: application/json');
        
            // Disable error reporting for clean JSON output in production
            ini_set('display_errors', 0);
            error_reporting(0);
        
            // Handle AJAX request and set the child session
            $request = json_decode(file_get_contents('php://input'), true);
            $response = [];
        
            if (isset($request['childName'])) {
                $session = new \Core\Session;
                $session->set('CHILDNAME', $request['childName']);
                $_SESSION['CHILDNAME'] = $request['childName'];
                $response = ['success' => true];
            } else {
                $response = ['success' => false, 'message' => 'Child name not provided.'];
            }
            echo json_encode($response); // Output JSON response
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