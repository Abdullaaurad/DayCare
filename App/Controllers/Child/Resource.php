<?php

    namespace Controller;
    use App\Helpers\SidebarHelper;

    defined('ROOTPATH') or exit('Access denied');

    class Resource{
        use MainController;
        public function index(){
            $session = new \Core\Session;
            $session->check_login();
            $session->check_child();
            $ChildID = $session->get("CHILDID");
    
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

            $data = $data + $this->store_resourse();
            $data = $data + $this->related_resource();
            $this->view('Child/Resource' , $data);
        }

        private function selectedchild($selectedchild)
        {
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

        public function like(){
            header('Content-Type: application/json');
            $requestData = json_decode(file_get_contents("php://input"), true);
            $MediaID = $requestData['mediaID'];

            $CommentModal = new \Modal\Comment;

            $session = new \Core\Session;
            $ChildID = $session->get("CHILDID");
            $Comments = $CommentModal->where_norder(["MediaID" => $MediaID , "ChildID" => $ChildID]);
            if($Comments){
                foreach ($Comments as $Comment) {
                    $newLikeStatus = !$Comment->Liked;
                
                    $CommentModal->update(
                        ["CommentID" => $Comment->CommentID],
                        ["Liked" => $newLikeStatus]
                    );
                }            
            }
            else{
                $CommentModal->insert([
                    "MediaID" => $MediaID, 
                    "ChildID" => $ChildID, 
                    "DateCommented" => date("Y-m-d H:i:s"),
                    "Liked" => true
                ]);
            }

            echo json_encode(['success' => true, 'data' => $MediaID]);
        }

        public function whishlist(){
            header('Content-Type: application/json');
            $requestData = json_decode(file_get_contents("php://input"), true);
            $MediaID = $requestData['mediaID'];

            $WhishlistModal = new \modal\MediaWhishlist;

            $session = new \Core\Session;
            $ChildID = $session->get("CHILDID");
            $Whishlist = $WhishlistModal->first(["MediaID"=> $MediaID, "ChildID" => $ChildID]);

            if($Whishlist){
                $WhishlistModal->delete($Whishlist->WishlistID, "WishlistID");
            }else{
                $WhishlistModal->insert([
                    "MediaID" => $MediaID,
                    "ChildID" => $ChildID,
                    "Date" => date("Y-m-d"),
                    "Time" => date("H:i:s")
                ]);                
            }

            echo json_encode(['success' => true, 'data' => $Whishlist]);
        }

        public function Add_Comment(){
            $Comment = $_POST['Comment'];
            $MediaID = $_POST['MediaID'];

            $CommentModal = new \Modal\Comment;
            $session = new \Core\Session;
            $ChildID = $session->get("CHILDID");

            $CommentModal->insert(["MediaID" => $MediaID, "ChildID" => $ChildID, "CommentText" => $Comment, "DateCommented" => date("Y-m-d H:i:s")]);
            redirect('Child/Resource?MediaID='.$MediaID);
        }

        public function Edit_Comment() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['CommentID'], $_POST['Comment'])) {
                $CommentID = $_POST['CommentID'];
                $CommentText = $_POST['Comment'];
        
                $CommentModal = new \Modal\Comment;
                $CommentModal->update(["CommentID" => $CommentID], ["CommentText" => $CommentText]);
                redirect('Child/Resource?MediaID=' . $_POST['MediaID']);
            }
        }        

        public function Delete_Comment() {
            $data = json_decode(file_get_contents("php://input"), true);
            if (isset($data['CommentID'])) {
                $CommentModal = new \Modal\Comment;
                $CommentModal->delete($data['CommentID'] ,"CommentID" );
                echo json_encode(["message" => "Comment deleted successfully"]);
            } else {
                echo json_encode(["error" => "Invalid request"]);
            }
        }   
        
        private function related_resource() {
            if (isset($_GET['MediaID'])) {
                $MediaID = (int) $_GET['MediaID'];
        
                $MediaModal = new \Modal\Media;
                $session = new \Core\Session;
                $ChildID = $session->get("CHILDID");
        
                // Get current media
                $Media = $MediaModal->first(["MediaID" => $MediaID]);
                if (!$Media) return [];
        
                $currentDescription = strtolower(trim($Media->Description));
        
                // Get all media (including the current one)
                $allMedia = $MediaModal->findall();  
        
                $relatedMedia = [];
        
                // Iterate over all media
                foreach ($allMedia as $otherMedia) {
                    // Skip the current media
                    if ($otherMedia->MediaID == $MediaID) {
                        continue;  // Skip this iteration and go to the next
                    }
        
                    $otherDescription = strtolower(trim($otherMedia->Description));
        
                    // Compute similarity (Levenshtein Distance)
                    $similarity = levenshtein($currentDescription, $otherDescription);
        
                    // Store with similarity score
                    $relatedMedia[] = [
                        "Media" => $otherMedia,
                        "Score" => $similarity
                    ];
                }
        
                // Sort by lowest similarity score (more similar)
                usort($relatedMedia, fn($a, $b) => $a['Score'] <=> $b['Score']);
        
                // Select the top 4 most similar media
                $data['relevant'] = array_slice(array_column($relatedMedia, 'Media'), 0, 4);
        
                return $data;
            }
        }        

        private function store_resourse(){
            if (isset($_GET['MediaID'])) {
                $MediaID = $_GET['MediaID'];
                $MediaID = (int)$MediaID;

                $HistoryModal = new \Modal\MediaHistory;
                $MediaModal = new \Modal\Media;
                $CommentModal = new \Modal\Comment;
                $WidhlistModal = new \modal\MediaWhishlist;

                $session = new \Core\Session;
                $ChildID = $session->get("CHILDID");

                $History = $HistoryModal->where_order_desc(["ChildID" => $ChildID], [], "DateTime");
                if ($History[0]->MediaID == $MediaID) {
                    $HistoryModal->update(
                        ["HistoryID" => $History[0]->HistoryID],
                        ["DateTime" => date("Y-m-d H:i:s"), "MediaID" => $MediaID]
                    );
                }
                else{
                    $HistoryModal->insert(["MediaID"=>$MediaID, "ChildID"=>$ChildID, "DateTime"=> date("Y-m-d H:i:s"), "Progress"=> 100 ]);
                }

                $Media = $MediaModal->first(["MediaID" => $MediaID]);

                $imageData = $Media->Image;
                $imageType = $Media->ImageType;
                $base64Image = (!empty($imageData) && is_string($imageData)) 
                    ? 'data:' . $imageType . ';base64,' . base64_encode($imageData) 
                    : null;

                $Media->Image = $base64Image;

                $Comment = $CommentModal->first(["MediaID" => $MediaID , "ChildID" => $ChildID]);
                $Whishlist = $WidhlistModal->first(["MediaID"=> $MediaID, "ChildID" => $ChildID]);

                if($Whishlist){
                    $Media->whishlist = true;
                }

                if($Comment && $Comment->Liked == true){
                    $Media->Liked = true;
                }

                $Comments =  $CommentModal->where_norder(["MediaID" => $MediaID]);
                if ($Comments) {
                    $ChildModal = new \Modal\Child;
                    foreach ($Comments as $key => $Comment) {
                        // Remove comment if CommentText is null
                        if ($Comment->CommentText === null) {
                            unset($Comments[$key]);
                            continue;
                        }
                    
                        // Mark comment as "mine" if it belongs to the current child
                        if ($Comment->ChildID == $ChildID) {
                            $Comment->Mine = true;
                        }
                    
                        // Split DateCommented into Date and Time
                        if (!empty($Comment->DateCommented)) {
                            $dateTimeParts = explode(' ', $Comment->DateCommented); // Splitting "YYYY-MM-DD HH:MM:SS"
                            $Comment->Date = $dateTimeParts[0]; // Date part
                            $Comment->Time = $dateTimeParts[1]; // Time part
                        }

                        $Child = $ChildModal->first(["ChildID" => $Comment->ChildID]);
                        $imageData = $Child->Image;
                        $imageType = $Child->ImageType;
                        $base64Image = (!empty($imageData) && is_string($imageData)) 
                            ? 'data:' . $imageType . ';base64,' . base64_encode($imageData) 
                            : null;
        
                        $Comment->Image = $base64Image;
                    }                    
                }

                $data['Media'] = $Media;
                $data['Comments'] = json_encode($Comments);

                return $data;
            }
        }
    }
?>