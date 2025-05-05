<?php

    namespace Controller;
    use App\Helpers\ChildHelper;

    defined('ROOTPATH') or exit('Access denied');

    class Sucess{
        use MainController;
        public function index(){

            if(!isset($_SESSION['success']) && $_SESSION['success'] != true) {
                $session = new \core\Session;
                $Location = $session->get('Location');
                redirect($Location);
                exit;
            }

            else if(isset($_SESSION['success']) && $_SESSION['success'] == true && isset($_SESSION['APP']['CHILDID']) && isset($_SESSION['APP']['purpose']) && $_SESSION['APP']['purpose'] == "Overdue Pyament"){
                $PaymentModal = new \Modal\Payment;
                $session = new \core\Session;

                show($_SESSION);
                $ChildID = $session->get('CHILDID');
                $Amount = $session->get('total')/100;
                $Mode = "Online";
                $DateTime = date("Y-m-d H:i:s");

                $PaymentModal->insert(["ChildID" => $ChildID, "Amount" => $Amount, "Mode" => $Mode, "DateTime" => $DateTime]);
                $Payment = $PaymentModal->first(["ChildID" => $ChildID, "Amount" => $Amount, "Mode" => $Mode, "DateTime" => $DateTime]);

                if($_SESSION['APP']['purpose'] === 'Overdue Pyament'){
                    $FeesModal = new \Modal\Fees;

                    $childPayments = $FeesModal->where_order_desc(["ChildID" => $ChildID, "Status" => "Unpaid"], [], "DueDate");
                    $TotalAmount = 0;
                    show($childPayments);
            
                    if(!empty($childPayments)){
                        foreach ($childPayments as $payment) {
                            $TotalAmount += $payment->Amount;
                        }
                    }

                    if($TotalAmount == $Amount) {
                        foreach ($childPayments as $payment) {
                            $FeesModal->update(["FeesID" => $payment->FeesID], ["Status" => 'paid']);
                        }
                    }
                    else{
                        show("Payment not equal to total amount due");
                    }
                }

                // $session->unset('total');
                // $session->unset('purpose');
                // $session->unset('success');
                // unset($_SESSION['success']);

                $data['Payment'] = $Payment;
            }

            else if (isset($_SESSION['success']) && $_SESSION['success'] == true && isset($_SESSION['APP']['USERID']) && isset($_SESSION['APP']['purpose']) && $_SESSION['APP']['purpose'] == "Overdue Pyament Parent"){
                $PaymentModal = new \Modal\Payment;
                $session = new \core\Session;            
                $Childhelper = new ChildHelper();
                $FeesModal = new \Modal\Fees;
                $children = $Childhelper->store_child();
    
                $Amount = $session->get('total')/100;
                $Mode = "Online";
                $DateTime = date("Y-m-d H:i:s");
                $ChildAmount = 0;
                $Recipt = 0;
                $Count = 0;

                foreach ($children as $child){
                    $ChildAmount = 0;
                    $childPayments = $FeesModal->where_order_desc(["ChildID" => $child->ChildID, "Status" => "Unpaid"], [], "DueDate");
                    if(!empty($childPayments)){
                        foreach($childPayments as $pay){
                            $ChildAmount += $pay->Amount;
                        }
                    }

                    if($ChildAmount != 0){
                        $PaymentModal->insert(["ChildID" => $child->ChildID, "Amount" => $ChildAmount, "Mode" => $Mode, "DateTime" => $DateTime]);
                        $Payment = $PaymentModal->first(["ChildID" => $child->ChildID, "Amount" => $ChildAmount, "Mode" => $Mode, "DateTime" => $DateTime]);
                    }
                    if($Count == 0){
                        if(!empty($Payment)){
                            $Recipt = $Payment;
                            $Count ++;
                        }
                    }
    
                    $childPayments = $FeesModal->where_order_desc(["ChildID" => $child->ChildID, "Status" => "Unpaid"], [], "DueDate");
                    $TotalAmount = 0;
                    if(!empty($childPayments)){
                        foreach ($childPayments as $payment) {
                            $TotalAmount += $payment->Amount;
                        }
                    }
                        
                    if($TotalAmount == $ChildAmount && !empty($childPayments)) {
                        foreach ($childPayments as $payment) {
                            $FeesModal->update(["FeesID" => $payment->FeesID], ["Status" => 'paid']);
                        }
                    }
                        
                    // $session->unset('total');
                    // $session->unset('purpose');
                    // $session->unset('success');
                    // unset($_SESSION['success']);
                }
                if(isset($Amount)){
                    $Recipt->Amount = $Amount;
                }
                $data['Payment'] = $Recipt;
            }

            show($_SESSION);
            $this->view('Payments/Sucess', $data);
        }
    }
?>