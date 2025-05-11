<?php

namespace Controller;

defined('ROOTPATH') or exit('Access denied');

class Leaves
{
    use MainController;
    public function index()
    {
        $leavesModel = new \Modal\MaidLeave;
        $data['Profile'] = $this->Profile();

        if (isset($_GET["Date"]) && $_GET["Date"] !== '') {
            $data['Date'] = $_GET["Date"];
            $data['leaves']  = $leavesModel->where_order_desc(["MaidID" => $data['Profile']->MaidID, 'Start_Date' => $_GET["Date"]], [], "Start_Date");
            $_GET['Date'] = '';
        } else {
            $data['leaves']  = $leavesModel->where_order_desc(["MaidID" => $data['Profile']->MaidID], [], "Start_Date");
            $_GET['Date'] = '';
        }

        $this->view('Maid/leaves', $data);
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
    
    public function Requestleave(){
        show($_POST);
    }

    public function datefilter()
    {
        $leavesModel = new \Modal\MaidLeave;
        $data['leaves']  = $leavesModel->where_norder(['Start_Date' => $_POST["Date"]], []);
        $this->view('Maid/leaves', $data);
    }

    public function delmai()
    {
        $leavesModel = new \Modal\MaidLeave;
        $leave = $leavesModel->where_norder(['LeaveID' => $_POST["LeaveID"]], []);
        // show($leave);
        // exit();
        if ($leave[0]->Status === "Pending") {
            $leavesModel->delete($_POST['LeaveID'], 'LeaveID');
            // Redirect to the success page or show a success message
            redirect('Maid/Leaves');
        } else {

            redirect('Maid/Leaves');
        }
    }
}
