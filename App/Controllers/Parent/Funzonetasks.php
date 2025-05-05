<?php

    namespace Controller;
    use App\Helpers\SidebarHelper;

    defined('ROOTPATH') or exit('Access denied');

    class FunzoneTasks{
        use MainController;
        public function index(){
            $session = new \Core\Session;
            $session->check_login();
            $session = new \Core\Session;
            $session->set("USERID", 1);

            $data = [];
            $SidebarHelper = new SidebarHelper();
            $data = $SidebarHelper->store_sidebar();

            $this->view('Parent/funzonetasks',$data);
        }

        public function store_tasks() {
            $session = new \Core\Session;
            $session->set("USERID", 1);
            header('Content-Type: application/json');
            $requestData = json_decode(file_get_contents("php://input"), true);
            
            $type = $requestData['type'] ?? 'All';
        
            $Session = new \core\session;
            $ChildModal = new \Modal\Child;
            $ParentModal = new \Modal\ParentUser;
            $CompletionModal = new \Modal\TaskCompletion;
            $MediaModal = new \Modal\Media;
            $TaskModal = new \Modal\Task;
            $TeacherModal = new \Modal\Teacher;
        
            $today = new \DateTime();
        
            // Get the logged-in User's ID
            $UserID = $Session->get("USERID");
        
            // Find the Parent of the logged-in Child
            $Parent = $ParentModal->first(["UserID" => $UserID]);
        
            // Fetch all children under this Parent
            $Children = $ChildModal->where_norder(["ParentID" => $Parent->ParentID]);
        
            $TaskList = [];
        
            foreach ($Children as $Child) {
                // Fetch all task completions for the current child
                $Data = $CompletionModal->where_order_desc(["ChildID" => $Child->ChildID]);
        
                if (!empty($Data)) {
                    foreach ($Data as $row) {
                        $task = $TaskModal->first(["TaskID" => $row->TaskID]);
        
                        if ($task) {
                            $taskDeadline = new \DateTime($task->Deadline);
        
                            if ($taskDeadline >= $today) { // Include tasks with today's or future deadline
                                $Teacher = $TeacherModal->first(["TeacherID" => $task->TeacherID]);
                                $Media = $MediaModal->first(["MediaID" => $task->MediaID]);
        
                                if ($Media) {
                                    // Check MediaType filter
                                    if ($type !== 'All' && $Media->MediaType !== $type) {
                                        continue; // Skip if MediaType does not match
                                    }
        
                                    $taskData = [
                                        "MediaType" => $Media->MediaType ?? '',
                                        "Time" => $row->Time ?? '',
                                        "URL" => $Media->URL ?? '',
                                        "Image" => $Media->Image ?? '',
                                        "ImageType" => $Media->ImageType ?? '',
                                        "MediaID" => $Media->MediaID ?? '',
                                        "Deadline" => $task->Deadline ?? '',
                                        "TeacherName" => $Teacher->First_Name ?? '',
                                        "Title" => $Media->Title ?? '',
                                        "Description" => $Media->Description ?? '',
                                        "Format" => $Media->Format ?? '',
                                        "ChildName" => $Child->First_Name // Add child's name
                                    ];
        
                                    // Convert image to base64 if it exists
                                    if (!empty($taskData["Image"]) && !empty($taskData["ImageType"])) {
                                        $taskData["Image"] = 'data:' . $taskData["ImageType"] . ';base64,' . base64_encode($taskData["Image"]);
                                    }
        
                                    // Add task entry for this child
                                    $TaskList[] = $taskData;
                                }
                            }
                        }
                    }
                }
            }
        
            // Sort TaskList by Deadline (earliest first)
            usort($TaskList, function ($a, $b) {
                return strtotime($a["Deadline"]) - strtotime($b["Deadline"]);
            });
        
            if (empty($TaskList)) {
                echo json_encode(['success' => true, 'message' => 'No events found for the selected filters']);
            } else {
                echo json_encode(['success' => true, 'data' => $TaskList]);
            }
        }        

        public function setchildsession()
        {
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