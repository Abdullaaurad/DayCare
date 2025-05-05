<?php

    namespace Controller;

    class Issue{
        use MainController;

        public function index(){
            $session = new \Core\Session;
            $session->check_login();
            
            $data = $this->store_stats();
            $data['Borrowed'] = $this->store_borrowed();
            $this->view('Inventory/Issue', $data);
        }

        public function store_stats(){
            $InventoryModal = new \Modal\Inventory;
            $StockModal = new \Modal\Stock;
            $Data = [
                "Use" => 0,
                "Overdue" => 0,
                "Available" => 0
            ];

            $Borrowed = $InventoryModal->where_norder(["Activity" => "Borrowed", "Returned" => 0]);
            foreach ($Borrowed as $row){
                $row->ReturnDate = date('Y-m-d', strtotime($row->Date . ' +1 day'));

                $today = date('Y-m-d');
                if($today == $row->Date){
                    $Data['Use'] += $row->Quantity;
                }
                else if($row->ReturnDate == $today){
                    $Data['Use'] += $row->Quantity;
                }
                else{
                    $Data['Overdue'] += $row->Quantity;
                }
            }

            $Stocks = $StockModal->findall();
            foreach ($Stocks as $Item){
                if($Item->Quantity >= $Item->MinQuantity){
                    $Data['Available'] += $Item->Quantity;
                }
            }

            return $Data;
        }

        public function Get_All(){
            $StockModal = new \Modal\Stock;
            $InventoryModal = new \Modal\Inventory;
            $TeacherModal = new \Modal\Teacher;
            $MaidModal = new \Modal\Maid;
            $ReceptionistModal = new \Modal\Receptionist;
            $ManagerModal = new \Modal\Manager;
            $UserModal = new \Modal\User;

            header('Content-Type: application/json');
            $requestData = json_decode(file_get_contents("php://input"), true);
            $Pagination = $requestData['Pagination'] ?? 1;
            $itemsPerPage = 5;
            $offset = ($Pagination - 1) * $itemsPerPage;
        
            $Tarnsactions = $InventoryModal->findall(); // Ideally: support limit/offset
            foreach($Tarnsactions as $row){
                $Item = $StockModal->first(["ItemID" => $row->ItemID]);
                $row->Item = $Item->Item ?? null;
                $row->Category = $Item->Category ?? null;
        
                $User = $UserModal->first(["UserID" => $row->UserID]);
                $row->Role = $User->Role ?? null;
        
                $Persondata = null;
                switch ($User->Role ?? '') {
                    case 'Teacher': $Persondata = $TeacherModal->first(["UserID" => $row->UserID]); break;
                    case 'Maid': $Persondata = $MaidModal->first(["UserID" => $row->UserID]); break;
                    case 'Receptionist': $Persondata = $ReceptionistModal->first(["UserID" => $row->UserID]); break;
                    case 'Manager': $Persondata = $ManagerModal->first(["UserID" => $row->UserID]); break;
                }
        
                $row->Name = ($Persondata->First_Name ?? '') . ' ' . ($Persondata->Last_Name ?? '');
                $row->ReturnDate = date('Y-m-d', strtotime($row->Date . ' +1 day'));
                $row->Date = date('Y-M-d', strtotime($row->Date));
                $row->ItemIDmodified = "IT-" . str_pad($row->ItemID, 4, "0", STR_PAD_LEFT);
            }
            
            $totalItems = count($Tarnsactions);
            $pagedStock = array_slice($Tarnsactions, $offset, $itemsPerPage);
        
            echo json_encode([
                'success' => true,
                'data' =>  $pagedStock,
                'Count' => ceil($totalItems / $itemsPerPage),
                'Pagination' => (int)$Pagination
            ]);
        }  

        public function Return_Borrowed(){
            $InventoryModal = new \Modal\Inventory;
            show($_POST);
            foreach ($_POST as $key=>$row){
                show($key);
                $InventoryModal->update(["ActivityID" => $key], ["Returned" => 1]);
            }
            redirect('Inventory/Issue');
        }
        
        public function store_borrowed(){
            $StockModal = new \Modal\Stock;
            $InventoryModal = new \Modal\Inventory;
            $TeacherModal = new \Modal\Teacher;
            $MaidModal = new \Modal\Maid;
            $ReceptionistModal = new \Modal\Receptionist;
            $ManagerModal = new \Modal\Manager;
            $UserModal = new \Modal\User;

            $Tarnsactions = $InventoryModal->where_order_desc(["Activity" => "Borrowed", "Returned" => 0],[],"Date"); // Ideally: support limit/offset
            foreach($Tarnsactions as $row){
                $Item = $StockModal->first(["ItemID" => $row->ItemID]);
                $row->Item = $Item->Item ?? null;
                $row->Category = $Item->Category ?? null;
        
                $User = $UserModal->first(["UserID" => $row->UserID]);
                $row->Role = $User->Role ?? null;
        
                $Persondata = null;
                switch ($User->Role ?? '') {
                    case 'Teacher': $Persondata = $TeacherModal->first(["UserID" => $row->UserID]); break;
                    case 'Maid': $Persondata = $MaidModal->first(["UserID" => $row->UserID]); break;
                    case 'Receptionist': $Persondata = $ReceptionistModal->first(["UserID" => $row->UserID]); break;
                    case 'Manager': $Persondata = $ManagerModal->first(["UserID" => $row->UserID]); break;
                }
        
                $row->Name = ($Persondata->First_Name ?? '') . ' ' . ($Persondata->Last_Name ?? '');
                $row->ReturnDate = date('Y-m-d', strtotime($row->Date . ' +1 day'));
                $row->Date = date('Y-M-d', strtotime($row->Date));
                $row->ItemIDmodified = "IT-" . str_pad($row->ItemID, 4, "0", STR_PAD_LEFT);
            }

            return $Tarnsactions;
        }
    }
?>