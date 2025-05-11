<?php

    namespace Controller;

    class Restock{
        use MainController;

        public function index(){
            $session = new \Core\Session;
            $session->check_login();
            $data = $this->store_stats();
            $data['Profile'] = $this->Profile();

            $this->view('Receptionist/Restock', $data);
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

        public function Logout(){
            $session = new \core\Session();
            $session->logout();
    
            echo json_encode(["success" => true]);
            exit;
        }

        public function store_stats(){
            $StockModal = new \Modal\Stock;
            $Stocks = $StockModal->findall();

            $Data = [
                "Low" => 0,
                "Out" => 0,
                "Full" => 0
            ];

            foreach ($Stocks as $Item){
                if($Item->Quantity == 0){
                    $Data['Out'] += 1;
                }else if($Item->Quantity < $Item->MinQuantity){
                    $Data['Low'] += 1;
                }else{
                    $Data['Full'] += 1;
                }
            }
            return $Data;
        }

        public function RestockItem(){
            $InventoryModal = new \Modal\Inventory;
            $StockModal = new \Modal\Stock;
            $session = new \core\Session;
            $UserID = $session->get("USERID");
            $_POST['UserID'] = $UserID;
            $_POST['Activity'] = "Restocked";

            show($_POST);
            $InventoryModal->insert($_POST);
            $StockModal->update(["ItemID" => $_POST['ItemID']], ["Quantity" => $_POST['Quantity']]);
            redirect('Inventory/Restock');
        }

        public function Low_Stock(){
            $StockModal = new \Modal\Stock;
            $InventoryModal = new \Modal\Inventory;
    
            header('Content-Type: application/json');
            $requestData = json_decode(file_get_contents("php://input"), true);
            $Filter = isset($requestData['Filter']) && trim($requestData['Filter']) !== '' ? trim($requestData['Filter']) : null;
            $Pagination = $requestData['Pagination']?? 1;
            $data1 = [];
            $data2 = [];
            $data3 = [];
    
            $itemsPerPage = 5;
            $offset = ($Pagination - 1) * $itemsPerPage;

            $Stocks = $StockModal->findall();
            foreach ($Stocks as $Item){
                $allowed = true;
                unset($Item->Image);
                unset($Item->ImageType);

                $Item->ItemIDmodified = "IT-" . str_pad($Item->ItemID, 4, "0", STR_PAD_LEFT);
                $Action = $InventoryModal->where_order_desc(["ItemID"=>$Item->ItemID, "Activity" => "Restocked"], [], "Date");
                if(!empty($Action)){
                    $Item->RestockDate = $Action[0]->Date;                   
                }
                if ($Filter !== null && ($Filter != $Item->Item && $Filter != $Item->ItemIDmodified && $Filter != $Item->Category)) {
                    $allowed = false;
                }  
                if($allowed == true){
                    if($Item->Quantity == 0){
                        $Item->class = "status status-out";
                        $Item->Status = "Out Of Stock";
                        $data1[] = $Item;
                    }else if($Item->Quantity < $Item->MinQuantity){
                        $Item->class = "status status-low";
                        $Item->Status = "Low Stock";
                        $data2[] = $Item;
                    }else{
                        $Item->Status = "In Stock";
                        $Item->class = "status status-available";
                        $data3[] = $Item;
                    }
                }
            }
    
            $Data['data'] = $data1 + $data2 + $data3;
            $Data['Count'] = ceil(count($Data['data'])/5);
            $Data['data'] = array_slice($Data['data'], $offset, $itemsPerPage);
            if($Data['Count'] < $Pagination ){
                $Data['Pagination'] = 1;
            }else{
                $Data['Pagination'] = $Pagination;
            }

            echo json_encode($Data);
        }
    }

?>