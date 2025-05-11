<?php

namespace Controller;

defined('ROOTPATH') or exit('Access denied');

class Reports
{
    use MainController;

    public function index()
    {
        $teacher = new \Modal\Teacher;

        // $TeacherID = $this->findID();
        $TeacherID =  1;
        $child = new \Modal\Child;
        $report =  new \Modal\Report;

        $row = $teacher->first(['TeacherID' => $TeacherID]);
        // show($row);
        // exit();
        $firstName = $row->First_Name;
        $lastName = $row->Last_Name;
        $email =  $row->Email;
        $image = $row->Image;
        $base64Image = base64_encode($image);

        $TeacherInfo = [
            'firstName' => $firstName,
            'lastName' => $lastName,
            'email' => $email,
            'image' => 'data:image/jpg;base64,' . $base64Image
        ];




        //getting reports from report table
        $reports = $report->findall();
        // var_dump($reports);
        // exit();

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'request') {
            // var_dump($_POST);
            // exit();
            error_log("🔥 Reached the index function");
            error_log("Received POST: " . print_r($_POST, true));

            $ageGroup = $_POST['value'];

            if ($ageGroup != null) {
                $completed = [];
                $pending = [];

                if (empty($reports)) {
                    echo json_encode(['message' => 'No reports found', 'teacher' => $TeacherInfo]);
                    exit;
                }


                foreach ($reports as $report) {

                    $result = $child->where_norder(['ChildID' => $report->StudentID]);

                    if (empty($result)) continue;

                    $student = $result[0];
                    $student->ReportID = $report->ReportID;
                    $age = $this->agecalculate($student->DOB);
                    $student->DOB = $age;
                    $image = $student->Image;
                    $base64Image = base64_encode($image);
                    $student->Image = 'data:image/jpg;base64,' . $base64Image;
                    $match = false;

                    if ($ageGroup == '10-13') {
                        if ($student->DOB >= 10 && $student->DOB <= 13) {
                            if ($report->Status == 'completed') {
                                $completed[] = $student;
                            } else {
                                $pending[] = $student;
                            }
                        }
                    } else if ($ageGroup == '6-9') {
                        if ($student->DOB >= 6 && $student->DOB <= 9) {
                            if ($report->Status == 'completed') {
                                $completed[] = $student;
                            } else {
                                $pending[] = $student;
                            }
                        }
                    }
                }


                error_log("Pending count: " . count($pending));
                error_log("Completed count: " . count($completed));

                ob_clean();
                header('Content-Type: application/json');
                echo json_encode([
                    'pending' => $this->convertToArray($pending),
                    'completed' => $this->convertToArray($completed),
                    'teacher' => $TeacherInfo
                ]);
                return;
            } else {
                $completed = [];
                $pending = [];

                if (empty($reports)) {

                    header('Content-Type: application/json');
                    echo json_encode([
                        'message' => 'No reports found',
                        'teacher' => $TeacherInfo
                    ]);
                    exit;
                }

                foreach ($reports as $report) {
                    $studentData = $child->where_norder(['ChildID' => $report->StudentID]);


                    if (empty($studentData)) continue;

                    $student = $studentData[0];
                    $student->ReportID = $report->ReportID;
                    $Stuimage = $student->Image;
                    $base64image = base64_encode($Stuimage);

                    //$studentArray = $this->convertToArray($student);

                    if ($report->Status == 'completed') {


                        $completed[] = $student;
                    } else {
                        $pending[] = $student;
                    }
                }



                if (!empty($completed) || !empty($pending)) {
                    header('Content-Type: application/json');
                    echo json_encode([
                        'pending' => $this->convertToArray($pending),
                        'completed' => $this->convertToArray($completed),
                        'teacher' => $TeacherInfo
                    ]);
                    exit;
                } else {
                    header('Content-Type: application/json');
                    echo json_encode([
                        'message' => 'No reports found',
                        'teacher' => $TeacherInfo
                    ]);
                    exit;
                }
            }
        }

        //fetching reports from report table

        $completed = [];
        $pending = [];
        // show($reports);
        // exit();

        if (!empty($reporst)) {
            foreach ($reports as $report) {
                $studentData = $child->where_norder(['ChildID' => $report->StudentID]);
                if (empty($studentData)) continue;

                $student = $studentData[0];
                $student->ReportID = $report->ReportID;

                $profleImage = $student->Image;
                $base64Image = base64_encode($profleImage);
                $student->Image = 'data:image/jpg;base64,' . $base64Image;
                // show($student);
                // exit();
                if ($report->Status == 'completed') {
                    $completed[] = $student;
                } else {
                    $pending[] = $student;
                }
            }
        } else {
            $this->view('Teacher/Reports', [
                'message' => 'No Reports Found',
                'teacher' => $TeacherInfo,
                "Profile" => $this->Profile()
            ]);
        }



        if (!empty($completed) || !empty($pending)) {
            $this->view(
                'Teacher/Reports',
                [
                    'pending' => $this->convertToArray($pending),
                    'completed' => $this->convertToArray($completed),
                    'teacher' => $TeacherInfo,
                    "Profile" => $this->Profile()
                ]
            );
        }
    }
    public function generateMonthlyReports()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {


            $report =  new \Modal\Report;
            $child = new \Modal\Child;

            $students = [];

            $month = date('F'); // like 'April'
            $year = date('Y');  // like 2025

            $children = $child->findall();

            // var_dump($children);
            // exit;

            foreach ($children as $child) {
                $age = $this->agecalculate($child->DOB);
                if ($age >= 6 && $age <= 13) {
                    $students[] = [
                        'StudentID' => $child->ChildID,
                        'Month' => $month,
                        'Year' => $year
                    ];
                }
            }
            // var_dump($students);
            // exit;

            $check = $report->where_norder(['Month' => $month, 'Year' => $year]);
            // var_dump($check);
            // exit();


            if (!$check) {
                //Insert base reports

                foreach ($students as $student) {
                    $result = $report->insert($student);
                }
                redirect('Teacher/Reports');
            } else {
            }
        }
    }

    private function Profile()
    {
        $session = new \core\Session;
        $UserID = $session->get('USERID');

        $TeacherModal = new \Modal\Teacher;
        $data = $TeacherModal->first(["UserID" => $UserID]);
        if (!empty($data)) {
            $imageData = $data->Image;
            $imageType = $data->ImageType;
            $base64Image = (!empty($imageData) && is_string($imageData))
                ? 'data:' . $imageType . ';base64,' . base64_encode($imageData)
                : null;
            $data->Image = $base64Image;
            $data->EmployeeID = 'EMP' . str_pad($data->UserID, 5, '0', STR_PAD_LEFT);
        }

        return $data;
    }

    public function Logout()
    {
        $session = new \core\Session();
        $session->logout();

        echo json_encode(["success" => true]);
        exit;
    }

    public function SubmitMarks()
    {


        $month = date('F'); // like 'April'
        $year = date('Y');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // var_dump($_POST);
            // exit();

            $teacherSub = new \Modal\TeacherSubject;
            $mark = new \Modal\Mark;
            $report =  new \Modal\Report;

            $TeacherID = $this->findID();
            $subjectID = $teacherSub->where_norder(['teacher_id' => $TeacherID]);
            $subjectID = $subjectID[0];
            $reportID = $_POST['report_id'];
            $marks = $_POST['marks'];

            // $reports = $report->where_norder(['ReportID' => $reportID]);
            // $rows = $reports[0];

            // var_dump($reports);
            // exit();

            $data = [
                'Report_ID' => $reportID,
                'Teacher_ID' => $TeacherID,
                'Subject_ID' => $subjectID->subject_id,
                'Marks' => $marks,
                'Submitted_at' => date('Y-m-d H:i:s')
            ];

            $insertmarks = $mark->insert($data);


            if (!$insertmarks) {

                $markedReports = $mark->where_norder(['Report_ID' => $reportID]);

                // var_dump($markedReports);
                // exit();


                $subjectsWithMarks = [1 => false, 2 => false, 3 => false];

                foreach ($markedReports as $reports) {
                    if (isset($subjectsWithMarks[$reports->Subject_ID]) && $reports->Marks !== null) {
                        $subjectsWithMarks[$reports->Subject_ID] = true;
                    }
                }






                if ($subjectsWithMarks[1] && $subjectsWithMarks[2] && $subjectsWithMarks[3]) {

                    // header('Content-Type: application/json');
                    // echo json_encode([
                    //     'success' => true,
                    //     'message' => 'Marks submitted and report status updated!',
                    //     'data' => $subjectsWithMarks
                    // ]);
                    // exit;

                    // Step 2: Update report status only if mark insertion is successful
                    $updated = $report->update_withid($reportID, ['Status' => 'completed', 'Submitted_at' => date('Y-m-d H:i:s')], 'ReportID');

                    // var_dump($updated);
                    // exit();
                    if (!$updated) {
                        header('Content-Type: application/json');
                        echo json_encode([
                            'success' => true,
                            'message' => 'Marks submitted and done',
                            'data' => $data
                        ]);
                        exit;
                    } else {
                        header('Content-Type: application/json');
                        echo json_encode([
                            'success' => false,
                            'error' => 'Marks added, but report status failed to update.'
                        ]);
                        exit;
                    }
                } else {
                    header('Content-Type: application/json');
                    echo json_encode([
                        'success' => false,
                        'error' => 'Not all subjects have marks for this report.'
                    ]);
                    exit;
                }
            } else {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'error' => 'Failed to insert marks']);
                exit;
            }
        }
    }

    function agecalculate($dob)
    {
        $dobTimestamp = strtotime($dob);
        $currentTimestamp = time();
        $age = floor(($currentTimestamp - $dobTimestamp) / (60 * 60 * 24 * 365.25)); // leap years considered
        return $age;
    }

    public function generateID($row)
    {
        $child = new \Modal\Child;




        return $row->ChildID;
    }

    function convertToArray($students)
    {
        $arr = [];

        foreach ($students as $student) {
            $arr[] = [
                'First_Name' => $student->First_Name,
                'Last_Name' => $student->Last_Name,
                'DOB' => $student->DOB,
                'ChildID' => $student->ChildID,
                'ReportID' => $student->ReportID
                // add more props you want
            ];
        }

        return $arr;
    }

    public function findID()
    {

        $teacher = new \Modal\Teacher;
        $session = new \Core\Session;

        $userID = $session->get('USERID');

        $row = $teacher->first(['UserID' => $userID]);
        $result = $row->TeacherID;

        return $result;
    }
}
