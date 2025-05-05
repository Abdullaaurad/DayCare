<?php

    namespace Controller;

    defined('ROOTPATH') or exit('Access denied');

    class Leaveform{
        use MainController;
        public function index(){
           
            $this->view('Maid/Leaveform');
        }
        public function RequestLeave(){
            $maidLeaveModel = new \Modal\MaidLeave;
            // $maidid = $this->findID();
            $maidid = 1;
                 
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $data = [
                    'MaidID' => $maidid,
                    'Start_Date' => $_POST['Start_Date'],
                    'End_Date' => $_POST['End_Date'],
                    'Description' => $_POST['Description'],
                    'Leave_Type' => $_POST['Leave_Type'],
                    'Status' => 'Pending',
                ];
                $data['Duration'] = (strtotime($data['End_Date']) - strtotime($data['Start_Date'])) / (60 * 60 * 24) + 1; 
               if($maidLeaveModel->validate($data)){
                    $maidLeaveModel->insert($data);
                    
                redirect('Maid/Leaves');
            }
        }
        }
        public function findID(){
            $maid = new \Modal\Maid;
            $session = new \Core\Session;
    
            $userID = $session->get('USERID'); 
            
            $row = $maid->first(['UserID' => $userID]);
            $result = $row->MaidID;
    
            return $result;
    
    
        }
    }
?>