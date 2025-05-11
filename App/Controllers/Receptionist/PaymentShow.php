<?php

namespace Controller;

class PaymentShow
{
    use MainController;

    public function index()
    {
        $paymentModel = new \Modal\Payment;
        $feesModel = new \Modal\Fees;

        $data  = [
            'ChildID' => $_POST['child_id'],
            'Amount' => $_POST['total_payment'],
            'Status' => 'Paid',
            'DueDate' => date('Y-m-t'),
        ];
        $pay = [
            'DateTime' => date('Y-m-d H:i:s'),
            'ChildID' => $_POST['child_id'],
            'Amount' => $_POST['total_payment'],
            'Mode' => 'Cash',
        ];
        $fees = $feesModel->insert($data);
        $payment = $paymentModel->insert($pay);

        // Redirect to the success page or show a success message
        if ($fees) {
            redirect('Receptionist/Payment');
        } else {
            // Pass a message to the view if no tasks exist
            $data['Profile'] = $this->Profile();
            $this->view('Receptionist/Paymenterror');
        }
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

    public function Logout()
    {
        $session = new \core\Session();
        $session->logout();

        echo json_encode(["success" => true]);
        exit;
    }
}
