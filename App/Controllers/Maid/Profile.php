<?php

namespace Controller;

defined('ROOTPATH') or exit('Access denied');

class Profile
{
    use MainController;
    public function index()
    {
        $maiddata = new \Modal\Maid;
        $maiddataim = $maiddata->where_norder(['MaidID' => 1], []);

        foreach ($maiddataim as $mai) {
            $maidpic = $mai->Image;
            $base64Image = base64_encode($maidpic);
            $mai->Image = 'data:image/jpg;base64,' . $base64Image;
        }
        $data['maids'] = $maiddataim;
        $data['Profile'] = $this->Profile();

        $this->view('Maid/profile', $data);
    }
    public function cond()
    {
        $childModel = new \Modal\Child();
        $emergencyModel = new \Modal\Emergency();
        //  $maidid = $this->findID();
        $maidid = 1;
        $maidassignModel = new \Modal\AssignMaid();
        $data = [
            'ChildID' => $_POST['child_id'],
            'Description' => $_POST['description'],
            'AssigneeID' => $maidid,
            'Date' => date('Y-m-d'),
            'Time' => date('H:i:s'),
        ];

        if ($emergencyModel->validate($data)) {

            // Insert the data into the database
            $emergencyModel->insert($data);
            redirect('Maid/Home');
        }
    }
    public function condi()
    {
        $behaviourModel = new \Modal\Behaviour;
        // $maidid = $this->findID();
        $maidid = 1;
        $data = [
            'ChildID' => $_POST['child_id'],
            'Description' => $_POST['description'],
            'AssigneeID' => $maidid,
            'Date' => date('Y-m-d'),
            'Time' => date('H:i:s'),
        ];

        if ($behaviourModel->validate($data)) {

            // Insert the data into the database
            $behaviourModel->insert($data);


            redirect('Maid/Home');
        }
    }
    public function findID()
    {
        $maid = new \Modal\Maid;
        $session = new \Core\Session;

        $userID = $session->get('USERID');

        $row = $maid->first(['UserID' => $userID]);
        $result = $row->MaidID;

        return $result;
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

}
