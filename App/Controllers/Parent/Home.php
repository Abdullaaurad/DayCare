<?php

    namespace Controller;
    use App\Helpers\SidebarHelper;
    use App\Helpers\ChildHelper;

    defined('ROOTPATH') or exit('Access denied');

    class Home{
        use MainController;
        public function index(){

            $session = new \Core\Session;
            // $session->set("USERID", 1);
            $session->check_login();

            $data = [];
            $SidebarHelper = new SidebarHelper();
            $data = $SidebarHelper->store_sidebar();

            $data['children'] = $this->store_child_details($data['children']);
            $data['reminders'] = $this->store_reminders();

            $ChildHelper = new ChildHelper();
            $data['Child_Count'] = $ChildHelper->child_count();
            $data = $data + $this->store_stats();
            $data = $data + $this->store_meeting_times();
            $data = $data + $this->store_payment();

            $session->set("Location" , 'Parent/Home');
            $this->view('Parent/home',$data);
        }

        public function SeenNotification(){
            $session = new \Core\Session;
            $session->set("USERID", 1);
            header('Content-Type: application/json');
            $NotificationModal = new \Modal\ChildNotification;
    
            $Notifications = $this->Notifications();
            if(!empty($Notifications['data'])){
                foreach ($Notifications['data'] as $Note){
                    $NotificationModal->update(["NotificationID"=>$Note->NotificationID], ["Seen" => 1]);
                }
            }
    
            echo json_encode(['success' => true, 'message' => 'Notification is seen by user']);
        }
    
        private function Notifications() {
            $session = new \Core\Session;
            $session->set("USERID", 1);
            $NotificationModal = new \Modal\ChildNotification;
            $ChildHelper = new ChildHelper();
            $Children = $ChildHelper->store_child();
        
            $currentDate = date('Y-m-d');
            $currentTime = date('H:i:s');
            $Notifications = ['data' => []];
        
            foreach ($Children as $Child) {
                if ($currentTime >= '08:00:00' && $currentTime < '12:00:00') {
                    $result = $NotificationModal->findFutureDatesWithConditions(
                        "08:00:00", "12:00:00",
                        ["ChildID" => $Child->ChildID, "Date" => $currentDate],
                        "Time"
                    );
                } elseif ($currentTime >= '12:00:00' && $currentTime < '20:00:00') {
                    $result = $NotificationModal->findFutureDatesWithConditions(
                        "11:59:00", "20:00:00",
                        ["ChildID" => $Child->ChildID, "Date" => $currentDate],
                        "Time"
                    );
                } else {
                    $result = [];
                }
        
                if (!empty($result)) {
                    $Notifications['data'] = array_merge($Notifications['data'], $result);
                }
            }
        
            $Count = 0;
            foreach ($Notifications['data'] as $Note) {
                if ($Note->Seen == 0) {
                    $Count++;
                }
            }
        
            $Notifications['Seen'] = $Count;
            return $Notifications;
        }

        private function store_stats(){

            $session = new \Core\Session;
            $session->set("USERID", 1);
            $today = new \DateTime();
            $today = $today->format("Y-m-d");
            $session = new \Core\Session;
            $ChildHelper = new ChildHelper();
            $childattended = false;
            $hasPickup = false;
            $Children = $ChildHelper->store_child();
            
            foreach ($Children as $child) {
                $AttendanceModal = new \Modal\Attendance;
                $attendanceRow = $AttendanceModal->first(["ChildID" => $child->ChildID, "Status" => "Present"]);
                
                if ($attendanceRow) {
                    $childattended = true;
                }
            
                $PickupModal = new \Modal\Pickup;
                $row = $PickupModal->first(['ChildID' => $child->ChildID, 'Date' => $today, "AllChild" => 1]);
                
                if ($row) {
                    $hasPickup = true;
                    if ($row->Person == 'New') {
                        $imageData = $row->Image;
                        $imageType = $row->ImageType;
                        $base64Image = (!empty($imageData) && is_string($imageData)) 
                            ? 'data:' . $imageType . ';base64,' . base64_encode($imageData) 
                            : null;
                        $stats['stat2'] = [
                            'Time' => $row->Time,
                            'Person' => $row->Person,
                            'Image' => $base64Image,
                            'OTP' => $row->OTP,
                            "NID" => $row->NID,
                        ];
                    } else {
                        $stats['stat2'] = [
                            'Time' => $row->Time,
                            'Person' => $row->Person,
                            'OTP' => $row->OTP
                        ];
                    }
                    break;
                }
            }
            
            if (!$childattended) {
                $stats['stat2'] = [
                    'nochild' => 'No child attended'
                ];
            } elseif (!$hasPickup) { 
                $stats['stat2'] = [
                    'Time' => '8:00PM',
                    'Person' => 'Parent'
                ];
            }            

            $UserID = $session->get("USERID");
            $ParentModal = new \Modal\ParentUser;
            $Parent = $ParentModal->first(["UserID" => $UserID]);
            $GuardianModal = new \Modal\Guardian;
            $Guardian = $GuardianModal->first(["ParentID" => $Parent->ParentID]);

            $imageData = $Guardian->Image;
            $imageType = $Guardian->ImageType;
            $base64Image = (!empty($imageData) && is_string($imageData)) 
                ? 'data:' . $imageType . ';base64,' . base64_encode($imageData) 
                : null;

            $stats['guardian']['Image'] = $base64Image;
            $stats['guardian']['name'] = $Guardian->First_Name . ' ' . $Guardian->Last_Name ;

            $UserID = $session->get("USERID");
            $MeetingModal = new \Modal\Meeting;
            $ParentModal = new \Modal\ParentUser;
            $firstday = date('Y-m-d');
            $lastday = date('Y-m-d', strtotime($firstday . ' +7 days'));
            $Meeting = $MeetingModal->findFutureDatesWithConditions($firstday, $lastday ,["ParentID" => $Parent->ParentID , "Scheduled" => 1]);

            if($Meeting && $Meeting[0]->Date == $today){
                $stats['stat1'] = [
                    'Time' => $Meeting[0]->Time,
                    'Date' => $Meeting[0]->Date,
                    'today' => 1
                ];
            }else if($Meeting){
                $stats['stat1'] = [
                    'Time' => $Meeting[0]->Time,
                    'Date' => $Meeting[0]->Date,
                    'today' => 0
                ];
            }
    
            return $stats;
        }

        private function store_payment(){
            $session = new \Core\Session;
            $session->set("USERID", 1);
            $data = [];
            $FeesModal = new \Modal\Fees;
            $Childhelper = new ChildHelper();
            $children = $Childhelper->store_child();

            foreach ($children as $child){
                $childPayments = $FeesModal->where_order_desc(["ChildID" => $child->ChildID, "Status" => "Unpaid"], [], "DueDate");

                $Amount = 0;
                $DueDate = null;
        
                if(!empty($childPayments)){
                    foreach ($childPayments as $payment) {
                        $Amount += $payment->Amount;
                    }
    
                    $data['Due']['Date'] = date('Y-m-d', strtotime($childPayments[0]->DueDate));
                    if(isset($data['Due']['Amount'])){
                        $data['Due']['Amount'] += $payment->Amount;
                    }else{
                        $data['Due']['Amount'] = $payment->Amount;
                    }            
                }
                
                $LastBill = $FeesModal->where_order_desc(["ChildID" => $child->ChildID], [], "DueDate");
                if (!empty($LastBill)) {
                    if (!isset($data['LastBill']['Amount'])) {
                        $data['LastBill']['Amount'] = $LastBill[0]->Amount;
                    } else {
                        $data['LastBill']['Amount'] += $LastBill[0]->Amount;
                    }
                }
    
                $ExpensesModal = new \Modal\Expense;
                $firstDayOfMonth = date('Y-m-01');
                $firstDayOfNextMonth = date('Y-m-01', strtotime('+1 month', strtotime($firstDayOfMonth)));
                $childExpenses = $ExpensesModal->where_order_desc(["ChildID" => $child->ChildID, "Date" => $firstDayOfMonth ], [], "Date");
                if($childExpenses){
                    $Amount = 0;
                    foreach ($childExpenses as $expense) {
                        $Amount += $expense->Amount;
                    }
                    if (!isset($data['Expenses']['Amount'])) {
                        $data['Expenses']['Amount'] = $Amount;
                    } else {
                        $data['Expenses']['Amount'] += $Amount;
                    }
                    $data['Expenses']['Date'] = date('Y-m-d', strtotime($firstDayOfNextMonth));
                }
            }

            return $data;
        }

        public function deletePickup(){
            $session = new \Core\Session;
            $session->set("USERID", 1);
            header('Content-Type: application/json');
            $requestData = json_decode(file_get_contents("php://input"), true);

            $today = new \DateTime();
            $today = $today->format("Y-m-d");
            $ChildHelper = new ChildHelper();
            $Children = $ChildHelper->store_child();

            foreach ($Children as $child) {
                $PickupModal = new \Modal\Pickup;
                $row = $PickupModal->first(['ChildID' => $child->ChildID, 'Date' => $today, "AllChild" => 1]);

                if ($row) {
                    $PickupModal->delete($row->PickupID , "PickupID");
                }
            }
            echo json_encode(['success' => true, 'message' => '']);
        }

        public function deleteMeeting(){
            $session = new \Core\Session;
            $session->set("USERID", 1);
            header('Content-Type: application/json');
            $requestData = json_decode(file_get_contents("php://input"), true);

            $session = new \Core\Session;
            $UserID = $session->get("USERID");
            $ParentModal = new \Modal\ParentUser;
            $MeetingModal = new \Modal\Meeting;

            $Parent = $ParentModal->first(["UserID" => $UserID]);
            $selectedmeeting = $MeetingModal->first(["ParentID" => $Parent->ParentID]);
            if($selectedmeeting){
                $MeetingModal->update(["MeetingID" => $selectedmeeting->MeetingID], ["ParentID" => NULL, "Scheduled" => false]);
            }

            echo json_encode(['success' => true, 'message' => '']);
        }

        private function store_meeting_times() {
            $session = new \Core\Session;
            $session->set("USERID", 1);
            $session = new \Core\Session;
            $UserID = $session->get("USERID");
            $MeetingModal = new \Modal\Meeting;
            $ParentModal = new \Modal\ParentUser;
        
            $firstday = date('Y-m-d', strtotime('+1 day'));
            $lastday = date('Y-m-d', strtotime($firstday . ' +7 days'));
        
            $Parent = $ParentModal->first(["UserID" => $UserID]);
        
            $Meetings = $MeetingModal->findFutureDatesWithConditions($firstday, $lastday, ["Scheduled" => 0]);
            $Meeting = $MeetingModal->findFutureDatesWithConditions($firstday, $lastday , ['ParentID' => $Parent->ParentID, "Scheduled" => 1]);
        
            // Ensure both are arrays
            $Meetings = is_array($Meetings) ? $Meetings : [];
            $Meeting = is_array($Meeting) ? $Meeting : ($Meeting ? [$Meeting] : []);
        
            // Merge both meeting sets
            $allMeetings = array_merge($Meetings, $Meeting);
        
            // Convert all items to objects to prevent property access issues
            foreach ($allMeetings as &$meeting) {
                if (is_array($meeting)) {
                    $meeting = (object) $meeting;
                }
            }
            unset($meeting);
        
            // Sort the meetings by Time
            usort($allMeetings, function ($a, $b) {
                return strtotime($a->Time) <=> strtotime($b->Time); // safer way to compare timestamps
            });
        
            $data['Meetingslots'] = $allMeetings;
            return $data;
        }        

        public function handlemeetings(){
            $session = new \Core\Session;
            $session->set("USERID", 1);
            header('Content-Type: application/json'); // Important for AJAX
        
            $session = new \Core\Session;
            $UserID = $session->get("USERID");
            $ParentModal = new \Modal\ParentUser;
            $MeetingModal = new \Modal\Meeting;
        
            $Parent = $ParentModal->first(["UserID" => $UserID]);
            if (!$Parent) {
                echo json_encode([
                    'success' => false,
                    'error' => 'User not found.'
                ]);
                exit;
            }
        
            $meetingID = $_POST['meeting_slot'] ?? null;
        
            if (!$meetingID) {
                echo json_encode([
                    'success' => false,
                    'error' => 'Please select a meeting slot.'
                ]);
                exit;
            }
        
            // Get valid slots
            $data = $this->store_meeting_times();
            $validSlots = array_column($data['Meetingslots'], 'MeetingID');
        
            if (!in_array($meetingID, $validSlots)) {
                echo json_encode([
                    'success' => false,
                    'error' => 'Invalid meeting slot selected. Please choose a valid date and time.'
                ]);
                exit;
            }
        
            // Unschedule previous meeting if any
            $selectedmeeting = $MeetingModal->first(["ParentID" => $Parent->ParentID]);
            if ($selectedmeeting) {
                $MeetingModal->update(
                    ["MeetingID" => $selectedmeeting->MeetingID],
                    ["ParentID" => null, "Scheduled" => false]
                );
            }
        
            // Schedule new meeting
            $MeetingModal->update(
                ["MeetingID" => $meetingID],
                ["ParentID" => $Parent->ParentID, "Scheduled" => true]
            );
        
            echo json_encode([
                'success' => true,
                'message' => 'Meeting scheduled successfully.'
            ]);
            exit;
        }
        
        public function handlePickups(){
            $session = new \Core\Session;
            $session->set("USERID", 1);
            header('Content-Type: application/json');
        
            $session = new \Core\Session;
            $ChildHelper = new ChildHelper();
            $PickupModal = new \Modal\Pickup;
            $Children = $ChildHelper->store_child();
            $Pickup = new \Modal\Pickup;
        
            $today = (new \DateTime())->format("Y-m-d");
        
            $_POST['Person'] = $_POST['PersonType'] ?? null;
            $_POST['AllChild'] = 1;
            $_POST['Date'] = $today;
        
            unset($_POST['PersonType'], $_POST['selectedPerson'], $_POST['inform']);
        
            // Handle image
            if (
                isset($_FILES['newPersonImage']) &&
                $_FILES['newPersonImage']['error'] === UPLOAD_ERR_OK &&
                ($_POST['Person'] === 'New')
            ) {
                $imageFile = $_FILES['newPersonImage'];
                $imageType = mime_content_type($imageFile['tmp_name']);
                $imageBlob = file_get_contents($imageFile['tmp_name']);
        
                if ($imageBlob !== false) {
                    $_POST['Image'] = $imageBlob;
                    $_POST['ImageType'] = $imageType;
                } else {
                    echo json_encode(['success' => false, 'error' => "Failed to read the image file."]);
                    exit;
                }
            }
        
            // Validate
            if (!$Pickup->validate($_POST)) {
                echo json_encode(['success' => false, 'error' => $Pickup->errors['Time'] ?? "Validation failed."]);
                exit;
            }
        
            foreach ($Children as $child) {
                $row = $PickupModal->first(['ChildID' => $child->ChildID, 'Date' => $today, "AllChild" => 1]);
                if ($row) {
                    $PickupModal->delete($row->PickupID , "PickupID");
                }
            }
        
            foreach ($Children as $Child){
                $_POST['ChildID'] = $Child->ChildID;
                $AttendanceModal = new \Modal\Attendance;
                $attendanceRow = $AttendanceModal->first(["ChildID" => $Child->ChildID, "Status" => "Present"]);
        
                if ($attendanceRow) {
                    $PickupModal->insert($_POST);
                }
            }
        
            echo json_encode(['success' => true, 'message' => "Pickup scheduled successfully!"]);
            exit;
        }        

        private function store_reminders() {
            $session = new \Core\Session;
            $session->set("USERID", 1);
            $reminderModal = new \Modal\Reminder;
            $ChildHelper = new ChildHelper();
            $childrens = $ChildHelper->store_child();
        
            $data = [];
            $today = date('Y-m-d');
        
            foreach ($childrens as $child) {
                $reminders = $reminderModal->where_norder(["ChildID" => $child->ChildID, "Date" => $today]);
        
                if(!empty($reminders)) {
                    foreach ($reminders as &$reminder) {
                        $reminder->Name = $child->First_Name;
                    }
                    // Only merge if reminders is an array
                    if (is_array($reminders)) {
                        $data = array_merge($data, $reminders);
                    }
                }
            }
            return $data;
        }        
        
        private function store_attendance($ChildID) {   
            $session = new \Core\Session;
            $session->set("USERID", 1);     
            $today = new \DateTime();
            $todayFormatted = $today->format("Y-m-d");
        
            $monday = clone $today;
            $monday->modify('Monday this week');
            $mondayFormatted = $monday->format("Y-m-d");
        
            $AttendanceModal = new \modal\Attendance;
            
            $attendedDays = 0;
            $totalDays = 0;
        
            $currentDate = clone $monday;
            while ($currentDate <= $today) {
                $dateFormatted = $currentDate->format("Y-m-d");
                $attendance = $AttendanceModal->first(["ChildID" => $ChildID, "Start_Date" => $dateFormatted]);
        
                if ($attendance) {
                    // If the child stayed overnight and left after 08:00 AM next day
                    if ($attendance->End_Date && $attendance->End_Date > $dateFormatted && $attendance->End_Time > "08:00") {
                        $attendedDays += 2; // Count as two days
                    } else {
                        $attendedDays++;
                    }
                }
        
                $totalDays++;
                $currentDate->modify("+1 day");
            }
            $attendancePercentage = ($totalDays > 0) ? ($attendedDays / $totalDays) * 100 : 0;
        
            $data = round($attendancePercentage, 2);
            return $data;
        }

        private function store_child_details($children) {
            $session = new \Core\Session;
            $session->set("USERID", 1);
            foreach ($children as &$child) {
                $AttendanceModal = new \Modal\Attendance;
                $row = $AttendanceModal->first(["ChildID" => $child['Id'], "Status" => 'Present']);
                
                if ($row) {
                    $child['Status'] = $row->Status; // Accessing as an object
                } else {
                    $child['Status'] = "Absent";
                }
        
                $reservationModal = new \Modal\Reservation;
                $reservations = $reservationModal->where_norder(["ChildID" => $child['Id']]);
        
                if (!empty($reservations)) {
                    $upcomingReservations = array_filter($reservations, function($reservation) {
                        $reservationDate = strtotime($reservation->Date); // Use object syntax
                        return $reservationDate >= strtotime(date('Y-m-d')); // Compare with today's date
                    });
        
                    // Find the closest upcoming reservation
                    if (!empty($upcomingReservations)) {
                        usort($upcomingReservations, function($a, $b) {
                            return strtotime($a->Date) - strtotime($b->Date); // Use object syntax
                        });
        
                        // Store the closest upcoming reservation date in the child array
                        $child['upcomingreservations'] = $upcomingReservations[0]->Date; // Use object syntax
                    }
                } else {
                    $child['upcomingreservations'] = 'No reservations';
                }

                $child['graph'] = $this->store_attendance($child['Id']);

                
                $ChildModal = new \Modal\Child;
                $Children = $ChildModal->first(["ChildID" => $child['Id']]);

                $CurrentDate = new \DateTime();
                $CurrentDate = $CurrentDate->format('Y-m-d');
                $CurrentTime = (new \DateTime())->format('H:i:s');

                $row = $AttendanceModal->first([
                    "ChildID" => $child['Id'], 
                    "Status" => 'Present', 
                    "Start_Date" => $CurrentDate
                ]);

                // Map the age to the corresponding age group
                $ChildHelper = new ChildHelper();
                $AgeGroup = $ChildHelper->getAgeGroup($Children->DOB);

                if ($row) {
                    $AssignModal = new \Modal\AssignTeacher;
                    $ActivityModal = new \Modal\Activity;

                    // Get all subjects assigned for the child's age group today
                    $subjects = $AssignModal->where_order(["Agegroup" => $AgeGroup, "Date" => $CurrentDate], [], 'Start_Time');

                    // Filter the activities to check if the current time is within Start_Time and End_Time
                    if(!empty($subjects)){
                        $currentActivity = array_filter($subjects, function ($subject) use ($CurrentTime) {
                            return $subject->Start_Time <= $CurrentTime && $subject->End_Time >= $CurrentTime;
                        });
                        if (!empty($currentActivity)) {
                            $currentActivity = reset($currentActivity);
                        }
                    }

                    // Get the first valid activity
                    

                    if (!empty($currentActivity)) {
                        // Fetch activity details using WorkID
                        $activityDetails = $ActivityModal->first(["WorkID" => $currentActivity->WorkID]);
                        $child['Activity'] = $currentActivity->Activity ?? "No Subject";
                        $child['Description'] = $activityDetails->Description ?? "No Description";
                    } else {
                        $child['Activity'] = "No ongoing activity";
                        $child['Description'] = "";
                    }
                } else {
                    $child['Activity'] = "Child not present";
                    $child['Description'] = "";
                }
            }
            return $children;
        }        

        public function setchildsession(){
            $session = new \Core\Session;
            $session->set("USERID", 1);

            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            header('Content-Type: application/json');
            $request = json_decode(file_get_contents('php://input'), true);
            $response = [];
        
            $session = new \Core\Session;
            if (isset($request['ChildID'])) {
                $session->set('CHILDID', $request['ChildID']);
                $response = ['success' => true, 'message' => 'Child session removed.'];
            } else {
                $response = ['success' => false, 'message' => 'No child session to remove.'];
            }
    
            echo json_encode($response);
            exit();
        }

        public function Logout(){
            $session = new \Core\Session;
            $session->set("USERID", 1);
            $session = new \core\Session();
            $session->logout();

            echo json_encode(["success" => true]);
            exit;
        }

        public function minimize() {
            $session = new \Core\Session;
            $session->set("USERID", 1);
            $session = new \Core\Session();
            $minimized = $session->get("MINIMIZE");
            $session->set("MINIMIZE", !$minimized);
            echo json_encode(["success" => true, "minimize" => !$minimized]);
            exit;
        }        
    }  
?>