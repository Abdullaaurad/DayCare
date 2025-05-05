<?php
    namespace Controller;

    class Dashboard{
         use MainController;

        public function index(){

           $doctor = new \Modal\Doctor;
           $child = new \Modal\Child;
           $slot = new \Modal\TimeSlot;
           $appoint = new \Modal\Appointment;

        //    $DoctorID = $this->findID();
        $DoctorID =  1;

            $doctorInfo = $doctor->first(['DoctorID' => $DoctorID]);
            $profileImage = $doctorInfo->Image;
            $baseImage = base64_encode($profileImage);

           $doctorDetails = [
            'id' => $DoctorID,
            'Name' =>$doctorInfo->First_Name. ' ' . $doctorInfo->Last_Name,
            'image' => 'data:image/jpeg;base64,' . $baseImage,
            'date' => date('Y-m-d')   
        ];

        // show($doctorDetails);
        // exit();

           $row = $slot->where_norder(['DoctorID' => $DoctorID, 'Slot_Date' => date('Y-m-d')]);
            // var_dump($row);
            // exit();
            if(empty($row)){
                $this->view('Doctor/Dashboard',['message' => 'No Time Slot Found','doctor' => $doctorDetails]);
            }else{
           foreach($row as $time){
            // var_dump($time);
            // exit();
            
               // 
                if($time->Status == 'available'){
                    $data[] = [
                        'SlotID' => $time->SlotID,
                        'Start_Time' => $time->Start_Time,
                        'End_Time' => $time->End_Time,
                        'Status' => $time->Status,
                        'ChildName' => 'No Booking'
                    ];
                }else{
                    $appointments = $appoint->where_norder(['SlotID' =>$time->SlotID]);
                    $childInfo = $child->first(['ChildID' => $appointments[0]->ChildID]);
                    // var_dump($appointments[0]->AppointmentID);
                    // exit();
                    $data[] = [
                        'SlotID' => $appointments[0]->AppointmentID,
                        'Start_Time' => $time->Start_Time,
                        'End_Time' => $time->End_Time,
                        'Status' => $time->Status,
                        'ChildName' => $childInfo->First_Name . ' ' . $childInfo->Last_Name,
                    ];
                
                }
           
           
        }
        // show($doctorDetails);
        // exit();
        $this->view('Doctor/Dashboard',['times' => $data,  'doctor' => $doctorDetails]);
    }
        // var_dump($data);
        //         exit();
        
        
    }
        
        public function findID(){

            $doctor = new \Modal\Doctor;
            $session = new \Core\Session;
    
            $userID = $session->get('USERID'); 
            // var_dump($userID);
            // exit();
    
            $row = $doctor->first(['UserID' => $userID]);
            $result = $row->DoctorID;
    
            return $result;
    
    
        }

        public function editBooking(){
            $DoctorID = $this->findID();

            
           $doctor = new \Modal\Doctor;
           $child = new \Modal\Child;
           $slot = new \Modal\TimeSlot;
           $appoint = new \Modal\Appointment;

        }
     }
?>