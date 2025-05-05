<?php

    namespace Controller;

    use App\Helpers\SidebarHelper;
    use App\Helpers\ChildHelper;

    defined('ROOTPATH') or exit('Access denied');

    class Reservation{
        use MainController;
        public function index(){

            $session = new \Core\Session;
            $session->set("USERID", 1);
            $session = new \Core\Session;
            $session->check_login();

            $data = [];
            $SidebarHelper = new SidebarHelper();
            $data = $SidebarHelper->store_sidebar();

            $data = $data + $this->set_stats();

            $data2['dates'] = $this->set_dates();
            $data = $data + $data2;

            $data2 = $this->makereservation();
            if(!empty($data2)){
                $data = $data + $data2; 
            }

            $ChildHelper = new ChildHelper();
            $data['Child_Count'] = $ChildHelper->child_count();
            $session->set("Location" , 'Parent/Event');

            $this->view('Parent/reservation', $data);
        }

        public function store_reservations() {
            $session = new \Core\Session;
            $session->set("USERID", 1);
            header('Content-Type: application/json');
            $requestData = json_decode(file_get_contents("php://input"), true);
        
            $date = $requestData['date'];
            if ($date === null) {
                $date = null;
            }
        
            $child = $requestData['child'];
            if ($child === null || $child === 'All' ) {
                $child = 'All';
            }
    
            $status = $requestData['status'];
            if ($status === null || $status === 'All') {
                $status = 'All';
            }
        
            $ChildHelper = new ChildHelper();
            $children = $ChildHelper->store_child();
        
            $res = new \Modal\Reservation;
            $reservations = [];  // Initialize this outside of the loop
        
            // Loop through all children
            foreach ($children as $childItem) {
                // Apply the child filter (skip child filter if it's 'All')
                if ($child !== 'All' && $childItem->First_Name !== $child) {
                    continue; // Skip if the child's First_Name doesn't match
                }
        
                // Get all reservations for this child
                $childReservations = $res->where_norder(['ChildID' => $childItem->ChildID]);
        
                // Loop through each reservation for the child
                if(!empty($childReservations)){
                    foreach ($childReservations as $reservation) {
                        // Apply the date filter
                        if ($date !== null && $reservation->Date !== $date) {
                            continue; // Skip if the date does not match
                        }
            
                        // Apply the status filter
                        if ($status !== 'All' && $reservation->Status !== $status) {
                            continue; // Skip if the status does not match
                        }
            
                        // Attach the child's name to the reservation
                        $reservation->First_Name = $childItem->First_Name;
            
                        // Add this reservation to the list
                        $reservations[] = $reservation;
                    }
                }
            }
        
            // Define "yesterday" for categorization
            $yesterday = new \DateTime('yesterday');
        
            // Prepare the data array with separate upcoming and history
            $data = [
                'upcoming' => [],
                'history' => [],
            ];
        
            // Categorize reservations into 'upcoming' and 'history'
            foreach ($reservations as $reservation) {
                $reservationDate = new \DateTime($reservation->Date);
        
                if ($reservationDate > $yesterday) {
                    $data['upcoming'][] = $reservation; // Add to upcoming
                } else {
                    // Auto-cancel expired pending reservations
                    if ($reservation->Status === 'Pending') {
                        $res->update(['ResID' => $reservation->ResID], ['Status' => 'Canceled']);
                    }
                    $data['history'][] = $reservation; // Add to history
                }
            }
        
            // Sort the reservations
            usort($data['upcoming'], function ($a, $b) {
                $dateA = new \DateTime($a->Date);
                $dateB = new \DateTime($b->Date);
                return $dateA <=> $dateB; // Ascending order
            });
        
            usort($data['history'], function ($a, $b) {
                $dateA = new \DateTime($a->Date);
                $dateB = new \DateTime($b->Date);
                return $dateB <=> $dateA; // Descending order
            });
        
            if (empty($data)){
                echo json_encode(['success' => false, 'message' => 'No reservations found for the selected filters']);
            } else {
                echo json_encode(['success' => true, 'data' => $data]);
            }
        }

        private function makereservation() 
        {

            $session = new \Core\Session;
            $session->set("USERID", 1);
            $ChildHelper = new ChildHelper();
            $children = $ChildHelper->store_child();

            $requiredFields = ['Date', 'Start_Time', 'End_Time'];
            
            // Initialize an array to hold the form values
            $data['values']['Date'] = $_POST['Date'] ?? '';
            $data['values']['Start_Time'] = $_POST['Start_Time'] ?? '';
            $data['values']['End_Time'] = $_POST['End_Time'] ?? '';
            $data['values']['Notes'] = $_POST['Notes'] ?? '';
            
            // Check if all required fields are filled in
            if (checkRequiredFields($requiredFields, $_POST) && isset($_POST['makereservation']) && $_POST['makereservation'] == 'new-reservation') {
                
                // Validate Date - must be after today + 2 days
                $today = new \DateTime();
                $today->modify('+2 days');
                $date = new \DateTime($_POST['Date']);
                
                if ($date < $today) {
                    $data['errors']['Date'] = 'Not a valid date';
                    $data['values']['Date'] = '';
                    $data['displayModal'] = true;
                    $data['Entered'] = true;
                }
                
                // Validate Start Time - must be between 8:00 AM and 8:00 PM
                $startTime = $_POST['Start_Time'];
                if ($startTime < '08:00' || $startTime > '20:00') {
                    $data['errors']['Start_Time'] = 'Not a valid time';
                    $data['values']['Start_Time'] = '';
                    $data['displayModal'] = true;
                    $data['Entered'] = true;
                }
                
                // Validate End Time - must be between 8:00 AM and 8:00 PM, and after the start time
                $endTime = $_POST['End_Time'];
                if ($endTime < '08:00' || $endTime > '20:00') {
                    $data['errors']['End_Time'] = 'Not a valid time';
                    $data['values']['End_Time'] = '';
                    $data['displayModal'] = true;
                    $data['Entered'] = true;
                }
        
                // Check 4-hour minimum difference between Start and End Time
                $startTimeObj = new \DateTime($startTime);
                $endTimeObj = new \DateTime($endTime);
                $minEndTime = (clone $startTimeObj)->modify('+4 hours'); // Minimum End Time, 4 hours after Start Time
                
                if ($endTimeObj < $minEndTime) {
                    // If the end time is too early, set it to the minimum allowed end time
                    $data['errors']['Time'] = 'End time must be at least 4 hours after start time.';
                    $data['values']['End_Time'] = $minEndTime->format('H:i'); // Set end time to 4 hours after start
                    $endTimeObj = $minEndTime;
                    $data['displayModal'] = true;
                    $data['Entered'] = true;
                }
        
                // Check if Start Time is within allowable range for an End Time of 8:00 PM
                if ($endTime == '20:00' && $startTime > '16:00') {
                    $data['errors']['Start_Time'] = 'With an 8:00 PM end time, the latest start time allowed is 4:00 PM.';
                    $data['values']['Start_Time'] = '16:00'; // Automatically adjust start time to the latest allowed
                    $startTimeObj = new \DateTime('16:00');
                    $data['displayModal'] = true;
                    $data['Entered'] = true;
                }
                
                // Final validation before saving
                if (!empty($data['errors'])) {
                    return $data;
                }
        
                // Proceed with saving if no errors
                $_POST['Start_Time'] = $startTimeObj->format('H:i');
                $_POST['End_Time'] = $endTimeObj->format('H:i');
                
                $res = new \Modal\Reservation;
                $_SESSION['success'] = true;
                foreach($children as $child){
                    $_POST['Child_Id'] = $child->Child_Id;
                    show($_POST);
                    $res->insert($_POST);
                }
                $data['displayModal'] = false;
                redirect('Parent\Reservation');
            
            } else {
                $data['errors'] = 'Please fill in all required fields.';
                return $data;
            }
        }             

        private function set_dates(){
            $session = new \Core\Session;
            $session->set("USERID", 1);
            $today = new \DateTime();
            // Start from the day after tomorrow
            $today->modify('+2 days');
        
            // Generate the next 7 days
            $dates = [];
            for ($i = 0; $i < 7; $i++) {
                $dates[] = [
                    'dayName' => $today->format('D'),  // Day of the week (e.g., Mon, Tue)
                    'day' => $today->format('d')       // Day of the month (e.g., 14)
                ];
                $today->modify('+1 day'); // Move to the next day
            }
        
            return $dates;  // Return the dates array
        }

        private function set_stats() {
            $session = new \Core\Session;
            $session->set("USERID", 1);
            $ChildHelper = new ChildHelper();
            $children = $ChildHelper->store_child();
        
            $res = new \Modal\Reservation;
            $reservations = [];
        
            // Collect reservations for all children
            foreach ($children as $child) {
                $childReservations = $res->where_norder(['ChildID' => $child->ChildID]);
        
                // Merge child reservations into the main array if not empty
                if (!empty($childReservations)) {
                    $reservations = array_merge($reservations, $childReservations);
                }
            }
        
            // Define "yesterday" as a DateTime object
            $yesterday = new \DateTime('yesterday');
        
            // Filter reservations to keep only upcoming ones
            $upcomingReservations = array_filter($reservations, function ($reservation) use ($yesterday) {
                $reservationDate = new \DateTime($reservation->Date);
                return $reservationDate > $yesterday; // Only include upcoming reservations
            });
        
            // Initialize statistics
            $data = [
                'Approved' => 0,
                'Pending' => 0,
                'Canceled' => 0,
            ];
        
            // Calculate statistics for upcoming reservations
            foreach ($upcomingReservations as $reservation) {
                if ($reservation->Status === "Approved") {
                    $data['Approved'] += 1;
                } elseif ($reservation->Status === "Pending") {
                    $data['Pending'] += 1;
                } elseif ($reservation->Status === "Canceled") {
                    $data['Canceled'] += 1;
                }
            }
        
            return $data;
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

        public function RemoveReservation() {
            $session = new \Core\Session;
            $session->set("USERID", 1);
            header('Content-Type: application/json');
        
            $response = [];
        
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Check if Res_Id is provided
                if (isset($_POST['Res_Id'])) {
                    $Res_Id = $_POST['Res_Id'];
                    
                    $reservation = new \Modal\Reservation;
                    $res = $reservation->delete($Res_Id, "Res_Id");
                    $isDeleted = true;
        
                    if ($isDeleted) {
                        $response = [
                            'success' => true,
                            'message' => "Reservation ID $Res_Id deleted successfully"
                        ];
                    } else {
                        $response = [
                            'success' => false,
                            'message' => "Failed to delete Reservation ID $Res_Id"
                        ];
                    }
                } else {
                    $response = [
                        'success' => false,
                        'message' => "Reservation ID not provided"
                    ];
                }
            } else {
                $response = [
                    'success' => false,
                    'message' => "Invalid request method"
                ];
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