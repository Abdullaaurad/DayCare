<?php

namespace Controller;

defined('ROOTPATH') or exit('Access denied');

class Leave
{
    use MainController;
    public function index()
    {
        $leavesModel = new \Modal\ReceptionistLeave;
        $data['Profile'] = $this->Profile();

        if(isset($_GET["Date"]) && $_GET["Date"] !== ''){
            $data['Date'] = $_GET["Date"];
            $data['leaves']  = $leavesModel->where_order_desc(["ReceptionistID" => $data['Profile']->ReceptionistID, 'Start_Date' => $_GET["Date"]], [], "Start_Date");
            $_GET['Date'] = '';
        }else{
            $data['leaves']  = $leavesModel->where_order_desc(["ReceptionistID" => $data['Profile']->ReceptionistID], [], "Start_Date");
            $_GET['Date'] = '';
        }

        $this->view('Receptionist/leave', $data);
    }

    private function Profile()
    {
        $session = new \core\Session;
        $session->set('USERID', 24);
        $UserID = $session->get('USERID');

        $ReceptionistModal = new \Modal\Receptionist;
        $data = $ReceptionistModal->first(["UserID" => $UserID]);
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

    public function RequestLeave() {
        $repLeaveModel = new \Modal\ReceptionistLeave;
        $ReceptionistModal = new \Modal\Receptionist;
        $session = new \core\session;
        $UserID = $session->get("USERID");
        $receptionist = $ReceptionistModal->first(["UserID" => $UserID]);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $startDate = $_POST['Start_Date'];
            $endDate = $_POST['End_Date'];
            $description = $_POST['Description'];
            $leaveType = $_POST['Leave_Type'];

            // Validate dates
            if (strtotime($startDate) > strtotime($endDate)) {
                $_SESSION['error'] = "Start date cannot be after end date.";
                redirect('Receptionist/RequestLeave');
                return;
            }

            $data = [
                'ReceptionistID' => $receptionist->ReceptionistID,
                'Start_Date' => $startDate,
                'End_Date' => $endDate,
                'Description' => $description,
                'Leave_Type' => $leaveType,
                'Status' => 'Pending',
                'RecID' => $receptionist->ReceptionistID,
            ];
            $data['Duration'] = (strtotime($endDate) - strtotime($startDate)) / (60 * 60 * 24) + 1;
            $repLeaveModel->insert($data);
            redirect('Receptionist/Leave');
        }
    }

    public function delrec()
    {
        $leavesModel = new \Modal\ReceptionistLeave;
        $leave = $leavesModel->where_norder(['LeaveID' => $_POST["LeaveID"]], []);
        if ($leave[0]->Status === "Pending") {
            $leavesModel->delete($_POST['LeaveID'], 'LeaveID');
            // Redirect to the success page or show a success message
            redirect('Receptionist/Leave');
        } else {

            redirect('Receptionist/Leave');
        }
    }
}
