<?php

namespace Controller;

defined('ROOTPATH') or exit('Access denied');

class Individualvisitor
{
    use MainController;
    public function index(){

        $visitorModel = new \Modal\Visitor();

        $data['Profile'] = $this->Profile();
        $data['visitors'] = $visitorModel->where_norder(['VisitorID' => $_POST['VisitorID']], []);

        $this->view('Receptionist/individualvisitor', $data);
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

}
