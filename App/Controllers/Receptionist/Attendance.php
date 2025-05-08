<?php

    namespace Controller;
    use App\Helpers\ChildHelper;

    defined('ROOTPATH') or exit('Access denied');

    class Attendance
    {
        use MainController;

        public function index(){
            $session = new \core\Session;
            $session->check_login();

            $data['Profile'] = $this->Profile();
            $data['graph'] = $this->graph();
            $data['checkin'] = $this->checkins();

            $this->view('Receptionist/attendance', $data);
        }

        private function checkins(){
            $AttendanceModel = new \Modal\Attendance;
            $ChildModal = new \Modal\Child;

            $today = date('Y-m-d');
            $data = $AttendanceModel->where_order_desc(["Start_Date" => $today],[], "Start_Time");

            foreach ($data as $value){
                $Child = $ChildModal->first(["ChildID" => $value->ChildID]);
                $value->ChildName = $Child->First_Name . ' ' . $Child->Last_Name;

                $imageData = $Child->Image;
                $imageType = $Child->ImageType;
    
                $base64Image = (!empty($imageData) && is_string($imageData)) 
                    ? 'data:' . $imageType . ';base64,' . base64_encode($imageData) 
                    : null
                ;

                $value->Image = $base64Image;
            }

            return $data;
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

        private function graph() {
            $AttendanceModel = new \Modal\Attendance;
        
            $today = date('Y-m-d');
            $lastMonday = date('Y-m-d', strtotime('monday last week', strtotime($today)));
        
            $attendanceCounts = [];
            for ($i = 0; $i < 7; $i++) {
                $date = date('Y-m-d', strtotime("+$i days", strtotime($lastMonday)));
                $dayName = date('l', strtotime($date));
                $entries = $AttendanceModel->where_norder(['Start_Date' => $date], []);
                $attendanceCounts[$dayName] = !empty($entries) ? count($entries) : 0;
            }

            $total = array_sum($attendanceCounts);        
            return [
                "data" => $attendanceCounts,
                "All" => $total
            ];
        }        

        public function Logout(){
            $session = new \core\Session();
            $session->logout();
    
            echo json_encode(["success" => true]);
            exit;
        }

        public function Rows(){
            header('Content-Type: application/json');
            $requestData = json_decode(file_get_contents("php://input"), true);
            $Filter = isset($requestData['Filter'])? $requestData['Filter'] : null;

            $AttendanceModel = new \Modal\Attendance;
            $ChildModal = new \Modal\Child;
            $PickupModal = new \Modal\Pickup;

            $today = date('Y-m-d');

            // Fetch children based on filter
            if ($Filter) {
                $Children = $ChildModal->where_norder(['ChildID' => $Filter]);
            } else {
                $Children = $ChildModal->findall();
            }

            $Present = [];
            $Absent = [];

            foreach ($Children as $Child) {
                $Child->ChildIDEdited = 'SRD' . str_pad($Child->ChildID, 5, '0', STR_PAD_LEFT);
                $Child->ChildName = $Child->First_Name . ' ' . $Child->Last_Name;
                $Attendance = $AttendanceModel->first(["ChildID" => $Child->ChildID, "Start_Date" => $today]);
                
                $imageData = $Child->Image;
                $imageType = $Child->ImageType;
                $base64Image = (!empty($imageData) && is_string($imageData)) 
                    ? 'data:' . $imageType . ';base64,' . base64_encode($imageData) 
                    : null;
                $Child->Image = $base64Image;

                if ($Attendance) {
                    $Child->Pickup = ($Attendance->Pickup !== "Parent") ? 1 : 0;
                    $Present[] = $Child;
                } else {
                    $Absent[] = $Child;
                }
            }

            $Data = array_merge($Present, $Absent);
            echo json_encode($Data);
        }
    }
?>