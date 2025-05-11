<?php

    namespace Controller;

    class AddItem{
        use MainController;

        public function index(){
            $session = new \Core\Session;
            $session->check_login();
            $data =  $this->store_stats();
            $data['Profile'] = $this->Profile();

            $this->view('Receptionist/AddItem', $data);
        }

        public function Logout(){
            $session = new \core\Session();
            $session->logout();
    
            echo json_encode(["success" => true]);
            exit;
        }

        private function Profile(){
            $session = new \core\Session;
            $session->set('USERID', 24);
            $UserID = $session->get('USERID');

            $ReceptionistModal = new \Modal\Receptionist;
            $data = $ReceptionistModal->first(["UserID" => $UserID]);
            if(!empty($data)){
                $imageData = $data->Image;
                $imageType = $data->ImageType;
                $base64Image = (!empty($imageData) && is_string($imageData)) 
                    ? 'data:' . $imageType . ';base64,' . base64_encode($imageData) 
                    : null
                ;
                $data->Image = $base64Image;
                $data->EmployeeID = 'EMP' . str_pad($data->UserID, 5, '0', STR_PAD_LEFT);
            }

            return $data;
        }

        public function AddItems()
        {
            header('Content-Type: application/json');
            $StockModal = new \Modal\Stock;
        
            $binaryImage = null;
            $imageType = null;
        
            if (!empty($_FILES['Image']['tmp_name'])) {
                $binaryImage = file_get_contents($_FILES['Image']['tmp_name']);
                $imageType = $_FILES['Image']['type'];
            }
        
            $_POST['Image'] = $binaryImage;
            $_POST['ImageType'] = $imageType;
            $_POST['Quantity'] = isset($_POST['Quantity']) ? (int) $_POST['Quantity'] : 0;
            $_POST['MinQuantity'] = isset($_POST['MinQuantity']) ? (int) $_POST['MinQuantity'] : 0;
            $_POST['Price'] = isset($_POST['Price']) ? (float) $_POST['Price'] : 0.0;
            $_POST['ItemID'] = isset($_POST['ItemID']) ? (int) $_POST['ItemID'] : 0.0;
        
            if ($StockModal->validate($_POST)) {
                $StockModal->insert($_POST);
                echo json_encode(['success' => true, 'message' => 'Item added successfully.']);
                exit;
            }
        
            echo json_encode(['success' => false, 'errors' => $StockModal->errors]);
            exit;
        }
        

        public function DeleteStock(){
            header('Content-Type: application/json');
            $requestData = json_decode(file_get_contents("php://input"), true);
            $StockModal = new \Modal\Stock;

            $ItemID = $requestData['ItemID'] ?? null;
            $ItemExists = $StockModal->first(["ItemID" => $ItemID]);
            if(!empty($ItemExists)){
                $StockModal->delete($ItemID, "ItemID");
                $ItemID = "IT-" . str_pad($ItemID, 4, "0", STR_PAD_LEFT);
                $response = [
                    "succcess" => true,
                    "message" => "Deleted Item " . $ItemID . " From Stock"
                ];
            }else{
                $response = [
                    "success" => false,
                    "Item doesn't exists in Stock"
                ];
            }
            echo json_encode($response);
        }

        public function ViewItem(){
            header('Content-Type: application/json');
            $requestData = json_decode(file_get_contents("php://input"), true);

            $ItemID = $requestData['ItemID'] ?? null;
            $StockModal = new \Modal\Stock;
            $Item = $StockModal->first(["ItemID" => $ItemID]);
            $Item->ItemIDmodified = "IT-" . str_pad($Item->ItemID, 4, "0", STR_PAD_LEFT);

            if(!empty($Item)){
                $imageData = $Item->Image;
                $imageType = $Item->ImageType;

                // If image data is available, construct the Base64 string using the correct MIME type
                $base64Image = (!empty($imageData) && is_string($imageData)) 
                    ? 'data:' . $imageType . ';base64,' . base64_encode($imageData) 
                    : null
                ;
                $Item->Image = $base64Image;

                $response = [
                    'success' => true,
                    'data' => $Item
                ];
            }
            else{
                $response = [
                    'success' => false,
                    'data' => "The Item is not in stock"
                ];
            }
            echo json_encode($response);
        }

        private function store_stats(){
            $data = [
                "RestockDate" => 0,
                "Categories" => 0,
                "Restocks" => 0
            ];

            $StockModal = new \Modal\Stock;
            $InventoryModal = new \Modal\Inventory;

            $All = $InventoryModal->findall_order("Date", "DESC");
            $dateObj = new \DateTime($All[0]->Date);
            $formattedDateTime = $dateObj->format('M d, Y');
            $data['RestockDate'] = $formattedDateTime;

            $All = $StockModal->findall();
            $categories = [];
            
            foreach ($All as $row) {
                $categories[] = $row->Category;
            }
            
            $uniqueCategories = array_unique($categories);
            $data['Categories'] = count($uniqueCategories);

            $startdate = new \DateTime(date("Y-m-01"));
            $lastdate = new \DateTime(date("Y-m-t"));

            $StockMonthRestocked = $InventoryModal->findFutureDatesWithConditions($startdate, $lastdate, ["Activity" => "Restocked"]);
            if(!empty($StockMonthRestocked)){
                foreach ($StockMonthRestocked as $row){
                    $data['Restocks'] += $row->Quantity;
                }
            }

            return $data;
        }

        public function NameError(){
            header('Content-Type: application/json');
            $requestData = json_decode(file_get_contents("php://input"), true);

            $Item = $requestData['Item'] ?? null;
            $Category = $requestData['Category'] ?? null;

            $StockModal = new \Modal\Stock;
            $Stock = $StockModal->first(["Item" => $Item, "Category" => $Category]);

            if(!empty($Stock)){
                $response = [
                    'success' => false,
                    'data' => "Item already exists in stock"
                ];
            }
            else{
                $response = [
                    'success' => true,
                    'data' => "Item can be added"
                ];
            }
            echo json_encode($response);   
        }

        public function EditItem(){

            $StockModal = new \Modal\Stock;
            if (!empty($_FILES['Image']['tmp_name'])) {
                $binaryImage = file_get_contents($_FILES['Image']['tmp_name']);
                $imageType = $_FILES['Image']['type'];

                $_POST['Image'] = $binaryImage;
                $_POST['ImageType'] = $imageType;
            }
            $Errors = $StockModal->validate($_POST);
            if(empty($Errors)){
                unset($_SESSION['errors']);
                unset($_SESSION['old']);
                unset($_SESSION ['Edit']);
                $StockModal->update(["ItemID" => $_POST['ItemID']], $_POST);
                redirect('Inventory/InventoryManage');
            }
            else{
                $_SESSION['errors'] = $StockModal->errors;
                $_SESSION['old'] = $_POST;
                $_SESSION ['Edit'] = 'EditError';
            }
        }

        public function EditNameError(){
            header('Content-Type: application/json');
            $requestData = json_decode(file_get_contents("php://input"), true);

            $Item = $requestData['Item'] ?? null;
            $Category = $requestData['Category'] ?? null;
            $ItemID = $requestData['ItemID'] ?? null;

            $StockModal = new \Modal\Stock;
            $Stock = $StockModal->first(["Item" => $Item, "Category" => $Category]);

            if(!empty($Stock) && $Stock->ItemID != $ItemID){
                $response = [
                    'success' => false,
                    'data' => "Item already exists in stock"
                ];
            }
            else{
                $response = [
                    'success' => true,
                    'data' => "Item can be added"
                ];
            }
            echo json_encode($response);
        }

        public function StoreInventory() {
            header('Content-Type: application/json');
            $requestData = json_decode(file_get_contents("php://input"), true);
        
            $Category = $requestData['Category'] ?? null;
            $Category = ($Category === 'null' || $Category === 'All') ? null : $Category;
        
            $Status = $requestData['Status'] ?? null;
            $Status = ($Status === 'null' || $Status === 'All') ? null : $Status;
        
            $Pagination = $requestData['Pagination'] ?? 1;
            $itemsPerPage = 5;
            $offset = ($Pagination - 1) * $itemsPerPage;
        
            $StockModal = new \Modal\Stock;
            $InventoryModal = new \Modal\Inventory;
        
            $allStock = $StockModal->findall();
            $filteredStock = [];
        
            foreach ($allStock as $row) {
                unset($row->Image);
                unset($row->ImageType);

                if ($Category && $row->Category !== $Category) {
                    continue;
                }
        
                if ($row->Quantity == 0) {
                    $row->Status = "Out of Stock";
                } else if ($row->Quantity < $row->MinQuantity) {
                    $row->Status = "Low Stock";
                } else {
                    $row->Status = "Available";
                }
        
                if ($Status && $row->Status !== $Status) {
                    continue;
                }
        
                $Stocked = $InventoryModal->first([
                    "ItemID" => $row->ItemID,
                    "Activity" => "Restocked"
                ]);
                if (!empty($Stocked)) {
                    $dateObj = new \DateTime($Stocked->Date);
                    $row->Date = $dateObj->format('M d, Y');
                }else{
                    $row->Date = null;
                }
        
                // Get issued quantity for the current month
                $row->Issued = 0;
                $startdate = new \DateTime(date("Y-m-01"));
                $lastdate = new \DateTime(date("Y-m-t"));
        
                $Issued = $InventoryModal->findFutureDatesWithConditions(
                    $startdate,
                    $lastdate,
                    ["ItemID" => $row->ItemID, "Activity" => "Returned"],
                    "Date"
                );
        
                if (!empty($Issued)) {
                    foreach ($Issued as $issue) {
                        $row->Issued += $issue->Quantity;
                    }
                }

                $row->ItemIDmodified = "IT-" . str_pad($row->ItemID, 4, "0", STR_PAD_LEFT);
        
                $filteredStock[] = $row;
            }
        
            $totalItems = count($filteredStock);
            $pagedStock = array_slice($filteredStock, $offset, $itemsPerPage);
        
            $response = [
                'success' => true,
                'data' => [
                    'Stock' => $pagedStock,
                    'TotalPages' => ceil($totalItems / $itemsPerPage),
                    'CurrentPage' => (int)$Pagination
                ]
            ];
        
            echo json_encode($response);
        }        
    }
?>