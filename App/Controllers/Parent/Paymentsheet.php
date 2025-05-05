<?php

    namespace Controller;
    use App\Helpers\ChildHelper;
    use App\Helpers\SidebarHelper;

    defined('ROOTPATH') or exit('Access denied');

    class PaymentSheet{
        use MainController;
        public function index(){
            $session = new \Core\Session;
            $session->set("USERID", 1);
            $session = new \Core\Session;
            $session->check_login();
            $SidebarHelper = new SidebarHelper;
            $data = $SidebarHelper->store_sidebar();

            $month = isset($_GET['month']) ? $_GET['month'] : null;
            $year = isset($_GET['year']) ? $_GET['year'] : null;
            if ($month && $year) {
                $dateObj = \DateTime::createFromFormat('!m', $month);
                $monthName = $dateObj->format('F');
                $date = $monthName . ' ' . $year;
            }
            $data['CostBreakdown'] = $this->CostBreakdown($month, $year);
            $data['Expenses'] = $this->description($month, $year);
            $data['Parent'] = $SidebarHelper->store_sidebar()['parent'];
            $data['Parent']['month'] = $date;

            $this->view('Parent/PaymentSheet',$data);
        }

        private function description($month, $year) {
            $session = new \Core\Session;
            $session->set("USERID", 1);
            $groupedExpenses = [];
            
            $ChildHelper = new ChildHelper;
            $children = $ChildHelper->store_child();
            $FinalTotal = 0;
            foreach ($children as $child){

                $base64Image = '';
                $imageData = $child->Image;
                $imageType = $child->ImageType;
                $base64Image = (!empty($imageData) && is_string($imageData)) 
                    ? 'data:image/jpeg;base64,' . base64_encode($imageData) 
                    : null
                ;

                $ExpensesModal = new \Modal\Expense;
                $Day = sprintf("%s-%02d-01", $year, $month);
                
                // Fetch only records from the current month and year
                $AllExpenses = $ExpensesModal->where_order_desc(
                    ["ChildID" => $child->ChildID, "Date" => $Day],
                    [],
                    "Date"
                );
                
                $Total = 0;
                foreach ($AllExpenses as $expense) {
                
                    // Initialize if not already
                    if (!isset($groupedExpenses[$child->First_Name])) {
                        $groupedExpenses[$child->First_Name] = [
                            'Name' => $child->First_Name,
                            'Image' => $base64Image,
                            'ChildID' => $child->ChildID,
                            'Meal' => 0,
                            'Activity' => 0,
                            'Reservations' => 0,
                            'Package' => 0,
                            'Total' => 0
                        ];
                    }
                
                    $desc = $expense->Description;
                    if (isset($groupedExpenses[$child->First_Name][$desc])) {
                        $groupedExpenses[$child->First_Name][$desc] += $expense->Amount;
                    }

                    $Total = $Total + $expense->Amount;
                }
                $groupedExpenses[$child->First_Name]['Total'] = $Total;
                $FinalTotal += $Total;
            }
            $groupedExpenses['Total'] = $FinalTotal;
            return $groupedExpenses;
        }

        private function CostBreakdown($month, $year) {
            $session = new \Core\Session;
            $session->set("USERID", 1);
            $ChildHelper = new ChildHelper;
            $children = $ChildHelper->store_child();
            $CostBreakdown = [];

            foreach ($children as $child){
                
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
                    $CostBreakdown[] = [
                        'reason' => 'Monthly package fee',
                        'date' => $firstdate,
                        'amount' => $Package->Price,
                        'name' => $child->First_Name
                    ];
                }

                $validDays = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
                $allowedDays = json_decode($Package->allowed_days ?? '[]');
            
                if(!empty($Attendance)){
                    foreach ($Attendance as $post) {
                        $startDate = date('Y-m-d', strtotime($post->Start_Date));
                        $endDate = date('Y-m-d', strtotime($post->End_Date));
                        $dayOfWeek = date('l', strtotime($startDate));
                
                        // Handle 24-hour reservation
                        if ($startDate !== $endDate) {
                            if (!$Package->AllHours) {
                                $CostBreakdown[] = [
                                    'reason' => '24-hour reservation fee',
                                    'date' => $startDate,
                                    'amount' => 5000,
                                    'name' => $child->First_Name
                                ];
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
                
                            $CostBreakdown[] = [
                                'reason' => "Daily charge - $dayOfWeek",
                                'date' => $startDate,
                                'amount' => $amountPerDay,
                                'name' => $child->First_Name
                            ];
                        } else {
                            // Fallback if no alternative package found
                            $CostBreakdown[] = [
                                'reason' => "Daily charge - $dayOfWeek",
                                'date' => $startDate,
                                'amount' => 2000,
                                'name' => $child->First_Name
                            ];
                        }
                    }
                }

                $Reservation = $ReservationsModal->findFutureDatesWithConditions($firstdate, $lastdate, ["ChildID" => $child->ChildID]);

                if(!empty($Reservation)){
                    foreach ($Reservation as $Res){
                        $DidAttend = $AttendanceModal->first(["ChildID" => $child->ChildID, "Start_Date"=> $Res->Date]);
                        if(empty($DidAttend)){
                            if($Res->Is_24_Hour){
                                $CostBreakdown[] = [
                                    'reason' => "Did not showup for full day reservation",
                                    'date' => $Res->Start_Date,
                                    'amount' => 1000,
                                    'Fine' => 1,
                                    'name' => $child->First_Name
                                ];
                            }
                            else{
                                $CostBreakdown[] = [
                                    'reason' => "Did not showup for reservation",
                                    'date' => $Res->Date,
                                    'amount' => 500,
                                    'Fine' => 1,
                                    'name' => $child->First_Name
                                ];
                            }
                        }
                        else{
                            if($Res->Is_24_Hour && $DidAttend->Start_Date == $DidAttend->End_Date){
                                $CostBreakdown[] = [
                                    'reason' => "Partial attendance",
                                    'date' => $Res->Date,
                                    'amount' => 200,
                                    'Fine' => 1,
                                    'name' => $child->First_Name
                                ];
                                }
                            else if($Res->Is_24_Hour == 0 && $DidAttend->Start_Date != $DidAttend->End_Date){
                                $CostBreakdown[] = [
                                    'reason' => "Uninformed full-day stay fine",
                                    'date' => $Res->Date,
                                    'amount' => 500,
                                    'Fine' => 1,
                                    'name' => $child->First_Name
                                ];
                            }
                        }
                    }
                }

                $Snacks = $SnackRequestModal->findFutureDatesWithConditions($firstdate, $lastdate, ["ChildID" => $child->ChildID]);
                if(!empty($Snacks)){
                    foreach($Snacks as $sna){
                        if($sna->Provide){
                            $CostBreakdown[] = [
                                'reason' => "Snack provided",
                                'date' => $sna->Date,
                                'amount' => 150*$sna->Quantity,
                                'name' => $child->First_Name
                            ];
                        }
                    }
                }

                $Events = $EventEnrollModal->findFutureDatesWithConditions($firstdate, $lastdate, ["ChildID" => $child->ChildID]);
                if(!empty($Events)){
                    foreach($Events as $Event){
                        $EventDetails = $EventModal->first(["EventID" => $Event->EventID]);
                        $CostBreakdown[] = [
                            'reason' => "$EventDetails->EventName fee",
                            'date' => $EventDetails->Date,
                            'amount' => $EventDetails->Fee,
                            'name' => $child->First_Name
                        ];
                    }
                }
            }
            return $CostBreakdown;
        }                  

    }
?>