<?php

    namespace Controller;

    defined('ROOTPATH') or exit('Access denied');

    class Leaveupdate{
        use MainController;
        public function index(){
            $receptionistleaveMode = new \Modal\ReceptionistLeave ;
            $leave = $receptionistleaveMode->where_norder(['LeaveID' => $_POST["leaveid"]],[]);
            if($leave[0]->Status === "Pending"){
           $data['leaveid'] =$_POST['leaveid']; 
           $this->view('Receptionist/Leaveupdate',$data);
            }else{
                redirect('Receptionist/Leaves');
            }        
            
           
        }
        public function update(){
            $receptionistleaveMode = new \Modal\ReceptionistLeave ;
           
            $_POST['Duration'] = (strtotime($_POST['End_Date']) - strtotime($_POST['Start_Date'])) / (60 * 60 * 24) + 1;
            $receptionistleaveMode->update_withid($_POST['leaveid'],$_POST,'LeaveID');
              redirect('Receptionist/Leaves');
            
 
         }
       
      
    }
?>