<?php

namespace Controller;


use App\Helpers\SidebarHelper;
use App\Helpers\ChildHelper;

defined('ROOTPATH') or exit('Access denied');

class Event
{
    use MainController;
    public function index(){

        $session = new \Core\Session;
         
        $session = new \Core\Session;
        $session->check_login();

        $data = [];
        $SidebarHelper = new SidebarHelper();
        $data = $SidebarHelper->store_sidebar();

        $data = $data + $this->store_Stats();
        
        $ChildHelper = new ChildHelper();
        $data['Child_Count'] = $ChildHelper->child_count();
        $session->set("Location" , 'Parent/Event');

        $this->view('Parent/event', $data);
    }

    private function store($children, $pre)
    {
        $session = new \Core\Session;
         
        $data = [];
        $imageData = $pre->Image;
        $imageType = $pre->ImageType;  // Get the image MIME type from the database

        // If image data is available, construct the Base64 string using the correct MIME type
        $base64Image = (!empty($imageData) && is_string($imageData))
            ? 'data:' . $imageType . ';base64,' . base64_encode($imageData)
            : null;

        $data['parent'] = [
            'fullname' => $pre->First_Name . ' ' . $pre->Last_Name,
            'childcount' => count($children),
            'lastseen' => $pre->Last_Seen,
            'firstname' => $pre->First_Name,
            'lastname' => $pre->Last_Name,
            'lastseen' => lastSeen($pre->Last_Seen),
            'image' => $base64Image
        ];

        // Retrieve each child's profile image and store by index
        foreach ($children as $index => $child) {
            $fullName = $child->First_Name . " " . $child->Last_Name;

            $imageData = $child->Image;
            $imageType = $child->ImageType;
            $base64Image = (!empty($imageData) && is_string($imageData))
                ? 'data:image/jpeg;base64,' . base64_encode($imageData)
                : null;

            $data['children'][$index] = [
                'Id' => $child->ChildID,
                'name' => $child->First_Name,
                'fullname' => $fullName,
                'image' => $base64Image,
            ];
        }
        return $data;
    }

    private function store_Stats(){
        $session = new \Core\Session;
         
        $ChildHelper = new ChildHelper();
        $children = $ChildHelper->store_child();

        $upcomingEvent = null;
        $enrolledEvents = 0;
        $newEvent = null; // Store the most recent event
        $EventModal = new \Modal\Event;
        $Enrollment = new \Modal\EventEnrollment;

        // Loop through each child to calculate stats
        foreach ($children as $child) {
            $childEnrollments = $Enrollment->where_norder(['ChildID' => $child->ChildID]);

            // Loop through each event the child is enrolled in
            if(!empty($childEnrollments)){
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
            'Image' => $base64Image, // This will be the Base64 string representation of the image
        
        ]: null;


        return $stats;
    }

    public function lol(){
        $session = new \Core\Session;
         
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

    public function store_data() {
        $session = new \Core\Session;
         
        header('Content-Type: application/json');
    
        // Parse incoming JSON request
        $requestData = json_decode(file_get_contents("php://input"), true);
        $filterDate = isset($requestData['date']) ? new \DateTime($requestData['date']) : null;
        $filterStatus = $requestData['status'] ?? null;
        $filtersChild = $requestData['child'] ?? null;
    
        $session = new \Core\Session;
        $UserID = $session->get('USERID');
    
        $parent = new \Modal\ParentUser;
        $pre = $parent->first(['UserID' => $UserID]);
        $ParentID = $pre->ParentID;
    
        $child = new \Modal\Child;
        $children = $child->where_norder(['ParentID' => $ParentID]);
    
        $Enrollment = new \Modal\EventEnrollment;
        $EventModal = new \Modal\Event;
    
        $data = [];
        foreach ($children as $childRow) {
            $EventEnrollments = $Enrollment->where_norder(["ChildID" => $childRow->ChildID]);
            if (!empty($EventEnrollments)){
                foreach ($EventEnrollments as $enrollment) {
                    $enrollment->ChildName = $childRow->First_Name;
                    $enrollment->ChildID = $childRow->ChildID; // Add ChildID for filtering
                    $data[] = $enrollment;
                }
            }
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
    
        if ($filtersChild && $filtersChild !== 'NULL') {
            $data = array_filter($data, function ($row) use ($filtersChild) {
                return $row->ChildName == $filtersChild;
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
    
    public function setchildsession()
    {
        $session = new \Core\Session;
         
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
         
        $session = new \core\Session();
        $session->logout();

        echo json_encode(["success" => true]);
        exit;
    }
}
