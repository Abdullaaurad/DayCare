<?php

    namespace Controller;

    class History{
        use MainController;

        public function index(){

            $doctor = new \Modal\Doctor;
            $child = new \Modal\Child;
            $appoint = new \Modal\Appointment;
            $slot = new \Modal\TimeSlot;
            $pres = new \Modal\Prescription;

            // $DoctorID = $this->findID();
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

            $appointments  = $appoint->where_norder(['DoctorID' => $DoctorID]);

            // show($appointments);
            // exit();
            

            if(!empty($appointments)){
                
                foreach($appointments as $appointment){
                    $children = $child->where_norder(['ChildID' => $appointment->ChildID]);
                        // show($children);
                        // exit();
                    $children = $children[0];
                    $prescriptions = $pres->first(['AppointmentID' => $appointment->AppointmentID]);
                    //$prescriptions = $prescriptions[0];
                    
                    if(!empty($prescriptions)){

                        $childInfo[] =[
                            'ChildName' => $children->First_Name . ' ' . $children->Last_Name,
                            'AppoinentID' => $appointment->AppointmentID,
                            'Medication'=> $prescriptions->Medication_Name,
                            'Dosage' => $prescriptions->Dosage,
                            'Frequency' => $prescriptions->Frequency,
                            'Route' => $prescriptions->Route_of_Administration,
                            
                        ];

                    }
              

                   
                }


                if(!empty($childInfo)){
                    // show($childInfo);
                    // exit();
                    $this->view('Doctor/History', ['childInfo' => $childInfo,'doctor' => $doctorDetails]);
                } else{
                    $this->view('Doctor/History',['Message' => 'No prescripotion found', 'doctor' => $doctorDetails]);
                }

               

                


                
                

                
            
            
           
           
        }else{
            $this->view('Doctor/History',['Message' => 'No appoinments found', 'doctor' => $doctorDetails]);
        }
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
    }
?>