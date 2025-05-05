<?php

    namespace Controller;

    defined('ROOTPATH') or exit('Access denied');

    class Leaves{
        use MainController;
        public function index(){
            $leavesModel = new \Modal\MaidLeave;
            $data['leaves']  = $leavesModel->findall();
            
            $this->view('Maid/leaves', $data);
        }
        public function datefilter(){
            $leavesModel = new \Modal\MaidLeave;
            $data['leaves']  = $leavesModel->where_norder(['Start_Date'=>$_POST["Date"]],[]);
            $this->view('Maid/leaves', $data);
        }
        public function delmai(){
            $leavesModel = new \Modal\MaidLeave;
                $leave = $leavesModel->where_norder(['LeaveID' => $_POST["LeaveID"]],[]);
                // show($leave);
                // exit();
                if($leave[0]->Status === "Pending"){
                $leavesModel->delete($_POST['LeaveID'],'LeaveID');
                 // Redirect to the success page or show a success message
                 redirect('Maid/Leaves'); 
                }else{
                   
                         redirect('Maid/Leaves'); 
                      
                }
            
        }
      
    }
?>