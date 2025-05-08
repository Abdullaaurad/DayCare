<?php

    namespace Controller;
    use App\Helpers\SidebarHelper;

    defined('ROOTPATH') or exit('Access denied');

    class FunzoneHome
    {
        use MainController;
        public function index()
        {
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

            $this->view('Child/funzonehome', $data);
        }

        public function store_media() {
            $session = new \Core\Session;
             
            header('Content-Type: application/json');
            $requestData = json_decode(file_get_contents("php://input"), true);
        
            $type = $requestData['type'] ?? 'All';
        
            $Session = new \core\session;
            $ChildID = $Session->get("CHILDID");
            $ChildModal = new \Modal\Child;
            $Child = $ChildModal->first(["ChildID" => $ChildID]);
        
            $data = [];
            $MediaModal = new \Modal\Media;
            $mediaFilter = ($type !== 'All')? ["MediaType" => $type] : [];
        
            $Media = empty($mediaFilter) ? $MediaModal->findall_order("Views", "DESC") : $MediaModal->where_order_desc($mediaFilter, [], "Views");
            $data['Trending'] = array_slice($Media, 0, 20);
            $data['Trending_avail'] = count($Media) > 20;
        
            // Fetch History for the child (sorted by DateTime)
            $HistoryModal = new \Modal\MediaHistory;
            $History = $HistoryModal->where_order_desc(["ChildID" => $ChildID], [], "DateTime");

            $updatedHistory = [];
            foreach ($History as $row) {
                $filterhistory = [];
                $filterhistory = empty($mediaFilter) ? ["MediaID" => $row->MediaID] : ["MediaID" => $row->MediaID, "MediaType" => $type];
                $mediaDetails = $MediaModal->first($filterhistory);
                if ($mediaDetails) {
                    $updatedHistory[] = $mediaDetails;
                }
            }
            $data['History'] = array_slice($updatedHistory, 0, 20);
            $data['History-avail'] = count($updatedHistory) > 20;
        
            // Fetch Popular media (sorted by Downloads)
            $Popular = empty($mediaFilter) ? $MediaModal->findall_order("Downloads", "DESC") : $MediaModal->where_order_desc($mediaFilter, [], "Downloads");
            $data['Popular'] = array_slice($Popular, 0, 20);
            $data['Popular_avail'] = count($Popular) > 20;
        
            // Calculate child's age at the start of the year
            $current_year = date("Y");
            $dob_date = new \DateTime($Child->DOB);
            $start_of_year = new \DateTime("$current_year-01-01");
            $age = $start_of_year->diff($dob_date)->y;
        
            // Map Age to AgeGroup
            $age_groups = ['3-5','6-9','10-13'];
            $AgeGroup = '2-3'; // Default AgeGroup
        
            foreach ($age_groups as $group) {
                list($start, $end) = explode('-', $group);
                if ($age >= $start && $age <= $end) {
                    $AgeGroup = $group;
                    break;
                }
            }
        
            // Build Recommended filter: Always filter by AgeGroup, add MediaType only if needed
            $recommendedFilter = ["AgeGroup" => $AgeGroup];
            if ($type !== 'All') {
                $recommendedFilter["MediaType"] = $type;
            }
        
            // Fetch Recommended media (sorted by DateTime)
            $Recomended = $MediaModal->where_order_desc($recommendedFilter, [], "DateTime");
            $data['Recomended'] = array_slice($Recomended, 0, 20);
            $data['Recomended_avail'] = count($Popular) > 20;

            $NewMedia = empty($mediaFilter) ? $MediaModal->findall_order("DateTime", "DESC") : $MediaModal->where_order_desc($mediaFilter, [], "DateTime");
            $data['New'] = array_slice($NewMedia, 0, 20);
            $data['New_avail'] = count($NewMedia) > 20;
        
            // Process images for each media type group
            foreach (['Trending', 'History', 'Popular', 'Recomended', 'New'] as $key) {
                foreach ($data[$key] as &$item) {
                    if ($item->MediaType !== 'Image' && !empty($item->Image)) {
                        $imageData = $item->Image;
                        $imageType = $item->ImageType;
        
                        $base64Image = (!empty($imageData) && is_string($imageData))
                            ? 'data:' . $imageType . ';base64,' . base64_encode($imageData)
                            : null;
        
                        $item->Image = $base64Image;
                    }
                }
            }
        
            if (empty($data)) {
                echo json_encode(['success' => false, 'message' => 'No media records found for the selected filters']);
            } else {
                echo json_encode(['success' => true, 'data' => $data]);
            }
        }
        
        public function store_extra() {
            $session = new \Core\Session;
             
            header('Content-Type: application/json');
            $requestData = json_decode(file_get_contents("php://input"), true);
        
            $type = $requestData['type'] ?? 'All';
            $grid = $requestData['grid'];  // e.g., trending-grid, history-grid, etc.
            $count = $requestData['count']; // starting point for pagination
        
            $Session = new \core\session;
            $ChildID = $Session->get("CHILDID");
            $ChildModal = new \Modal\Child;
            $Child = $ChildModal->first(["ChildID" => $ChildID]);
        
            $data = [];
            $MediaModal = new \Modal\Media;
            $mediaFilter = ($type !== 'All') ? ["MediaType" => $type] : [];
        
            // Fetch data based on grid selection
            switch ($grid) {
                case 'trending-grid':
                    $Media = empty($mediaFilter) ? $MediaModal->findall_order("Views", "DESC") : $MediaModal->where_order_desc($mediaFilter, [], "Views");
                    $data['Trending'] = array_slice($Media, $count, 20); // Fetch from count to count + 20
                    $data['Trending_avail'] = count($Media) > ($count + 20);
                    break;
                case 'popular-grid':
                    $Popular = empty($mediaFilter) ? $MediaModal->findall_order("Downloads", "DESC") : $MediaModal->where_order_desc($mediaFilter, [], "Downloads");
                    $data['Popular'] = array_slice($Popular, $count, 20); // Fetch from count to count + 20
                    $data['Popular_avail'] = count($Popular) > ($count + 20);
                    break;
                case 'recommended-grid':
                    // Calculate child's age at the start of the year
                    $current_year = date("Y");
                    $dob_date = new \DateTime($Child->DOB);
                    $start_of_year = new \DateTime("$current_year-01-01");
                    $age = $start_of_year->diff($dob_date)->y;
        
                    // Map Age to AgeGroup
                    $age_groups = ['3-5','6-9','10-13'];
                    $AgeGroup = '2-3'; // Default AgeGroup
        
                    foreach ($age_groups as $group) {
                        list($start, $end) = explode('-', $group);
                        if ($age >= $start && $age <= $end) {
                            $AgeGroup = $group;
                            break;
                        }
                    }
        
                    // Build Recommended filter
                    $recommendedFilter = ["AgeGroup" => $AgeGroup];
                    if ($type !== 'All') {
                        $recommendedFilter["MediaType"] = $type;
                    }
        
                    // Fetch Recommended media (sorted by DateTime)
                    $Recomended = $MediaModal->where_order_desc($recommendedFilter, [], "DateTime");
                    $data['Recomended'] = array_slice($Recomended, $count, 20); // Fetch from count to count + 20
                    $data['Recomended_avail'] = count($Recomended) > ($count + 20);
                    break;
                case 'watch-again-grid':
                    // Fetch History for the child (sorted by DateTime)
                    $HistoryModal = new \Modal\MediaHistory;
                    $History = $HistoryModal->where_order_desc(["ChildID" => $ChildID], [], "DateTime");
        
                    $updatedHistory = [];
                    foreach ($History as $row) {
                        $filterhistory = empty($mediaFilter) ? ["MediaID" => $row->MediaID] : ["MediaID" => $row->MediaID, "MediaType" => $type];
                        $mediaDetails = $MediaModal->first($filterhistory);
                        if ($mediaDetails) {
                            $updatedHistory[] = $mediaDetails;
                        }
                    }
                    $data['History'] = array_slice($updatedHistory, $count, 20); // Fetch from count to count + 20
                    $data['History_avail'] = count($updatedHistory) > ($count + 20);
                    break;
                case 'new-grid':
                    // Fetch New media inputs (sorted by DateTime descending)
                    $NewMedia = empty($mediaFilter) ? $MediaModal->findall_order("DateTime", "DESC") : $MediaModal->where_order_desc($mediaFilter, [], "DateTime");
                    $data['New'] = array_slice($NewMedia, $count, 20); // Fetch from count to count + 20
                    $data['New_avail'] = count($NewMedia) > ($count + 20);
                    break;
                default:
                    echo json_encode(['success' => false, 'message' => 'Invalid grid parameter']);
                    return;
            }
        
            // Process images for each media type group
            foreach (['Trending', 'History', 'Popular', 'Recomended', 'New'] as $key) {
                if (isset($data[$key])) {
                    foreach ($data[$key] as &$item) {
                        if ($item->MediaType !== 'Image' && !empty($item->Image)) {
                            $imageData = $item->Image;
                            $imageType = $item->ImageType;
        
                            $base64Image = (!empty($imageData) && is_string($imageData))
                                ? 'data:' . $imageType . ';base64,' . base64_encode($imageData)
                                : null;
        
                            $item->Image = $base64Image;
                        }
                    }
                }
            }
        
            // Return response
            if (empty($data)) {
                echo json_encode(['success' => false, 'message' => 'No media records found for the selected filters']);
            } else {
                echo json_encode(['success' => true, 'data' => $data]);
            }
        }
        

        private function selectedchild($selectedchild)
        {
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