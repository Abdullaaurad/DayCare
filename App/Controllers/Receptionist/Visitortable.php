<?php

    namespace Controller;

    defined('ROOTPATH') or exit('Access denied');

    class Visitortable{
        use MainController;

        public function index() {
            $visitorModel = new \Modal\Visitor();

            // Get filters from $_GET
            $filterDate = isset($_GET['Date']) && $_GET['Date'] !== ''
                ? $_GET['Date']
                : date('Y-m-d');

            $filters = ["Date" => $filterDate];

            if (isset($_GET['NID']) && $_GET['NID'] !== '') {
                $filters['NID'] = $_GET['NID'];
            }

            // Get filtered visitor list
            $data['visitors'] = $visitorModel->where_order_desc($filters, [], ["Start_Time"]);
            $data['Profile'] = $this->Profile();

            $this->view('Receptionist/visitortable', $data);
        }

        private function Profile(){
            $session = new \core\Session;
            $session->set('USERID', 24);
            $UserID = $session->get('USERID');

            $ReceptionistModal = new \Modal\Receptionist;
            $data = $ReceptionistModal->first(["UserID" => $UserID]);
            if (!empty($data)) {
                $imageData = $data->Image;
                $imageType = $data->ImageType;
                $base64Image = (!empty($imageData) && is_string($imageData))
                    ? 'data:' . $imageType . ';base64,' . base64_encode($imageData)
                    : null;
                $data->Image = $base64Image;
                $data->EmployeeID = 'EMP' . str_pad($data->UserID, 5, '0', STR_PAD_LEFT);
            }

            return $data;
        }

        public function search(){
            $visitorModel = new \Modal\Visitor();
        
            if (!empty($_POST['NID'])) {
                $nid = $_POST['NID'];
                $data['visitors'] = $visitorModel->where_norder(['NID' => $nid], []);
                
                
            }else if (!empty($_POST['Date'])) {
                $date = $_POST['Date'];
                $data['visitors'] = $visitorModel->where_norder(['Date' => $date], []);
                
            }
            $this->view('Receptionist/visitortable', $data);
            
        }
        
        
    }
?>