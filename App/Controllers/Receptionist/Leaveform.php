<?php

    namespace Controller;

    defined('ROOTPATH') or exit('Access denied');

    class Leaveform{
        use MainController;
        public function index(){
           
            $this->view('Receptionist/Leaveform');
        }
        public function RequestLeave(){
            $repLeaveModel = new \Modal\ReceptionistLeave;
            // $maidid = $this->findID();
            $repid = 1;
                 
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $data = [
                    'ReceotionistID' => $repid,
                    'Start_Date' => $_POST['Start_Date'],
                    'End_Date' => $_POST['End_Date'],
                    'Description' => $_POST['Description'],
                    'Leave_Type' => $_POST['Leave_Type'],
                    'Status' => 'Pending',
                ];
                $data['Duration'] = (strtotime($data['End_Date']) - strtotime($data['Start_Date'])) / (60 * 60 * 24) + 1; 
               if($repLeaveModel->validate($data)){
                    $repLeaveModel->insert($data);
                    
                redirect('Receptionist/Leaves');
            }
        }
        }
        // public function findID(){
        //     $maid = new \Modal\;
        //     $session = new \Core\Session;
    
        //     $userID = $session->get('USERID'); 
            
        //     $row = $maid->first(['UserID' => $userID]);
        //     $result = $row->MaidID;
    
        //     return $result;
    
    
        // }
    }
?>