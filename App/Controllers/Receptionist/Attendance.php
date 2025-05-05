<?php

    namespace Controller;
    use App\Helpers\ChildHelper;
    defined('ROOTPATH') or exit('Access denied');

    class Attendance{
        use MainController;
        
        public function index(){
            $childModel = new \Modal\Child();
            $pickup = new \Modal\Pickup();
            $attend = new \Modal\Attendance();
            $lastSunday = date('Y-m-d', strtotime('last Sunday'));
            $sun = count($attend->where_norder(['Start_Date'=>$lastSunday],[]));
        
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $childHelper= new ChildHelper();
                $datas['childrens'] =  $childModel->findall();
                foreach($datas['childrens'] as $child){
                    $child->ageGroup = $childHelper->getAgeGroup($child->DOB);
                }
                
                // Initialize empty array to hold filtered children
                $data['children'] = [];
                
                // Filter children by selected age group
                foreach($datas['childrens'] as $child) {
                    if($child->ageGroup === $_POST['ageGroup']){
                        // Add this child to the filtered array
                        $data['children'][] = $child;
                    }
                }

                foreach($data['children'] as $child){   
                    $pickups = null;
                    $attends = $attend->where_norder(['ChildID' => $child->ChildID, 'Start_Date' => date('Y-m-d')],[]);

                    $pickups = $pickup->first(['ChildID' => $child->ChildID, 'Date' => date('Y-m-d')]);
                    
                    
                    

                    
                    if(isset($attends[0])){
                    $child->Start_Time = $attends[0]->Start_Time;
                    $child->End_Time = $attends[0]->End_Time;
                    }
                    $childPic =  $child->Image;
                    $base64Image = base64_encode($childPic);
                    $child->Image = 'data:image/jpg;base64,' . $base64Image;
                    if(!empty($pickups)){
                        $child->pickups = (array)$pickups;
                    }
                }
                //show($data);
                
                $this->view('Receptionist/attendance',$data);
            }else{
            
                
                $data['children'] =  $childModel->findall();
                foreach($data['children'] as $child){
                    $attends = $attend->where_norder(['ChildID' => $child->ChildID, 'Start_Date' => date('Y-m-d')],[]);
                   

                    //  show($pickups);
                    //  exit();
                    if(isset($attends[0])){
                    $child->Start_Time = $attends[0]->Start_Time;
                    $child->End_Time = $attends[0]->End_Time;
                    }
                    $childPic =  $child->Image;
                    $base64Image = base64_encode($childPic);
                    $child->Image = 'data:image/jpg;base64,' . $base64Image;
                    
                    
                   
                    //   var_dump($child);
                    //  exit();
                    // $child->End_Time = $attends[0]->End_Time;

                }
                
                // var_dump($data['children']);
                // exit();
          $this->view('Receptionist/attendance',$data); 
        }  
           
        }
        public function markAttendance(){
            $AttendanceModel = new \Modal\Attendance();
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Directly take input from the form
                
                $data = [
                    'ChildID'   => $_POST['childID'],
                    'Start_Date'    => date('Y-m-d'),
                    'Start_Time'        => date('H:i:s'),
                    'Status'        => 'Present',
                ];
               
                if ($AttendanceModel->validate($data)) {
                    // Insert the data into the database
                    $AttendanceModel->insert($data);
                    // Redirect to success page or display a success message
                    redirect('Receptionist/attendance');
                } 
        }
        //    $this->view('Receptionist/attendance');
        }
        public function finAttendance(){
            $AttendanceModel = new \Modal\Attendance();
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Directly take input from the form
                
                $data = [
                    
                    'End_Time'        => date('H:i:s'),
                    'Status'        => 'Departed',
                    
                ];

                
                if ($AttendanceModel->validate($data)) {
                    // Insert the data into the database
                    $AttendanceModel->update_withid($_POST['childID'],$data,'ChildID');
                    // Redirect to success page or display a success message
                    redirect('Receptionist/attendance');
                }
                 
        }

        
    }
   
}
    
    ?>