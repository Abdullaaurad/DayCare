<?php

    namespace Controller;
    use App\Helpers\SidebarHelper;
    use App\Helpers\ChildHelper;

    defined('ROOTPATH') or exit('Access denied');

    class ManageChildren{
        use MainController;
        public function index(){

            $session = new \Core\Session;
             
            $session = new \Core\Session;
            $session->check_login();

            $data = [];
            $SidebarHelper = new SidebarHelper();
            $data = $SidebarHelper->store_sidebar();

            $session = new \Core\Session;
            $session->unset("CHILDID");

            $this->view('Parent/ManageChildren',$data);
        }

        public function DeleteChild(){
            $session = new \Core\Session;
             
            header('Content-Type: application/json');
            $requestData = json_decode(file_get_contents("php://input"), true);
            $ChildID = $requestData['ChildID'];
            $response = [];

            $ChildModal = new \Modal\Child;
            $ChildModal->delete($ChildID, "ChildID");
    
            if (isset($ChildID)) {
                $response = ['success' => true, 'message' => 'Child session removed.'];
            } else {
                $response = ['success' => false, 'message' => 'No child session to remove.'];
            }
    
            echo json_encode($response);
            exit();
        }
    }

?>