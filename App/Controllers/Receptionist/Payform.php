<?php

    namespace Controller;

    defined('ROOTPATH') or exit('Access denied');

    class Payform
    {
        use MainController;

        public function index()
        {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $childModel = new \Modal\Child;
                $expenseModel = new \Modal\Expense;
                $month = date('m');
                $year = date('Y');
                $firstdate = sprintf('%04d-%02d-01', $year, $month);
                $data['payments'] = $expenseModel->where_norder(['Date' => $firstdate, 'ChildID' => $_POST['reg_no']], []);
                $totalAmount = 0;
                if (is_array($data['payments'])) {
                    foreach ($data['payments'] as $payment) {
                        $totalAmount += $payment->Amount;
                    }
                }
                $data['children'] = $childModel->where_norder(['ChildID' => $_POST['reg_no']], []);
                $netAmount =  number_format($totalAmount, 2, '.', '');

                $totalObject = new \stdClass();
                $totalObject->Amount = $netAmount;
                $totalObject->Description = 'Total';

                $data['payments'][] = $totalObject;

                // show($data['payments']);
                // exit();
                $data['Profile'] = $this->Profile();
                $this->view('Receptionist/paymentShow', $data);
            } else {

                $data['Profile'] = $this->Profile();
                $this->view('Receptionist/payform', $data);
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
    }

?>