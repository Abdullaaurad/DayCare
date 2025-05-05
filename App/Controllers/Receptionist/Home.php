<?php

    namespace Controller;

    defined('ROOTPATH') or exit('Access denied');

    class Home{
        use MainController;
        public function index(){
            $session = new \core\Session;
            $session->check_login();

            $data['Profile'] = $this->Profile();
            $data['Visitors'] = $this->visitors();
            $this->view('Receptionist/home',$data);
        }

        private function Profile(){
            $session = new \core\Session;
            $UserID = $session->get('USERID');

            $ReceptionistModal = new \Modal\Receptionist;
            $data = $ReceptionistModal->first(["UserID" => $UserID]);
            if(!empty($data)){
                $imageData = $data->Image;
                $imageType = $data->ImageType;
                $base64Image = (!empty($imageData) && is_string($imageData)) 
                    ? 'data:' . $imageType . ';base64,' . base64_encode($imageData) 
                    : null
                ;
                $data->Image = $base64Image;
                $data->EmployeeID = 'EMP' . str_pad($data->UserID, 5, '0', STR_PAD_LEFT);
            }

            return $data;
        }

        public function Logout(){
            $session = new \core\Session();
            $session->logout();
    
            echo json_encode(["success" => true]);
            exit;
        }

        private function visitors(){
            $VistorModal = new \Modal\Visitor;
            $today = date('Y-m-d');

            $Visitors = $VistorModal->where_order_desc(["Date" =>$today], [], "Start_Time");
            return $Visitors;
        }
    }
?>