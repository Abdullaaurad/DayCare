<?php

    namespace Controller;

    defined('ROOTPATH') or exit('Access denied');

    class Individualvisitor{
        use MainController;
        public function index(){
            
            $visitorModel = new \Modal\Visitor();
            $data['visitors'] = $visitorModel->where_norder(['VisitorID' => $_POST['VisitorID']], []);
           
            $this->view('Receptionist/individualvisitor',$data);
        }
    }
?>