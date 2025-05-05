<?php

    namespace Controller;

    defined('ROOTPATH') or exit('Access denied');

    class Leaves{
        use MainController;
        public function index(){
            $leavesModel = new \Modal\ReceptionistLeave;
            $data['leaves']  = $leavesModel->findall();
            
            $this->view('Receptionist/leaves', $data);
        }
        public function datefilter(){
            $leavesModel = new \Modal\ReceptionistLeave;
            $data['leaves']  = $leavesModel->where_norder(['Start_Date'=>$_POST["Date"]],[]);
            $this->view('Receptionist/leaves', $data);
        }
        public function delrec(){
            $leavesModel = new \Modal\ReceptionistLeave;
                $leave = $leavesModel->where_norder(['LeaveID' => $_POST["LeaveID"]],[]);
                // show($leave);
                // exit();
                if($leave[0]->Status === "Pending"){
                $leavesModel->delete($_POST['LeaveID'],'LeaveID');
                 // Redirect to the success page or show a success message
                 redirect('Receptionist/Leaves'); 
                }else{
                   
                         redirect('Receptionist/Leaves'); 
                      
                }
            
        }
      
    }
?>