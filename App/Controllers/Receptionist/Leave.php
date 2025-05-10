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

    public function RequestLeave(){
        $repLeaveModel = new \Modal\ReceptionistLeave;
        // $maidid = $this->findID();
        $repid = 1;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'ReceotionistID' => $repid,
                'Start_Date' => $_POST['Start_Date'],
                'End_Date' => $_POST['End_Date'],
                'Description' => $_POST['Description'],
                'Leave_Type' => $_POST['Leave_Type'],
                'Status' => 'Pending',
            ];
            $data['Duration'] = (strtotime($data['End_Date']) - strtotime($data['Start_Date'])) / (60 * 60 * 24) + 1;
            if ($repLeaveModel->validate($data)) {
                $repLeaveModel->insert($data);

                redirect('Receptionist/Leaves');
            }
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
