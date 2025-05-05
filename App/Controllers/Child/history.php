<?php

namespace Controller;
use App\Helpers\SidebarHelper;

defined('ROOTPATH') or exit('Access denied');

class History
{
    use MainController;
    public function index()
    {
        $session = new \Core\Session;
        $session->set("USERID", 1);
        $session = new \Core\Session;
        $session->check_login();
        $session->check_child('Parent');
        $ChildID = $session->get('CHILDID');

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

        $data = $data + $this->store_week();
        $data = $data + $this->set_states();

        $session->set("Location" , 'Child/History');
        $this->view('Child/history', $data);
    }

    private function selectedchild($selectedchild)
    {
        $session = new \Core\Session;
        $session->set("USERID", 1);
        $data = [];

        $imageData = $selectedchild->Image;
        $imageType = $selectedchild->ImageType;

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

    private function store_week()
    {
        $session = new \Core\Session;
        $session->set("USERID", 1);
        $currentDate = new \DateTime();
        $weekStart = $currentDate->modify('this week')->format('Y-m-d');
        $weekDays = [];

        // Get all 7 dates for the week
        for ($i = 0; $i < 7; $i++) {
            $weekDays[] = date('Y-m-d', strtotime("$weekStart +$i days"));
        }

        $session = new \Core\Session;
        $ChildID = $session->get('CHILDID');

        if (!$ChildID) {
            // If ChildID is not in session, return an error response
            echo json_encode(['success' => false, 'message' => 'ChildID not found in session']);
            return;
        }

        $attendanceModel = new \Modal\Attendance;
        $attendanceRecords = [];

        // Fetch attendance records for each day in the week
        foreach ($weekDays as $date) {
            $dailyRecords = $attendanceModel->where_norder([
                'ChildID' => $ChildID,
                'Start_Date' => $date // Fetch records for this specific day
            ]);

            if (!empty($dailyRecords)) {
                $attendanceRecords = array_merge($attendanceRecords, $dailyRecords);
            }
        }

        // Initialize the week's attendance summary
        $weeklyAttendance = [];
        $halfDayThreshold = 6; // Hours threshold for half-day

        foreach ($weekDays as $index => $currentDayDate) {
            $dayName = date('l', strtotime($currentDayDate)); // Day name (e.g., Monday)
            $attendanceForDay = null;

            foreach ($attendanceRecords as $record) {
                if ($record->Start_Date === $currentDayDate) {
                    // Calculate hours stayed based on Start_Time and End_Time
                    $startTime = isset($record->Start_Time) ? strtotime($record->Start_Time) : null;
                    $endTime = isset($record->End_Time) ? strtotime($record->End_Time) : null;
        
                    // Default to 0 hours if Start_Time or End_Time is missing
                    $hoursStayed = 0;
                    if ($startTime && $endTime) {
                        $hoursStayed = ($endTime - $startTime) / 3600; // Convert seconds to hours
                    }

                    if ($record->Status === 'Departed') {
                        if ($hoursStayed <=$halfDayThreshold) {
                            $status = 'Half day';
                            $style="half-day";
                        } else {
                            $status = 'Departed';
                            $style="Present";
                        }
                    }

                    if ($record->Status === 'Present'){
                        $status = "Present";
                        $style = "Present";
                    }
        
                    $attendanceForDay = [
                        'day' => $dayName,
                        'date' => $currentDayDate,
                        'hours' => $hoursStayed,
                        'status' => $status,
                        'style' => $style,
                    ];
                    break;
                }
            }

            // If no attendance record is found
            if (!$attendanceForDay) {
                $status = (strtotime($currentDayDate) > time()) ? 'Future' : 'Absent';
                $attendanceForDay = [
                    'day' => $dayName,
                    'date' => $currentDayDate,
                    'hours' => 0,
                    'status' => $status,
                    'style' => $status === 'Absent' ? 'Absent' : 'Future',
                ];
            }

            $weeklyAttendance[] = $attendanceForDay;
        }

        // Prepare summary
        $summary = [
            'totalDaysPresent' => count(array_filter($weeklyAttendance, function ($day) {
                return $day['status'] === 'Present';
            })),
            'totalDaysDeparted' => count(array_filter($weeklyAttendance, function ($day) {
                return $day['status'] === 'Departed';
            })),
            'totalDaysHalfDay' => count(array_filter($weeklyAttendance, function ($day) {
                return $day['status'] === 'Half day';
            })),
            'totalDaysAbsent' => count(array_filter($weeklyAttendance, function ($day) {
                return $day['status'] === 'Absent';
            }))
        ];

        // Return data for view
        return [
            'weeklyAttendance' => $weeklyAttendance,
            'summary' => $summary
        ];
    }


    public function store_history()
    {
        $session = new \Core\Session;
        $session->set("USERID", 1);
        // Set the response content type to JSON
        header('Content-Type: application/json');
        $requestData = json_decode(file_get_contents("php://input"), true);

        // Default to today's date if no 'date' is provided, or if 'date' is 'null' or 'All'
        $date = $requestData['date'] ?? date('Y-m-d');
        if ($date === 'null' || $date === 'All') {
            $date = null; // Treat 'null' or 'All' as no date filter (fetch all records)
        }

        $session = new \Core\Session;
        $ChildID = $session->get('CHILDID');

        if (!$ChildID) {
            // If ChildID is not in session, return an error response
            echo json_encode(['success' => false, 'message' => 'ChildID not found in session']);
            return;
        }

        // Initialize the Attendance model to fetch attendance records
        $attendanceModel = new \Modal\Attendance;

        // Fetch attendance records for the given child and date
        if ($date) {
            $attendanceRecords = $attendanceModel->where_norder([
                'ChildID' => $ChildID,
                'Start_Date' => $date // Filter records by the provided date
            ]);
        } else {
            // If no date filter is set, fetch all attendance records for the child
            $attendanceRecords = $attendanceModel->where_norder([
                'ChildID' => $ChildID
            ]);
        }

        // Sort attendance records by status, date, and time
        usort($attendanceRecords, function ($a, $b) {
            // Prioritize 'Present' status
            if ($a->Status === 'Present' && $b->Status !== 'Present') {
                return -1;
            } elseif ($a->Status !== 'Present' && $b->Status === 'Present') {
                return 1;
            }

            // If both are the same status, sort by Start Date
            if ($a->Start_Date !== $b->Start_Date) {
                return strtotime($a->Start_Date) <=> strtotime($b->Start_Date);
            }

            // Within the same Start Date, sort by Start Time
            return strtotime($a->Start_Time) <=> strtotime($b->Start_Time);
        });

        // Check if there are any attendance records and return a response accordingly
        if (empty($attendanceRecords)) {
            echo json_encode(['success' => false, 'message' => 'No attendance records found for the selected filters']);
        } else {
            echo json_encode(['success' => true, 'data' => $attendanceRecords]);
        }
    }


    private function set_states()
    {
        $session = new \Core\Session;
        $session->set("USERID", 1);
        // Get the ChildID from the session
        $session = new \Core\Session;
        $ChildID = $session->get('CHILDID');
    
        if (!$ChildID) {
            // If ChildID is not in session, return an empty result
            return [
                'holidays' => 0,
                'average_attendance' => 0,
                'late_arrivals' => 0
            ];
        }
    
        // Initialize the Attendance model to fetch attendance records
        $attendanceModel = new \Modal\Attendance;
    
        // Get the current date and calculate the first day of the current month
        $currentDate = new \DateTime();
        $firstDayOfMonth = $currentDate->modify('first day of this month')->format('Y-m-d');
        $today = date('Y-m-d'); // Get today's date
    
        // Generate all dates from the start of the month to today
        $monthDates = [];
        $dateIterator = new \DateTime($firstDayOfMonth);
        while ($dateIterator->format('Y-m-d') <= $today) {
            $monthDates[] = $dateIterator->format('Y-m-d');
            $dateIterator->modify('+1 day'); // Increment day
        }
    
        // Initialize statistics
        $totalLateArrivals = 0;
        $totalAttendanceDays = 0;
        $holidayCount = 2; // Hardcoded holidays
    
        // Iterate through each day in the month
        foreach ($monthDates as $currentDay) {
            // Fetch attendance record for the specific date
            $dailyRecord = $attendanceModel->where_norder([
                'ChildID' => $ChildID,
                'Start_Date' => $currentDay // Check for this specific day
            ]);
    
            if ($dailyRecord) {
                // If attendance is found, calculate statistics
                $record = $dailyRecord[0]; // Assuming one record per day for the child
    
                // Check if the child was late (Start_Time after 08:00:00)
                if (isset($record->Start_Time) && strtotime($record->Start_Time) > strtotime('08:00:00')) {
                    $totalLateArrivals++;
                }
    
                // Count days where the child is marked as 'Present' or 'Departed'
                if (in_array($record->Status, ['Present', 'Departed'])) {
                    $totalAttendanceDays++;
                }
            }
        }
    
        // Calculate average attendance (ratio of attended days to total days checked)
        $totalDaysSoFar = count($monthDates);
        $averageAttendance = $totalDaysSoFar > 0 ? round($totalAttendanceDays / $totalDaysSoFar, 0) : 1;

        $averageAttendance = $averageAttendance == 0 && $averageAttendance < 1 ? 1 : $averageAttendance;
    
        // Return statistics (holidays, average attendance, late arrivals)
        return [
            'holidays' => $holidayCount,  // Hardcoded
            'average_attendance' => $averageAttendance,
            'late_arrivals' => $totalLateArrivals
        ];
    }    

    public function setchildsession()
    {
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

        echo json_encode($response);  // Send JSON response
        exit();
    }

    public function removechildsession()
    {
        $session = new \Core\Session;
        $session->set("USERID", 1);
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
        $session->set("USERID", 1);
        $session = new \core\Session();
        $session->logout();

        echo json_encode(["success" => true]);
        exit;
    }
}

?>