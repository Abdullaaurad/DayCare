<?php

namespace Controller;

defined('ROOTPATH') or exit('Access denied');

class Dashboard
{
    use MainController;

    public function index()
    {
        $TeacherID =  1;

        $task = new \Modal\Task;
        $activity = new \Modal\Activity;
        $child = new \Modal\Child;
        $attend = new \Modal\Attendance;
        $teacher = new \Modal\Teacher;
        $marks = new \Modal\Mark;

        $result = [];

        $teacherDetails = $teacher->where_norder(['TeacherID' => $TeacherID]);
        $teacherDetails = $teacherDetails[0];
        $profilePic = $teacherDetails->Image;
        $base64Image = base64_encode($profilePic);

        $teacherInfo = [
            'TeacherID' => $teacherDetails->TeacherID,
            'First_Name' => $teacherDetails->First_Name,
            'Last_Name' => $teacherDetails->Last_Name,
            'Image' => 'data:image/jpg;base64,' . $base64Image
        ];

        //finding marks for the chart
        $overallMarks = $marks->where_norder(['Teacher_ID' => $TeacherID]);
        $stuCount = count($overallMarks);
        $best = [];
        $good = [];
        $fair = [];
        $weak = [];

        foreach ($overallMarks as $mark) {
            if ($mark->Marks >= 75) {
                $best[] = $mark->Marks;
            } elseif ($mark->Marks >= 50 && $mark->Marks < 75) {
                $good[] = $mark->Marks;
            } elseif ($mark->Marks >= 35 && $mark->Marks < 50) {
                $fair[] = $mark->Marks;
            } else {
                $weak[] = $mark->Marks;
            }
        }

        if ($stuCount > 0) {
            $dataArray = [

                round((count($best) / $stuCount) * 100),
                round((count($good) / $stuCount) * 100),
                round((count($fair) / $stuCount) * 100),
                round((count($weak) / $stuCount) * 100)
            ];
            // show($dataArray);
            // exit();


        } else {
            $dataArray = [0, 0, 0, 0]; // Or whatever fallback you want
        }

        $jan = [];
        $feb = [];
        $mar = [];
        $apr = [];
        $may = [];
        $jun = [];
        $jul = [];
        $aug = [];
        $sep = [];
        $oct = [];
        $nov = [];
        $dec = [];

        foreach ($overallMarks as $mk) {
            $submittedDate = $mk->Submitted_at;
            $submittedMonth = date('Y-m', strtotime($submittedDate));
            if ($submittedMonth == '2025-01') {
                $jan[] = $mk->Marks;
                // do your April 2025 logic here
            } else if ($submittedMonth == '2025-02') {
                $feb[] = $mk->Marks;
            } else if ($submittedMonth == '2025-03') {
                $mar[] = $mk->Marks;
            } else if ($submittedMonth == '2025-04') {
                $apr[] = $mk->Marks;
            } else if ($submittedMonth == '2025-05') {
                $may[] = $mk->Marks;
            } else if ($submittedMonth == '2025-06') {
                $jun[] = $mk->Marks;
            } else if ($submittedMonth == '2025-07') {
                $jul[] = $mk->Marks;
            } else if ($submittedMonth == '2025-08') {
                $aug[] = $mk->Marks;
            } else if ($submittedMonth == '2025-09') {
                $sep[] = $mk->Marks;
            } else if ($submittedMonth == '2025-10') {
                $oct[] = $mk->Marks;
            } else if ($submittedMonth == '2025-11') {
                $nov[] = $mk->Marks;
            } else if ($submittedMonth == '2025-12') {
                $dec[] = $mk->Marks;
            }
        }

        $lineArray = [
            count($jan) ? round(array_sum($jan) / count($jan)) : 0,
            count($feb) ? round(array_sum($feb) / count($feb)) : 0,
            count($mar) ? round(array_sum($mar) / count($mar)) : 0,
            count($apr) ? round(array_sum($apr) / count($apr)) : 0,
            count($may) ? round(array_sum($may) / count($may)) : 0,
            count($jun) ? round(array_sum($jun) / count($jun)) : 0,
            count($jul) ? round(array_sum($jul) / count($jul)) : 0,
            count($aug) ? round(array_sum($aug) / count($aug)) : 0,
            count($sep) ? round(array_sum($sep) / count($sep)) : 0,
            count($oct) ? round(array_sum($oct) / count($oct)) : 0,
            count($nov) ? round(array_sum($nov) / count($nov)) : 0,
            count($dec) ? round(array_sum($dec) / count($dec)) : 0
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'request') {

            $age = $_POST['value'];


            if ($age != null) {
                $todayTask = $task->where_norder(['Date' => date('Y-m-d'), 'TeacherID' => $TeacherID, 'AgeGroup' => $age]);

                if (!empty($todayTask)) {

                    $result = $this->findTaskList($result);
                    $result = (array)$result;


                    // foreach ($todayTask as $task) {
                    //     $row = $activity->where_norder(['WorkID'=>$task->WorkID]);

                    //     if(!empty($row)){
                    //         $row = $row[0]; // Unwrap the first record
                    //         $row = (array)$row;
                    //         $row['Activity'] = $task->Activity;
                    //         $row['Start_Time'] = $task->Start_Time;
                    //         $row['End_Time'] = $task->End_Time;
                    //         $result[] = $row;  
                    //     }else{
                    //         $result[] = (array)$task; 
                    //     }

                    // }

                    if (empty($result)) {
                        $result = $todayTask;
                    }

                    header('Content-Type: application/json');
                    echo json_encode([
                        'tasks' => $result,
                        'message' => empty($result) ? 'No tasks found.' : '',
                        'dataArray' => $dataArray,
                        'lineArray' => $lineArray
                    ]);
                    return;
                } else {
                    header('Content-Type: application/json');
                    echo json_encode([
                        'tasks' => [],
                        'message' => 'No tasks found for this age group.',
                        'dataArray' => $dataArray,
                        'lineArray' => $lineArray
                    ]);
                    return;
                }
            } else {

                // If no age group is selected, fetch all tasks for today
                $result = $task->where_norder(['Date' => date('Y-m-d'), 'TeacherID' => $TeacherID]);

                $result = $this->findTaskList($result);
                $result = (array)$result;

                if (!empty($result)) {
                    header('Content-Type: application/json');
                    echo json_encode([
                        'tasks' => $result,
                        'message' => empty($result) ? 'No tasks found.' : ''
                    ]);
                    return;
                } else {
                    header('Content-Type: application/json');
                    echo json_encode([
                        'tasks' => [],
                        'message' => 'No tasks found for this age group.'
                    ]);
                    return;
                }
            }
        }

        // Fetch today's tasks

        // var_dump($tasks);
        // exit();
        if (!empty($tasks)) {

            $taskList = $this->findTaskList($tasks);

            if (!empty($taskList)) {
                $this->view(
                    'Teacher/Dashboard',
                    [
                        'tasks' => $taskList,
                        'message' => empty($taskList) ? 'No tasks created.' : '',
                        'teacherInfo' => $teacherInfo,
                        'dataArray' => $dataArray,
                        'lineArray' => $lineArray,
                        "Profile" => $this->Profile()

                    ]
                );
            }
        } else {
            $this->view(
                'Teacher/Dashboard',
                [
                    'tasks' => [],
                    'message' => 'No tasks created.',
                    'teacherInfo' => $teacherInfo,
                    'dataArray' => $dataArray,
                    'lineArray' => $lineArray,
                    "Profile" => $this->Profile()
                ]
            );
        }
    }



    public function findTaskList($arr)
    {

        $activity = new \Modal\Activity;
        $result = [];


        // Check if the array is empty
        foreach ($arr as $task) {
            $row = $activity->where_norder(['WorkID' => $task->WorkID]);

            if (!empty($row)) {
                $row = $row[0]; // Unwrap the first record
                $row = (array)$row;
                $row['Activity'] = $task->Activity;
                $row['Start_Time'] = $task->Start_Time;
                $row['End_Time'] = $task->End_Time;
                $result[] = $row;
            } else {
                $result[] = (array)$task;
            }
        }
        // var_dump($result);
        // exit();
        if (empty($result)) {
            $result = $arr;
        }


        return $result;
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

    private function Profile(){
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

    function agecalculate($dob)
    {
        $dobTimestamp = strtotime($dob);
        $currentTimestamp = time();
        $age = floor(($currentTimestamp - $dobTimestamp) / (60 * 60 * 24 * 365.25)); // leap years considered
        return $age;
    }
}
