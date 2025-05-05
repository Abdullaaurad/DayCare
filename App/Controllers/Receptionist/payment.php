<?php

    namespace Controller;

    defined('ROOTPATH') or exit('Access denied');

    class Payment{
        use MainController;
        public function index(){
            $paymentModel = new \Modal\Payment;
            $childModel = new \Modal\Child;
            $allPayments = $paymentModel->findall();
            // show($allPayments);
            // exit();
            foreach($allPayments as $payment){
            

                  $child = $childModel->first(['ChildID' => $payment->ChildID],[]);
                    $payment->First_Name = $child->First_Name ;
                    $childPic =  $child->Image;
                    $base64Image = base64_encode($childPic);
                    $payment->Image = 'data:image/jpg;base64,' . $base64Image;
                }
            $data['payments'] = $allPayments;
            //  show($allPayments);
            // exit();
            $this->view('Receptionist/payment',$data);
        }
        public function delpay(){
            $paymentModel = new \Modal\Payment;
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                
               $paymentModel->delete($_POST['payment_id'],'PaymentID');
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
               foreach($filterpaymenties as $payment){
                $child = $childModel->first(['ChildID' => $payment->ChildID],[]);
                  $payment->First_Name = $child->First_Name ;
                  $childPic =  $child->Image;
                  $base64Image = base64_encode($childPic);
                  $payment->Image = 'data:image/jpg;base64,' . $base64Image;
              }
            //   show($filterpaymenties);
            //   exit();
              $data['payments'] = $filterpaymenties;
                // show($_POST['ChildID']);
                // exit();
            }else if (!empty($_POST['Date'])) {
                $date = $_POST['Date'];
                $filterpayments = $paymentModel->where_norder(['DateTime' => $date], []);
                foreach($filterpayments as $payment){
                    $child = $childModel->first(['ChildID' => $payment->ChildID],[]);
                      $payment->First_Name = $child->First_Name ;
                      // $childPic =  $child->Image;
                      // $base64Image = base64_encode($childPic);
                      // $payment["Image"] = 'data:image/jpg;base64,' . $base64Image;
                  }
                  $data['payments'] = $filterpayments;
            }
            $this->view('Receptionist/Payment', $data);
            
        }
    }
?>