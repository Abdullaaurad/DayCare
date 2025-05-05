<?php

    namespace Controller;

    use App\Helpers\SidebarHelper;
    use App\Helpers\ChildHelper;
    use Illuminate\Http\Request;
    use Illuminate\Routing\Controller;

use DateTime;

    defined('ROOTPATH') or exit('Access denied');

    class Payment{
        use MainController;
        public function index(){
            $session = new \Core\Session;
            $session->set("USERID", 1);
            $session = new \Core\Session;
            $session->check_login();

            $data = [];
            $SidebarHelper = new SidebarHelper();
            $data = $SidebarHelper->store_sidebar();

            $session->set("Location" , 'Parent/Payment');
            $Childhelper = new ChildHelper();
            $children = $Childhelper->store_child();

            foreach($children as $child){
                $currentDate = date('Y-m-d');
                $month = date('m');
                $year = date('Y');
                $firstdate = sprintf('%04d-%02d-01', $year, $month);

                $ExpensesModal = new \Modal\Expense;
                $Expenses = $ExpensesModal->first(["ChildID"=> $child->ChildID,"Date" => $firstdate]);
                if(empty($Expenses)){
                    $AttendanceModal = new \Modal\Attendance;
                    $ReservationsModal = new \Modal\Reservation;
                    $PackageModal = new \Modal\Package;
                    $ChildModal = new \Modal\Child;
                    $ChildHelper = new \App\Helpers\ChildHelper;
                    $SnackRequestModal = new \Modal\SnackRequest;
                    $EventModal = new \Modal\Event;
                    $EventEnrollModal = new \Modal\EventEnrollment;
                
                    $firstdate = sprintf('%04d-%02d-01', $year, $month);
                    $currentMonth = date('m');
                    $currentYear = date('Y');
                
                    $lastdate = ((int)$month === (int)$currentMonth && (int)$year === (int)$currentYear)
                        ? date('Y-m-d') // Today
                        : date('Y-m-t', strtotime($firstdate)); // Last day of month
                
                    $Attendance = $AttendanceModal->findFutureDatesWithConditions($firstdate, $lastdate, ["ChildID"=>$child->ChildID] ,"Start_Date");
                    $Child = $ChildModal->first(["ChildID"=> $child->ChildID]);
                    $AgeGroup = $ChildHelper->getAgeGroup($Child->DOB);
                    $Package = $PackageModal->first(["PackageID" => $Child->PackageID]);

                    if(!empty($Package)){
                        $ExpensesModal->insert(["ChildID" => $child->ChildID, "Date" => $firstdate, "UpdatedDate" => $currentDate, "Amount" => $Package->Price, "Description" => "Package"]);
                    }

                    $validDays = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
                    $allowedDays = json_decode($Package->allowed_days ?? '[]');
                
                    $Amount = 0;
                    if(!empty($Attendance)){
                        foreach ($Attendance as $post) {
                            $startDate = date('Y-m-d', strtotime($post->Start_Date));
                            $endDate = date('Y-m-d', strtotime($post->End_Date));
                            $dayOfWeek = date('l', strtotime($startDate));
                    
                            // Handle 24-hour reservation
                            if ($startDate !== $endDate) {
                                if (!$Package->AllHours) {
                                    $Amount = $Amount + 5000;
                                }
                                continue;
                            }
                    
                            // ✅ Step 1: If current package covers the day — skip
                            if (in_array($dayOfWeek, $allowedDays)) {
                                continue;
                            }
                    
                            // ✅ Step 2: Look for alternative package that allows this day
                            $PaymentPackage = $PackageModal->first([
                                $dayOfWeek => 1,
                                "AgeGroup" => $AgeGroup
                            ]);
                    
                            if ($PaymentPackage) {
                                // Manually count allowed days in that package
                                $paymentAllowedDays = [];
                                foreach ($validDays as $day) {
                                    if (!empty($PaymentPackage->$day)) {
                                        $paymentAllowedDays[] = $day;
                                    }
                                }
                                $dayCount = count($paymentAllowedDays);
                                $amountPerDay = ($dayCount > 0) ? ($PaymentPackage->Price / ($dayCount * 4)) : 0;
                    
                                $Amount = $Amount + $amountPerDay;
                            } else {
                                $Amount = $Amount + 2000;
                            }
                        }
                    }

                    $Reservation = $ReservationsModal->findFutureDatesWithConditions($firstdate, $lastdate, ["ChildID" => $child->ChildID]);

                    if(!empty($Reservation)){
                        foreach ($Reservation as $Res){
                            $DidAttend = $AttendanceModal->first(["ChildID" => $child->ChildID, "Start_Date"=> $Res->Date]);
                            if(empty($DidAttend)){
                                if($Res->Is_24_Hour){
                                    $Amount = $Amount + 1000;
                                }
                                else{
                                    $Amount = $Amount + 500;
                                }
                            }
                            else{
                                if($Res->Is_24_Hour && $DidAttend->Start_Date == $DidAttend->End_Date){
                                    $Amount = $Amount + 200;
                                }
                                else if($Res->Is_24_Hour == 0 && $DidAttend->Start_Date != $DidAttend->End_Date){
                                    $Amount = $Amount + 500;
                                }
                            }
                        }
                    }

                    $ExpensesModal->insert(["ChildID" => $child->ChildID, "Date" => $firstdate, "UpdatedDate" => $currentDate, "Amount" => $Amount, "Description" => "Reservations"]);

                    $Amount = 0;
                    $Snacks = $SnackRequestModal->findFutureDatesWithConditions($firstdate, $lastdate, ["ChildID" => $child->ChildID]);
                    if(!empty($Snacks)){
                        foreach($Snacks as $sna){
                            if($sna->Provide){ 
                                $Amount = $Amount + 150*$sna->Quantity;
                            }
                        }
                    }
                    
                    $ExpensesModal->insert(["ChildID" => $child->ChildID, "Date" => $firstdate, "UpdatedDate" => $currentDate, "Amount" => $Amount, "Description" => "Meal"]);

                    $Amount = 0;
                    $Events = $EventEnrollModal->findFutureDatesWithConditions($firstdate, $lastdate, ["ChildID" => $child->ChildID]);
                    if(!empty($Events)){
                        foreach($Events as $Event){
                            $EventDetails = $EventModal->first(["EventID" => $Event->EventID]);
                            $Amount = $Amount + $EventDetails->Fee;
                        }
                    }

                    $ExpensesModal->insert(["ChildID" => $child->ChildID, "Date" => $firstdate, "UpdatedDate" => $currentDate, "Amount" => $Amount, "Description" => "Activity"]);

                }
                else{
                    if($Expenses->UpdatedDate != $currentDate){
                        $AttendanceModal = new \Modal\Attendance;
                        $ReservationsModal = new \Modal\Reservation;
                        $PackageModal = new \Modal\Package;
                        $ChildModal = new \Modal\Child;
                        $ChildHelper = new \App\Helpers\ChildHelper;
                        $SnackRequestModal = new \Modal\SnackRequest;
                        $EventModal = new \Modal\Event;
                        $EventEnrollModal = new \Modal\EventEnrollment;
                    
                        $firstdate = sprintf('%04d-%02d-01', $year, $month);
                        $currentMonth = date('m');
                        $currentYear = date('Y');
                    
                        $lastdate = ((int)$month === (int)$currentMonth && (int)$year === (int)$currentYear)
                            ? date('Y-m-d') // Today
                            : date('Y-m-t', strtotime($firstdate)); // Last day of month
                    
                        $Attendance = $AttendanceModal->findFutureDatesWithConditions($firstdate, $lastdate, ["ChildID"=>$child->ChildID] ,"Start_Date");
                        $Child = $ChildModal->first(["ChildID"=> $child->ChildID]);
                        $AgeGroup = $ChildHelper->getAgeGroup($Child->DOB);
                        $Package = $PackageModal->first(["PackageID" => $Child->PackageID]);
        
                        $Expenses = $ExpensesModal->first(["ChildID"=> $child->ChildID,"Date" => $firstdate, "Description" => "Package"]);
                        if(!empty($Expenses)){
                            $ExpensesModal->update(["ExpenseID" => $Expenses->ExpenseID], ["UpdatedDate" => $currentDate]);
                        }
        
                        $validDays = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
                        $allowedDays = json_decode($Package->allowed_days ?? '[]');
                    
                        $Amount = 0;
                        if(!empty($Attendance)){
                            foreach ($Attendance as $post) {
                                $startDate = date('Y-m-d', strtotime($post->Start_Date));
                                $endDate = date('Y-m-d', strtotime($post->End_Date));
                                $dayOfWeek = date('l', strtotime($startDate));
                        
                                // Handle 24-hour reservation
                                if ($startDate !== $endDate) {
                                    if (!$Package->AllHours && $Package) {
                                        $Amount = $Amount + 5000;
                                    }
                                    continue;
                                }
                        
                                // ✅ Step 1: If current package covers the day — skip
                                if (in_array($dayOfWeek, $allowedDays)) {
                                    continue;
                                }
                        
                                // ✅ Step 2: Look for alternative package that allows this day
                                $PaymentPackage = $PackageModal->first([
                                    $dayOfWeek => 1,
                                    "AgeGroup" => $AgeGroup
                                ]);
                        
                                if ($PaymentPackage) {
                                    // Manually count allowed days in that package
                                    $paymentAllowedDays = [];
                                    foreach ($validDays as $day) {
                                        if (!empty($PaymentPackage->$day)) {
                                            $paymentAllowedDays[] = $day;
                                        }
                                    }
                                    $dayCount = count($paymentAllowedDays);
                                    $amountPerDay = ($dayCount > 0) ? ($PaymentPackage->Price / ($dayCount * 4)) : 0;
                        
                                    $Amount = $Amount + $amountPerDay;
                                } else {
                                    $Amount = $Amount + 2000;
                                }
                            }
                        }
        
                        $Reservation = $ReservationsModal->findFutureDatesWithConditions($firstdate, $lastdate, ["ChildID" => $child->ChildID]);
        
                        if(!empty($Reservation)){
                            foreach ($Reservation as $Res){
                                $DidAttend = $AttendanceModal->first(["ChildID" => $child->ChildID, "Start_Date"=> $Res->Date]);
                                if(empty($DidAttend)){
                                    if($Res->Is_24_Hour){
                                        $Amount = $Amount + 1000;
                                    }
                                    else{
                                        $Amount = $Amount + 500;
                                    }
                                }
                                else{
                                    if($Res->Is_24_Hour && $DidAttend->Start_Date == $DidAttend->End_Date){
                                        $Amount = $Amount + 200;
                                    }
                                    else if($Res->Is_24_Hour == 0 && $DidAttend->Start_Date != $DidAttend->End_Date){
                                        $Amount = $Amount + 500;
                                    }
                                }
                            }
                        }
        
                            
                        $Expenses = $ExpensesModal->first(["ChildID"=> $child->ChildID,"Date" => $firstdate, "Description" => "Reservations"]);
                        $ExpensesModal->update(["ExpenseID" => $Expenses->ExpenseID], ["UpdatedDate" => $currentDate, "Amount" => $Amount]);
        
                        $Amount = 0;
                        $Snacks = $SnackRequestModal->findFutureDatesWithConditions($firstdate, $lastdate, ["ChildID" => $child->ChildID]);
                        if(!empty($Snacks)){
                            foreach($Snacks as $sna){
                                if($sna->Provide){ 
                                    $Amount = $Amount + 150*$sna->Quantity;
                                }
                            }
                        }
                        
                        $Expenses = $ExpensesModal->first(["ChildID"=> $child->ChildID,"Date" => $firstdate, "Description" => "Meal"]);
                        $ExpensesModal->update(["ExpenseID" => $Expenses->ExpenseID], ["UpdatedDate" => $currentDate, "Amount" => $Amount]);
        
                        $Amount = 0;
                        $Events = $EventEnrollModal->findFutureDatesWithConditions($firstdate, $lastdate, ["ChildID" => $child->ChildID]);
                        if(!empty($Events)){
                            foreach($Events as $Event){
                                $EventDetails = $EventModal->first(["EventID" => $Event->EventID]);
                                $Amount = $Amount + $EventDetails->Fee;
                            }
                        }
        
                        $Expenses = $ExpensesModal->first(["ChildID"=> $child->ChildID,"Date" => $firstdate, "Description" => "Activity"]);
                        $ExpensesModal->update(["ExpenseID" => $Expenses->ExpenseID], ["UpdatedDate" => $currentDate, "Amount" => $Amount]);
                    }
                }
            }

            $data = $data + $this->store_states();
            $data['graph'] = $this->graph();
            $data['description'] = $this->description();
            $this->view('Parent/payment',$data);
        }

        public function AmountPurpose(){
            $session = new \Core\Session;
            $session->set("USERID", 1);
            $input = json_decode(file_get_contents('php://input'), true);
            if (isset($input['total']) && isset($input['purpose'])) {

                $session = new \Core\Session;
                $session->set("total", $input['total']);
                $session->set("purpose", $input['purpose']);

                echo json_encode(['success' => true]);
            } else {
                $session = new \Core\Session;
                $session->unset("total");
                $session->unset("purpose");
                echo json_encode(['success' => false]);
            }
        }

        private function description() {
            $session = new \Core\Session;
            $session->set("USERID", 1);
            $ExpensesModal = new \Modal\Expense;
            $Childhelper = new ChildHelper();
            $children = $Childhelper->store_child();
        
            $groupedExpenses = [];
        
            foreach ($children as $child) {
                $AllExpenses = $ExpensesModal->where_order_desc(
                    ["ChildID" => $child->ChildID], [], "Date"
                );
        
                if(!empty($AllExpenses)){
                    foreach ($AllExpenses as $expense) {
                        $monthYear = date('F Y', strtotime($expense->Date));
                        $desc = $expense->Description; // keep as-is, you want it untouched
            
                        // Initialize month block if not set
                        if (!isset($groupedExpenses[$monthYear])) {
                            $groupedExpenses[$monthYear] = [
                                'Meal' => 0,
                                'Activity' => 0,
                                'Reservations' => 0,
                                'Package' => 0
                            ];
                        }
            
                        // Accumulate only if category exists in structure
                        if (array_key_exists($desc, $groupedExpenses[$monthYear])) {
                            $groupedExpenses[$monthYear][$desc] += $expense->Amount;
                        }
                    }
                }
            }
            return $groupedExpenses;
        }        

        public function graph() {
            $session = new \Core\Session;
            $session->set("USERID", 1);
            $FeesModal = new \Modal\Fees;
            $Childhelper = new ChildHelper();
        
            $children = $Childhelper->store_child();
            $childPayments = []; // This will store all payments

            foreach ($children as $child) {
                $Day = new DateTime();
                $Day->modify('first day of last month'); // Start from the previous month
                
                for ($i = 0; $i < 3; $i++) { // Loop for the last 3 months
                    $lastDayOfMonth = clone $Day;
                    $lastDayOfMonth->modify('last day of this month');
                    $formattedDate = $lastDayOfMonth->format('Y-m-d');
        
                    // Fetch payments for the current child and month
                    $payments = $FeesModal->where_norder([
                        'ChildID' => $child->ChildID,
                        'DueDate' => $formattedDate
                    ]);
        
                    // Store in array
                    $childPayments[$child->First_Name][$formattedDate] = $payments;
                    $Day->modify('-1 month');
                }
            }
        
            // Convert to Chart.js format
            $chartData = [
                'labels' => [], // To store months
                'datasets' => [] // To store children's data
            ];
        
            if (!empty($childPayments)) {
                // Get all unique months
                $months = [];
                foreach ($childPayments as $childName => $monthsData) {
                    foreach ($monthsData as $month => $payments) {
                        if (!in_array($month, $months)) {
                            $months[] = $month;
                        }
                    }
                }
        
                // Sort months in ascending order
                sort($months);
                $chartData['labels'] = array_map(function ($month) {
                    return date('F', strtotime($month)); // Convert "YYYY-MM-01" to "January"
                }, $months);
        
                // Generate datasets dynamically
                $colors = [
                    'rgba(255, 99, 132, 0.6)',  // Red
                    'rgba(54, 162, 235, 0.6)',  // Blue
                    'rgba(255, 206, 86, 0.6)',  // Yellow
                    'rgba(75, 192, 192, 0.6)',  // Teal
                    'rgba(153, 102, 255, 0.6)'  // Purple
                ];
        
                $i = 0;
                foreach ($childPayments as $childName => $monthsData) {
                    $childData = [];
        
                    foreach ($months as $month) {
                        $amount = 0;
                        if (!empty($monthsData[$month])) {
                            foreach ($monthsData[$month] as $payment) {
                                $amount += $payment->Amount; // Sum all payments for the month
                            }
                        }
                        $childData[] = $amount;
                    }
        
                    $chartData['datasets'][] = [
                        'label' => $childName,
                        'data' => $childData,
                        'backgroundColor' => $colors[$i % count($colors)],
                        'borderColor' => str_replace('0.6', '1', $colors[$i % count($colors)]),
                        'borderWidth' => 1
                    ];
        
                    $i++;
                }
            }
        
            return (json_encode($chartData));
        }        

        private function store_states(){
            $session = new \Core\Session;
            $session->set("USERID", 1);
            $data = [];
            $FeesModal = new \Modal\Fees;
            $Childhelper = new ChildHelper();
            $children = $Childhelper->store_child();

            foreach ($children as $child){
                $childPayments = $FeesModal->where_order_desc(["ChildID" => $child->ChildID, "Status" => "Unpaid"], [], "DueDate");

                $Amount = 0;
                $DueDate = null;
        
                if(!empty($childPayments)){
                    foreach ($childPayments as $payment) {
                        $Amount += $payment->Amount;
                    }
    
                    $data['Due']['Date'] = date('Y-m-d', strtotime($childPayments[0]->DueDate));
                    if(isset($data['Due']['Amount'])){
                        $data['Due']['Amount'] += $payment->Amount;
                    }else{
                        $data['Due']['Amount'] = $payment->Amount;
                    }            
                }
                
                $LastBill = $FeesModal->where_order_desc(["ChildID" => $child->ChildID], [], "DueDate");
                if (!empty($LastBill)) {
                    if (!isset($data['LastBill']['Amount'])) {
                        $data['LastBill']['Amount'] = $LastBill[0]->Amount;
                    } else {
                        $data['LastBill']['Amount'] += $LastBill[0]->Amount;
                    }
                }
    
                $ExpensesModal = new \Modal\Expense;
                $firstDayOfMonth = date('Y-m-01');
                $childExpenses = $ExpensesModal->where_order_desc(["ChildID" => $child->ChildID, "Date" => $firstDayOfMonth ], [], "Date");
                if($childExpenses){
                    $Amount = 0;
                    foreach ($childExpenses as $expense) {
                        $Amount += $expense->Amount;
                    }
                    if (!isset($data['Expenses']['Amount'])) {
                        $data['Expenses']['Amount'] = $Amount;
                    } else {
                        $data['Expenses']['Amount'] += $Amount;
                    }
                    $data['Expenses']['Date'] = date('Y-m-d', strtotime($firstDayOfMonth));
                }
            }

            return $data;
        }

        public  function store_history(){
            $session = new \Core\Session;
            $session->set("USERID", 1);
            header('Content-Type: application/json');
            $requestData = json_decode(file_get_contents("php://input"), true);
        
            $date = $requestData['date'];
            if ($date === null) {
                $date = null;
            }
        
            $childname = $requestData['child'];
            if ($childname === null || $childname === 'All' ) {
                $childname = 'All';
            }
    
            $mode = $requestData['mode'];
            if ($mode === null || $mode === 'All') {
                $mode = 'All';
            }

            $data = [];
            $PaymentsModal = new \Modal\Payment;

            $ChildHelper = new ChildHelper();
            $children = $ChildHelper->store_child();

            $Payments = [];

            foreach ($children as $child) {
                if ($childname !== 'All' && $child->First_Name !== $childname) {
                    continue; // Skip if the child's First_Name doesn't match
                }

                $childPayments = $PaymentsModal->where_order_desc(["ChildID" => $child->ChildID], [], "DateTime");
                foreach ($childPayments as $pay){
                    $pay->ChildName = $child->First_Name;
                    $dateTime = new \DateTime($pay->DateTime);
                    $pay->Date = $dateTime->format('Y-m-d');
                    $pay->Time = $dateTime->format('H:i:s');

                    if ($date !== null && $pay->Date !== $date) {
                        continue; // Skip if the date does not match
                    }
        
                    // Apply the status filter
                    if ($mode !== 'All' && $pay->Mode !== $mode) {
                        continue; // Skip if the status does not match
                    }

                    $Payments[] = $pay;
                }
            }
            if (empty($Payments)){
                echo json_encode(['success' => false, 'message' => 'No reservations found for the selected filters']);
            } else {
                echo json_encode(['success' => true, 'data' => $Payments]);
            }
        }

        public function setchildsession(){
            $session = new \Core\Session;
            $session->set("USERID", 1);
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            header('Content-Type: application/json');
            $request = json_decode(file_get_contents('php://input'), true);
            $response = [];
        
            $session = new \Core\Session;
            if (isset($request['ChildID'])) {
                $session->set('CHILDID', $request['ChildID']);
                $response = ['success' => true, 'message' => 'Child session removed.'];
            } else {
                $response = ['success' => false, 'message' => 'No child session to remove.'];
            }
    
            echo json_encode($response);
            exit();
        }

        public function Logout(){
            $session = new \Core\Session;
            $session->set("USERID", 1);
            $session = new \core\Session();
            $session->logout();

            echo json_encode(["success" => true]);
            exit;
        }
    }
?>