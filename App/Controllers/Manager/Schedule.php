<?php

namespace Controller;

use App\Helpers\ManagerHelper;

defined('ROOTPATH') or exit('Access denied');

class Schedule
{
    use MainController;

    public function index()
    {
        $Helper = new ManagerHelper;
        $Helper->Check_Manager();
        // Get all maids from the database
        $maidModel = new \Modal\Maid;
        $maids = $maidModel->findAll();

        // Pass the maids data to the view
        $data['maids'] = $maids;

        // Get all teachers from the database
        $teacherModel = new \Modal\Teacher;
        $teachers = $teacherModel->findAll();
        $data['teachers'] =  $teachers;  // Properly assign the teachers data

        // Pass data to the view
        $this->view('Manager/schedule/Schedule', $data);
    }

    public function addscheduleMaid(){
        $assignmaidmodel = new \Modal\Maidactivity;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $date = $_POST['Date'];
            
            // Define all activities and their time slots
            $activitySchedule = [
                ['Breakfast', '8:00', '8:30'],
                [$_POST['Activity'][0] ?? '', '8:30', '10:00'],
                ['Refreshment', '10:00', '10:30'],
                [$_POST['Activity'][1] ?? '', '10:30', '12:00'],
                ['Ready for Lunch', '12:00', '13:00'],
                ['Lunch', '13:00', '13:30'],
                [$_POST['Activity'][2] ?? '', '13:30', '15:00'],
                [$_POST['Activity'][3] ?? '', '15:00', '16:30'],
                [$_POST['Activity'][4] ?? '', '16:30', '17:00']
            ];
            
            $success = true;
            $insertCount = 0;
            
            // Insert all activities, both fixed and selected
            foreach ($activitySchedule as $activity) {
                // Skip empty or "Select Activity" options
                if (empty($activity[0]) || $activity[0] == 'Select Activity') {
                    continue;
                }
                
                $data = [
                    'Date' => $date,
                    'Activity' => $activity[0],
                    'Start_Time' => $activity[1],
                    'End_Time' => $activity[2]
                ];
                
                // For debugging
                // show($data);
                
                $result = $assignmaidmodel->insert($data);
                if ($result) {
                    $insertCount++;
                } else {
                    $success = false;
                    break;
                }
            }
            
            if ($success && $insertCount > 0) {
                // Redirect with success message
                redirect('Manager/Schedule?msg=schedule_added');
            } else {
                // Redirect with error message
                redirect('Manager/Schedule?msg=schedule_failed');
            }
        }
    }   

    public function getTeacher()
    {
        header('Content-Type: application/json');
        $requestData = json_decode(file_get_contents("php://input"), true);
        $Subject = $requestData['Subject'];

        $teacherModel = new \Modal\Teacher;
        $Teacher = $teacherModel->where_norder(["Subject" => $Subject]);

        $AssignTeacherModal = new \Modal\AssignTeacher;

        $ExistTeacher = [];
        if (!empty($Teacher)) {
            foreach ($Teacher as $teach) {
                $Exist = $AssignTeacherModal->first(["TeacherID" => $teach->TeacherID, "Date" => date("Y-m-d", strtotime("tomorrow"))]);
                if (empty($Exist)) {
                    $ExistTeacher[] = $teach;
                }
            }
        }

        if (empty($ExistTeacher)) {
            echo json_encode(['success' => true, 'data' => 'No teacher found for this subject']);
            return;
        } else {
            echo json_encode(['success' => true, 'data' => $ExistTeacher]);
            return;
        }
    }

    public function addscheduleforTeacher()
    {
        $assignteachermodel = new \Modal\AssignTeacher;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'TeacherID' => $_POST['TeacherID'],
                'Date' => $_POST['Date'],
                'Activity' => $_POST['Activity'][1],
                'AgeGroup' => $_POST['AgeGroup'],
            ];

            // Debugging output
            // echo '<pre>';
            // print_r($data);  // Check the data being passed
            // echo '</pre>';
            if ($assignteachermodel->validate($data)) {
                $result = $assignteachermodel->insert($data);
                if ($result) {
                    echo "Schedule Added successfully";
                } else {
                    echo "Failed to add";
                }
            }
            redirect('Manager/schedule/Schedule');
        }
    }
}
