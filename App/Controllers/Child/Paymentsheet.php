<?php

    namespace Controller;

    defined('ROOTPATH') or exit('Access denied');

    class PaymentSheet{
        use MainController;
        public function index(){
            $session = new \Core\Session;
            $session->check_login();

            if(isset($_GET['ChildID'])){
                $ChildID = $_GET['ChildID'];
            }
            else{
                $ChildID = $session->get("CHILDID");
            }

            $data = $this->selectedchild($ChildID);

            $month = isset($_GET['month']) ? $_GET['month'] : null;
            $year = isset($_GET['year']) ? $_GET['year'] : null;
            $data['CostBreakdown'] = $this->CostBreakdown($month, $year, $ChildID);
            $data['Expenses'] = $this->description($month, $year, $ChildID);
            $this->view('Child/PaymentSheet', $data);
        }

        private function selectedchild($ChildID){
            $data = [];
            $ChildModal = new \Modal\Child;
            $selectedchild = $ChildModal->first(["ChildID" => $ChildID]);

            $imageData = $selectedchild->Image;
            $imageType = $selectedchild->ImageType;  // Get the image MIME type from the database

            // If image data is available, construct the Base64 string using the correct MIME type
            $base64Image = (!empty($imageData) && is_string($imageData))
                ? 'data:' . $imageType . ';base64,' . base64_encode($imageData)
                : null;

            $data['selectedchildren'] = [
                'fullname' => $selectedchild->First_Name . ' ' . $selectedchild->Last_Name,
                'name' => $selectedchild->First_Name,
                'image' => $base64Image,
                'age' => agecalculate($selectedchild->DOB),
                'language' => $selectedchild->Language,
                'religion' => $selectedchild->Religion,
                'id' => str_pad($selectedchild->ChildID, 5, '0', STR_PAD_LEFT),
            ];

            return $data;
        }

        private function CostBreakdown($month, $year, $ChildID) {
        
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
        
            $Attendance = $AttendanceModal->findFutureDatesWithConditions($firstdate, $lastdate, ["ChildID"=>$ChildID] ,"Start_Date");
            $Child = $ChildModal->first(["ChildID"=> $ChildID]);
            $AgeGroup = $ChildHelper->getAgeGroup($Child->DOB);
            $Package = $PackageModal->first(["PackageID" => $Child->PackageID]);

            $CostBreakdown = [];

            if(!empty($Package)){
                $CostBreakdown[] = [
                    'reason' => 'Monthly package fee',
                    'date' => $firstdate,
                    'amount' => $Package->Price
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
                                'amount' => 5000
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
                            'amount' => $amountPerDay
                        ];
                    } else {
                        // Fallback if no alternative package found
                        $CostBreakdown[] = [
                            'reason' => "Daily charge - $dayOfWeek",
                            'date' => $startDate,
                            'amount' => 2000
                        ];
                    }
                }
            }

            $Reservation = $ReservationsModal->findFutureDatesWithConditions($firstdate, $lastdate, ["ChildID" => $ChildID]);

            if(!empty($Reservation)){
                foreach ($Reservation as $Res){
                    $DidAttend = $AttendanceModal->first(["ChildID" => $ChildID, "Start_Date"=> $Res->Date]);
                    if(empty($DidAttend)){
                        if($Res->Is_24_Hour){
                            $CostBreakdown[] = [
                                'reason' => "Did not showup for full day reservation",
                                'date' => $Res->Start_Date ?? '2025-04-27',
                                'amount' => 1000,
                                'Fine' => 1
                            ];
                        }
                        else{
                            $CostBreakdown[] = [
                                'reason' => "Did not showup for reservation",
                                'date' => $Res->Date ?? '2025-04-27',
                                'amount' => 500,
                                'Fine' => 1
                            ];
                        }
                    }
                    else{
                        if($Res->Is_24_Hour && $DidAttend->Start_Date == $DidAttend->End_Date){
                            $CostBreakdown[] = [
                                'reason' => "Partial attendance",
                                'date' => $Res->Date ?? '2025-04-27',
                                'amount' => 200,
                                'Fine' => 1
                            ];
                            }
                        else if($Res->Is_24_Hour == 0 && $DidAttend->Start_Date != $DidAttend->End_Date){
                            $CostBreakdown[] = [
                                'reason' => "Uninformed full-day stay fine",
                                'date' => $Res->Date ?? '2025-04-27',
                                'amount' => 500,
                                'Fine' => 1
                            ];
                        }
                    }
                }
            }

            $Snacks = $SnackRequestModal->findFutureDatesWithConditions($firstdate, $lastdate, ["ChildID" => $ChildID]);
            if(!empty($Snacks)){
                foreach($Snacks as $sna){
                    if($sna->Provide){
                        $CostBreakdown[] = [
                            'reason' => "Snack provided",
                            'date' => $sna->Date,
                            'amount' => 150*$sna->Quantity
                        ];
                    }
                }
            }

            $Events = $EventEnrollModal->findFutureDatesWithConditions($firstdate, $lastdate, ["ChildID" => $ChildID]);
            if(!empty($Events)){
                foreach($Events as $Event){
                    $EventDetails = $EventModal->first(["EventID" => $Event->EventID]);
                    $CostBreakdown[] = [
                        'reason' => "$EventDetails->EventName fee",
                        'date' => $EventDetails->Date,
                        'amount' => $EventDetails->Fee
                    ];
                }
            }
        
            return $CostBreakdown;
        }                  

        private function description($month, $year, $ChildID) {
            
            $ExpensesModal = new \Modal\Expense;
            $Day = sprintf("%s-%02d-01", $year, $month);
            
            // Fetch only records from the current month and year
            $AllExpenses = $ExpensesModal->where_order_desc(
                ["ChildID" => $ChildID, "Date" => $Day],
                [],
                "Date"
            );
            
            $Total = 0;
            foreach ($AllExpenses as $expense) {
            
                // Initialize if not already
                if (!isset($groupedExpenses)) {
                    $groupedExpenses = [
                        'Meal' => 0,
                        'Activity' => 0,
                        'Reservations' => 0,
                        'Package' => 0,
                        'Total' => 0
                    ];
                }
            
                $desc = $expense->Description;
                if (isset($groupedExpenses[$desc])) {
                    $groupedExpenses[$desc] += $expense->Amount;
                }

                $Total = $Total + $expense->Amount;
            }
            
            $groupedExpenses['Total'] = $Total;
            return $groupedExpenses;
        }
    }
?>