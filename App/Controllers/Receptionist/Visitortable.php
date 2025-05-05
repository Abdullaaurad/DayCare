<?php

    namespace Controller;

    defined('ROOTPATH') or exit('Access denied');

    class Visitortable{
        use MainController;
        public function index(){
            $visitorModel = new \Modal\Visitor();
            $data['visitors'] = $visitorModel->findall();
            $this->view('Receptionist/visitortable', $data);
        }
        public function search()
        {
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