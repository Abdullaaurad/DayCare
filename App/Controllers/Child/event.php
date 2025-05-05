<?php

    namespace Controller;
    use App\Helpers\SidebarHelper;

    defined('ROOTPATH') or exit('Access denied');

    class Event{
        use MainController;
        public function index(){
            $session = new \Core\Session;
            $session->set("USERID", 1);

            $session = new \Core\Session;
            $session->check_login();
            $session->check_child();
            $ChildID = $session->get("CHILDID");

            $data = [];
            $SidebarHelper = new SidebarHelper();
            $data = $SidebarHelper->store_sidebar();

            $ChildModal = new \Modal\Child;
            $select = $ChildModal->first(['ChildID' => $ChildID ]);
            $data['child_id'] = $ChildID;

            if (!empty($select)) {
                $data2 = $this->selectedchild($select);
                $data = $data + $data2;
            }

            $data = $data + $this->store_Stats();
            $session->set("Location" , 'Child/event');
            $this->view('Child/event', $data);
        }

        private function selectedchild($selectedchild){
            $session = new \Core\Session;
            $session->set("USERID", 1);
            $data = [];

            // Retrieve the specific child's profile image and details

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

        private function store_Stats(){
            $session = new \Core\Session;
            $session->set("USERID", 1);
            $upcomingEvent = null;
            $enrolledEvents = 0;
            $newEvent = null;
            $EventModal = new \Modal\Event;
            $Enrollment = new \Modal\EventEnrollment;
    
            $session = new \core\Session;
            $ChildID = $session->get("CHILDID");

            $childEnrollments = $Enrollment->where_norder(['ChildID' => $ChildID]);

            foreach ($childEnrollments as $enrollment) {
                $event = $EventModal->first(['EventID' => $enrollment->EventID]);
                $eventDate = new \DateTime($event->Date);

                // Count the total events enrolled
                $enrolledEvents++;
    
                    // Check if the event is upcoming and the closest one
                if ($eventDate > new \DateTime()) {
                    if (!$upcomingEvent || $eventDate < new \DateTime($upcomingEvent->Date)) {
                        $upcomingEvent = $event;  // Set the closest upcoming event
                    }
                }
            }
    
            $AllEvents = $EventModal->findall();
            $newEvent = null;
            if (!empty($AllEvents)) {
                $newEvent = array_reduce($AllEvents, function ($carry, $item) {
                    return (!$carry || $item->EventID > $carry->EventID) ? $item : $carry;
                });
            }
    
            $stats = [];
            $stats['stat1'] = [
                'upcomingEvent' => $upcomingEvent ? [
                    'EventName' => $upcomingEvent->EventName,
                    'Date' => $upcomingEvent->Date,
                ] : null,
            ];
            $stats['stat2'] = [
                'enrolledEvents' => $enrolledEvents,
                'eventsMessage' => $enrolledEvents > 0
                    ? "$enrolledEvents events upcoming this month"
                    : "No events upcoming",
            ];
    
            $imageData = $newEvent->Image;
            $imageType = $newEvent->ImageType; // The MIME type of the image (e.g., image/jpeg, image/png)
        
            // Check if image data is available and it's a valid string
            $base64Image = (!empty($imageData) && is_string($imageData)) 
                ? 'data:' . $imageType . ';base64,' . base64_encode($imageData) 
                : null;
    
            $stats['stat3'] = $newEvent ? [
                'EventName' => $newEvent->EventName,
                'Date' => $newEvent->Date,
                'Image' => $base64Image,
            
            ]: null;
    
            return $stats;
        }

        public function store_data() {
            $session = new \Core\Session;
            $session->set("USERID", 1);
            header('Content-Type: application/json');
            $requestData = json_decode(file_get_contents("php://input"), true);
            $filterDate = isset($requestData['date']) ? new \DateTime($requestData['date']) : null;
            $filterStatus = $requestData['status'] ?? null;
        
            $session = new \Core\Session;
            $ChildID = $session->get('CHILDID');

            $ChildModal = new \Modal\Child;
            $Child = $ChildModal->first(['ChildID' => $ChildID]);
        
            $Enrollment = new \Modal\EventEnrollment;
            $EventModal = new \Modal\Event;
        
            $data = [];
            $EventEnrollments = $Enrollment->where_norder(["ChildID" => $ChildID]);
            foreach ($EventEnrollments as $enrollment) {
                $enrollment->ChildName = $Child->First_Name;
                $enrollment->ChildID = $Child->ChildID; // Add ChildID for filtering
                $data[] = $enrollment;
            }
        
            $today = new \DateTime();
            foreach ($data as $row) {
                $Event = $EventModal->first(['EventID' => $row->EventID]);
                $row->EventName = $Event->EventName;
                $row->EventID = $Event->EventID;
                $row->Date = (new \DateTime($Event->Date))->format('Y-m-d');
        
                $eventDate = new \DateTime($Event->Date);
                if ($eventDate == $today) {
                    $row->Status = 'Happening';
                } elseif ($eventDate > $today) {
                    $row->Status = 'Upcoming';
                } else {
                    $row->Status = 'Finished';
                }
            }
        
            // Apply filters
            if ($filterDate) {
                $filterDate = $filterDate->format('Y-m-d'); // Convert to string
                $data = array_filter($data, function ($row) use ($filterDate) {
                    return $row->Date == $filterDate;
                });
            }
        
            if ($filterStatus && $filterStatus !== 'NULL') {
                $data = array_filter($data, function ($row) use ($filterStatus) {
                    return $row->Status == $filterStatus;
                });
            }
        
            // Sort the data
            usort($data, function ($a, $b) use ($today) {
                $statusOrder = ['Happening' => 0, 'Upcoming' => 1, 'Finished' => 2];
                $statusComparison = $statusOrder[$a->Status] <=> $statusOrder[$b->Status];
                if ($statusComparison === 0) {
                    return $a->Date <=> $b->Date;
                }
                return $statusComparison;
            });
        
            if (empty($data)) {
                echo json_encode(['success' => true, 'message' => 'No events found for the selected filters']);
            } else {
                echo json_encode(['success' => true, 'data' => $data]);
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

        public function lol(){
            $session = new \Core\Session;
            $session->set("USERID", 1);
            header('Content-Type: application/json');
    
            // Parse incoming JSON request
            $requestData = json_decode(file_get_contents("php://input"), true);
            $EventID = isset($requestData['EventID']) ? $requestData['EventID'] : null;
    
            if ($EventID) {
                $EventModal = new \Modal\Event;
                $event = $EventModal->first(['EventID' => $EventID]);
    
                if($event->Image != null){
                    $imageData = $event->Image;
                    $imageType = $event->ImageType;
                    $base64Image = (!empty($imageData) && is_string($imageData))
                        ? 'data:image/jpeg;base64,' . base64_encode($imageData)
                        : null;
    
                    $event->Image = $base64Image;
                }
            }
    
            if (empty($event)) {
                echo json_encode(['success' => false, 'message' => 'No events found for the selected filters']);
            } else {
                echo json_encode(['success' => true, 'data' => $event]);
            }
        }
    
        public function leaveEvent(){
            $session = new \Core\Session;
            $session->set("USERID", 1);
            header('Content-Type: application/json');
    
            // Parse incoming JSON request
            $requestData = json_decode(file_get_contents("php://input"), true);
            $EnrollmentID = isset($requestData['EnrollmentID']) ? $requestData['EnrollmentID'] : null;
    
            if ($EnrollmentID) {
                $EventModal = new \Modal\EventEnrollment;
                $event = $EventModal->delete($EnrollmentID, "EnrollmentID");
    
            }
            echo json_encode(['success' => true, 'data' => $event]);
        }

        public function removechildsession(){

            $session = new \Core\Session;
            $session->set("USERID", 1);
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            header('Content-Type: application/json');
            $response = [];

            $session = new \Core\Session;
            $ChildID = $session->get("CHILDID");
            
            if (isset($ChildID)) {
                $session->unset("CHILDID");
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