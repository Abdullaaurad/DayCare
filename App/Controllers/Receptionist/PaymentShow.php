<?php

    namespace Controller;

    class PaymentShow{
        use MainController;

        public function index(){
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
                    'Mode'=> 'Cash',
                ];
                $fees = $feesModel->insert($data);
                $payment = $paymentModel->insert($pay);
                
                    // Redirect to the success page or show a success message
                if($fees){    
                    redirect('Receptionist/Payment');

                
                
               }else{
            // Pass a message to the view if no tasks exist
                $this->view('Receptionist/Paymenterror');
               }
           
        }

       
    
    }
     
     



?>

