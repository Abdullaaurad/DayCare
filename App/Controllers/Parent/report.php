<?php

namespace Controller;

use App\Helpers\SidebarHelper;
use App\Helpers\ChildHelper;

defined('ROOTPATH') or exit('Access denied');

class Report
{
    use MainController;
    public function index()
    {

        $session = new \Core\Session;
         
        $session = new \Core\Session;
        $session->check_login();

        $data = [];
        $SidebarHelper = new SidebarHelper();
        $data = $SidebarHelper->store_sidebar();
        $data['stats'] =$this->store_stats();

        $ChildHelper = new ChildHelper();
        $data['Child_Count'] = $ChildHelper->child_count();
        $session->set("Location" , 'Parent/Event');

        $this->view('Parent/report', $data);
    }

    public function setchildsession(){
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

    private function store_stats()
    {
        $session = new \Core\Session;
         
        $ChildHelper = new ChildHelper();
        $children = $ChildHelper->store_child();

        $attendanceModel = new \Modal\Attendance;
        $maidReportModel = new \Modal\MaidReport;
        $teacherReportModel = new \Modal\TeacherReport;

        // Initialize stats arrays
        $stats = [
            'maid_pending' => 0,
            'maid_viewed' => 0,
            'maid_downloaded' => 0,
            'teacher_pending' => 0,
            'teacher_viewed' => 0,
            'teacher_downloaded' => 0,
        ];

        foreach ($children as $child) {
            $childAttendance = $attendanceModel->where_order(['ChildID' => $child->ChildID], [], 'Start_Date');

            if (!empty($childAttendance)) {
                foreach ($childAttendance as $attendance) {
                    $maidReports = $maidReportModel->where_norder(['AttendanceID' => $attendance->AttendanceID]);
                    if (!empty($maidReports)) {
                        foreach ($maidReports as $report) {
                            $stats['maid_pending'] += ($report->Viewed == 0) ? 1 : 0;
                            $stats['maid_viewed'] += ($report->Viewed == 1) ? 1 : 0;
                            $stats['maid_downloaded'] += ($report->Downloaded == 1) ? 1 : 0;
                        }
                    }
                }
            }

            $teacherReports = $teacherReportModel->where_norder(['ChildID' => $child->ChildID]);
            if (!empty($teacherReports)) {
                foreach ($teacherReports as $report) {
                    $stats['teacher_pending'] += ($report->Viewed == 0) ? 1 : 0;
                    $stats['teacher_viewed'] += ($report->Viewed == 1) ? 1 : 0;
                    $stats['teacher_downloaded'] += ($report->Downloaded == 1) ? 1 : 0;
                }
            }
        }

        return $stats;
    }


    public function store_reports() {
        $session = new \Core\Session;
         
        header('Content-Type: application/json');
        $requestData = json_decode(file_get_contents("php://input"), true);
    
        // Default to today's date if no 'date' is provided
        $date = $requestData['date'] ?? date('Y-m-d');
        if ($date === 'null' || $date === 'All') {
            $date = null;  // Treat 'null' or 'All' as no date filter (fetch all records)
        }
    
        // Default to 'All' if no 'child' filter is provided
        $childFilter = $requestData['child'] ?? 'All';
        if ($childFilter === 'null') {
            $childFilter = 'All'; // Treat 'null' as 'All' (fetch all children records)
        }
    
        // Initialize helpers and models
        $ChildHelper = new ChildHelper();
        $children = $ChildHelper->store_child();
    
        $attendanceModel = new \Modal\Attendance;
        $maidModel = new \Modal\Maid;
        $maidReportModel = new \Modal\MaidReport;
        $TeacherModel = new \Modal\Teacher;
        $TeacherReportModel = new \Modal\TeacherReport;
    
        $maidReports = [];
        $teacherReports = [];
    
        foreach ($children as $child) {
            // Apply child filter if needed
            if ($childFilter !== 'All' && $child->First_Name != $childFilter) {
                continue;
            }
    
            $childFirstName = $child->First_Name;
    
            // Fetch maid reports
            $childAttendance = $date ? 
                $attendanceModel->where_order(['ChildID' => $child->ChildID, 'Start_Date' => $date]) : 
                $attendanceModel->where_order(['ChildID' => $child->ChildID]);
    
            if (!empty($childAttendance)) {
                foreach ($childAttendance as $attendance) {
                    $maidReport = $maidReportModel->first(['AttendanceID' => $attendance->AttendanceID]);
                    if (!empty($maidReport)) {
                        $maidInfo = $maidModel->first(['MaidID' => $maidReport->MaidID]);
                        $maidName = !empty($maidInfo) 
                            ? $maidInfo->First_Name . ' ' . $maidInfo->Last_Name 
                            : 'Unknown Maid';
    
                        $maidReports[] = [
                            'Child_Name' => $childFirstName,
                            'Maid_Name' => $maidName,
                            'Report_Date' => $attendance->Start_Date,
                            'Viewed' => $maidReport->Viewed ? 'Yes' : 'No',
                        ];
                    }
                }
            }
    
            // Fetch teacher reports
            $TeacherReports = $date ? 
                $TeacherReportModel->where_order(['ChildID' => $child->ChildID, 'Date' => $date]) : 
                $TeacherReportModel->where_order(['ChildID' => $child->ChildID]);
    
            if (!empty($TeacherReports)) {
                foreach ($TeacherReports as $report) {
                    $TeacherInfo = $TeacherModel->first(['TeacherID' => $report->TeacherID]);
                    $TeacherName = !empty($TeacherInfo) 
                        ? $TeacherInfo->First_Name . ' ' . $TeacherInfo->Last_Name 
                        : 'Unknown Teacher';
    
                    $teacherReports[] = [
                        'Child_Name' => $childFirstName,
                        'Teacher_Name' => $TeacherName,
                        'Report_Date' => $report->Date,
                        'Viewed' => $report->Viewed ? 'Yes' : 'No',
                    ];
                }
            }
        }
    
        // Sort reports by date
        usort($maidReports, function ($a, $b) {
            return strtotime($a['Report_Date']) - strtotime($b['Report_Date']);
        });
    
        usort($teacherReports, function ($a, $b) {
            return strtotime($a['Report_Date']) - strtotime($b['Report_Date']);
        });
    
        // Prepare response data
        $data = [
            'Maid' => $maidReports,
            'Teacher' => $teacherReports
        ];
    
        if (empty($data)) {
            // If no records were found, return a failure response with a message
            echo json_encode(['success' => false, 'message' => 'No attendance records found for the selected filters']);
        } else {
            // If records are found, return them in the response with a success flag
            echo json_encode(['success' => true, 'data' => $data]);
        }
    }    

    public function Logout(){
        $session = new \Core\Session;
         
        $session = new \core\Session();
        $session->logout();

        echo json_encode(["success" => true]);
        exit;
    }

    // private function store_reports_maid(){
    //     $ChildHelper = new ChildHelper();
    //     $children = $ChildHelper->store_child();

    //     // Initialize models
    //     $attendanceModel = new \Modal\Attendance; // Assuming you have an Attendance model
    //     $childModel = new \Modal\Child; // Assuming you have a Child model
    //     $maidModel = new \Modal\Maid; // Assuming you have a Maid model
    //     $maidReportModel = new \Modal\MaidReport; // Assuming you have a MaidReport model
    
    //     $reportRecords = [];
    
    //     // Iterate through each child
    //     foreach ($children as $child) {
    //         // Fetch the child information (First_Name) based on ChildID
    //         $childInfo = $childModel->first(['ChildID' => $child->ChildID]);
    
    //         if (!empty($childInfo)) {
    //             $childFirstName = $childInfo->First_Name;
    
    //             // Fetch attendance records for the child
    //             $childAttendance = $attendanceModel->where_order(['ChildID' => $child->ChildID]);
    
    //             if (!empty($childAttendance)) {
    //                 foreach ($childAttendance as $attendance) {
    //                     // Fetch the maid report for the attendance record (there can be only one)
    //                     $maidReport = $maidReportModel->first(['AttendanceID' => $attendance->AttendanceID]);
    
    //                     if (!empty($maidReport)) {
    //                         // Fetch maid information based on MaidID
    //                         $maidInfo = $maidModel->first(['MaidID' => $maidReport->MaidID]);
    //                         $maidName = !empty($maidInfo) 
    //                             ? $maidInfo->First_Name . ' ' . $maidInfo->Last_Name 
    //                             : 'Unknown Maid';
    
    //                         $reportDetails = [
    //                             'Child_Name' => $childFirstName,
    //                             'Maid_Name' => $maidName,
    //                             'Report_Date' => $attendance->Start_Date,
    //                             'Viewed' => $maidReport->Viewed ? 'Yes' : 'No',
    //                         ];
    
    //                         $reportRecords[] = $reportDetails;
    //                     }
    //                 }
    //             }
    //         }
    //     }
        
    //     usort($reportRecords, function ($a, $b) {
    //         return strtotime($a['Report_Date']) - strtotime($b['Report_Date']);
    //     });

    //     return $reportRecords;
    // }
    

    // private function store_reports_teacher(){

    //     $ChildHelper = new ChildHelper();
    //     $children = $ChildHelper->store_child();

    //     $childModel = new \Modal\Child;
    //     $TeacherModel = new \Modal\Teacher;
    //     $TeacherReportModel = new \Modal\TeacherReport;

    //     $reportRecords = [];

    //     foreach ($children as $child) {
    //         if (!empty($child)) {
    //             $childFirstName = $child->First_Name;
    //             $TeacherReports = $TeacherReportModel->where_order(['ChildID' => $child->ChildID], [], 'Date');

    //             if (!empty($TeacherReports)) {
    //                 foreach ($TeacherReports as $report) {
    //                     $TeacherInfo = $TeacherModel->first(['TeacherID' => $report->TeacherID]);
    //                     $TeacherName = !empty($TeacherInfo) ? $TeacherInfo->First_Name . ' ' . $TeacherInfo->Last_Name : 'Unknown Teacher';

    //                     $reportDetails = [
    //                         'Child_Name' => $childFirstName,
    //                         'Teacher_Name' => $TeacherName,
    //                         'Report_Date' => $report->Date,
    //                         'Viewed' => $report->Viewed ? 'Yes' : 'No',
    //                     ];

    //                     $reportRecords[] = $reportDetails;
            
    //                 }
    //             }
    //         }
    //     }
    //     usort($reportRecords, function ($a, $b) {
    //         return strtotime($a['Report_Date']) - strtotime($b['Report_Date']);
    //     });

    //     return $reportRecords;
    // }
}
