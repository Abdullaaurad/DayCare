<?php

    namespace Controller;
    use App\Helpers\ChildHelper;

    defined('ROOTPATH') or exit('Access denied');

    class Home{
        use MainController;
        public function index(){
            $session = new \core\Session;
            $session->check_login();

            $data['Profile'] = $this->Profile();
            $data['Visitors'] = $this->visitors();
            $data['stats'] = $this->store_stats();
            $data['graph'] = $this->store_graph();
            $this->view('Receptionist/home',$data);
        }

        private function Profile(){
            $session = new \core\Session;
            $session->set('USERID', 24);
            $UserID = $session->get('USERID');

            $ReceptionistModal = new \Modal\Receptionist;
            $data = $ReceptionistModal->first(["UserID" => $UserID]);
            if(!empty($data)){
                $imageData = $data->Image;
                $imageType = $data->ImageType;
                $base64Image = (!empty($imageData) && is_string($imageData)) 
                    ? 'data:' . $imageType . ';base64,' . base64_encode($imageData) 
                    : null
                ;
                $data->Image = $base64Image;
                $data->EmployeeID = 'EMP' . str_pad($data->UserID, 5, '0', STR_PAD_LEFT);
            }

            return $data;
        }

        private function store_stats(){
            $AttendanceModal = new \Modal\Attendance;
            $MaidModal = new \Modal\Maid;
            $EmployeeAttendanceModal = new \Modal\EmployeeAttendance;
            $ChildModal = new \Modal\Child;
            $MaidModal = new \Modal\Maid;
            $TeacherModal = new \Modal\Teacher;
        
            $presentChildren = $AttendanceModal->where_norder(["Status" => "Present"], []);
            $totalPresentChildren = count($presentChildren);
        
            $allChildren = $ChildModal->findall();
            $totalChildren = count($allChildren);
        
            $availableMaids = [];
            $allMaids = $MaidModal->findall();
            foreach ($allMaids as $maid) {
                $attendance = $EmployeeAttendanceModal->first(["UserID" => $maid->UserID, "Status" => "Present"]);
                if (!empty($attendance)) {
                    $availableMaids[] = $maid->MaidID;
                }
            }
        
            $totalAvailableMaids = count($availableMaids);
            $slotCapacity = $totalAvailableMaids * 5;
            $availableSlots = $slotCapacity - $totalPresentChildren;
            $availableSlotPercentage = $slotCapacity > 0 ? $slotCapacity : 0;
            $absentPercentage = $totalChildren > 0 ? $totalChildren : 0;

            $AttendedEmployee = $EmployeeAttendanceModal->where_norder(["Status" => "Present"], []);
            $totalAttendedEmployee = count($AttendedEmployee);

            $AllTeachers = $TeacherModal->findall();
            $AllMaids = $MaidModal->findall();
        
            $data = [
                'presentCount' => $totalPresentChildren,
                'absentPercentage' => $absentPercentage,
                'availableSlots' => $availableSlots,
                'availableSlotPercentage' => $availableSlotPercentage -$availableSlots,
                'totalEmployeePresent' => $totalAttendedEmployee,
                'totalEmployee' => count($AllMaids) + count($AllTeachers)
            ];

            return $data;
        }

        private function store_graph(){
            $ChildModal = new \Modal\Child;
            $AttendanceModal = new \Modal\Attendance;
            $ChildHelper = new ChildHelper();

            $data['3-5'] = [
                "Present" => 0,
                "Absent" => 0,
            ];
            $data['6-9'] = [
                "Present" => 0,
                "Absent" => 0,
            ];
            $data['10-13'] = [
                "Present" => 0,
                "Absent" => 0,
            ];

            $Children = $ChildModal->findall();
            foreach($Children as $child){
                $AgeGroup = $ChildHelper->getAgeGroup($child->DOB);
                $Attendance = $AttendanceModal->first(["ChildID" => $child->ChildID, "Status" => "Present"]);
                switch($AgeGroup){
                    case "3-5":
                        if(!empty($Attendance)){
                            $data['3-5']["Present"] += 1;
                        }else{
                            $data['3-5']["Absent"] += 1;
                        }
                    break;
                    case "6-9":
                        if(!empty($Attendance)){
                            $data['6-9']["Present"] += 1;
                        }else{
                            $data['6-9']["Absent"] += 1;
                        }
                    break;
                    case "10-13":
                        if(!empty($Attendance)){
                            $data['10-13']["Present"] += 1;
                        }else{
                            $data['10-13']["Absent"] += 1;
                        }
                    break;
                }
            }

            return $data;
        }

        public function Logout(){
            $session = new \core\Session();
            $session->logout();
    
            echo json_encode(["success" => true]);
            exit;
        }

        private function visitors(){
            $VistorModal = new \Modal\Visitor;
            $today = date('Y-m-d');

            $Visitors = $VistorModal->where_order_desc(["Date" =>$today], [], "Start_Time");
            return $Visitors;
        }
    }
?>