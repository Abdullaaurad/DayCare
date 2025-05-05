<?php

    namespace Controller;

    defined('ROOTPATH') or exit('Access denied');

    class Items{
        use MainController;
        public function index(){

            $session = new \Core\Session;
            $session->set("USERID", 1);
            $session = new \Core\Session;
            $session->check_login();
            $session->check_child('Parent');

            // Retrieve session variables
            $childname = $session->get('CHILDNAME');
            $parentname = $session->get('USERNAME');

            // Retrieve parent and children data
            $child = new \Modal\Child;
            $children = $child->where_norder(['Parent_Name' => $parentname]);
            $parent = new \Modal\ParentUser;
            $pre = $parent->where_norder(['Username' => $parentname]);

            // Prepare data for all children
            $data = $this->store($children, $pre);

            // Select specific child by name, if it exists
            $select = $child->where_norder(['Parent_Name' => $parentname, 'First_Name' => $childname ]);
            $session->set('CHILD_ID', $select[0]->Child_Id);

            $child_id = $session->get('CHILD_ID');
            $data['child_id'] = $child_id;
            
            if (!empty($select)) {
                $data2 = $this->selectedchild($select[0], $pre);
                $data = $data + $data2;
            }

            $this->view('Child/items', $data);
        }

        private function store($children, $pre){
            $session = new \Core\Session;
            $session->set("USERID", 1);
            $data = [];

            // Retrieve the parent's profile image
            $parentImage = getProfileImageUrl($pre[0]->Username);
            $data['parent'] = [
                'fullname' => $pre[0]->First_Name . ' ' . $pre[0]->Last_Name,
                'image' => !empty($parentImage) ? $parentImage : null,
            ];

            // Retrieve each child's profile image and details
            foreach ($children as $index => $child) {
                $childImage = getProfileImageUrl($pre[0]->Username, $child->First_Name);
                $data['children'][$index] = [
                    'name' => $child->First_Name,
                    'image' => !empty($childImage) ? $childImage : null,
                ];
            }

            return $data;
        }

        private function selectedchild($selectedchild, $pre){
            $session = new \Core\Session;
            $session->set("USERID", 1);
            $data = [];

            // Retrieve the specific child's profile image and details
            $childImage = getProfileImageUrl($pre[0]->Username, $selectedchild->First_Name);
            $data['selectedchildren'] = [
                'fullname' => $selectedchild->First_Name . ' ' . $selectedchild->Last_Name,
                'name' => $selectedchild->First_Name,
                'image' => !empty($childImage) ? $childImage : null,
                'age' => agecalculate($selectedchild->DOB),
                'language' => $selectedchild->Language,
                'religion' => $selectedchild->Religion,
            ];

            return $data;
        }

        public function setchildsession(){
            $session = new \Core\Session;
            $session->set("USERID", 1);

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
                $_SESSION['CHILD_ID'] = $request['childId'];
                $session->set('CHILD_ID', $request['childId']);
                $session->set('CHILDNAME', $request['childName']);
                $response = ['success' => true];
            } else {
                $response = ['success' => false, 'message' => 'Child name not provided.'];
            }
            echo json_encode($response); // Output JSON response
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
            
            if (isset($_SESSION['CHILDNAME'])) {
                $session = new \Core\Session;
                $session->unset("CHILDNAME");
                $response = ['success' => true, 'message' => 'Child session removed.'];
            } else {
                $response = ['success' => false, 'message' => 'No child session to remove.'];
            }

            echo json_encode($response);  // Send JSON response
            exit();
        }
    }
?>