<?php

namespace Controller;
use App\Helpers\SidebarHelper;
use App\Helpers\ChildHelper;
use DateTime;

defined('ROOTPATH') or exit('Access denied');

class Home
{
    use MainController;

    public function index()
    {
        // $session = new \Core\Session;
        //  
        $session = new \Core\Session;
        $session->check_login();
        $session->check_child();
        $ChildID = $session->get("CHILDID");
        $session->set("CHILDID", $ChildID);

        $data = [];
        $SidebarHelper = new SidebarHelper();
        $data = $SidebarHelper->store_sidebar();

        $ChildModal = new \Modal\Child;
        $select = $ChildModal->first(['ChildID' => $ChildID]);
        $data['child_id'] = $ChildID;

        if (!empty($select)) {
            $data2 = $this->selectedchild($select);
            $data = $data + $data2;
        }

        $data = $data + $this->store_attendance();
        $data = $data + $this->store_stats();
        $data['holiday'] = $this->holidays();
        $data['Notification'] = $this->Notifications();
        $data['reminders'] = $this->store_reminders();
        $session->set("Location" , 'Child/Home');

        $this->view('Child/home', $data);
    }

    private function store_reminders() {
        $reminderModal = new \Modal\Reminder;
        $childModal = new \Modal\Child;
        $session = new \Core\Session;
    
        $ChildID = $session->get("CHILDID");
        $today = date('Y-m-d');
    
        $data = [];
        $child = $childModal->first(["ChildID" => $ChildID]);
    
        if ($child) {
            // Fetch reminders for this child
            $reminders = $reminderModal->where_order(["ChildID" => $ChildID, "Date" => $today], [], "Date");
            if (!empty($reminders)) {
                foreach ($reminders as &$reminder) {
                    $reminder->Name = $child->First_Name; // Add child's name into reminder
                }
    
                // Merge into data
                if (is_array($reminders)) {
                    $data = array_merge($data, $reminders);
                }
            }
        }
        return $data;
    }    

    public function SeenNotification(){
        $session = new \Core\Session;
         
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
         
        $NotificationModal = new \Modal\ChildNotification;
        $session = new \Core\Session;
        $ChildID = $session->get("CHILDID");
    
        $currentDate = date('Y-m-d');
        $currentTime = date('H:i:s');
        $Notifications = [];       
        
        if ($currentTime >= '08:00:00' && $currentTime < '12:00:00') {
            $Notifications['data'] = $NotificationModal->findFutureDatesWithConditions("08:00:00", "12:00:00", ["ChildID" => $ChildID,"Date" => $currentDate], "Time");
        }
        elseif ($currentTime >= '12:00:00' && $currentTime < '20:00:00') {
            $Notifications['data'] = $NotificationModal->findFutureDatesWithConditions("11:59:00", "20:00:00", ["ChildID" => $ChildID,"Date" => $currentDate], "Time");
        }

        $Count = 0;

        if(!empty($Notifications['data'])){
            foreach ($Notifications['data'] as $Note){
                if($Note->Seen == 0){
                    $Count ++;
                }
            }
        }

        $Notifications['Seen'] = $Count;
        return $Notifications;
    }    

    private function holidays() {
        $session = new \Core\Session;
         
        $HolidayModal = new \Modal\Holiday;
        $firstDate = new DateTime();
        $lastDate = (clone $firstDate)->modify('+30 days');
        $Holidays = $HolidayModal->findFutureDates($firstDate, $lastDate);

        return($Holidays);
    }    

    public function GetCalendar(){
        $session = new \Core\Session;
         
        // Get raw JSON from POST
        $raw = file_get_contents("php://input");
        $body = json_decode($raw, true);

        $year = isset($body['Year']) ? (int)$body['Year'] : date('Y');
        $month = isset($body['Month']) ? (int)$body['Month'] : date('n');

        $firstDay = new DateTime("$year-$month-01");
        $startDayOfWeek = (int)$firstDay->format('N'); // 1 = Mon, 7 = Sun
        $totalDays = (int)$firstDay->format('t');
        $monthName = $firstDay->format('F');

        $days = [];
        for ($i = 1; $i <= $totalDays; $i++) {
            $date = new DateTime("$year-$month-$i");
            $days[] = [
                'day' => $i,
                'date' => $date->format('Y-m-d'),
                'dayOfWeek' => (int)$date->format('N') // 1 = Mon
            ];
        }

        $firstdate = date("Y-m-01", strtotime("$year-$month-01"));
        $lastdate = date("Y-m-t", strtotime("$year-$month-01"));
        $AttendanceModal = new \Modal\Attendance;
        $session = new \Core\Session;
        $ChildID = $session->get("CHILDID");
        
        $AttendanceModal = new \Modal\Attendance;
        $session = new \Core\Session;
        $ChildID = $session->get("CHILDID");
        
        $records = $AttendanceModal->findFutureDatesWithConditions($firstdate, $lastdate, ["ChildID" => $ChildID], "Start_Date");
        $Attendance = [];
        if(!empty($records)){
            foreach ($records as $record) {
                if (!empty($record->Start_Date)) {
                    $day = date('j', strtotime($record->Start_Date));
                    $Attendance[] = (int)$day;
                }
            }
        }
        
        $HolidayDates = [];
        $HolidayModal = new \Modal\Holiday;
        $Holidays = $HolidayModal->findFutureDates($firstdate, $lastdate);
        
        if(!empty($Holidays)){
            foreach ($Holidays as $Holiday) {
                if (!empty($Holiday->Date)) {
                    $day = date('j', strtotime($Holiday->Date));
                    $HolidayDates[] = (int)$day;
                }
            }
        }

        $response = [
            'success' => true,
            'year' => $year,
            'month' => $month,
            'monthName' => $monthName,
            'startDay' => $startDayOfWeek-1,
            'totalDays' => $totalDays,
            'days' => $days,
            'Attendance' => $Attendance,
            'Holiday' => $HolidayDates,
        ];

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    private function store_stats(){

        $session = new \Core\Session;
         
        $today = new \DateTime();
        $today = $today->format("Y-m-d");
        $session = new \Core\Session;
        $childattended = false;
        $hasPickup = false;
        $ChildID = $session->get("CHILDID");
        
        $AttendanceModal = new \Modal\Attendance;
        $attendanceRow = $AttendanceModal->first(["ChildID" => $ChildID, "Status" => "Present"]);
            
        if ($attendanceRow) {
            $childattended = true;
        }
        
        $PickupModal = new \Modal\Pickup;
        $row = $PickupModal->first(['ChildID' => $ChildID, 'Date' => $today, "AllChild" => 0]);
            
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
        }
        
        if (!$childattended) {
            $stats['stat2'] = [
                'nochild' => 'child not attended'
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

        return $stats;
    }

    public function deletePickup(){
        $session = new \Core\Session;
         
        header('Content-Type: application/json');
        $requestData = json_decode(file_get_contents("php://input"), true);

        $today = new \DateTime();
        $today = $today->format("Y-m-d");
        $session = new \Core\Session;
        $ChildID = $session->get("CHILDID");

        $PickupModal = new \Modal\Pickup;
        $row = $PickupModal->first(['ChildID' => $ChildID, 'Date' => $today, "AllChild" => 0]);

        if ($row) {
            $PickupModal->delete($row->PickupID , "PickupID");
        }
        echo json_encode(['success' => true, 'message' => '']);
    }

    public function handlePickups(){
        $session = new \Core\Session;
         
        header('Content-Type: application/json');
    
        $session = new \Core\Session;
        $PickupModal = new \Modal\Pickup;
        $Pickup = new \Modal\Pickup;
        $ChildID = $session->get("CHILDID");
    
        $today = (new \DateTime())->format("Y-m-d");
    
        $_POST['Person'] = $_POST['PersonType'] ?? null;
        $_POST['AllChild'] = 0;
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
    
        // ✅ Validate time
        if (!$Pickup->validate($_POST)) {
            echo json_encode(['success' => false, 'error' => $Pickup->errors['Time'] ?? "Validation failed."]);
            exit;
        }
    
        $row = $PickupModal->first(['ChildID' => $ChildID, 'Date' => $today, "AllChild" => 0]);
        if ($row) {
            $PickupModal->delete($row->PickupID , "PickupID");
        }
    
        $_POST['ChildID'] = $ChildID;
        $AttendanceModal = new \Modal\Attendance;
        $attendanceRow = $AttendanceModal->first(["ChildID" => $ChildID, "Status" => "Present"]);
    
        if ($attendanceRow) {
            $PickupModal->insert($_POST);
            echo json_encode(['success' => true, 'message' => "Pickup scheduled successfully!"]);
            exit;
        }
    
        echo json_encode(['success' => false, 'error' => "Child is not marked as present."]);
        exit;
    }    

    private function store_attendance() {
        $session = new \Core\Session;
         
        $session = new \core\session;
        $ChildID = $session->get("CHILDID");
    
        $today = new \DateTime();
        $todayFormatted = $today->format("Y-m-d");
    
        // Get Monday of the current week
        $monday = clone $today;
        $monday->modify('Monday this week');
        $mondayFormatted = $monday->format("Y-m-d");
    
        $AttendanceModal = new \modal\Attendance;
        
        $attendedDays = 0;
        $totalDays = 0;
    
        // Loop from Monday to today
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
    
        $data['graph'] = round($attendancePercentage, 2);
        return $data;
    }    

    private function selectedchild($selectedchild)
    {
        $session = new \Core\Session;
         
        $data = [];

        // Retrieve the specific child's profile image and details

        $imageData = $selectedchild->Image;
        $imageType = $selectedchild->ImageType;  // Get the image MIME type from the database

        // If image data is available, construct the Base64 string using the correct MIME type
        $base64Image = (!empty($imageData) && is_string($imageData))
            ? 'data:' . $imageType . ';base64,' . base64_encode($imageData)
            : null;

        $data['selectedchildren'] = [
            'fullname' => $selectedchild->First_Name . ' ' . $selectedchild->Last_Name,
            'name' => $selectedchild->First_Name,
            'image' => $base64Image,
            'age' => agecalculate($selectedchild->DOB),
            'language' => $selectedchild->Language,
            'religion' => $selectedchild->Religion,
            'id' => str_pad($selectedchild->ChildID, 5, '0', STR_PAD_LEFT),
        ];

        return $data;
    }

    public function store_schedule(){
        $session = new \Core\Session;
         
        header('Content-Type: application/json');
        $requestData = json_decode(file_get_contents("php://input"), true);

        $date = $requestData['date'] ?? date('Y-m-d');
        if ($date === null) {
            $date = date('Y-m-d');
        }

        $session = new \core\session;
        $ChildID = $session->get("CHILDID");

        $ChildModal = new \Modal\Child;
        $AssignModal = new \Modal\AssignTeacher;
        $ActivityModal = new \Modal\Activity;

        $Child = $ChildModal->first(["ChildID" => $ChildID]);
        $validAgeGroups = ['3-5'. '6-9', '10-13'];

        // Calculate the child's age at the start of the current year (January 1st)
        $dob = new \DateTime($Child->DOB); // Assuming $Child->DOB is a valid date string
        $currentYear = (new \DateTime())->format('Y');
        $startOfYear = new \DateTime("{$currentYear}-01-01");

        // Calculate the age as of January 1st of the current year
        $ChildHelper = new ChildHelper();
        $AgeGroup = $ChildHelper->getAgeGroup($Child->DOB);
        
        $subjects = $AssignModal->where_order(["Agegroup" => $AgeGroup, "Date" => $date], [] , 'Start_Time');
        foreach ($subjects as $subject) {
            if (empty($subject->End_Time)) {
                $startTime = new \DateTime($subject->Start_Time);
                $startTime->modify('+1 hour');
                $subject->End_Time = $startTime->format('H:i:s');
            }
        }

        // Create a new stdClass object for Dinner
        $dinnerRow = new \stdClass();
        $dinnerRow->Start_Time = '13:30:00';
        $dinnerRow->End_Time   = '14:30:00';
        $dinnerRow->Activity    = 'Dinner';
        
        // Create a new stdClass object for Breakfast
        $breakfastRow = new \stdClass();
        $breakfastRow->Start_Time = '10:00:00';
        $breakfastRow->End_Time   = '10:30:00';
        $breakfastRow->Activity   = 'Breakfast';
        
        // Insert Breakfast and Dinner rows into the subjects array
        $subjects[] = $breakfastRow;
        $subjects[] = $dinnerRow;
        
        // Now sort the subjects array by Start_Time
        usort($subjects, function($a, $b) {
            $timeA = new \DateTime($a->Start_Time);
            $timeB = new \DateTime($b->Start_Time);
            if ($timeA == $timeB) {
                return 0;
            }
            return ($timeA < $timeB) ? -1 : 1;
        });
        
        // Continue with the rest of your processing
        foreach ($subjects as $subject) {
            if (!empty($subject->WorkID)) {
                $Activity = $ActivityModal->first(["WorkID" => $subject->WorkID]);
                if ($Activity) {
                    $subject->Description = $Activity->Description;
                } else {
                    $subject->Description = 'No Description Available';
                }
            }
        }        

        // Now update each subject's description from ActivityModal if WorkID exists
        foreach ($subjects as $subject) {
            if (!empty($subject->WorkID)) {
                $Activity = $ActivityModal->first(["WorkID" => $subject->WorkID]);
                if ($Activity) { 
                    $subject->Description = $Activity->Description;
                } else {
                    $subject->Description = 'No Description Available';
                }
            }
        }

        if (empty($subjects)) {
            echo json_encode(['success' => false, 'message' => 'No attendance records found for the selected filters']);
        } else {
            echo json_encode(['success' => true, 'data' => $subjects]);
        }
    }

    public function setchildsession()
    {

        $session = new \Core\Session;
         
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

    public function removechildsession()
    {
        $session = new \Core\Session;
         
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        header('Content-Type: application/json');
        $response = [];

        $session = new \Core\Session;
        $ChildID = $session->get("CHILDID");

        if (isset($ChildID)) {
            $session->unset("CHILDID");
            $response = ['success' => true, 'message' => 'Child session removed.'];
        } else {
            $response = ['success' => false, 'message' => 'No child session to remove.'];
        }

        echo json_encode($response);  // Send JSON response
        exit();
    }

    public function Logout(){
        $session = new \Core\Session;
         
        $session = new \core\Session();
        $session->logout();

        echo json_encode(["success" => true]);
        exit;
    }

    public function minimize() {
        $session = new \Core\Session;
         
        $session = new \Core\Session();
        $minimized = $session->get("MINIMIZE");
        $session->set("MINIMIZE", !$minimized);
        echo json_encode(["success" => true, "minimize" => !$minimized]);
        exit;
    }  
}
