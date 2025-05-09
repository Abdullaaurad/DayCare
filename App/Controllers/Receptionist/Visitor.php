<?php

namespace Controller;

defined('ROOTPATH') or exit('Access denied');

class Visitor
{

    use MainController;
    public function index()
    {
        $visitorModel = new \Modal\Visitor();
        $data['visitors'] = $visitorModel->findFirstRecords();
        $data['Profile'] = $this->Profile();

        $this->view('Receptionist/visitor', $data);
    }

    private function Profile(){
        $session = new \core\Session;
        $session->set('USERID', 24);
        $UserID = $session->get('USERID');

        $ReceptionistModal = new \Modal\Receptionist;
        $data = $ReceptionistModal->first(["UserID" => $UserID]);
        if(!empty($data)){
            $imageData = $data->Image;
            $imageType = $data->ImageType;
            $base64Image = (!empty($imageData) && is_string($imageData)) 
                ? 'data:' . $imageType . ';base64,' . base64_encode($imageData) 
                : null
            ;
            $data->Image = $base64Image;
            $data->EmployeeID = 'EMP' . str_pad($data->UserID, 5, '0', STR_PAD_LEFT);
        }

        return $data;
    }

    public function Logout(){
        $session = new \core\Session();
        $session->logout();

        echo json_encode(["success" => true]);
        exit;
    }

    public function addvisitor()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Directly take input from the form
            $data = [
                'FirstName'   => $_POST['FirstName'],
                'LastName'    => $_POST['LastName'],
                'Phone_Number'        => $_POST['Phone_Number'],
                'e_mail'        => $_POST['e_mail'],
                'Role'     => $_POST['Role'],
                'NID'  => $_POST['NID'],
                'Date'         => date('Y-m-d'), // Default to current date
                'Purpose'      => $_POST['Purpose'],
                'Start_Time'      => $_POST['Start_Time'],
                'End_Time'     => $_POST['End_Time'],
            ];

            $visitorModel = new \Modal\Visitor();
            if ($visitorModel->validate($data)) {
                // Insert the data into the database
                $visitorModel->insert($data);
                // Redirect to success page or display a success message
                redirect('Receptionist/Visitortable');
            } else {
                $this->view('Receptionist/Visitorerror');
            }
        }
    }
}
