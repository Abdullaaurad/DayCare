<?php

namespace Controller;

use App\Helpers\SidebarHelper;
use App\Helpers\ChildHelper;

defined('ROOTPATH') or exit('Access denied');

class History
{
    use MainController;
    public function index(){

        $session = new \Core\Session;
        $session->set("USERID", 1);
        $session = new \Core\Session;
        $session->check_login();

        $SidebarHelper = new SidebarHelper();
        $data = $SidebarHelper->store_sidebar();

        $data = $data + $this->set_states();

        $ChildHelper = new ChildHelper();
        $data['Child_Count'] = $ChildHelper->child_count();
        $session->set("Location" , 'Parent/History');

        $data['graph'] = $this->store_graph();
        $this->view('Parent/history', $data);
    }

    private function store_graph() {
        $session = new \Core\Session;
        $session->set("USERID", 1);
        $ChildHelper = new ChildHelper();
        $children = $ChildHelper->store_child();
    
        // Initialize the Attendance model to fetch attendance records
        $attendanceModel = new \Modal\Attendance;
        $attendanceData = [];
    
        $currentDate = date('Y-m-d');
        $monday = date('Y-m-d', strtotime('monday this week'));
    
        foreach ($children as $child) {
            $daysAttended = 0;
            $totalDays = 0;
            
            // Loop through each day from Monday to today
            $date = $monday;
            while ($date <= $currentDate) {
                $attendanceRecords = $attendanceModel->where_norder([
                    'ChildID' => $child->ChildID,
                    'Start_Date' => $date
                ]);
    
                if (!empty($attendanceRecords)) {
                    $daysAttended++; // Count days attended
                }
    
                $totalDays++; // Increment total days counted
                $date = date('Y-m-d', strtotime($date . ' +1 day')); // Move to next day
            }
    
            $attendancePercentage = ($totalDays > 0) ? ($daysAttended / $totalDays) * 100 : 0;
    
            $attendanceData[] = [
                'ChildID' => $child->ChildID,
                'ChildName' => $child->First_Name,
                'Attendance' => round($attendancePercentage)
            ];
        }
    
        return $attendanceData;
    }
    
    
    public function store_history(){
        $session = new \Core\Session;
        $session->set("USERID", 1);
        // Set the response content type to JSON
        header('Content-Type: application/json');
    
        // Get the request data (date and child) from the incoming JSON request body
        $requestData = json_decode(file_get_contents("php://input"), true);
    
        // Default to today's date if no 'date' is provided, or if 'date' is 'null' or 'All'
        $date = $requestData['date'] ?? date('Y-m-d');
        if ($date === 'null' || $date === 'All') {
            $date = null;  // Treat 'null' or 'All' as no date filter (fetch all records)
        }
    
        // Default to 'All' if no 'child' filter is provided, or if 'child' is 'null'
        $childFilter = $requestData['child'] ?? 'All';
        if ($childFilter === 'null') {
            $childFilter = 'All'; // Treat 'null' as 'All' (fetch all children records)
        }
    
        // Initialize the ChildHelper to retrieve the children
        $ChildHelper = new ChildHelper();
        $children = $ChildHelper->store_child();
    
        // Initialize the Attendance model to fetch attendance records
        $attendanceModel = new \Modal\Attendance;
        $attendanceRecords = [];
    
        // Loop through each child to fetch their attendance data
        foreach ($children as $child) {
            // If a child filter is applied and it doesn't match the current child's ID, skip this child
            if ($childFilter !== 'All' && $childFilter != $child->First_Name) {
                continue;
            }
    
            // Fetch attendance records for the current child for the given date, if a date is set
            if ($date) {
                $childAttendance = $attendanceModel->where_norder([
                    'ChildID' => $child->ChildID,
                    'Start_Date' => $date // Filter records by the provided date
                ]);
            } else {
                // If no date filter is set (or it's 'null'/'All'), fetch all attendance records for the child
                $childAttendance = $attendanceModel->where_norder([
                    'ChildID' => $child->ChildID
                ]);
            }
    
            // If attendance records are found for the current child, merge them into the main array
            if (!empty($childAttendance)) {
                foreach ($childAttendance as $attendance) {
                    // Attach the child's First Name to each attendance record
                    $attendance->First_Name = $child->First_Name;
                }
                // Merge the found attendance records into the main records array
                $attendanceRecords = array_merge($attendanceRecords, $childAttendance);
            }
        }
    
        // Sort attendance records by status, date, and time
        usort($attendanceRecords, function ($a, $b) {
            // Prioritize 'Present' status
            if ($a->Status === 'Present' && $b->Status !== 'Present') {
                return -1; // 'Present' comes first
            } elseif ($a->Status !== 'Present' && $b->Status === 'Present') {
                return 1; // 'Present' comes first
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
            // If no records were found, return a failure response with a message
            echo json_encode(['success' => false, 'message' => 'No attendance records found for the selected filters']);
        } else {
            // If records are found, return them in the response with a success flag
            echo json_encode(['success' => true, 'data' => $attendanceRecords]);
        }
    }      

    private function set_states()
    {
        $session = new \Core\Session;
        $session->set("USERID", 1);
        $ChildHelper = new ChildHelper();
        $children = $ChildHelper->store_child(); // Get the list of children

        $attendanceModel = new \Modal\Attendance; // Attendance model to fetch attendance records
        $attendanceRecords = [];

        // Get the current year and month (e.g., 2025-01 for January 2025)
        $currentMonth = date('Y-m');

        $firstday = date('Y-m-01'); // First day of the current month
        $lastday = date('Y-m-t'); // Last day of the current month

        // Fetch attendance records for all children for the current month
        foreach ($children as $child) {
            // Fetch the attendance records for each child using ChildID and the current month filter
            $childAttendance = $attendanceModel->findFutureDatesWithConditions($firstday, $lastday, ['ChildID' => $child->ChildID], "Start_Date");

            // Add the attendance records to the result set
            if (!empty($childAttendance)) {
                $attendanceRecords = array_merge($attendanceRecords, $childAttendance);
            }
        }

        // Initialize statistics
        $totalLateArrivals = 0;
        $totalAttendanceDays = 0;
        $childrenCount = count($children);
        $holidayCount = 2; // Hardcoded holidays

        // Iterate through attendance records to calculate statistics
        foreach ($attendanceRecords as $record) {
            // Check if the child was late (Start_Time after 08:00:00)
            if (isset($record->Start_Time) && strtotime($record->Start_Time) > strtotime('08:00:00')) {
                $totalLateArrivals++;
            }

            // Count days where the child is marked as 'present'
            if ($record->Status === 'Present') {
                $totalAttendanceDays++;
            }
        }

        // Calculate average attendance (ratio of present days to children count)
        $averageAttendance = $childrenCount > 0 ? round($totalAttendanceDays / $childrenCount, 2) : 1;

        // Return statistics (holidays, average attendance, late arrivals)
        return [
            'holidays' => $holidayCount,  // Hardcoded
            'average_attendance' => $averageAttendance*100,
            'late_arrivals' => $totalLateArrivals
        ];
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
}
