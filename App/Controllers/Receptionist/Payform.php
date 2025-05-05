<?php

    namespace Controller;

    defined('ROOTPATH') or exit('Access denied');

    class Payform{
        use MainController;
        
        public function index(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $childModel = new \Modal\Child;
            $expenseModel = new \Modal\Expense;
            $month = date('m');
            $year = date('Y');
            $firstdate = sprintf('%04d-%02d-01', $year, $month);
            $data['payments'] = $expenseModel->where_norder(['Date'=>$firstdate,'ChildID'=> $_POST['reg_no'] ], []);
            $totalAmount = 0;
            if(is_array($data['payments'])){
                foreach ($data['payments'] as $payment) {
                    $totalAmount += $payment->Amount;
                }
            }
            $data['children'] = $childModel->where_norder(['ChildID'=> $_POST['reg_no'] ], []);
            $netAmount =  number_format($totalAmount, 2, '.', '');

            $totalObject = new \stdClass();
            $totalObject->Amount = $netAmount;
            $totalObject->Description = 'Total';
            
            $data['payments'][] = $totalObject;
            
            // show($data['payments']);
            // exit();
            $this->view('Receptionist/paymentShow', $data);
            
            }else{

            $this->view('Receptionist/payform');
        }
        }
    }
?>