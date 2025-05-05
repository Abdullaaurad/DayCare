<?php

    namespace Controller;

    use App\Helpers\SidebarHelper;

    defined('ROOTPATH') or exit('Access denied');

    class Report{
        use MainController;
        public function index() {
            $session = new \Core\Session;
            $session->check_login();
            $session->check_child();
            $ChildID = $session->get("CHILDID");

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

            $data['stats'] =$this->store_stats();
            $session->set("Location" , 'Child/Report');
            $this->view('Child/report', $data);
        }

        // public function test(){


        //     return $data;
        // }

        public function store_reports() {
            header('Content-Type: application/json');
            $requestData = json_decode(file_get_contents("php://input"), true);
        
            // Default to today's date if no 'date' is provided
            $date = $requestData['date'];
            $date = null;
            if ($date === null || $date === 'All') {
                $date = null;  // Treat 'null' or 'All' as no date filter (fetch all records)
            }

            $session = new \Core\Session;
            $ChildID = $session->get("CHILDID");
        
            $attendanceModel = new \Modal\Attendance;
            $maidModel = new \Modal\Maid;
            $maidReportModel = new \Modal\MaidReport;
            $TeacherModel = new \Modal\Teacher;
            $TeacherReportModel = new \Modal\TeacherReport;
            $ChildModel = new \Modal\Child;
        
            $maidReports = [];
            $teacherReports = [];
        
            $childAttendance = $date ? 
                $attendanceModel->where_order(['ChildID' => $ChildID, 'Start_Date' => $date], [] , "Start_Date") : 
                $attendanceModel->where_order(['ChildID' => $ChildID], [] , "Start_Date");
        
            $child = $ChildModel->first(["ChildID" => $ChildID]);

            if (!empty($childAttendance)) {
                foreach ($childAttendance as $attendance) {
                    $maidReport = $maidReportModel->first(['AttendanceID' => $attendance->AttendanceID]);
                    if (!empty($maidReport)) {
                        $maidInfo = $maidModel->first(['MaidID' => $maidReport->MaidID]);
                        $maidName = !empty($maidInfo) 
                            ? $maidInfo->First_Name . ' ' . $maidInfo->Last_Name 
                            : 'Unknown Maid';
    
                        $maidReports[] = [
                            'Child_Name' => $child->First_Name,
                            'Maid_Name' => $maidName,
                            'Report_Date' => $attendance->Start_Date,
                            'Viewed' => $maidReport->Viewed ? 'Yes' : 'No',
                        ];
                    }
                }
            }
        
                // Fetch teacher reports
            $TeacherReports = $date ? 
                $TeacherReportModel->where_order(['ChildID' => $ChildID, 'Start_Date' => $date], [] , "Start_Date") : 
                $TeacherReportModel->where_order(['ChildID' => $ChildID], [] , "Date");
        
            if (!empty($TeacherReports)) {
                foreach ($TeacherReports as $report) {
                    $TeacherInfo = $TeacherModel->first(['TeacherID' => $report->TeacherID]);
                    $TeacherName = !empty($TeacherInfo) 
                        ? $TeacherInfo->First_Name . ' ' . $TeacherInfo->Last_Name 
                        : 'Unknown Teacher';
    
                    $teacherReports[] = [
                        'Child_Name' => $child->First_Name,
                        'Teacher_Name' => $TeacherName,
                        'Report_Date' => $report->Date,
                        'Viewed' => $report->Viewed ? 'Yes' : 'No',
                    ];
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

        private function store_stats()
        {
            $session = new \Core\Session;
            $ChildID = $session->get("CHILDID");

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

            $childAttendance = $attendanceModel->where_order(['ChildID' => $ChildID], [], 'Start_Date');

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

            $teacherReports = $teacherReportModel->where_norder(['ChildID' => $ChildID]);
            if (!empty($teacherReports)) {
                foreach ($teacherReports as $report) {
                    $stats['teacher_pending'] += ($report->Viewed == 0) ? 1 : 0;
                    $stats['teacher_viewed'] += ($report->Viewed == 1) ? 1 : 0;
                    $stats['teacher_downloaded'] += ($report->Downloaded == 1) ? 1 : 0;
                }
            }

            return $stats;
        }

        private function selectedchild($selectedchild)
        {
            $data = [];

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

        public function setchildsession()
        {
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
            $session = new \core\Session();
            $session->logout();

            echo json_encode(["success" => true]);
            exit;
        }
    }
?>