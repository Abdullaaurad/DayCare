<?php

    namespace Controller;

    use App\Helpers\SidebarHelper;
    use App\Helpers\ChildHelper;

    defined('ROOTPATH') or exit('Access denied');

    class Attendance{
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
            $session->set("Location" , 'Parent/Attendance');

            $this->view('Parent/allevent', $data);
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
        
        public function Logout(){
            $session = new \core\Session();
            $session->logout();

            echo json_encode(["success" => true]);
            exit;
        }
        
    }
?>