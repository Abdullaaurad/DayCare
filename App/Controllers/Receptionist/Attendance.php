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

        public function PickupDetails(){
            header('Content-Type: application/json');
            $requestData = json_decode(file_get_contents("php://input"), true);
            $ChildID = isset($requestData['ChildID'])? $requestData['ChildID'] : null;

            $PickupModal = new \Modal\Pickup;
            $GuardianModal = new \Modal\Guardian;
            $ChildModal = new \Modal\Child;
            $ParentModal = new \Modal\ParentUser;

            $Data = [];
            $today = date('Y-m-d');

            if($ChildID != null){
                $Pickup = $PickupModal->first(["ChildID" => $ChildID, "Date" => $today]);
                if($Pickup != null && $Pickup->Person == "Guardian"){
                    $child = $ChildModal->first(["ChildID" => $ChildID]);
                    $guardian = $GuardianModal->first(["ParentID" => $child->ParentID]);

                    $Data['NID'] = $guardian->NID;
                    $Data['OTP'] = $Pickup->OTP;

                    $imageData = $guardian->Image;
                    $imageType = $guardian->ImageType;
        
                    $base64Image = (!empty($imageData) && is_string($imageData)) 
                        ? 'data:' . $imageType . ';base64,' . base64_encode($imageData) 
                        : null
                    ;

                    $Data['Image'] = $base64Image;
                    $Data['Person'] = "Guardian";

                }else if($Pickup != null && $Pickup->Person == "New"){
                    $Data['NID'] = $Pickup->NID;
                    $Data['OTP'] = $Pickup->OTP;
                    $imageData = $Pickup->Image;
                    $imageType = $Pickup->ImageType;
        
                    $base64Image = (!empty($imageData) && is_string($imageData)) 
                        ? 'data:' . $imageType . ';base64,' . base64_encode($imageData) 
                        : null
                    ;

                    $Data['Image'] = $base64Image;
                    $Data['Person'] = "New";
                }

                else{
                    $child = $ChildModal->first(["ChildID" => $ChildID]);
                    $Parent = $ParentModal->first(["ParentID" => $child->ParentID]);

                    $Data['NID'] = $Parent->NID;
                    $imageData = $Parent->Image;
                    $imageType = $Parent->ImageType;
        
                    $base64Image = (!empty($imageData) && is_string($imageData)) 
                        ? 'data:' . $imageType . ';base64,' . base64_encode($imageData) 
                        : null
                    ;

                    $Data['Image'] = $base64Image;
                    $Data['Person'] = "Parent";
                }
            }

            echo json_encode($Data);
        }

        private function checkins(){
            $AttendanceModel = new \Modal\Attendance;
            $ChildModal = new \Modal\Child;

            $today = date('Y-m-d');
            $data = $AttendanceModel->where_order_desc(["Start_Date" => $today],[], "Start_Time");

            if(!empty($data)){
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

        public function markAttendance(){
            $ChildID = $_POST['ChildID'];
            show($_POST);
            $AttendanceModel = new \Modal\Attendance;

            $AttendanceModel->insert([
                "ChildID" => $ChildID,
                "Start_Date" => date('Y-m-d'),
                "Start_Time" => date('H:i:s'),
                "Status" => "Present"
            ]);

            redirect("Receptionist/Attendance");
        }

        public function markdeparture(){
            $ChildID = $_POST['ChildID'];
            $AttendanceModel = new \Modal\Attendance;

            $AttendanceModel->update(
                ["ChildID" => $ChildID, "Start_Date" => date('Y-m-d')],
                [
                    "End_Time" => date('H:i:s'),
                    "End_Date" => date('Y-m-d'),
                    "Status" => "Departed"
                ]       
            );

            // show($_POST);
            redirect("Receptionist/Attendance");
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
                    $Child->Start_Time = $Attendance->Start_Time;
                    $Child->End_Time = $Attendance->End_Time;
                    $Child->Pickup = $Attendance->Pickup;
                    $Child->PickupScheduled = ($Attendance->Pickup !== "Parent") ? 1 : 0;
                    $Present[] = $Child;
                } else {
                    $Absent[] = $Child;
                }
            }

            usort($Present, function($a, $b) {
                return strtotime($a->Start_Time) <=> strtotime($b->Start_Time);
            });
            $Data = array_merge($Present, $Absent);
            echo json_encode($Data);
        }
    }
?>