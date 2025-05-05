<?php

    namespace Controller;
    use App\Helpers\SidebarHelper;

    defined('ROOTPATH') or exit('Access denied');

    class FunzoneHome{
        use MainController;
        public function index(){

            $session = new \Core\Session;
            $session->set("USERID", 1);
            $session = new \Core\Session;
            $session->check_login();

            $data = [];
            $SidebarHelper = new SidebarHelper();
            $data = $SidebarHelper->store_sidebar();

            $this->view('Parent/funzonehome', $data);
        }

        public function store_media() {
            $session = new \Core\Session;
            $session->set("USERID", 1);
            header('Content-Type: application/json');
            $requestData = json_decode(file_get_contents("php://input"), true);
        
            $type = $requestData['type'] ?? 'All';
        
            $Session = new \core\session;
            $ChildModal = new \Modal\Child;
            $ParentModal = new \Modal\ParentUser;
        
            $UserID = $Session->get("USERID");
            $Parent = $ParentModal->first(["UserID" => $UserID]);
            $Children = $ChildModal->where_norder(["ParentID" => $Parent->ParentID]);
        
            $data = [];
            $MediaModal = new \Modal\Media;
            $mediaFilter = ($type !== 'All') ? ["MediaType" => $type] : [];
        
            // Fetch Trending Media
            $Media = empty($mediaFilter) ? $MediaModal->findall_order("Views", "DESC") : $MediaModal->where_order_desc($mediaFilter, [], "Views");
            $data['Trending'] = array_slice($Media, 0, 20);
            $data['Trending_avail'] = count($Media) > 20;
        
            // Fetch History for all children
            $HistoryModal = new \Modal\MediaHistory;
            $updatedHistory = [];
        
            foreach ($Children as $Child) {
                $History = $HistoryModal->where_order_desc(["ChildID" => $Child->ChildID], [], "DateTime");
                if(!empty($History)){
                    foreach ($History as $row) {
                        $filterhistory = empty($mediaFilter) ? ["MediaID" => $row->MediaID] : ["MediaID" => $row->MediaID, "MediaType" => $type];
                        $mediaDetails = $MediaModal->first($filterhistory);
                        if ($mediaDetails) {
                            $updatedHistory[] = $mediaDetails;
                        }
                    }
                }
            }
        
            $data['History'] = array_slice($updatedHistory, 0, 20);
            $data['History-avail'] = count($updatedHistory) > 20;
        
            // Fetch Popular media
            $Popular = empty($mediaFilter) ? $MediaModal->findall_order("Downloads", "DESC") : $MediaModal->where_order_desc($mediaFilter, [], "Downloads");
            $data['Popular'] = array_slice($Popular, 0, 20);
            $data['Popular_avail'] = count($Popular) > 20;
        
            // Fetch Recommended media for all children
            $recommendedMedia = [];
            foreach ($Children as $Child) {
                $current_year = date("Y");
                $dob_date = new \DateTime($Child->DOB);
                $start_of_year = new \DateTime("$current_year-01-01");
                $age = $start_of_year->diff($dob_date)->y;
        
                $age_groups = ['3-5', '6-9', '10-13'];
                $AgeGroup = '3-5';
        
                foreach ($age_groups as $group) {
                    list($start, $end) = explode('-', $group);
                    if ($age >= $start && $age <= $end) {
                        $AgeGroup = $group;
                        break;
                    }
                }
        
                $recommendedFilter = ["AgeGroup" => $AgeGroup];
                if ($type !== 'All') {
                    $recommendedFilter["MediaType"] = $type;
                }
        
                $Recomended = $MediaModal->where_order_desc($recommendedFilter, [], "DateTime");
                if(!empty($Recomended)){
                    $recommendedMedia = array_merge($recommendedMedia, $Recomended);
                }
            }
        
            $data['Recomended'] = array_slice($recommendedMedia, 0, 20);
            $data['Recomended_avail'] = count($recommendedMedia) > 20;
        
            // Fetch New Media
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
            $session->set("USERID", 1);
            header('Content-Type: application/json');
            $requestData = json_decode(file_get_contents("php://input"), true);
        
            $type = $requestData['type'] ?? 'All';
            $grid = $requestData['grid'];
            $count = $requestData['count'];
        
            $Session = new \core\session;
            $ChildModal = new \Modal\Child;
            $ParentModal = new \Modal\ParentUser;
        
            $UserID = $Session->get("USERID");
            $Parent = $ParentModal->first(["UserID" => $UserID]);
            $Children = $ChildModal->where_norder(["ParentID" => $Parent->ParentID]);
        
            $data = [];
            $MediaModal = new \Modal\Media;
            $mediaFilter = ($type !== 'All') ? ["MediaType" => $type] : [];
        
            // Fetch data based on grid selection
            switch ($grid) {
                case 'trending-grid':
                    $Media = empty($mediaFilter) ? $MediaModal->findall_order("Views", "DESC") : $MediaModal->where_order_desc($mediaFilter, [], "Views");
                    if (!empty($Media)) {
                        $data['Trending'] = array_slice($Media, $count, 20);
                        $data['Trending_avail'] = count($Media) > ($count + 20);
                    }
                    break;
                case 'popular-grid':
                    $Popular = empty($mediaFilter) ? $MediaModal->findall_order("Downloads", "DESC") : $MediaModal->where_order_desc($mediaFilter, [], "Downloads");
                    if (!empty($Popular)) {
                        $data['Popular'] = array_slice($Popular, $count, 20);
                        $data['Popular_avail'] = count($Popular) > ($count + 20);
                    }
                    break;
                case 'recommended-grid':
                    $recommendedMedia = [];
                    foreach ($Children as $Child) {
                        $current_year = date("Y");
                        $dob_date = new \DateTime($Child->DOB);
                        $start_of_year = new \DateTime("$current_year-01-01");
                        $age = $start_of_year->diff($dob_date)->y;
        
                        $age_groups = ['3-5', '6-9', '10-13'];
                        $AgeGroup = '3-5';
        
                        foreach ($age_groups as $group) {
                            list($start, $end) = explode('-', $group);
                            if ($age >= $start && $age <= $end) {
                                $AgeGroup = $group;
                                break;
                            }
                        }
        
                        $recommendedFilter = ["AgeGroup" => $AgeGroup];
                        if ($type !== 'All') {
                            $recommendedFilter["MediaType"] = $type;
                        }
        
                        $Recomended = $MediaModal->where_order_desc($recommendedFilter, [], "DateTime");
                        if (!empty($Recomended)) {
                            $recommendedMedia = array_merge($recommendedMedia, $Recomended);
                        }
                    }
                    if (!empty($recommendedMedia)) {
                        $data['Recomended'] = array_slice($recommendedMedia, $count, 20);
                        $data['Recomended_avail'] = count($recommendedMedia) > ($count + 20);
                    }
                    break;
                case 'watch-again-grid':
                    $updatedHistory = [];
                    $HistoryModal = new \Modal\MediaHistory;
                    foreach ($Children as $Child) {
                        $History = $HistoryModal->where_order_desc(["ChildID" => $Child->ChildID], [], "DateTime");
                        foreach ($History as $row) {
                            $filterhistory = empty($mediaFilter) ? ["MediaID" => $row->MediaID] : ["MediaID" => $row->MediaID, "MediaType" => $type];
                            $mediaDetails = $MediaModal->first($filterhistory);
                            if ($mediaDetails) {
                                $updatedHistory[] = $mediaDetails;
                            }
                        }
                    }
                    if (!empty($updatedHistory)) {
                        $data['History'] = array_slice($updatedHistory, $count, 20);
                        $data['History_avail'] = count($updatedHistory) > ($count + 20);
                    }
                    break;
                case 'new-grid':
                    $NewMedia = empty($mediaFilter) ? $MediaModal->findall_order("DateTime", "DESC") : $MediaModal->where_order_desc($mediaFilter, [], "DateTime");
                    if (!empty($NewMedia)) {
                        $data['New'] = array_slice($NewMedia, $count, 20);
                        $data['New_avail'] = count($NewMedia) > ($count + 20);
                    }
                    break;
                default:
                    echo json_encode(['success' => false, 'message' => 'Invalid grid parameter']);
                    return;
            }
        
            if (empty($data)) {
                echo json_encode(['success' => false, 'message' => 'No media records found for the selected filters']);
            } else {
                echo json_encode(['success' => true, 'data' => $data]);
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