<?php

    namespace Controller;

    defined('ROOTPATH') or exit('Access denied');

    class Leaveupdate{
        use MainController;
        public function index(){
            $maidleaveMode = new \Modal\MaidLeave ;
            $leave = $maidleaveMode->where_norder(['LeaveID' => $_POST["leaveid"]],[]);
            if($leave[0]->Status === "Pending"){
           $data['leaveid'] =$_POST['leaveid']; 
           $this->view('Maid/Leaveupdate',$data);
            }else{
                redirect('Maid/Leaves');
            }        
        }
        public function update(){
           $maidleaveMode = new \Modal\MaidLeave ;
          
           $_POST['Duration'] = (strtotime($_POST['End_Date']) - strtotime($_POST['Start_Date'])) / (60 * 60 * 24) + 1;
           $maidleaveMode->update_withid($_POST['leaveid'],$_POST,'LeaveID');
             redirect('Maid/Leaves');
           

        }
      
    }
?>