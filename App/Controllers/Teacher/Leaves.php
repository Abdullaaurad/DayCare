<?php

namespace Controller;

class Leaves
{
    use MainController;


    public function index()
    {


        $leave = new \Modal\TeacherLeave;
        $rem = new \Modal\TeacherRem;
        $teacher = new \Modal\Teacher;

        // $TeacherID = $this->findID();
        $TeacherID =  1;

        $row = $teacher->first(['TeacherID' => $TeacherID]);
        $firstName = $row->First_Name;
        $lastName = $row->Last_Name;
        $email =  $row->Email;
        $image = $row->Image;
        $base64Image = base64_encode($image);

        $result = [
            'firstName' => $firstName,
            'lastName' => $lastName,
            'email' => $email,
            'image' => 'data:image/jpg;base64,' . $base64Image
        ];





        //remaining leaves of the teacher in each type
        $remainings = $rem->where_norder(['TeacherID' => $TeacherID]);

        if (empty($remainings)) {
            //assigning total allocated leaves to each type
            $rem->insert(['TeacherID' => $TeacherID, 'Leave Type' => 'Annual Leave', 'TotalAllocated' => 12, 'Used' => 0, 'Remaining' => 12]);
            $rem->insert(['TeacherID' => $TeacherID, 'Leave Type' => 'Sick Leave', 'TotalAllocated' => 10, 'Used' => 0, 'Remaining' => 10]);
            $rem->insert(['TeacherID' => $TeacherID, 'Leave Type' => 'Compassionate Leave', 'TotalAllocated' => 5, 'Used' => 0, 'Remaining' => 5]);
        } else {

            // show($remainings);
            // exit;

            foreach ($remainings as $rem) {
                $rems[] = [
                    'LeaveType' => $rem->LeaveType,
                    'Used' => $rem->Used,
                    'Remain' => $rem->Remaining
                ];
            }
        }



        // all leaves of the teacher
        $leaves = $leave->where_norder(['TeacherID' => $TeacherID]);

        foreach ($leaves as $date) {
            if (strtotime($date->Start_Date) < strtotime(date('Y-m-d')) && $date->Status == 'Pending') {
                $date->Status = 'Rejected'; // assignment, not comparison
            }
        }

        // show($leaves);
        // exit();



        if (!empty($leaves)) {
            $this->view('Teacher/Leaves', ['leaves' => $leaves, 'remains' => $remainings, 'result' => $result, 'rems' => $rems, "Profile" => $this->Profile()]);
        } else {
            $this->view('Teacher/Leaves', ['message' => 'No leave records found for you.', 'result' => $result, "Profile" => $this->Profile()]);
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

    public function addLeave()
    {

        $leave = new \Modal\TeacherLeave;
        $rem = new \Modal\TeacherRem;
        $session = new \Core\Session;
        $teacher = new \Modal\Teacher;

        // $TeacherID = $this->findID();
        $TeacherID =  1;

        $row = $teacher->first(['TeacherID' => $TeacherID]);
        $firstName = $row->First_Name;
        $lastName = $row->Last_Name;
        $email =  $row->Email;
        $image = $row->Image;
        $base64Image = base64_encode($image);

        $result = [
            'firstName' => $firstName,
            'lastName' => $lastName,
            'email' => $email,
            'image' => 'data:image/jpg;base64,' . $base64Image
        ];



        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $arr = $_POST;

            // var_dump($TeacherID,$arr);
            // exit();

            if (!$TeacherID) {
                // Redirect to login page if TeacherID is not found
                $this->view('Teacher/Leaves', ['message' => 'Please log in to request a leave.', 'result' => $result, "Profile" => $this->Profile()]);
                return;
            }
            $arr = array_merge($arr, ['TeacherID' => $TeacherID]);

            // Validate form data
            $reuslt  = $leave->validate($arr);
            if ($reuslt) {

                //find the leave duraiton
                $arr['Duration'] = (strtotime($arr['End_Date']) -  strtotime($arr['Start_Date'])) / (60 * 60 * 24);;
                //       var_dump($arr);
                // exit();

                if ($arr['Leave_Type'] == 'Annual Leave') {
                    $remainings = $rem->where_norder(['TeacherID' => $TeacherID, 'LeaveType' => $arr['Leave_Type']]);
                    $remains = (int)$remainings[0]->Remaining;

                    if ($remains > 0 &&  $arr['Duration'] <= 2) {
                        $arr['Status'] = 'Approved';
                    } else if ($arr['Duration'] > 2 && $remains > 0) {
                        $arr['Status'] = 'Pending';
                    } else if ($remains === 0) {
                        $arr['Status'] = 'Rejected';
                    }
                    // var_dump($arr);
                    // exit();
                } else if ($arr['Leave_Type'] == 'Sick Leave') {
                    $remainings = $rem->where_norder(['TeacherID' => $TeacherID, 'LeaveType' => $arr['Leave_Type']]);
                    $remains = (int)$remainings[0]->Remaining;

                    if ($remains > 0 &&  $arr['Duration'] <= 1) {
                        $arr['Status'] = 'Approved';
                    } else if ($arr['Duration'] > 1 && $remains > 0) {
                        $arr['Status'] = 'Pending';
                    } else if ($remains === 0) {
                        $arr['Status'] = 'Pending';
                    }
                    // var_dump($arr);
                    // exit();

                } else if ($arr['Leave_Type'] == 'Compassionate Leave') {
                    $remainings = $rem->where_norder(['TeacherID' => $TeacherID, 'LeaveType' => $arr['Leave_Type']]);
                    $remains = (int)$remainings[0]->Remaining;
                    if ($remains > 0) {
                        $arr['Status'] = 'Pending';
                    } else {
                        $arr['Status'] = 'Rejected';
                    }
                }
                if (!($leave->insert($arr))) {
                    $this->view('Teacher/Leaves', ['result' => $result, 'success' => "Request Sent Successfully", "Profile" => $this->Profile()]);
                } else {
                    $this->view('Teacher/Leaves', ['message' => 'Failed to add leave. Please try again.', 'result' => $result, "Profile" => $this->Profile()]);
                }
            } else {
                // Show validation errors
                $this->view('Teacher/Leaves', ['errors' => $leave->errors, 'result' => $result, "Profile" => $this->Profile()]);
            }
        } else {
            $this->view('Teacher/Leaves', ['result' => $result, "Profile" => $this->Profile()]);
        }
    }

    public function editLeave()
    {

        $leave = new \Modal\TeacherLeave;
        $rem = new \Modal\TeacherRem;
        $session = new \Core\Session;
        $teacher = new \Modal\Teacher;

        // $TeacherID = $this->findID();
        $TeacherID =  1;


        $row = $teacher->first(['TeacherID' => $TeacherID]);
        $firstName = $row->First_Name;
        $lastName = $row->Last_Name;
        $email =  $row->Email;
        $image = $row->Image;
        $base64Image = base64_encode($image);

        $result = [
            'firstName' => $firstName,
            'lastName' => $lastName,
            'email' => $email,
            'image' => 'data:image/jpg;base64,' . $base64Image
        ];



        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $TeacherID = $this->findID();

            $arr = $_POST;
            $arr = array_merge($arr, ['TeacherID' => $TeacherID]);
            if (!empty($arr)) {

                $valid  = $leave->validate($arr);
                if (!$valid) {

                    $this->view('Teacher/Leaves', ['errors' => $leave->errors, 'result' => $result, "Profile" => $this->Profile()]);
                    return;
                }
                // show($arr);
                // exit();

                //find the leave duraiton
                $arr['Duration'] = (strtotime($arr['End_Date']) -  strtotime($arr['Start_Date'])) / (60 * 60 * 24);

                if ($arr['Leave_Type'] == 'Annual Leave') {
                    $remainings = $rem->where_norder(['TeacherID' => $TeacherID, 'LeaveType' => $arr['Leave_Type']]);
                    $remains = (int)$remainings[0]->Remaining;

                    if ($remains > 0 &&  $arr['Duration'] <= 2) {
                        $arr['Status'] = 'Approved';
                    } else if ($arr['Duration'] > 2 && $remains > 0) {
                        $arr['Status'] = 'Pending';
                    } else if ($remains === 0) {
                        $arr['Status'] = 'Rejected';
                    }
                    // var_dump($arr);
                    // exit();
                } else if ($arr['Leave_Type'] == 'Sick Leave') {
                    $remainings = $rem->where_norder(['TeacherID' => $TeacherID, 'LeaveType' => $arr['Leave_Type']]);
                    $remains = (int)$remainings[0]->Remaining;

                    if ($remains > 0 &&  $arr['Duration'] <= 1) {
                        $arr['Status'] = 'Approved';
                    } else if ($arr['Duration'] > 1 && $remains > 0) {
                        $arr['Status'] = 'Pending';
                    } else if ($remains === 0) {
                        $arr['Status'] = 'Pending';
                    }
                    // var_dump($arr);
                    // exit();

                } else if ($arr['Leave_Type'] == 'Compassionate Leave') {
                    $remainings = $rem->where_norder(['TeacherID' => $TeacherID, 'LeaveType' => $arr['Leave_Type']]);
                    $remains = (int)$remainings[0]->Remaining;
                    if ($remains > 0) {
                        $arr['Status'] = 'Pending';
                    } else {
                        $arr['Status'] = 'Rejected';
                    }
                }


                //update the record
                $results = $leave->update_withid($arr['LeaveID'], $arr, 'LeaveID');

                if (isset($results)) {
                    $this->view('Teacher/Leaves', ['result' => $result, 'success' => 'Leave Updated Successfully', "Profile" => $this->Profile()]);
                } else {
                    $this->view('Teacher/Leaves', ['message' => 'Faild to Update ', 'result' => $result, "Profile" => $this->Profile()]);
                }
                // }else{
                //     $this->view('Teacher/Leaves', ['errors' => $leave->errors,'result' => $result]);
                // }

            } else {
                $this->view('Teacher/Leaves', ['message' => 'Faild to Update Due to Error', 'result' => $result, "Profile" => $this->Profile()]);
            }
        }
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

    public function deleteLeave()
    {
        $leave = new \Modal\TeacherLeave;
        $rem = new \Modal\TeacherRem;
        $session = new \Core\Session;
        $teacher = new \Modal\Teacher;

        $TeacherID = $this->findID();

        $row = $teacher->first(['TeacherID' => $TeacherID]);
        $firstName = $row->First_Name;
        $lastName = $row->Last_Name;
        $email =  $row->Email;
        $image = $row->Image;
        $base64Image = base64_encode($image);

        $result = [
            'firstName' => $firstName,
            'lastName' => $lastName,
            'email' => $email,
            'image' => 'data:image/jpg;base64,' . $base64Image
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $arr = $_POST;
            $leaves = $leave->first(['LeaveID' => $arr['LeaveID']]);
            if ($leaves->Status == 'Pending') {
                $leave->delete($arr['LeaveID'], 'LeaveID');

                $this->view('Teacher/Leaves', ['message' => 'Deleted Successfully', 'result' => $result, "Profile" => $this->Profile()]);
            } else {
                $this->view('Teacher/Leaves', ['message' => 'Faild to Delete', 'result' => $result, "Profile" => $this->Profile()]);
            }
        }
    }
}
