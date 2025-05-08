<?php

    namespace Controller;
    use App\Helpers\SidebarHelper;

    defined('ROOTPATH') or exit('Access denied');

    class FunzoneTasks{
        use MainController;
        public function index(){

            $session = new \Core\Session;
             
            $session = new \Core\Session;
            $session->check_login();
            $session->check_child('Parent');
            $ChildID = $session->get('CHILDID');
    
            $data = [];
            $SidebarHelper = new SidebarHelper();
            $data = $SidebarHelper->store_sidebar();
    
            $ChildModal = new \Modal\Child;
            $select = $ChildModal->first(['ChildID' => $ChildID]);
            $data['child_id'] = $ChildID;
    
            if (!empty($select)) {
                $data2 = $this->selectedchild($select);
                $data = $data + $data2;
            }

            $this->view('Child/funzonetasks',$data);
        }

        public function store_tasks() {
            $session = new \Core\Session;
             
            header('Content-Type: application/json');
            $requestData = json_decode(file_get_contents("php://input"), true);
            
            $type = $requestData['type']?? 'All';
        
            $Session = new \core\session;
            $ChildID = $Session->get("CHILDID");
        
            $CompletionModal = new \Modal\TaskCompletion;
            $MediaModal = new \Modal\Media;
            $TaskModal = new \Modal\Task;
            $TeacherModal = new \Modal\Teacher;
        
            $today = new \DateTime();
            $Data = $CompletionModal->where_order_desc(["ChildID" => $ChildID]);
        
            foreach ($Data as $key => $row) {
                $task = $TaskModal->first(["TaskID" => $row->TaskID]);
        
                if ($task) {
                    $row->Deadline = $task->Deadline;
                    $taskDeadline = new \DateTime($task->Deadline);

                    if ($taskDeadline > $today) {
                        $Teacher = $TeacherModal->first(["TeacherID" => $task->TeacherID]);
                        $Media = $MediaModal->first(["MediaID" => $task->MediaID]);
                        if ($Media) {
                            // Check MediaType filter
                            if ($type !== 'All' && $Media->MediaType !== $type) {
                                unset($Data[$key]); // Skip if MediaType does not match
                                continue;
                            }
        
                            $row->MediaType = $Media->MediaType ?? '';
                            $row->Time = $row->Time ?? '';
                            $row->URL = $Media->URL ?? '';
                            $row->Image = $Media->Image ?? '';
                            $row->ImageType = $Media->ImageType ?? '';
                            $row->MediaID = $Media->MediaID ?? '';
        
                            // // Convert image to base64 if it exists
                            if (!empty($row->Image) && !empty($row->ImageType)) {
                                $row->Image = 'data:' . $row->ImageType . ';base64,' . base64_encode($row->Image);
                            }
        
                            $row->Deadline = $task->Deadline?? '';
                            $row->TeacherName = $Teacher->First_Name?? '';
                            $row->ImageType = $Media->ImageType ?? '';
                            $row->URL = $Media->URL ?? '';
                            $row->Title = $Media->Title ?? '';
                            $row->Description = $Media->Description ?? '';
                            $row->Format = $Media->Format ?? '';
                        } else {
                            unset($Data[$key]);
                        }
                    } else {
                        unset($Data[$key]);
                    }
                } else {
                    unset($Data[$key]);
                }
            }
            $Data = array_values($Data);

            usort($Data, function ($a, $b) {
                return strtotime($b->Deadline) - strtotime($a->Deadline); // Sort descending
            });            

            if (empty($Data)) {
                echo json_encode(['success' => true, 'message' => 'No events found for the selected filters']);
            } else {
                echo json_encode(['success' => true, 'data' => $Data]);
            }
        }                

        private function selectedchild($selectedchild){
            $session = new \Core\Session;
             
            $data = [];

            $imageData = $selectedchild->Image;
            $imageType = $selectedchild->ImageType;

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

        public function removechildsession()
        {
            $session = new \Core\Session;
             
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

            echo json_encode($response);  // Send JSON response
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
?>