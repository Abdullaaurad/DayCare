<?php

    namespace Controller;

    class TimeSlots{
        use MainController;

        public function index(){

            $doctor = new \Modal\Doctor;

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

            // echo("gee");
            // exit();
            $this->view('Doctor/TimeSlots',['doctor' => $doctorDetails]);
           
        }


        public function addSlot(){

            $slot = new \Modal\TimeSlot;
            $doctor = new \Modal\Doctor;
            $appoint = new \Modal\Appointment;

            $DoctorID = $this->findID();

           // var_dump($_POST);

            $timeSlots = []; // Initialize an array to collect all the time slots for the day

            for ($i = 1; $i <= 14; $i++) {  // Assuming there are no more than 10 time slots
                $timeKey = 'time-' . $i;
                
                if (isset($_POST[$timeKey])) {
                    //show($_POST[$timeKey]);
                    // Get the time slot, e.g., '9:30 - 10:00'
                    $timeSlot = $_POST[$timeKey];
            
                    // Split the time slot into start time and end time
                    list($startTime, $endTime) = explode(" - ", $timeSlot);
            
                    // Store the start and end time as an array in $timeSlots
                    $timeSlots[] = [
                        'DoctorID' => $DoctorID,
                        'Slot_Date' => $_POST['Date'],
                        'Start_Time' => $startTime,
                        'End_Time' => $endTime,
                        'Status' => 'available'
                    ];
                }
            }

            // show($timeSlots);
            // exit();
            

            if(!empty($timeSlots)){

               
                $apps = []; // outside the loop

                foreach($timeSlots as $slots){
                    $result = $slot->insert($slots); 
                     // insert into slots table
                
                    if (!$result) {
                        // Get the last inserted slot for the same doctor and date
                        $row = $slot->where_norder([
                            'DoctorID' => $DoctorID,
                            'Slot_Date' => $slots['Slot_Date']
                        ]);

                
                        // Only get the latest slot inserted (assuming last is the new one)
                        $lastSlot = end($row);
                    //     var_dump($lastSlot->SlotID);
                    // exit();
                
                        if ($lastSlot) {
                            $apps[] = [
                                'SlotID' => $lastSlot->SlotID,
                                'ChildID' => null,
                                'DoctorID' =>$DoctorID,
                                'Booked_At' => null,
                            ];
                            
                        

                            if(!empty($apps)){
                                $appoint->insert(end($apps));
                            }
                           
                        }
                        
                    }
                }
                // show ($apps);
                //              exit();
                redirect('Doctor/Dashboard');   

                // var_dump($apps);
                // exit();
                
                // ✅ Only insert once after loop ends
                // if () {

                //     redirect('Doctor/Dashboard');
                // } else {
                //     $this->view('Doctor/Dashboard', ['message' => 'No time slots added']);
                // }
                

            
        }else{
            redirect('Doctor/Dashboard');
        }
    }

    public function deleteSlot() {

        $slot = new \Modal\TimeSlot;
       
        header('Content-Type: application/json');
        $request = json_decode(file_get_contents('php://input'), true);
        $response = [];
    
        if (isset($request['SlotID'])) {
            $SlotID = $request['SlotID'];
            $slot->delete($SlotID, 'SlotID');
            //$slot->insert(['DoctorID'=> 4, 'Slot_Date'=>'2025-04-26', 'Start_Time'=>'10:00', 'End_Time'=>'11:00', 'Status'=>'available']);
            $response = ['success' => true, 'message' =>$request['SlotID']];
        } else {
            $response = ['success' => true, 'message' => 'No SlotID provided.'];
        }
    
        echo json_encode($response);
        exit();
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