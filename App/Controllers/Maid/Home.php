<?php

namespace Controller;

use App\Helpers\ChildHelper;

defined('ROOTPATH') or exit('Access denied');

class Home
{
    use MainController;
    public function index()
    {
        $childModel = new \Modal\Child();
        $maidactivityModel = new \Modal\Maidactivity();
        $AttendanceModel = new \Modal\Attendance();
        $maidassignModel = new \Modal\AssignMaid();
        $maidattendance = new \Modal\Employeeattendance;
        $maiddata = new \Modal\Maid;
        $maids =  $maiddata->findall();
        foreach ($maids as $maid) {
            $attend = $maidattendance->where_norder(['UserID' => $maid->UserID, 'Start_Date' => date('Y-m-d')], []);
            if (isset($attend[0])) {
                $maid->Status = $attend[0]->Status;
            }
        }
        $attendchilds = $AttendanceModel->where_order(['Status' => 'Present', 'Start_Date' => date('Y-m-d')], [], 'Start_Time');

        $assign = $maidassignModel->where_norder(['Date' => date('Y-m-d')], []);


        if (is_array($attendchilds) && !empty($attendchilds)) {
            $presentChildIds = array_map(function ($child) {
                return $child->ChildID;
            }, $attendchilds);
        } else {
            $presentChildIds = [];
        }

        if (is_array($assign) && !empty($assign)) {
            $assignedChildIds = array_map(function ($assig) {
                return $assig->ChildID;
            }, $assign);
        } else {
            $assignedChildIds = [];
        }

        $notAssignedButPresent = array_diff($presentChildIds, $assignedChildIds);
        $presentMaids = [];

        foreach ($maids as $maid) {
            if (isset($maid->Status) && $maid->Status === 'Present') {
                $presentMaids[] = $maid;
            }
        }

        foreach ($presentMaids as $maid) {

            $maidAssignments = $maidassignModel->where_norder(['MaidID' => $maid->MaidID, 'Date' => date('Y-m-d')], []);


            if (is_array($maidAssignments)) {
                $maid->AssignmentCount = count($maidAssignments);
                // show($maid);
                // exit();

            } else {

                $maid->AssignmentCount = 0;
            }
        }
        $children = [];
        $childHelper = new ChildHelper();

        foreach ($notAssignedButPresent as $childID) {
            $childData = $childModel->where_norder(['ChildID' => $childID], []);

            if (is_array($childData) && !empty($childData)) {
                $child = $childData[0];
                $child->AgeGroup = $childHelper->getAgeGroup($child->DOB);
                $children[] = $child;
            }
        }

        foreach ($children as $child) {
            foreach ($presentMaids as $maid) {
                if (($child->AgeGroup === $maid->AgeGroup) && ($maid->AssignmentCount < 5)) {
                    $data = [
                        'MaidID'   => $maid->MaidID,
                        'ChildID'   => $child->ChildID,
                        'AgeGroup'    => $child->AgeGroup,
                        'Date'        => date('Y-m-d'),

                    ];

                    if ($maidassignModel->validate($data)) {
                        $maidassignModel->insert($data);
                    }
                    break;
                }
            }
        }
        $maidid = 1;

        $todayassigned = $maidassignModel->where_norder(['MaidID' => $maidid, 'Date' => date('Y-m-d')], []);
        $todayactivities = $maidactivityModel->where_norder(['Date' => date('Y-m-d')], []);

        if (is_array($todayassigned) && !empty($todayassigned)) {
            $todayAssignedChildIds = array_map(function ($child) {
                return $child->ChildID;
            }, $todayassigned);
        } else {
            $todayAssignedChildIds = [];
        }
        $data['children'] = [];
        foreach ($todayAssignedChildIds as $childID) {
            $child = $childModel->first(['ChildID' => $childID], []);
            $childPic =  $child->Image;
            $base64Image = base64_encode($childPic);
            $child->Image = 'data:image/jpg;base64,' . $base64Image;

            $data['children'][] = $child;
        }
        if (is_array($todayactivities) && !empty($todayactivities)) {
            $data['activities'] = $todayactivities;
        }
        $maiddataim = $maiddata->where_norder(['MaidID' => 1], []);

        foreach ($maiddataim as $mai) {
            $maidpic = $mai->Image;
            $base64Image = base64_encode($childPic);
            $mai->Image = 'data:image/jpg;base64,' . $base64Image;
        }
        $data['maids'] = $maiddataim;
        $data['Profile'] = $this->Profile();

        $this->view('Maid/home', $data);
    }
    public function conditions()
    {
        $childModel = new \Modal\Child();
        $childid = $_POST['child_id'];
        $data['children'] = $childModel->where_norder(['ChildID' => $childid], []);

        // show($data['children']);

        if (is_array($data) && !empty($data)) {
            $data['Profile'] = $this->Profile();
            $this->view('Maid/Profile', $data);
        }
    }
    public function markActivity()
    {
        $maidactivityModel = new \Modal\Maidactivity();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {



            // Insert the data into the database
            $success =  $maidactivityModel->update(['WorkID' => $_POST['work_id']], ['IsCompleted' => 1]);
            if ($success) {
                redirect('maid/home');
            } else {
                redirect('maid/home');
            }
        }
    }

    private function Profile()
    {
        $session = new \core\Session;
        $UserID = $session->get('USERID');

        $MaidModal = new \Modal\Maid;
        $data = $MaidModal->first(["UserID" => $UserID]);
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

    public function findID()
    {
        $maid = new \Modal\Maid;
        $session = new \Core\Session;

        $userID = $session->get('USERID');

        $row = $maid->first(['UserID' => $userID]);
        $result = $row->MaidID;

        return $result;


        $this->view('Maid/home');
    }
}
