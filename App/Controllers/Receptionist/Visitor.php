<?php

    namespace Controller;

    defined('ROOTPATH') or exit('Access denied');

    class Visitor{

        use MainController;
        public function index(){
            $visitorModel = new \Modal\Visitor();
            $data['visitors'] = $visitorModel->findFirstRecords();
            // show($data);
            $this->view('Receptionist/visitor',$data);
        }
        public function addvisitor(){
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Directly take input from the form
                $data = [
                    'FirstName'   => $_POST['FirstName'],
                    'LastName'    => $_POST['LastName'],
                    'Phone_Number'        => $_POST['Phone_Number'],
                    'e_mail'        => $_POST['e_mail'],
                    'Role'     => $_POST['Role'],
                    'NID'  => $_POST['NID'] ,
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

    ?>