<?php

namespace Controller;

defined('ROOTPATH') or exit('Access denied');

class Payment
{
    use MainController;
    public function index()
    {
        $paymentModel = new \Modal\Payment;
        $childModel = new \Modal\Child;
        $data['Profile'] = $this->Profile();
        $allPayments = $paymentModel->findall();

        foreach ($allPayments as $payment) {
            $child = $childModel->first(['ChildID' => $payment->ChildID], []);
            $payment->First_Name = $child->First_Name;
            $childPic =  $child->Image;
            $base64Image = base64_encode($childPic);
            $payment->Image = 'data:image/jpg;base64,' . $base64Image;
        }
        $data['payments'] = $allPayments;
        //  show($allPayments);
        // exit();
        $this->view('Receptionist/payment', $data);
    }

    public function delpay()
    {
        $paymentModel = new \Modal\Payment;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $paymentModel->delete($_POST['payment_id'], 'PaymentID');
            // Redirect to the success page or show a success message
            redirect('Receptionist/Payment');
        }
    }

    public function search()
    {
        $paymentModel = new \Modal\Payment();
        $childModel = new \Modal\Child;
        if (!empty($_POST['ChildID'])) {
            $childid = $_POST['ChildID'];
            $filterpaymenties = $paymentModel->where_norder(['ChildID' => $childid], []);
            foreach ($filterpaymenties as $payment) {
                $child = $childModel->first(['ChildID' => $payment->ChildID], []);
                $payment->First_Name = $child->First_Name;
                $childPic =  $child->Image;
                $base64Image = base64_encode($childPic);
                $payment->Image = 'data:image/jpg;base64,' . $base64Image;
            }
            //   show($filterpaymenties);
            //   exit();
            $data['payments'] = $filterpaymenties;
            // show($_POST['ChildID']);
            // exit();
        } else if (!empty($_POST['Date'])) {
            $date = $_POST['Date'];
            $filterpayments = $paymentModel->where_norder(['DateTime' => $date], []);
            foreach ($filterpayments as $payment) {
                $child = $childModel->first(['ChildID' => $payment->ChildID], []);
                $payment->First_Name = $child->First_Name;
                // $childPic =  $child->Image;
                // $base64Image = base64_encode($childPic);
                // $payment["Image"] = 'data:image/jpg;base64,' . $base64Image;
            }
            $data['payments'] = $filterpayments;
        }
        $this->view('Receptionist/Payment', $data);
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
